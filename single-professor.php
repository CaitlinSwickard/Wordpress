<!-- this page powers the professor pages -->

<?php
  get_header();

  while(have_posts()) {
    the_post(); 
    // pageBanner function lives on function.php -reusable function for page banner logic
    pageBanner();
    ?>

 

    <div class="container container--narrow page-section">

      <!-- added the thumbnail function to display here -->
      <div class="generic-content">
        <div class="row group">

          <div class="one-third">
          <!-- to load custom thumbnail just add to function -->
            <?php the_post_thumbnail('professorPortrait'); ?>
          </div>

          <div class="two-thirds">
            <?php the_content(); ?>
          </div>

        </div>
      </div>


      <!-- this is pulling in the related custom field we created to relate events to programs -->
        <?php 
          $relatedPrograms = get_field('related_programs');
          
          if($relatedPrograms) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
            echo '<ul class="link-list min-list">';
            foreach($relatedPrograms as $program) { ?>
               <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
            
            <?php }
            echo '</ul>';

          }
        ?>
    </div>

  <?php }

  get_footer();

?>