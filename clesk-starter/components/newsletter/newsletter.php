<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Newsletter
 * Description: Newsletter signup section with optional CF7 integration or static placeholder form
 * Variants: inline, centered, split
 */

$style        = get_sub_field('newsletter_style') ?: 'centered';
$headline     = get_sub_field('nl_headline');
$text         = get_sub_field('nl_text');
$placeholder  = get_sub_field('nl_placeholder') ?: 'Enter your email';
$button_text  = get_sub_field('nl_button_text') ?: 'Subscribe';
$cf7_shortcode = get_sub_field('nl_cf7_shortcode');
$privacy_text = get_sub_field('nl_privacy_text');
?>

<?php if ($style === 'inline') : ?>
    <!-- Inline Variant: Compact bar style -->
    <section class="clesk-newsletter clesk-section bg-[var(--color-surface)] py-6">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <?php if ($headline) : ?>
                        <h2 class="text-lg font-semibold text-[var(--color-heading)]"><?php echo esc_html($headline); ?></h2>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <p class="mt-1 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                </div>

                <div class="shrink-0 sm:w-auto w-full">
                    <?php if ($cf7_shortcode) : ?>
                        <?php echo do_shortcode(wp_kses_post($cf7_shortcode)); ?>
                    <?php else : ?>
                        <form action="#" class="flex gap-3">
                            <input type="email" placeholder="<?php echo esc_attr($placeholder); ?>" class="flex-1 px-4 py-3 rounded-lg border border-[var(--color-border)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]">
                            <button type="submit" class="clesk-btn-primary"><?php echo esc_html($button_text); ?></button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php elseif ($style === 'centered') : ?>
    <!-- Centered Variant: Full section, centered -->
    <section class="clesk-newsletter clesk-section bg-[var(--color-background)]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <?php if ($headline) : ?>
                    <h2 class="clesk-heading-2"><?php echo esc_html($headline); ?></h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <p class="mt-3 text-lg text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                <?php endif; ?>

                <div class="mt-8 max-w-md mx-auto">
                    <?php if ($cf7_shortcode) : ?>
                        <?php echo do_shortcode(wp_kses_post($cf7_shortcode)); ?>
                    <?php else : ?>
                        <form action="#" class="flex gap-3">
                            <input type="email" placeholder="<?php echo esc_attr($placeholder); ?>" class="flex-1 px-4 py-3 rounded-lg border border-[var(--color-border)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]">
                            <button type="submit" class="clesk-btn-primary"><?php echo esc_html($button_text); ?></button>
                        </form>
                    <?php endif; ?>
                </div>

                <?php if ($privacy_text) : ?>
                    <p class="mt-3 text-sm text-[var(--color-text-muted)]"><?php echo esc_html($privacy_text); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php else : ?>
    <!-- Split Variant: Two columns -->
    <section class="clesk-newsletter clesk-section bg-[var(--color-background)]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Text -->
                <div>
                    <?php if ($headline) : ?>
                        <h2 class="clesk-heading-2"><?php echo esc_html($headline); ?></h2>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <p class="mt-3 text-lg text-[var(--color-text-muted)] leading-relaxed"><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Right: Form -->
                <div>
                    <?php if ($cf7_shortcode) : ?>
                        <?php echo do_shortcode(wp_kses_post($cf7_shortcode)); ?>
                    <?php else : ?>
                        <form action="#" class="flex gap-3">
                            <input type="email" placeholder="<?php echo esc_attr($placeholder); ?>" class="flex-1 px-4 py-3 rounded-lg border border-[var(--color-border)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]">
                            <button type="submit" class="clesk-btn-primary"><?php echo esc_html($button_text); ?></button>
                        </form>
                    <?php endif; ?>

                    <?php if ($privacy_text) : ?>
                        <p class="mt-3 text-sm text-[var(--color-text-muted)]"><?php echo esc_html($privacy_text); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
