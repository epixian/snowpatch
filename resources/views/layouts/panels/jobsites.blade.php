<div class="content">
	<table class="table is-striped is-hoverable is-narrow">
		<thead>
			<tr>
				<td><label class="checkbox"><input type="checkbox"></label></td>
				<td></td>
				<td> @sortablelink('name', 'Name') </td>
				<td> @sortablelink('address', 'Address') </td>
				<td>Status</td>
				<td>Organization</td>
				<td class="has-text-centered">Acres</td>
				<td class="has-text-centered">LF</td>
			</tr>
		</thead>
		<tbody>
		
			@foreach ($jobsites as $jobsite)
			<tr>
				<td><label class="checkbox" name="jobsite-{{ $jobsite->id }}"><input type="checkbox"></label></td>
				<td class="has-text-centered">
					@switch($jobsite->type)
						@case(1)
							<i class="fas fa-home"></i>
							@break
						@case(2)
							<i class="far fa-building"></i>
							@break
						@case(3)
							<i class="fas fa-university"></i>
							@break
						@case(4)
							<i class="far fa-hospital"></i>
							@break
						@case(5)
							<i class="fas fa-place-of-worship"></i>
							@break
						@default
							<i class="far fa-question-circle"></i>
					@endswitch
				</td>
				<td><a href="/jobsites/{{ $jobsite->id }}">{{ $jobsite->name }}</a></td>
				<td>{{ $jobsite->address }}, {{ $jobsite->city }}, {{ $jobsite->state }} {{ $jobsite->postal_code }}</td>
				<td>
					@switch($jobsite->status)
						@case(1)
							<span class="tag is-success">Active</span>
							@break
						@case(2)
							<span class="tag is-dark">Inactive</span>
							@break
						@case(3)
							<span class="tag is-warning">Pending</span>
							@break
						@default
							<i class="far fa-question-circle"></i>
					@endswitch

				</td>
				<td><a href="/organizations/{{ $jobsite->organization->id }}">{{ $jobsite->organization->name }}</a></td>
				<td class="has-text-right">
					@if($jobsite->acreage)
					<span class="tag is-warning">{{ $jobsite->acreage }}</span>
					@endif
				</td>
				<td class="has-text-right">
					@if($jobsite->linear_feet)
					<span class="tag is-info">{{ $jobsite->linear_feet }}</span>
					@endif
				</td>

			</tr>
			@endforeach
		</tbody>
	</table>
</div>