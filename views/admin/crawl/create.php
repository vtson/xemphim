<h2>Crawl Films</h2>
<form action="<?php echo route('admin/crawl', 'store');?>" method="post">
    <div class="field">
        <label for="url">URL Phimmoi</label>
        <p class="control ">
            <input class="input" type="text" name="url">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <button class="button is-success" type="submit">
                Create
            </button>
        </p>
    </div>
</form>



<h2>Crawl Episodes</h2>
<form action="<?php echo route('admin/crawl', 'store2');?>" method="post">
    <div class="field">
        <select id="multiple-directors" name="film-id">
            <?php foreach ($films as $film) : ?>
                <option value="<?php echo $film->id; ?>"><?php echo $film->fname; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="field">
        <label for="url">URL Youtube</label>
        <p class="control ">
            <input class="input" type="text" name="url">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <button class="button is-success" type="submit">
                Create
            </button>
        </p>
    </div>
</form>