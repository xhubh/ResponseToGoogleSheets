<div id="sidebar">
  <?php
  if ( is_active_sidebar( 'main-sidebar' ) ) {
    dynamic_sidebar( 'main-sidebar' );
  } else {
    ?>
    <h3>Default Sidebar</h3>
    <p>Please add widgets to the main sidebar to display here.</p>
    <?php
  }
  ?>
</div>
