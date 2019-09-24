<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supportchat;
use Auth;
use Input;

class pageController extends Controller
{
	public function welcome()
	{
		return view('welcome');
	}
    public function welcomePage()
    {
        if (Auth::user()) {
            $chat = Supportchat::all();
            return view('support',compact('chat'));
        }else{
            return Redirect::to('/Login');
        }
    }
    public function loginPage(Request $request)
    {
    	return view('login');
    }
    public function registration()
    {
       return view('register');
    }
    public function supportChat(Request $request)
    {
    	$this->validate($request,[
    		'inputChatText' => 'required',
    		'userId'        => 'required'
    	]);

    	$chat = new App\Supportchat;

    	$chat->content = $request->input('inputChatText');
    	$chat->userId  = $request->input('userId');

    	$chat->save();

    	return back();
    }
}
