<h2>Movie Genre</h2>
<form action="<?php echo route('admin/year', 'store');?>" method="post">
    <div class="field">
        <label for="year">Year</label>
        <p class="control ">
            <input class="input" type="text" name="year">
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
