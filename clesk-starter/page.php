<?php
if (!defined('ABSPATH')) exit;
/**
 * Template for pages with SCF Flexible Content components
 */

get_header(); ?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        clesk_render_components();
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
