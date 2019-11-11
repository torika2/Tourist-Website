@extends('lay')

@section('main')
        <div class="chatDiv">
            <div style="height: 7px;"></div>
            <div class="chatOutput" >
                {{-- OUT PUT --}}
                    <p style="color: yellow;text-align: center"><b><i>Select One Of Them !!</i></b></p>
            </div>
            <div style="float: right;margin-top: -85%;">
                <ul>
                    @foreach ($user as $users)
                            @if (Auth::user()->id != $users->id)
                                <form action="{{ route('userChat') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="userId" value="{{$users->id}}">
                                    <li><button class="chooseChatWith">{{$users->name}}
                                        @foreach ($chat as $chats)
                                            @if ($chats->oponentId == \Auth::user()->id && $chats->seen == 0)
                                               <b style="color:yellow;">| ! |</b>
                                            @endif
                                        @endforeach
                                    </button></li>
                                </form>
                            @endif
                    @endforeach
                </ul>
            </div>
            <div class="chatInput">
                <form action="#" method="POST">
                        @csrf
                    <input class="chatTextInput"  type="text" disabled/>
                    <button class="sendButton" disabled><b>Send</b></button>
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

@endsection