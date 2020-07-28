<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Activity;

class UserController extends Controller
{

  public function index(){
  $activities = Activity::where('user_id', Auth::id())->paginate(5);
  return view("user.index", compact("activities"));
}

public function create (Request $request){
  $user = Auth::user();
  $activity = new Activity;
  $userId = $user->id;
  
  $activity->user_id = $userId;
  $activity->title = $request->title;
  $activity->activity_date = $request->date;
  $activity->save();
  return redirect("/user/home");


}

public function destroyActivity(Request $request){
  $activity = Activity::findOrFail($request->activity_id);
  $activity->delete();
  return redirect('/user/home');
}

public function destroyAllActivity(Request $request){
  Activity::where('user_id', Auth::id())->delete();
  return redirect('user/home');
}


public function editActivity (Request $request){
    $activity = Activity::findOrFail($request->activity_id);

    $activity->title = $request->title;
    $activity->activity_date = $request->date;
    $activity->save();

    return redirect("user/home");
}

public function updateStatusDone (Request $request){
    $activity = Activity::findOrFail($request->activity_id);

    $activity->isFinished = 1;
    $activity->save();

    return redirect("user/home");
}

public function updateStatusUnDone (Request $request){
    $activity = Activity::findOrFail($request->activity_id);

    $activity->isFinished = 0;
    $activity->save();

    return redirect("user/home");
}





}
