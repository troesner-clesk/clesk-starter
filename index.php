<?php
if (!defined('ABSPATH')) exit;
/**
 * Fallback template (WordPress requirement)
 *
 * This file exists as a fallback. All page content is rendered
 * via page.php using SCF Flexible Content components.
 */

get_header(); ?>

<main id="primary" class="site-main clesk-container py-16">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header mb-8">
                    <h1 class="clesk-heading-1"><?php echo esc_html(get_the_title()); ?></h1>
                </header>
                <div class="entry-content clesk-body-text prose max-w-none">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    endif;
    ?>
</main>

<?php get_footer(); ?>
