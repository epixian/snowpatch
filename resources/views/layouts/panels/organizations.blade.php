<div class="content">
	<table class="table is-striped is-hoverable is-narrow">
		<thead>
			<tr>
				<td><label class="checkbox"><input type="checkbox"></label></td>
				<td>Name</td>
				<td>Location</td>
				<td>Type</td>
			</tr>
		</thead>
		<tbody>
		
			@foreach ($organizations as $organization)
			<tr>
				<td><label class="checkbox" name="organization-{{ $organization->id }}"><input type="checkbox"></label></td>
				<td><a href="/organizations/{{ $organization->id }}">{{ $organization->name }}</a></td>
				<td>{{ $organization->city }}, {{ $organization->state }}</td>
				<td><span class="tag">Type</span></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>