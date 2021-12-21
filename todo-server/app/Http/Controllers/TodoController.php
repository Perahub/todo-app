<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	public function getTodos() {
		// return Todo::paginate(25);
		return Todo::get();
	}
	public function getTodo($id) {
		return Todo::find($id);
	}

	public function createTodo(Request $request) {
		return Todo::create($request->all());
	}

	public function updateTodo($id, Request $request) {
		$todo = Todo::find($id);
		$todo->update($request->all());
		$todo->is_finished = $request->is_finished == 'true' ? '1' : '0';
		$todo->save();
		return $todo;
	}

	public function deleteTodo($id) {
		$todo = Todo::find($id);
		$todo->delete();
		return $todo;
	}

	public function deleteTodos() {
		Todo::truncate();
		return;
	}
}
