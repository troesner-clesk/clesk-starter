<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Features / Icon Grid
 * Description: Feature grid with icons, titles and descriptions
 * Variants: grid-3, grid-4, list, split, medium
 */

$style       = get_sub_field('features_style') ?: 'grid-3';
$headline    = get_sub_field('features_headline');
$subheadline = get_sub_field('features_subheadline');
$text        = get_sub_field('features_text');
$cta_text      = get_sub_field('features_cta_text');
$cta_link      = get_sub_field('features_cta_link');
$cta_link_opts = get_sub_field('features_cta_link_opts');
$items         = get_sub_field('features_items');

if (!$items) return;

$default_icons = array('blocks.svg', 'palette.svg', 'shield.svg', 'bolt.svg', 'code.svg', 'layers.svg');
?>

<?php if ($style === 'split') : ?>
    <!-- Split: Description Left, Icon Blocks Right -->
    <section class="clesk-features clesk-features--split clesk-section bg-[var(--color-background)]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <!-- Left: Description -->
                <div class="lg:sticky lg:top-24">
                    <?php if ($headline) : ?>
                        <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                    <?php endif; ?>

                    <?php if ($subheadline) : ?>
                        <p class="mt-3 text-lg text-[var(--color-text-muted)]"><?php echo wp_kses_post($subheadline); ?></p>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <div class="mt-5 clesk-body-text">
                            <?php echo wp_kses_post($text); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($cta_text && $cta_link) : ?>
                        <div class="mt-8">
                            <a href="<?php echo esc_url($cta_link); ?>" class="group inline-flex items-center gap-2 text-[var(--color-primary)] font-semibold hover:gap-3 transition-all"<?php echo clesk_link_attrs($cta_link_opts); ?>>
                                <?php echo esc_html($cta_text); ?>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Stacked Icon Blocks -->
                <div class="space-y-8">
                    <?php foreach ($items as $index => $item) :
                        $icon  = $item['feature_icon'] ?? null;
                        $title = $item['feature_title'] ?? '';
                        $desc  = $item['feature_text'] ?? '';
                        $fallback_icon = get_template_directory_uri() . '/assets/icons/' . $default_icons[$index % count($default_icons)];
                    ?>
                        <div class="flex gap-5 items-start">
                            <div class="flex-shrink-0 w-11 h-11 rounded-full border border-[var(--color-border)] bg-[var(--color-surface)] flex items-center justify-center">
                                <?php if ($icon) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>"
                                         alt="<?php echo esc_attr($icon['alt']); ?>"
                                         class="w-5 h-5 object-contain"
                                         loading="lazy">
                                <?php else : ?>
                                    <img src="<?php echo esc_url($fallback_icon); ?>"
                                         alt=""
                                         class="w-5 h-5 object-contain"
                                         loading="lazy">
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if ($title) : ?>
                                    <h3 class="text-base lg:text-lg font-semibold text-[var(--color-heading)]"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>
                                <?php if ($desc) : ?>
                                    <p class="mt-1 text-[var(--color-text-muted)]"><?php echo esc_html($desc); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

