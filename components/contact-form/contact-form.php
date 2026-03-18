<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Contact Form
 * Description: Contact form section with CF7 integration, optional contact info display
 * Variants: simple, split, with-info
 */

$style       = get_sub_field('contact_form_style') ?: 'simple';
$headline    = get_sub_field('cf_headline');
$subheadline = get_sub_field('cf_subheadline');
$text        = get_sub_field('cf_text');
$shortcode   = get_sub_field('cf_shortcode');
$phone       = get_sub_field('cf_phone');
$email       = get_sub_field('cf_email');
$address     = get_sub_field('cf_address');
$hours       = get_sub_field('cf_hours');
?>

<section class="clesk-contact-form clesk-section bg-[var(--color-background)]">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">

        <?php if ($style === 'simple') : ?>
            <!-- Simple Variant: Centered layout -->
            <div class="max-w-2xl mx-auto text-center">
                <?php if ($headline) : ?>
                    <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                <?php endif; ?>

                <?php if ($subheadline) : ?>
                    <p class="mt-3 text-lg text-[var(--color-text-muted)]"><?php echo wp_kses_post($subheadline); ?></p>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php if ($shortcode) : ?>
                    <div class="mt-8 text-left">
                        <?php echo do_shortcode(wp_kses_post($shortcode)); ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php elseif ($style === 'split') : ?>
            <!-- Split Variant: Two-column layout -->
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <!-- Left: Info -->
                <div>
                    <?php if ($headline) : ?>
                        <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <div class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                            <?php echo wp_kses_post($text); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($phone || $email || $address || $hours) : ?>
                        <div class="mt-8 space-y-4">
                            <?php if ($phone) : ?>
                                <div class="flex items-center gap-3 text-[var(--color-text)]">
                                    <svg class="w-6 h-6 shrink-0 text-[var(--color-primary)]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                                    <span><?php echo esc_html($phone); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($email) : ?>
                                <div class="flex items-center gap-3 text-[var(--color-text)]">
                                    <svg class="w-6 h-6 shrink-0 text-[var(--color-primary)]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 4L12 13 2 4"/></svg>
                                    <a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-[var(--color-primary)] transition-colors"><?php echo esc_html($email); ?></a>
                                </div>
                            <?php endif; ?>

                            <?php if ($address) : ?>
                                <div class="flex items-start gap-3 text-[var(--color-text)]">
                                    <svg class="w-6 h-6 shrink-0 text-[var(--color-primary)] mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <span><?php echo nl2br(esc_html($address)); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($hours) : ?>
                                <div class="flex items-center gap-3 text-[var(--color-text)]">
                                    <svg class="w-6 h-6 shrink-0 text-[var(--color-primary)]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <span><?php echo esc_html($hours); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Form -->
                <div>
                    <?php if ($shortcode) : ?>
                        <?php echo do_shortcode(wp_kses_post($shortcode)); ?>
                    <?php endif; ?>
                </div>
            </div>

        <?php else : ?>
            <!-- With-Info Variant: Form on top, info cards below -->
            <div class="max-w-2xl mx-auto text-center">
                <?php if ($headline) : ?>
                    <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                <?php endif; ?>

                <?php if ($subheadline) : ?>
                    <p class="mt-3 text-lg text-[var(--color-text-muted)]"><?php echo wp_kses_post($subheadline); ?></p>
                <?php endif; ?>

                <?php if ($shortcode) : ?>
                    <div class="mt-8 text-left">
                        <?php echo do_shortcode(wp_kses_post($shortcode)); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($phone || $email || $address || $hours) : ?>
                <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php if ($phone) : ?>
                        <div class="bg-[var(--color-surface)] rounded-xl p-6 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[var(--color-primary)]/10 text-[var(--color-primary)] mb-4">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-[var(--color-heading)] mb-1">Telefon</p>
                            <p class="text-[var(--color-text-muted)]"><?php echo esc_html($phone); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($email) : ?>
                        <div class="bg-[var(--color-surface)] rounded-xl p-6 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[var(--color-primary)]/10 text-[var(--color-primary)] mb-4">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 4L12 13 2 4"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-[var(--color-heading)] mb-1">E-Mail</p>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="text-[var(--color-text-muted)] hover:text-[var(--color-primary)] transition-colors"><?php echo esc_html($email); ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if ($address) : ?>
                        <div class="bg-[var(--color-surface)] rounded-xl p-6 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[var(--color-primary)]/10 text-[var(--color-primary)] mb-4">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-[var(--color-heading)] mb-1">Adresse</p>
                            <p class="text-[var(--color-text-muted)]"><?php echo nl2br(esc_html($address)); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($hours) : ?>
                        <div class="bg-[var(--color-surface)] rounded-xl p-6 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[var(--color-primary)]/10 text-[var(--color-primary)] mb-4">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-[var(--color-heading)] mb-1">Öffnungszeiten</p>
                            <p class="text-[var(--color-text-muted)]"><?php echo esc_html($hours); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</section>
