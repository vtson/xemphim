<h2>Movie Genre</h2>
<form action="<?php echo route('admin/genre', 'store');?>" method="post">
    <div class="field">
        <label for="genre">Name of Genre</label>
        <p class="control ">
            <input class="input" type="text" name="genre">
        </p>
    </div>
    <div class="field">
        <label for="description">Description</label>
        <p class="control ">
            <input class="input" type="text" name="description">
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
