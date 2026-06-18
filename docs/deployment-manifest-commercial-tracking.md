# Commercial Tracking Deployment Manifest

This manifest covers the controlled production deployment package for the EDS commercial SEO/GEO, tracking, lead-classification, thank-you, and project-case safeguard work.

Do not upload the whole worktree blindly. The repository currently contains many unrelated modified and untracked files.

## Required Deployment Bundle

| File path | Reason for deployment | Dependency notes | Required now | Optional | Rollback note |
|---|---|---|---:|---:|---|
| `includes/head.php` | Loads modular CSS, GA4/dataLayer, conversion tracking, commercial CSS, and commercial overlays where needed. | Required by all rendered pages. Depends on `assets/js/eds-conversion-tracking.js`, `assets/css/components/eds-commercial.css`, and `assets/js/eds-commercial-overlays.js`. | Yes | No | Restore previous `head.php` if global CSS/JS loading breaks. |
| `includes/seo.php` | Adds SEO mapping for commercial pages and `/thank-you` noindex metadata. | Required for `/thank-you` route metadata and canonical/robots output. | Yes | No | Restore if page metadata or canonical output breaks. |
| `includes/header.php` | Fixes cookie banner include and global quote CTA target. | Depends on existing `includes/cookies-banner.php`. | Yes | No | Restore if header, menu, or fixed CTA breaks. |
| `includes/breadcrumbs.php` | Provides breadcrumb markup used by commercial pages. | Required if commercial pages include breadcrumbs. | Yes | No | Restore/remove related includes if breadcrumbs break rendering. |
| `includes/home-commercial-sourcing.php` | Home commercial sourcing section with tracked CTAs and overlays. | Depends on commercial CSS and overlay JS. | Yes, if home commercial section is part of release | No | Restore/remove include from `index.php` if home section breaks. |
| `assets/css/components/eds-commercial.css` | Styles commercial sections, cards, breadcrumbs, and commercial overlays. | Required by commercial pages through `includes/head.php`. | Yes | No | Restore/remove stylesheet reference if commercial layout breaks. |
| `assets/js/eds-commercial-overlays.js` | Opens and closes commercial info overlays. | Required for `[data-eds-modal-open]` elements. | Yes, if overlays are present | No | Restore/remove script reference if overlay behavior breaks. |
| `assets/js/eds-conversion-tracking.js` | Passive dataLayer event helper for CTA, overlay, contact, RFQ, file-count, success/error events. | Loaded by `includes/head.php`; safe when `dataLayer` is missing. | Yes | No | Remove script include or restore previous file if tracking creates console issues. |
| `assets/js/contact.js` | Keeps RFQ UI targeting correct while `/contact#request-quotation` points to a visible anchor. | Required by `/contact`; depends on IDs in `pages-php/contact.php`. | Yes | No | Restore with `pages-php/contact.php` if RFQ UI breaks. |
| `pages-php/contact.php` | Contact form field, campaign anchors, CAPTCHA markup, RFQ modal, and existing success modal. | Depends on `assets/js/contact.js`, `/new-leads`, reCAPTCHA, and existing CSS. | Yes | No | Restore if contact form markup, CAPTCHA, RFQ modal, or success flow breaks. |
| `pages-php/new-leads.php` | Lead category validation, internal priority, safe subject routing, email body updates. | Depends on PHPMailer config, DB config, CAPTCHA include, upload handling. | Yes | No | Restore immediately if real form submissions or email delivery fail. |
| `pages-php/projects.php` | Public case rendering guard for approved cases only; commercial focus area anchors. | Depends on `data/project-cases.php` and commercial CSS. | Yes | No | Restore if project page fails or case rendering is incorrect. |
| `data/project-cases.php` | Internal project-case structure with no public cases by default. | Required by `pages-php/projects.php`. | Yes | No | Restore empty data file or restore previous `projects.php` if include fails. |
| `pages-php/workflow.php` | Commercial workflow anchors and tracked CTAs. | Depends on commercial CSS; existing `assets/js/workflow.js` remains separate. | Yes, if commercial SEO/GEO section is part of release | No | Restore if workflow page layout or popups break. |
| `pages-php/industries-partners.php` | Commercial industry anchors and tracked CTAs. | Depends on commercial CSS. | Yes, if commercial SEO/GEO section is part of release | No | Restore if page layout breaks. |
| `pages-php/quality.php` | Commercial quality anchors and tracked CTAs. | Depends on commercial CSS. | Yes, if commercial SEO/GEO section is part of release | No | Restore if quality page layout breaks. |
| `pages-php/thank-you.php` | Noindex confirmation route for future/safe use. | Depends on `includes/head.php`, `includes/header.php`, footer includes, and `includes/seo.php`. | Yes, if `/thank-you` route is desired now | Optional for current form flow | Remove file and SEO map if route causes issues. |
| `generate-sitemap.php` | Excludes `/thank-you` from generated sitemap. | Only needed when regenerating sitemap. | Yes, before next sitemap generation | No | Restore if generator fails, then manually remove `/thank-you` from sitemap. |

