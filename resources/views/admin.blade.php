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
                background:darkgrey;
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

            {{-- styleEND --}}
        <div>
            <a href="" style="text-decoration: underline gold;color:black;font-size:20px;">
                <b><i>{{'Support '.\Auth::user()->name}}</i></b></a>
        </div>
        
        {{-- CHAT ::::::::::::::::::::::::: --}}
        <div class="chatDiv">
            <div style="height: 7px;"></div>
            <div class="chatOutput" >
                {{-- OUT PUT --}}
                <a style="color: yellow;margin:5px;">Select One Of Them !!</a>
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
                <form action="#" method="POST">
                        @csrf
                    <input class="chatTextInput"  type="text" disabled/>
                    <button class="sendButton" ><b>Send</b></button>
                </form>
            </div>    
        </div>
        
        {{-- CHAT ::::::::::::::::::::::::: --}}
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="registerbtn">Logout</button>
            </form>
        </div>

</body>
</html>