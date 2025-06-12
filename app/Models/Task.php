<?php

namespace App\Models;

use App\Trait\ActivityLogging;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    use ActivityLogging;

    public $guarded = [];
    protected $casts = [
        'complete' => 'boolean'
    ];
    protected $touches = ['project'];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($task) {
            $task->activity()->delete();
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function path(): string
    {
        return "/tasks/{$this->id}";
    }
}
