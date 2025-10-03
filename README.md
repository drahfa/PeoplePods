# PeoplePods (Community Revival) – v0.92

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE.txt)  
![PHP Version](https://img.shields.io/badge/PHP-8%2B-blue.svg)

---

## 📖 Overview

**PeoplePods** is an SDK for creating flexible, community-driven web applications where people can meet, talk, share, read, work, publish, and explore.  

It is **not just a blog**, **not just a CMS**, and **not just a social network** — instead, it provides a unified set of tools ("pods") that you can combine to build all kinds of interactive web applications.

Originally created by **XOXCO, Inc.**, PeoplePods was last updated in 2011 (v0.91). Since then, the official site `peoplepods.net` and XOXCO itself have shut down.  
This project is a **community revival (v0.92)** — updated for **PHP 8+**, refreshed with modern themes, and maintained as an open-source project.

---

## 🚀 Features

- ✅ **PHP 8+ compatibility** (modernized from legacy PHP 4/5).  
- 🎨 New **Twitter-inspired theme** with responsive UI.  
- 🛠 Updated **default theme** with HTML5 compliance.  
- ⚡ Fixed caching, layout duplication, and other long-standing bugs.  
- 🔌 Extensible plugin system and customizable "pods".  

---

## 📦 Requirements

- PHP **8.0 or higher**  
- MySQL **4+** (tested on MariaDB 10+)  
- Web server (Apache/Nginx)  

---

## 🛠 Installation

1. Clone or download the repository:
   ```bash
   git clone https://github.com/yourusername/peoplepods.git
   cd peoplepods
   ```

2. Create a database and update your database credentials in:
   ```
   peoplepods/lib/etc/options.php
   ```

3. Run the installation script:
   ```
   /install/
   ```

4. Access the **Admin Command Center** at:
   ```
   /admin/
   ```

5. Start building your site by customizing themes and pods.

For more detailed steps, see [INSTALL.txt](INSTALL.txt).

---

## 🔄 Upgrading

To upgrade from a previous PeoplePods installation:

1. Backup your existing `peoplepods/` directory.  
2. Copy your customized `options.php`, pods, and themes.  
3. Replace old files with the new version.  
4. Restore your `options.php` and custom files.  
5. Visit `/admin/` to apply schema changes if needed.  

---

## 📜 Changelog

See [CHANGELOG.md](CHANGELOG.md) for detailed release notes.  
- v0.92 (2025) – Community revival, PHP 8 support, new themes.  
- v0.91 (2011) – Last official release by XOXCO.  

---

## 🙌 Acknowledgements

- **Original Author**: [XOXCO, Inc.](http://xoxco.com)  
- **Community Revival**: v0.92 maintained by *[Your Name]*  
- Thanks to all past contributors on PeoplePods.net.  

---

## 🤝 Contributing

This is a community-maintained fork. Contributions are welcome!  

- Report issues via [GitHub Issues](../../issues).  
- Submit pull requests for bug fixes and improvements.  
- See [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.  

---

## 📄 License

PeoplePods is released under the **MIT License**.  
See [LICENSE.txt](LICENSE.txt) for full details.
