@extends('lay')

@section('main')

@foreach ($chatWith as $chatWiths)
    <div class="chatDiv">
            <div style="height: 7px;"></div>
            <div class="chatOutput" >
            @foreach ($chat as $chats)
                @if (\Auth::user()->id == $chats->userId && $chatWiths->id == $chats->oponentId)
                    <div id="{{$chats->id}}" style="border:none;background:none;">{{\Auth::user()->name.':'.$chats->content}}
                    <button id="btn-submit" class="deleteButton" onclick="deleteData({{$chats->id}})" >X</button>
                    @if ($chats->seen == 1)
                        <p id="outPutP" style="font-size: 10px;float: right;">Seen...</p>
                    @endif  
                </div>                         
                @endif 
                @if ($chats->userId == $chatWiths->id && \Auth::user()->id == $chats->oponentId)
                    <div id="output" style="background:grey;color:white;text-align: right;">{{$chatWiths->name.' : '.$chats->content}}</div>
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
                                <li><button class="chooseChatWith">{{$users->name}}
                                    @if ( $chats->oponentId == \Auth::user()->id && $chats->seen == 0)
                                       <b style="color:yellow;">|!|</b>
                                    @endif
                                </button></li>
                            </form>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="chatInput">
                {{-- <form action="{{route('supp')}}" method="POST"> --}}
                    {{-- @csrf  --}}
                        @if ($chats->seen == 0 && $chats->oponentId == \Auth::user()->id)
                            <input id="content" class="chatTextInput" type="text"placeholder="{{'Send Message To -'.$chatWiths->name}}" name="inputChatText" />
                        @else
                            <input id="anotherInp" class="chatTextInput" type="text"placeholder="{{'Send Message To -'.$chatWiths->name}}" name="inputChatText" />
                        @endif
                    <input id="oponentId" name="opId" type="hidden" value="{{$chatWiths->id}}" />
                    <button id="chatAccept" class="sendButton" name="chatSendButton"><b>Send</b></button>
                {{-- </form> --}}
            </div>    
        </div>
        @endforeach
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    // ========
$(document).ready(function(){
    $("#content").click(function(){
            var oponentId = $('#oponentId').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post", 
                dataType : "json",
                url: "{{ route('seenMsg') }}", 
                data: {
                    oponentId: $('').val()
                },
            }).done( function(){ 
                console.log('Ajax Successful');
            }).fail(function(){
                console.log('Ajax Failed');
            });
        });
    });

    // ========
$(document).ready(function(id){
    $("#chatAccept").click(function(id){
            var content = $('#anotherInp').val();
            var myId = $('#myId').val();
            var oponentId = $('#oponentId').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
           $.ajax({
                type: "POST",
                dataType : 'json',
                url: "{{ route('supp') }}", 
                data: {'oponentId':oponentId,'inputChatText':content},
            }).done(function(data){
                    $("output"+data.userId);
            }).fail(function(){
                console.log('Ajax Failed')
            });
        });
    });

    // ========
function deleteData(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        if (confirm("Are you sure ?")) {
            $.ajax({
                type: "delete", 
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
@endsection

