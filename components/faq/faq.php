<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: FAQ / Accordion
 * Description: Expandable FAQ items using Preline's accordion
 * Variants: simple, bordered, two-columns, with-image
 */

$style       = get_sub_field('faq_style') ?: 'simple';
$headline    = get_sub_field('faq_headline');
$subheadline = get_sub_field('faq_subheadline');
$items       = get_sub_field('faq_items');
$image       = get_sub_field('faq_image');

if (!$items) return;

$accordion_id = 'clesk-faq-' . uniqid();
?>

<?php if ($style === 'with-image') : ?>
    <!-- With Image: Image left, Accordion right -->
    <section class="clesk-faq clesk-faq--with-image clesk-section bg-[var(--color-background)]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <!-- Left: Image -->
                <div class="relative">
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt']); ?>"
                             class="rounded-2xl shadow-lg w-full h-auto object-cover"
                             loading="lazy">
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder-4-3.svg'); ?>"
                             alt="Placeholder"
                             class="rounded-2xl shadow-lg w-full h-auto"
                             loading="lazy">
                    <?php endif; ?>
                </div>

                <!-- Right: Headline + Accordion -->
                <div>
                    <?php if ($headline || $subheadline) : ?>
                        <div class="mb-8">
                            <?php if ($headline) : ?>
                                <h2 class="clesk-heading-2"><?php echo wp_kses_post($headline); ?></h2>
                            <?php endif; ?>
                            <?php if ($subheadline) : ?>
                                <p class="mt-3 text-lg text-[var(--color-text-muted)]"><?php echo wp_kses_post($subheadline); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div>
                        <?php foreach ($items as $index => $item) :
                            $item_id = $accordion_id . '-' . $index;
                            $is_first = ($index === 0);
                        ?>
                            <div class="hs-accordion <?php echo esc_attr($is_first ? 'active' : ''); ?> border-b border-[var(--color-border)]"
                                 id="<?php echo esc_attr($item_id); ?>">
                                <button class="hs-accordion-toggle py-4 px-4 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-left text-[var(--color-heading)] hover:text-[var(--color-primary)] transition-colors"
                                        aria-expanded="<?php echo esc_attr($is_first ? 'true' : 'false'); ?>"
                                        aria-controls="<?php echo esc_attr($item_id . '-content'); ?>">
                                    <?php echo esc_html($item['faq_question']); ?>
                                    <svg class="hs-accordion-active:hidden block shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    <svg class="hs-accordion-active:block hidden shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                                </button>
                                <div id="<?php echo esc_attr($item_id . '-content'); ?>"
                                     class="hs-accordion-content <?php echo esc_attr($is_first ? '' : 'hidden'); ?> w-full overflow-hidden transition-[height] duration-300"
                                     role="region"
                                     aria-labelledby="<?php echo esc_attr($item_id); ?>">
                                    <div class="pb-4 px-4 text-[var(--color-text)] leading-relaxed">
                                        <?php echo wp_kses_post($item['faq_answer']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php else : ?>
    <!-- Original variants: simple, bordered, two-columns -->
    <section class="clesk-faq clesk-section bg-[var(--color-background)]">
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

            <?php
            $container_class = 'max-w-3xl mx-auto';
            if ($style === 'two-columns') {
                $container_class = 'grid md:grid-cols-2 gap-6';
            }
            ?>

            <div class="<?php echo esc_attr($container_class); ?>">
                <?php foreach ($items as $index => $item) :
                    $item_id = $accordion_id . '-' . $index;
                    $is_first = ($index === 0);

                    $wrapper_class = '';
                    if ($style === 'bordered') {
                        $wrapper_class = 'border border-[var(--color-border)] rounded-lg';
                    }
                ?>
                    <div class="hs-accordion <?php echo esc_attr($is_first ? 'active' : ''); ?> <?php echo esc_attr($wrapper_class); ?> <?php echo esc_attr(($style !== 'two-columns') ? 'border-b border-[var(--color-border)]' : ''); ?>"
                         id="<?php echo esc_attr($item_id); ?>">
                        <button class="hs-accordion-toggle py-4 px-4 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-left text-[var(--color-heading)] hover:text-[var(--color-primary)] transition-colors"
                                aria-expanded="<?php echo esc_attr($is_first ? 'true' : 'false'); ?>"
                                aria-controls="<?php echo esc_attr($item_id . '-content'); ?>">
                            <?php echo esc_html($item['faq_question']); ?>
                            <svg class="hs-accordion-active:hidden block shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            <svg class="hs-accordion-active:block hidden shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                        </button>
                        <div id="<?php echo esc_attr($item_id . '-content'); ?>"
                             class="hs-accordion-content <?php echo esc_attr($is_first ? '' : 'hidden'); ?> w-full overflow-hidden transition-[height] duration-300"
                             role="region"
                             aria-labelledby="<?php echo esc_attr($item_id); ?>">
                            <div class="pb-4 px-4 text-[var(--color-text)] leading-relaxed">
                                <?php echo wp_kses_post($item['faq_answer']); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
<?php endif; ?>
