<h2>Movie Genre</h2>
<form action="<?php echo route('admin/country', 'update');?>" method="post">
    <input type="hidden" name="id" value="<?php echo $country->id; ?>">
    <div class="field">
        <label for="country">Name of Country</label>
        <p class="control ">
            <input class="input" type="text" name="country" value="<?php echo $country->country; ?>">
        </p>
    </div>
    <div class="field">
        <p class="control">
            <button class="button is-success" type="submit">
                Update
            </button>
        </p>
    </div>
</form>
