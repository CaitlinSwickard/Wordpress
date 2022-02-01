<!-- this page is what WP is looking for to display pages -->

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

<!-- php if statement for showing the page button box when on different pages, or not showing -->
    <?php 
    $theParent = wp_get_post_parent_ID(get_the_ID());
    // this get post parent function will return 0 if no parent page, otherwise it will print post # of parent
      if ($theParent) { ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
        </p>
      </div>

        <?php
      }
    ?>



<!-- this is the control code for the menu box that appears on the about/privacy pages -->
<!-- the if statement controls whether the box appears, and makes sure it doesnt appear on pages that dont have children pages -->
    <?php 
    $testArray = get_pages(array(
      'child_of' => get_the_ID(),
    ));
    
    if ($theParent or $testArray) { ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
        <ul class="min-list">
        <!--wp_list_pages function needs an associative array -->
          <?php 
            if ($theParent) {
                $findChildrenOf = $theParent;
              } else {
                $findChildrenOf = get_the_ID();
              }

            wp_list_pages(array(
              'title_li' => NULL,
              'child_of' => $findChildrenOf,
              'sort_column' => 'menu_order'

            )); 
          ?>
        </ul>
      </div>
      <?php } ?>



      <!-- php function the_content to load the content from the wordpress page -->
      <div class="generic-content">
          <?php the_content(); ?>
      </div>
    </div>

<?php }

get_footer();

?>