<h2>Update Film</h2>
<form action="<?php echo route('admin/episode', 'store'); ?>" method="post" enctype="multipart/form-data">

            <div class="field field-actors" >
                <label for="actor">Path-Title-Part</label>
                    <?php foreach($episodes as $episode) : ?>
                        <div class="columns field-actor">
                            <input type="hidden" name="id" value="<?php echo $episode->id; ?>">
                            <div class="control column">
                                <input class="input" type="text" name="econtent[]" value="<?php echo $episode->econtent; ?>">
                            </div>
                            <div class="column">
                                <input class="input" type="text" name="ename[]" value="<?php echo $episode->ename; ?>">
                            </div>
                            <div class="column">
                                <input class="input" type="text" name="part[]" value="<?php echo $episode->part; ?>">
                            </div>
                            <div class="column">
                                  <a class="button is-danger is-outlined delete-field">
                                    <span>Delete</span>
                                    <span class="icon is-small">
                                      <i class="fas fa-times"></i>
                                    </span>
                                  </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>

    <div class="field">
        <p class="control">
            <button class="button is-success" type="submit">
                Update
            </button>
        </p>
    </div>
</form>