<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Result;
use App\Group_user;
use Response;
use Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Result::all()->where('user_id', Auth::user()->id);
        //$results = Result::all()->where('user_id', 1);

        $total = 0;
        foreach ($results as $key=>$result) {
            $total = $total + $result->result;
        }

        $response = json_decode($results);

        return Response::json(array(
                    'error' => false,
                    'results' => $response, 
                    'total' => $total,
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
        $data = new Result;

        $data->user_id = Auth::user()->id;
        //$data->user_id = $request->user_id;
        $data->game_id = $request->game_id;
        $data->info = $request->info;
        $data->result = $request->result;
        $data->created_at = date("Y-m-d H:i:s");
        $data->updated_at = date("Y-m-d H:i:s");

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

            $groups = Group::where('id', $id)->first();
            $users = $groups->users;

            
            $results = array();
            foreach ($users as $key=>$user) {
                $results_temp = array();
                $results_temp['name'] = $user->name;
                $results_temp['result'] = Result::where('user_id', $user->id)->get();
                array_push($results, $results_temp);
            }

            
            $total = array();
            foreach ($results as $key=>$result) {
                $total_user = 0;
                for ($i=0; $i < count($result['result']); $i++) {
                    
                        $total_user = $total_user + $result['result'][$i]->result;
                }
                $total_user_array = array();
                $total_user_array['result'] = $total_user;
                $total_user_array['name'] = $result['name'];
                array_push($total, $total_user_array);
            }
            usort($total, function($a, $b) {
                return -($a['result'] - $b['result']);
            });
            //$total = array_orderby($total, 'result', SORT_DESC);


            // //$results = Result::all()->where('user_id', Auth::user()->id);
            // $results = Result::all()->where('group_id', 1);
            
            // $response = json_decode($groups);
            // foreach ($results as $key=>$result) {
            //     $total = $total + $result->result;
            // }

            //$response = json_decode($results);

            return Response::json(array(
                        'error' => false,
                        'top' => $total, 
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
