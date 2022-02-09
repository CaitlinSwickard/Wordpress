<!-- This is the custom page that powers PROGRAM pages -->

<?php
get_header();

while (have_posts()) {
    the_post();?>

    <div class="page-banner">
      <!-- notice php function to load photo uri -->
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
      <div class="page-banner__content container container--narrow">
        <!-- php the_title function to dynamically pull in page info we want -->
        <h1 class="page-banner__title"><?php the_title();?></h1>
        <div class="page-banner__intro">
          <p>Dont forget to replace me later.</p>
        </div>
      </div>
    </div>

    <div class="container container--narrow page-section">
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
        <!-- notice updated archive link function for the events page custom type we created -->
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
          <i class="fa fa-home" aria-hidden="true"></i> All Programs</a>
          <span class="metabox__main"><?php the_title();?></span>
        </p>
      </div>

      <div class="generic-content"><?php the_content();?></div>
     

      <?php
        // this custom query build the relationship for programs and professor who teach that program/event
        $relatedProfessors = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'professor',
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_query' => array(
              array( //this array is checking the array of the related_programs contains the ID # of the current program post - then post to page
                  'key' => 'related_programs',
                  'compare' => 'LIKE',
                  'value' => '"' . get_the_ID() . '"', //the quotes are serializing the data coming in
              ),
          ),
      ));
  
      if ($relatedProfessors->have_posts()) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
  
          while ($relatedProfessors->have_posts()) {
              $relatedProfessors->the_post();?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              
          <?php }
      }
      // this WP function resets the global post object back to default so we can run multiple custom queries on a page
      wp_reset_postdata();


      // this is the custom query for upcoming event related to a program
      $today = date('Ymd');
      $homepageEvents = new WP_Query(array(
        'posts_per_page' => 2,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'event_date', // this array allows for the check of the events to only display events that are greater than the current date
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric',
            ),
            array( //this array is checking the array of the related_programs contains the ID # of the current program post - then post to page
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"', //the quotes are serializing the data coming in
            ),
        ),
    ));

    if ($homepageEvents->have_posts()) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';

        while ($homepageEvents->have_posts()) {
            $homepageEvents->the_post();?>
          <div class="event-summary">
            <a class="event-summary__date t-center" href="#">
            <!-- notice php code for custom field created to display the date -->
              <span class="event-summary__month"><?php
            $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('M')
            ?></span>
               <span class="event-summary__day"><?php echo $eventDate->format('d') ?></span>
            </a>
          <div class="event-summary__content">
           <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
           <p><?php if (has_excerpt()) {
                echo get_the_excerpt();
            } else {
                echo wp_trim_words(get_the_content(), 18);
            }?></p><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
        <?php }
    }

    ?>
    </div>

  <?php }

get_footer();

?>