<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Blog Teaser
 * Description: Dynamic blog post listings pulled from WordPress via WP_Query
 * Variants: grid, list, featured
 */

$style        = get_sub_field('blog_teaser_style') ?: 'grid';
$headline     = get_sub_field('bt_headline');
$subheadline  = get_sub_field('bt_subheadline');
$posts_count  = get_sub_field('bt_posts_count') ?: 3;
$category     = get_sub_field('bt_category');
$show_date    = get_sub_field('bt_show_date');
$show_excerpt = get_sub_field('bt_show_excerpt');
$show_author  = get_sub_field('bt_show_author');
$cta_text      = get_sub_field('bt_cta_text');
$cta_link      = get_sub_field('bt_cta_link');
$cta_link_opts = get_sub_field('bt_cta_link_opts');

$placeholder  = get_template_directory_uri() . '/assets/images/placeholder-16-9.svg';

// Build WP_Query arguments
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => intval($posts_count) ?: 3,
    'post_status'    => 'publish',
);
if ($category) {
    $args['category_name'] = sanitize_text_field($category);
}
$query = new WP_Query($args);

if (!$query->have_posts()) {
    wp_reset_postdata();
    return;
}
?>

<section class="clesk-blog-teaser clesk-section bg-[var(--color-background)]">
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

        <?php if ($style === 'grid') : ?>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php while ($query->have_posts()) : $query->the_post();
                    $thumb_url  = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $placeholder;
                    $categories = get_the_category();
                ?>
                    <article class="bg-[var(--color-surface)] rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <img src="<?php echo esc_url($thumb_url); ?>"
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="w-full aspect-video object-cover"
                                 loading="lazy">
                            <?php if (!empty($categories)) : ?>
                                <span class="absolute top-3 left-3 bg-[var(--color-primary)] text-white text-xs px-2 py-1 rounded-full">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="p-5">
                            <h3 class="clesk-heading-3">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="hover:text-[var(--color-primary)] transition-colors">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h3>

                            <?php if ($show_excerpt) : ?>
                                <p class="mt-2 text-[var(--color-text-muted)] line-clamp-3"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <?php endif; ?>

                            <?php if ($show_date || $show_author) : ?>
                                <div class="mt-4 flex items-center gap-2 text-sm text-[var(--color-text-muted)]">
                                    <?php if ($show_date) : ?>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                                    <?php endif; ?>
                                    <?php if ($show_date && $show_author) : ?>
                                        <span>&middot;</span>
                                    <?php endif; ?>
                                    <?php if ($show_author) : ?>
                                        <span><?php echo esc_html(get_the_author()); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

        <?php elseif ($style === 'list') : ?>

            <div class="space-y-6">
                <?php while ($query->have_posts()) : $query->the_post();
                    $thumb_url  = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $placeholder;
                    $categories = get_the_category();
                ?>
                    <article class="flex gap-6 bg-[var(--color-surface)] rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="flex-shrink-0 w-48">
                            <img src="<?php echo esc_url($thumb_url); ?>"
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="w-full h-full aspect-video object-cover"
                                 loading="lazy">
                        </div>

                        <div class="flex flex-col justify-center py-4 pr-5">
                            <?php if (!empty($categories)) : ?>
                                <span class="text-xs font-medium text-[var(--color-primary)] mb-1">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>

                            <h3 class="clesk-heading-3">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="hover:text-[var(--color-primary)] transition-colors">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h3>

                            <?php if ($show_excerpt) : ?>
                                <p class="mt-2 text-[var(--color-text-muted)] line-clamp-2"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <?php endif; ?>

                            <?php if ($show_date || $show_author) : ?>
                                <div class="mt-3 flex items-center gap-2 text-sm text-[var(--color-text-muted)]">
                                    <?php if ($show_date) : ?>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                                    <?php endif; ?>
                                    <?php if ($show_date && $show_author) : ?>
                                        <span>&middot;</span>
                                    <?php endif; ?>
                                    <?php if ($show_author) : ?>
                                        <span><?php echo esc_html(get_the_author()); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

        <?php elseif ($style === 'featured') : ?>

            <?php
            $post_index = 0;
            $total_posts = $query->post_count;
            ?>

            <?php while ($query->have_posts()) : $query->the_post();
                $thumb_url  = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $placeholder;
                $categories = get_the_category();
            ?>

                <?php if ($post_index === 0) : ?>
                    <!-- Featured post (first post, full-width) -->
                    <article class="lg:grid lg:grid-cols-2 gap-8 bg-[var(--color-surface)] rounded-xl overflow-hidden hover:shadow-lg transition-shadow mb-8">
                        <div>
                            <img src="<?php echo esc_url($thumb_url); ?>"
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="w-full h-full object-cover"
                                 loading="lazy">
                        </div>

                        <div class="flex flex-col justify-center p-6 lg:p-8">
                            <?php if (!empty($categories)) : ?>
                                <span class="text-xs font-medium text-[var(--color-primary)] mb-2">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>

                            <h3 class="clesk-heading-2">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="hover:text-[var(--color-primary)] transition-colors">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h3>

                            <?php if ($show_excerpt) : ?>
                                <p class="mt-3 text-[var(--color-text-muted)]"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <?php endif; ?>

                            <?php if ($show_date || $show_author) : ?>
                                <div class="mt-4 flex items-center gap-2 text-sm text-[var(--color-text-muted)]">
                                    <?php if ($show_date) : ?>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                                    <?php endif; ?>
                                    <?php if ($show_date && $show_author) : ?>
                                        <span>&middot;</span>
                                    <?php endif; ?>
                                    <?php if ($show_author) : ?>
                                        <span><?php echo esc_html(get_the_author()); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>

                    <?php if ($total_posts > 1) : ?>
                    <!-- Remaining posts grid -->
                    <div class="grid gap-8 sm:grid-cols-2">
                    <?php endif; ?>

                <?php else : ?>
                    <!-- Secondary posts -->
                    <article class="bg-[var(--color-surface)] rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <img src="<?php echo esc_url($thumb_url); ?>"
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="w-full aspect-video object-cover"
                                 loading="lazy">
                            <?php if (!empty($categories)) : ?>
                                <span class="absolute top-3 left-3 bg-[var(--color-primary)] text-white text-xs px-2 py-1 rounded-full">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="p-5">
                            <h3 class="clesk-heading-3">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="hover:text-[var(--color-primary)] transition-colors">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h3>

                            <?php if ($show_excerpt) : ?>
                                <p class="mt-2 text-[var(--color-text-muted)] line-clamp-3"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <?php endif; ?>

                            <?php if ($show_date || $show_author) : ?>
                                <div class="mt-4 flex items-center gap-2 text-sm text-[var(--color-text-muted)]">
                                    <?php if ($show_date) : ?>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                                    <?php endif; ?>
                                    <?php if ($show_date && $show_author) : ?>
                                        <span>&middot;</span>
                                    <?php endif; ?>
                                    <?php if ($show_author) : ?>
                                        <span><?php echo esc_html(get_the_author()); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endif; ?>

            <?php
            $post_index++;
            endwhile; ?>

            <?php if ($total_posts > 1) : ?>
            </div>
            <?php endif; ?>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

        <?php if ($cta_text && $cta_link) : ?>
            <div class="text-center mt-8">
                <a href="<?php echo esc_url($cta_link); ?>" class="clesk-btn-primary"<?php echo clesk_link_attrs($cta_link_opts); ?>>
                    <?php echo esc_html($cta_text); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>