## Documentation / Internal Only

| File path | Reason | Required on production | Rollback note |
|---|---|---:|---|
| `docs/project-case-data-checklist.md` | Internal checklist for collecting validated real EDS case data. | No | Keep out of public upload unless docs are intentionally deployed outside web root. |
| `docs/deployment-manifest-commercial-tracking.md` | This deployment control note. | No | Keep local/internal. |

## Files Modified But Not Part of This Deployment

Do not upload unrelated modified files simply because they are dirty in Git. Notable categories currently present in the worktree:

- Broad legacy CSS edits under `assets/css/pages-css/*`, `assets/css/components/*`, `assets/css/responsive.css`, and `assets/css/global-overrides.css`.
- Broad page rewrites under many `pages-php/*.php` files outside the commercial deployment set.
- Image additions/deletions under `assets/img/*`.
- JavaScript changes outside this deployment slice, such as `assets/js/global.js`, `assets/js/header.js`, and `assets/js/workflow.js`, unless already part of an approved earlier release.
- Language/i18n folders and files unless the production release explicitly includes them.

## Must Upload Together

- `includes/head.php`, `assets/js/eds-conversion-tracking.js`, `assets/css/components/eds-commercial.css`, and `assets/js/eds-commercial-overlays.js`.
- `pages-php/contact.php`, `assets/js/contact.js`, and `pages-php/new-leads.php`.
- `pages-php/projects.php` and `data/project-cases.php`.
- `pages-php/thank-you.php`, `includes/seo.php`, and `generate-sitemap.php` if `/thank-you` is included.

## Rollback Checklist

### If the contact form breaks

Restore:

- `pages-php/contact.php`
- `assets/js/contact.js`
- `pages-php/new-leads.php`

Then test CAPTCHA, RFQ modal, file upload validation, and one safe test submission.

### If tracking causes JavaScript errors

Restore or remove:

- `assets/js/eds-conversion-tracking.js`
- the tracking script line in `includes/head.php`

Then reload `/`, `/contact`, and `/projects` with DevTools console open.

### If the projects page breaks

Restore:

- `pages-php/projects.php`
- `data/project-cases.php`
- `assets/css/components/eds-commercial.css` if the break is visual

Then verify `/projects#project-focus-areas` and `/projects#second-sourcing-projects`.

### If sitemap generation fails

Restore:

- `generate-sitemap.php`

Then regenerate to a temporary file first and confirm `/thank-you` is absent before replacing production `sitemap.xml`.

### If `/thank-you` causes issues

Restore or remove:

- `pages-php/thank-you.php`
- `/thank-you` mapping in `includes/seo.php`
- `/thank-you` exclusion in `generate-sitemap.php` only if the page is removed

The current form flow can continue using `/contact?sent=1`.

## Pre-Upload QA Commands

Run from the public web root:

```powershell
php -l includes\head.php
php -l includes\seo.php
php -l includes\header.php
php -l includes\breadcrumbs.php
php -l includes\home-commercial-sourcing.php
php -l pages-php\contact.php
php -l pages-php\new-leads.php
php -l pages-php\projects.php
php -l pages-php\workflow.php
php -l pages-php\industries-partners.php
php -l pages-php\quality.php
php -l pages-php\thank-you.php
php -l data\project-cases.php
php -l generate-sitemap.php
```

Start a local server:

```powershell
php -S 127.0.0.1:8097 router.php
```

Check key routes:

```powershell
$routes = @('/', '/workflow', '/projects', '/industries-partners', '/quality', '/contact', '/thank-you')
foreach ($route in $routes) {
  (Invoke-WebRequest -Uri "http://127.0.0.1:8097$route" -UseBasicParsing).StatusCode
}
```

