<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status'];

    protected $casts = [
        'status' => TaskStatus::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
