<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supportchat;
use Auth;
use Input;

class pageController extends Controller
{
    public function __construct(){

        // $this->middleware('noSession');
        
    }
    public function emptyLogin()
    {
        return \Redirect::to('/Login');
    }
    public function welcome()
    {
        return view('welcome');
    }
    public function welcomePage()
    {
        if (Auth::user()) {
            // $chat = Supportchat::all();
            // return view('support',compact('chat'));
            return \Redirect::to('/adminSupport');
        }else{
            return \Redirect::to('/Login');
        }
    }
    public function loginPage(Request $request)
    {
        return view('Login');
    }
    public function registration()
    {
       return view('register');
    }
    public function supportChat(Request $request)
    {
        if (Auth::user()) {
            $this->validate($request,[
                'inputChatText' => 'required',
                'userId'        => 'required'
            ]);
            $chat = new Supportchat;

            $chat->content = $request->input('inputChatText');
            $chat->userId  = $request->input('userId');
            if (!empty(request('seen'))) {
                $chat->seen = $request->input('seen');
            }
            $chat->save();

            return back();
        }else{
            return back();
        }
    }
}
