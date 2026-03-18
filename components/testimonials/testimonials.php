<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Testimonials
 * Description: Customer testimonials with quotes, avatars and ratings
 * Variants: grid, single-quote, cards
 */

$style       = get_sub_field('testimonials_style') ?: 'grid';
$headline    = get_sub_field('tm_headline');
$subheadline = get_sub_field('tm_subheadline');
$items       = get_sub_field('tm_items');

if (!$items) return;

$placeholder_avatar = get_template_directory_uri() . '/assets/images/placeholder-1-1.svg';
?>

<section class="clesk-testimonials clesk-section bg-[var(--color-background)]">
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
                <?php foreach ($items as $item) :
                    $quote   = $item['tm_quote'] ?? '';
                    $name    = $item['tm_name'] ?? '';
                    $role    = $item['tm_role'] ?? '';
                    $company = $item['tm_company'] ?? '';
                    $avatar  = $item['tm_avatar'] ?? null;
                ?>
                    <div class="bg-[var(--color-surface)] rounded-xl p-6">
                        <?php if ($quote) : ?>
                            <p class="text-[var(--color-text)] leading-relaxed mb-6"><?php echo esc_html($quote); ?></p>
                        <?php endif; ?>

                        <div class="flex items-center gap-3">
                            <img src="<?php echo esc_url($avatar ? $avatar['url'] : $placeholder_avatar); ?>"
                                 alt="<?php echo esc_attr($avatar ? $avatar['alt'] : $name); ?>"
                                 class="w-12 h-12 rounded-full object-cover"
                                 loading="lazy">
                            <div>
                                <?php if ($name) : ?>
                                    <p class="font-bold text-[var(--color-heading)]"><?php echo esc_html($name); ?></p>
                                <?php endif; ?>
                                <?php if ($role || $company) : ?>
                                    <p class="text-sm text-[var(--color-text-muted)]">
                                        <?php
                                        $meta_parts = array_filter([$role, $company]);
                                        echo esc_html(implode(', ', $meta_parts));
                                        ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'single-quote') : ?>

            <?php
            $item    = $items[0];
            $quote   = $item['tm_quote'] ?? '';
            $name    = $item['tm_name'] ?? '';
            $role    = $item['tm_role'] ?? '';
            $company = $item['tm_company'] ?? '';
            $avatar  = $item['tm_avatar'] ?? null;
            ?>

            <div class="text-center max-w-3xl mx-auto">
                <?php if ($quote) : ?>
                    <blockquote class="text-xl leading-relaxed text-[var(--color-text)] mb-8">
                        &ldquo;<?php echo esc_html($quote); ?>&rdquo;
                    </blockquote>
                <?php endif; ?>

                <div class="flex flex-col items-center gap-3">
                    <img src="<?php echo esc_url($avatar ? $avatar['url'] : $placeholder_avatar); ?>"
                         alt="<?php echo esc_attr($avatar ? $avatar['alt'] : $name); ?>"
                         class="w-16 h-16 rounded-full object-cover"
                         loading="lazy">
                    <?php if ($name) : ?>
                        <p class="font-bold text-[var(--color-heading)]"><?php echo esc_html($name); ?></p>
                    <?php endif; ?>
                    <?php if ($role || $company) : ?>
                        <p class="text-sm text-[var(--color-text-muted)]">
                            <?php
                            $meta_parts = array_filter([$role, $company]);
                            echo esc_html(implode(', ', $meta_parts));
                            ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ($style === 'cards') : ?>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($items as $item) :
                    $quote   = $item['tm_quote'] ?? '';
                    $name    = $item['tm_name'] ?? '';
                    $role    = $item['tm_role'] ?? '';
                    $company = $item['tm_company'] ?? '';
                    $avatar  = $item['tm_avatar'] ?? null;
                    $rating  = intval($item['tm_rating'] ?? 5);
                ?>
                    <div class="bg-[var(--color-surface)] rounded-xl p-6 shadow-md">
                        <?php if ($rating) : ?>
                            <div class="flex gap-1 mb-4">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <span class="text-lg <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>">&#9733;</span>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($quote) : ?>
                            <p class="text-[var(--color-text)] leading-relaxed mb-6"><?php echo esc_html($quote); ?></p>
                        <?php endif; ?>

                        <div class="flex items-center gap-3 mt-auto">
                            <img src="<?php echo esc_url($avatar ? $avatar['url'] : $placeholder_avatar); ?>"
                                 alt="<?php echo esc_attr($avatar ? $avatar['alt'] : $name); ?>"
                                 class="w-12 h-12 rounded-full object-cover"
                                 loading="lazy">
                            <div>
                                <?php if ($name) : ?>
                                    <p class="font-bold text-[var(--color-heading)]"><?php echo esc_html($name); ?></p>
                                <?php endif; ?>
                                <?php if ($role || $company) : ?>
                                    <p class="text-sm text-[var(--color-text-muted)]">
                                        <?php
                                        $meta_parts = array_filter([$role, $company]);
                                        echo esc_html(implode(', ', $meta_parts));
                                        ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</section>
