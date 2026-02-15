<?php if (!defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<?php
$header_variant = get_option('clesk_header_variant', 'default');
$body_extra     = '';

if ($header_variant === 'transparent') {
    $body_extra = ' has-transparent-header';
}
?>
<body <?php body_class('bg-[var(--color-background)] text-[var(--color-text)] font-[var(--font-body)]' . $body_extra); ?>>
<?php wp_body_open(); ?>

<?php get_template_part('template-parts/headers/header', $header_variant); ?>
