# Build the Program Overview page on WordPress

## 1. Create the page

1. **Pages → Add New**
2. Title: **Program Overview**
3. **Page → Template** (right sidebar): choose **Program Overview page**
4. Permalink slug: `program-overview` under parent **About** (full path `/about/program-overview`)

## 2. Add content (choose one)

Patterns live in the **block editor inserter**, not in **Appearance → Editor → Patterns** (that library is for synced/reusable patterns you create manually).

1. Open the page in the block editor.
2. Click **+** (block inserter).
3. Go to **Patterns** → **CCG Fusion — About** (or search “About”).
4. Insert the full page or section patterns below.

### Option A — Full page (fastest)

Open **Patterns → CCG Fusion — About** and insert:

| Pattern |
|---------|
| **About — full page (Program Overview)** |

### Option B — Section by section

Insert **in this order**:

| Order | Pattern name |
|------|----------------|
| 1 | About — hero band |
| 2 | About — critical work |
| 3 | About — feature capabilities |
| 4 | About — services & stats |
| 5 | About — security |
| 6 | About — building together CTA |

Section headings and ledes in **critical work** and **services & stats** are core blocks — edit them directly in the editor.

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
| “Block contains unexpected or invalid content” after inserting a pattern | Delete the broken block and re-insert from **Patterns → CCG Fusion — About** (theme v0.7.2+ fixes group wrapper markup). Or run `bin/setup-program-overview-page.php` to rebuild the page. |
| “CCG Fusion — About” missing in Patterns | Hard-refresh the editor, confirm theme **CCG Fusion** v0.7.1+ is active, then try **Patterns → All** and search `About`. |
| Front end looks fine but editor is blank | Switch a Custom HTML block to **Edit as HTML** — if you see markup, replace the block using the patterns above. |
