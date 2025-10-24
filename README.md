# 🚀 Craft Starter Project

This project provides a ready-to-use **DDEV environment**, **Craft CMS configuration**, and a **prebuilt content builder** to accelerate development across Craft-based projects.

---

## 🧭 Overview

The **Craft Starter Project** serves as a baseline for all new Craft CMS projects.
It includes a minimal setup with core sections, a content builder, and an optimized DDEV workflow.
You can install it directly from **Packagist** using Composer — cloning the GitHub repository is **not required**.

---

## ⚙️ Requirements

Before you begin, make sure you have:

- [Docker](https://www.docker.com/)  
- [DDEV](https://ddev.readthedocs.io/en/stable/)  
- PHP ≥ 8.2  
- Composer ≥ 2.x  

---

## 🏗️ Installation

Follow the steps below to create and configure a new Craft CMS project using the starter pack.

### 1. Create a new project directory

```bash
mkdir my-craft-site && cd my-craft-site
```

### 2. Configure DDEV for Craft CMS

```bash
ddev config --project-type=craftcms --docroot=web
ddev start
```

### 3. Create a new project from the package

```bash
composer create-project "developion/craft:dev-master"
```

> 💡 Always use the **Packagist package** instead of cloning the GitHub repository.

### 4. Follow the CLI setup

During installation, the CLI will guide you through:
- Database configuration  
- Admin user setup  
- Site name and URL  
- Initial environment setup  

---

## 🔧 Environment Configuration

After the installation, open the generated `.env` file and ensure it includes the following values:

```dotenv
DISALLOW_ROBOTS=true
CP_TRIGGER=admin
ALLOW_ADMIN_CHANGES=true
DEV_MODE=true
ACTION_TRIGGER=actions
```

These variables configure the control panel trigger, development mode, and prevent indexing in local environments.

---

## 🧑‍💻 Local Development

### Launch the project

```bash
ddev launch
```

You’ll see a blank homepage — this is expected for a clean starter setup.

### Access the admin panel

```
https://your-project-name.ddev.site/admin
```

Login with the credentials you created during the CLI setup.

Once logged in, you can start building your site structure, fields, and templates.

---

## 🧩 Project Structure

The starter pack comes with a preconfigured Craft setup:

| Area | Description |
|------|--------------|
| **Home Page** | Single section ready for customization |
| **Pages Channel** | Fully working channel for standard pages |
| **Content Builder** | Includes 6 flexible block types for modular content |

You’re free to add, remove, or modify everything to match your project needs.

---

## 🎨 Frontend Development

### Building Assets

When you have installed the project, you also need to install Node modules for asset building.

1. **Install Node modules**  
   In the root of your project, run:  
   ```bash
   ddev npm ci
   ```

2. **Work with CSS**  
   Every time you work with CSS or make frontend changes, run:  
   ```bash
   ddev npm run dev
   ```

3. **Explore other commands**  
   You can view the rest of the available frontend commands in the `gulpfile.js` file.

---

## 🗂️ Example Directory Structure

```
craft-starter-project/
├── config/
│   ├── general.php
│   ├── db.php
│   └── routes.php
├── modules/
│   └── app/
├── templates/
│   ├── _layouts/
│   ├── _partials/
│   └── index.twig
├── web/
│   ├── index.php
│   └── cpresources/
├── composer.json
├── gulpfile.js
├── package.json
├── ddev/
└── .env
```

---

## 🧰 Useful Commands

| Command | Description |
|----------|-------------|
| `ddev start` | Start the DDEV containers |
| `ddev stop` | Stop all running DDEV containers |
| `ddev launch` | Open the site in your default browser |
| `ddev ssh` | Access the web container shell |
| `composer install` | Install dependencies |
| `composer update` | Update dependencies |
| `ddev npm ci` | Install Node modules |
| `ddev npm run dev` | Build frontend assets in development mode |

---

## ✨ Features

- ⚡ Preconfigured Craft CMS 4+ setup  
- 🧱 Content builder with 6 flexible block types  
- 🧩 Working Pages channel and Home single section  
- 🐳 DDEV-based Docker environment for local development  
- 🎨 Frontend build pipeline with npm and Gulp  
- 🔐 Ready `.env` configuration for local or staging environments  
- 🪶 Lightweight structure — easy to extend or customize  

---

## 📦 Package Information

- **GitHub Repository:**  
  [https://github.com/developion/craft-starter-project](https://github.com/developion/craft-starter-project)

- **Packagist Package:**  
  [https://packagist.org/packages/developion/craft](https://packagist.org/packages/developion/craft)

Use the Packagist package to install the latest stable or development version.

---