Check `/thank-you` noindex:

```powershell
(Invoke-WebRequest -Uri 'http://127.0.0.1:8097/thank-you' -UseBasicParsing).Content -match '<meta name="robots" content="noindex,follow"'
```

Check generated sitemap excludes `/thank-you`:

```powershell
$tmp = Join-Path $env:TEMP 'eds-sitemap-audit.xml'
php generate-sitemap.php --base=https://www.edscasting.com --out=$tmp
Select-String -Path $tmp -Pattern 'thank-you'
Remove-Item $tmp
```

Check contact markup:

```powershell
$html = (Invoke-WebRequest -Uri 'http://127.0.0.1:8097/contact#request-quotation' -UseBasicParsing).Content
$html -match 'class="g-recaptcha"'
$html -match 'id="request-quotation"'
$html -match 'id="rfqTriggerRow"'
$html -match 'action="/new-leads"'
```

Check tracking helper without dataLayer:

1. Temporarily open a page with DevTools console.
2. Run `delete window.dataLayer`.
3. Click a tracked CTA.
4. Confirm no console error and navigation still works.

Check project case guard:

1. Leave `data/project-cases.php` empty.
2. Open `/projects`.
3. Confirm no approved-case cards render.
4. Add a temporary draft case locally only, with `approval_status: draft` and `can_publish: false`.
5. Confirm it does not render.
6. Remove the temporary case before deployment.

## Manual Browser QA Checklist

Viewports:

- 1366px desktop
- 1024px tablet
- 768px tablet/mobile
- 480px mobile
- 390px mobile

Pages:

- `/`
- `/workflow`
- `/projects`
- `/industries-partners`
- `/quality`
- `/contact`
- `/thank-you`

Check on every page:

- Header layout is stable.
- Header overlay opens, closes, and traps focus acceptably.
- Breadcrumbs display where expected.
- CTAs fit inside their containers.
- Footer is visible and not overlapping content.
- No horizontal scrolling.
- No white text on white background.
- No broken images.
- No browser console errors.

Extra page-specific checks:

- Home: commercial overlays open and close.
- Workflow: workflow popups still work.
- Projects: focus-area anchors work; no unapproved case cards render.
- Industries & Partners: industry cards stack correctly on mobile.
- Quality: supplier risk and documentation anchors land correctly.
- Contact: contact category field is visible; RFQ UI appears when “Request a Quotation” is selected; CAPTCHA renders; success/error modal behavior is unchanged.
- Thank-you: page is short, noindex, and links back to Workflow, Projects, and Contact.

## Campaign Link QA

Open:

- `/?utm_source=test&utm_medium=manual&utm_campaign=engineering#engineering-driven-sourcing`
- `/workflow?utm_source=test&utm_medium=manual&utm_campaign=workflow#from-drawing-to-reliable-supply`
- `/projects?utm_source=test&utm_medium=manual&utm_campaign=projects#project-focus-areas`
- `/industries-partners?utm_source=test&utm_medium=manual&utm_campaign=industries#industries-we-support`
- `/quality?utm_source=test&utm_medium=manual&utm_campaign=quality#supplier-risk-reduction`
- `/contact?utm_source=test&utm_medium=manual&utm_campaign=contact#sourcing-challenge`
- `/contact?utm_source=test&utm_medium=manual&utm_campaign=rfq#request-quotation`

Confirm the page lands at the intended section and tracked events include UTM values in GA4/GTM DebugView when available.

## Production Post-Upload Checklist

1. Open `/`, `/workflow`, `/projects`, `/industries-partners`, `/quality`, `/contact`, and `/thank-you`.
2. Confirm CSS and JS assets load with `200` responses.
3. Submit one safe test contact form message.
4. Verify received email subject matches category/request type.
5. Verify category and internal priority appear in HTML and plain-text email body.
6. Verify CAPTCHA works.
7. Verify RFQ UI works and uploaded safe test attachment behavior is correct if tested.
8. Verify GA4/GTM DebugView events when available.
9. Validate structured data for key pages.
10. Regenerate sitemap only if required.
11. Confirm `/thank-you` is not in `sitemap.xml`.
12. Run PageSpeed mobile.
13. Check Search Console after deployment.

## Recommendation

Deploy only the required bundle listed above, not the whole dirty worktree.
