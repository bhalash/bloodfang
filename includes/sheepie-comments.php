<?php

/**
 * Theme Comment Functions
 * -----------------------------------------------------------------------------
 */

function bloodfang_theme_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  ?>

  <li <?php comment_class(['comment']); ?> id="comment--<?php comment_ID() ?>">
    <header>
      <?php echo bloodfang_avatar($comment, get_comment_author($comment), 'comment__avatar', ['size' => 130]); ?>
      <p class="comment__header">
        <span class="comment__header-item"><?php comment_author_link(); ?></span>
        <span class="comment__header-item">
          <time datetime="<?php comment_date('Y-M-d H:i'); ?>"><?php comment_date(get_option('date_format')); ?></time>
          <a href="<?php comment_link($comment); ?>">#</a>

          <?php if (is_user_logged_in()) : ?>
            <?php edit_comment_link(__('edit', 'bloodfang'), ' / ', ''); ?>
          <?php endif; ?>
        </span>
      </p>
    </header>
    <div class="comment__body">
      <?php if (!$comment->comment_approved) : ?>
        <p><?php _e('Your comment is awaiting approval.', 'bloodfang'); ?></p>
      <?php else : ?>
        <?php comment_text(); ?>
      <?php endif; ?>
    </div>
  </li>

  <?php
}

/**
 * Generate Custom Commentform Input HTML
 * -------------------------------------------------------------------------
 */

function bloodfang_commentform_fields($input_fields = null, $input_html = null) {
  // Template input for name, email and URL.
  $input_html = $input_html ?: '<input class="comments__input %s-name font-size--small" id="%s" name="%s" placeholder="%s" type="text" required="required">';

  $input_fields = $input_fields ?: [
    'author' => __('Name*', 'bloodfang'),
    'email' => __('Email*', 'bloodfang'),
    'url' => __('Website', 'bloodfang')
  ];

  foreach ($input_fields as $field => $label) {
    $input_fields[$field] = sprintf($input_html, $field, $field, $field, $label);
  }

  return $input_fields;
}

/**
 * Wrap Comment Fields in Elements
 * -------------------------------------------------------------------------
 * Wrap comment form fields in <div></div> tags.
 */

function bloodfang_wrap_comment_fields_before() {
  printf('<div class="comments__inputs vspace--full">');
}

function bloodfang_wrap_comment_fields_after() {
  printf('</div>');
}

add_action('comment_form_before_fields', 'bloodfang_wrap_comment_fields_before');
add_action('comment_form_after_fields', 'bloodfang_wrap_comment_fields_after');

?>
