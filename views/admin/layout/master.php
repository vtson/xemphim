<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xem Phim</title>
   	<?php include 'css.php'; ?>
  </head>
  <body>
  <?php include 'nav.php'; ?>
  <section class="section">
    <div class="container">
      <?php
      if (isset($flashMessage) && array_key_exists('errors', $flashMessage)): ?>
          <div class="notification is-danger">
            <button class="delete"></button>
            <strong>Error!</strong>
            <ul>
              <?php foreach ($flashMessage['errors'] as $error) : ?>
                <li><?php echo $error; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
      <?php endif; ?>
      <?php
      if (isset($flashMessage) && array_key_exists('success', $flashMessage)):
        ?>
          <div class="notification is-success">
              <button class="delete"></button>
              <strong>Success!</strong>
              <ul>
                <?php foreach ($flashMessage['success'] as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
              </ul>
          </div>
      <?php endif; ?>
     	<div class="columns">
        <?php include 'side-bar.php'; ?>
        <div class="column is-9">
     		<?php require_once $viewName; ?>
     	</div>
    </div>
  </section>
  <?php include 'views/layout/scripts.php'; ?>
  </body>
</html>