<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\WithCrud;

class Todo extends Model
{
    use HasFactory, WithCrud;

    protected $fillable = [
        'title',
        'date',
        'is_finished',
        'created_by',
        'is_finished'
    ];
}
