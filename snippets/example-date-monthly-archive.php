<?php
get_header();
// $theme = ThemeOption::getInstance();
?>

<div id="content">
  <?php if(have_posts()): ?>
    <h1>Archive for <?php echo trim(single_month_title(' ', false)); ?></h1>
    <?php
    $blog_posts = \Taco\Post\Factory::createMultiple($posts);
    if(Arr::iterable($blog_posts)) {
      foreach($blog_posts as $blog_post) {
        echo sprintf(
          '<article>
            <h2><a href="%s">%s</a></h2>
            <p class="date">%s</p>
            %s
          </article>',
          $blog_post->getPermalink(),
          $blog_post->getTheTitle(),
          mysql2date('F j, Y', $blog_post->post_date),
          $blog_post->getTheExcerpt()
        );
      }
    }
    ?>
  <?php endif; ?>
</div>

<?php get_footer(); ?>