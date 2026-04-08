<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Tabs
 * Description: Tabbed content sections with cards or image-text layouts
 * Variants: horizontal
 */

$style       = get_sub_field('tabs_style') ?: 'horizontal';
$headline    = get_sub_field('tabs_headline');
$subheadline = get_sub_field('tabs_subheadline');
$tabs        = get_sub_field('tabs_items');

if (!$tabs) return;

$uid = 'clesk-tabs-' . uniqid();
$fallback_icons = array('blocks.svg', 'palette.svg', 'shield.svg', 'bolt.svg', 'code.svg', 'layers.svg', 'chart.svg', 'users.svg', 'star.svg', 'clock.svg');
$placeholder_4_3 = get_template_directory_uri() . '/assets/images/placeholder-4-3.svg';
?>

<section class="clesk-tabs clesk-section bg-[var(--color-background)]">
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

        <!-- Tab Navigation -->
        <nav class="flex flex-wrap justify-center gap-x-2 gap-y-2 mb-8" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
            <?php foreach ($tabs as $index => $tab) :
                $tab_id   = $uid . '-tab-' . $index;
                $panel_id = $uid . '-panel-' . $index;
                $is_first = ($index === 0);
            ?>
                <button type="button"
                        class="py-3 px-5 inline-flex items-center gap-x-2 text-sm font-medium text-center rounded-lg text-[var(--color-text)] bg-[var(--color-surface)] hover:bg-[var(--color-primary-light)] transition-colors duration-200<?php echo $is_first ? ' active' : ''; ?>"
                        id="<?php echo esc_attr($tab_id); ?>"
                        aria-selected="<?php echo $is_first ? 'true' : 'false'; ?>"
                        aria-controls="<?php echo esc_attr($panel_id); ?>"
                        role="tab">
                    <?php echo esc_html($tab['tab_title']); ?>
                </button>
            <?php endforeach; ?>
        </nav>

        <!-- Tab Panels -->
        <div class="mt-3">
            <?php foreach ($tabs as $index => $tab) :
                $tab_id   = $uid . '-tab-' . $index;
                $panel_id = $uid . '-panel-' . $index;
                $is_first = ($index === 0);
                $layout   = $tab['tab_layout'] ?? 'cards';
            ?>
                <div id="<?php echo esc_attr($panel_id); ?>"
                     role="tabpanel"
                     aria-labelledby="<?php echo esc_attr($tab_id); ?>"
                     <?php echo !$is_first ? 'class="hidden"' : ''; ?>>

                    <?php if ($layout === 'cards') : ?>
                        <?php $cards = $tab['tab_cards'] ?? array(); ?>
                        <?php if ($cards) : ?>
                            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                <?php foreach ($cards as $ci => $card) :
                                    $icon  = $card['tab_card_icon'] ?? null;
                                    $title = $card['tab_card_title'] ?? '';
                                    $desc  = $card['tab_card_text'] ?? '';
                                    $fallback = get_template_directory_uri() . '/assets/icons/' . $fallback_icons[$ci % count($fallback_icons)];
                                ?>
                                    <div class="text-center p-6 rounded-xl bg-[var(--color-surface)] hover:shadow-md transition-shadow duration-200">
                                        <div class="mx-auto w-14 h-14 rounded-xl bg-[var(--color-primary-light)] flex items-center justify-center mb-4">
                                            <?php if ($icon) : ?>
                                                <img src="<?php echo esc_url($icon['url']); ?>"
                                                     alt="<?php echo esc_attr($icon['alt']); ?>"
                                                     class="w-7 h-7 object-contain"
                                                     loading="lazy">
                                            <?php else : ?>
                                                <img src="<?php echo esc_url($fallback); ?>"
                                                     alt=""
                                                     class="w-7 h-7 object-contain"
                                                     loading="lazy">
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($title) : ?>
                                            <h3 class="text-lg font-semibold text-[var(--color-heading)]"><?php echo esc_html($title); ?></h3>
                                        <?php endif; ?>
                                        <?php if ($desc) : ?>
                                            <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($desc); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    <?php elseif ($layout === 'image-text') : ?>
                        <?php
                        $image    = $tab['tab_image'] ?? null;
                        $position = $tab['tab_image_position'] ?? 'left';
                        $text     = $tab['tab_text'] ?? '';
                        ?>
                        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                            <div class="<?php echo $position === 'left' ? 'lg:order-last' : 'lg:order-first'; ?>">
                                <?php if ($text) : ?>
                                    <div class="clesk-body-text">
                                        <?php echo wp_kses_post($text); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="<?php echo $position === 'left' ? 'lg:order-first' : 'lg:order-last'; ?>">
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>"
                                         class="rounded-xl shadow-md w-full h-auto object-cover"
                                         loading="lazy">
                                <?php else : ?>
                                    <img src="<?php echo esc_url($placeholder_4_3); ?>"
                                         alt=""
                                         class="rounded-xl shadow-md w-full h-auto"
                                         loading="lazy">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    $cta_text      = $tab['tab_cta_text'] ?? '';
                    $cta_link      = $tab['tab_cta_link'] ?? '';
                    $cta_link_opts = $tab['tab_cta_link_opts'] ?? array();
                    if ($cta_text && $cta_link) : ?>
                        <div class="mt-8 text-center">
                            <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary"<?php echo clesk_link_attrs($cta_link_opts); ?>>
                                <?php echo esc_html($cta_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
