				<div class="box">
					<div class="media">
					  <figure class="media-left">
						<p class="image is-64x64">
						  <img src="https://bulma.io/images/placeholders/128x128.png">
						</p>
					  </figure>
					  <div class="media-content">
						<div class="content">
						  <p>
							<strong>{{ $contact->fname }} {{ $contact->lname }}</strong> <small>{{ $contact->title }}</small>
							<br>
							<div class="columns">
								@if ($contact->work_phone)
								<a href="tel:{{ $contact->work_phone }}">{{ $contact->work_phone }}</a>	
								@endif
							</div>
						  </p>
						</div>
						<nav class="level is-mobile">
						  <div class="level-left">
							<a class="level-item">
							  <span class="icon is-small"><i class="fas fa-reply"></i></span>
							</a>
							<a class="level-item">
							  <span class="icon is-small"><i class="fas fa-retweet"></i></span>
							</a>
							<a class="level-item">
							  <span class="icon is-small"><i class="fas fa-heart"></i></span>
							</a>
						  </div>
						</nav>
					  </div>
					  <div class="media-right">
						<button class="delete"></button>
					  </div>
					</div>
				</div>