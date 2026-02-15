<?php
if (!defined('ABSPATH')) exit;
/**
 * Auto-create default Contact Form 7 forms on theme activation
 *
 * Creates two forms:
 * - "Contact Form" (Name, Email, Subject, Message)
 * - "Newsletter Signup" (Email only)
 *
 * Only runs once and requires CF7 to be active.
 *
 * @package Clesk_Starter
 */

function clesk_create_default_cf7_forms() {
    // Only run if CF7 is active
    if (!class_exists('WPCF7_ContactForm')) {
        return;
    }

    // Only run once
    if (get_option('clesk_cf7_forms_created')) {
        return;
    }

    $forms = array();

    // 1. Contact Form
    $contact_form = WPCF7_ContactForm::get_template(array(
        'title' => __('Contact Form', 'clesk-starter'),
    ));

    if ($contact_form) {
        $contact_form->set_title(__('Contact Form', 'clesk-starter'));
        $contact_form->set_properties(array(
            'form' => '<p>[text* your-name placeholder "' . __('Your Name', 'clesk-starter') . '"]</p>
<p>[email* your-email placeholder "' . __('Your Email', 'clesk-starter') . '"]</p>
<p>[text your-subject placeholder "' . __('Subject', 'clesk-starter') . '"]</p>
<p>[textarea your-message placeholder "' . __('Your Message', 'clesk-starter') . '"]</p>
<p>[submit class:clesk-btn-primary "' . __('Send Message', 'clesk-starter') . '"]</p>',
            'mail' => array(
                'active'             => true,
                'subject'            => '[_site_title] – [your-subject]',
                'sender'             => '[_site_title] <[_site_admin_email]>',
                'recipient'          => '[_site_admin_email]',
                'body'               => __('From:', 'clesk-starter') . " [your-name] <[your-email]>\n" . __('Subject:', 'clesk-starter') . " [your-subject]\n\n[your-message]\n\n--\n" . __('Sent from', 'clesk-starter') . ' [_site_title] ([_site_url])',
                'additional_headers' => 'Reply-To: [your-email]',
                'attachments'        => '',
                'use_html'           => false,
                'exclude_blank'      => false,
            ),
        ));
        $contact_form->save();
        $forms['contact'] = $contact_form->id();
    }

    // 2. Newsletter Signup Form
    $newsletter_form = WPCF7_ContactForm::get_template(array(
        'title' => __('Newsletter Signup', 'clesk-starter'),
    ));

    if ($newsletter_form) {
        $newsletter_form->set_title(__('Newsletter Signup', 'clesk-starter'));
        $newsletter_form->set_properties(array(
            'form' => '<div class="flex flex-col sm:flex-row gap-3">[email* your-email placeholder "' . __('Enter your email', 'clesk-starter') . '"] [submit class:clesk-btn-primary "' . __('Subscribe', 'clesk-starter') . '"]</div>',
            'mail' => array(
                'active'             => true,
                'subject'            => '[_site_title] – ' . __('New Newsletter Signup', 'clesk-starter'),
                'sender'             => '[_site_title] <[_site_admin_email]>',
                'recipient'          => '[_site_admin_email]',
                'body'               => __('New newsletter signup:', 'clesk-starter') . "\n" . __('Email:', 'clesk-starter') . " [your-email]\n\n--\n" . __('From', 'clesk-starter') . ' [_site_title] ([_site_url])',
                'additional_headers' => '',
                'attachments'        => '',
                'use_html'           => false,
                'exclude_blank'      => false,
            ),
        ));
        $newsletter_form->save();
        $forms['newsletter'] = $newsletter_form->id();
    }

    // Store created form IDs and mark as done
    if (!empty($forms)) {
        update_option('clesk_cf7_default_forms', $forms);
        update_option('clesk_cf7_forms_created', true);
    }
}
add_action('after_switch_theme', 'clesk_create_default_cf7_forms');

// Also try on admin_init in case CF7 was activated after theme
function clesk_maybe_create_cf7_forms() {
    if (!get_option('clesk_cf7_forms_created') && class_exists('WPCF7_ContactForm')) {
        clesk_create_default_cf7_forms();
    }
}
add_action('admin_init', 'clesk_maybe_create_cf7_forms');
