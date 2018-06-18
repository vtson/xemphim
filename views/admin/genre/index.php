<table class="table">
  <thead>
    <tr>
      <th>Stt</th>
      <th>Genre</th>
      <th>Slug</th>
      <th>Description</th>
      <td>Edit</td>
      <td>Delete</td>
    </tr>
  </thead>
  <tbody>
    <?php 
    $stt = 0;
    foreach ($genres as $genre) : 
      $stt++;
      ?>
      <tr>
        <th><?php echo $stt; ?></th>
        <td><?php echo $genre->genre; ?></td>
        <td><?php echo $genre->slug; ?></td>
        <td><?php echo $genre->description; ?></td>
        <td><a href="<?php echo route('admin/genre', 'edit?id=' . $genre->id) ;?>">Edit</a></td>
        <td><a href="<?php echo route('admin/genre', 'destroy/' . $genre->id) ;?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>