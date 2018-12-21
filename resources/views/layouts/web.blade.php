<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
	<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
	<style>
		.panel-heading, .panel-tabs {
			margin-bottom:0 !important;
		}
	</style>
</head>
<body>

	@include('layouts.header')
	
	@include('layouts.nav')
	
	<!-- end top navigation -->




	<section class="section">
		<div class="container">
			<nav class="level">
				<div class="level-left">
					<div class="level-item">
						<p class="subtitle is-5"><a href="/">Home</a></p>
					</div>
					<div class="level-item">
						<div class="field has-addons">
							<p class="control">
								<input class="input" type="text" placeholder="Search @yield('module_name')">
							</p>
							<p class="control">
								<button class="button">Search</button>
							</p>
						</div>
					</div>
				</div> <!-- level-left -->

				<div class="level-right">
					<p class="level-item"><a href="/organizations"><strong>All</strong></a></p>
					<p class="level-item">Clients</p>
					<p class="level-item">Vendors</p>
					<p class="level-item">Leads</p>
					<p class="level-item"><a class="button is-success" href="/organizations/create">New</a></p>
				</div> <!-- level-right -->
			</nav>

		@yield('content')

		</div> <!-- container -->
	</section>
</body>
</html>

