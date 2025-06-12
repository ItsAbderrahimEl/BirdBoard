<?php

namespace App\Models;

use App\Trait\ActivityLogging;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    use ActivityLogging;

    protected static array $logEvents = ['created', 'updated', 'deleting'];
    protected $guarded = [];

    //---------------------------------------------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class)->oldest('complete');
    }

    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }

    //---------------------------------------------------------------------------

    public function path(): string
    {
        return '/projects/'.$this->id;
    }

    public function addTask(array $attributes = [])
    {
        return Task::factory()->recycle($this)->create($attributes);
    }

    public function addTasks(array $tasks): void
    {
        foreach ($tasks as $task) {
            $this->addTask(['body' => $task]);
        }
    }

    public function invite($user): static
    {
        $this->members()->attach($user);
        return $this;
    }
}
