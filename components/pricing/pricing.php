<?php
if (!defined('ABSPATH')) exit;
/**
 * Component: Pricing
 * Description: Pricing plans display with features list, highlighted plan option and CTA buttons
 * Variants: two-columns, three-columns, comparison
 */

$style       = get_sub_field('pricing_style') ?: 'three-columns';
$headline    = get_sub_field('pr_headline');
$subheadline = get_sub_field('pr_subheadline');
$plans       = get_sub_field('pr_plans');

if (!$plans) return;

// Grid classes based on variant
switch ($style) {
    case 'two-columns':
        $grid_classes = 'grid gap-8 sm:grid-cols-2 max-w-4xl mx-auto';
        break;
    case 'comparison':
    case 'three-columns':
    default:
        $grid_classes = 'grid gap-8 sm:grid-cols-2 lg:grid-cols-3';
        break;
}
?>

<section class="clesk-pricing clesk-section bg-[var(--color-background)]">
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

        <!-- Pricing Cards -->
        <div class="<?php echo esc_attr($grid_classes); ?>">
            <?php foreach ($plans as $plan) :
                $name        = $plan['pr_plan_name'] ?? '';
                $price       = $plan['pr_plan_price'] ?? '';
                $currency    = $plan['pr_plan_currency'] ?? '';
                $period      = $plan['pr_plan_period'] ?? '';
                $description = $plan['pr_plan_description'] ?? '';
                $features    = $plan['pr_plan_features'] ?? '';
                $cta_text      = $plan['pr_plan_cta_text'] ?? '';
                $cta_link      = $plan['pr_plan_cta_link'] ?? '';
                $cta_link_opts = $plan['pr_plan_cta_link_opts'] ?? array();
                $highlighted   = !empty($plan['pr_plan_highlighted']);

                $feature_list = $features ? array_filter(array_map('trim', explode("\n", $features))) : [];

                if ($highlighted) {
                    $card_classes = 'relative bg-[var(--color-primary)] text-white rounded-xl p-8 shadow-xl scale-105';
                    $name_classes = 'text-xl font-bold text-white';
                    $price_classes = 'text-4xl font-bold text-white';
                    $currency_classes = 'text-white/80';
                    $period_classes = 'text-white/80';
                    $desc_classes = 'text-white/80';
                    $feature_text_classes = 'text-white/90';
                    $check_classes = 'text-white';
                    $btn_classes = 'inline-block w-full rounded-lg bg-white px-8 py-3 text-base font-semibold text-[var(--color-primary)] shadow-sm hover:bg-gray-100 transition-colors duration-200 text-center';
                } else {
                    $card_classes = 'bg-[var(--color-surface)] rounded-xl p-8 border border-[var(--color-border)]';
                    $name_classes = 'clesk-heading-3';
                    $price_classes = 'text-4xl font-bold text-[var(--color-heading)]';
                    $currency_classes = 'text-[var(--color-text-muted)]';
                    $period_classes = 'text-[var(--color-text-muted)]';
                    $desc_classes = 'text-[var(--color-text-muted)]';
                    $feature_text_classes = 'text-[var(--color-text)]';
                    $check_classes = 'text-[var(--color-primary)]';
                    $btn_classes = 'clesk-btn-primary w-full text-center';
                }
            ?>
                <div class="<?php echo esc_attr($card_classes); ?>">
                    <?php if ($highlighted) : ?>
                        <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[var(--color-secondary)] text-white text-sm px-4 py-1 rounded-full">Popular</span>
                    <?php endif; ?>

                    <?php if ($name) : ?>
                        <h3 class="<?php echo esc_attr($name_classes); ?>"><?php echo esc_html($name); ?></h3>
                    <?php endif; ?>

                    <?php if ($price) : ?>
                        <div class="mt-4 flex items-baseline gap-1">
                            <?php if ($currency) : ?>
                                <span class="<?php echo esc_attr($currency_classes); ?>"><?php echo esc_html($currency); ?></span>
                            <?php endif; ?>
                            <span class="<?php echo esc_attr($price_classes); ?>"><?php echo esc_html($price); ?></span>
                            <?php if ($period) : ?>
                                <span class="<?php echo esc_attr($period_classes); ?>">/ <?php echo esc_html($period); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($description) : ?>
                        <p class="mt-3 <?php echo esc_attr($desc_classes); ?>"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($feature_list)) : ?>
                        <ul class="mt-6 space-y-3">
                            <?php foreach ($feature_list as $feature) : ?>
                                <li class="flex items-start gap-2">
                                    <svg class="w-5 h-5 shrink-0 mt-0.5 <?php echo esc_attr($check_classes); ?>" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span class="<?php echo esc_attr($feature_text_classes); ?>"><?php echo esc_html($feature); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($cta_text && $cta_link) : ?>
                        <div class="mt-8">
                            <a href="<?php echo esc_url($cta_link); ?>" class="<?php echo esc_attr($btn_classes); ?>"<?php echo clesk_link_attrs($cta_link_opts); ?>>
                                <?php echo esc_html($cta_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($style === 'comparison') : ?>
            <!-- Comparison Table -->
            <div class="mt-16 max-w-4xl mx-auto">
                <?php
                // Collect all unique features across all plans
                $all_features = [];
                foreach ($plans as $plan) {
                    $features = $plan['pr_plan_features'] ?? '';
                    if ($features) {
                        $feature_list = array_filter(array_map('trim', explode("\n", $features)));
                        foreach ($feature_list as $feature) {
                            if (!in_array($feature, $all_features)) {
                                $all_features[] = $feature;
                            }
                        }
                    }
                }
                ?>

                <?php if (!empty($all_features)) : ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-[var(--color-border)]">
                                    <th class="py-4 pr-4 text-[var(--color-heading)] font-semibold">Features</th>
                                    <?php foreach ($plans as $plan) : ?>
                                        <th class="py-4 px-4 text-center text-[var(--color-heading)] font-semibold"><?php echo esc_html($plan['pr_plan_name'] ?? ''); ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_features as $feature) : ?>
                                    <tr class="border-b border-[var(--color-border)]">
                                        <td class="py-3 pr-4 text-[var(--color-text)]"><?php echo esc_html($feature); ?></td>
                                        <?php foreach ($plans as $plan) :
                                            $plan_features = $plan['pr_plan_features'] ?? '';
                                            $plan_feature_list = $plan_features ? array_filter(array_map('trim', explode("\n", $plan_features))) : [];
                                            $has_feature = in_array($feature, $plan_feature_list);
                                        ?>
                                            <td class="py-3 px-4 text-center">
                                                <?php if ($has_feature) : ?>
                                                    <svg class="w-5 h-5 mx-auto text-[var(--color-primary)]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                                <?php else : ?>
                                                    <span class="text-[var(--color-text-muted)]">&mdash;</span>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
