<?php
if (!defined('ABSPATH')) exit;
/**
 * Custom Walker for desktop navigation
 *
 * Supports:
 * - Standard dropdown menus (2 levels)
 * - Mega menus (add CSS class "mega-menu" to a top-level item)
 * - Tailwind CSS styling with CSS :hover dropdowns
 *
 * @package Clesk_Starter
 */

class Clesk_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Track if current item is a mega menu
     */
    private $is_mega_menu = false;

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);

        if ($depth === 0 && $this->is_mega_menu) {
            // Mega menu: wide dropdown with grid layout
            $output .= "\n{$indent}<div class=\"clesk-mega-menu invisible opacity-0 group-hover/item:visible group-hover/item:opacity-100 absolute left-1/2 -translate-x-1/2 top-full pt-2 w-screen max-w-4xl transition-all duration-200 z-50\">\n";
            $output .= "{$indent}\t<div class=\"bg-[var(--color-background)] rounded-xl shadow-lg ring-1 ring-[var(--color-border)] p-6\">\n";
            $output .= "{$indent}\t\t<ul class=\"grid grid-cols-2 md:grid-cols-3 gap-4\">\n";
        } elseif ($depth === 0) {
            // Standard dropdown
            $output .= "\n{$indent}<div class=\"clesk-dropdown invisible opacity-0 group-hover/item:visible group-hover/item:opacity-100 absolute left-0 top-full pt-2 w-56 transition-all duration-200 z-50\">\n";
            $output .= "{$indent}\t<ul class=\"bg-[var(--color-background)] rounded-xl shadow-lg ring-1 ring-[var(--color-border)] py-2\">\n";
        } else {
            // Sub-dropdown (level 3)
            $output .= "\n{$indent}<ul class=\"mt-1 ml-4 border-l-2 border-[var(--color-border)] pl-3 space-y-1\">\n";
        }
    }

    /**
     * Ends the list after the elements are added.
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);

        if ($depth === 0 && $this->is_mega_menu) {
            $output .= "{$indent}\t\t</ul>\n";
            $output .= "{$indent}\t</div>\n";
            $output .= "{$indent}</div>\n";
        } elseif ($depth === 0) {
            $output .= "{$indent}\t</ul>\n";
            $output .= "{$indent}</div>\n";
        } else {
            $output .= "{$indent}</ul>\n";
        }
    }

    /**
     * Starts the element output.
     */
    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        $item    = $data_object;
        $indent  = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        // Check for mega menu class on top-level items
        if ($depth === 0) {
            $this->is_mega_menu = in_array('mega-menu', $classes, true);
        }

        $has_children = in_array('menu-item-has-children', $classes, true);

        // Build class list
        $li_classes = array('clesk-menu-item');

        if ($depth === 0) {
            $li_classes[] = 'relative';
            if ($has_children) {
                $li_classes[] = 'group/item';
            }
        }

        if (in_array('current-menu-item', $classes, true)) {
            $li_classes[] = 'current-menu-item';
        }

        $class_string = implode(' ', array_filter($li_classes));

        $output .= $indent . '<li class="' . esc_attr($class_string) . '">';

        // Build link
        $atts = array();
        $atts['href']  = !empty($item->url) ? $item->url : '';
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';

        if ($item->target === '_blank') {
            $atts['target'] = '_blank';
            $atts['rel']    = 'noopener noreferrer';
        }

        // Link classes based on depth
        if ($depth === 0) {
            $atts['class'] = 'inline-flex items-center gap-x-1 px-3 py-2 rounded-lg text-sm font-medium text-[var(--color-text)] hover:text-[var(--color-primary)] hover:bg-[var(--color-surface)] transition-colors';
        } elseif ($this->is_mega_menu && $depth === 1) {
            $atts['class'] = 'block p-3 rounded-lg hover:bg-[var(--color-surface)] transition-colors';
        } else {
            $atts['class'] = 'block px-4 py-2 text-sm text-[var(--color-text)] hover:text-[var(--color-primary)] hover:bg-[var(--color-surface)] transition-colors';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';

        // Item title
        if ($this->is_mega_menu && $depth === 1) {
            // Mega menu items get a title + description layout
            $output .= '<span class="block text-sm font-semibold text-[var(--color-heading)]">' . esc_html($item->title) . '</span>';
            if (!empty($item->description)) {
                $output .= '<span class="block mt-1 text-xs text-[var(--color-text-muted)]">' . esc_html($item->description) . '</span>';
            }
        } else {
            $output .= esc_html($item->title);
        }

        // Dropdown arrow for top-level items with children
        if ($depth === 0 && $has_children) {
            $output .= '<svg class="w-4 h-4 ml-1 transition-transform group-hover/item:rotate-180" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>';
        }

        $output .= '</a>';
    }

    /**
     * Ends the element output.
     */
    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}
