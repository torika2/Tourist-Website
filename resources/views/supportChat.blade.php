<!DOCTYPE html>
<html>
<head>
	<title>Support</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <meta charset="utf-8">
     <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
                width: 76.4%;
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
@foreach ($chatWith as $chatWiths)
	<div class="chatDiv">
            <div style="height: 7px;"></div>
            <div class="chatOutput" >
            @foreach ($chat as $chats)
                @if (\Auth::user()->id == $chats->userId && $chatWiths->id == $chats->oponentId)
                    <div id="{{ $chats->id }}" style="border-radius: 5px;background:none;border:solid 0.5px white;">{{\Auth::user()->name.':'.$chats->content}}
                    <button id="btn-submit" style="color:red;" onclick="deleteData({{$chats->id}})" >X</button>
                </div>                         
                @endif 
                @if ($chats->userId == $chatWiths->id && \Auth::user()->id == $chats->oponentId)
                    <div id="outPut" style="border-radius: 5px;background:blue;color:white;text-align: right;">{{$chatWiths->name.' : '.$chats->content}}</div>
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
                <form id="chatForm" action="{{route('supportisation')}}" method="POST">
                        @csrf
                    <input id="content" class="chatTextInput" type="text"placeholder="{{'Send Message To -'.$chatWiths->name}}" name="inputChatText" />
                    <input type="hidden" name="oponentId" value="{{$chatWiths->id}}">
                    <button id="chatAccept" class="sendButton" name="chatSendButton"><b>Send</b></button>
                    <input id="seen" name="seen" type="hidden" value="1"/>
                </form>
            </div>    
        </div>
        @endforeach
<script type="text/javascript">
function loadDoc() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
     var xhttp = new XMLHttpRequest();
       $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{ route('supportisation') }}", 
            data: {_token:"{{csrf_token()}}"}
        }).done(function(){
                console.log('Ajax was Successful!');
        }).fail(function(){
            console.log('Ajax Failed')
        });
  // xhttp.open("POST", "", true);
  // xhttp.send();
}

    function deleteData(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        if (confirm("Are you sure ?")) {
            $.ajax({
                type: "POST", 
                dataType : 'json',
                url: "{{ route('deleteComm') }}", 
                data: {"msgId":id},
            }).done( function(data){
                    $("#"+id).toggle();
            }).fail(function(){
                console.log('Ajax Failed')
            });
        }
    }
</script>
        {{-- LOGOUT :::::::::::::: --}}
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="registerbtn">Logout</button>
            </form>
        </div>
<script type="text/javascript" src="{{ asset('js/ajax.min.js') }}"></script>

</body>
</html>