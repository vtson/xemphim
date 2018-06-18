<?php include 'filterform.php'; ?>
<div class="columns">
	<div class="column is-9">
		<h1 class="title-list"><?php echo $notification; ?></h1>
		<div class="columns is-multiline">
			<?php foreach ($films as $film) : ?>
				<div class="column is-3">
					<div class="card">
					  	<div class="card-image">
						    <figure class="image is-2by3">
						      <img src="<?php echo asset($film->thumbnail); ?>" title="<?php echo $film->fname; ?>">
						    </figure>
					  	</div>
					  	<div class="card-content">
						    <div class="content">
						      <a href="<?php echo route('episode', 'phim?id=' . $film->id); ?>"><span class="title-image"><?php echo $film->fname; ?></span></a>
						    </div>
					  	</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php include 'views/home/side-right.php'; ?>
</div>
