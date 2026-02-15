# Clesk Starter – WordPress Framework Theme

A modular, component-based WordPress parent theme built for agencies. Create client websites by copying the child theme boilerplate and overriding design tokens — no parent theme code changes needed.

## Requirements

- WordPress 6.x
- [SCF (Secure Custom Fields)](https://wordpress.org/plugins/secure-custom-fields/) — free ACF-compatible plugin
- PHP 8.0+
- Node.js 18+ (for building CSS)
- Contact Form 7 (optional, for form components)

## Installation

1. Copy both theme folders into your WordPress installation:
```bash
cp -r clesk-starter/ /path/to/wordpress/wp-content/themes/clesk-starter/
cp -r clesk-starter-child/ /path/to/wordpress/wp-content/themes/clesk-starter-child/
```

2. Install dependencies and build both themes:
```bash
cd /path/to/wordpress/wp-content/themes/clesk-starter
npm install && npm run build

cd /path/to/wordpress/wp-content/themes/clesk-starter-child
npm install && npm run build
```

3. Activate the child theme in **WordPress Admin → Appearance → Themes**

4. Install and activate the **SCF** plugin (required for page builder components)

5. Configure components in **Admin → Clesk Framework**

## Quick Start (New Client Project)

```bash
# 1. Copy the child theme boilerplate
cp -r clesk-starter-child/ /path/to/wordpress/wp-content/themes/my-client/

# 2. Update style.css header in my-client/style.css:
#    Theme Name: My Client
#    Template: clesk-starter

# 3. Install dependencies & build
cd /path/to/wordpress/wp-content/themes/my-client
npm install && npm run build

# 4. Activate in WordPress Admin → Appearance → Themes

# 5. Configure components: Admin → Clesk Framework
```

> **Tip:** See `STARTER-PROMPT.md` for a complete prompt you can give to Claude or another AI assistant when starting a new client project with this framework.

## Architecture

```
clesk-starter/          ← Parent Theme (don't modify)
├── components/         ← 22 page builder components (65 variants)
├── template-parts/     ← 3 header + 3 footer variants
├── inc/                ← PHP logic (fields, walkers, options)
├── src/css/base/       ← Design tokens, reset, typography
└── dist/               ← Built CSS (56 kB) + JS (1 kB)

clesk-starter-child/    ← Boilerplate (copy for each client)
├── src/css/custom.css  ← Override design tokens here
├── components/         ← Override component templates here
└── functions.php       ← Activate components, add custom logic
```

## Design Token Reference

The entire visual identity is controlled through CSS Custom Properties. Override them in your child theme's `src/css/custom.css` — the parent's defaults apply for anything you don't set.

### Colors

| Token | Default | Controls |
|---|---|---|
| `--color-primary` | `#3b82f6` (Blue) | Buttons, links, active states, highlighted elements |
| `--color-primary-hover` | `#2563eb` | Button/link hover state |
| `--color-primary-light` | `#dbeafe` | Feature icon backgrounds, subtle highlights |
| `--color-secondary` | `#10b981` (Green) | Secondary buttons, accent color |
| `--color-secondary-hover` | `#059669` | Secondary hover state |
| `--color-heading` | `#111827` | All headings (h1-h6) |
| `--color-text` | `#374151` | Body text, paragraphs |
| `--color-text-muted` | `#6b7280` | Subheadlines, descriptions, meta text |
| `--color-text-light` | `#9ca3af` | Placeholder text, very subtle labels |
| `--color-background` | `#ffffff` | Page background, card backgrounds |
| `--color-surface` | `#f9fafb` | Section backgrounds, card surfaces, hover states |
| `--color-surface-dark` | `#f3f4f6` | Darker surface variant (alternating sections) |
| `--color-border` | `#e5e7eb` | Borders, dividers, input outlines |
| `--color-success` | `#10b981` | Success messages, positive indicators |
| `--color-warning` | `#f59e0b` | Warning banners, caution states |
| `--color-error` | `#ef4444` | Error messages, form validation |

### Typography

| Token | Default | Controls |
|---|---|---|
| `--font-heading` | `'Inter', system-ui, sans-serif` | All headings (h1-h6) |
| `--font-body` | `'Inter', system-ui, sans-serif` | Body text, paragraphs, UI elements |
| `--font-mono` | `'JetBrains Mono', monospace` | Code blocks, monospace text |
| `--font-size-xs` | `0.75rem` (12px) | Badges, fine print |
| `--font-size-sm` | `0.875rem` (14px) | Small text, card descriptions, meta |
| `--font-size-base` | `1rem` (16px) | Body text default |
| `--font-size-lg` | `1.125rem` (18px) | Lead paragraphs, subheadlines |
| `--font-size-xl` | `1.25rem` (20px) | Small headings |
| `--font-size-2xl` | `1.5rem` (24px) | Card headings, section titles |
| `--font-size-3xl` | `1.875rem` (30px) | Section headings (mobile) |
| `--font-size-4xl` | `2.25rem` (36px) | Section headings (desktop) |
| `--font-size-5xl` | `3rem` (48px) | Hero headings |

### Spacing & Layout

| Token | Default | Controls |
|---|---|---|
| `--section-padding-y` | `4rem` | Vertical padding on all sections (mobile) |
| `--section-padding-y-lg` | `6rem` | Vertical padding on all sections (desktop) |
| `--container-max-width` | `85rem` (1360px) | Maximum content width |
| `--container-padding-x` | `1rem` | Horizontal page padding |

### Border Radius

| Token | Default | Controls |
|---|---|---|
| `--radius-sm` | `0.25rem` (4px) | Small elements (badges, tags) |
| `--radius-md` | `0.5rem` (8px) | Inputs, small cards |
| `--radius-lg` | `0.75rem` (12px) | Cards, dropdowns, modals |
| `--radius-xl` | `1rem` (16px) | Large cards, hero images |
| `--radius-full` | `9999px` | Fully rounded (pills, avatars) |

### Shadows

| Token | Default | Controls |
|---|---|---|
| `--shadow-sm` | `0 1px 2px ...` | Subtle elevation (inputs, small cards) |
| `--shadow-md` | `0 4px 6px ...` | Medium elevation (cards on hover) |
| `--shadow-lg` | `0 10px 15px ...` | High elevation (dropdowns, modals) |
| `--shadow-xl` | `0 20px 25px ...` | Highest elevation (overlays) |

### Transitions

| Token | Default | Controls |
|---|---|---|
| `--transition-fast` | `150ms ease` | Micro-interactions (hover color changes) |
| `--transition-normal` | `200ms ease` | Standard transitions (card hover) |
| `--transition-slow` | `300ms ease` | Larger animations (dropdown open) |

## Child Theme Customization

### 1. Override Design Tokens

Edit `src/css/custom.css` and uncomment/change the tokens you need:

```css
:root {
    --color-primary: #e11d48;        /* Rose red */
    --color-primary-hover: #be123c;
    --color-primary-light: #ffe4e6;
    --font-heading: 'Playfair Display', serif;
    --radius-lg: 0;                  /* Sharp corners */
}
```

Then run `npm run build` to compile.

### 2. Override Component Templates

Copy any component from the parent to your child theme's `components/` directory:

```bash
# Example: customize the hero component
cp clesk-starter/components/hero/hero.php my-client/components/hero/hero.php
```

Edit the copy — WordPress automatically uses the child theme version.

### 3. Activate Components

In `functions.php`, the `after_switch_theme` hook sets which components are active:

```php
function clesk_child_set_active_components() {
    update_option('clesk_active_components', array(
        'hero', 'text_image', 'cta', 'features',
        'testimonials', 'contact_form',
    ));
}
add_action('after_switch_theme', 'clesk_child_set_active_components');
```

Or configure it in the admin: **Clesk Framework → Components**.

### 4. Use Custom Fonts

Add Google Fonts or local fonts in `functions.php`:

```php
function clesk_child_enqueue_fonts() {
    wp_enqueue_style('google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap',
        array(), null
    );
}
add_action('wp_enqueue_scripts', 'clesk_child_enqueue_fonts');
```

Then set `--font-heading: 'Playfair Display', serif;` in `custom.css`.

## CSS Classes

The parent theme provides these utility classes (Tailwind @layer components):

| Class | Purpose |
|---|---|
| `.clesk-section` | Section wrapper (py-16 lg:py-24) |
| `.clesk-container` | Content container (max-w-[85rem] mx-auto px-4) |
| `.clesk-btn-primary` | Primary button (filled, rounded) |
| `.clesk-btn-secondary` | Secondary button (outlined) |
| `.clesk-heading-1` | Hero heading (4xl → 6xl responsive) |
| `.clesk-heading-2` | Section heading (3xl → 4xl responsive) |
| `.clesk-heading-3` | Card heading (2xl bold) |
| `.clesk-body-text` | Body paragraph (lg, relaxed) |

## Components (22)

All components are in `clesk-starter/components/[name]/[name].php` and use SCF Flexible Content fields.

| Component | Variants | Key Fields |
|---|---|---|
| **Hero** | centered, left-aligned, with-image, text-on-image, carousel, video-play | headline, subheadline, text, image, button |
| **Text + Image** | image-left, image-right | headline, text, image, button |
| **Features** | grid-3, grid-4, list, split, medium | headline, subheadline, items (icon+title+text) |
| **Text Block** | normal, narrow | headline, content (WYSIWYG) |
| **CTA** | simple, highlight, dark | headline, text, button |
| **Stats** | inline, cards, icon-cards | headline, items (number+label+description) |
| **Cards Grid** | 2-col, 3-col, 4-col | headline, cards (image+title+text+link+badge) |
| **Testimonials** | grid, single-quote, cards | headline, items (quote+name+role+rating) |
| **Logo Cloud** | row, grid, marquee | headline, logos (image+name+link) |
| **Steps** | numbered, icon, connector | headline, items (title+text+icon) |
| **Timeline** | vertical, alternating, horizontal | headline, items (date+title+text) |
| **Team** | grid, cards, list | headline, members (name+role+photo+bio) |
| **FAQ** | simple, bordered, two-columns | headline, items (question+answer) |
| **Banner** | info, warning, promo | text, button, dismissible |
| **Video** | simple, overlay, background | headline, source, url, thumbnail |
| **Gallery** | grid, masonry, slider | headline, columns, images (image+caption) |
| **Blog Teaser** | grid, list, featured | headline, post count, category, button |
| **Pricing** | 2-col, 3-col, comparison | headline, plans (name+price+features+button) |
| **Newsletter** | inline, centered, split | headline, text, placeholder, button |
| **Contact Form** | simple, split, with-info | headline, CF7 shortcode, phone, email, address |
| **Map** | google-maps, openstreetmap | headline, embed code, height |
| **Spacer** | empty, line, wave | height, line-width/wave-color |

## Header & Footer

Configured in **Clesk Framework → Header & Footer** admin tab.

**Headers:** default (logo left/nav right), centered, transparent (solid on scroll)
**Footers:** default (logo+nav+copyright), columns (4-col with menus+social), minimal (single line)

### Navigation

- **Dropdown menus:** Drag items to sub-level in Appearance → Menus
- **Mega menu:** Add CSS class `mega-menu` to any top-level item (enable via Screen Options → CSS Classes)
- **Mobile:** Automatic accordion with `<details>`/`<summary>` (no JS)

## Development

```bash
# Parent theme (only needed for framework development)
cd clesk-starter
npm install
npm run dev    # Vite dev server (HMR on port 5173)
npm run build  # Production build

# Child theme
cd my-client
npm install
npm run build  # Compile custom.css → dist/
```

For Vite HMR during development, add to `wp-config.php`:
```php
define('CLESK_DEV_MODE', true);  // false for production
```

## Tech Stack

- WordPress 6.x
- SCF (Secure Custom Fields) — ACF-compatible, free
- Tailwind CSS 3.4
- Vite 5
- Contact Form 7 (optional, for form components)
- Pure PHP templating (no Timber/Twig)

## License

GPL-2.0-or-later
