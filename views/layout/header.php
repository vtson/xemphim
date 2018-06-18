<?php use App\Helper\Auth as Auth; ?>
  	<div class="header container">
  		<div class="top columns is-multiline">
  			<div class="logo column is-9"> 
			    <a href="<?php echo route('home', 'index'); ?>">
			      <img src="http://xem-phims.com/storage/home-logo.jpg" alt="Xem phim" width="112" height="28">&nbsp<span class="name-logo">XEM PHIM</span>
			    </a>
	  		</div>
	  		<?php if (Auth::checkLogin()) : ?>
	  			<div class="user-action column is-3">
	  				<?php if(Auth::user()->role == "admin") : ?>
		  				<a href="<?php echo route('admin', '/');?>"><span>Admin Dashboard</span></a>
		  			<?php endif; ?>
		  			<a href="<?php echo route('users', 'profile');?>"><span><?php echo Auth::user()->username; ?></span></a>
		  			<a href="<?php echo route('users', 'logout');?>"><span><?php echo LANGUAGE['logout']; ?></span></a>
		  		</div>
		  	<?php else : ?>
		  		<div class="user-action column is-2">
		  			<a href="<?php echo route('users', 'create');?>"><span><?php echo LANGUAGE['signup']; ?></span></a>
		  			<a href="<?php echo route('users', 'login');?>"><span><?php echo LANGUAGE['login']; ?></span></a>
		  		</div>
		  	<?php endif; ?>
  		</div>
	  	<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
	  		<div class="navbar-start">
	  			<ul class="navbar-item">
	  				<li>
			      <a class="navbar-item" href="<?php echo route('home', 'index'); ?>">
			        <?php echo LANGUAGE['home']; ?>
			      </a>
			      </li>
			      <li>
			      <a class="navbar-item" href="<?php echo route('films', 'phim-le'); ?>">
			        <?php echo LANGUAGE['movie']; ?>
			      </a>
			      </li>
			      <li>
			      <a class="navbar-item" href="<?php echo route('films', 'phim-bo'); ?>">
			        <?php echo LANGUAGE['series']; ?>
			      </a>
			      </li>
			      <li class="dropdown is-hoverable">
			      <a class="navbar-item dropdown-trigger" href="#">
			        <?php echo LANGUAGE['year']; ?>
			      </a>
			      <div class="sub-menu">
			      		<div class="dropdown-menu">
			      			<div class="columns is-multiline">
				      		<?php 
				      		$years = years();
				      		foreach ($years as $year) : 
				      			if($year->year >= 2010 && $year->year <= date("Y")) :
				      			?>
				      			<div class="column is-2">
				      				<a href="<?php echo route('films', 'nam-phat-hanh/' . $year->year); ?>"><?php echo $year->year; ?></a>
				      			</div>
				      		<?php endif; endforeach; ?>
				      		<div class="column is-2">
				      			<a href="<?php echo route('films', 'nam-phat-hanh/-2010'); ?>">Cũ hơn</a>
				      		</div>
				      	</div>
			      		</div>
			      	</div>
			      </li>
			      <li class="dropdown is-hoverable">
			      <a class="navbar-item dropdown-trigger" href="#">
			        <?php echo LANGUAGE['kind']; ?>
			      </a>
			      	<div class="sub-menu">
			      		<div class="dropdown-menu">
			      			<div class="columns is-multiline">
				      		<?php 
				      		$genres = genres();
				      		foreach ($genres as $genre) : ?>
				      			<div class="column is-2">
				      				<a href="<?php echo route('films', 'the-loai/' . $genre->slug); ?>"><?php echo $genre->genre; ?></a>
				      			</div>
				      		<?php endforeach; ?>
				      	</div>
			      		</div>
			      	</div>
			      </li>
			     	<li class="dropdown is-hoverable">
			      <a class="navbar-item dropdown-trigger" href="#">
			        <?php echo LANGUAGE['country']; ?>
			      </a>
			      	<div class="sub-menu">
			      		<div class="dropdown-menu">
			      			<div class="columns is-multiline">
					      		<?php 
					      		$countries = countries();
					      		foreach ($countries as $country) : ?>
					      			<div class="column is-2">
					      				<a href="<?php echo route('films', 'quoc-gia/' . $country->slug); ?>"><?php echo $country->country; ?></a>
					      			</div>
					      		<?php endforeach; ?>
			      			</div>
			      		</div>
			      	</div>
			      </li>
		      	</ul>
    		</div>
    		<div class="navbar-end">
    			<div class="navbar-item">
            		<div class="field is-grouped">
		    			<form class="" action="<?php echo route('films', 'tim-kiem'); ?>" method="POST">
		                    <div class="control search">
		                        <input class="input" name="search" type="text" placeholder="Type and Enter to search...">
		                    </div>
		                </form>
            		</div>
        		</div>
    		</div>
		</nav>
	</div>