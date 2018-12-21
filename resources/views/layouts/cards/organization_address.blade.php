			<div class="card">
				<div class="card-content">
					<p>{{ $organization->address_line_1 }}</p>
					@if ($organization->address_line_2)
					<p>{{ $organization->address_line_2 }}</p>
					@endif
					<p>{{ $organization->city }}, {{ $organization->state}} {{ $organization->postal_code}}</p>
					<p>{{ $organization->country }}</p>
				</div>
				<footer class="card-footer">
					<p class="card-footer-item">
						<span>
							<a href="/organizations/{{ $organization->id }}/edit">Edit</a>
						</span<
					</p>
				</footer>
			</div> <!-- address card -->