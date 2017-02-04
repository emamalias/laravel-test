<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Laravel Test</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	@yield('on-page-styles')
</head>
<body>
	<div class="container">
		@yield('content')
	</div>

	
	@yield('on-page-scripts')
</body>
</html>