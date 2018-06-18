<table class="table">
  <thead>
    <tr>
      <th>Stt</th>
      <th>Thumbnail</th>
      <th>Name</th>
      <th>Episode</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $stt = 0;
    foreach ($films as $film) : 
      $stt++;
      ?>
      <tr>
        <th><?php echo $stt; ?></th>
        <td><?php if(!empty($film->thumbnail)) : ?>
          <figure><img src="<?php echo asset($film->thumbnail); ?>"></figure>
          <?php else : ?>
          <figure><img src="<?php echo ROOT_URL . '/' . DEFAULT_THUMBNAIL; ?>"></figure>
          <?php endif; ?>
        </td>
        <td><?php echo $film->fname; ?></td>
        <td><a href="<?php echo route('admin/episode', 'show?film_id=' . $film->id) ;?>">Episode</td>
        <td><a href="<?php echo route('admin/films', 'edit?id=' . $film->id) ;?>">Edit</a></td>
        <td><a href="<?php echo route('admin/films', 'destroy/' . $film->id) ;?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>