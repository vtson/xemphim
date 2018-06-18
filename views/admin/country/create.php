<h2>Movie Genre</h2>
<form action="<?php echo route('admin/country', 'store');?>" method="post">
    <div class="field">
        <label for="country">Name of Country</label>
        <p class="control ">
            <input class="input" type="text" name="country">
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
