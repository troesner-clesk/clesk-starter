<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Text Block
 * Description: Rich text content block
 * Variants: normal, narrow
 */

$style    = get_sub_field('tb_style') ?: 'normal';
$headline = get_sub_field('tb_headline');
$content  = get_sub_field('tb_content');

if (!$content && !$headline) return;

$width_class = ($style === 'narrow') ? 'max-w-3xl mx-auto' : 'max-w-[85rem] mx-auto';
?>

<section class="clesk-text-block clesk-section bg-[var(--color-background)]">
    <div class="<?php echo esc_attr($width_class); ?> px-4 sm:px-6 lg:px-8">
        <?php if ($headline) : ?>
            <h2 class="clesk-heading-2 mb-6"><?php echo esc_html($headline); ?></h2>
        <?php endif; ?>

        <?php if ($content) : ?>
            <div class="prose prose-lg max-w-none text-[var(--color-text)]">
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
