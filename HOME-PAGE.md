# Build the Home page on WordPress

## 1. Set the front page

1. **Settings → Reading**
2. Choose **A static page**
3. **Homepage:** pick your Home page (or create one titled **Home**)
4. Save

The theme’s **Front Page** template already inserts the full homepage pattern. New sites get all sections automatically.

## 2. If the page is empty (existing site)

1. **Pages →** open your Home page
2. Open the block inserter → **Patterns → CCG Fusion — Home**
3. Insert **Home — full page (all sections)** once
4. **Update** and view the site

### Or insert section by section

| Order | Pattern |
|------|---------|
| 1 | Home — hero carousel |
| 2 | Home — Quick Access |
| 3 | Home — pathways |
| 4 | Home — Multi-Cloud Services |
| 5 | Home — Featured Resources |
| 6 | Home — Fusion Academy |
| 7 | Home — FUSION ecosystem |
| 8 | Home — Latest Announcements |

## 3. What you get

Matches the FUSION Sphere React homepage:

- Hero carousel with CMS primary background
- Quick Access icon grid
- “How can we help you today?” pathway pills
- Multi-Cloud Services full-bleed band
- Featured Resources cards
- Fusion Academy hero + offering tiles
- FUSION ecosystem orbit diagram + capability cards
- Latest Announcements horizontal scroll

Links use your WordPress site URL (e.g. `/explore/`, `/learn/knowledge-center/`, in-page `#pathways`).

## 4. Images

These files must be in the theme zip:

- `assets/images/sections/hero-cms-home-primary-blue.png`
- `assets/images/sections/new-bg-cloud.png`
- `assets/images/sections/fusion-academy-hero.png`
- `assets/images/sections/ecosphere/*.png`

Copy from the FUSION Sphere prototype `public/images/sections/` if any are missing after upload.

## 5. Editing content

Section copy lives in `inc/home/partials/*.php` (developer-maintained). Editors can still rearrange or remove pattern blocks in the page editor; to change default text long-term, update those partials and re-upload the theme.
