<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Support</title>
       {{--  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
    </head>
    <body>
        {{-- style --}}
<style type="text/css">
            .chatDiv{
                width: 500px;
                height: 500px;
                border-radius: 2px;
                background:grey;
                margin:auto;
            }
            .chatOutput{
                width: 95%;
                height: 85%;
                background:white;
                border-radius: 1px;
                margin:auto;
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
</style>
            {{-- styleEND --}}
        <div>
            <a href="" style="text-decoration: underline gold;color:black;font-size:20px;">
                <b><i>{{\Auth::user()->name}}</i></b></a>
        </div>
        <div class="chatDiv">
            <div style="height: 7px;"></div>
            <div class="chatOutput">
                @foreach ($chat as $chats)
                @if (\Auth::user()->id == $chats->userId)
                    @if (\Auth::user()->id == $chats->userId)
                        <div style="background-color: darkblue;color:white;">
                            <p style="margin-top:0%;">{{$chats->content}}</p>
                            <div style="float:right;margin-top:-6.05%;margin-right:1%;border-radius: 5px;width: 5px;height: 5px;background:white;"></div>
                        </div>
                    @else
                        <div style="background-color:darkred;color:white;">
                            <p style="margin-top:0%;margin-left: 75%;">{{$chats->content}}</p>
                            <div style="float:left;margin-top:-6.05%;margin-left:1%;;border-radius: 5px;width: 5px;height: 5px;background:none;border:solid 0.5px white;"></div>
                        </div>
                    @endif
                @endif
                @endforeach



            </div>
            <div class="chatInput">
                <form action="{{ route('supp') }}" method="POST">
                        @csrf
                    <input class="chatTextInput" type="text" name="inputChatText">
                    <input type="hidden" name="userId" value="{{\Auth::user()->id}}">
                    <button class="sendButton"><b>Send</b></button>
                </form>
            </div>    
        </div>
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="registerbtn">Logout</button>
            </form>
        </div>
    </body>
</html>
