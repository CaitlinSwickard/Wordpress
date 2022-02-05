<?php
get_header();?>


<div class="page-banner">
    <!-- notice php function to load photo uri -->
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
      <div class="page-banner__content container container--narrow">
        <!-- php function to dynamically pull in info we want -->
        <h1 class="page-banner__title">Past Events</h1>
        <div class="page-banner__intro">
          <p>A recap of past events.</p>
        </div>
      </div>
    </div>


<!-- container to hold blog posts -->
<div class="container container--narrow page-section">
<?php
// custom query for grabbing past events for the past event page
$today = date('Ymd');
$pastEvents = new WP_Query(array(
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'event_date', // this array allows for the check of the events to only display events that are less than the current date
            'compare' => '<',
            'value' => $today,
            'type' => 'numeric',
        ),
    ),
));

// update loop to have new $pastEvents variable and look inside it
while ($pastEvents->have_posts()) {
    $pastEvents->the_post();?>
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
           <p><?php echo wp_trim_words(get_the_content(), 18); ?></p><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
          </div>
      </div>

  <?php }
  // update to this pagination function to make it customizable from our archive page that we custom created
echo paginate_links(array(
  'total' => $pastEvents->max_num_pages
));
?>
</div>


<?php get_footer();
?>