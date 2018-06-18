<div class="columns episode-show">
	<div class="column is-9">
		<?php if(is_string($episode)) : ?>
			<div class="card">
			  <div class="card-content">
			    <div class="content">
					<?php echo $episode; ?>
			    </div>
			  </div>
			</div>
		<?php else : ?>
			<div class="card" data-episode-id="<?php echo $episode->id; ?>">
			  <header class="card-header">
			    <p class="card-header-title">
			      <?php echo $episode->ename; ?>
			    </p>
			  </header>
			  <div class="card-content">
			    <div class="content">
					<?php echo embedYoutube($episode->econtent); ?>
			    </div>
			  </div>
			  	<dialog id="dialog">
			  		<div class="modal-content">
			  		</div>
				</dialog>
			  <footer class="card-footer">
			    <a href="#" class="card-footer-item">Đánh gía</a>
			    <a href="#" class="card-footer-item">Xem sau</a>
			    <a href="#" data-object="report" class="report card-footer-item">Báo lỗi</a>
			  </footer>
			</div>
			<div class="card">
				<?php $actors = explode(',', $film->actor); 
					foreach ($actors as $actor) :
						$actor = explode('|', $actor);
				?>
				  <div class="card-content">
						<p><?php echo $actor[0]; ?></p> - <p><?php echo $actor[1]; ?></p>
				  </div>
				<?php endforeach; ?>
			</div>
		<?php if($film->type == 'series') : ?>
		<div class="card">
		  <header class="card-header">
		    <p class="card-header-title">
		      Chọn Tập Phim
		    </p>
		  </header>
		  <div class="card-content">
				<nav class="pagination" role="navigation" aria-label="pagination">
				  <ul class="pagination-list">
				  	<?php $highLight = '';?>
				  	<?php $i=1;
				  	for($i; $i<=$film->total;$i++) : 
				  		if($i == $episode->id)
				  			$highLight = 'is-current';
				  		?>
					  	<li>
					      <a href="<?php echo route('episode', 'phim?id='. $film->id .'&tap=' .$i); ?>" class="pagination-link <?php echo $highLight; ?>"><?php echo $i; ?></a>
					    </li>
				  	<?php unset($highLight); endfor; ?>
				  </ul>
				</nav>
		  </div>
		</div>
		<?php endif; ?>
		<div class="card">
		  <header class="card-header">
		    <p class="card-header-title">
		      Bình luận
		    </p>
		  </header>
		  <div class="card-content">

		  </div>
		</div>
		<?php endif; ?>
		<div class="recomment-film">
			<h1 class="title-list">Có thể bạn muốn xem</h1>
			<div class="columns is-multiline">
				<?php foreach ($filmrandoms as $film) : ?>
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
	</div>
	<?php include 'views/home/side-right.php'; ?>
</div>
