<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Activity;
use App\User;

class AdminController extends Controller
{

  public function index(){
  $activities = Activity::onlyTrashed()->paginate(5);
  return view("admin.admin_index", compact("activities"));
}

public function restoreActivity(Request $request){
		$restoremessage = $request->restore_id;
		$activity = Activity::onlyTrashed()->where("id", $restoremessage);
		$activity->restore();
		return redirect('/admin/home');
	}

}
