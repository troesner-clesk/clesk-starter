<?php
if (!defined('ABSPATH')) exit;
/**
 * Custom Walker for mobile navigation
 *
 * Uses native <details>/<summary> for accordion behavior (no JS needed).
 * Accessible and works without JavaScript.
 *
 * @package Clesk_Starter
 */

class Clesk_Mobile_Walker extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent  = str_repeat("\t", $depth);
        $padding = $depth === 0 ? 'pl-4' : 'pl-4';
        $output .= "\n{$indent}<ul class=\"{$padding} mt-1 space-y-1 border-l-2 border-[var(--color-border)] ml-3\">\n";
    }

    /**
     * Ends the list after the elements are added.
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "{$indent}</ul>\n";
    }

    /**
     * Starts the element output.
     */
    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        $item    = $data_object;
        $indent  = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $has_children = in_array('menu-item-has-children', $classes, true);
        $is_current   = in_array('current-menu-item', $classes, true);

        $li_classes = array('clesk-mobile-item');
        if ($is_current) {
            $li_classes[] = 'current-menu-item';
        }

        $link_class = 'block px-3 py-2 rounded-lg text-sm font-medium text-[var(--color-text)] hover:text-[var(--color-primary)] hover:bg-[var(--color-surface)] transition-colors';

        if ($is_current) {
            $link_class .= ' text-[var(--color-primary)]';
        }

        if ($has_children) {
            // Wrap in <details> for accordion behavior
            $output .= $indent . '<li class="' . esc_attr(implode(' ', $li_classes)) . '">';
            $output .= '<details class="group">';
            $output .= '<summary class="' . esc_attr($link_class) . ' flex items-center justify-between cursor-pointer list-none">';
            $output .= '<span>' . esc_html($item->title) . '</span>';
            $output .= '<svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>';
            $output .= '</summary>';

            // Also add a direct link to the page
            if (!empty($item->url) && $item->url !== '#') {
                $output .= '<a href="' . esc_url($item->url) . '" class="block px-3 py-1.5 ml-3 text-xs text-[var(--color-text-muted)] hover:text-[var(--color-primary)] transition-colors">';
                $output .= esc_html__('Go to', 'clesk-starter') . ' ' . esc_html($item->title) . ' &rarr;';
                $output .= '</a>';
            }
        } else {
            $output .= $indent . '<li class="' . esc_attr(implode(' ', $li_classes)) . '">';

            $atts = array(
                'href'  => !empty($item->url) ? $item->url : '',
                'class' => $link_class,
            );

            if ($item->target === '_blank') {
                $atts['target'] = '_blank';
                $atts['rel']    = 'noopener noreferrer';
            }

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
                }
            }

            $output .= '<a' . $attributes . '>' . esc_html($item->title) . '</a>';
        }
    }

    /**
     * Ends the element output.
     */
    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        $classes      = empty($data_object->classes) ? array() : (array) $data_object->classes;
        $has_children = in_array('menu-item-has-children', $classes, true);

        if ($has_children) {
            $output .= "</details>";
        }
        $output .= "</li>\n";
    }
}
