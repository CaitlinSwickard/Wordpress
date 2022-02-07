<!-- This file is a behind the scene file -->


<?php 

function university_files() {

  // this loads the JS files. 
  // If you have dependencies for the JS that is the 3rd arg, if no dependencies you can just put , NULL
  // 4th arg is version num, final arg is "do you want to load this file at bottom of page like it should normally be (true)
  wp_enqueue_script('main_university_js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  // this is loading google font
  wp_enqueue_style('custom_google_fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  // this is loading the font awesome icons
  wp_enqueue_style('font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  // this function is specific to a wordpress function, takes 2 args
  // first arg is name of file you want to load, 2nd arg is the WP function to load the stylesheet 
  // the wording changes to script if you are loading JS
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css')); 
}
// this add action function takes 2 args, first one is what you want it to do, second is the name of the function
// wp_enqueue_scripts tells word press you want to load some files. Very specific naming.
// this function is calling the university_files function
add_action('wp_enqueue_scripts','university_files');



// this function loads the title for the browser tabs
function university_features() {
  // specific function to load menu navigation into wordpress admin area
  // specific function - arg title-tag
  add_theme_support('title-tag');
}
// add action specific after setup theme, then name of function 
add_action('after_setup_theme', 'university_features');


// this function manipulates a default query
// this code only runs for the archives pages for custom queries
function university_adjust_queries($query) {

  // this if statement powers the PROGRAMS page query 
  if(!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
    $query->set('orderby', 'title'); //setting order by title
    $query->set('order', 'ASC'); //setting order in Alphabetical
    $query->set('post_per_page', -1); //allows post set up to infinity
  }


  // this if statement powers the EVENT page query
  if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
    $today = date('Ymd');

    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date', // this array allows for the check of the events to only display events that are greater than the current date
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
        )
      ));
  }
}
// this add action function takes 2 args, first one is what you want it to do, second is the name of the function
add_action('pre_get_posts', 'university_adjust_queries');