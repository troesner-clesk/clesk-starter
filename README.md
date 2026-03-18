# Clesk Starter – WordPress Framework Theme

A modular, component-based WordPress parent theme built for agencies. Ship client websites faster by overriding design tokens in a child theme — no parent theme changes needed.

## Features

- **22 page builder components** with 65+ style variants
- **Design token system** via CSS Custom Properties — change colors, fonts, spacing, and more
- **3 header + 3 footer variants** — configurable from the admin
- **Child theme ready** — copy the boilerplate, set your tokens, done
- **No build step for child themes** — plain CSS, no Node.js required
- **SCF (Secure Custom Fields)** powered — free, ACF-compatible
- **Tailwind CSS 3.4** — utility-first CSS with minimal output (~56 kB)
- **Vite 5** — fast builds and HMR during development
- **Security hardened** — output escaping, version hiding, XML-RPC disabled
- **No jQuery** — vanilla JS only, lightweight frontend

## Requirements

- WordPress 6.0+
- [SCF (Secure Custom Fields)](https://wordpress.org/plugins/secure-custom-fields/) — free plugin
- PHP 8.0+
- Node.js 18+ (only for parent theme development)
- [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) (optional, for form components)

## Installation

1. Download or clone this repository into `wp-content/themes/`:
   ```bash
   cd wp-content/themes
   git clone https://github.com/troesner-clesk/clesk-starter.git
   ```

2. Install dependencies and build:
   ```bash
   cd clesk-starter
   npm install && npm run build
   ```

3. Install and activate the **SCF** plugin in WordPress Admin

4. Activate the theme (or a child theme) in **Appearance > Themes**

5. Configure components in **Clesk Framework** admin page

## Child Theme

For client projects, use the [Clesk Starter Child](https://github.com/troesner-clesk/clesk-starter-child) boilerplate. It lets you override design tokens with plain CSS — no build step needed.

```css
/* custom.css in child theme */
:root {
    --color-primary: #e11d48;
    --font-heading: 'Playfair Display', serif;
    --radius-lg: 0;
}
```

## Components

| Component | Variants |
|---|---|
| **Hero** | centered, left-aligned, text-on-image, carousel, video-play |
| **Text + Image** | image-left, image-right |
| **Features** | grid-3, grid-4, list, split, medium |
| **Text Block** | normal, narrow |
| **CTA** | simple, highlight, dark |
| **Stats** | inline, cards, icon-cards |
| **Cards Grid** | 2-col, 3-col, 4-col |
| **Testimonials** | grid, single-quote, cards |
| **Logo Cloud** | row, grid, marquee |
| **Steps** | numbered, icon, connector |
| **Timeline** | vertical, alternating, horizontal |
| **Team** | grid, cards, list |
| **FAQ** | simple, bordered, two-columns |
| **Banner** | info, warning, promo |
| **Video** | simple, overlay, background |
| **Gallery** | grid, masonry, slider |
| **Blog Teaser** | grid, list, featured |
| **Pricing** | 2-col, 3-col, comparison |
| **Newsletter** | inline, centered, split |
| **Contact Form** | simple, split, with-info |
| **Map** | google-maps, openstreetmap |
| **Spacer** | empty, line, wave |

All components are activated/deactivated in **Clesk Framework > Components**.

## Design Tokens

Override these CSS Custom Properties in your child theme's `custom.css`:

| Token | Default | Purpose |
|---|---|---|
| `--color-primary` | `#3b82f6` | Buttons, links, active states |
| `--color-secondary` | `#10b981` | Secondary buttons, accents |
| `--color-heading` | `#111827` | All headings |
| `--color-text` | `#374151` | Body text |
| `--color-background` | `#ffffff` | Page background |
| `--color-surface` | `#f9fafb` | Section backgrounds |
| `--font-heading` | `'Inter', system-ui` | Heading font family |
| `--font-body` | `'Inter', system-ui` | Body font family |
| `--radius-lg` | `0.75rem` | Cards, modals |
| `--section-padding-y` | `4rem` | Section vertical padding |

See the child theme's `custom.css` for the complete token reference.

## Header & Footer

Configured in **Clesk Framework > Header & Footer**.

**Headers:** Default (logo left), Centered, Transparent (solid on scroll)
**Footers:** Default, Columns (4-col with menus + social), Minimal

**Navigation features:**
- Dropdown menus (CSS-only, no JS)
- Mega menus (add CSS class `mega-menu` to a top-level menu item)
- Mobile accordion (`<details>`/`<summary>`, no JS)

## Development

```bash
npm run dev    # Vite dev server with HMR (port 5173)
npm run build  # Production build to dist/
```

For Vite HMR, add to `wp-config.php`:
```php
define('CLESK_DEV_MODE', true);
```

## License

GPL-2.0-or-later. See [LICENSE](LICENSE).

## Credits

Built by [Clesk Digital GmbH](https://clesk.de). Uses [Tailwind CSS](https://tailwindcss.com), [Preline UI](https://preline.co) (design reference), and [Vite](https://vite.dev).
