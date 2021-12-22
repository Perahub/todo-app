<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\roles;
use Illuminate\Support\Facades\Auth;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::orderBy('created_at', 'ASC')->get();
        $auth = Auth::user();

        if(count($roles) <= 0){//this condition will prevent having a empty role table
            $roles = new Roles;
            $roles->id = 1;
            $roles->name = "Administrator";
            $roles->description = "Super User";
            $roles->save();
            $roles = Roles::orderBy('created_at', 'ASC')->get();
        }
        // return count($roles);
        return Inertia::render('RolesManagement', [ 'roles'=>$roles, 'role_id'=>$auth->role_id ]);
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
        $roles = new Roles;
        $roles->name = $request->name;
        $roles->description = $request->description;
        $roles->save();
        return redirect('RolesManagement');
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
        $roles = Roles::find($id);
        $roles->name = $request->name;
        $roles->description = $request->description;
        $roles->save();
        // return $roles;
        return redirect('RolesManagement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Roles::find($id)->delete();
        return redirect('RolesManagement');
    }
}
