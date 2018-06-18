<table class="table">
  <thead>
    <tr>
      <th>Stt</th>
      <th>Title</th>
      <th>Path-------------------------------------------------------------------------</th>
      <th>Part</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $stt = 0;
    foreach ($episodes as $episode) : 
      $stt++;
      ?>
      <tr>
        <th><?php echo $stt; ?></th>
        <td><?php echo $episode->ename; ?></td>
        <td><?php echo $episode->econtent; ?></td>
        <td><?php echo $episode->part; ?></td>
        <td><a href="<?php echo route('admin/episode', 'edit?film_id=' . $episode->film_id) ;?>">Edit</a></td>
        <td><a href="<?php echo route('admin/episode', 'destroy/' . $episode->id) ;?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>