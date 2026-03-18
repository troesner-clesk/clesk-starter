<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Steps / Process
 * Description: Step-by-step process display with numbered, icon or connector variants
 * Variants: numbered, icon, connector
 */

$style       = get_sub_field('steps_style') ?: 'numbered';
$headline    = get_sub_field('sp_headline');
$subheadline = get_sub_field('sp_subheadline');
$items       = get_sub_field('sp_items');

if (!$items) return;

$fallback_icon = get_template_directory_uri() . '/assets/icons/arrow-right.svg';
$total_items   = count($items);
?>

<section class="clesk-steps clesk-section bg-[var(--color-background)]">
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

        <?php if ($style === 'numbered') : ?>
            <!-- Numbered Variant -->
            <div class="lg:flex lg:gap-8 space-y-8 lg:space-y-0">
                <?php foreach ($items as $index => $item) :
                    $title = $item['sp_title'] ?? '';
                    $text  = $item['sp_text'] ?? '';
                ?>
                    <div class="flex-1 text-center">
                        <div class="w-12 h-12 rounded-full bg-[var(--color-primary)] text-white flex items-center justify-center text-xl font-bold mx-auto">
                            <?php echo esc_html($index + 1); ?>
                        </div>

                        <?php if ($title) : ?>
                            <h3 class="clesk-heading-3 mt-4"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'icon') : ?>
            <!-- Icon Variant -->
            <div class="lg:flex lg:gap-8 space-y-8 lg:space-y-0">
                <?php foreach ($items as $index => $item) :
                    $title = $item['sp_title'] ?? '';
                    $text  = $item['sp_text'] ?? '';
                    $icon  = $item['sp_icon'] ?? null;
                ?>
                    <div class="flex-1 text-center">
                        <div class="w-12 h-12 rounded-lg bg-[var(--color-primary-light)] flex items-center justify-center mx-auto">
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

                        <?php if ($title) : ?>
                            <h3 class="clesk-heading-3 mt-4"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else : ?>
            <!-- Connector Variant -->
            <div class="lg:flex lg:items-start space-y-8 lg:space-y-0">
                <?php foreach ($items as $index => $item) :
                    $title = $item['sp_title'] ?? '';
                    $text  = $item['sp_text'] ?? '';
                ?>
                    <div class="flex-1 text-center">
                        <div class="w-12 h-12 rounded-full bg-[var(--color-primary)] text-white flex items-center justify-center text-xl font-bold mx-auto">
                            <?php echo esc_html($index + 1); ?>
                        </div>

                        <?php if ($title) : ?>
                            <h3 class="clesk-heading-3 mt-4"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if ($index < $total_items - 1) : ?>
                        <div class="hidden lg:flex flex-shrink-0 self-center w-12">
                            <div class="flex-1 h-0.5 bg-[var(--color-border)] self-center"></div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
