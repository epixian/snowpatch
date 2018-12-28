<aside class="menu">

	<p class="menu-label">Modules</p>
	<ul class="menu-list">
		<li><a href="/organizations"{{ isset($organizations) ? ' class=is-active' : '' }}>Organizations</a></li>
		<li><a href="/contacts"{{ isset($contacts) ? ' class=is-active' : '' }}>Contacts</a></li>
		<li><a href="/jobsites"{{ isset($jobsites) ? ' class=is-active' : '' }}>Jobsites</a></li>
	</ul>
	
	<p class="menu-label">Admin</p>
	<ul class="menu-list">
		<li><a href="/users"{{ isset($users) ? ' class=is-active' : '' }}>Users</a></li>
		<li><a href="/groups"{{ isset($groups) ? ' class=is-active' : '' }}>Groups</a></li>
		<li><a href="/account"{{ isset($account) ? ' class=is-active' : '' }}>Account</a></li>
	</ul>
	
	<hr class="menu-label">
	<ul class="menu-list">
		<li><a>Log out</a></li>
	</ul>

</aside>