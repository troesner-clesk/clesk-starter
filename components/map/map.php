<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Map
 * Description: Embedded map section supporting Google Maps and OpenStreetMap via iframe embed code
 * Variants: google-maps, openstreetmap
 */

$style      = get_sub_field('map_style') ?: 'google-maps';
$headline   = get_sub_field('map_headline');
$embed_code = get_sub_field('map_embed_code');
$map_height = get_sub_field('map_height') ?: 'md';
$full_width = get_sub_field('map_full_width');

if (!$embed_code) return;

// Height mapping
$height_map = [
    'sm' => '300px',
    'md' => '450px',
    'lg' => '600px',
];
$height = $height_map[$map_height] ?? '450px';

// Allowed tags for safe iframe rendering
$allowed_tags = array(
    'iframe' => array(
        'src'             => true,
        'width'           => true,
        'height'          => true,
        'style'           => true,
        'frameborder'     => true,
        'allowfullscreen' => true,
        'loading'         => true,
        'referrerpolicy'  => true,
    ),
);
?>

<section class="clesk-map clesk-section bg-[var(--color-background)]">
    <?php if ($full_width) : ?>
        <!-- Full Width -->
        <div class="px-4 sm:px-6 lg:px-8">
            <?php if ($headline) : ?>
                <div class="max-w-[85rem] mx-auto mb-8">
                    <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                </div>
            <?php endif; ?>
        </div>

        <div class="w-full overflow-hidden rounded-xl" style="height: <?php echo esc_attr($height); ?>;">
            <?php echo wp_kses($embed_code, $allowed_tags); ?>
        </div>

    <?php else : ?>
        <!-- Contained Width -->
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <?php if ($headline) : ?>
                <div class="mb-8">
                    <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                </div>
            <?php endif; ?>

            <div class="w-full overflow-hidden rounded-xl" style="height: <?php echo esc_attr($height); ?>;">
                <?php echo wp_kses($embed_code, $allowed_tags); ?>
            </div>
        </div>

    <?php endif; ?>
</section>

<style>
    .clesk-map iframe {
        width: 100%;
        height: 100%;
        border: 0;
        border-radius: 0.75rem;
    }
</style>
