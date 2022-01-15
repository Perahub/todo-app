<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'date' => 'required'
        ]);

        (new Todo())->saveData([
            'id' => $request->id,
            'title' => $request->title,
            'date' => $request->date,
            'created_by' => auth()->user()->id
        ]);

        $message = 'Item added successfully.';

        if(isset($request->id))
        {
            $message = 'Item updated successfully.';
        }

        return response()->json([
            'status' => true,
            'message' => $message
        ]);

    }

    public function all()
    {
        $todos = Todo::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'status' => true,
            'response' => $todos,
            'links' => html_entity_decode($todos->links('pagination::bootstrap-4'))
        ]);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'ids' => 'required'
        ]);

        Todo::whereIn('id', array_values($request->ids))->delete();

        return response()->json([
            'status' => true,
            'message' => 'Item(s) deleted successfully.'
        ]);
    }

    public function markAsComplete(Request $request)
    {
        $this->validate($request, [
            'ids' => 'required'
        ]);

        Todo::whereIn('id', array_values($request->ids))
        ->update([
            'is_finished' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item(s) completed successfully.'
        ]);
    }
}
