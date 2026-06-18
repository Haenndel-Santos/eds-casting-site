# EDS Website Content Editing Manual

This website uses a small flat-file content layer. It is not a public CMS, does not have a login, and does not write to a database. Content is edited in PHP array files under `/data/` using VS Code, GitHub, or DirectAdmin.

The normal editing flow is: edit and test locally in VS Code, make a manual backup, then upload only the changed files through DirectAdmin.

## 1. Purpose of the Content Data Files

- `/data/faq-items.php` controls FAQ questions and answers.
- `/data/careers.php` controls open vacancy data.
- `/data/project-cases.php` controls project case content and visibility.
- `/data/original-parts.php` controls editable Original Parts support groups and part categories.
- `/data/site-settings.php` and `/data/navigation.php` are controlled reference files for site-level content.

## 2. Safety Rules Before Editing

Always make a backup before editing directly in DirectAdmin. Prefer editing locally in VS Code, testing locally, then uploading.

Do not edit PHP structure outside `/data/` unless you know what you are doing. Do not edit `includes/head.php`, `includes/header.php`, `includes/footer.php`, mail files, `.htaccess`, config files, tracking, reCAPTCHA, sitemap, or routing files without technical review.

Do not publish project cases without technical validation. Do not include customer names, supplier names, confidential drawings, prices, or internal technical values unless approved.

Draft data must not be treated as public website content. Product examples and draft project cases are working material until EDS has approved the wording, images, metrics and publication permission.

## 3. How to Edit FAQ Content

Open `/data/faq-items.php`. Each FAQ item has `question`, `answer`, `category`, `display_order`, and `is_active`.

Edit only the text between quotes. Keep commas and brackets intact.

## 4. How to Add a FAQ Item

Copy an existing FAQ block, paste it before the closing `];`, then change:

```php
'id' => 'new-question-id',
'question' => 'Your question?',
'answer' => 'Your answer.',
'category' => 'Company & Project Support',
'display_order' => 210,
'is_active' => true,
```

## 5. How to Remove or Deactivate a FAQ Item

Do not delete first. Hide it safely:

```php
'is_active' => false,
```

## 6. How to Edit Careers Content

Open `/data/careers.php`. Edit vacancy title, location, employment type, short description, responsibilities, and requirements.

## 7. How to Add a New Vacancy

Copy an existing vacancy block and change the values. Use:

```php
'status' => 'open',
'is_active' => true,
```

## 8. How to Close or Deactivate a Vacancy

To close a role without deleting it:

```php
'status' => 'closed',
'is_active' => false,
```

If no active open roles exist, the Vacancies page shows a professional fallback message.

## 9. How to Add a Project to the Home Page

In `/data/project-cases.php`, use:

```php
'show_on_home' => true,
'can_publish' => true,
'approval_status' => 'public_approved',
```

Only approved public projects should be shown.

## 10. How to Remove a Project from the Home Page

```php
'show_on_home' => false,
```

## 11. How to Add a Project to the Projects Page

```php
'show_on_projects' => true,
'can_publish' => true,
'approval_status' => 'public_approved',
```

## 12. How to Remove a Project from the Projects Page

```php
'show_on_projects' => false,
```

## 13. How to Add a Project to the Original Parts Page

Use `/data/original-parts.php` for Original Parts page category/support content. If a project case should later appear there, add this only after technical review:

```php
'show_on_original_parts' => true,
'can_publish' => true,
'approval_status' => 'public_approved',
```

## 14. How to Remove a Project from the Original Parts Page

```php
'show_on_original_parts' => false,
```

## 15. Publication Controls

To show a project on the Home page:

```php
'show_on_home' => true,
'can_publish' => true,
```

To hide it from the Home page:

```php
'show_on_home' => false,
```

To keep it internal only:

```php
'approval_status' => 'draft',
'can_publish' => false,
```

Use `approval_status`, `can_publish`, `show_on_home`, `show_on_projects`, and `show_on_original_parts` together. A public project must be approved and publishable.

## Local Preview for Draft Examples

The Projects page can show draft product/example preview cards only during local preview. This is controlled by `EDS_LOCAL_PREVIEW`.

Local preview is enabled automatically when testing on `localhost`, `127.0.0.1`, or `::1`. It can also be enabled by setting the environment variable `EDS_LOCAL_PREVIEW` to `true`, `1`, `yes`, or `on`.

In normal production mode, draft product examples from `/data/product-examples.php` are hidden even though the file still exists. To keep draft examples hidden from production, do not change the preview guard in `/pages-php/projects.php`, and do not set production environment variables that enable `EDS_LOCAL_PREVIEW`.

## 16. How to Add or Update Project Images

Upload optimized `.webp` images, then update the `image` field:

```php
'image' => '/assets/img/projects/case-studies/example-project.webp',
'image_alt' => 'Short approved description of the project image',
```

## 17. Recommended Image Folder and Naming

Use `/assets/img/projects/case-studies/`.

Use lowercase file names with hyphens, for example:

```text
movable-bracket.webp
rear-axle.webp
fusee-casting.webp
```

## 18. What Non-Technical Users Must Never Edit

Do not edit:

- `includes/head.php`
- `includes/header.php`
- `includes/footer.php`
- mail handlers
- `.htaccess`
- `generate-sitemap.php`
- `router.php`
- `i18n.php`
- reCAPTCHA settings
- tracking scripts
- global CSS

## 19. Basic Testing Checklist

After editing, test:

- Home page loads without errors.
- Projects page loads without errors.
- Original Parts page loads without errors.
- FAQ page loads without errors.
- Vacancies and Careers pages load without errors.
- Missing data files do not crash the website.
- Project visibility flags work correctly.
- Inactive FAQ items do not appear.
- Closed or inactive vacancies do not appear as open.
- Existing layout and CSS still look correct.
- No broken links were introduced.

## 20. DirectAdmin Upload Checklist

Before uploading through DirectAdmin, back up the current production versions of any files you plan to replace.

Files to back up before upload:

- Every changed file under `/data/`
- Every changed file under `/pages-php/`
- Every changed file under `/includes/`
- `/docs/content-editing-manual.md` if you upload documentation

Files safe to upload for this CMS change, if they are changed locally and tested:

- `/includes/content-loader.php`
- `/includes/home-project-results.php`
- `/pages-php/projects.php`
- `/pages-php/faq.php`
- `/pages-php/original-parts.php`
- `/pages-php/vacancies.php`
- `/data/faq-items.php`
- `/data/careers.php`
- `/data/project-cases.php`
- `/data/original-parts.php`
- `/data/site-settings.php`
- `/data/navigation.php`
- `/docs/content-editing-manual.md`

Upload only changed files. Do not upload unrelated local work.

Do not upload these files unless specifically reviewed:

- `.htaccess`
- `includes/head.php`
- `includes/header.php`
- `includes/validate-captcha.php`
- mail handlers
- config files

After upload, test the changed pages immediately in the browser.

## 21. Rollback Procedure

If something breaks, restore the last working file from your backup or Git. If editing in DirectAdmin, upload the previous working version of the changed data file. If unsure, set the changed item inactive:

```php
'is_active' => false,
```

or keep a project internal:

```php
'approval_status' => 'draft',
'can_publish' => false,
```
