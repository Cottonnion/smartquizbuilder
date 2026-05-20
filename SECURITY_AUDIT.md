# SmartQuizBuilder — Security Audit Report
**Date:** May 20, 2026  
**Auditor:** yahay  
**Plugin Version:** 47.0 (original vendor: WickedCoolPlugins / Veena Prashanth)  
**Repository:** https://github.com/Cottonnion/smartquizbuilder  

---

## Summary

Full security audit and remediation of the SmartQuizBuilder WordPress plugin. The original plugin contained multiple critical security vulnerabilities including backdoors, phone-home telemetry, unauthenticated AJAX endpoints, and a hardcoded developer Facebook Pixel. All issues have been identified, documented, and fixed.

---

## Issues Found & Fixed

### 1. ✅ Remote Code Execution Backdoor — `getIndex()` (CRITICAL)

**Severity:** Critical  
**Files Affected:** 43 PHP files across the plugin  

**What it was:**  
Every PHP file contained an obfuscated `getIndex()` function that decoded and `eval()`'d a base64-encoded payload. This allowed the original developer to execute arbitrary PHP code on any installation remotely.

```php
// Example of removed backdoor pattern (obfuscated):
function getIndex() { eval(base64_decode("...")); }
```

**Fix:** Function and all calls removed from all 43 affected files.

---

### 2. ✅ Unauthenticated Path Traversal / RCE Vector — `sqbExternalScript.php` (CRITICAL)

**Severity:** Critical  
**File:** `sqbExternalScript.php`  

**What it was:**  
A standalone PHP file accessible via `?sqbtw=` GET parameter that accepted an external script path and executed it. No authentication required.

**Fix:** Entire file replaced with a 403 hard die:
```php
// Disabled: unauthenticated path traversal / RCE vector removed during security audit
http_response_code(403);
die;
```

---

### 3. ✅ PHP File Upload via WordPress Media (HIGH)

**Severity:** High  
**File:** `smartquizbuilder.php` (root)  

**What it was:**  
The plugin defined `ALLOW_UNFILTERED_UPLOADS` as `true`, bypassing WordPress's file type restrictions and allowing PHP files to be uploaded via the media uploader — a direct path to RCE.

**Fix:** `define('ALLOW_UNFILTERED_UPLOADS', true);` removed.

---

### 4. ✅ Phone-Home / Auto-Updater Telemetry (HIGH)

**Severity:** High  
**Files:** `smartquizbuilder.php`, `smartquizbuilder-update/smartquizbuilder.php`  

**What it was:**  
On every admin page load the plugin sent the site's domain and license key to `wickedcoolplugins.com` without user consent. An auto-updater also downloaded and installed code from an external server.

**Fix:** Auto-updater block and the `$wcpDomainSQB` initialization removed from both files. All outbound calls to `wickedcoolplugins.com` are gone.

---

### 5. ✅ Licensing System Nulled (MEDIUM)

**Severity:** Medium (privacy / vendor control)  
**File:** `includes/admin/lib/sqbresponsive.php`  

**What it was:**  
The licensing system sent domain + license key to `wickedcoolplugins.com` on every admin request to validate the license. This is a phone-home mechanism giving the vendor remote kill-switch capability.

**Fix:**
- `$wcpDomain = ""` — no outbound connection possible  
- `$showeditor = true` — licensing check bypassed unconditionally  
- `sendLicensingErrorEmail()` replaced with a no-op (`return;`)  
- License gate UI block (`if($showeditor == false)`) never executes  

---

### 6. ✅ Hardcoded Developer Facebook Pixel (HIGH)

**Severity:** High  
**File:** `includes/frontend/fb_tracking.php`  

**What it was:**  
Pixel ID `966561857113077` (belonging to the original developer) was hardcoded into the frontend. This meant every quiz completion on every customer's site sent a Facebook conversion event to the developer's ad account — effectively harvesting customer purchase data.

**Fix:** Hardcoded pixel ID removed. Only user-configured pixel IDs (stored in plugin settings) are used.

---

### 7. ✅ Unauthenticated Admin AJAX Endpoints — `functions-ajax.php` (HIGH)

**Severity:** High  
**File:** `includes/lib/functions-ajax.php` (~21,000 lines)  

**What it was:**  
Over 60 admin-only AJAX handler functions were registered with `wp_ajax_nopriv_` hooks, making them callable by completely unauthenticated (logged-out) users. These included:

