<?php

namespace App\Http\Controllers\User;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserFollowProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //
        $products = $user->follows()
                        ->whereHas('product')
                        ->with('product')
                        ->get()
                        ->pluck('product');
        return $this->showAll($products);
    }
}
