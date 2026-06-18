# EDS Casting Site

PHP website for EDS Casting & Forging. The repository contains the public site code, editable content data, styling, JavaScript, SEO routing, public assets and web-ready media needed to review or demo the site.

## Structure

- `index.php` and `app.php` - public entry point and clean URL resolver.
- `pages-php/` - page templates.
- `includes/` - shared layout and components.
- `data/` - editable structured content for navigation, projects, FAQ, careers and product examples.
- `lang/` and `i18n.php` - server-side language helpers and translations currently used by the site.
- `assets/css/`, `assets/js/`, `assets/img/` - public front-end assets.

## Local Requirements

- PHP 8.x recommended.
- Web server with URL rewriting enabled for `.htaccess`.
- Mail/CAPTCHA credentials are intentionally loaded from `../config/mail.php`, outside this repository.
- Composer/PHPMailer dependencies are intentionally loaded from `../private_vendor/autoload.php`, outside this repository.

## Demo Notes

This repository excludes temporary files, local uploads, debug logs, OS metadata, duplicate language exports, local utility scripts and heavy source project files such as CAD, PSD, TIFF, INDD and render archives. The committed project media is limited to the web-ready assets used by the site.