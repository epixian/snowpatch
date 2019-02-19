<div id="new-contact" class="modal">
	<div class="modal-background"></div>
	<div class="modal-card">
	    <header class="modal-card-head">
			<h2 class="modal-card-title title is-4">New Contact</h2>
			<h3 class="subtitle is-6"
			<button class="delete" aria-label="close" onclick="document.getElementById('new-contact').style.display='none';"></button>
	    </header>
	    <section class="modal-card-body">

	    	@include('layouts.forms.contact')

	    </section>
	    <footer class="modal-card-foot">
			<button class="button is-success">Save changes</button>
			<button class="button" onclick="document.getElementById('new-contact').style.display='none';">Cancel</button>
	    </footer>
	</div>
</div>