<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Image;
use File;

class ProfileController extends Controller
{
    public function show(){
        if(\Illuminate\Support\Facades\Auth::check())
        {
            return view('profile');
        }
        return view('auth.login');
    }

    public function edit(){
        $id = Auth::user();

        return view('edit_profile',compact('id'));
    }

    public function update(Request $request, User $id){

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');//->move(public_path('images/avatars/'));
            $filename = 'images/avatars/'. time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( $filename );
            $filename = 'images/avatars/image.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save( $filename )->pixelate(300);
            //$avatar->pixelate(12);
            $id->avatar = $filename;
            $id->update();
            //$id->avatar = $request->file('avatar')->store('avatars');

            //$id->save();
        }

        else{
            $id->name = $request->name;
            $id->email = $request->email;
            $id->city = $request->city;
            $id->country = $request->country;
            $id->update();
        }


        return redirect('/profile');//return to the profile page page
    }

    public function delete(){
        $user = Auth::user();

        Auth::logout();

        if($user->delete()){
            return redirect('/home')->with('global', 'Your account has bee deleted');
        }
    }
}
