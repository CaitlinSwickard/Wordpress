<?php 
get_header(); ?> 


<div class="page-banner">
    <!-- notice php function to load photo uri -->
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
      <div class="page-banner__content container container--narrow">
        <!-- php the_title function to dynamically pull in page info we want -->
        <h1 class="page-banner__title">Welcome to our blog!</h1>
        <div class="page-banner__intro">
          <p>Keep up with the latest news.</p>
        </div>
      </div>
    </div>


<!-- container to hold blog posts -->
<div class="container container--narrow page-section">
<?php 
  while(have_posts()) {
    the_post(); ?>
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

      <div class="metabox">
      <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
      </div>

      <div class="generic-content">
        <?php the_excerpt(); ?>
        <p><a class="btn btn--blue"href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
      </div> 
    </div>

  <?php }
?>
</div>


<?php get_footer();
?>








<!-- ----------------------------------------------------------------------------------------------- -->

<!-- FUNCTION Example -->
<!-- <?php 
function greet($name, $color) {
  echo "<p>My name is $name, my fav color is $color.</p>";
}
greet("John", "blue");
greet("Jane", "green");
?> -->


<!-- ARRAY Example-->
<!-- <?php
  $names = array("Brad", "John", "Jane", "Tom");

  $count = 0;
while($count < count($names)) {
  echo "<li>Hi, my name is $names[$count]</li>";
  $count++;
}
?> -->




