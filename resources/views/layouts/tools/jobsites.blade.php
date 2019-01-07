<div class="level">

	<div class="level-left">
		
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
					<a name="type-commercial" class="dropdown-item">Commercial</a>
					<a name="type-residential" class="dropdown-item">Residential</a>
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
					<a name="status-active" class="dropdown-item">Active</a>
					<a name="status-inactive" class="dropdown-item">Inactive</a>
					<a name="status-pending" class="dropdown-item">Pending</a>
				</div>
			</div>
		</div> <!-- dropdown menu status -->
	</div>
	
	<div class="level-right">
		{!! $jobsites->appends(\Request::except('page'))->links('vendor.pagination.bulma') !!}
	</div>
	
</div> <!-- level -->