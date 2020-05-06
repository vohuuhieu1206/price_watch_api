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
    public function index()
    {
        //
        $users = User::WhereHas('follows')
                               ->with('follows')
                               ->get();
        foreach($users as $key1 => $user){
            $follows = $user->follows;
            foreach($follows as $key2 => $follow)
            {
                $product = $follow->product()->pluck('product_name')->first();
                $price = $follow->product->prices()->orderBy('created_at','DESC')->pluck('product_price')->values();
                $first_price = $price->get(0);
                $second_price = $price->get(1);    
                if($first_price == $second_price)
                {
                    $follows->forget($key2);              
                }
            }
            if($follows->isEmpty())
            {
                $users->forget($key1);
            }         
        }
        return $this->showAll($users);
    }
}
