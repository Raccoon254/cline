<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Task extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        'estimated_duration',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
