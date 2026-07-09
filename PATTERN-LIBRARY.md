# Pattern library (v0.8+)

Theme patterns are grouped by **purpose** in the block inserter — not by page name. Core and WordPress.org remote patterns are disabled so editors mainly see theme patterns.

## Inserter categories

| Category | Use for |
|----------|---------|
| **Hero** | Page heroes (home carousel, interior + breadcrumbs, explore dark hero, marketing hero) |
| **CTA** | Gradient call-to-action bands |
| **Cards** | Image or numbered card grids |
| **Feature grid** | Icon + title + description columns |
| **Stats & metrics** | Stat rows and KPI blocks |
| **Content sections** | General body sections (roadmap, feeds, home tiles, two-column text) |
| **Checklist & lists** | Checkmark / icon lists |
| **Breadcrumbs** | Breadcrumb bars |
| **Page layouts** | Full-page starters (insert once) |
| **Utilities** | Scope wrappers and helpers |

## Program Overview

**Page layouts → Program Overview page layout** inserts all sections in order.

Or build section by section:

| Order | Pattern |
|------|---------|
| 1 | Hero → Interior hero with breadcrumbs |
| 2 | Cards → Three image cards |
| 3 | Feature grid → Four icon features |
| 4 | Stats & metrics → Four metrics |
| 5 | Checklist & lists → Checkmark list (two columns) |
| 6 | CTA → Gradient CTA band |

Optional: **Utilities → Sections scope wrapper** when assembling sections manually on a non–Program Overview template.

## Home & Explore

- **Page layouts → Home page layout** — full homepage starter
- Explore sections live under **Hero**, **Cards**, **Content sections**, and **CTA** (not a separate Explore category)

## Slugs (developers)

Internal slugs keep the `ccg-wp-theme/` prefix. Older `about-*` slugs remain registered for backward compatibility but are hidden from the inserter (`Inserter: no`).

## After theme updates

Saved page content does not auto-update when pattern files change. Re-insert patterns or run:

```powershell
$php = "$env:USERPROFILE\AppData\Roaming\Local\lightning-services\php-8.2.29+0\bin\win64\php.exe"
$ini = "$env:APPDATA\Local\run\<site-id>\conf\php\php.ini"
& $php -c $ini bin/setup-program-overview-page.php
```

Hard-refresh the editor if categories look stale after a version bump.
