<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Mail\UserCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Transformers\UserTransformer;
use App\Http\Controllers\ApiController;


class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('transform.input:'.UserTransformer::class)->only(['update','store']);
        // $this->middleware('client.credentials')->only(['store','resend']);        
        // $this->middleware('auth:api')->except(['store','verified','resend']);
        
        // $this->middleware('scope:manage-account')->only(['show'],['update']);
        // $this->middleware('can:view,user')->only(['show']);
        // $this->middleware('can:update,user')->only(['update']);
        // $this->middleware('can:delete,user')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $this->allowedAdminAction();
        
        $users = User::all();

        return $this->showAll($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $rules = [
            'email' => 'email|unique:users,email,'. $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ];

        $this->validate($request, $rules);

        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('email') && $user->email != $request->email){
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        // if($request->has('admin')){
        //     $this->allowedAdminAction();
        
        //     if(!$user->isVerified())
        //     {
        //         return $this->errorResponse('Only verified users can modify the admin field',409);
        //     }
        //     $user->admin = $request->admin;
        // }

        if($user->isClean()){
            return $this->errorResponse('You need to specify a different value to update',422);
        }
        $user->save();
        return $this->showOne($user);
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);

        return $this->showOne($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return $this->showOne($user);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        
        return $this->showOne($user);
    }
    public function verified($token)
    {
        $user= User::where('verification_token',$token)->firstOrFail();

        $user->verified = User::VERIFIED_USER;

        $user->verification_token = null;

        $user->save();

        return $this->showMessage('The account has been verified successly');
    }
    public function resendMail(User $user)
    {
        if($user->isVerified())
        {
            $this->errorResponse("The account is already verified",409);
        }
       retry(5, function () use ($user){
                Mail::to($user)->send(new UserCreated($user));
            },100);

        return $this->showMessage('The verification mail has been resend');
    }
    public function me(Request $request)
    {
        $user = $request->user();
        return $this->showOne($user);
    }
}
