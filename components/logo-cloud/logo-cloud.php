<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Logo Cloud
 * Description: Display partner/client logos in various layouts
 * Variants: row, grid, marquee
 */

$style       = get_sub_field('logo_cloud_style') ?: 'row';
$headline    = get_sub_field('lc_headline');
$subheadline = get_sub_field('lc_subheadline');
$logos       = get_sub_field('lc_logos');

if (!$logos) return;

$placeholder_logo = get_template_directory_uri() . '/assets/images/placeholder-4-3.svg';
?>

<section class="clesk-logo-cloud clesk-section bg-[var(--color-background)]">
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

        <?php if ($style === 'row') : ?>

            <div class="flex flex-wrap items-center justify-center gap-8 lg:gap-12">
                <?php foreach ($logos as $logo_item) :
                    $logo = $logo_item['lc_logo'] ?? null;
                    $name = $logo_item['lc_name'] ?? '';
                    $link = $logo_item['lc_link'] ?? '';
                    $img_url = $logo ? $logo['url'] : $placeholder_logo;
                    $img_alt = $logo ? $logo['alt'] : $name;
                ?>
                    <?php if ($link) : ?>
                        <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer" class="block">
                    <?php endif; ?>
                        <img src="<?php echo esc_url($img_url); ?>"
                             alt="<?php echo esc_attr($img_alt); ?>"
                             class="max-h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300"
                             loading="lazy">
                    <?php if ($link) : ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'grid') : ?>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8">
                <?php foreach ($logos as $logo_item) :
                    $logo = $logo_item['lc_logo'] ?? null;
                    $name = $logo_item['lc_name'] ?? '';
                    $link = $logo_item['lc_link'] ?? '';
                    $img_url = $logo ? $logo['url'] : $placeholder_logo;
                    $img_alt = $logo ? $logo['alt'] : $name;
                ?>
                    <div class="flex items-center justify-center p-4">
                        <?php if ($link) : ?>
                            <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer" class="block">
                        <?php endif; ?>
                            <img src="<?php echo esc_url($img_url); ?>"
                                 alt="<?php echo esc_attr($img_alt); ?>"
                                 class="max-h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300"
                                 loading="lazy">
                        <?php if ($link) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'marquee') : ?>

            <?php $marquee_id = 'clesk-marquee-' . uniqid(); ?>

            <style>
                @keyframes <?php echo esc_attr($marquee_id); ?>-scroll {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
            </style>

            <div class="overflow-hidden">
                <div class="flex items-center gap-12"
                     style="animation: <?php echo esc_attr($marquee_id); ?>-scroll 20s linear infinite; width: max-content;">
                    <?php for ($repeat = 0; $repeat < 2; $repeat++) : ?>
                        <?php foreach ($logos as $logo_item) :
                            $logo = $logo_item['lc_logo'] ?? null;
                            $name = $logo_item['lc_name'] ?? '';
                            $link = $logo_item['lc_link'] ?? '';
                            $img_url = $logo ? $logo['url'] : $placeholder_logo;
                            $img_alt = $logo ? $logo['alt'] : $name;
                        ?>
                            <div class="flex-shrink-0 px-4">
                                <?php if ($link) : ?>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer" class="block">
                                <?php endif; ?>
                                    <img src="<?php echo esc_url($img_url); ?>"
                                         alt="<?php echo esc_attr($img_alt); ?>"
                                         class="max-h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300"
                                         loading="lazy">
                                <?php if ($link) : ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                </div>
            </div>

        <?php endif; ?>

    </div>
</section>
