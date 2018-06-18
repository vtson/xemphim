<table class="table">
  <thead>
    <tr>
      <th>Stt</th>
      <th>Year</th>
      <td>Edit</td>
      <td>Delete</td>
    </tr>
  </thead>
  <tbody>
    <?php 
    $stt = 0;
    foreach ($years as $year) : 
      $stt++;
      ?>
      <tr>
        <th><?php echo $stt; ?></th>
        <td><?php echo $year->year; ?></td>
        <td><a href="<?php echo route('admin/year', 'edit?id=' . $year->id) ;?>">Edit</a></td>
        <td><a href="<?php echo route('admin/year', 'destroy/' . $year->id) ;?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>