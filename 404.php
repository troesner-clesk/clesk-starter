<?php
if (!defined('ABSPATH')) exit;
/**
 * 404 template
 *
 * @package Clesk_Starter
 */

get_header();
?>
<main class="clesk-section">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 text-center py-24 lg:py-32">
        <p class="font-mono text-sm text-[var(--color-text-muted)] mb-4">404</p>
        <h1 class="clesk-heading-1 mb-6"><?php esc_html_e('Seite nicht gefunden', 'clesk-starter'); ?></h1>
        <p class="text-lg text-[var(--color-text-muted)] mb-10 max-w-xl mx-auto">
            <?php esc_html_e('Die Seite, die du suchst, existiert nicht (oder nicht mehr).', 'clesk-starter'); ?>
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="clesk-btn-primary">
            <?php esc_html_e('Zur Startseite', 'clesk-starter'); ?>
        </a>
    </div>
</main>
<?php get_footer(); ?>
