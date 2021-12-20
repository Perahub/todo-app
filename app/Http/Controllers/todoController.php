<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Auth;

class todoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $get_todos = Todo::orderBy("created_at", "desc")->get();

      return view("todo-views.index", compact("get_todos"));
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
      date_default_timezone_set('Asia/Manila');
      $get_user = Auth::user()->id;
      $date = date("Y-m-d H:i:s");
      $title = $request->todo_title;
      $desc = $request->todo_desc;
      $status = "active";

      $insert[] = [
        "created_at" => $date,
        "title" => $title,
        "description" => $desc,
        "status" => $status,
        "user_id" => $get_user,
      ];

      Todo::insert($insert);

      return response()->json(array(
        "status" => "success",
      ));
    }

    public function complete(Request $request)
    {
      date_default_timezone_set('Asia/Manila');
      $get_user = Auth::user()->id;
      $date = date("Y-m-d H:i:s");
      $todo_id = $request->todo_id;

      Todo::where("id", $todo_id)
          ->where("user_id", $get_user)
          ->update(["status" => "is_finished", "completed_date" => $date]);

      return response()->json(array(
        "status" => "success",
      ));
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
    public function update(Request $request)
    {
      date_default_timezone_set('Asia/Manila');
      $get_user = Auth::user()->id;
      $date = date("Y-m-d H:i:s");
      $title = $request->todo_title;
      $desc = $request->todo_desc;
      $todo_id = $request->todo_id;

      Todo::where("id", $todo_id)
          ->where("user_id", $get_user)
          ->update([
            "title" => $title,
            "description" => $desc,
            "updated_at" => $date]);

      return response()->json(array(
        "status" => "success",
      ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $todo_id = $request->todo_id;

      Todo::whereIn("id", $todo_id)->delete();

      return response()->json(array(
        "status" => "success",
      ));
    }
}
