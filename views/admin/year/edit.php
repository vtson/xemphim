<h2>Movie Genre</h2>
<form action="<?php echo route('admin/year', 'update');?>" method="post">
    <input type="hidden" name="id" value="<?php echo $year->id; ?>">
    <div class="field">
        <label for="year">Year</label>
        <p class="control ">
            <input class="input" type="text" name="year" value="<?php echo $year->year; ?>">
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
