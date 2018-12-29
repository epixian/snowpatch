<aside class="menu">

	<p class="menu-label">Modules</p>
	<ul class="menu-list">
		<li><a href="/organizations" class="{{ isset($organizations) || isset($organization) ? 'is-active' : '' }}">Organizations</a></li>
		<li><a class="{{ isset($contacts) || isset($contact) ? 'is-active' : '' }}">Contacts</a></li>
		<li><a href="/jobsites" class="{{ isset($jobsites) || isset($jobsite) ? 'is-active' : '' }}">Jobsites</a></li>
	</ul>
	
	<p class="menu-label">Admin</p>
	<ul class="menu-list">
		<li><a{{ isset($users) || isset($user) ? ' class=is-active' : '' }}>Users</a></li>
		<li><a{{ isset($groups) || isset($group) ? ' class=is-active' : '' }}>Groups</a></li>
		<li><a{{ isset($account) ? ' class=is-active' : '' }}>Account</a></li>
	</ul>
	
	<hr class="menu-label">
	<ul class="menu-list">
		<li><a>Log out</a></li>
	</ul>

</aside>