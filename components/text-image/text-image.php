<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Text + Image
 * Description: Two-column section with text and image
 * Variants: image-left, image-right
 */

$layout   = get_sub_field('ti_layout') ?: 'image-right';
$headline = get_sub_field('ti_headline');
$text     = get_sub_field('ti_text');
$image    = get_sub_field('ti_image');
$cta_text = get_sub_field('ti_cta_text');
$cta_link = get_sub_field('ti_cta_link');

$image_order = ($layout === 'image-left') ? 'lg:order-first' : 'lg:order-last';
?>

<section class="clesk-text-image clesk-section bg-[var(--color-background)]">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Text -->
            <div>
                <?php if ($headline) : ?>
                    <h2 class="clesk-heading-2">
                        <?php echo wp_kses_post($headline); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="mt-4 clesk-body-text">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php if ($cta_text && $cta_link) : ?>
                    <div class="mt-6">
                        <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary">
                            <?php echo esc_html($cta_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Image -->
            <div class="<?php echo esc_attr($image_order); ?>">
                <?php if ($image) : ?>
                    <img src="<?php echo esc_url($image['url']); ?>"
                         alt="<?php echo esc_attr($image['alt']); ?>"
                         class="rounded-xl shadow-md w-full h-auto object-cover"
                         loading="lazy">
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder-4-3.svg'); ?>"
                         alt="Placeholder"
                         class="rounded-xl shadow-md w-full h-auto"
                         loading="lazy">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
