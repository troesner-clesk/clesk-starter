<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Call to Action
 * Description: CTA section with headline, text and button
 * Variants: simple, highlight, dark
 */

$style       = get_sub_field('cta_style') ?: 'simple';
$headline    = get_sub_field('cta_headline');
$text        = get_sub_field('cta_text');
$button_text        = get_sub_field('cta_button_text');
$button_link        = get_sub_field('cta_button_link');
$button_link_opts   = get_sub_field('cta_button_link_opts');
$button_text_2      = get_sub_field('cta_button_text_2');
$button_link_2      = get_sub_field('cta_button_link_2');
$button_link_2_opts = get_sub_field('cta_button_link_2_opts');

// Style-dependent classes
$section_classes = 'clesk-cta clesk-section';
$heading_classes = 'clesk-heading-2';
$text_classes    = 'mt-4 text-lg leading-relaxed';
$btn_classes     = 'clesk-btn-primary';
$btn2_classes    = 'clesk-btn-secondary';

switch ($style) {
    case 'highlight':
        $section_classes .= ' bg-[var(--color-primary)] text-white';
        $heading_classes  = 'text-3xl font-bold tracking-tight sm:text-4xl text-white';
        $text_classes    .= ' text-white/90';
        $btn_classes      = 'inline-block rounded-lg bg-white px-8 py-3 text-base font-semibold text-[var(--color-primary)] shadow-sm hover:bg-gray-100 transition-colors duration-200';
        $btn2_classes     = 'clesk-btn-outline-white inline-block rounded-lg border-2 border-white px-8 py-3 text-base font-semibold text-white hover:bg-white/10 transition-colors duration-200';
        break;
    case 'dark':
        $section_classes .= ' bg-gray-900 text-white';
        $heading_classes  = 'text-3xl font-bold tracking-tight sm:text-4xl text-white';
        $text_classes    .= ' text-gray-300';
        $btn_classes      = 'clesk-btn-primary';
        $btn2_classes     = 'clesk-btn-outline-white inline-block rounded-lg border-2 border-white px-8 py-3 text-base font-semibold text-white hover:bg-white/10 transition-colors duration-200';
        break;
    default: // simple
        $section_classes .= ' bg-[var(--color-surface)]';
        break;
}
?>

<section class="<?php echo esc_attr($section_classes); ?>">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <?php if ($headline) : ?>
                <h2 class="<?php echo esc_attr($heading_classes); ?>">
                    <?php echo wp_kses_post($headline); ?>
                </h2>
            <?php endif; ?>

            <?php if ($text) : ?>
                <p class="<?php echo esc_attr($text_classes); ?>">
                    <?php echo esc_html($text); ?>
                </p>
            <?php endif; ?>

            <?php if ($button_text && $button_link) : ?>
                <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                    <a href="<?php echo esc_url($button_link); ?>" class="<?php echo esc_attr($btn_classes); ?>"<?php echo clesk_link_attrs($button_link_opts); ?>>
                        <?php echo esc_html($button_text); ?>
                    </a>
                    <?php if ($button_text_2 && $button_link_2) : ?>
                        <a href="<?php echo esc_url($button_link_2); ?>" class="<?php echo esc_attr($btn2_classes); ?>"<?php echo clesk_link_attrs($button_link_2_opts); ?>>
                            <?php echo esc_html($button_text_2); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
