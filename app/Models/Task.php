<?php

namespace App\Models;

use App\enum\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];
    protected $casts = [
        'status' => TaskStatus::class,
    ];
}
