# Clesk Starter – Initial Prompt for New Client Projects

Copy this prompt and give it to Claude when starting a new website with the clesk-starter theme framework.

---

## PROMPT START

Du hilfst mir eine WordPress-Website zu bauen. Wir verwenden das **Clesk Starter Framework** — ein komponentenbasiertes Parent Theme mit Child-Theme-Architektur.

### Projekt-Setup

- **Parent Theme:** `clesk-starter` (NICHT verändern, kommt von GitHub)
- **Child Theme:** `[CHILD-THEME-NAME]` (basiert auf `clesk-starter-child` Boilerplate)
- **WordPress** mit SCF (Secure Custom Fields) — ACF-kompatibler Fork
- **Styling:** Tailwind CSS 3.4 + CSS Custom Properties (Design Tokens)
- **Build:** Vite 5 — nach CSS-Änderungen immer `npm run build` im Child Theme

### Architektur

Das gesamte Design wird über **CSS Custom Properties** gesteuert. Das Child Theme überschreibt nur die Variablen — der komplette HTML-Code kommt aus dem Parent Theme.

```
clesk-starter/          ← Parent (nicht anfassen)
├── components/         ← 22 Komponenten mit 65 Varianten
├── template-parts/     ← 3 Header + 3 Footer Varianten
├── src/css/base/       ← Default Design Tokens
└── dist/               ← Gebaute CSS/JS

[child-theme]/          ← Hier arbeiten wir
├── src/css/custom.css  ← Design Token Overrides
├── components/         ← Komponenten-Overrides (nur bei Bedarf)
├── functions.php       ← Komponenten-Aktivierung, Custom Fonts
└── dist/               ← Gebauter Output
```

### Design Tokens (custom.css)

Alle visuellen Eigenschaften werden über CSS-Variablen in `src/css/custom.css` gesteuert. Nur überschreiben was sich ändert — alles andere erbt vom Parent.

**Farben:**
| Token | Kontrolliert |
|---|---|
| `--color-primary` | Buttons, Links, aktive States, Highlights |
| `--color-primary-hover` | Hover-State von Buttons/Links |
| `--color-primary-light` | Feature-Icon Hintergründe, dezente Akzente |
| `--color-secondary` | Sekundäre Buttons, Badges |
| `--color-secondary-hover` | Sekundärer Hover |
| `--color-heading` | Alle Überschriften (h1–h6) |
| `--color-text` | Fließtext, Absätze |
| `--color-text-muted` | Untertitel, Beschreibungen, Meta-Text |
| `--color-text-light` | Placeholder, sehr dezente Labels |
| `--color-background` | Seitenhintergrund |
| `--color-surface` | Section-Hintergründe, Karten, Hover-States |
| `--color-surface-dark` | Dunklere Flächen (alternierende Sections) |
| `--color-border` | Rahmen, Trennlinien, Input-Outlines |
| `--color-success/warning/error` | Status-Farben für Banner, Formulare |

**Typografie:**
| Token | Kontrolliert |
|---|---|
| `--font-heading` | Schriftart aller Überschriften |
| `--font-body` | Schriftart für Fließtext und UI |
| `--font-size-xs` bis `--font-size-5xl` | Globale Type-Scale (12px–48px) |

**Layout:**
| Token | Kontrolliert |
|---|---|
| `--section-padding-y` / `--section-padding-y-lg` | Vertikaler Abstand zwischen Sektionen |
| `--container-max-width` | Maximale Inhaltsbreite (Standard: 1360px) |
| `--radius-sm/md/lg/xl/full` | Rundungen (0 = eckig, 9999px = Pillen) |
| `--shadow-sm/md/lg/xl` | Schatten-Stufen |
| `--transition-fast/normal/slow` | Animationsgeschwindigkeiten |

### Verfügbare Komponenten (22)

Jede Komponente hat mehrere Varianten. Aktivierung via `functions.php` oder Admin → Clesk Framework.

