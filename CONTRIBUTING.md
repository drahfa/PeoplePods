# Contributing to PeoplePods (Community Revival)

First off, thank you for considering contributing to PeoplePods! 🎉  
This project is the **community-maintained revival** of the original PeoplePods SDK (by XOXCO, Inc.), updated for PHP 8+ and modern web development.  
Contributions of all kinds are welcome — from bug reports and documentation to new features and themes.

---

## 📌 How to Contribute

### 1. Reporting Issues
- Use [GitHub Issues](../../issues) to report bugs or request features.
- Please include:
  - A clear description of the problem.
  - Steps to reproduce (if it’s a bug).
  - Your environment (PHP version, MySQL/MariaDB version, OS).
  - Screenshots or logs (if relevant).

### 2. Suggesting Features
- Open a **feature request issue** first before writing code.
- Explain *why* the feature would be useful.
- Propose how it fits into the PeoplePods ecosystem.

### 3. Submitting Pull Requests
- Fork the repository and create a new branch:
  ```bash
  git checkout -b feature/my-feature
  ```
- Make your changes, following our [Coding Guidelines](#-coding-guidelines).
- Write clear commit messages (e.g., `fix: resolve caching issue in Twitter theme`).
- Submit a Pull Request with:
  - A clear description of what you changed and why.
  - References to related issues (if any).

### 4. Writing Documentation
- Improvements to `README.md`, `INSTALL.txt`, and inline code comments are very welcome.
- If you add a new feature, update documentation so others can use it.

---

## 🧑‍💻 Coding Guidelines

- Target **PHP 8+** (strict types and modern syntax where possible).
- Follow PSR-12 coding style (https://www.php-fig.org/psr/psr-12/).
- Use meaningful variable and function names.
- Keep backwards compatibility where possible (avoid breaking legacy APIs unless absolutely necessary).
- Add comments where logic may not be obvious.

---

## ✅ Submitting Themes or Pods

PeoplePods is designed to be extensible. If you create:
- **Themes** → put them under `/themes/` and ensure they are responsive/mobile-friendly.
- **Pods** → document installation and usage clearly.

Please also include:
- Screenshots (for themes).
- Example code or usage instructions (for pods).

---

## 🙌 Community Acknowledgement

- **Original Author**: XOXCO, Inc. (last release v0.91, 2011).
- **Community Revival**: v0.92 and onwards maintained by the open-source community.

We will credit contributors in the [CHANGELOG.md](CHANGELOG.md) and release notes.

---

## 📄 License

By contributing, you agree that your code will be released under the **MIT License**, in line with the rest of the project.
