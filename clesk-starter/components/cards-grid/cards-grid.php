<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Cards Grid
 * Description: Responsive card grid with image, title, text, badge and link
 * Variants: two-columns, three-columns, four-columns
 */

$style       = get_sub_field('cards_grid_style') ?: 'three-columns';
$headline    = get_sub_field('cg_headline');
$subheadline = get_sub_field('cg_subheadline');
$cards       = get_sub_field('cg_cards');

if (!$cards) return;

// Grid columns based on style
$grid_classes = 'grid gap-8';
switch ($style) {
    case 'two-columns':
        $grid_classes .= ' sm:grid-cols-2';
        break;
    case 'four-columns':
        $grid_classes .= ' sm:grid-cols-2 lg:grid-cols-4';
        break;
    default: // three-columns
        $grid_classes .= ' sm:grid-cols-2 lg:grid-cols-3';
        break;
}

$placeholder = get_template_directory_uri() . '/assets/images/placeholder-16-9.svg';
?>

<section class="clesk-cards-grid clesk-section bg-[var(--color-background)]">
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

        <div class="<?php echo esc_attr($grid_classes); ?>">
            <?php foreach ($cards as $card) :
                $image     = $card['cg_image'] ?? null;
                $title     = $card['cg_title'] ?? '';
                $text      = $card['cg_text'] ?? '';
                $link_text = $card['cg_link_text'] ?? '';
                $link_url  = $card['cg_link_url'] ?? '';
                $badge     = $card['cg_badge'] ?? '';
            ?>
                <div class="bg-[var(--color-surface)] rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="relative">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"
                                 class="w-full aspect-video object-cover"
                                 loading="lazy">
                        <?php else : ?>
                            <img src="<?php echo esc_url($placeholder); ?>"
                                 alt=""
                                 class="w-full aspect-video object-cover"
                                 loading="lazy">
                        <?php endif; ?>

                        <?php if ($badge) : ?>
                            <span class="absolute top-3 right-3 bg-[var(--color-primary)] text-white text-xs px-2 py-1 rounded-full">
                                <?php echo esc_html($badge); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="p-5">
                        <?php if ($title) : ?>
                            <h3 class="clesk-heading-3"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>

                        <?php if ($link_text && $link_url) : ?>
                            <a href="<?php echo esc_url($link_url); ?>"
                               class="mt-4 inline-block text-[var(--color-primary)] font-medium hover:underline">
                                <?php echo esc_html($link_text); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
