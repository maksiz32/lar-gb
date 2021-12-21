<?php

namespace App\Services;

use Laravel\Socialite\Contracts\User;
use App\Models\User as UserModel;

class Social
{
    public function loginUser(User $user)
    {
        $authUser = UserModel::where('email', $user->getEmail())->first();
        if($authUser) {
            $authUser->name = $authUser->getName();
            $authUser->avatar = $authUser->getAvatar();
            if ($authUser->save()) {
                \Auth::loginUsingId($authUser->id);
                return route('account');
            }
        }

        return route('register');
    }
}
