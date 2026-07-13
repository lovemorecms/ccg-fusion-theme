# Build the Fusion Toolkit page on WordPress

## 1. Create the page

1. **Pages → Add New**
2. Title: **Fusion Toolkit** (admin/menus only — hidden on front end with this template)
3. **Page → Template**: choose **Fusion Toolkit page** or **Page (no title)**
4. Permalink slug: `fusion-toolkit` under parent **Explore** (`/explore/fusion-toolkit`)

## 2. Add content (choose one)

Patterns live in the **block editor inserter** (see **PATTERN-LIBRARY.md**).

### Option A — Full page (fastest)

**Patterns → Page layouts → Fusion Toolkit page layout**

### Option B — Section by section

| Order | Category | Pattern name |
|------|----------|----------------|
| 1 | Breadcrumbs | Fusion Toolkit breadcrumbs |
| 2 | Hero | Fusion Toolkit hero |
| 3 | Utilities | Fusion Toolkit sticky nav |
| 4 | Cards | Fusion Toolkit product grid |
| 5 | Content sections | Fusion Toolkit — BaseCamp |
| 6 | Content sections | Fusion Toolkit — Helix |
| 7 | Content sections | Fusion Toolkit — Lens |
| 8 | Content sections | Fusion Toolkit — Match |
| 9 | CTA | Fusion Toolkit footer band |

## Shared interior section nav (v0.9.0+)

Order is **breadcrumbs → hero → section nav → content**. The nav overlaps the hero bottom, pins under the site header, and hides breadcrumbs while pinned.

## What editors can change in the block editor

| Section | Editable in Gutenberg | HTML-only (icons, buttons, nav) |
|---------|----------------------|----------------------------------|
| Hero | Title, lede | Breadcrumbs, gradient glows, CTA buttons |
| Product grid | Each card title, tagline, body, “Learn more” link | Product icon |
| Product detail | Title, tagline, body, feature list items | Icon, action buttons, viz placeholder |
| Footer band | Heading, lede | CTA buttons |

Click a card or product section block to edit copy directly — no Custom HTML required for text updates.

## 3. Publish

View at `/explore/fusion-toolkit/`.

### Optional — CLI setup (LocalWP)

```powershell
$php = "$env:USERPROFILE\AppData\Roaming\Local\lightning-services\php-8.2.29+0\bin\win64\php.exe"
$ini = "$env:APPDATA\Local\run\<site-id>\conf\php\php.ini"
& $php -c $ini wp-content/themes/CCG-WP-THEME/bin/setup-fusion-toolkit-page.php
```

Replace `<site-id>` with your Local run folder under `%APPDATA%\Local\run\`.

## In-page anchors

| Anchor | Section |
|--------|---------|
| `#overview` | Hero |
| `#toolkit-grid` | Product grid |
| `#basecamp` | BaseCamp detail |
| `#helix` | Helix detail |
| `#lens` | Lens detail |
| `#match` | Match detail |

## After theme updates

Re-insert patterns or run `bin/setup-fusion-toolkit-page.php` to rebuild the page. Hard-refresh the editor if pattern categories look stale (theme v0.9.0+).
