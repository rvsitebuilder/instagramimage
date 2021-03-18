@extends('rvsitebuilder/instagramimage::layouts.layout')

@section('content')
<header>
	<div class="ig-container">

		<div class="ig-profile">

			<div class="ig-profile-image">

				<img src="{{ $ig_info->data->profile_picture }}" alt="">

			</div>

			<div class="ig-profile-user-settings">

				<h1 class="ig-profile-user-name">{{ $ig_info->data->username }}</h1>

				<button class="ig-btn ig-profile-edit-btn">Edit Profile</button>

				<button class="ig-btn ig-profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

			</div>

			<div class="ig-profile-stats">

				<ul>
					<li><span class="ig-profile-stat-count">{{ $ig_info->data->counts->media }}</span> posts</li>
					<li><span class="ig-profile-stat-count">{{ $ig_info->data->counts->follows }}</span> followers</li>
					<li><span class="ig-profile-stat-count">{{ $ig_info->data->counts->followed_by }}</span> following</li>
				</ul>

			</div>

			<div class="ig-profile-bio">

				<p><span class="ig-profile-real-name">{{ $ig_info->data->full_name }}</span> {{ $ig_info->data->bio }}</p>

			</div>

		</div>
		<!-- End of profile section -->

	</div>
	<!-- End of container -->
</header>
<main>
	<div class="ig-container">

		<div class="ig-gallery">
      @foreach ($ig_img->data as $post)
        <div class="ig-gallery-item" tabindex="0">

  				<img sizes="293px" src="{{ $post->images->thumbnail->url }}" class="ig-gallery-image" alt="">

  				<div class="ig-gallery-item-info">

  					<ul>
  						<li class="ig-gallery-item-likes"><span class="ig-visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> {{ $post->likes->count }}</li>
  						<li class="ig-gallery-item-comments"><span class="ig-visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> {{ $post->comments->count }}</li>
  					</ul>

  				</div>

  			</div>
      @endforeach

		<!-- End of gallery -->

		<div class="loader"></div>

	</div>
	<!-- End of container -->
</main>
@stop
