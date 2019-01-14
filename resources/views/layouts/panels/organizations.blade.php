<div class="content">
	<table class="table is-striped is-hoverable is-narrow">
		<thead>
			<tr>
				<td><label class="checkbox"><input type="checkbox"></label></td>
				<td> @sortablelink('name', 'Name') </td>
				<td>Location</td>
				<td>Type</td>
				<td>Contact</td>
			</tr>
		</thead>
		<tbody>
		
			@foreach ($organizations as $organization)
			<tr>
				<td><label class="checkbox" name="organization-{{ $organization->id }}"><input type="checkbox"></label></td>
				<td><a href="/organizations/{{ $organization->id }}">{{ $organization->name }}</a></td>
				<td>{{ $organization->city }}, {{ $organization->state }}</td>
				<td>
					@switch($organization->type)
						@case(1)
							<span class="tag is-light">Lead</span>
							@break
						@case(2)
							<span class="tag is-success">Client</span>
							@break
						@case(3)
							<span class="tag is-info">Vendor</span>
							@break
						@case(4)
							<span class="tag is-warning">Subcontractor</span>
							@break
						@default
							<span class="tag is-black">Unknown</span>
					@endswitch
				</td>
				<td>
					@if ($organization->hasPrimaryContact())
						<a href="/contacts/{{ $organization->primaryContact->id }}">{{ $organization->primaryContact->fname }} {{ $organization->primaryContact->lname }}</a>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>