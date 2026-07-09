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

| 2 | Utilities | Fusion Toolkit sticky nav |

| 3 | Hero | Fusion Toolkit hero |

| 4 | Cards | Fusion Toolkit product grid |

| 4 | Content sections | Fusion Toolkit — BaseCamp |

| 5 | Content sections | Fusion Toolkit — Helix |

| 6 | Content sections | Fusion Toolkit — Lens |

| 7 | Content sections | Fusion Toolkit — Match |

| 8 | CTA | Fusion Toolkit footer band |



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



## 4. Verify navigation



Mega menu **Explore → Fusion Toolkit** (and in-page anchors) should resolve to this page.



## In-page anchors



| Anchor | Section |

|--------|---------|

| `#overview` | Hero |

| `#toolkit-grid` | Product grid |

| `#basecamp` | BaseCamp detail |

| `#helix` | Helix detail |

| `#lens` | Lens detail |

| `#match` | Match detail |



Sticky nav appears after scrolling past the hero and highlights the active section.



## After theme updates



Re-insert patterns or run `bin/setup-fusion-toolkit-page.php` to rebuild the page. Hard-refresh the editor if pattern categories look stale (theme v0.8.4+).

