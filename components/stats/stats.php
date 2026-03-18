<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Stats / Numbers
 * Description: Display key statistics and metrics in various layouts
 * Variants: inline, cards, icon-cards
 */

$style       = get_sub_field('stats_style') ?: 'inline';
$headline    = get_sub_field('st_headline');
$subheadline = get_sub_field('st_subheadline');
$items       = get_sub_field('st_items');

if (!$items) return;

$fallback_icon = get_template_directory_uri() . '/assets/icons/chart.svg';
?>

<section class="clesk-stats clesk-section bg-[var(--color-background)]">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">

        <?php if ($headline || $subheadline) : ?>
            <div class="text-center max-w-3xl mx-auto mb-12">
                <?php if ($headline) : ?>
                    <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                <?php endif; ?>
                <?php if ($subheadline) : ?>
                    <p class="mt-3 text-lg text-[var(--color-text-muted)]"><?php echo wp_kses_post($subheadline); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($style === 'inline') : ?>

            <div class="flex flex-wrap justify-center gap-8 lg:gap-16">
                <?php foreach ($items as $item) :
                    $number = $item['st_number'] ?? '';
                    $label  = $item['st_label'] ?? '';
                ?>
                    <div class="text-center">
                        <?php if ($number) : ?>
                            <p class="text-4xl font-bold text-[var(--color-primary)]"><?php echo esc_html($number); ?></p>
                        <?php endif; ?>
                        <?php if ($label) : ?>
                            <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($label); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'cards') : ?>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($items as $item) :
                    $number      = $item['st_number'] ?? '';
                    $label       = $item['st_label'] ?? '';
                    $description = $item['st_description'] ?? '';
                ?>
                    <div class="bg-[var(--color-surface)] rounded-xl p-6 text-center">
                        <?php if ($number) : ?>
                            <p class="text-4xl font-bold text-[var(--color-primary)]"><?php echo esc_html($number); ?></p>
                        <?php endif; ?>
                        <?php if ($label) : ?>
                            <p class="mt-2 font-semibold text-[var(--color-heading)]"><?php echo esc_html($label); ?></p>
                        <?php endif; ?>
                        <?php if ($description) : ?>
                            <p class="mt-1 text-sm text-[var(--color-text-muted)]"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'icon-cards') : ?>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($items as $item) :
                    $number      = $item['st_number'] ?? '';
                    $label       = $item['st_label'] ?? '';
                    $description = $item['st_description'] ?? '';
                    $icon        = $item['st_icon'] ?? null;
                ?>
                    <div class="bg-[var(--color-surface)] rounded-xl p-6 text-center">
                        <div class="mx-auto w-12 h-12 rounded-lg bg-[var(--color-primary-light)] flex items-center justify-center mb-4">
                            <?php if ($icon) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>"
                                     alt="<?php echo esc_attr($icon['alt']); ?>"
                                     class="w-6 h-6 object-contain"
                                     loading="lazy">
                            <?php else : ?>
                                <img src="<?php echo esc_url($fallback_icon); ?>"
                                     alt=""
                                     class="w-6 h-6 object-contain"
                                     loading="lazy">
                            <?php endif; ?>
                        </div>

                        <?php if ($number) : ?>
                            <p class="text-4xl font-bold text-[var(--color-primary)]"><?php echo esc_html($number); ?></p>
                        <?php endif; ?>
                        <?php if ($label) : ?>
                            <p class="mt-2 font-semibold text-[var(--color-heading)]"><?php echo esc_html($label); ?></p>
                        <?php endif; ?>
                        <?php if ($description) : ?>
                            <p class="mt-1 text-sm text-[var(--color-text-muted)]"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</section>
