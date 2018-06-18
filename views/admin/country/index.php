<table class="table">
  <thead>
    <tr>
      <th>Stt</th>
      <th>Country</th>
      <th>Slug</th>
      <td>Edit</td>
      <td>Delete</td>
    </tr>
  </thead>
  <tbody>
    <?php 
    $stt = 0;
    foreach ($countrys as $country) : 
      $stt++;
      ?>
      <tr>
        <th><?php echo $stt; ?></th>
        <td><?php echo $country->country; ?></td>
        <td><?php echo $country->slug; ?></td>
        <td><a href="<?php echo route('admin/country', 'edit?id=' . $country->id) ;?>">Edit</a></td>
        <td><a href="<?php echo route('admin/country', 'destroy/' . $country->id) ;?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<ul>
  <li><a href="<?php echo route('admin/country', 'create'); ?>">New</a></li>
</ul>