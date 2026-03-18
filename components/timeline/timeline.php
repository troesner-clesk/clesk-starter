<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Timeline
 * Description: Chronological timeline display for milestones, history or roadmap
 * Variants: vertical, alternating, horizontal
 */

$style       = get_sub_field('timeline_style') ?: 'vertical';
$headline    = get_sub_field('tl_headline');
$subheadline = get_sub_field('tl_subheadline');
$items       = get_sub_field('tl_items');

if (!$items) return;

$total_items = count($items);
?>

<section class="clesk-timeline clesk-section bg-[var(--color-background)]">
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

        <?php if ($style === 'vertical') : ?>
            <!-- Vertical Variant -->
            <div class="max-w-3xl mx-auto border-l-2 border-[var(--color-border)]">
                <?php foreach ($items as $index => $item) :
                    $date  = $item['tl_date'] ?? '';
                    $title = $item['tl_title'] ?? '';
                    $text  = $item['tl_text'] ?? '';
                ?>
                    <div class="relative pl-8 <?php echo $index < $total_items - 1 ? 'pb-10' : ''; ?>">
                        <!-- Dot -->
                        <div class="absolute left-0 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-[var(--color-primary)] border-4 border-[var(--color-background)]"></div>

                        <?php if ($date) : ?>
                            <span class="text-sm font-semibold text-[var(--color-primary)]"><?php echo esc_html($date); ?></span>
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <h3 class="clesk-heading-3 <?php echo $date ? 'mt-1' : ''; ?>"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($style === 'alternating') : ?>
            <!-- Alternating Variant -->
            <!-- Mobile: vertical fallback -->
            <div class="lg:hidden max-w-3xl mx-auto border-l-2 border-[var(--color-border)]">
                <?php foreach ($items as $index => $item) :
                    $date  = $item['tl_date'] ?? '';
                    $title = $item['tl_title'] ?? '';
                    $text  = $item['tl_text'] ?? '';
                ?>
                    <div class="relative pl-8 <?php echo $index < $total_items - 1 ? 'pb-10' : ''; ?>">
                        <div class="absolute left-0 top-1 -translate-x-1/2 w-4 h-4 rounded-full bg-[var(--color-primary)] border-4 border-[var(--color-background)]"></div>

                        <?php if ($date) : ?>
                            <span class="text-sm font-semibold text-[var(--color-primary)]"><?php echo esc_html($date); ?></span>
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <h3 class="clesk-heading-3 <?php echo $date ? 'mt-1' : ''; ?>"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Desktop: alternating layout -->
            <div class="hidden lg:block max-w-5xl mx-auto">
                <?php foreach ($items as $index => $item) :
                    $date  = $item['tl_date'] ?? '';
                    $title = $item['tl_title'] ?? '';
                    $text  = $item['tl_text'] ?? '';
                    $is_left = ($index % 2 === 0);
                ?>
                    <div class="grid grid-cols-[1fr_auto_1fr] gap-8 <?php echo $index < $total_items - 1 ? 'pb-10' : ''; ?>">
                        <?php if ($is_left) : ?>
                            <!-- Content left -->
                            <div class="text-right">
                                <?php if ($date) : ?>
                                    <span class="text-sm font-semibold text-[var(--color-primary)]"><?php echo esc_html($date); ?></span>
                                <?php endif; ?>

                                <?php if ($title) : ?>
                                    <h3 class="clesk-heading-3 <?php echo $date ? 'mt-1' : ''; ?>"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($text) : ?>
                                    <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Center dot + line -->
                            <div class="relative flex flex-col items-center">
                                <div class="w-4 h-4 rounded-full bg-[var(--color-primary)] border-4 border-[var(--color-background)] z-10"></div>
                                <?php if ($index < $total_items - 1) : ?>
                                    <div class="w-0.5 flex-1 bg-[var(--color-border)]"></div>
                                <?php endif; ?>
                            </div>

                            <!-- Empty right -->
                            <div></div>
                        <?php else : ?>
                            <!-- Empty left -->
                            <div></div>

                            <!-- Center dot + line -->
                            <div class="relative flex flex-col items-center">
                                <div class="w-4 h-4 rounded-full bg-[var(--color-primary)] border-4 border-[var(--color-background)] z-10"></div>
                                <?php if ($index < $total_items - 1) : ?>
                                    <div class="w-0.5 flex-1 bg-[var(--color-border)]"></div>
                                <?php endif; ?>
                            </div>

                            <!-- Content right -->
                            <div class="text-left">
                                <?php if ($date) : ?>
                                    <span class="text-sm font-semibold text-[var(--color-primary)]"><?php echo esc_html($date); ?></span>
                                <?php endif; ?>

                                <?php if ($title) : ?>
                                    <h3 class="clesk-heading-3 <?php echo $date ? 'mt-1' : ''; ?>"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($text) : ?>
                                    <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else : ?>
            <!-- Horizontal Variant -->
            <div class="overflow-x-auto pb-4">
                <div class="flex gap-8">
                    <?php foreach ($items as $index => $item) :
                        $date  = $item['tl_date'] ?? '';
                        $title = $item['tl_title'] ?? '';
                        $text  = $item['tl_text'] ?? '';
                    ?>
                        <div class="min-w-[250px] flex-shrink-0">
                            <!-- Dot + connector line -->
                            <div class="flex items-center mb-4">
                                <div class="w-4 h-4 rounded-full bg-[var(--color-primary)] border-4 border-[var(--color-background)] flex-shrink-0 z-10"></div>
                                <?php if ($index < $total_items - 1) : ?>
                                    <div class="flex-1 h-0.5 bg-[var(--color-border)]"></div>
                                <?php endif; ?>
                            </div>

                            <?php if ($date) : ?>
                                <span class="text-sm font-semibold text-[var(--color-primary)]"><?php echo esc_html($date); ?></span>
                            <?php endif; ?>

                            <?php if ($title) : ?>
                                <h3 class="clesk-heading-3 <?php echo $date ? 'mt-1' : ''; ?>"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if ($text) : ?>
                                <p class="mt-2 text-[var(--color-text-muted)]"><?php echo esc_html($text); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
