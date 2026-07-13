# Build the Explore page on WordPress

## 1. Create the page

1. **Pages → Add New**
2. Title: **Explore**
3. **Page → Template** (right sidebar): choose **Explore page**
4. Permalink slug: `explore` (`/explore/`)

## 2. Add content (choose one)

### Option A — Full page (fastest)

**Patterns → Page layouts → Explore page layout**

Or run:

```powershell
$php = "$env:USERPROFILE\AppData\Roaming\Local\lightning-services\php-8.2.29+0\bin\win64\php.exe"
$ini = "$env:APPDATA\Local\run\<site-id>\conf\php\php.ini"
& $php -c $ini wp-content/themes/CCG-WP-THEME/bin/setup-explore-page.php
```

### Option B — Section by section

| Order | Category | Pattern name |
|------|----------|----------------|
| 1 | Breadcrumbs | Interior breadcrumbs (Explore) |
| 2 | Hero | Dark hero with image |
| 3 | Utilities | Explore section nav |
| 4 | Cards | Explore platforms grid |
| 5 | Content sections | Platform roadmap timeline |
| 6 | Content sections | What's happening feed |
| 7 | Content sections | Learn and get started steps |
| 8 | CTA | Getting started CTA (three cards) |

## Shared interior section nav (v0.9.0+)

The Explore section nav overlaps the bottom of the hero, then pins under the site header on scroll. When pinned, breadcrumbs hide automatically.

Section anchors: `#overview`, `#platforms`, `#roadmap`, `#whats-happening`, `#learn-connect`, `#getting-started`.

## Hero image

The hero uses `assets/images/sections/initiatives-hero-cms-gov.png` inside the theme.

## After theme updates

Re-insert **Explore page layout** or run `bin/setup-explore-page.php` so the shared section nav and section IDs are present. Hard-refresh the front end.
