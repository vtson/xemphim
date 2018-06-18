	<div class="column is-3">
		<h1 class="title-list">Phim đã đánh dấu</h1>
		<div>
			
		</div>
		<div class="white-space">
	
		</div>
		<h1 class="title-list">Xem nhiều trong tuần</h1>
		<div class="is-scrollable">
			<?php 
			$films = mostViewInWeek();
			foreach ($films as $film) : ?>
				<div class="columns">
					<div class="column is-12">
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
				</div>
			<?php endforeach; ?>
		</div>
	</div>