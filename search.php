<?php
get_header();
if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php the_excerpt(); ?>
    <?php
  }
} else {
  echo '<p>No results found for "' . get_search_query() . '".</p>';
}
get_footer();
