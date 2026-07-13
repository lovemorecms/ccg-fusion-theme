# Page layouts library (WordPress)

## URLs

| Page | Path | Template |
|------|------|----------|
| Library index | `/resources/page-layouts/` | Page layouts library |
| Landing template | `/resources/page-layouts/landing/` | Landing page layout |
| 2-column demo | `/resources/page-layouts/2-column/` | Page layouts library |
| 3-column demo | `/resources/page-layouts/3-column/` | Page layouts library |

Footer **Additional resources → Page layouts** links to the library index.

## CLI setup (LocalWP)

```powershell
$php = "$env:USERPROFILE\AppData\Roaming\Local\lightning-services\php-8.2.29+0\bin\win64\php.exe"
$ini = "$env:APPDATA\Local\run\<site-id>\conf\php\php.ini"
& $php -c $ini wp-content/themes/CCG-WP-THEME/bin/setup-page-layouts.php
```

## Landing template sections

Order: breadcrumbs → hero → shared section nav → cards → spotlight → metrics → compare → FAQ → timeline → partners → CTA.

Patterns are under **Page layouts**, **Hero**, **Cards**, **Content**, **CTA**, and **Utilities** (landing section nav).

Full insert: **Patterns → Page layouts → Landing page layout (full)**.

## Notes

- Landing reuses Fusion Toolkit hero styles (`.ft-hero`) and the shared interior section nav.
- Card layout tabs, compare tabs, and FAQ accordion are enhanced by `assets/js/landing-page-layout.js`.
- Soft section motion from the React prototype is not ported yet.
