<!-- this loop is connected to the WP loop in index.php, this loop gets rid of the a tags and hr -->
<!-- the single.php is what wordpress is looking for from index.php to display the individual post as styled -->

<?php
  get_header();

  while(have_posts()) {
    the_post(); ?>

    <div class="page-banner">
      <!-- notice php function to load photo uri -->
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
      <div class="page-banner__content container container--narrow">
        <!-- php the_title function to dynamically pull in page info we want -->
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p>Dont forget to replace me later.</p>
        </div>
      </div>
    </div>

    <div class="container container--narrow page-section">
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo site_url('/blog') ?>">
          <i class="fa fa-home" aria-hidden="true"></i> Blog Home</a>
          <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></span>
        </p>
      </div>

      <div class="generic-content"><?php the_content(); ?></div>
    </div>

  <?php }

  get_footer();

?>