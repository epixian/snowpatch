<nav class="navbar is-primary is-fixed-top" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a class="navbar-item" href="/">SNOWPATCH</a>

		<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</a>
	</div>

	<div id="navbar" class="navbar-menu">
		<div class="navbar-start">
			<a class="navbar-item is-active" href="/organizations">Organizations</a>
			<a class="navbar-item">Contacts</a>

<!-- if($user->isAdmin()) -->
			<div class="navbar-item has-dropdown is-hoverable">
				<a class="navbar-link">Admin</a>
				<div class="navbar-dropdown">
					<a class="navbar-item">Users</a>
					<a class="navbar-item">Groups</a>
	<!-- if($user->isSuperAdmin()) -->
					<hr class="navbar-divider">
					<a class="navbar-item">Manage Account</a>
	<!-- endif -->
				</div>
			</div>
<!-- endif -->
			
		</div>

		<div class="navbar-end">
			<div class="navbar-item has-dropdown is-hoverable">
				<a class="navbar-link">User</a>

				<div class="navbar-dropdown">
					<a class="navbar-item">Profile</a>
					<a class="navbar-item">Account</a>
					<hr class="navbar-divider">
					<a class="navbar-item">Log out</a>
				</div>
			</div>
		</div>
	</div>
</nav>	
