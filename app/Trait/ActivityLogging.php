<?php

/**
 * Trait ActivityLogging
 *
 * Provides functionality for logging activities in a Laravel application.
 * This trait is designed to be used by Eloquent models to automatically
 * log specific events (creation, updates, deletion) as well as custom activity logs.
 */

namespace App\Trait;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;

/**
 * Trait ActivityLogging
 *
 * Provides activity logging capabilities for models.
 */
trait ActivityLogging
{
    /**
     * The default log events for the application.
     */
    private const array DEFAULT_LOG_EVENTS = [
        'created', 'updated', 'deleted'
    ];
    /**
     * The current model class name using this trait.
     */
    private string $className;

    /**
     * Boots the activity logging functionality for the model.
     * Iterates through the defined log events and attaches a logging mechanism
     * that logs activity with a generated description for each event.
     */
    public static function bootActivityLogging(): void
    {
        foreach (self::getLogEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $description = $model->getDescription($event);
                $model->logActivity($description, $event);
            });
        }
    }

    /**
     * Retrieves the log events.
     *
     * @return array The array of log events.
     */
    private static function getLogEvents(): array
    {
        return static::$logEvents ?? self::DEFAULT_LOG_EVENTS;
    }

    /**
     * Initializes activity logging by setting the class name property to the basename of the current class.
     */
    public function initializeActivityLogging(): void
    {
        $this->className = class_basename($this);
    }

    /**
     *
     */
    public function activity(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    /**
     * Retrieves a collection of recent activities associated with the model, limited to the specified number.
     *
     * @param  int  $limit  The maximum number of activities to retrieve. Default is 20.
     * @return Collection A collection of recent activities.
     */
    public function recentActivities(int $limit = 20): Collection
    {
        return $this->activity()->take($limit)->get();
    }

    /**
     * Logs an activity for the current instance.
     *
     * @param  string  $body  The body of the activity to be logged.
     * @return Activity The created activity instance.
     */
    public function logActivity(string $body, $event): Activity
    {
        $isProjectDeleting = $event === 'deleting';

        $data = [
            'project_id' => $this->resolveProjectId($isProjectDeleting),
            'user_id' => $this->resolveUserId(),
            'body' => $body,
            'changes' => $this->changes($event),
        ];

        return $isProjectDeleting
            ? Activity::create($data)
            : $this->activity()->create($data);
    }

    /**
     * Retrieves the description for a given event.
     *
     * @param  string  $event  The event name or identifier.
     * @return string The description of the event.
     */
    public function getDescription(string $event): string
    {
        if ($this->className === 'Task' and $event === 'updated')
            return $this->descriptionForUpdateTask();

        return strtolower($this->className).'_'.$event;
    }

    /**
     * Retrieve the changes made to the model, if any.
     *
     * @return array|null An associative array containing 'before' and 'after' changes, or null if no changes occurred.
     */
    public function changes($event): ?array
    {
        return match ($event) {
            'deleted', 'deleting' => [
                'before' => $this->getOriginal(),
            ],
            default => $this->wasChanged() ? [
                'before' => Arr::except($this->beforeChanges(), ['updated_at']),
                'after' => Arr::except($this->afterChanges(), ['updated_at'])
            ] : NULL
        };
    }

    /**
     * Retrieves the differences between the original attributes and current attributes before changes.
     *
     * @return array The array of changes before the current modifications.
     */
    public function beforeChanges(): array
    {
        return array_diff($this->getOriginal(), $this->getAttributes());
    }

    /**
     * Determines the changes made to the model after updates.
     *
     * @return array The array of changed attributes after comparing the current attributes with the original.
     */
    public function afterChanges(): array
    {
        return array_diff($this->getAttributes(), $this->getOriginal());
    }

    /**
     * @param  bool  $isProjectDeleting
     * @return int|mixed|null
     */
    public function resolveProjectId(bool $isProjectDeleting): mixed
    {
        return $isProjectDeleting
            ? NULL
            : ($this->project ?? $this)->id;
    }

    /**
     * @return int
     */
    private function resolveUserId(): mixed
    {
        return auth()->id() ?? ($this->project ?? $this)->user_id;
    }

    /**
     * Generate a description string based on the state of the task for an update operation.
     *
     * @return string The description string indicating the task update state.
     */
    private function descriptionForUpdateTask(): string
    {
        if ($this->isDirty('body'))
            return 'task_updated';

        return $this->complete ? 'task_completed' : 'task_uncompleted';
    }
}
