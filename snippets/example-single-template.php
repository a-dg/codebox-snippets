<?php
get_header();
$theme = ThemeOption::getInstance();
$article = \Taco\Post\Factory::create($post);
?>

<h1><?php echo $article->getTheTitle(); ?></h1>
<?php echo $article->getDate(); ?>
<?php echo $article->getTermList('topic'); ?>
<?php echo $article->getTheContent(); ?>

<?php get_footer(); ?>