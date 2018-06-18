<h2>UpdateFilm</h2>
<form action="<?php echo route('admin/films', 'update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name='id' value="<?php echo $film->id; ?>">
    <div class="field">
        <label for="fname">Name of Film</label>
        <p class="control ">
            <input class="input" type="text" name="fname"
            value="<?php echo $film->fname; ?>"
            >
        </p>
    </div>

    <div class="field">
        <label for="description">Description</label>
        <p class="control ">
            <textarea class="textarea" name="description"
            ><?php echo $film->description; ?></textarea>
        </p>
    </div>

    <div class="field">
        <figure class="image is-128x128">
        <?php $image = !empty($film->thumbnail) ? $film->thumbnail : DEFAULT_THUMBNAIL; ?>
        <img class="reviewImageUpload" src="<?php echo asset($image); ?>" alt="image"/>
        </figure>
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
                      <option value="<?php echo $director->aname; ?>"
                        <?php if(in_array($director->aname, $film->directors)){
                            echo "selected";} ?>
                        ><?php echo $director->aname; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field" >
        <label for="actor">Actor-Role</label>
                <?php foreach ($film->actor as $factor) : 
                    $factor = explode('|', $factor); ?>
                    <div class=" columns">
                        <div class="control column">
                            <div class="select is-primary">
                                <select name="actor[]">
                                    <option value="0"></option>
                                      <?php $actors = participants('actor'); ?>
                                    <?php foreach ($actors as $actor) : ?>
                                          <option value="<?php echo $actor->aname; ?>"
                                            <?php if($actor->aname == $factor[0]){
                                                echo "selected";} ?>
                                            ><?php echo $actor->aname; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="column">
                            <input class="input" type="text" name="role[]" value="<?php 
                            if(isset($factor[1]))
                                echo $factor[1]; ?>">
                        </div>
                     </div>
                <?php endforeach; ?>
        </div>

    <div class="field">
        <label for="quality">Quality</label>
        <p class="control ">
            <input class="input" type="text" name="quality" value="<?php echo $film->quality; ?>">
        </p>
    </div>

    <div class="field">
        <label for="time">Time</label>
        <p class="control ">
            <input class="input" type="text" name="time" value="<?php echo $film->time; ?>">
        </p>
    </div>

     <div class="field" >
        <label for="type">Type</label>
        <div class="control">
            <div class="select is-primary">
                <select name="type">
                    <option value="movie" <?php if($film->type == 'movie'){
                            echo "selected";} ?>>Movie</option>
                    <option value="series" <?php if($film->type == 'series'){
                            echo "selected";} ?>>Series</option>
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
                      <option value="<?php echo $genre->genre; ?>"
                        <?php if(in_array(repairTextInput($genre->genre), $film->genre)){
                            echo "selected";} ?>
                        ><?php echo $genre->genre; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field" >
        <label for="notation">Country</label>
        <div class="control">
            <div class="">
                <select id="multiple-country" name="nation[]" multiple="multiple">
                    <option value="0"></option>
                  <?php $countries = countries(); ?>
                  <?php foreach ($countries as $country) : ?>
                      <option value="<?php echo $country->country; ?>"
                        <?php if(in_array(repairTextInput($country->country), $film->country)){
                            echo "selected";} ?>
                        ><?php echo $country->country; ?></option>
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
                      <option value="<?php echo $year->year; ?>"
                        <?php if($year->year == $film->year){
                            echo "selected";} ?>
                        ><?php echo $year->year; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>


    <div class="field">
        <p class="control">
            <button class="button is-success" type="submit">
                Update
            </button>
        </p>
    </div>
</form>