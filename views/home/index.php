<h1 class="title-list">Gợi Ý</h1>
<div class='carousel is-5 carousel-animated carousel-animate-slide'>
  <div class='carousel-container'>
  	<?php foreach ($frandoms as $film) : ?>
	  	<div class='carousel-item is-active'>
	      <figure class="image is-256x256"><img src="<?php echo asset($film->thumbnail); ?>">
	      	<div class="title"><?php echo $film->fname; ?></div>
	      </figure>
	    </div>
  	<?php endforeach; ?>
  </div>
  <div class="carousel-navigation is-overlay">
    <div class="carousel-nav-left">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </div>
    <div class="carousel-nav-right">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </div>
  </div>
</div>
<div class="columns">
	<div class="column is-9">
		<h1 class="title-list"><a>Phim Lẻ &gt;</a></h1>
		<div class="columns is-multiline">
			<?php foreach ($fmovies as $movie) : ?>
				<div class="column is-3">
					<div class="card">
					  	<div class="card-image">
						    <figure class="image is-2by3">
						      <img src="<?php echo asset($movie->thumbnail); ?>" title="<?php echo $movie->fname; ?>">
						    </figure>
					  	</div>
					  	<div class="card-content">
						    <div class="content">
						      <a href="<?php echo route('episode', 'phim?id=' . $movie->id); ?>"><span class="title-image"><?php echo $movie->fname; ?></span></a>
						    </div>
					  	</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="white-space">
	
		</div>
		<h1 class="title-list"><a>Phim Bộ &gt;</a></h1>
		<div class="columns is-multiline">
			<?php foreach ($fseries as $series) : ?>
				<div class="column is-3">
					<div class="card">
					  	<div class="card-image">
						    <figure class="image is-2by3">
						      <img src="<?php echo asset($series->thumbnail); ?>" title="<?php echo $series->fname; ?>">
						    </figure>
					  	</div>
					  	<div class="card-content">
						    <div class="content">
						      <a href="<?php echo route('episode', 'phim?id=' . $series->id); ?>"><span class="title-image"><?php echo $series->fname; ?></span></a>
						    </div>
					  	</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="white-space">
	
		</div>
		<h1 class="title-list"><a>Phim Hoạt Hình &gt;</a></h1>
		<div class="columns is-multiline">
			<?php foreach ($fcartoons as $cartoon) : ?>
				<div class="column is-3">
					<div class="card">
					  	<div class="card-image">
						    <figure class="image is-2by3">
						      <img src="<?php echo asset($cartoon->thumbnail); ?>" title="<?php echo $cartoon->fname; ?>">
						    </figure>
					  	</div>
					  	<div class="card-content">
						    <div class="content">
						      <a href="<?php echo route('episode', 'phim?id=' . $cartoon->id); ?>"><span class="title-image"><?php echo $cartoon->fname; ?></span></a>
						    </div>
					  	</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="white-space">
	
	</div>
	<?php include "side-right.php"; ?>
</div>