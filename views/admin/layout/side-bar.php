
        <div class="columns">
            <div class="column is-3">
                <aside class="menu">
                    <p class="menu-label">
                        General
                    </p>
                    <ul class="menu-list">
                        <li><a href="<?php echo route('admin','dashboard'); ?>"class="is-active">Dashboard</a></li>
                    </ul>
                    <p class="menu-label">
                        Search
                    </p>
                    <input type ="text" class="input" placeholder="Film title">
                    <p class="menu-label">
                        Administration
                    </p>
                    <ul class="menu-list">
                        <li><a href="<?php echo route('admin/films', 'create'); ?>">Upload film</a></li>
                        <li><a href="<?php echo route('admin/episode', 'create'); ?>">Add Episodes</a></li>
                        <li><a href="<?php echo route('admin/crawl', 'create'); ?>">Crawl film</a></li>
                        <li><a href="<?php echo route('admin/films', 'index'); ?>">Films</a></li>
                        <li><a>Members</a></li>
                        <li><a>Reports</a></li>
                        <li><a href="<?php echo route('admin/participants', 'create'); ?>">Participants</a></li>
                        <li><a href="<?php echo route('admin/genre', 'index'); ?>">Genre</a></li>
                        <li><a href="<?php echo route('admin/country', 'index'); ?>">Country</a></li>
						<li><a href="<?php echo route('admin/year', 'index'); ?>">Year</a></li>
                    </ul>
                </aside>
            </div>