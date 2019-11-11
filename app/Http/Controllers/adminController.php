<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Supportchat;
use Input;
class adminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
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
			$user = User::all();
			$chat = Supportchat::all();
			return view('admin')->with('user',$user)->with('chat',$chat);
	}
	public function chatForSupport(Request $request)
	{
			$this->validate($request, [
				'oponentId' => 'required',
				'inputChatText'=>'required'
			]);

			$users = new Supportchat;
			$users->userId = Auth::user()->id;
			$users->oponentId = $request->input('oponentId');
			$users->content = $request->input('inputChatText');
			$users->save();
			return response()->json($users);
	}
	public function Seen(Request $request)
	{
		$this->validate($request,[
			'opId' => 'required'
		]);
		$myId = \Auth::user()->id;
		$oponentId = $request->input('opId');

		$post = Supportchat::where('oponentId',$myId)->where('userId',$oponentId)->update(['seen' => 1]);

		return response()->json($post);
	}
	public function userChat(Request $request)
	{
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
	}
}
