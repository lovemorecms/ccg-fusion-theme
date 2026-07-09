# CCG Fusion theme — start here



**Version 0.8.0** uses the **official CMS.gov Design System** (same library as the FUSION Sphere prototype). See **HOME-PAGE.md**, **EXPLORE-PAGE.md**, **ABOUT-PROGRAM-OVERVIEW-PAGE.md**, and **PATTERN-LIBRARY.md** for building pages with patterns.



**Local development:** this copy under LocalWP is the folder to edit day to day. See **DEVELOPMENT.md** for zip, GitHub, and Local workflow.



## What this folder is



A **WordPress block theme** (the design shell for the site). It is built from the FUSION Sphere prototype.



- **Editors** use Gutenberg patterns for page sections.

- **Developers** own global chrome: USA banner, header/mega nav, search, and footer.



## What’s included (v0.8)



### Global chrome (dev-owned)



| Component | How it works |

|-----------|----------------|

| USA banner | `inc/usa-banner.php` → template part `usa-banner` |

| Mega menu | `inc/mega-nav.php` → template part `header` |

| Site search | `inc/site-search.php` → panel below nav bar |

| Footer | `inc/footer.php` → template part `footer` |



### Pages & patterns

Patterns are grouped by **purpose** in the inserter (Hero, CTA, Cards, etc.) — see **PATTERN-LIBRARY.md**.

- **Home** — page layout + section patterns (`patterns/home-*.php`)
- **Explore** — section patterns + `page-explore.html` template
- **About / Program Overview** — section patterns + `page-program-overview.html` template
- **Marketing** — hero, two-column, CTA band patterns



### Stack



- CMS.gov Design System v12.4.5 (jsDelivr CDN, or vendored via `npm run vendor:cmsds`)

- Block theme templates in `templates/`

- Styles: `theme.css`, `mega-nav.css`, `home.css`, `explore.css`, `program-overview.css`



## Daily workflow (LocalWP)



1. Edit files in `CCG-WP-THEME`

2. Save

3. Hard refresh the browser at your Local site URL



No zip upload needed for local changes.



## Zip for staging / TasteWP



Zip the theme folder so WordPress sees a single root folder inside the archive (e.g. `ccg-wp-theme/`). See **DEVELOPMENT.md** for PowerShell commands.



## Folder structure



```

CCG-WP-THEME/

  style.css              ← WordPress theme header

  functions.php          ← version, enqueues, includes

  theme.json             ← layout widths, palette

  templates/             ← page layouts

  parts/                 ← template part stubs (PHP injects markup)

  patterns/              ← editor sections

  inc/                   ← usa-banner, mega-nav, site-search, footer, nav data

  assets/css/            ← theme + section styles

  assets/js/             ← mega-nav, search, home interactions

```



## What’s not included yet



- Knowledge Center doc templates and side nav

- Pixel-perfect inner pages beyond Home, Explore, and Program Overview

- Real WordPress pages for every nav destination (many links point to future routes)



## Questions?



Edit this theme folder in your IDE. Prototype reference: `Desktop/fusion-sphere/fusion-sphere`.

