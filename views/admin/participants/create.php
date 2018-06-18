<h2>Upload Film</h2>
<form action="<?php echo route('admin/participants', 'store'); ?>" method="post" enctype="multipart/form-data">
    <div class="field">
        <label for="aname">Name</label>
        <p class="control ">
            <input class="input" type="text" name="aname">
        </p>
    </div>

    <div class="field">
        <label for="dob">Date of brith</label>
        <p class="control ">
            <input class="input" type="date" name="dob">
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
        <label for="notation">Job</label>
        <div class="control">
            <div class="">
                <select id="multiple-job" name="job[]" multiple="multiple">
                    <option value="actor">Actor</option>
                    <option value="director">Director</option>
                </select>
            </div>
        </div>
    </div>

    <div class="field">
        <label for="height">Height</label>
        <p class="control ">
            <input class="input" type="text" name="height">
        </p>
    </div>

    <div class="field">
        <label for="marriage">Marriage</label>
        <div class="control">
            <div class="select">
                <select name="marriage">
                    <option value="married">Married</option>
                    <option value="single">Single</option>
                </select>
            </div>
        </div>
    </div>

    <div class="field" >
        <label for="country">Country</label>
        <div class="control">
            <div class="">
                <select id="multiple-country" name="country[]" multiple="multiple">
                    <option value="0"></option>
                  <?php $countries = countries(); ?>
                  <?php foreach ($countries as $country) : ?>
                      <option value="<?php echo $country->country; ?>"><?php echo $country->country; ?></option>
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