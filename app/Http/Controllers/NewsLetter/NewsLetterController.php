<?php

namespace App\Http\Controllers\NewsLetter;

use App\NewsLetter;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\NewsLetterTransformer;

class NewsLetterController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('transform.input:'.NewsLetterTransformer::class)->only(['store']);
    }
    public function index()
    {
        //
        $newsletter = NewsLetter::all();

        return $this->showAll($newsletter);
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
            'guest_name' => 'required',
            'guest_email' => 'required|email|unique:news_letters',
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();
        $newsletter = NewsLetter::create($data);
        if ($newsletter)
        {

            return $this->showOne($newsletter);      
        }
        else
            return $this->errorResponse('NewsLetter fail',422);
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
        $newsletter = NewsLetter::findOrFail($id);
        if($newsletter){
            $newsletter->delete();
            return response()->json(['success' => 'Delete success' , 'code' => 200],200);
        }
        else
        {
            return $this->errorResponse("Delete Fail",404);
        }
    }
}
