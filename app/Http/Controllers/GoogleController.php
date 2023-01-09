<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\User;
use App\Customer;
use App\SocialUser;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $social = SocialUser::where('social_id', $user->id)->where('provider', 'google')->first();

        if($social){
            $u = User::where('email', $user->email)->first();
            Auth::login($u);
            return redirect()->route('home');
        }
        else{
            $u = User::where('email', $user->email)->first();
            if(!$u){
                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $user->id
                ];
                $u = User::create($data);

                $customer = [
                    'fullname' => $user->name,
                    'email' => $user->email,
                    'user_id' => $u->id
                ];

                Customer::create($customer);
            }

            $temp = new SocialUser;
            $temp->social_id = $user->id;
            $temp->provider = 'google';
            $temp->user_id = $u->id;
            $temp->save();

            Auth::login($u);
            return redirect()->route('home');
        }
    }
}
