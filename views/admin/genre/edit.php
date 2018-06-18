<h2>Movie Genre</h2>
<form action="<?php echo route('admin/genre', 'update');?>" method="post">
    <input type="hidden" name="id" value="<?php echo $genre->id; ?>">
    <div class="field">
        <label for="genre">Name of Genre</label>
        <p class="control ">
            <input class="input" type="text" name="genre" value="<?php echo $genre->genre; ?>">
        </p>
    </div>
    <div class="field">
        <label for="description">Description</label>
        <p class="control ">
            <input class="input" type="text" name="description" value="<?php echo $genre->description; ?>">
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