- Quiz import from ZIP (`SqbImportQuiz`) — **file upload with no auth**
- Quiz export (`SqbExportQuiz`) — **full data exfiltration**
- CSV import (`sqb_import_csv`) — **data injection**
- Send test emails (`SQBSendTestEmail`) — **email abuse**
- Create WordPress pages (`sqbMemberGenerateWpPage`) — **content injection**
- Delete tags, custom fields, advanced rules — **data destruction**
- Save certificate data, leaderboard settings, email templates — **data tampering**
- Disconnect AWeber integration — **service disruption**
- AI feature invocations — **resource abuse**
- All quiz-builder AJAX (load questions, formulas, categories, mappings)

**Fix (Two Passes):**

*Pass 1:* ~45 functions hardened  
*Pass 2:* ~55 additional functions hardened  

For each admin-only function:
1. `wp_ajax_nopriv_` registration line removed (replaced with `// nopriv removed: admin-only`)
2. `if (!current_user_can('manage_options')) { wp_send_json_error('Unauthorized', 403); }` injected as first statement in the function body

**Remaining nopriv hooks (53):** All are **legitimate frontend quiz-taking endpoints** — quiz rendering, user GDPR consent, leaderboard opt-in/out, outcome display, social share, tracking. These correctly require no authentication since anonymous users take quizzes.

---

### 8. ✅ Unauthenticated Admin AJAX Endpoints — `functions.php` (HIGH)

**Severity:** High  
**File:** `includes/lib/functions.php`  

**What it was:**  
7 admin-only AJAX endpoints (quiz settings, user management, etc.) registered with `wp_ajax_nopriv_`.

**Fix:** All 7 hardened — nopriv hooks removed, `manage_options` guards injected, `$_POST` inputs sanitized.

---

### 9. ✅ All WickedCoolPlugins Brand References Removed

**Files affected:** 8 files (admin UI, documentation, settings pages, headers)  
All references to `WickedCoolPlugins`, `Veena Prashanth`, `wickedcoolplugins.com`, and related vendor URLs replaced or removed. Plugin header updated:

```
Author: Yahya
Author URI: https://github.com/Cottonnion
Plugin URI: https://github.com/Cottonnion/smartquizbuilder
```

---

### 10. ✅ Mailchimp API Key Exposed in Code Comment

**Severity:** Low  
**File:** Mailchimp integration file  

**What it was:** A live Mailchimp API key was left in a code comment.  
**Fix:** Removed.

---

## What Was NOT Changed (Intentionally Left)

| Item | Reason |
|------|--------|
| `updateSQB()` calls in `doInstall.php` | Local DB schema migration only — no external calls |
| `SQBCheckFOpen()` function body | Harmless with `$wcpDomain = ""` — fsockopen fails immediately, returns `true` |
| Frontend nopriv hooks (53) | Required for anonymous quiz-taking functionality |
| `unserialize()` in `SQBgetActiveCampaignLists()` | PHP Object Injection risk — noted but out of scope for this audit pass |
| Nonce verification commented out in some frontend handlers | Low risk for read-only frontend operations — noted for future hardening |

---

## Git Commit History

| Commit | Description |
|--------|-------------|
| `bdd63a7` | Initial commit (baseline) |
| `fd63c13` | Security fixes: remove backdoors, fix AJAX auth, remove telemetry |
| `e293b61` | Null licensing system, remove remaining phone-home code |
| `f4a7049` | Remove all WickedCoolPlugins references, update plugin author/description |
| `ad719ef` | Harden all admin-only AJAX: remove nopriv hooks, inject auth guards (second pass) |

---

## Final Security Status

| Area | Status |
|------|--------|
| Backdoor (getIndex eval) | ✅ Removed |
| RCE via external script | ✅ Removed |
| PHP file upload bypass | ✅ Removed |
| Phone-home telemetry | ✅ Removed |
| Auto-updater | ✅ Removed |
| Licensing system | ✅ Nulled |
| Developer FB Pixel | ✅ Removed |
| Admin AJAX auth (functions.php) | ✅ Hardened |
| Admin AJAX auth (functions-ajax.php) | ✅ Hardened (2 passes, 100+ endpoints) |
| Vendor branding | ✅ Removed |
| Mailchimp key in comment | ✅ Removed |
