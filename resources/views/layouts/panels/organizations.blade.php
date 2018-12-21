<div class="level">

	<div class="level-left">
	
		<div class="control has-icons-left level-item">
			<input class="input is-small" type="text" placeholder="Search organizations">
			<span class="icon is-small is-left"><i class="fas fa-search" aria-hidden="true"></i></span>
		</div>
		
	</div> <!-- level-left -->

	<div class="level-right">
	
		<div class="level-item dropdown is-right is-hoverable">
			<div class="dropdown-trigger">
				<button class="button" aria-haspopup="true" aria-controls="dropdown-menu-type">
					<span>Type</span>
					<span class="icon is-small">
						<i class="fas fa-angle-down" aria-hidden="true"></i>
					</span>
				</button>
			</div>
			<div class="dropdown-menu" id="dropdown-menu-type" role="menu">
				<div class="dropdown-content">
					<a href="#" class="dropdown-item">All</a>
					<a href="#" class="dropdown-item">Leads</a>
					<a href="#" class="dropdown-item">Clients</a>
					<a href="#" class="dropdown-item">Vendors</a>
					<a href="#" class="dropdown-item">Subcontractors</a>
					<a href="#" class="dropdown-item">Other</a>
				</div>
			</div>
		</div> <!-- dropdown menu type -->

		<div class="level-item dropdown is-right is-hoverable">
			<div class="dropdown-trigger">
				<button class="button" aria-haspopup="true" aria-controls="dropdown-menu-status">
					<span>Status</span>
					<span class="icon is-small">
						<i class="fas fa-angle-down" aria-hidden="true"></i>
					</span>
				</button>
			</div>
			<div class="dropdown-menu" id="dropdown-menu-status" role="menu">
				<div class="dropdown-content">
					<a href="#" class="dropdown-item">All</a>
					<a href="#" class="dropdown-item">Current</a>
					<a href="#" class="dropdown-item">Archived</a>
				</div>
			</div>
		</div> <!-- dropdown menu status -->
		
	</div> <!-- level-right -->
	
</div> <!-- level -->

<table class="table">
	<thead>
		<tr>
			<td>Name</td>
			<td>Location</td>
			<td>Type</td>
		</tr>
	</thead>
	<tbody>
	
		@foreach ($organizations as $organization)
		<tr>
			<td><a href="/organizations/{{ $organization->id }}">{{ $organization->name }}</a></td>
			<td>{{ $organization->city }}, {{ $organization->state }}</td>
			<td><span class="tag">Type</span></td>
		</tr>
		@endforeach
	</tbody>
</table>