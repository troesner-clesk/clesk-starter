<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Text + Image / Video
 * Description: Two-column section with text and image or video (YouTube or media library)
 * Variants: image-left, image-right
 */

$style        = get_sub_field('ti_layout') ?: 'image-right';
$headline     = get_sub_field('ti_headline');
$text         = get_sub_field('ti_text');
$media_type   = get_sub_field('ti_media_type') ?: 'image';
$image        = get_sub_field('ti_image');
$video_source = get_sub_field('ti_video_source') ?: 'file';
$video_file   = get_sub_field('ti_video_file');
$video_poster = get_sub_field('ti_video_poster');
$video_url    = get_sub_field('ti_video_url');
$aspect_ratio = get_sub_field('ti_video_aspect_ratio') ?: '16-9';
$cta_text     = get_sub_field('ti_cta_text');
$cta_link     = get_sub_field('ti_cta_link');

$image_order = ($style === 'image-left') ? 'lg:order-first' : 'lg:order-last';

$aspect_classes = array(
    '16-9' => 'aspect-video',
    '4-3'  => 'aspect-[4/3]',
    '1-1'  => 'aspect-square',
);
$aspect_class = isset($aspect_classes[$aspect_ratio]) ? $aspect_classes[$aspect_ratio] : 'aspect-video';
?>

<section class="clesk-text-image clesk-section bg-[var(--color-background)]">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Text -->
            <div>
                <?php if ($headline) : ?>
                    <h2 class="clesk-heading-2">
                        <?php echo wp_kses_post($headline); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="mt-4 clesk-body-text">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php if ($cta_text && $cta_link) : ?>
                    <div class="mt-6">
                        <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary">
                            <?php echo esc_html($cta_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Media (Image or Video) -->
            <div class="<?php echo esc_attr($image_order); ?>">
                <?php if ($media_type === 'video') : ?>
                    <?php if ($video_source === 'youtube' && $video_url) :
                        $embed_url = clesk_get_embed_url($video_url, 'youtube');
                    ?>
                        <?php if ($embed_url) : ?>
                            <div class="rounded-xl overflow-hidden shadow-md">
                                <iframe src="<?php echo esc_url($embed_url); ?>"
                                        class="w-full <?php echo esc_attr($aspect_class); ?>"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        loading="lazy"></iframe>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($video_source === 'file' && !empty($video_file['url'])) : ?>
                        <video class="w-full <?php echo esc_attr($aspect_class); ?> rounded-xl shadow-md object-cover"
                               controls
                               preload="metadata"
                               <?php if (!empty($video_poster['url'])) : ?>poster="<?php echo esc_url($video_poster['url']); ?>"<?php endif; ?>>
                            <source src="<?php echo esc_url($video_file['url']); ?>" type="<?php echo esc_attr(!empty($video_file['mime_type']) ? $video_file['mime_type'] : 'video/mp4'); ?>">
                        </video>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder-16-9.svg'); ?>"
                             alt="Placeholder"
                             class="rounded-xl shadow-md w-full h-auto"
                             loading="lazy">
                    <?php endif; ?>
                <?php else : ?>
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt']); ?>"
                             class="rounded-xl shadow-md w-full h-auto object-cover"
                             loading="lazy">
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder-4-3.svg'); ?>"
                             alt="Placeholder"
                             class="rounded-xl shadow-md w-full h-auto"
                             loading="lazy">
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
