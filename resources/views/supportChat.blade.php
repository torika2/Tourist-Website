<!DOCTYPE html>
<html>
<head>
	<title>Support</title>
</head>
<body>
		<style type="text/css">
            .chatDiv{
                width: 500px;
                height: 500px;
                border-radius: 2px;
                background:grey;
                margin:auto;
            }
            .chatOutput{
                width: 76.5%;
                height: 85%;
                background:white;
                border-radius: 1px;
                margin-left: 2.5%;
                margin-top: 5px;
            }
            .chatInput{
                width: 95%;
                margin:auto;
                height: 50px;
                background:darkgrey;
                border-radius:2px;
            }
            .chatTextInput{
                width: 79%;
                margin-left: 4px;
                height:35px;
                margin-top: 5px
            }
            .chatTextInput:hover{
                border:solid 1px orange;

            }
            .sendButton{
                color:white;
                background: orange;
                border:none;
                border-radius: 2px;
                width: 17.5%;
                height: 39px;
            }
            .sendButton:hover{
                opacity: 0.8;
            }
            .registerbtn {
              background-color: darkred;
              color: white;
              height: 50px;
              margin-left:31.4%;
              border: none;
              cursor: pointer;
              width: 37.2%;
              opacity: 0.9;
              border-radius: 2px;
            }

            .registerbtn:hover {
              opacity: 1;
            }
            li{
                list-style: none;
                text-align: center;
            }
</style>
        <div>
            <a href="" style="text-decoration: underline gold;color:black;font-size:20px;">
                <b><i>{{'Support '.\Auth::user()->name}}</i></b></a>
        </div>
@foreach ($chatTable as $chatTables)
	<div class="chatDiv">
            <div style="height: 7px;"></div>
            <div class="chatOutput" >
            @foreach ($chat as $chats)
                @if (\Auth::user()->id == $chats->userId)
                    <div style="margin-left:3%;border-radius: 5px;width: 5px;height: 5px;background:none;border:solid 0.5px white;">{{\Auth::user()->name.':'.$chats->content}}</div> 
                @endif
                @if ($chats->oponentId == $chatTables->id)
                    <div style="float:right;margin-top:6.05%;margin-right:20%;border-radius: 5px;width: 5px;height: 5px;background:white;text-align: center;">Filipe:DSA</div>
                @endif
            @endforeach
            </div>
            <div style="float: right;margin-top: -85%;">
                <ul>
                    @foreach ($user as $users)
	                    @if (Auth::user()->id != $users->id)
		                    <form action="{{ route('userChat') }}" method="POST">
		                        @csrf
		                        <input type="hidden" name="userId" value="{{$users->id}}">
		                        <li><button style="border-radius: 2px;width: 95px;margin-right:6px;height: 30px;background: darkorange;color: white;">{{$users->name}}</button></li>
		                    </form>
	                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="chatInput">
                <form action="{{route('supportisation')}}" method="POST">
                        @csrf
                    <input class="chatTextInput" type="text"placeholder="{{'Send Message To -'.$chatTables->name}}" name="inputChatText" />
                    <input type="hidden" name="oponentId" value="{{$chatTables->id}}">
                    <button class="sendButton" name="chatSendButton"><b>Send</b></button>
                    <input type="hidden" name="seen" value="1" />
                </form>
            </div>    
        </div>
        @endforeach
        {{-- LOGOUT :::::::::::::: --}}
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="registerbtn">Logout</button>
            </form>
        </div>

</body>
</html>