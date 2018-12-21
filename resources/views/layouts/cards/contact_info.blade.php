<div class="card">
	<div class="card-content">
		<div class="media">

			<div class="media-content">
				<p class="title is-5">{{ $contact->fname }} {{ $contact->lname }}</p>
				<p class="subtitle is-6">{{ $contact->title }}</p>
			</div>
		</div>
		
		<div class="content">
			<div class="columns">
			
				<div class="column">
					@if ($contact->work_phone)
					<span class="tag">work</span>
					<a href="tel:{{ $contact->work_phone }}">{{ $contact->work_phone }}</a>	
					@endif
					<br>
					@if ($contact->mobile_phone)
					<span class="tag">mobile</span>
					<a href="tel:{{ $contact->mobile_phone }}">{{ $contact->mobile_phone }}</a>	
					@endif
				</div>
				
				<div class="column">
					@if ($contact->email_1)
					<a class="is-6" href="mailto:{{ $contact->email_1 }}">{{ $contact->email_1 }}</a>	
					@endif
					<br>
					@if ($contact->email_2)
					<a href="mailto:{{ $contact->email_2 }}">{{ $contact->email_2 }}</a>	
					@endif
				</div>

			</div> <!-- columns -->
		</div> <!-- content -->

	</div> <!-- card content -->
</div> <!-- card -->