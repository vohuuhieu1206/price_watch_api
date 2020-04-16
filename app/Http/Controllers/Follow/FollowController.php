<?php

namespace App\Http\Controllers\Follow;
use App\Follow;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class FollowController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $follows = Follow::all();

        return $this->showAll($follows);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['user_id'] = $request->user_id;
        $data['product_id'] = $request->product_id;

        $follow = Follow::create($data);

        return $this->showOne($follow);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow $follow)
    {
        //
        $follow->delete();
        
        return $this->showOne($follow);
    }
}
