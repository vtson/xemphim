<h2>Upload Film</h2>
<form action="<?php echo route('admin/films', 'store'); ?>" method="post" enctype="multipart/form-data">
    <div class="field">
        <label for="fname">Name of Film</label>
        <p class="control ">
            <input class="input" type="text" name="fname">
        </p>
    </div>

    <div class="field">
        <label for="description">Description</label>
        <p class="control ">
            <textarea class="textarea" name="description"></textarea>
        </p>
    </div>

    <div class="field">
        <img hidden class="reviewImageUpload" src="#" alt="image"/>
    </div>

    <div class="field">
        <div><p>Thumnail</p></div>
        <label class="control">
            <input class="file-input post" id="thumbnail" type="file" name="thumbnail" multiple
                   accept='image/*'>
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">
                    Choose a file…
                </span>
            </span>
        </label>
    </div>

  
      <div class="field" >
        <label for="directors">Directors</label>
        <div class="control">
            <div class="">
                <select id="multiple-directors" name="directors[]" multiple="multiple">
                    <option value="0"></option>
                  <?php $directors = participants('Director'); ?>
                  <?php foreach ($directors as $director) : ?>
                      <option value="<?php echo $director->aname; ?>"><?php echo $director->aname; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

 
            <div class="field field-actors" >
        <label for="actor">Actor-Role</label>
                    <div class="columns field-actor">
                        <div class="control column">
                            <div class="select is-primary">
                                <select name="actor[]">
                                    <option value="0"></option>
                                      <?php $actors = participants('actor'); ?>
                                    <?php foreach ($actors as $actor) : ?>
                                          <option value="<?php echo $actor->aname; ?>"
                                            ><?php echo $actor->aname; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="column">
                            <input class="input" type="text" name="role[]">
                        </div>
                    </div>
        </div>
        <div>
            <a class="button" id="newFieldActor">Add field</a>
        </div>


    <div class="field">
        <label for="quality">Quality</label>
        <p class="control ">
            <input class="input" type="text" name="quality">
        </p>
    </div>

    <div class="field">
        <label for="time">Time</label>
        <p class="control ">
            <input class="input" type="text" name="time">
        </p>
    </div>

     <div class="field" >
        <label for="type">Type</label>
        <div class="control">
            <div class="select is-primary">
                <select name="type">
                    <option value="movie">Movie</option>
                    <option value="series">Series</option>
                </select>
            </div>
        </div>
    </div>

     <div class="field" >
        <label for="genre">Genre</label>
        <div class="control">
            <div class="">
                <select id="multiple-genre" name="genre[]" multiple="multiple">
                    <option value="0"></option>
                  <?php $genres = genres(); ?>
                  <?php foreach ($genres as $genre) : ?>
                      <option value="<?php echo $genre->genre; ?>"><?php echo $genre->genre; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field" >
        <label for="notation">Country</label>
        <div class="control">
            <div class="">
                <select id="multiple-country" name="notation[]" multiple="multiple">
                    <option value="0"></option>
                  <?php $countries = countries(); ?>
                  <?php foreach ($countries as $country) : ?>
                      <option value="<?php echo $country->country; ?>"><?php echo $country->country; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field" >
        <label for="year">Release date</label>
        <div class="control">
            <div class="select is-primary">
                <select name="year">
                    <option value="0"></option>
                  <?php $years = years(); ?>
                  <?php foreach ($years as $year) : ?>
                      <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field">
        <p class="control">
            <button class="button is-success" type="submit">
                Create
            </button>
        </p>
    </div>
</form>