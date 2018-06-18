<table class="table">
  <thead>
    <tr>
      <th>Stt</th>
      <th>Thumbnail</th>
      <th>Name</th>
      <th>Dob</th>
      <th>Country</th>
      <th>marriage</th>
      <th>job</th>
      <td>Edit</td>
      <td>Delete</td>
    </tr>
  </thead>
  <tbody>
    <?php 
    $stt = 0;
    foreach ($participants as $participant) : 
      $stt++;
      ?>
      <tr>
        <th><?php echo $stt; ?></th>
        <td><?php if(!empty($participant->thumbnail)) : ?>
          <figure><img src="<?php echo asset($participant->thumbnail); ?>"></figure>
          <?php else : ?>
          <figure><img src="<?php echo ROOT_URL . '/' . DEFAULT_THUMBNAIL; ?>"></figure>
          <?php endif; ?>
        </td>
        <td><?php echo $participant->aname; ?></td>
        <td><?php echo $participant->dob; ?></td>
        <td><?php echo $participant->country; ?></td>
        <td><?php echo $participant->marriage; ?></td>
        <td><?php echo $participant->job; ?></td>
        <td><a href="<?php echo route('admin/participants', 'edit?id=' . $participant->id) ;?>">Edit</a></td>
        <td><a href="<?php echo route('admin/participants', 'destroy/' . $participant->id) ;?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>