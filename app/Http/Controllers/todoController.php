<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\todo;
use Illuminate\Support\Facades\Auth;
class todoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $todos = Todo::where('user_id', $auth->id)->orderBy('created_at', 'ASC')->get();
        // dd($auth->role_id);
        return Inertia::render('TodoList', [ 'todos'=>$todos, 'role_id'=>$auth->role_id ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth = Auth::user();
        $todos = new Todo;
        $todos->user_id = $auth->id;
        $todos->title = $request->title;
        $todos->date = $request->date;
        $todos->isFinished = 0;
        $todos->save();
        return redirect('dashboard');
        // return $roles;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $auth = Auth::user();
        $todos = Todo::find($id);
        $todos->title = $request->title;
        $todos->date = $request->description;

        $todos->save();
        // return $roles;
        return redirect('dashboard');
    }
    public function toggleTodo(Request $request, $id)
    {
        $auth = Auth::user();
        $todos = Todo::find($id);
        $todos->title = $request->title;
        $todos->date = $request->description;
        $todos->isFinished = $request->isFinished;

        $todos->save();
        // return $roles;
        return redirect('dashboard');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::find($id)->delete();
        return redirect('dashboard');
    }
    public function deleteAll(){
        $auth = Auth::user();
        Todo::where('user_id', $auth->id)->delete();
        return redirect('dashboard');
    }
}
