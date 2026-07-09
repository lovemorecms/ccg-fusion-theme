# Build the Program Overview page on WordPress

## 1. Create the page

1. **Pages → Add New**
2. Title: **Program Overview** (used in admin/menus only when the no-title template is selected)
3. **Page → Template** (right sidebar): choose **Program Overview page** or **Page (no title)**
4. Permalink slug: `program-overview` under parent **About** (full path `/about/program-overview`)

## Hide the WordPress page title

Block themes do not have a core **Hide title** checkbox. This theme uses **templates** instead:

| Template | Page title on front end |
|----------|-------------------------|
| **Page** (default) | Shows the page title above content |
| **Page (no title)** | Hidden — patterns supply the hero heading |
| **Program Overview page** | Hidden — same as no-title, plus Program Overview layout styles |
| **Explore page** | Hidden |

For any page built from section patterns (including **Test page 1** on the default template), the title is also hidden automatically when the content includes the `ccg-about-sections` wrapper from **Program Overview page layout**.

**Editor:** switch **Page → Template** to **Page (no title)** so the title block does not appear in the canvas either.

## 2. Add content (choose one)

Patterns live in the **block editor inserter**, not in **Appearance → Editor → Patterns** (that library is for synced/reusable patterns you create manually).

1. Open the page in the block editor.
2. Click **+** (block inserter).
3. Go to **Patterns** and pick a purpose category (see **PATTERN-LIBRARY.md**), or search by pattern name.

### Option A — Full page (fastest)

Open **Patterns → Page layouts** and insert:

| Pattern |
|---------|
| **Program Overview page layout** |

### Option B — Section by section

Insert **in this order**:

| Order | Category | Pattern name |
|------|----------|----------------|
| 1 | Hero | Interior hero with breadcrumbs |
| 2 | Cards | Three image cards |
| 3 | Feature grid | Four icon features |
| 4 | Stats & metrics | Four metrics |
| 5 | Checklist & lists | Checkmark list (two columns) |
| 6 | CTA | Gradient CTA band |

Section headings and ledes in **hero**, **cards**, **features**, **stats**, **checklist**, and **CTA** are core blocks — edit them directly in the editor.

**Still Custom HTML (by design):** breadcrumb bar, hero buttons, security checklist (icons + list), feature icons, and CTA button — these use CMS Design System markup that is easier to keep in small HTML blocks.

**Editable as blocks:** section headings/ledes, platform card images/titles/descriptions, stat values/labels, and feature card titles/descriptions.

## Using Program Overview patterns on other pages

You do **not** need the **Program Overview page** template on every page. Use the default page template.

1. **Pages → Add New** (any title/slug).
2. Insert **Program Overview page layout** once, **or** insert section patterns from the categories above in order.
3. Each pattern includes the `ccg-about-sections` scope class so **full-width hero/CTA bands** and section styles apply automatically.

Optional: insert **Sections scope wrapper** (Utilities) first if you are building the page piece by piece.

After updating the theme, **re-insert** patterns on pages that were built with an older version (boxed layout / HTML-only cards).

## 3. Publish

**Update** the page and view it at `/about/program-overview/`.

### Optional — CLI setup (LocalWP)

If PHP CLI is available with Local’s `php.ini` (mysqli enabled), you can create or refresh the page from the theme folder:

```powershell
$php = "$env:USERPROFILE\AppData\Roaming\Local\lightning-services\php-8.2.29+0\bin\win64\php.exe"
$ini = "$env:APPDATA\Local\run\<site-id>\conf\php\php.ini"
& $php -c $ini bin/setup-program-overview-page.php
& $php -c $ini bin/verify-program-overview-page.php
```

Replace `<site-id>` with your Local run folder (e.g. under `%APPDATA%\Local\run\`).

## 4. Verify navigation

Mega menu **About → Program Overview** (and panel links) should resolve to this page.

## Images

Platform cards use theme images in:

`assets/images/sections/program-overview/`

- `secure-platforms.jpg`
- `scalable-platforms.jpg`
- `stress-tested-platforms.jpg`

## In-page anchors

| Anchor | Section |
|--------|---------|
| `#critical-work` | Platform cards |
| `#services` | Stats row |
| `#about` | Breadcrumb About link (top of page) |

Hero **Get Started** links to the homepage pathways section (`/#pathways`).

## Editor troubleshooting

| Symptom | Fix |
|---------|-----|
| “Block contains unexpected or invalid content” after inserting a pattern | Delete the broken block and re-insert from **Patterns** (theme v0.7.2+ fixes group wrapper markup). Or run `bin/setup-program-overview-page.php` to rebuild the page. |
| Purpose categories missing in Patterns | Hard-refresh the editor, confirm theme **CCG Fusion** v0.8.0+ is active, then try **Patterns → All** and search by section name. |
| Front end looks fine but editor is blank | Switch a Custom HTML block to **Edit as HTML** — if you see markup, replace the block using the patterns above. |
