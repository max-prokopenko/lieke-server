<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Response;
use Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Remember to change to auth
        //$games = Game::all()->where('teacher_id', Auth::user()->id);
        $games = Game::all()->where('teacher_id', 1);
      
        $response = json_decode($games);

        return Response::json(array(
                    'error' => false,
                    'games' => $response,
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

        //Remember to change teaxcher id to Auth
        $data = new Game;

        $data->name = $request->name;
        $data->tasks = $request->tasks;
        $data->radius = $request->radius;
        //$data->teacher_id = Auth::user()->id;
        $data->teacher_id = 1;
        $data->group_id = $request->group_id;
        $data->coords = $request->coords;
        $data->created_at = date("Y-m-d H:i:s");
        $data->updated_at = date("Y-m-d H:i:s");

        if($data->save()) {
            return Response::json(array('success' => true, 'last_insert_id' => $data->id), 200);
        }
        //$data->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $games = Game::all()->where('group_id', $id);
      
        $response = json_decode($games);

        return Response::json(array(
                    'error' => false,
                    'games' => $response,
                    'status_code' => 200
        ));
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
