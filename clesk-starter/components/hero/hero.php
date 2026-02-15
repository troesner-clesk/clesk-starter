<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Hero
 * Description: Full-width hero section with headline, text and CTA button
 * Variants: centered, left-aligned, with-image, text-on-image, carousel, video-play
 */

$headline         = get_sub_field('hero_headline');
$subheadline      = get_sub_field('hero_subheadline');
$text             = get_sub_field('hero_text');
$image            = get_sub_field('hero_image');
$cta_text         = get_sub_field('hero_cta_text');
$cta_link         = get_sub_field('hero_cta_link');
$style            = get_sub_field('hero_style') ?: 'centered';
$carousel_images  = get_sub_field('hero_carousel_images');
$video_url        = get_sub_field('hero_video_url');
?>

<?php if ($style === 'text-on-image') : ?>
    <?php
    $bg_url = $image ? $image['url'] : '';
    ?>
    <section class="clesk-hero clesk-hero--text-on-image relative overflow-hidden">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative h-[28rem] md:h-[36rem] lg:h-[80vh] flex flex-col rounded-2xl overflow-hidden bg-cover bg-center bg-no-repeat"
                 <?php if ($bg_url) : ?>style="background-image: url('<?php echo esc_url($bg_url); ?>');"<?php endif; ?>>
                <!-- Dark overlay -->
                <div class="absolute inset-0 bg-black/40"></div>

                <!-- Content pinned to bottom-left -->
                <div class="relative mt-auto p-6 md:p-10 lg:p-14 max-w-2xl">
                    <?php if ($headline) : ?>
                        <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white">
                            <?php echo esc_html($headline); ?>
                        </h1>
                    <?php endif; ?>

                    <?php if ($subheadline) : ?>
                        <p class="mt-3 text-lg text-white/80">
                            <?php echo esc_html($subheadline); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($cta_text && $cta_link) : ?>
                        <div class="mt-6">
                            <a href="<?php echo esc_url($cta_link); ?>" class="inline-block rounded-lg bg-white px-6 py-3 text-sm font-semibold text-gray-900 shadow-sm hover:bg-white/90 transition-colors">
                                <?php echo esc_html($cta_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php elseif ($style === 'carousel') : ?>
    <section class="clesk-hero clesk-hero--carousel relative overflow-hidden bg-[var(--color-surface)] py-16 lg:py-24">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <?php if ($headline) : ?>
                    <h1 class="clesk-heading-1">
                        <?php echo esc_html($headline); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($subheadline) : ?>
                    <p class="mt-4 text-xl text-[var(--color-text-muted)]">
                        <?php echo esc_html($subheadline); ?>
                    </p>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="mt-6 clesk-body-text">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php if ($cta_text && $cta_link) : ?>
                    <div class="mt-8">
                        <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary">
                            <?php echo esc_html($cta_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($carousel_images && count($carousel_images) > 1) : ?>
                <div class="mt-12 lg:mt-16 clesk-hero-carousel overflow-hidden">
                    <div class="clesk-hero-carousel-track flex gap-6 animate-[clesk-scroll_30s_linear_infinite]">
                        <?php foreach ($carousel_images as $img) : ?>
                            <div class="flex-shrink-0 w-72 sm:w-80 lg:w-96">
                                <img src="<?php echo esc_url($img['url']); ?>"
                                     alt="<?php echo esc_attr($img['alt']); ?>"
                                     class="rounded-2xl shadow-lg w-full h-48 sm:h-56 lg:h-64 object-cover"
                                     loading="lazy">
                            </div>
                        <?php endforeach; ?>
                        <!-- Duplicate for seamless loop -->
                        <?php foreach ($carousel_images as $img) : ?>
                            <div class="flex-shrink-0 w-72 sm:w-80 lg:w-96">
                                <img src="<?php echo esc_url($img['url']); ?>"
                                     alt="<?php echo esc_attr($img['alt']); ?>"
                                     class="rounded-2xl shadow-lg w-full h-48 sm:h-56 lg:h-64 object-cover"
                                     loading="lazy">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php elseif ($style === 'video-play') : ?>
    <section class="clesk-hero clesk-hero--video-play relative overflow-hidden bg-[var(--color-surface)] py-16 lg:py-24">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <?php if ($headline) : ?>
                    <h1 class="clesk-heading-1">
                        <?php echo esc_html($headline); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($subheadline) : ?>
                    <p class="mt-4 text-xl text-[var(--color-text-muted)]">
                        <?php echo esc_html($subheadline); ?>
                    </p>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="mt-6 clesk-body-text">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php if ($cta_text && $cta_link) : ?>
                    <div class="mt-8">
                        <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary">
                            <?php echo esc_html($cta_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($image) : ?>
                <div class="mt-12 lg:mt-16 relative group max-w-4xl mx-auto">
                    <img src="<?php echo esc_url($image['url']); ?>"
                         alt="<?php echo esc_attr($image['alt']); ?>"
                         class="rounded-2xl shadow-xl w-full h-auto object-cover"
                         loading="lazy">

                    <?php if ($video_url) : ?>
                        <!-- Play button overlay -->
                        <button type="button"
                                class="clesk-video-play-btn absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/30 rounded-2xl transition-colors cursor-pointer"
                                data-video-url="<?php echo esc_attr($video_url); ?>"
                                aria-label="<?php esc_attr_e('Play video', 'clesk-starter'); ?>">
                            <span class="flex items-center justify-center w-16 h-16 md:w-20 md:h-20 rounded-full bg-white/90 shadow-lg group-hover:bg-white group-hover:scale-110 transition-all">
                                <svg class="w-6 h-6 md:w-8 md:h-8 text-[var(--color-primary)] ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </span>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php else : ?>
    <!-- Original variants: centered, left-aligned, with-image -->
    <section class="clesk-hero clesk-hero--<?php echo esc_attr($style); ?> relative overflow-hidden bg-[var(--color-surface)] py-16 lg:py-24">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">

            <?php if ($style === 'centered') : ?>
                <div class="text-center max-w-3xl mx-auto">
                    <?php if ($headline) : ?>
                        <h1 class="clesk-heading-1">
                            <?php echo esc_html($headline); ?>
                        </h1>
                    <?php endif; ?>

                    <?php if ($subheadline) : ?>
                        <p class="mt-4 text-xl text-[var(--color-text-muted)]">
                            <?php echo esc_html($subheadline); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <div class="mt-6 clesk-body-text">
                            <?php echo wp_kses_post($text); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($cta_text && $cta_link) : ?>
                        <div class="mt-8">
                            <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary">
                                <?php echo esc_html($cta_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

            <?php elseif ($style === 'left-aligned') : ?>
                <div class="max-w-3xl">
                    <?php if ($headline) : ?>
                        <h1 class="clesk-heading-1">
                            <?php echo esc_html($headline); ?>
                        </h1>
                    <?php endif; ?>

                    <?php if ($subheadline) : ?>
                        <p class="mt-4 text-xl text-[var(--color-text-muted)]">
                            <?php echo esc_html($subheadline); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <div class="mt-6 clesk-body-text">
                            <?php echo wp_kses_post($text); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($cta_text && $cta_link) : ?>
                        <div class="mt-8">
                            <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary">
                                <?php echo esc_html($cta_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

            <?php elseif ($style === 'with-image') : ?>
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <?php if ($headline) : ?>
                            <h1 class="clesk-heading-1">
                                <?php echo esc_html($headline); ?>
                            </h1>
                        <?php endif; ?>

                        <?php if ($subheadline) : ?>
                            <p class="mt-4 text-xl text-[var(--color-text-muted)]">
                                <?php echo esc_html($subheadline); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <div class="mt-6 clesk-body-text">
                                <?php echo wp_kses_post($text); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($cta_text && $cta_link) : ?>
                            <div class="mt-8">
                                <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary">
                                    <?php echo esc_html($cta_text); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="relative">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"
                                 class="rounded-xl shadow-lg w-full h-auto object-cover"
                                 loading="lazy">
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder-16-9.svg'); ?>"
                                 alt="Placeholder"
                                 class="rounded-xl shadow-lg w-full h-auto"
                                 loading="lazy">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>
