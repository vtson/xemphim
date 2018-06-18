<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xem Phim</title>
   	<?php include 'css.php'; ?>
  </head>
  <body>
  <?php include 'header.php'; ?>
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
     	<div>
     		<?php require_once $viewName; ?>
     	</div>
    </div>
  </section>
  <footer class="footer">
  <div class="container">
    <div class="content has-text-centered">
      <p>
        <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
        <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
        is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
      </p>
    </div>
  </div>
</footer>
  <?php include 'scripts.php'; ?>
  </body>
</html>