<?php elseif ($style === 'medium') : ?>
    <!-- Medium: Large Centered Description + Icon Grid -->
    <section class="clesk-features clesk-features--medium clesk-section bg-[var(--color-background)]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with larger text -->
            <div class="max-w-3xl mx-auto text-center mb-12 lg:mb-16">
                <?php if ($headline) : ?>
                    <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                <?php endif; ?>

                <?php if ($subheadline) : ?>
                    <p class="mt-3 text-lg text-[var(--color-text-muted)]"><?php echo wp_kses_post($subheadline); ?></p>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="mt-5 text-lg text-[var(--color-text)] leading-relaxed">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Icon blocks in 2-column grid -->
            <div class="grid sm:grid-cols-2 gap-8 lg:gap-12 max-w-4xl mx-auto">
                <?php foreach ($items as $index => $item) :
                    $icon  = $item['feature_icon'] ?? null;
                    $title = $item['feature_title'] ?? '';
                    $desc  = $item['feature_text'] ?? '';
                    $fallback_icon = get_template_directory_uri() . '/assets/icons/' . $default_icons[$index % count($default_icons)];
                ?>
                    <div class="flex gap-4 items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-[var(--color-primary-light)] flex items-center justify-center">
                            <?php if ($icon) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>"
                                     alt="<?php echo esc_attr($icon['alt']); ?>"
                                     class="w-5 h-5 object-contain"
                                     loading="lazy">
                            <?php else : ?>
                                <img src="<?php echo esc_url($fallback_icon); ?>"
                                     alt=""
                                     class="w-5 h-5 object-contain"
                                     loading="lazy">
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if ($title) : ?>
                                <h3 class="text-base font-semibold text-[var(--color-heading)]"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if ($desc) : ?>
                                <p class="mt-1 text-sm text-[var(--color-text-muted)]"><?php echo esc_html($desc); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($cta_text && $cta_link) : ?>
                <div class="mt-12 text-center">
                    <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary"<?php echo clesk_link_attrs($cta_link_opts); ?>><?php echo esc_html($cta_text); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php else : ?>
    <!-- Original variants: grid-3, grid-4, list -->
    <?php
    $grid_classes = 'grid gap-8';
    switch ($style) {
        case 'grid-4':
            $grid_classes .= ' sm:grid-cols-2 lg:grid-cols-4';
            break;
        case 'list':
            $grid_classes = 'space-y-6 max-w-3xl mx-auto';
            break;
        default: // grid-3
            $grid_classes .= ' sm:grid-cols-2 lg:grid-cols-3';
            break;
    }
    ?>

    <section class="clesk-features clesk-section bg-[var(--color-background)]">
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

            <div class="<?php echo esc_attr($grid_classes); ?>">
                <?php foreach ($items as $index => $item) :
                    $icon  = $item['feature_icon'] ?? null;
                    $title = $item['feature_title'] ?? '';
                    $desc  = $item['feature_text'] ?? '';
                    $fallback_icon = get_template_directory_uri() . '/assets/icons/' . $default_icons[$index % count($default_icons)];
                ?>
                    <?php if ($style === 'list') : ?>
                        <div class="flex gap-6 items-start">
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-[var(--color-primary-light)] flex items-center justify-center">
                                <?php if ($icon) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>"
                                         alt="<?php echo esc_attr($icon['alt']); ?>"
                                         class="w-6 h-6 object-contain"
                                         loading="lazy">
                                <?php else : ?>
                                    <img src="<?php echo esc_url($fallback_icon); ?>"
                                         alt=""
                                         class="w-6 h-6 object-contain text-[var(--color-primary)]"
                                         loading="lazy">
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if ($title) : ?>
                                    <h3 class="clesk-heading-3 text-lg"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>
                                <?php if ($desc) : ?>
                                    <p class="mt-1 text-[var(--color-text-muted)]"><?php echo esc_html($desc); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="text-center p-6 rounded-xl bg-[var(--color-surface)] hover:shadow-md transition-shadow duration-200">
                            <div class="mx-auto w-14 h-14 rounded-xl bg-[var(--color-primary-light)] flex items-center justify-center mb-4">
                                <?php if ($icon) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>"
                                         alt="<?php echo esc_attr($icon['alt']); ?>"
                                         class="w-7 h-7 object-contain"
                                         loading="lazy">
                                <?php else : ?>
                                    <img src="<?php echo esc_url($fallback_icon); ?>"
                                         alt=""
                                         class="w-7 h-7 object-contain text-[var(--color-primary)]"
                                         loading="lazy">
                                <?php endif; ?>
                            </div>

                            <?php if ($title) : ?>
                                <h3 class="clesk-heading-3 text-lg"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if ($desc) : ?>
                                <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($desc); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php if ($cta_text && $cta_link) : ?>
                <div class="mt-12 text-center">
                    <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary"<?php echo clesk_link_attrs($cta_link_opts); ?>><?php echo esc_html($cta_text); ?></a>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>
