<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection as NormalCollection;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //---------------------------------------------------------------------------

    public function projects(): HasMany
    {
        return $this->HasMany(Project::class)->latest('updated_at');
    }

    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function sharedProjects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_members')->withTimestamps();
    }

    //---------------------------------------------------------------------------

    public function allProjects()
    {
        return $this->projects->merge($this->sharedProjects);
    }

    public function allActivity($limit = 25)
    {
        return $this->projectsActivities()
            ->merge($this->getSharedProjectsActivities())
            ->sortByDesc('created_at')->take($limit)->unique('id');
    }

    public function projectsActivities(): NormalCollection
    {
        return $this->projects->flatMap(fn($project) => $project->activity)
            ->merge(Activity::where('user_id', $this->id)->get());
    }

    private function getSharedProjectsActivities(): NormalCollection
    {
        return $this->sharedProjects
            ->flatMap(fn($project) => $project->activity);
    }
}