| Komponente | Varianten |
|---|---|
| **Hero** | `centered`, `left-aligned`, `with-image`, `text-on-image`, `carousel`, `video-play` |
| **Text + Image** | `image-left`, `image-right` |
| **Features / Icons** | `grid-3`, `grid-4`, `list`, `split`, `medium` |
| **Text Block** | `normal`, `narrow` |
| **CTA** | `simple`, `highlight`, `dark` |
| **Stats** | `inline`, `cards`, `icon-cards` |
| **Cards Grid** | `two-columns`, `three-columns`, `four-columns` |
| **Testimonials** | `grid`, `single-quote`, `cards` |
| **Logo Cloud** | `row`, `grid`, `marquee` |
| **Steps / Process** | `numbered`, `icon`, `connector` |
| **Timeline** | `vertical`, `alternating`, `horizontal` |
| **Team** | `grid`, `cards`, `list` |
| **FAQ** | `simple`, `bordered`, `two-columns` |
| **Banner / Notice** | `info`, `warning`, `promo` |
| **Video** | `simple`, `overlay`, `background` |
| **Gallery** | `grid`, `masonry`, `slider` |
| **Blog Teaser** | `grid`, `list`, `featured` |
| **Pricing** | `two-columns`, `three-columns`, `comparison` |
| **Newsletter** | `inline`, `centered`, `split` |
| **Contact Form** | `simple`, `split`, `with-info` |
| **Map** | `google-maps`, `openstreetmap` |
| **Spacer / Divider** | `empty`, `line`, `wave` |

### Header & Footer

Konfigurierbar über Admin → Clesk Framework → Header & Footer.

**Header:** `default` (Logo links/Nav rechts), `centered` (Logo oben zentriert), `transparent` (wird beim Scrollen solid)
**Footer:** `default` (Logo+Nav+Copyright), `columns` (4-Spalten mit Menüs+Social), `minimal` (einzeilig)

**Navigation:** Dropdown-Menüs automatisch bei Sub-Items. Mega Menu: CSS-Klasse `mega-menu` an Top-Level-Item.

### CSS-Utility-Klassen

Das Parent Theme stellt bereit:
- `.clesk-btn-primary` — Primärer Button (gefüllt)
- `.clesk-btn-secondary` — Sekundärer Button (Outline)
- `.clesk-heading-1/2/3` — Responsive Überschriften
- `.clesk-body-text` — Fließtext-Styling
- `.clesk-section` — Section-Wrapper mit Padding
- `.clesk-container` — Content-Container (max-width + padding)

### Workflow

1. **Design Tokens setzen:** `src/css/custom.css` bearbeiten
2. **Build:** `npm run build` im Child Theme Ordner
3. **Komponenten aktivieren:** In `functions.php` oder Admin → Clesk Framework
4. **Seiten bauen:** Im WP-Admin Seite bearbeiten → Blocks hinzufügen
5. **Komponente überschreiben:** Nur wenn HTML geändert werden muss — PHP-Datei vom Parent nach `components/` kopieren

### Regeln

- **Niemals das Parent Theme bearbeiten** — nur Child Theme
- **Farben immer als CSS-Variable** — nie hardcoded `#hex` in Templates
- **Nach CSS-Änderungen:** Immer `npm run build`
- **Custom Fonts:** In `functions.php` per `wp_enqueue_style()` einbinden, dann `--font-heading`/`--font-body` in custom.css setzen
- **Button-Links:** Feld-Typ ist `text` (nicht `url`) — `#anchor` und relative Pfade sind erlaubt
- **Bilder:** Immer `loading="lazy"` verwenden
- **Escaping:** Immer `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()` nutzen

### Jetzt starten

Bitte lies zuerst die `README.md` im Repo-Root und die `src/css/custom.css` im Child Theme. Dann können wir loslegen.

## PROMPT END
