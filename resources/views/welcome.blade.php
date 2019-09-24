<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
</head>
<body>
@if (!\Auth::check())
    <div>
        <a href="./Login">Login Page</a>
    </div>
    <div>
    	<a href="./Registration">Registration Page</a>
    </div>
@else
	<div>
		<a href="./Support" style="color:darkgreen;">Support Page</a>
	</div>
	<form id="logout-form" action="{{ route('logout') }}" method="POST">
		@csrf
    </form>
@endif
</body>
</html>
