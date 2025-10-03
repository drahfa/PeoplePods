# Changelog

All notable changes to this project will be documented in this file.  
This project follows [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) format.  
Dates use `YYYY-MM-DD`.

---

## [0.92] – 2025-10-03 (Community Revival)

### Added
- New **Twitter-inspired theme** with responsive design and modern UI components.
- Updated default theme with better HTML5 compliance and browser support.

### Changed
- Full upgrade for **PHP 8+ compatibility** (previously only supported PHP 4/5).
- Modernized function calls and removed deprecated syntax.

### Fixed
- Resolved **layout duplication** in the profile edit template.
- Fixed missing `files/cache` directory initialization for proper caching functionality.

### Notes
- This version marks the **community revival** of PeoplePods after over a decade of inactivity.
- Original project was created by **XOXCO, Inc.** (last release: v0.91 in 2011).
- This revival release is maintained by *[Your Name]*.

---

## [0.91] – 2011-04-15

### Added
- Default theme upgraded to valid **HTML5** with improved markup and JavaScript.
- Tag system enhancements: tags can now be applied to users, groups, comments, and files.
- Plugin pods support schema changes, install/uninstall functions, and permalink patterns.
- `core_api_simple` pod rewritten with more endpoints.

### Fixed
- Improved query generation code in `Obj` class.
- More robust install process (all default pods enabled automatically).
- Foreign language comments saved and displayed properly.

---

## [0.81] – 2010-11-24

### Added
- New **Alerts system** (hybrid of private messaging and activity streams).
- Command Center tool for managing alerts, activity posts, and system emails.
- Person object gained `stub` and `fullname` fields.
- Support for attaching comments to Person objects and files to Group objects.
- Ability to override core functions for custom permissions, caching, templating, etc.

### Fixed
- Updated `$POD->sanitizeInput()` to support video embed tags and `<pre>` formatting.
- Numerous fixes to sloppy array calls → calmer error logs.

---

## [0.8] – 2010-12-10

### Added
- Redesigned Command Center tools.
- Expanded plugin system.
- New pods: **OpenID, Facebook, Twitter Connect**.
- `$stack->output` improvements, `$Obj->flagDate()`, and file object updates.
- Unit tests introduced in `tests/`.

---

## [0.7] – 2009-??-??

### Added
- Magic methods for object access (no longer requires `->get` / `->set`).
- Rewritten query engine with multi-meta field queries.
- `file->src()` for dynamic resizing.
- Tag cloud sidebar, flag/file browsing in admin.
- `$POD->getFiles()` method.

---

## [0.666] – 2009-10-31 (Developer Preview)

### Notes
- First developer preview release of PeoplePods.
- Introduced core pods, default theme, and extensible SDK architecture.
- Recommended approach: copy & modify pods/themes instead of editing originals.

---

## License
PeoplePods is released under the **MIT License**.  
See `LICENSE.txt` for details.
