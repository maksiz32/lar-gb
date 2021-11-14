<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Services\Social;

class SocialAuthController extends Controller
{
    public function link()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Social $social)
    {
        return redirect(
            $social->loginUser(
                Socialite::driver('facebook')->user()
            )
        );
    }
}
