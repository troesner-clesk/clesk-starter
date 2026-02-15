<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Gallery
 * Description: Image gallery with multiple layout options for showcasing visual content
 * Variants: grid, masonry, slider
 */

$style       = get_sub_field('gallery_style') ?: 'grid';
$headline    = get_sub_field('gal_headline');
$subheadline = get_sub_field('gal_subheadline');
$columns     = get_sub_field('gal_columns') ?: '3';
$images      = get_sub_field('gal_images');

if (!$images) return;

$placeholder = get_template_directory_uri() . '/assets/images/placeholder-16-9.svg';

// Grid column classes based on selection
$grid_col_classes = array(
    '2' => 'sm:grid-cols-2',
    '3' => 'sm:grid-cols-2 lg:grid-cols-3',
    '4' => 'sm:grid-cols-2 lg:grid-cols-4',
);
$grid_class = $grid_col_classes[$columns] ?? 'sm:grid-cols-2 lg:grid-cols-3';
?>

<section class="clesk-gallery clesk-section bg-[var(--color-background)]">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">

        <?php if ($headline || $subheadline) : ?>
            <div class="text-center max-w-3xl mx-auto mb-12">
                <?php if ($headline) : ?>
                    <h2 class="clesk-heading-2"><?php echo esc_html($headline); ?></h2>
                <?php endif; ?>
                <?php if ($subheadline) : ?>
                    <p class="mt-3 text-lg text-[var(--color-text-muted)]"><?php echo esc_html($subheadline); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($style === 'grid') : ?>

            <div class="grid grid-cols-2 <?php echo esc_attr($grid_class); ?> gap-4">
                <?php foreach ($images as $item) :
                    $image   = $item['gal_image'] ?? null;
                    $caption = $item['gal_caption'] ?? '';
                    $img_url = $image ? $image['url'] : $placeholder;
                    $img_alt = $image ? $image['alt'] : '';
                ?>
                    <div class="rounded-lg overflow-hidden">
                        <img src="<?php echo esc_url($img_url); ?>"
                             alt="<?php echo esc_attr($img_alt); ?>"
                             class="w-full aspect-square object-cover"
                             loading="lazy">
                        <?php if ($caption) : ?>
                            <div class="p-3 bg-[var(--color-surface)]">
                                <p class="text-sm text-[var(--color-text-muted)]"><?php echo esc_html($caption); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'masonry') : ?>

            <div class="columns-2 sm:columns-<?php echo esc_attr($columns); ?> gap-4">
                <?php foreach ($images as $item) :
                    $image   = $item['gal_image'] ?? null;
                    $caption = $item['gal_caption'] ?? '';
                    $img_url = $image ? $image['url'] : $placeholder;
                    $img_alt = $image ? $image['alt'] : '';
                ?>
                    <div class="mb-4 rounded-lg overflow-hidden break-inside-avoid">
                        <img src="<?php echo esc_url($img_url); ?>"
                             alt="<?php echo esc_attr($img_alt); ?>"
                             class="w-full h-auto"
                             loading="lazy">
                        <?php if ($caption) : ?>
                            <div class="p-3 bg-[var(--color-surface)]">
                                <p class="text-sm text-[var(--color-text-muted)]"><?php echo esc_html($caption); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'slider') : ?>

            <div class="overflow-x-auto flex gap-4 snap-x snap-mandatory pb-4"
                 style="-webkit-overflow-scrolling: touch; scrollbar-width: thin; scrollbar-color: var(--color-primary) var(--color-surface);">
                <?php foreach ($images as $item) :
                    $image   = $item['gal_image'] ?? null;
                    $caption = $item['gal_caption'] ?? '';
                    $img_url = $image ? $image['url'] : $placeholder;
                    $img_alt = $image ? $image['alt'] : '';
                ?>
                    <div class="snap-center flex-shrink-0 w-[80%] sm:w-[60%] lg:w-[40%]">
                        <div class="rounded-lg overflow-hidden">
                            <img src="<?php echo esc_url($img_url); ?>"
                                 alt="<?php echo esc_attr($img_alt); ?>"
                                 class="w-full aspect-video object-cover"
                                 loading="lazy">
                        </div>
                        <?php if ($caption) : ?>
                            <p class="mt-2 text-sm text-[var(--color-text-muted)]"><?php echo esc_html($caption); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</section>
