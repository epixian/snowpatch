<form method="POST" action="/organizations/{{ $organization->id }}/contact">
	<div id="new-contact" class="modal">
		<div class="modal-background"></div>
		<div class="modal-card">
			<header class="modal-card-head">
				<div class="modal-card-title">
					<h2 class="title is-4">New Contact</h2>
					<h3 class="subtitle is-6">{{ $organization->name }}</h3>
				</div>
				<button class="delete" aria-label="close" onclick="document.getElementById('new-contact').style.display='none';"></button>
			</header>
			<section class="modal-card-body">
				@csrf
				<div class="field">
					<label class="label" for="fname">First Name</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('fname') ? 'is-danger' : '' }}" name="fname" placeholder="First Name" value="{{ old('fname') }}" required>
					</div>
				</div>
				<div class="field">
					<label class="label" for="lname">Last Name</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('lname') ? 'is-danger' : '' }}" name="lname" placeholder="Last Name" value="{{ old('lname') }}" required>
					</div>
				</div>
				<div class="field">
					<label class="label" for="title">Title</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title" placeholder="Title" value="{{ old('title') }}" required>
					</div>
				</div>
				<div class="field">
					<label class="label"" for="work_phone">Work Phone</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('work_phone') ? 'is-danger' : '' }}" name="work_phone" placeholder="Work Phone" value="{{ old('work_phone') }}">
					</div>
				</div>
				<div class="field">
					<label class="label"" for="mobile_phone">Mobile Phone</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('mobile_phone') ? 'is-danger' : '' }}" name="mobile_phone" placeholder="Work Phone" value="{{ old('mobile_phone') }}">
					</div>
				</div>
				<div class="field">
					<label class="label" for="email_1">Email 1</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('email_1') ? 'is-danger' : '' }}" name="email_1" placeholder="Email 1" value="{{ old('email_1') }}">
					</div>
				</div>
				<div class="field">
					<label class="label" for="email_2">Email 2</label>
					<div class="control">
						<input type="text" class="input {{ $errors->has('email_2') ? 'is-danger' : '' }}" name="email_2" placeholder="Email 2" value="{{ old('email_2') }}">
					</div>
				</div>
				<div class="field">
					<label class="checkbox" for="setPrimaryContact">
						<input type="checkbox" name="setPrimaryContact">
						Set as primary?
					</label>
				</div>
			</section>
		    <footer class="modal-card-foot">
				<button class="button is-success">Save changes</button>
				<button class="button" onclick="document.getElementById('new-contact').style.display='none';">Cancel</button>
	    	</footer>
		</div>
	</div>
</form>	