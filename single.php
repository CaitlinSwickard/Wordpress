<!-- this loop is connected to the WP loop in index.php, this loop gets rid of the a tags and hr -->
<!-- the single.php is what wordpress is looking for from index.php to display the individual post as styled -->

<?php
  get_header();
  while(have_posts()) {
    the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>
<?php }

get_footer();

?>