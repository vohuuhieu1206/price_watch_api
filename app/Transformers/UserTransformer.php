<?php

namespace App\Transformers;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier' => (int)$user->id,
            'nameUser' => (string)$user->name,
            'emailUser' => (string)$user->email,
            'isVerified' => (int)$user->verified,
            'verification_token' =>(string)$user->verification_token,
            'creationDate' => (string)$user->created_at,
            'lastChange' => (string)$user->update_at,
            'deleteDate' => isset($user->delele_at) ? (string) $user->deleted_at : null,
            'links' => 
            [
                'rel' => 'self',
                'href' => route('users.show', $user->id),
            ],
        ];
    }
    public static function originalAttribute($index){
        $attributes = [
            //
            'identifier' => 'id',
            'nameUser' => 'name',
            'emailUser' => 'email',
            'password' => 'password',
            'password_confirmation' => 'password_confirmation',
            'isVerified' =>'verified',
            'verification_token' => 'verification_token',
            'auth_token' => 'auth_token',
            'creationDate' => 'created_at',
            'lastChange' => 'update_at',
            'deleteDate' => 'delele_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    public static function transformedlAttribute($index){
        $attributes = [
            //
            'id' => 'identifier',
            'name' => 'nameUser',
            'email' => 'emailUser',
            'password' => 'password',
            'password_confirmation' => 'password_confirmation',
            'verified' =>'isVerified',
            'verification_token' => 'verification_token',
            'auth_token' => 'auth_token',
            'created_at' => 'creationDate',
            'update_at' => 'lastChange',
            'delele_at' => 'deleteDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    } 
}
