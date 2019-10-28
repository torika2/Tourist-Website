<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Supportchat;
use Input;
class adminController extends Controller
{
	public function dltComm(Request $request)
	{
		
		$this->validate($request,[
			'msgId' => 'required'
		]);
		$msgId = $request->input('msgId');
		
		$a = Supportchat::where('id',$msgId)->delete();
		
		return response()->json($a);
	}
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
		// es middlewareti gaaketexolme shemdegshi

		if (Auth::user()->admin == 1) {
			if (!empty(request('userId'))) {
				$this->validate($request,[
					'userId' => 'required'
				]);

				$uId = $request->input('userId');
					$chatWith = User::where('id',$uId)->get();
				$user = User::all();
				$chat = Supportchat::all();
				return view('supportChat',compact('chatWith'))->with('user',$user)->with('chat',$chat);
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
