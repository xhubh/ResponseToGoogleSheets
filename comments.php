<?php
if ( post_password_required() ) {
  return;
}
?>

<div id="comments" class="comments-area">
  <?php if ( have_comments() ) : ?>
    <h2 class="comments-title">
      <?php
      $comments_number = get_comments_number();
      if ( '1' === $comments_number ) {
        /* translators: %s: post title */
        printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'okmg' ), get_the_title() );
      } else {
        printf(
          /* translators: 1: number of comments, 2: post title */
          _nx(
            '%1$s thought on &ldquo;%2$s&rdquo;',
            '%1$s thoughts on &ldquo;%2$s&rdquo;',
            $comments_number,
            'comments title',
            'okmg'
          ),
          number_format_i18n( $comments_number ),
          get_the_title()
        );
      }
      ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments( array(
        'avatar_size' => 100,
        'style'       => 'ol',
        'short_ping'  => true,
        'reply_text'  => __( 'Reply', 'okmg' ),
      ) );
      ?>
    </ol>

    <?php the_comments_navigation(); ?>

    <?php if ( ! comments_open() ) : ?>
      <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'okmg' ); ?></p>
    <?php endif; ?>
  <?php endif; ?>

  <?php comment_form(); ?>
</div>
