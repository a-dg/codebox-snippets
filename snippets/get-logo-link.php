<div class="logo">
  <?php
  $site_title = 'Site Title';
  if(is_front_page()) {
    echo '<h1>'.$site_title.'</h1>';
  } else {
    echo '<a href="/">'.$site_title.'</a>';
  }
  ?>
</div>