<?php
if (!defined('ABSPATH')) exit;
/**
 * SCF Flexible Content field definitions
 *
 * Only active components (via Theme Options) are registered as layouts.
 * Uses the same API as ACF (acf_add_local_field_group).
 *
 * @package Clesk_Starter
 */

if (function_exists('acf_add_local_field_group')) {

    $active_components = get_option('clesk_active_components', array());
    $all_layouts = array();

    // --- HERO ---
    $all_layouts['hero'] = array(
        'key' => 'layout_hero',
        'name' => 'hero',
        'label' => 'Hero Section',
        'display' => 'block',
        'sub_fields' => array(
            array(
                'key' => 'field_hero_style',
                'label' => 'Layout Style',
                'name' => 'hero_style',
                'type' => 'select',
                'choices' => array(
                    'centered'      => 'Centered',
                    'left-aligned'  => 'Left Aligned',
                    'text-on-image' => 'Text on Background Image',
                    'carousel'      => 'Image Carousel',
                    'video-play'    => 'Video Play Button',
                ),
                'default_value' => 'centered',
            ),
            array(
                'key' => 'field_hero_headline',
                'label' => 'Headline',
                'name' => 'hero_headline',
                'type' => 'text',
                            ),
            array(
                'key' => 'field_hero_subheadline',
                'label' => 'Subheadline',
                'name' => 'hero_subheadline',
                'type' => 'text',
            ),
            array(
                'key' => 'field_hero_text',
                'label' => 'Text',
                'name' => 'hero_text',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 1,
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Image',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'Used by: Centered (below text), Left Aligned (side by side), Text on Background Image, Video Play Button',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_hero_style',
                            'operator' => '==',
                            'value' => 'centered',
                        ),
                    ),
                    array(
                        array(
                            'field' => 'field_hero_style',
                            'operator' => '==',
                            'value' => 'left-aligned',
                        ),
                    ),
                    array(
                        array(
                            'field' => 'field_hero_style',
                            'operator' => '==',
                            'value' => 'text-on-image',
                        ),
                    ),
                    array(
                        array(
                            'field' => 'field_hero_style',
                            'operator' => '==',
                            'value' => 'video-play',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_hero_carousel_images',
                'label' => 'Carousel Images',
                'name' => 'hero_carousel_images',
                'type' => 'gallery',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'max' => 8,
                'instructions' => 'Add 2–8 images for the carousel. Recommended: landscape, same aspect ratio.',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_hero_style',
                            'operator' => '==',
                            'value' => 'carousel',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_hero_video_url',
                'label' => 'Video URL',
                'name' => 'hero_video_url',
                'type' => 'url',
                'instructions' => 'YouTube or Vimeo URL for the play button overlay.',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_hero_style',
                            'operator' => '==',
                            'value' => 'video-play',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_hero_cta_text',
                'label' => 'Button Text',
                'name' => 'hero_cta_text',
                'type' => 'text',
            ),
            array(
                'key' => 'field_hero_cta_link',
                'label' => 'Button Link',
                'name' => 'hero_cta_link',
                'type' => 'text',
                'placeholder' => 'https://… or #anchor',
            ),
            array(
                'key' => 'field_hero_cta_link_opts',
                'label' => 'Link Options',
                'name' => 'hero_cta_link_opts',
                'type' => 'checkbox',
                'layout' => 'horizontal',
                'choices' => array(
                    'new_tab'  => 'Open in new tab',
                    'nofollow' => 'Add rel="nofollow"',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'    => 'field_hero_cta_link',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),
        ),
    );

    // --- TEXT + IMAGE / VIDEO ---
    $all_layouts['text_image'] = array(
        'key' => 'layout_text_image',
        'name' => 'text_image',
        'label' => 'Text + Image / Video',
        'display' => 'block',
        'sub_fields' => array(
            array(
                'key' => 'field_ti_layout',
                'label' => 'Media Position',
                'name' => 'ti_layout',
                'type' => 'select',
                'choices' => array(
                    'image-left'  => 'Media Left',
                    'image-right' => 'Media Right',
                ),
                'default_value' => 'image-right',
            ),
            array(
                'key' => 'field_ti_headline',
                'label' => 'Headline',
                'name' => 'ti_headline',
                'type' => 'text',
            ),
            array(
                'key' => 'field_ti_text',
                'label' => 'Text',
                'name' => 'ti_text',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'delay' => 1,
            ),
            array(
                'key' => 'field_ti_media_type',
                'label' => 'Media Type',
                'name' => 'ti_media_type',
                'type' => 'select',
                'choices' => array(
                    'image' => 'Image',
                    'video' => 'Video',
                ),
                'default_value' => 'image',
            ),
            array(
                'key' => 'field_ti_image',
                'label' => 'Image',
                'name' => 'ti_image',
                'type' => 'image',
                'return_format' => 'array',
                'conditional_logic' => array(
                    array(
                        array('field' => 'field_ti_media_type', 'operator' => '==', 'value' => 'image'),
                    ),
                ),
            ),
            array(
                'key' => 'field_ti_video_source',
                'label' => 'Video Source',
                'name' => 'ti_video_source',
                'type' => 'select',
                'choices' => array(
                    'file'    => 'Media Library (self-hosted)',
                    'youtube' => 'YouTube',
                ),
                'default_value' => 'file',
                'conditional_logic' => array(
                    array(
                        array('field' => 'field_ti_media_type', 'operator' => '==', 'value' => 'video'),
                    ),
                ),
            ),
            array(
                'key' => 'field_ti_video_file',
                'label' => 'Video File',
                'name' => 'ti_video_file',
                'type' => 'file',
                'return_format' => 'array',
                'mime_types' => 'mp4,webm,mov',
                'conditional_logic' => array(
                    array(
                        array('field' => 'field_ti_media_type', 'operator' => '==', 'value' => 'video'),
                        array('field' => 'field_ti_video_source', 'operator' => '==', 'value' => 'file'),
                    ),
                ),
            ),
            array(
                'key' => 'field_ti_video_poster',
                'label' => 'Video Poster (optional)',
                'name' => 'ti_video_poster',
                'type' => 'image',
                'return_format' => 'array',
                'instructions' => 'Displayed before the video plays.',
                'conditional_logic' => array(
                    array(
                        array('field' => 'field_ti_media_type', 'operator' => '==', 'value' => 'video'),
                        array('field' => 'field_ti_video_source', 'operator' => '==', 'value' => 'file'),
                    ),
                ),
            ),
            array(
                'key' => 'field_ti_video_url',
                'label' => 'YouTube URL',
                'name' => 'ti_video_url',
                'type' => 'url',
                'placeholder' => 'https://www.youtube.com/watch?v=...',
                'conditional_logic' => array(
                    array(
                        array('field' => 'field_ti_media_type', 'operator' => '==', 'value' => 'video'),
                        array('field' => 'field_ti_video_source', 'operator' => '==', 'value' => 'youtube'),
                    ),
                ),
            ),
            array(
                'key' => 'field_ti_video_aspect_ratio',
                'label' => 'Video Aspect Ratio',
                'name' => 'ti_video_aspect_ratio',
                'type' => 'select',
                'choices' => array(
                    '16-9' => '16:9',
                    '4-3'  => '4:3',
                    '1-1'  => '1:1',
                ),
                'default_value' => '16-9',
                'conditional_logic' => array(
                    array(
                        array('field' => 'field_ti_media_type', 'operator' => '==', 'value' => 'video'),
                    ),
                ),
            ),
            array(
                'key' => 'field_ti_cta_text',
                'label' => 'Button Text',
                'name' => 'ti_cta_text',
                'type' => 'text',
            ),
            array(
                'key' => 'field_ti_cta_link',
                'label' => 'Button Link',
                'name' => 'ti_cta_link',
                'type' => 'text',
                'placeholder' => 'https://… or #anchor',
            ),
            array(
                'key' => 'field_ti_cta_link_opts',
                'label' => 'Link Options',
                'name' => 'ti_cta_link_opts',
                'type' => 'checkbox',
                'layout' => 'horizontal',
                'choices' => array(
                    'new_tab'  => 'Open in new tab',
                    'nofollow' => 'Add rel="nofollow"',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'    => 'field_ti_cta_link',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),
        ),
    );

    // --- CALL TO ACTION ---
    $all_layouts['cta'] = array(
        'key' => 'layout_cta',
        'name' => 'cta',
        'label' => 'Call to Action',
        'display' => 'block',
        'sub_fields' => array(
            array(
                'key' => 'field_cta_style',
                'label' => 'Style',
                'name' => 'cta_style',
                'type' => 'select',
                'choices' => array(
                    'simple'    => 'Simple',
                    'highlight' => 'Highlighted (Primary Color)',
                    'dark'      => 'Dark',
                ),
                'default_value' => 'simple',
            ),
            array(
                'key' => 'field_cta_headline',
                'label' => 'Headline',
                'name' => 'cta_headline',
                'type' => 'text',
                            ),
            array(
                'key' => 'field_cta_text',
                'label' => 'Text',
                'name' => 'cta_text',
                'type' => 'textarea',
            ),
            array(
                'key' => 'field_cta_button_text',
                'label' => 'Button Text',
                'name' => 'cta_button_text',
                'type' => 'text',
            ),
            array(
                'key' => 'field_cta_button_link',
                'label' => 'Button Link',
                'name' => 'cta_button_link',
                'type' => 'text',
                'placeholder' => 'https://… or #anchor',
            ),
            array(
                'key' => 'field_cta_button_link_opts',
                'label' => 'Link Options',
                'name' => 'cta_button_link_opts',
                'type' => 'checkbox',
                'layout' => 'horizontal',
                'choices' => array(
                    'new_tab'  => 'Open in new tab',
                    'nofollow' => 'Add rel="nofollow"',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'    => 'field_cta_button_link',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_cta_button_text_2',
                'label' => 'Secondary Button Text',
                'name' => 'cta_button_text_2',
                'type' => 'text',
            ),
            array(
                'key' => 'field_cta_button_link_2',
                'label' => 'Secondary Button Link',
                'name' => 'cta_button_link_2',
                'type' => 'text',
                'placeholder' => 'https://… or #anchor',
            ),
            array(
                'key' => 'field_cta_button_link_2_opts',
                'label' => 'Secondary Link Options',
                'name' => 'cta_button_link_2_opts',
                'type' => 'checkbox',
                'layout' => 'horizontal',
                'choices' => array(
                    'new_tab'  => 'Open in new tab',
                    'nofollow' => 'Add rel="nofollow"',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'    => 'field_cta_button_link_2',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),
        ),
    );

    // --- FAQ / ACCORDION ---
    $all_layouts['faq'] = array(
        'key' => 'layout_faq',
        'name' => 'faq',
        'label' => 'FAQ / Accordion',
        'display' => 'block',
        'sub_fields' => array(
            array(
                'key' => 'field_faq_style',
                'label' => 'Style',
                'name' => 'faq_style',
                'type' => 'select',
                'choices' => array(
                    'simple'      => 'Simple',
                    'bordered'    => 'Bordered',
                    'two-columns' => 'Two Columns',
                    'with-image'  => 'With Image',
                ),
                'default_value' => 'simple',
            ),
            array(
                'key' => 'field_faq_image',
                'label' => 'Image',
                'name' => 'faq_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => 'Image displayed on the left side of the accordion.',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_faq_style',
                            'operator' => '==',
                            'value' => 'with-image',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_faq_headline',
                'label' => 'Section Headline',
                'name' => 'faq_headline',
                'type' => 'text',
            ),
            array(
                'key' => 'field_faq_subheadline',
                'label' => 'Section Subheadline',
                'name' => 'faq_subheadline',
                'type' => 'text',
            ),
            array(
                'key' => 'field_faq_items',
                'label' => 'FAQ Items',
                'name' => 'faq_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Question',
                'sub_fields' => array(
                    array(
                        'key' => 'field_faq_item_question',
                        'label' => 'Question',
                        'name' => 'faq_question',
                        'type' => 'text',
                                            ),
                    array(
                        'key' => 'field_faq_item_answer',
                        'label' => 'Answer',
                        'name' => 'faq_answer',
                        'type' => 'wysiwyg',
                        'toolbar' => 'basic',
                        'media_upload' => 0,
                        'delay' => 1,
                    ),
                ),
            ),
        ),
    );

    // --- FEATURES / ICON GRID ---
    $all_layouts['features'] = array(
        'key' => 'layout_features',
        'name' => 'features',
        'label' => 'Features / Icon Grid',
        'display' => 'block',
        'sub_fields' => array(
            array(
                'key' => 'field_features_style',
                'label' => 'Layout',
                'name' => 'features_style',
                'type' => 'select',
                'choices' => array(
                    'grid-3'  => '3 Columns',
                    'grid-4'  => '4 Columns',
                    'list'    => 'List',
                    'split'   => 'Description Left, Icons Right',
                    'medium'  => 'Large Description + Icon Grid',
                ),
                'default_value' => 'grid-3',
            ),
            array(
                'key' => 'field_features_headline',
                'label' => 'Section Headline',
                'name' => 'features_headline',
                'type' => 'text',
            ),
            array(
                'key' => 'field_features_subheadline',
                'label' => 'Section Subheadline',
                'name' => 'features_subheadline',
                'type' => 'text',
            ),
            array(
                'key' => 'field_features_text',
                'label' => 'Description Text',
                'name' => 'features_text',
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 1,
                'instructions' => 'Longer description text. Used by: Split, Large Description variants.',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_features_style',
                            'operator' => '==',
                            'value' => 'split',
                        ),
                    ),
                    array(
                        array(
                            'field' => 'field_features_style',
                            'operator' => '==',
                            'value' => 'medium',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_features_cta_text',
                'label' => 'Link Text',
                'name' => 'features_cta_text',
                'type' => 'text',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_features_style',
                            'operator' => '==',
                            'value' => 'split',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_features_cta_link',
                'label' => 'Link URL',
                'name' => 'features_cta_link',
                'type' => 'text',
                'placeholder' => 'https://… or #anchor',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_features_style',
                            'operator' => '==',
                            'value' => 'split',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_features_cta_link_opts',
                'label' => 'Link Options',
                'name' => 'features_cta_link_opts',
                'type' => 'checkbox',
                'layout' => 'horizontal',
                'choices' => array(
                    'new_tab'  => 'Open in new tab',
                    'nofollow' => 'Add rel="nofollow"',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'    => 'field_features_cta_link',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_features_items',
                'label' => 'Features',
                'name' => 'features_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Feature',
                'sub_fields' => array(
                    array(
                        'key' => 'field_features_item_icon',
                        'label' => 'Icon (SVG or Image)',
                        'name' => 'feature_icon',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                    ),
                    array(
                        'key' => 'field_features_item_title',
                        'label' => 'Title',
                        'name' => 'feature_title',
                        'type' => 'text',
                                            ),
                    array(
                        'key' => 'field_features_item_text',
                        'label' => 'Description',
                        'name' => 'feature_text',
                        'type' => 'textarea',
                    ),
                ),
            ),
        ),
    );

    // --- TEXT BLOCK ---
    $all_layouts['text_block'] = array(
        'key' => 'layout_text_block',
        'name' => 'text_block',
        'label' => 'Text Block',
        'display' => 'block',
        'sub_fields' => array(
            array(
                'key' => 'field_tb_style',
                'label' => 'Width',
                'name' => 'tb_style',
                'type' => 'select',
                'choices' => array(
                    'normal' => 'Normal',
                    'narrow' => 'Narrow (reading width)',
                ),
                'default_value' => 'normal',
            ),
            array(
                'key' => 'field_tb_headline',
                'label' => 'Headline',
                'name' => 'tb_headline',
                'type' => 'text',
            ),
            array(
                'key' => 'field_tb_content',
                'label' => 'Content',
                'name' => 'tb_content',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 1,
            ),
        ),
    );

    // --- TESTIMONIALS ---
    $all_layouts['testimonials'] = array(
        'key' => 'layout_testimonials', 'name' => 'testimonials', 'label' => 'Testimonials', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_tm_style', 'label' => 'Style', 'name' => 'testimonials_style', 'type' => 'select', 'choices' => array('grid' => 'Grid', 'single-quote' => 'Single Quote', 'cards' => 'Cards'), 'default_value' => 'grid'),
            array('key' => 'field_tm_headline', 'label' => 'Headline', 'name' => 'tm_headline', 'type' => 'text'),
            array('key' => 'field_tm_subheadline', 'label' => 'Subheadline', 'name' => 'tm_subheadline', 'type' => 'text'),
            array('key' => 'field_tm_items', 'label' => 'Testimonials', 'name' => 'tm_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Testimonial', 'sub_fields' => array(
                array('key' => 'field_tm_item_quote', 'label' => 'Quote', 'name' => 'tm_quote', 'type' => 'textarea'),
                array('key' => 'field_tm_item_name', 'label' => 'Name', 'name' => 'tm_name', 'type' => 'text'),
                array('key' => 'field_tm_item_role', 'label' => 'Role', 'name' => 'tm_role', 'type' => 'text'),
                array('key' => 'field_tm_item_company', 'label' => 'Company', 'name' => 'tm_company', 'type' => 'text'),
                array('key' => 'field_tm_item_avatar', 'label' => 'Avatar', 'name' => 'tm_avatar', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
                array('key' => 'field_tm_item_rating', 'label' => 'Rating', 'name' => 'tm_rating', 'type' => 'select', 'choices' => array('5' => '5 Stars', '4' => '4 Stars', '3' => '3 Stars', '2' => '2 Stars', '1' => '1 Star'), 'default_value' => '5'),
            )),
        ),
    );

    // --- LOGO CLOUD ---
    $all_layouts['logo_cloud'] = array(
        'key' => 'layout_logo_cloud', 'name' => 'logo_cloud', 'label' => 'Logo Cloud', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_lc_style', 'label' => 'Style', 'name' => 'logo_cloud_style', 'type' => 'select', 'choices' => array('row' => 'Row', 'grid' => 'Grid', 'marquee' => 'Marquee'), 'default_value' => 'row'),
            array('key' => 'field_lc_headline', 'label' => 'Headline', 'name' => 'lc_headline', 'type' => 'text'),
            array('key' => 'field_lc_subheadline', 'label' => 'Subheadline', 'name' => 'lc_subheadline', 'type' => 'text'),
            array('key' => 'field_lc_logos', 'label' => 'Logos', 'name' => 'lc_logos', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Logo', 'sub_fields' => array(
                array('key' => 'field_lc_logo_image', 'label' => 'Logo', 'name' => 'lc_logo', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_lc_logo_name', 'label' => 'Company Name', 'name' => 'lc_name', 'type' => 'text'),
                array('key' => 'field_lc_logo_link', 'label' => 'Link', 'name' => 'lc_link', 'type' => 'url'),
                array(
                    'key' => 'field_lc_logo_link_opts',
                    'label' => 'Link Options',
                    'name' => 'lc_link_opts',
                    'type' => 'checkbox',
                    'layout' => 'horizontal',
                    'choices' => array(
                        'new_tab'  => 'Open in new tab',
                        'nofollow' => 'Add rel="nofollow"',
                    ),
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_lc_logo_link',
                                'operator' => '!=empty',
                            ),
                        ),
                    ),
                ),
            )),
        ),
    );

    // --- STATS ---
    $all_layouts['stats'] = array(
        'key' => 'layout_stats', 'name' => 'stats', 'label' => 'Statistics / Numbers', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_st_style', 'label' => 'Style', 'name' => 'stats_style', 'type' => 'select', 'choices' => array('inline' => 'Inline', 'cards' => 'Cards', 'icon-cards' => 'Icon Cards'), 'default_value' => 'inline'),
            array('key' => 'field_st_headline', 'label' => 'Headline', 'name' => 'st_headline', 'type' => 'text'),
            array('key' => 'field_st_subheadline', 'label' => 'Subheadline', 'name' => 'st_subheadline', 'type' => 'text'),
            array('key' => 'field_st_items', 'label' => 'Stats', 'name' => 'st_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Stat', 'sub_fields' => array(
                array('key' => 'field_st_item_number', 'label' => 'Number', 'name' => 'st_number', 'type' => 'text'),
                array('key' => 'field_st_item_label', 'label' => 'Label', 'name' => 'st_label', 'type' => 'text'),
                array('key' => 'field_st_item_description', 'label' => 'Description', 'name' => 'st_description', 'type' => 'text'),
                array('key' => 'field_st_item_icon', 'label' => 'Icon', 'name' => 'st_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
            )),
        ),
    );

    // --- SPACER / DIVIDER ---
    $all_layouts['spacer_divider'] = array(
        'key' => 'layout_spacer_divider', 'name' => 'spacer_divider', 'label' => 'Spacer / Divider', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_sd_style', 'label' => 'Style', 'name' => 'spacer_divider_style', 'type' => 'select', 'choices' => array('empty' => 'Empty Space', 'line' => 'Line', 'wave' => 'Wave'), 'default_value' => 'empty'),
            array('key' => 'field_sd_height', 'label' => 'Height', 'name' => 'sd_height', 'type' => 'select', 'choices' => array('sm' => 'Small (2rem)', 'md' => 'Medium (4rem)', 'lg' => 'Large (6rem)', 'xl' => 'Extra Large (8rem)'), 'default_value' => 'md'),
            array('key' => 'field_sd_line_width', 'label' => 'Line Width', 'name' => 'sd_line_width', 'type' => 'select', 'choices' => array('narrow' => 'Narrow (50%)', 'medium' => 'Medium (75%)', 'full' => 'Full (100%)'), 'default_value' => 'medium', 'conditional_logic' => array(array(array('field' => 'field_sd_style', 'operator' => '==', 'value' => 'line')))),
            array('key' => 'field_sd_wave_color', 'label' => 'Wave Color', 'name' => 'sd_wave_color', 'type' => 'select', 'choices' => array('primary' => 'Primary', 'surface' => 'Surface', 'dark' => 'Dark'), 'default_value' => 'primary', 'conditional_logic' => array(array(array('field' => 'field_sd_style', 'operator' => '==', 'value' => 'wave')))),
        ),
    );

    // --- BANNER ---
    $all_layouts['banner'] = array(
        'key' => 'layout_banner', 'name' => 'banner', 'label' => 'Banner / Notice', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_bn_style', 'label' => 'Style', 'name' => 'banner_style', 'type' => 'select', 'choices' => array('info' => 'Info', 'warning' => 'Warning', 'promo' => 'Promo'), 'default_value' => 'info'),
            array('key' => 'field_bn_text', 'label' => 'Text', 'name' => 'bn_text', 'type' => 'text'),
            array('key' => 'field_bn_cta_text', 'label' => 'Button Text', 'name' => 'bn_cta_text', 'type' => 'text'),
            array('key' => 'field_bn_cta_link', 'label' => 'Button Link', 'name' => 'bn_cta_link', 'type' => 'text', 'placeholder' => 'https://… or #anchor'),
            array(
                'key' => 'field_bn_cta_link_opts',
                'label' => 'Link Options',
                'name' => 'bn_cta_link_opts',
                'type' => 'checkbox',
                'layout' => 'horizontal',
                'choices' => array(
                    'new_tab'  => 'Open in new tab',
                    'nofollow' => 'Add rel="nofollow"',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'    => 'field_bn_cta_link',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),
            array('key' => 'field_bn_dismissible', 'label' => 'Dismissible', 'name' => 'bn_dismissible', 'type' => 'true_false', 'default_value' => 0),
        ),
    );

    // --- CARDS GRID ---
    $all_layouts['cards_grid'] = array(
        'key' => 'layout_cards_grid', 'name' => 'cards_grid', 'label' => 'Cards Grid', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_cg_style', 'label' => 'Columns', 'name' => 'cards_grid_style', 'type' => 'select', 'choices' => array('two-columns' => '2 Columns', 'three-columns' => '3 Columns', 'four-columns' => '4 Columns'), 'default_value' => 'three-columns'),
            array('key' => 'field_cg_headline', 'label' => 'Headline', 'name' => 'cg_headline', 'type' => 'text'),
            array('key' => 'field_cg_subheadline', 'label' => 'Subheadline', 'name' => 'cg_subheadline', 'type' => 'text'),
            array('key' => 'field_cg_cards', 'label' => 'Cards', 'name' => 'cg_cards', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Card', 'sub_fields' => array(
                array('key' => 'field_cg_card_image', 'label' => 'Image', 'name' => 'cg_image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_cg_card_title', 'label' => 'Title', 'name' => 'cg_title', 'type' => 'text'),
                array('key' => 'field_cg_card_text', 'label' => 'Text', 'name' => 'cg_text', 'type' => 'textarea'),
                array('key' => 'field_cg_card_link_text', 'label' => 'Link Text', 'name' => 'cg_link_text', 'type' => 'text'),
                array('key' => 'field_cg_card_link_url', 'label' => 'Link URL', 'name' => 'cg_link_url', 'type' => 'text', 'placeholder' => 'https://… or #anchor'),
                array(
                    'key' => 'field_cg_card_link_url_opts',
                    'label' => 'Link Options',
                    'name' => 'cg_link_url_opts',
                    'type' => 'checkbox',
                    'layout' => 'horizontal',
                    'choices' => array(
                        'new_tab'  => 'Open in new tab',
                        'nofollow' => 'Add rel="nofollow"',
                    ),
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_cg_card_link_url',
                                'operator' => '!=empty',
                            ),
                        ),
                    ),
                ),
                array('key' => 'field_cg_card_badge', 'label' => 'Badge', 'name' => 'cg_badge', 'type' => 'text'),
            )),
        ),
    );

    // --- TEAM ---
    $all_layouts['team'] = array(
        'key' => 'layout_team', 'name' => 'team', 'label' => 'Team', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_team_style', 'label' => 'Style', 'name' => 'team_style', 'type' => 'select', 'choices' => array('grid' => 'Grid', 'cards' => 'Cards', 'list' => 'List'), 'default_value' => 'grid'),
            array('key' => 'field_team_headline', 'label' => 'Headline', 'name' => 'team_headline', 'type' => 'text'),
            array('key' => 'field_team_subheadline', 'label' => 'Subheadline', 'name' => 'team_subheadline', 'type' => 'text'),
            array('key' => 'field_team_members', 'label' => 'Members', 'name' => 'team_members', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Member', 'sub_fields' => array(
                array('key' => 'field_team_member_name', 'label' => 'Name', 'name' => 'team_name', 'type' => 'text'),
                array('key' => 'field_team_member_role', 'label' => 'Role', 'name' => 'team_role', 'type' => 'text'),
                array('key' => 'field_team_member_photo', 'label' => 'Photo', 'name' => 'team_photo', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_team_member_bio', 'label' => 'Bio', 'name' => 'team_bio', 'type' => 'textarea'),
                array('key' => 'field_team_member_email', 'label' => 'Email', 'name' => 'team_email', 'type' => 'text'),
                array('key' => 'field_team_member_linkedin', 'label' => 'LinkedIn', 'name' => 'team_linkedin', 'type' => 'url'),
                array(
                    'key' => 'field_team_member_linkedin_opts',
                    'label' => 'Link Options',
                    'name' => 'team_linkedin_opts',
                    'type' => 'checkbox',
                    'layout' => 'horizontal',
                    'choices' => array(
                        'new_tab'  => 'Open in new tab',
                        'nofollow' => 'Add rel="nofollow"',
                    ),
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_team_member_linkedin',
                                'operator' => '!=empty',
                            ),
                        ),
                    ),
                ),
            )),
        ),
    );

    // --- STEPS ---
    $all_layouts['steps'] = array(
        'key' => 'layout_steps', 'name' => 'steps', 'label' => 'Steps / Process', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_sp_style', 'label' => 'Style', 'name' => 'steps_style', 'type' => 'select', 'choices' => array('numbered' => 'Numbered', 'icon' => 'Icon', 'connector' => 'Connector'), 'default_value' => 'numbered'),
            array('key' => 'field_sp_headline', 'label' => 'Headline', 'name' => 'sp_headline', 'type' => 'text'),
            array('key' => 'field_sp_subheadline', 'label' => 'Subheadline', 'name' => 'sp_subheadline', 'type' => 'text'),
            array('key' => 'field_sp_items', 'label' => 'Steps', 'name' => 'sp_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step', 'sub_fields' => array(
                array('key' => 'field_sp_item_title', 'label' => 'Title', 'name' => 'sp_title', 'type' => 'text'),
                array('key' => 'field_sp_item_text', 'label' => 'Description', 'name' => 'sp_text', 'type' => 'textarea'),
                array('key' => 'field_sp_item_icon', 'label' => 'Icon', 'name' => 'sp_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
            )),
        ),
    );

    // --- TIMELINE ---
    $all_layouts['timeline'] = array(
        'key' => 'layout_timeline', 'name' => 'timeline', 'label' => 'Timeline', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_tl_style', 'label' => 'Style', 'name' => 'timeline_style', 'type' => 'select', 'choices' => array('vertical' => 'Vertical', 'alternating' => 'Alternating', 'horizontal' => 'Horizontal'), 'default_value' => 'vertical'),
            array('key' => 'field_tl_headline', 'label' => 'Headline', 'name' => 'tl_headline', 'type' => 'text'),
            array('key' => 'field_tl_subheadline', 'label' => 'Subheadline', 'name' => 'tl_subheadline', 'type' => 'text'),
            array('key' => 'field_tl_items', 'label' => 'Events', 'name' => 'tl_items', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Event', 'sub_fields' => array(
                array('key' => 'field_tl_item_date', 'label' => 'Date', 'name' => 'tl_date', 'type' => 'text'),
                array('key' => 'field_tl_item_title', 'label' => 'Title', 'name' => 'tl_title', 'type' => 'text'),
                array('key' => 'field_tl_item_text', 'label' => 'Description', 'name' => 'tl_text', 'type' => 'textarea'),
                array('key' => 'field_tl_item_icon', 'label' => 'Icon', 'name' => 'tl_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
            )),
        ),
    );

    // --- VIDEO ---
    $all_layouts['video'] = array(
        'key' => 'layout_video', 'name' => 'video', 'label' => 'Video Embed', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_vid_style', 'label' => 'Style', 'name' => 'video_style', 'type' => 'select', 'choices' => array('simple' => 'Simple', 'overlay' => 'Overlay', 'background' => 'Background'), 'default_value' => 'simple'),
            array('key' => 'field_vid_headline', 'label' => 'Headline', 'name' => 'vid_headline', 'type' => 'text'),
            array('key' => 'field_vid_subheadline', 'label' => 'Subheadline', 'name' => 'vid_subheadline', 'type' => 'text'),
            array('key' => 'field_vid_source', 'label' => 'Source', 'name' => 'vid_source', 'type' => 'select', 'choices' => array('youtube' => 'YouTube', 'vimeo' => 'Vimeo', 'self-hosted' => 'Self-hosted'), 'default_value' => 'youtube'),
            array('key' => 'field_vid_url', 'label' => 'Video URL', 'name' => 'vid_url', 'type' => 'url'),
            array('key' => 'field_vid_thumbnail', 'label' => 'Thumbnail', 'name' => 'vid_thumbnail', 'type' => 'image', 'return_format' => 'array'),
            array('key' => 'field_vid_overlay_text', 'label' => 'Overlay Text', 'name' => 'vid_overlay_text', 'type' => 'text', 'conditional_logic' => array(array(array('field' => 'field_vid_style', 'operator' => '==', 'value' => 'background')))),
            array('key' => 'field_vid_overlay_cta_text', 'label' => 'Overlay Button Text', 'name' => 'vid_overlay_cta_text', 'type' => 'text', 'conditional_logic' => array(array(array('field' => 'field_vid_style', 'operator' => '==', 'value' => 'background')))),
            array('key' => 'field_vid_overlay_cta_link', 'label' => 'Overlay Button Link', 'name' => 'vid_overlay_cta_link', 'type' => 'text', 'placeholder' => 'https://… or #anchor', 'conditional_logic' => array(array(array('field' => 'field_vid_style', 'operator' => '==', 'value' => 'background')))),
            array(
                'key' => 'field_vid_overlay_cta_link_opts',
                'label' => 'Link Options',
                'name' => 'vid_overlay_cta_link_opts',
                'type' => 'checkbox',
                'layout' => 'horizontal',
                'choices' => array(
                    'new_tab'  => 'Open in new tab',
                    'nofollow' => 'Add rel="nofollow"',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'    => 'field_vid_overlay_cta_link',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),
            array('key' => 'field_vid_aspect_ratio', 'label' => 'Aspect Ratio', 'name' => 'vid_aspect_ratio', 'type' => 'select', 'choices' => array('16-9' => '16:9', '4-3' => '4:3', '21-9' => '21:9'), 'default_value' => '16-9'),
        ),
    );

    // --- GALLERY ---
    $all_layouts['gallery'] = array(
        'key' => 'layout_gallery', 'name' => 'gallery', 'label' => 'Gallery', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_gal_style', 'label' => 'Style', 'name' => 'gallery_style', 'type' => 'select', 'choices' => array('grid' => 'Grid', 'masonry' => 'Masonry', 'slider' => 'Slider'), 'default_value' => 'grid'),
            array('key' => 'field_gal_headline', 'label' => 'Headline', 'name' => 'gal_headline', 'type' => 'text'),
            array('key' => 'field_gal_subheadline', 'label' => 'Subheadline', 'name' => 'gal_subheadline', 'type' => 'text'),
            array('key' => 'field_gal_columns', 'label' => 'Columns', 'name' => 'gal_columns', 'type' => 'select', 'choices' => array('2' => '2', '3' => '3', '4' => '4'), 'default_value' => '3'),
            array('key' => 'field_gal_images', 'label' => 'Images', 'name' => 'gal_images', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Image', 'sub_fields' => array(
                array('key' => 'field_gal_item_image', 'label' => 'Image', 'name' => 'gal_image', 'type' => 'image', 'return_format' => 'array'),
                array('key' => 'field_gal_item_caption', 'label' => 'Caption', 'name' => 'gal_caption', 'type' => 'text'),
            )),
        ),
    );

    // --- BLOG TEASER ---
    $all_layouts['blog_teaser'] = array(
        'key' => 'layout_blog_teaser', 'name' => 'blog_teaser', 'label' => 'Blog Teaser', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_bt_style', 'label' => 'Style', 'name' => 'blog_teaser_style', 'type' => 'select', 'choices' => array('grid' => 'Grid', 'list' => 'List', 'featured' => 'Featured'), 'default_value' => 'grid'),
            array('key' => 'field_bt_headline', 'label' => 'Headline', 'name' => 'bt_headline', 'type' => 'text'),
            array('key' => 'field_bt_subheadline', 'label' => 'Subheadline', 'name' => 'bt_subheadline', 'type' => 'text'),
            array('key' => 'field_bt_posts_count', 'label' => 'Number of Posts', 'name' => 'bt_posts_count', 'type' => 'number', 'default_value' => 3, 'min' => 1, 'max' => 12),
            array('key' => 'field_bt_category', 'label' => 'Category (slug)', 'name' => 'bt_category', 'type' => 'text'),
            array('key' => 'field_bt_show_date', 'label' => 'Show Date', 'name' => 'bt_show_date', 'type' => 'true_false', 'default_value' => 1),
            array('key' => 'field_bt_show_excerpt', 'label' => 'Show Excerpt', 'name' => 'bt_show_excerpt', 'type' => 'true_false', 'default_value' => 1),
            array('key' => 'field_bt_show_author', 'label' => 'Show Author', 'name' => 'bt_show_author', 'type' => 'true_false', 'default_value' => 0),
            array('key' => 'field_bt_cta_text', 'label' => 'View All Text', 'name' => 'bt_cta_text', 'type' => 'text'),
            array('key' => 'field_bt_cta_link', 'label' => 'View All Link', 'name' => 'bt_cta_link', 'type' => 'text', 'placeholder' => 'https://… or #anchor'),
            array(
                'key' => 'field_bt_cta_link_opts',
                'label' => 'Link Options',
                'name' => 'bt_cta_link_opts',
                'type' => 'checkbox',
                'layout' => 'horizontal',
                'choices' => array(
                    'new_tab'  => 'Open in new tab',
                    'nofollow' => 'Add rel="nofollow"',
                ),
                'conditional_logic' => array(
                    array(
                        array(
                            'field'    => 'field_bt_cta_link',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
            ),
        ),
    );

    // --- CONTACT FORM ---
    $all_layouts['contact_form'] = array(
        'key' => 'layout_contact_form', 'name' => 'contact_form', 'label' => 'Contact Form (CF7)', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_cf_style', 'label' => 'Style', 'name' => 'contact_form_style', 'type' => 'select', 'choices' => array('simple' => 'Simple', 'split' => 'Split', 'with-info' => 'With Info'), 'default_value' => 'simple'),
            array('key' => 'field_cf_headline', 'label' => 'Headline', 'name' => 'cf_headline', 'type' => 'text'),
            array('key' => 'field_cf_subheadline', 'label' => 'Subheadline', 'name' => 'cf_subheadline', 'type' => 'text'),
            array('key' => 'field_cf_text', 'label' => 'Text', 'name' => 'cf_text', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0, 'delay' => 1),
            array('key' => 'field_cf_shortcode', 'label' => 'CF7 Shortcode', 'name' => 'cf_shortcode', 'type' => 'text', 'instructions' => 'Paste your Contact Form 7 shortcode here'),
            array('key' => 'field_cf_phone', 'label' => 'Phone', 'name' => 'cf_phone', 'type' => 'text'),
            array('key' => 'field_cf_email', 'label' => 'Email', 'name' => 'cf_email', 'type' => 'text'),
            array('key' => 'field_cf_address', 'label' => 'Address', 'name' => 'cf_address', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_cf_hours', 'label' => 'Opening Hours', 'name' => 'cf_hours', 'type' => 'text'),
        ),
    );

    // --- NEWSLETTER ---
    $all_layouts['newsletter'] = array(
        'key' => 'layout_newsletter', 'name' => 'newsletter', 'label' => 'Newsletter Signup', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_nl_style', 'label' => 'Style', 'name' => 'newsletter_style', 'type' => 'select', 'choices' => array('inline' => 'Inline', 'centered' => 'Centered', 'split' => 'Split'), 'default_value' => 'centered'),
            array('key' => 'field_nl_headline', 'label' => 'Headline', 'name' => 'nl_headline', 'type' => 'text'),
            array('key' => 'field_nl_text', 'label' => 'Text', 'name' => 'nl_text', 'type' => 'textarea'),
            array('key' => 'field_nl_placeholder', 'label' => 'Placeholder', 'name' => 'nl_placeholder', 'type' => 'text', 'default_value' => 'Enter your email'),
            array('key' => 'field_nl_button_text', 'label' => 'Button Text', 'name' => 'nl_button_text', 'type' => 'text', 'default_value' => 'Subscribe'),
            array('key' => 'field_nl_cf7_shortcode', 'label' => 'CF7 Shortcode', 'name' => 'nl_cf7_shortcode', 'type' => 'text', 'instructions' => 'Optional: CF7 form for actual submission'),
            array('key' => 'field_nl_privacy_text', 'label' => 'Privacy Text', 'name' => 'nl_privacy_text', 'type' => 'text'),
        ),
    );

    // --- PRICING ---
    $all_layouts['pricing'] = array(
        'key' => 'layout_pricing', 'name' => 'pricing', 'label' => 'Pricing Table', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_pr_style', 'label' => 'Style', 'name' => 'pricing_style', 'type' => 'select', 'choices' => array('two-columns' => '2 Columns', 'three-columns' => '3 Columns', 'comparison' => 'Comparison'), 'default_value' => 'three-columns'),
            array('key' => 'field_pr_headline', 'label' => 'Headline', 'name' => 'pr_headline', 'type' => 'text'),
            array('key' => 'field_pr_subheadline', 'label' => 'Subheadline', 'name' => 'pr_subheadline', 'type' => 'text'),
            array('key' => 'field_pr_plans', 'label' => 'Plans', 'name' => 'pr_plans', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Plan', 'sub_fields' => array(
                array('key' => 'field_pr_plan_name', 'label' => 'Plan Name', 'name' => 'pr_plan_name', 'type' => 'text'),
                array('key' => 'field_pr_plan_price', 'label' => 'Price', 'name' => 'pr_plan_price', 'type' => 'text'),
                array('key' => 'field_pr_plan_currency', 'label' => 'Currency', 'name' => 'pr_plan_currency', 'type' => 'text', 'default_value' => '€'),
                array('key' => 'field_pr_plan_period', 'label' => 'Period', 'name' => 'pr_plan_period', 'type' => 'text', 'default_value' => '/month'),
                array('key' => 'field_pr_plan_description', 'label' => 'Description', 'name' => 'pr_plan_description', 'type' => 'text'),
                array('key' => 'field_pr_plan_features', 'label' => 'Features (one per line)', 'name' => 'pr_plan_features', 'type' => 'textarea'),
                array('key' => 'field_pr_plan_cta_text', 'label' => 'Button Text', 'name' => 'pr_plan_cta_text', 'type' => 'text', 'default_value' => 'Get Started'),
                array('key' => 'field_pr_plan_cta_link', 'label' => 'Button Link', 'name' => 'pr_plan_cta_link', 'type' => 'text', 'placeholder' => 'https://… or #anchor'),
                array(
                    'key' => 'field_pr_plan_cta_link_opts',
                    'label' => 'Link Options',
                    'name' => 'pr_plan_cta_link_opts',
                    'type' => 'checkbox',
                    'layout' => 'horizontal',
                    'choices' => array(
                        'new_tab'  => 'Open in new tab',
                        'nofollow' => 'Add rel="nofollow"',
                    ),
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_pr_plan_cta_link',
                                'operator' => '!=empty',
                            ),
                        ),
                    ),
                ),
                array('key' => 'field_pr_plan_highlighted', 'label' => 'Highlighted', 'name' => 'pr_plan_highlighted', 'type' => 'true_false', 'default_value' => 0),
            )),
        ),
    );

    // --- MAP ---
    $all_layouts['map'] = array(
        'key' => 'layout_map', 'name' => 'map', 'label' => 'Map', 'display' => 'block',
        'sub_fields' => array(
            array('key' => 'field_map_style', 'label' => 'Provider', 'name' => 'map_style', 'type' => 'select', 'choices' => array('google-maps' => 'Google Maps', 'openstreetmap' => 'OpenStreetMap'), 'default_value' => 'google-maps'),
            array('key' => 'field_map_headline', 'label' => 'Headline', 'name' => 'map_headline', 'type' => 'text'),
            array('key' => 'field_map_embed_code', 'label' => 'Embed Code', 'name' => 'map_embed_code', 'type' => 'textarea', 'instructions' => 'Paste the iframe embed code'),
            array('key' => 'field_map_height', 'label' => 'Height', 'name' => 'map_height', 'type' => 'select', 'choices' => array('sm' => 'Small (300px)', 'md' => 'Medium (450px)', 'lg' => 'Large (600px)'), 'default_value' => 'md'),
            array('key' => 'field_map_full_width', 'label' => 'Full Width', 'name' => 'map_full_width', 'type' => 'true_false', 'default_value' => 0),
        ),
    );

    // --- TABS ---
    $all_layouts['tabs'] = array(
        'key' => 'layout_tabs',
        'name' => 'tabs',
        'label' => 'Tabs',
        'display' => 'block',
        'sub_fields' => array(
            // Style (index 0 — required for variant filtering)
            array(
                'key' => 'field_tabs_style',
                'label' => 'Style',
                'name' => 'tabs_style',
                'type' => 'select',
                'choices' => array(
                    'horizontal' => 'Horizontal',
                ),
                'default_value' => 'horizontal',
            ),
            // Section headline
            array(
                'key' => 'field_tabs_headline',
                'label' => 'Headline',
                'name' => 'tabs_headline',
                'type' => 'text',
            ),
            // Section subheadline
            array(
                'key' => 'field_tabs_subheadline',
                'label' => 'Subheadline',
                'name' => 'tabs_subheadline',
                'type' => 'text',
            ),
            // Tabs repeater
            array(
                'key' => 'field_tabs_items',
                'label' => 'Tabs',
                'name' => 'tabs_items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Tab',
                'sub_fields' => array(
                    // Tab title
                    array(
                        'key' => 'field_tabs_item_title',
                        'label' => 'Tab Title',
                        'name' => 'tab_title',
                        'type' => 'text',
                    ),
                    // Layout chooser
                    array(
                        'key' => 'field_tabs_item_layout',
                        'label' => 'Content Layout',
                        'name' => 'tab_layout',
                        'type' => 'select',
                        'choices' => array(
                            'cards'      => 'Cards Grid',
                            'image-text' => 'Image + Text',
                        ),
                        'default_value' => 'cards',
                    ),
                    // --- Cards layout fields ---
                    array(
                        'key' => 'field_tabs_item_cards',
                        'label' => 'Cards',
                        'name' => 'tab_cards',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'button_label' => 'Add Card',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_tabs_item_layout',
                                    'operator' => '==',
                                    'value' => 'cards',
                                ),
                            ),
                        ),
                        'sub_fields' => array(
                            array('key' => 'field_tabs_card_icon', 'label' => 'Icon / Image', 'name' => 'tab_card_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'),
                            array('key' => 'field_tabs_card_title', 'label' => 'Title', 'name' => 'tab_card_title', 'type' => 'text'),
                            array('key' => 'field_tabs_card_text', 'label' => 'Description', 'name' => 'tab_card_text', 'type' => 'textarea'),
                        ),
                    ),
                    // --- Image + Text layout fields ---
                    array(
                        'key' => 'field_tabs_item_image',
                        'label' => 'Image',
                        'name' => 'tab_image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_tabs_item_layout',
                                    'operator' => '==',
                                    'value' => 'image-text',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_tabs_item_image_position',
                        'label' => 'Image Position',
                        'name' => 'tab_image_position',
                        'type' => 'select',
                        'choices' => array(
                            'left'  => 'Image Left',
                            'right' => 'Image Right',
                        ),
                        'default_value' => 'left',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_tabs_item_layout',
                                    'operator' => '==',
                                    'value' => 'image-text',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_tabs_item_heading',
                        'label' => 'Überschrift (H3)',
                        'name' => 'tab_heading',
                        'type' => 'text',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_tabs_item_layout',
                                    'operator' => '==',
                                    'value' => 'image-text',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_tabs_item_subheading',
                        'label' => 'Unterüberschrift (H4)',
                        'name' => 'tab_subheading',
                        'type' => 'text',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_tabs_item_layout',
                                    'operator' => '==',
                                    'value' => 'image-text',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_tabs_item_text',
                        'label' => 'Text',
                        'name' => 'tab_text',
                        'type' => 'wysiwyg',
                        'toolbar' => 'basic',
                        'media_upload' => 0,
                        'delay' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_tabs_item_layout',
                                    'operator' => '==',
                                    'value' => 'image-text',
                                ),
                            ),
                        ),
                    ),
                    // --- CTA Button (both layouts) ---
                    array('key' => 'field_tabs_item_cta_text', 'label' => 'Button Text', 'name' => 'tab_cta_text', 'type' => 'text'),
                    array('key' => 'field_tabs_item_cta_link', 'label' => 'Button Link', 'name' => 'tab_cta_link', 'type' => 'text', 'placeholder' => 'https://… or #anchor'),
                    array(
                        'key' => 'field_tabs_item_cta_link_opts',
                        'label' => 'Link Options',
                        'name' => 'tab_cta_link_opts',
                        'type' => 'checkbox',
                        'layout' => 'horizontal',
                        'choices' => array(
                            'new_tab'  => 'Open in new tab',
                            'nofollow' => 'Add rel="nofollow"',
                        ),
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field'    => 'field_tabs_item_cta_link',
                                    'operator' => '!=empty',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );

    // No active components = no layouts shown
    if (empty($active_components)) {
        return;
    }

    // Filter variant choices based on Clesk Framework settings
    // The style selector is always the first sub_field (index 0) for every component
    foreach ($all_layouts as $comp_key => &$layout) {
        if (isset($layout['sub_fields'][0]['choices'])) {
            $filtered = clesk_filter_variant_choices(
                $layout['sub_fields'][0]['choices'],
                $comp_key
            );
            if (!empty($filtered)) {
                $layout['sub_fields'][0]['choices'] = $filtered;
            }
        }
    }
    unset($layout);

    // Only include active components in Flexible Content
    $active_layouts = array();
    foreach ($all_layouts as $key => $layout) {
        if (in_array($key, $active_components)) {
            $active_layouts[] = $layout;
        }
    }

    if (empty($active_layouts)) {
        return;
    }

    // Register Flexible Content field group
    acf_add_local_field_group(array(
        'key' => 'group_clesk_page_builder',
        'title' => 'Page Builder',
        'fields' => array(
            array(
                'key' => 'field_clesk_components',
                'label' => 'Components',
                'name' => 'clesk_components',
                'type' => 'flexible_content',
                'instructions' => 'Add blocks to build your page.',
                'button_label' => 'Add Block',
                'layouts' => $active_layouts,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'seamless',
    ));
}
