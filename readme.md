# Spin The Wheel

## Version
`v1.3.0`

## Project Overview
This project is a WordPress-based "Spin & Win" campaign system with:
- Frontend spin wheel UI and form
- Server-side prize decision logic
- Duplicate entry prevention
- Admin dashboard with entry tracking
- CSV export of participants
- Optional Google Sheets webhook sync

## Core Functionality

### 1. Backend Core
File: `Spin Wheel Backend Core.php`
- Creates DB table: `wp_spin_wheel_entries` (with unique `email + mobile`)
- Defines prize quotas:
  - `voucher_1000`: 20
  - `voucher_500`: 110
  - `blnt`: 200
- Picks result on the server based on remaining quota
- Handles AJAX action: `spin_wheel`
- Validates/sanitizes form data
- Blocks duplicate participation (same email + mobile)
- Stores spin entry (name, email, mobile, location, result, spin_id, IP, user-agent)
- Sends data to Google Apps Script webhook asynchronously

### 2. Admin Dashboard
File: `Spin Wheel Dashboard.php`
- Adds WP Admin menu: **Spin Wheel**
- Shows result counts and submissions table
- Displays key entry fields (name, email, mobile, location, result, spin ID, date, IP)
- Supports CSV export of all entries

### 3. Shortcode UI
File: `Spin Wheel Shortcode UI.php`
- Registers shortcode: `[spin_wheel]`
- Renders wheel markup + participant form
- Includes consent checkbox and terms link

### 4. Frontend Styling & Logic
File: `Spin Wheel Frontend JS & CSS.html`
- Responsive UI for desktop/tablet/mobile
- Wheel visuals, pointer, and form styling
- Enables submit button only after valid form input
- Submits to `/wp-admin/admin-ajax.php` with action `spin_wheel`
- Animates wheel based on server response
- Displays final result message

## Data Captured Per Entry
- Full Name
- Email
- Mobile
- Location
- Result (`voucher_1000`, `voucher_500`, `blnt`)
- Spin ID
- IP Address
- User Agent
- Timestamp

## Current Prize Labels
- `voucher_1000` -> `₹1000 Voucher`
- `voucher_500` -> `₹500 Voucher`
- `blnt` -> `Better Luck Next Time`

## Versioning Rules (For Every Future Change)
1. Update the **Version** value at the top of this file.
2. Add a new entry in **Version History** with:
   - Version number
   - Date
   - What changed
3. Keep latest version at the top of the history.

## Version History
- `v1.3.0` (2026-03-08)
  - Rebuilt frontend UI to match the new premium design system (wheel stage, modern form card, live badge)
  - Added result modal popup flow with win/loss states and dismiss/reset behavior
  - Added custom form validation messaging and updated error placement below the action button
  - Updated consent row styling (smaller checkbox, centered alignment) and improved input affordance with visible light borders
  - Simplified wheel to a 2-layer visual structure and refined clacker positioning on the right edge across breakpoints
  - Preserved backend integration and AJAX contract (`action=spin_wheel`, same field keys, same endpoints)
  - Preserved current wheel image assets (`red.webp`, `green.webp`, `blue.webp`, `gray.webp`)

- `v1.2.0` (2026-03-08)
  - Revamped frontend UI styling and form layout for improved visual hierarchy
  - Updated desktop/mobile responsive sizing behavior for wheel and form
  - Fixed container width issues with full-bleed section behavior
  - Updated wheel segment image assets to new production URLs

- `v1.0.0` (2026-03-08)
  - Initial project documentation created in `read.me`
  - Documented existing V1 functionality and architecture
