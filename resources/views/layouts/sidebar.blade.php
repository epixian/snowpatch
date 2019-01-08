<aside class="menu">

	<p class="menu-label">Modules</p>
	<ul class="menu-list">
		<li><a href="/organizations" @if($module_name == 'organizations') class="is-active" @endif >Organizations</a></li>
		<li><a href="#" @if($module_name == 'contacts') class="is-active" @endif >Contacts</a></li>
		<li><a href="/jobsites" @if($module_name == 'jobsites') class="is-active" @endif ">Jobsites</a></li>
	</ul>
	
	<p class="menu-label">Admin</p>
	<ul class="menu-list">
		<li><a href="#" @if($module_name == 'users') class="is-active" @endif >Users</a></li>
		<li><a href="#" @if($module_name == 'groups') class="is-active" @endif >Groups</a></li>
		<li><a href="#" @if($module_name == 'account') class="is-active" @endif >Account</a></li>
	</ul>
	
	<hr class="menu-label">
	<ul class="menu-list">
		<li><a href="#">Log out</a></li>
	</ul>

</aside>