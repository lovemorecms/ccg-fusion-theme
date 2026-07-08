# Local development (LocalWP)

**This folder is the active theme** for site `ccg-fusion-wp`:

```
C:\Users\LovemoreChirombo\Local Sites\ccg-fusion-wp\app\public\wp-content\themes\CCG-WP-THEME
```

## Daily workflow

1. Edit theme files here (PHP, CSS, JS, patterns).
2. Save.
3. Refresh the browser at your Local site URL (e.g. `http://ccg-fusion-wp.local`).

No zip upload needed for local changes.

## Zip for TasteWP or another host

From **inside** `wp-content/themes`, zip the theme folder so the archive looks like:

```
ccg-wp-theme.zip
  └── ccg-wp-theme/
        style.css
        functions.php
        ...
```

PowerShell example (run from `wp-content\themes`):

```powershell
Compress-Archive -Path "CCG-WP-THEME\*" -DestinationPath "ccg-wp-theme.zip" -Force
```

Then rename or restructure so WordPress sees a single folder named `ccg-wp-theme` inside the zip (lowercase is fine on Windows; use `ccg-wp-theme` on Linux hosts).

## GitHub (theme only)

Yes — you can use **only this theme folder** as a Git repository (not the whole WordPress install).

```powershell
cd "C:\Users\LovemoreChirombo\Local Sites\ccg-fusion-wp\app\public\wp-content\themes\CCG-WP-THEME"
git init
git add .
git commit -m "Initial CCG Fusion theme"
git branch -M main
git remote add origin https://github.com/YOUR_ORG/ccg-wp-theme.git
git push -u origin main
```

Add a `.gitignore` in this folder for things you should not commit, for example:

- `node_modules/`
- `assets/vendor/cmsds/` (if you vendor CMS DS locally)
- `.DS_Store`, `Thumbs.db`

Do **not** commit the full Local site (`app/public/wp-content/uploads`, database, etc.) — only this theme directory.

## Local editing

Open this theme folder in your editor (File → Open Folder) so paths match LocalWP. Keep changes scoped to this directory, not the full WordPress install.

## Prototype reference

React prototype (read-only reference):  
`Desktop\fusion-sphere\fusion-sphere`

Legacy Desktop copy of the theme (optional backup):  
`Desktop\ccg-wp-theme` — sync from here when Local is ahead.
