<div class="level">

	<div class="level-left">
		
		<div class="level-item">
			<a class="button is-primary" href="/organizations/create">New</a>
		</div>
	
		<div class="control has-icons-left level-item">
			<input class="input" type="text" placeholder="Search organizations">
			<span class="icon is-left"><i class="fas fa-search" aria-hidden="true"></i></span>
		</div>
		
		<div class="level-item dropdown is-hoverable">
			<div class="dropdown-trigger">
				<button class="button" aria-haspopup="true" aria-controls="dropdown-menu-type">
					<span>Type</span>
					<span class="icon">
						<i class="fas fa-angle-down" aria-hidden="true"></i>
					</span>
				</button>
			</div>
			<div class="dropdown-menu" id="dropdown-menu-type" role="menu">
				<div class="dropdown-content">
					<a name="type-all" class="dropdown-item">All</a>
					<a name="type-leads" class="dropdown-item">Leads</a>
					<a name="type-clients" class="dropdown-item">Clients</a>
					<a name="type-vendors" class="dropdown-item">Vendors</a>
					<a name="type-subcontractors" class="dropdown-item">Subcontractors</a>
					<a name="type-other" class="dropdown-item">Other</a>
				</div>
			</div>
		</div> <!-- dropdown menu type -->

		<div class="level-item dropdown is-hoverable">
			<div class="dropdown-trigger">
				<button class="button" aria-haspopup="true" aria-controls="dropdown-menu-status">
					<span>Status</span>
					<span class="icon">
						<i class="fas fa-angle-down" aria-hidden="true"></i>
					</span>
				</button>
			</div>
			<div class="dropdown-menu" id="dropdown-menu-status" role="menu">
				<div class="dropdown-content">
					<a name="status-all" class="dropdown-item">All</a>
					<a name="status-current" class="dropdown-item">Current</a>
					<a name="status-archived" class="dropdown-item">Archived</a>
				</div>
			</div>
		</div> <!-- dropdown menu status -->
	</div>
	
	<div class="level-right">
		{!! $organizations->appends(\Request::except('page'))->links('vendor.pagination.bulma') !!}
	</div>
	
</div> <!-- level -->