<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model {
	use HasFactory;
	// protected $table = 'todos';

	protected $fillable = [
		'id',
		// 'created_by',
		'title',
		'date',
		'isFinished'
	];

	protected $hidden = [
		// 'password',
	];
}
