<!DOCTYPE html>
<html>
<head>
	<title>Support</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/supportChat.css">
     <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<style type="text/css">
  body{
    background: #2f3136;
  }
</style>
<body>
	<div>
  		<a href="/adminSupport" style="text-decoration: underline gold;color:white;font-size:20px;">
        <b><i>{{'Support '.\Auth::user()->name}}</i></b></a>
  </div>
<div class="chatDiv">
  <div style="height: 2%;"></div>
  <div class="chatOutput" >
    @yield('main')  
  </div>    
</div>
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="registerbtn">Logout</button>
            </form>
        </div>    
<script type="text/javascript" src="{{ asset('js/ajax.min.js') }}"></script>
</body>
</html>

