<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Video
 * Description: Responsive video embed section with support for YouTube, Vimeo and self-hosted videos
 * Variants: simple, overlay, background
 */

/**
 * Convert YouTube/Vimeo URLs to privacy-friendly embed URLs
 */
if (!function_exists('clesk_get_embed_url')) :
function clesk_get_embed_url($url, $source) {
    if ($source === 'youtube') {
        preg_match('/(?:v=|\/embed\/|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $m);
        return !empty($m[1]) ? 'https://www.youtube-nocookie.com/embed/' . $m[1] : '';
    } elseif ($source === 'vimeo') {
        preg_match('/vimeo\.com\/(\d+)/', $url, $m);
        return !empty($m[1]) ? 'https://player.vimeo.com/video/' . $m[1] : '';
    }
    return $url;
}
endif;

$style          = get_sub_field('video_style') ?: 'simple';
$headline       = get_sub_field('vid_headline');
$subheadline    = get_sub_field('vid_subheadline');
$source         = get_sub_field('vid_source') ?: 'youtube';
$url            = get_sub_field('vid_url');
$thumbnail      = get_sub_field('vid_thumbnail');
$overlay_text   = get_sub_field('vid_overlay_text');
$overlay_cta    = get_sub_field('vid_overlay_cta_text');
$overlay_link   = get_sub_field('vid_overlay_cta_link');
$aspect_ratio   = get_sub_field('vid_aspect_ratio') ?: '16-9';

$placeholder    = get_template_directory_uri() . '/assets/images/placeholder-16-9.svg';
$embed_url      = ($source !== 'self-hosted') ? clesk_get_embed_url($url, $source) : $url;
$thumbnail_url  = $thumbnail ? $thumbnail['url'] : $placeholder;
$thumbnail_alt  = $thumbnail ? $thumbnail['alt'] : 'Video thumbnail';

// Aspect ratio Tailwind classes
$aspect_classes = array(
    '16-9' => 'aspect-video',
    '4-3'  => 'aspect-[4/3]',
    '21-9' => 'aspect-[21/9]',
);
$aspect_class = $aspect_classes[$aspect_ratio] ?? 'aspect-video';
?>

<?php if ($style === 'simple') : ?>

    <section class="clesk-video clesk-section bg-[var(--color-background)]">
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

            <div class="rounded-xl overflow-hidden">
                <?php if ($source === 'self-hosted' && $url) : ?>
                    <video class="w-full <?php echo esc_attr($aspect_class); ?> object-cover" controls loading="lazy">
                        <source src="<?php echo esc_url($url); ?>" type="video/mp4">
                    </video>
                <?php elseif ($embed_url) : ?>
                    <iframe src="<?php echo esc_url($embed_url); ?>"
                            class="w-full <?php echo esc_attr($aspect_class); ?>"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"></iframe>
                <?php endif; ?>
            </div>

        </div>
    </section>

<?php elseif ($style === 'overlay') : ?>

    <section class="clesk-video clesk-section bg-[var(--color-background)]">
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

            <div class="relative rounded-xl overflow-hidden cursor-pointer group <?php echo esc_attr($aspect_class); ?>"
                 <?php if ($source === 'self-hosted' && $url) : ?>
                     onclick="this.outerHTML='<video class=\'w-full <?php echo esc_attr($aspect_class); ?> rounded-xl\' controls autoplay><source src=\'<?php echo esc_url($url); ?>\' type=\'video/mp4\'></video>'"
                 <?php elseif ($embed_url) : ?>
                     onclick="this.outerHTML='<div class=\'rounded-xl overflow-hidden <?php echo esc_attr($aspect_class); ?>\'><iframe src=\'<?php echo esc_url($embed_url); ?>?autoplay=1\' class=\'w-full h-full\' frameborder=\'0\' allow=\'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\' allowfullscreen></iframe></div>'"
                 <?php endif; ?>>

                <img src="<?php echo esc_url($thumbnail_url); ?>"
                     alt="<?php echo esc_attr($thumbnail_alt); ?>"
                     class="absolute inset-0 w-full h-full object-cover"
                     loading="lazy">

                <!-- Play button overlay -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-20 h-20 bg-white/90 rounded-full flex items-center justify-center shadow-lg group-hover:bg-white transition-colors">
                        <svg class="w-8 h-8 text-[var(--color-primary)] ml-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php elseif ($style === 'background') : ?>

    <section class="clesk-video clesk-section relative overflow-hidden min-h-[60vh] flex items-center">

        <?php if ($source === 'self-hosted' && $url) : ?>
            <!-- Self-hosted background video -->
            <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline>
                <source src="<?php echo esc_url($url); ?>" type="video/mp4">
            </video>
        <?php else : ?>
            <!-- Thumbnail as background for YouTube/Vimeo -->
            <img src="<?php echo esc_url($thumbnail_url); ?>"
                 alt="<?php echo esc_attr($thumbnail_alt); ?>"
                 class="absolute inset-0 w-full h-full object-cover"
                 loading="lazy">
        <?php endif; ?>

        <!-- Dark overlay -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 w-full text-center py-16 lg:py-24">

            <?php if ($headline) : ?>
                <h2 class="clesk-heading-2 text-white"><?php echo esc_html($headline); ?></h2>
            <?php endif; ?>

            <?php if ($subheadline) : ?>
                <p class="mt-3 text-lg text-white/80"><?php echo esc_html($subheadline); ?></p>
            <?php endif; ?>

            <?php if ($overlay_text) : ?>
                <p class="mt-6 text-xl text-white max-w-2xl mx-auto"><?php echo esc_html($overlay_text); ?></p>
            <?php endif; ?>

            <?php if ($overlay_cta && $overlay_link) : ?>
                <div class="mt-8">
                    <a href="<?php echo esc_url($overlay_link); ?>" class="clesk-btn-primary">
                        <?php echo esc_html($overlay_cta); ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>

    </section>

<?php endif; ?>
