<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Banner
 * Description: Top-of-page notification banners for info, warnings and promotions
 * Variants: info, warning, promo
 */

$style       = get_sub_field('banner_style') ?: 'info';
$text        = get_sub_field('bn_text');
$cta_text    = get_sub_field('bn_cta_text');
$cta_link    = get_sub_field('bn_cta_link');
$dismissible = get_sub_field('bn_dismissible');
$icon_type   = get_sub_field('bn_icon') ?: 'none';

if (!$text) return;

// Style-dependent classes
$wrapper_classes = 'clesk-banner';
$text_classes    = 'text-sm font-medium';
$icon_classes    = 'flex-shrink-0';

switch ($style) {
    case 'warning':
        $wrapper_classes .= ' bg-amber-50 text-amber-800 py-3';
        break;
    case 'promo':
        $wrapper_classes .= ' bg-[var(--color-primary)] text-white py-4';
        break;
    default: // info
        $wrapper_classes .= ' bg-blue-50 text-blue-800 py-3';
        break;
}
?>

<div class="<?php echo esc_attr($wrapper_classes); ?>">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center gap-3">

            <?php if ($icon_type !== 'none') : ?>
                <span class="<?php echo esc_attr($icon_classes); ?>">
                    <?php if ($icon_type === 'info') : ?>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M10 9v5M10 6.5v0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    <?php elseif ($icon_type === 'warning') : ?>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2L1 18h18L10 2z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                            <path d="M10 8v4M10 14.5v0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    <?php elseif ($icon_type === 'megaphone') : ?>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 4v12M15 4L7 7H3a1 1 0 00-1 1v4a1 1 0 001 1h4l8 3V4z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                            <path d="M18 8a2 2 0 010 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M5 13v3a1 1 0 001 1h2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php endif; ?>
                </span>
            <?php endif; ?>

            <p class="<?php echo esc_attr($text_classes); ?>">
                <?php echo esc_html($text); ?>
            </p>

            <?php if ($cta_text && $cta_link) : ?>
                <?php if ($style === 'promo') : ?>
                    <a href="<?php echo esc_url($cta_link); ?>"
                       class="clesk-btn-secondary inline-flex items-center text-sm px-4 py-1.5 rounded-lg border border-white/30 text-white hover:bg-white/10 transition-colors duration-200 whitespace-nowrap">
                        <?php echo esc_html($cta_text); ?>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url($cta_link); ?>"
                       class="text-sm font-semibold underline hover:no-underline whitespace-nowrap">
                        <?php echo esc_html($cta_text); ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($dismissible) : ?>
                <button type="button"
                        class="flex-shrink-0 ml-2 p-1 rounded-lg hover:bg-black/10 transition-colors duration-200"
                        onclick="this.closest('.clesk-banner').style.display='none'"
                        aria-label="<?php esc_attr_e('Dismiss', 'clesk-starter'); ?>">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4l8 8M12 4l-8 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            <?php endif; ?>

        </div>
    </div>
</div>
