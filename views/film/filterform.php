<div class="filter-film">
<form action="<?php echo route('films', 'loc-phim'); ?>" method="post">
<div class="field is-horizontal">
  <div class="field-body">

    <div class="field">
      <div class="select">
        <select name="sort">
          <option value="DESC">Sắp xếp</option>
          <option value="ASC">Mới nhất</option>
          <option value="DESC">Cũ nhất</option>
        </select>
      </div>
    </div>
    <div class="field">
      <div class="select">
        <select name="type">
          <option value="">Tất cả</option>
          <option value="movie"><?php echo LANGUAGE['movie']; ?></option>
          <option value="series"><?php echo LANGUAGE['series']; ?></option>
        </select>
      </div>
    </div>
    <div class="field">
      <div class="select">
        <select name="genre">
          <option value="">Thể loại</option>
            <?php $genres = genres(); ?>
            <?php foreach ($genres as $genre) : ?>
          <option value="<?php echo $genre->genre; ?>"><?php echo $genre->genre; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
  </div>
    <div class="field">
      <div class="select">
                <select name="nation">
                    <option value="">Quốc gia</option>
                  <?php $countries = countries(); ?>
                  <?php foreach ($countries as $country) : ?>
                      <option value="<?php echo $country->country; ?>"><?php echo $country->country; ?></option>
                  <?php endforeach; ?>
                </select>
    </div>
  </div>
    <div class="field">
      <div class="select">
      <select name="year">
        <option value="">Năm phát hành</option>
                        <?php 
                  $years = years();
                  foreach ($years as $year) : 
                    if($year->year >= 2010 && $year->year <= date("Y")) :
                    ?>
                    <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                  <?php endif; endforeach; ?>
                  <option value="-2010">Cũ hơn</option>
        </select>
    </div>
  </div>
      <div class="field">
        <p class="control">
            <button class="button is-success" type="submit" name="submit">
                Lọc phim
            </button>
        </p>
    </div>
  </div>
</div>
</form>
</div>