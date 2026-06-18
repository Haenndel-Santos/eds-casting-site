# EDS Casting Site

PHP website code for EDS Casting & Forging. This public repository is intentionally code-only: PHP templates, shared includes, CSS, JavaScript and web-server configuration.

## Structure

- `index.php` and `app.php` - public entry point and clean URL resolver.
- `pages-php/` - page templates.
- `includes/` - shared layout and components.
- `i18n.php` - server-side language helper code.
- `assets/css/` and `assets/js/` - public front-end code.

## Local Requirements

- PHP 8.x recommended.
- Web server with URL rewriting enabled for `.htaccess`.
- Mail/CAPTCHA credentials are intentionally loaded from `../config/mail.php`, outside this repository.
- Composer/PHPMailer dependencies are intentionally loaded from `../private_vendor/autoload.php`, outside this repository.
- Site content, translations, PDFs and images are intentionally excluded from this public repository.

## Demo Notes

This repository excludes temporary files, local uploads, debug logs, OS metadata, content data, translation data, PDFs, images, local utility scripts and heavy source project files such as CAD, PSD, TIFF, INDD and render archives.
