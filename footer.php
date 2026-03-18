<?php
if (!defined('ABSPATH')) exit;
$footer_variant = get_option('clesk_footer_variant', 'default');
get_template_part('template-parts/footers/footer', $footer_variant);
?>

<?php wp_footer(); ?>
</body>
</html>
