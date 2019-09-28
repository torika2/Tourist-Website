<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Supportchat;
use Input;
class adminController extends Controller
{
	public function supportChat()
	{
		if (Auth::user()->admin == 1) {
			$user = User::all();
			$chat = Supportchat::all();
			return view('admin')->with('user',$user)->with('chat',$chat);
		}else{
			return back();
			exit();
		}
	}
	public function chatForSupport(Request $request)
	{
		if (Auth::user()) {
			$this->validate($request, [
				'oponentId' => 'required',
				'inputChatText'=>'required'
			]);

			$users = new Supportchat;
			$users->userId = Auth::user()->id;
			$users->oponentId = $request->input('oponentId');
			$users->content = $request->input('inputChatText');
			$users->save();

			return \Redirect::to('/adminSupport');
		}else{
			return back();
			exit();
		}
	}
	public function userChat(Request $request)
	{
		if (Auth::user()->admin == 1) {
			if (!empty(request('userId'))) {
				$this->validate($request,[
					'userId' => 'required',
				]);

				$uId = $request->input('userId');
					$chatTable = User::where('id',$uId)->get();

				$user = User::all();
				$chat = Supportchat::all();
				return view('supportChat',compact('chatTable'))->with('user',$user)->with('chat',$chat);
			}else{
				return back();
				exit();
			}
		}else{
			return back();
			exit();
		}
	}
}
