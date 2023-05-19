<?php get_header(); ?>

<div id="content" class="container">
  <h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'okmg' ); ?></h1>
  <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'okmg' ); ?></p>
  <?php get_search_form(); ?>
  <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
  <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
</div>

<?php get_footer(); ?>
