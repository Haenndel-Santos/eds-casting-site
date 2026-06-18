# EDS Project Case Data Checklist

Use this checklist before adding any real project case to `data/project-cases.php`.

## Project Basics

- Project title
- Industry
- Component type
- Material
- Casting, forging, machining or finishing process
- Customer problem
- Supplier problem, if relevant
- EDS contribution
- Quality documents involved
- Photos or visual evidence available

## Publication Permissions

- Customer name may be used: yes/no
- Supplier name may be used: yes/no
- Result may be described publicly: yes/no
- Savings may be quantified: yes/no
- Lead time may be quantified: yes/no
- Photos may be published: yes/no
- Confidential details removed or generalized: yes/no

## Approval Status

- Internal approval status: draft/internal/public_approved
- Public approval status confirmed by responsible EDS contact: yes/no
- `approval_status` set to `public_approved`: yes/no
- `can_publish` set to `true`: yes/no
- Public case URL created and tested: yes/no
- `public_url` added to the case data only after the URL exists: yes/no

Only publish cases when the content is validated, permission is clear, the public URL exists, and both `approval_status === public_approved` and `can_publish === true`.
Draft cases and cases without an explicit `public_url` must not be added to the sitemap.

## Before Publishing Product Examples

- Technical values are still valid
- Old price tables are removed
- Incomplete fields are not shown
- Image path is approved
- EDS has permission to publish the visual material
- Commercial owner approves publication
- `approval_status` is `public_approved`
- `can_publish` is `true`

## Technical Validation Before Publication

Before publishing a project case, confirm:

- The original problem is described accurately
- The production route is correct
- Material designation is correct
- Casting, forging or machining process is correct
- Parting line, tooling, core, machining or gating claims are approved if mentioned
- Percentages are validated internally
- Images are approved
- No supplier, customer, partner, school, personal name or internal project number is exposed
- The wording does not imply EDS manufactured the part in-house
- `approval_status` is `public_approved`
- `can_publish` is `true`
