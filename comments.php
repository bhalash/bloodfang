<?php

/**
 * Comments Template
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Bloodfang
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU GPL v3.0
 * @version    1.0
 * @link       https://github.com/bhalash/bloodfang
 */

if (!comments_open() || post_password_required()) {
    return;
}

$textarea_html = '<textarea class="vspace--full comments__textarea" id="textarea" name="comment" required="required"></textarea>';

?>

<hr class="vcenter--full">
<div class="comments" id="comments">
    <?php if (have_comments()) : ?>
        <ul class="comments__commentlist vspace--triple">
            <?php wp_list_comments([
                'callback' => 'bloodfang_theme_comments',
                'avatar_size' => 0,
                'format' => 'html5',
                'style' => 'ul'
            ]); ?>
        </ul>
    <?php endif; ?>

    <?php if (get_comment_pages_count() > 1) {
        bloodfang_partial('pagination', 'comment');
    } ?>

    <div class="noprint" id="comments__entry">
        <?php comment_form([
            'class_form' => 'comments__form',
            'id_submit' => 'comments__submit',
            'title_reply' => '',
            'comment_field' => $textarea_html,
            'comment_form_before_fields' => '<div class="comments__form">',
            'comment_form_after_fields' => '</div>',
            'fields' => bloodfang_commentform_fields()
        ]); ?>
    </div>
</div>
