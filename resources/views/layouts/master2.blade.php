<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Ostaz">
		<meta name="Author" content="Momtaz Nussair">
		<meta name="Keywords" content="Ostaz"/>
		@include('layouts.head')
		<title> @yield('title') </title>
	</head>
	
	<body class="main-body bg-secondary-gradient">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<div class="container pt-5">
			@yield('content')
		</div>
		@include('layouts.footer')	
		@include('layouts.footer-scripts')	
	</body>
</html>

