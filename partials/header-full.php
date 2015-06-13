<?php

/**
 * Article Header
 * -----------------------------------------------------------------------------
 * @category   PHP Script
 * @package    Sheepie
 * @author     Mark Grealish <mark@bhalash.com>
 * @copyright  Copyright (c) 2015 Mark Grealish
 * @license    https://www.gnu.org/copyleft/gpl.html The GNU General Public License v3.0
 * @version    3.0
 * @link       https://github.com/bhalash/sheepie
 *
 * This file is part of Sheepie.
 *
 * Sheepie is free software: you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software 
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * Sheepie is distributed in the hope that it will be useful, but WITHOUT ANY 
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along with 
 * Sheepie. If not, see <http://www.gnu.org/licenses/>.
 */

?>

<header>
    <h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf('%s %s', _e('Permanent link to', TTD), the_title_attribute()); ?>"><?php the_title(); ?></a></h3>
    <?php if (!is_page()) : ?>
        <small>
            <time datetime="<?php the_time('Y-m-d H:i'); ?>">
                <?php the_time(get_option('date_format')) ?>
            </time>
            <?php _e(' in ', TTD); the_category(', '); edit_post_link(__('edit post', TTD), ' / ', ''); ?>
            </small>
    <?php endif; ?>
</header>