<div class="card">
	<div class="card-content">
		<div class="columns">
				<p class="column title is-5">{{ $contact->fname }} {{ $contact->lname }}</p>
				<p class="column has-text-right is-6">{{ $contact->title }}</p>
		</div>
		
		<div class="content">
			@if ($contact->work_phone)
			<span class="tag">work</span>
			<a href="tel:{{ $contact->work_phone }}">{{ $contact->work_phone }}</a>	
			@endif
			@if ($contact->work_phone) && ($contact->mobile_phone)
			<br>
			@endif
			@if ($contact->mobile_phone)
			<span class="tag">mobile</span>
			<a href="tel:{{ $contact->mobile_phone }}">{{ $contact->mobile_phone }}</a>	
			@endif
		</div>

		
		<div class="content">
			@if ($contact->email_1)
			<a href="mailto:{{ $contact->email_1 }}">{{ $contact->email_1 }}</a>	
			@endif
			@if ($contact->email_1 && $contact->email_2)
			<br>
			@endif
			@if ($contact->email_2)
			<a href="mailto:{{ $contact->email_2 }}">{{ $contact->email_2 }}</a>	
			@endif
		</div> <!-- content -->

	</div> <!-- card content -->
</div> <!-- card -->