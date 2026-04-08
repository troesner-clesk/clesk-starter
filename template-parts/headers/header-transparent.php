<?php
if (!defined('ABSPATH')) exit;
/**
 * Header variant: Transparent
 * Transparent background initially, becomes solid on scroll.
 * Uses same layout as default (logo left, nav right).
 * Requires scroll JS in app.js to toggle .clesk-header--scrolled class.
 *
 * @package Clesk_Starter
 */
?>
<header class="clesk-header clesk-header--transparent fixed top-0 left-0 right-0 z-50 bg-transparent border-b border-transparent transition-all duration-300">
    <nav class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-xl font-bold font-[var(--font-heading)] transition-colors clesk-header-logo-link">
                    <?php echo esc_html(get_bloginfo('name')); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile menu button -->
        <button type="button"
                class="clesk-mobile-toggle lg:hidden inline-flex items-center justify-center rounded-md p-2"
                aria-controls="clesk-mobile-menu"
                aria-expanded="false"
                onclick="this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'); document.getElementById('clesk-mobile-menu').classList.toggle('hidden');">
            <span class="sr-only"><?php esc_html_e('Open menu', 'clesk-starter'); ?></span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex lg:items-center lg:gap-x-1">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'clesk-desktop-menu flex items-center gap-x-1',
                'fallback_cb'    => false,
                'depth'          => 3,
                'walker'         => new Clesk_Nav_Walker(),
            ));
            ?>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    <div id="clesk-mobile-menu" class="hidden lg:hidden border-t border-[color:var(--color-border,rgba(127,127,127,0.2))]">
        <div class="px-4 py-4 bg-[var(--color-background)]">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'clesk-mobile-menu flex flex-col gap-y-1',
                'fallback_cb'    => false,
                'depth'          => 3,
                'walker'         => new Clesk_Mobile_Walker(),
            ));
            ?>
        </div>
    </div>
</header>
