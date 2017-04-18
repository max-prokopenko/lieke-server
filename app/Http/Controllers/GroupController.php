<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Group_user;
use Response;
use Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Remember to change to auth
        
        //$games = Game::all()->where('teacher_id', Auth::guard('teacher')->user()->id);
        $groups = Group::all()->where('teacher_id', Auth::guard('teacher')->user()->id);
                //$groups = Group::all()->where('teacher_id', Auth::user()->id);
        
        
        foreach ($groups as $key=>$group) {
            $users = $group->users;
            $groups[$key]['users'] = $users;
        }

        $response = json_decode($groups);


        return Response::json(array(
                    'error' => false,
                    'groups' => $response,
                    'status_code' => 200
        ));
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
        if ($request->type == "NEW_GROUP") {

            $data = new Group;

            $data->name = $request->name;
            $data->desc = $request->desc;
            //$data->teacher_id = Auth::user()->id;
            $data->teacher_id = 1;
            $data->created_at = date("Y-m-d H:i:s");
            $data->updated_at = date("Y-m-d H:i:s");
            
        }
        elseif ($request->type == "NEW_USER") {
            $data = new Group_user;
            $user = User::where('email', $request->email)->first();
            
            $data->group_id = $request->group_id;
            $data->user_id = $user->id;
            $data->created_at = date("Y-m-d H:i:s");
            $data->updated_at = date("Y-m-d H:i:s");
        }
       
      
        $data->save();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
