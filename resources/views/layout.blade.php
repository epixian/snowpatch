<!DOCTYPE html>
<html class="has-navbar-fixed-top">
<head>
	<title>
		Snowpatch CRM - @yield('title')
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
	<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
	<style>
		.panel-heading, .panel-tabs {
			margin-bottom:0 !important;
		}
		#map {
			height: 400px;
		}
	</style>
</head>
<body>

	@include('layouts.header')
	
	@include('layouts.content')

</body>
</html>

