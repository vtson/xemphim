<h2>Upload Participant</h2>
<form action="<?php echo route('admin/participants', 'update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $participant->id; ?>">
    <div class="field">
        <label for="aname">Name</label>
        <p class="control ">
            <input class="input" type="text" name="aname" value="<?php echo $participant->aname; ?>">
        </p>
    </div>

    <div class="field">
        <label for="dob">Date of brith</label>
        <p class="control ">
            <input class="input" type="date" name="dob" value="<?php echo $participant->dob; ?>">
        </p>
    </div>

    <div class="field">
        <figure class="image is-128x128">
        <?php $image = !empty($participant->thumbnail) ? $participant->thumbnail : DEFAULT_THUMBNAIL; ?>
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
        <label for="notation">Job</label>
        <div class="control">
            <div class="">
                <select id="multiple-job" name="job[]" multiple="multiple">
                    <?php foreach ($GLOBALS['jobs'] as $job) : ?>
                        <option value="<?php echo $job; ?>"
                            <?php if(in_array($job, $participant->job))
                                echo "selected";
                        ?>
                        ><?php echo $job; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field">
        <label for="height">Height</label>
        <p class="control ">
            <input class="input" type="text" name="height" value="<?php echo $participant->height; ?>">
        </p>
    </div>

    <div class="field">
        <label for="marriage">Marriage</label>
        <div class="control">
            <div class="select">
                <select name="marriage">
                    <?php foreach ($GLOBALS['marriages'] as $marriage) : ?>
                        <option value="<?php echo $marriage; ?>"
                            <?php if($marriage == $participant->marriage)
                                echo "selected";
                        ?>
                        ><?php echo $marriage; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field" >
        <label for="country">Country</label>
        <div class="control">
            <div class="">
                <select id="multiple-country" name="country[]" multiple="multiple" value="<?php echo $participant->country; ?>">
                    <option value="0">Unkown</option>
                      <?php $countries = countries(); ?>
                      <?php foreach ($countries as $country) : ?>
                          <option value="<?php echo $country->country; ?>" <?php if(in_array(repairTextInput($country->country), $participant->country)){
                            echo "selected";} ?> >
                            <?php echo $country->country; ?></option>
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