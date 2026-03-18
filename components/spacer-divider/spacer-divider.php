<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Spacer / Divider
 * Description: Visual spacing and divider elements between sections
 * Variants: empty, line, wave
 */

$style      = get_sub_field('spacer_divider_style') ?: 'empty';
$height     = get_sub_field('sd_height') ?: 'md';
$line_width = get_sub_field('sd_line_width') ?: 'medium';
$wave_color = get_sub_field('sd_wave_color') ?: 'primary';

// Height mapping
$height_map = [
    'sm' => '2rem',
    'md' => '4rem',
    'lg' => '6rem',
    'xl' => '8rem',
];
$height_value = $height_map[$height] ?? '4rem';

// Line width mapping
$line_width_map = [
    'narrow' => '50%',
    'medium' => '75%',
    'full'   => '100%',
];
$line_width_value = $line_width_map[$line_width] ?? '75%';

// Wave color mapping
$wave_color_map = [
    'primary' => 'var(--color-primary)',
    'surface' => 'var(--color-surface)',
    'dark'    => 'var(--color-heading)',
];
$wave_fill = $wave_color_map[$wave_color] ?? 'var(--color-primary)';
?>

<?php if ($style === 'empty') : ?>

    <div class="clesk-spacer-divider" style="height: <?php echo esc_attr($height_value); ?>;"></div>

<?php elseif ($style === 'line') : ?>

    <div class="clesk-spacer-divider flex items-center justify-center" style="height: <?php echo esc_attr($height_value); ?>;">
        <hr class="border-0 border-t border-[var(--color-border)]"
            style="width: <?php echo esc_attr($line_width_value); ?>;">
    </div>

<?php elseif ($style === 'wave') : ?>

    <div class="clesk-spacer-divider w-full overflow-hidden leading-[0]">
        <svg class="w-full" height="60" viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,30 C240,60 480,0 720,30 C960,60 1200,0 1440,30 L1440,60 L0,60 Z"
                  fill="<?php echo esc_attr($wave_fill); ?>"/>
        </svg>
    </div>

<?php endif; ?>
