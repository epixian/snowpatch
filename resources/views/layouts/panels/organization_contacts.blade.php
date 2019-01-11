<section class="panel">
	<p class="panel-heading">
		Contacts
	</p>
	@if ($organization->contacts->count())
	<table class="table is-striped is-hoverable is-narrow is-bordered">
		<thead>
			<tr>
				<td>Name</td>
				<td>Title</td>
				<td>Phone</td>
				<td>Email</td>
			</tr>
		</thead>
		<tbody>
			@if ($organization->hasPrimaryContact())
			<tr>
				<td>
					<a href="/contacts/{{ $organization->primaryContact->id }}">{{ $organization->primaryContact->fname }} {{ $organization->primaryContact->lname }}</a>
					<span class="tag is-info">Primary</span>
				</td>
				<td>{{ $organization->primaryContact->title }}</td>
				<td>
					@isset($organization->primaryContact->work_phone)
						{{ $organization->primaryContact->work_phone }}
						<span class="tag is-link">work</span>
					@endisset

					@if( isset($organization->primaryContact->work_phone) && 
						isset($organization->primaryContact->mobile_phone) )
						<br>
					@endif
						
					@isset($organization->primaryContact->mobile_phone)
						{{ $organization->primaryContact->mobile_phone }}
						<span class="tag is-info">cell</span>
					@endisset
				</td>
				<td>
					@isset($organization->primaryContact->email_1)
						{{ $organization->primaryContact->email_1 }}
					@endisset

					@if( isset($organization->primaryContact->email_1) && isset($organization->primaryContact->email_2) )
						<br>
					@endif

					@isset($organization->primaryContact->email_2)
						{{ $organization->primaryContact->email_2 }}
					@endisset
				</td>
			</tr>
			@endif

			@foreach ($organization->contacts as $contact)
			@if ($contact->isNotPrimaryContact())
			<tr>
				<td><a href="/contacts/{{ $contact->id }}">{{ $contact->fname }} {{ $contact->lname }}</a></td>
				<td>{{ $contact->title }}</td>
				<td>
					@isset($contact->work_phone)
						{{ $contact->work_phone }}
						<span class="tag is-link">work</span>
					@endisset

					@if( isset($contact->work_phone) && isset($contact->mobile_phone) )
						<br>
					@endif

					@isset($contact->mobile_phone)
						{{ $contact->mobile_phone }}
						<span class="tag is-info">cell</span>
					@endisset
				</td>
				<td>
					@isset($contact->email_1)
						{{ $contact->email_1 }}
					@endisset

					@if( isset($contact->email_1) && isset($contact->email_2) )
						<br>
					@endif

					@isset($contact->email_2)
						{{ $contact->email_2 }}
					@endisset
				</td>
			</tr>
			@endif
			@endforeach
		</tbody>
	</table>
	@endif
	
	<div class="panel-block">
		<a class="button is-success" onclick="document.getElementById('new-contact').style.display='block';">New Contact</a>
	</div>

</section>

@include ('layouts.forms.contact')