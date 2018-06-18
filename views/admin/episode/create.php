<h2>Upload Film</h2>
<form action="<?php echo route('admin/episode', 'store'); ?>" method="post" enctype="multipart/form-data">
  
      <div class="field" >
        <label for="film_id">Film</label>
        <div class="control">
            <div class="">
                <select id="multiple-directors" name="film_id">
                    <option value="0"></option>
                  <?php foreach ($films as $film) : ?>
                      <option value="<?php echo $film->id; ?>"><?php echo $film->fname; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

 
            <div class="field field-actors" >
                <label for="actor">Path-Title-Part</label>
                    <div class="columns field-actor">
                        <div class="control column">
                            <input class="input" type="text" name="econtent[]">
                        </div>
                        <div class="column">
                            <input class="input" type="text" name="ename[]">
                        </div>
                        <div class="column">
                            <input class="input" type="text" name="part[]">
                        </div>
                    </div>
        </div>
        <div>
            <a class="button" id="newFieldActor">Add field</a>
        </div>


    <div class="field">
        <p class="control">
            <button class="button is-success" type="submit">
                Create
            </button>
        </p>
    </div>
</form>