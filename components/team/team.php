<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Team
 * Description: Team members display with photo, name, role, bio and social links
 * Variants: grid, cards, list
 */

$style       = get_sub_field('team_style') ?: 'grid';
$headline    = get_sub_field('team_headline');
$subheadline = get_sub_field('team_subheadline');
$members     = get_sub_field('team_members');

if (!$members) return;

$placeholder = get_template_directory_uri() . '/assets/images/placeholder-1-1.svg';
?>

<section class="clesk-team clesk-section bg-[var(--color-background)]">
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
            <!-- Grid Variant -->
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($members as $member) :
                    $photo = $member['team_photo'] ?? null;
                    $name  = $member['team_name'] ?? '';
                    $role  = $member['team_role'] ?? '';
                ?>
                    <div class="text-center">
                        <?php if ($photo) : ?>
                            <img src="<?php echo esc_url($photo['url']); ?>"
                                 alt="<?php echo esc_attr($photo['alt']); ?>"
                                 class="w-full aspect-square rounded-xl object-cover"
                                 loading="lazy">
                        <?php else : ?>
                            <img src="<?php echo esc_url($placeholder); ?>"
                                 alt=""
                                 class="w-full aspect-square rounded-xl object-cover"
                                 loading="lazy">
                        <?php endif; ?>

                        <?php if ($name) : ?>
                            <h3 class="clesk-heading-3 mt-4"><?php echo esc_html($name); ?></h3>
                        <?php endif; ?>

                        <?php if ($role) : ?>
                            <p class="mt-1 text-[var(--color-text-muted)]"><?php echo esc_html($role); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'cards') : ?>
            <!-- Cards Variant -->
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($members as $member) :
                    $photo    = $member['team_photo'] ?? null;
                    $name     = $member['team_name'] ?? '';
                    $role     = $member['team_role'] ?? '';
                    $bio      = $member['team_bio'] ?? '';
                    $email    = $member['team_email'] ?? '';
                    $linkedin = $member['team_linkedin'] ?? '';
                    $linkedin_opts = $member['team_linkedin_opts'] ?? array();
                ?>
                    <div class="bg-[var(--color-surface)] rounded-xl overflow-hidden">
                        <?php if ($photo) : ?>
                            <img src="<?php echo esc_url($photo['url']); ?>"
                                 alt="<?php echo esc_attr($photo['alt']); ?>"
                                 class="w-full aspect-square object-cover"
                                 loading="lazy">
                        <?php else : ?>
                            <img src="<?php echo esc_url($placeholder); ?>"
                                 alt=""
                                 class="w-full aspect-square object-cover"
                                 loading="lazy">
                        <?php endif; ?>

                        <div class="p-5">
                            <?php if ($name) : ?>
                                <h3 class="clesk-heading-3"><?php echo esc_html($name); ?></h3>
                            <?php endif; ?>

                            <?php if ($role) : ?>
                                <p class="mt-1 text-sm text-[var(--color-text-muted)]"><?php echo esc_html($role); ?></p>
                            <?php endif; ?>

                            <?php if ($bio) : ?>
                                <p class="mt-3 text-[var(--color-text-muted)]"><?php echo esc_html($bio); ?></p>
                            <?php endif; ?>

                            <?php if ($email || $linkedin) : ?>
                                <div class="mt-4 flex items-center gap-3">
                                    <?php if ($email) : ?>
                                        <a href="mailto:<?php echo esc_attr($email); ?>"
                                           class="text-[var(--color-text-muted)] hover:text-[var(--color-primary)] transition-colors"
                                           aria-label="<?php echo esc_attr($name); ?> per E-Mail kontaktieren">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="4" width="20" height="16" rx="2" />
                                                <path d="M22 4L12 13 2 4" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($linkedin) : ?>
                                        <a href="<?php echo esc_url($linkedin); ?>"
                                           class="text-[var(--color-text-muted)] hover:text-[var(--color-primary)] transition-colors"
                                           aria-label="<?php echo esc_attr($name); ?> auf LinkedIn"<?php echo clesk_link_attrs($linkedin_opts, array('new_tab' => true)); ?>>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else : ?>
            <!-- List Variant -->
            <div class="space-y-8 max-w-4xl mx-auto">
                <?php foreach ($members as $member) :
                    $photo    = $member['team_photo'] ?? null;
                    $name     = $member['team_name'] ?? '';
                    $role     = $member['team_role'] ?? '';
                    $bio      = $member['team_bio'] ?? '';
                    $email    = $member['team_email'] ?? '';
                    $linkedin = $member['team_linkedin'] ?? '';
                    $linkedin_opts = $member['team_linkedin_opts'] ?? array();
                ?>
                    <div class="flex gap-6 items-start">
                        <div class="flex-shrink-0">
                            <?php if ($photo) : ?>
                                <img src="<?php echo esc_url($photo['url']); ?>"
                                     alt="<?php echo esc_attr($photo['alt']); ?>"
                                     class="w-24 h-24 rounded-full object-cover"
                                     loading="lazy">
                            <?php else : ?>
                                <img src="<?php echo esc_url($placeholder); ?>"
                                     alt=""
                                     class="w-24 h-24 rounded-full object-cover"
                                     loading="lazy">
                            <?php endif; ?>
                        </div>

                        <div>
                            <?php if ($name) : ?>
                                <h3 class="clesk-heading-3"><?php echo esc_html($name); ?></h3>
                            <?php endif; ?>

                            <?php if ($role) : ?>
                                <p class="mt-1 text-sm text-[var(--color-text-muted)]"><?php echo esc_html($role); ?></p>
                            <?php endif; ?>

                            <?php if ($bio) : ?>
                                <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($bio); ?></p>
                            <?php endif; ?>

                            <?php if ($email || $linkedin) : ?>
                                <div class="mt-3 flex items-center gap-3">
                                    <?php if ($email) : ?>
                                        <a href="mailto:<?php echo esc_attr($email); ?>"
                                           class="text-[var(--color-text-muted)] hover:text-[var(--color-primary)] transition-colors"
                                           aria-label="<?php echo esc_attr($name); ?> per E-Mail kontaktieren">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="4" width="20" height="16" rx="2" />
                                                <path d="M22 4L12 13 2 4" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($linkedin) : ?>
                                        <a href="<?php echo esc_url($linkedin); ?>"
                                           class="text-[var(--color-text-muted)] hover:text-[var(--color-primary)] transition-colors"
                                           aria-label="<?php echo esc_attr($name); ?> auf LinkedIn"<?php echo clesk_link_attrs($linkedin_opts, array('new_tab' => true)); ?>>
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
