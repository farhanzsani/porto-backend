# Frontend Pages Specification - FarhanSAI Core CMS

> Dokumentasi lengkap halaman-halaman yang perlu dibuat untuk frontend admin panel

---

## 📑 Daftar Isi

- [A. Halaman Autentikasi](#a-halaman-autentikasi)
- [B. Halaman Admin Panel](#b-halaman-admin-panel)
- [C. Komponen Global](#c-komponen-global)
- [D. Fitur Tambahan](#d-fitur-tambahan)
- [E. Teknologi Frontend](#e-teknologi-frontend)

---

## A. Halaman Autentikasi

### 1. Login Page
**Route:** `/login`  
**Controller:** `Auth\AuthenticatedSessionController`

**Komponen:**
- Form login dengan fields:
  - Email (required, email format)
  - Password (required, min 8 characters)
  - Remember me (checkbox)
- Link "Forgot Password"
- Link "Register" (jika registration diaktifkan)
- Submit button
- Error messages display

**Behavior:**
- Redirect ke `/admin` jika user role = admin/editor
- Redirect ke `/dashboard` jika user role = user
- Show validation errors
- Rate limiting: max 5 attempts per minute

**UI Requirements:**
- Responsive design (mobile-first)
- Loading state saat submit
- Password visibility toggle
- Auto-focus pada email field

---

### 2. Register Page
**Route:** `/register`  
**Controller:** `Auth\RegisteredUserController`

**Komponen:**
- Form registrasi dengan fields:
  - Name (required, max 255)
  - Email (required, email, unique)
  - Password (required, min 8, confirmation)
  - Password Confirmation (required, same as password)
- Link ke login page
- Submit button
- Terms & conditions checkbox (optional)

**Behavior:**
- Email verification required setelah register
- Redirect ke email verification notice
- Default role: user

---

### 3. Forgot Password
**Route:** `/forgot-password`  
**Controller:** `Auth\PasswordResetLinkController`

**Komponen:**
- Form dengan field:
  - Email (required, email)
- Submit button "Send Reset Link"
- Link back to login
- Success message after submit

**Behavior:**
- Send password reset email
- Rate limiting: max 1 request per minute
- Show success message even if email not found (security)

---

### 4. Reset Password
**Route:** `/reset-password/{token}`  
**Controller:** `Auth\NewPasswordController`

**Komponen:**
- Form dengan fields:
  - Email (required, readonly/prefilled)
  - New Password (required, min 8, confirmation)
  - Password Confirmation (required)
- Submit button
- Password strength indicator

**Behavior:**
- Validate token
- Show error if token expired/invalid
- Redirect to login after success
- Auto-login after password reset

---

### 5. Email Verification
**Route:** `/verify-email`  
**Controller:** `Auth\EmailVerificationPromptController`

**Komponen:**
- Notice message
- Button "Resend Verification Email"
- Logout button
- Success message after resend

**Behavior:**
- Show only if email not verified
- Rate limit resend: max 1 per minute
- Auto-redirect jika sudah verified

---

## B. Halaman Admin Panel

### Dashboard

#### 6. Admin Dashboard
**Route:** `/admin`  
**Controller:** `Admin\DashboardController@index`  
**Middleware:** `auth`, `admin`

**Sections:**

**1. Statistics Cards (4 cards)**
```
- Total Projects: count dari projects table
- Total Technologies: count dari technologies table  
- Total Inquiries: count dari inquiries table
- Total Users: count dari users table
```

**2. Recent Projects Table**
- Display: 5 latest projects
- Columns:
  - Title
  - Client
  - Technologies (badges)
  - Created At
  - Actions (View, Edit)
- Link "View All Projects"

**3. New Inquiries Table**
- Display: 5 inquiries dengan status = 'new'
- Columns:
  - Name
  - Email
  - Company
  - Message (truncated, max 50 chars)
  - Date
  - Status badge
  - Actions (View)
- Link "View All Inquiries"

**4. Quick Actions**
- Button: Create New Project
- Button: View All Inquiries
- Button: Manage Users

**UI Requirements:**
- Cards dengan icon & color coding
- Responsive grid layout
- Loading skeleton saat fetch data
- Empty state jika no data

---

### Projects Management

#### 7. Projects List
**Route:** `/admin/projects`  
**Controller:** `Admin\ProjectController@index`

**Features:**
- Search box (search by title, client, description)
- Filter by technology (dropdown multi-select)
- Sort by: newest, oldest, title A-Z, title Z-A

**Table Columns:**
- Thumbnail (featured_image, 80x80px)
- Title (clickable → view page)
- Slug
- Client
- Technologies (badges, max 3 visible + count)
- View Count
- Created At
- Actions dropdown:
  - View
  - Edit
  - Delete (with confirmation)

**Pagination:** 10 items per page

**Top Actions:**
- Button: Create New Project (primary)
- Button: Export to CSV (optional)

**UI Requirements:**
- Responsive table (card view on mobile)
- Technology badges dengan color
- Confirmation modal untuk delete
- Bulk actions (optional: bulk delete)
- Empty state dengan illustration

---

#### 8. Create Project
**Route:** `/admin/projects/create`  
**Controller:** `Admin\ProjectController@create`

**Form Sections:**

**1. Basic Information**
- Title (text input, required, max 255)
  - Auto-generate slug saat typing
- Slug (text input, optional, unique)
  - Editable, show validation
- Description (textarea, required, max 500)
  - Character counter
- Content (rich text editor, required)
  - WYSIWYG editor atau Markdown
  - Support: bold, italic, lists, links, code blocks
  - Image upload dalam content

**2. Featured Image**
- Image upload (drag & drop atau browse)
- Preview thumbnail
- Max size: 5MB
- Accepted: jpeg, png, jpg, gif, webp
- Recommended size info: 1200x630px

**3. Project Details**
- Client (text input, optional, max 255)
- Project URL (url input, optional)
  - Validation: valid URL format
- GitHub URL (url input, optional)
  - Validation: valid URL format

**4. Technologies**
- Multi-select checkbox list atau tag input
- Search/filter technologies
- Show technology icon/logo
- Create new technology (quick add modal)

**5. Media Gallery (Repeater)**
- Add Media button
- Each media item:
  - File upload (image/video/document)
  - File Type (auto-detect, bisa override)
  - Title (text input, optional)
  - Preview thumbnail
  - Remove button
- Drag to reorder
- Max file size: 10MB
- Accepted formats:
  - Images: jpeg, png, jpg, gif, webp
  - Videos: mp4, webm, mov
  - Documents: pdf

**Actions:**
- Save Project (submit)
- Save as Draft (optional)
- Cancel (back to list)

**Validation:**
- Client-side validation
- Display server errors
- Prevent duplicate slug
- Required fields indicator

**UI Requirements:**
- Multi-step wizard atau single long form
- Auto-save draft (optional)
- Unsaved changes warning
- Preview mode
- Progress indicator

---

#### 9. Edit Project
**Route:** `/admin/projects/{id}/edit`  
**Controller:** `Admin\ProjectController@edit`

**Same as Create, dengan tambahan:**
- Pre-filled dengan data existing
- Show existing featured image dengan option Remove
- Show existing media gallery:
  - Option to delete individual media
  - Upload new media
- Show created_at & updated_at timestamps
- Show view count (readonly)

**Additional Actions:**
- View Project (open in new tab)
- Delete Project (bottom, danger button)

---

#### 10. View Project
**Route:** `/admin/projects/{id}`  
**Controller:** `Admin\ProjectController@show`

**Display Sections:**

**1. Header**
- Title (h1)
- Status badge (published, draft)
- Quick actions: Edit, Delete

**2. Featured Image**
- Full width image
- Lightbox on click

**3. Project Information**
- Slug (copyable)
- Client
- Project URL (clickable link, open new tab)
- GitHub URL (clickable link, open new tab)
- Description
- Content (formatted HTML/markdown render)

**4. Technologies**
- List dengan icon/logo
- Badge style
- Link ke technology page

**5. Media Gallery**
- Grid layout (3-4 columns)
- Thumbnails untuk images
- Play icon untuk videos
- File icon untuk documents
- Lightbox/modal untuk preview
- Title display

**6. Metadata**
- View Count
- Created At (formatted date)
- Updated At (formatted date)
- Created By (user name)
- Last Updated By

**Actions:**
- Back to List
- Edit Project
- Delete Project (with confirmation)
- Duplicate Project (optional)

---

#### 11. Delete Project (Modal)
**Trigger:** Click delete button dari list/view/edit page

**Modal Content:**
- Warning title: "Delete Project?"
- Message: "Are you sure you want to delete '[Project Title]'? This action cannot be undone."
- Warning: "This will also delete all associated media files."
- Checkbox: "I understand this action is permanent"
- Actions:
  - Cancel (secondary)
  - Delete (danger, disabled until checkbox checked)

**Behavior:**
- Delete project record
- Delete featured_image dari storage
- Delete all project_media files dari storage
- Delete project_media records
- Remove technology associations
- Soft delete (deleted_at timestamp)
- Redirect to projects list dengan success message

---

### Technologies Management

#### 12. Technologies List
**Route:** `/admin/technologies`  
**Controller:** `Admin\TechnologyController@index`

**Features:**
- Search box (by name)
- Filter by category (jika ada)
- Sort by: name A-Z, newest, most used

**Table Columns:**
- Icon/Logo (thumbnail 40x40px)
- Name (clickable → edit)
- Slug
- Category (optional)
- Projects Count (link to filtered projects)
- Created At
- Actions:
  - Edit
  - Delete (disabled jika ada projects using it)

**Top Actions:**
- Create New Technology (button)

**Pagination:** 20 items per page

**UI Requirements:**
- Icon display (fallback to first letter)
- Show warning jika technology dipakai projects
- Cannot delete jika masih dipakai
- Empty state

---

#### 13. Create Technology
**Route:** `/admin/technologies/create`  
**Controller:** `Admin\TechnologyController@create`

**Form Fields:**
- Name (text, required, max 255)
  - Auto-generate slug
- Slug (text, optional, unique)
- Icon/Logo (image upload, optional)
  - Max 1MB
  - Accepted: png, jpg, svg
  - Preview
  - Recommended: square, 200x200px
- Category (text, optional, max 100)
  - Examples: Frontend, Backend, Database, DevOps
- Description (textarea, optional, max 500)

**Actions:**
- Save Technology
- Cancel

**Validation:**
- Unique name & slug
- Valid image format

---

#### 14. Edit Technology
**Route:** `/admin/technologies/{id}/edit`  
**Controller:** `Admin\TechnologyController@edit`

**Same as Create, plus:**
- Show existing icon/logo
- Remove icon option
- Show "Used in X projects" info
- Show created_at & updated_at

**Additional Actions:**
- View Projects using this technology
- Delete (jika tidak dipakai)

---

### Work Experiences Management

#### 15. Work Experiences List
**Route:** `/admin/work-experiences`  
**Controller:** `Admin\WorkExperienceController@index`

**Table Columns:**
- Company Logo (thumbnail)
- Company Name
- Position
- Start Date - End Date
  - Show "Present" jika end_date = null
  - Show duration (e.g., "2 years 3 months")
- Location (optional)
- Actions:
  - Edit
  - Delete

**Top Actions:**
- Create New Work Experience

**Sort:** Newest first (by start_date DESC)

**UI Requirements:**
- Timeline view (optional alternative layout)
- Current position highlighted
- Company logo fallback

---

#### 16. Create Work Experience
**Route:** `/admin/work-experiences/create`  
**Controller:** `Admin\WorkExperienceController@create`

**Form Fields:**

**1. Company Information**
- Company Name (text, required, max 255)
- Company Logo (image upload, optional)
  - Max 2MB, png/jpg
- Location (text, optional)
  - Example: "Jakarta, Indonesia" atau "Remote"
- Company Website (url, optional)

**2. Position Details**
- Job Title/Position (text, required, max 255)
- Employment Type (select, optional)
  - Full-time, Part-time, Contract, Freelance, Internship
- Start Date (date picker, required)
- End Date (date picker, optional)
- Checkbox: "I currently work here"
  - When checked, end_date = null, show "Present"

**3. Description**
- Job Description (rich text, optional)
  - Support: lists, bold, italic, links
  - Responsibilities & achievements
- Key Achievements (textarea, optional)
  - Bullet points

**4. Technologies Used**
- Multi-select dari technologies table
- Tag input
- Quick add new technology

**Actions:**
- Save
- Cancel

**Validation:**
- End date must be after start date
- Cannot have end date if "currently work here" checked

---

#### 17. Edit Work Experience
**Route:** `/admin/work-experiences/{id}/edit`  
**Controller:** `Admin\WorkExperienceController@edit`

**Same as Create, pre-filled**

**Additional:**
- Show created_at & updated_at
- Delete button (bottom)

---

### Educations Management

#### 18. Educations List
**Route:** `/admin/educations`  
**Controller:** `Admin\EducationController@index`

**Table Columns:**
- Institution Logo (optional)
- Institution Name
- Degree (e.g., "Bachelor of Science")
- Field of Study (e.g., "Computer Science")
- Start Date - End Date
- Grade/GPA (optional)
- Actions:
  - Edit
  - Delete

**Top Actions:**
- Create New Education

**Sort:** Newest first (end_date DESC)

---

#### 19. Create Education
**Route:** `/admin/educations/create`  
**Controller:** `Admin\EducationController@create`

**Form Fields:**

**1. Institution**
- Institution Name (text, required, max 255)
  - Example: "MIT", "Stanford University"
- Institution Logo (image upload, optional)
- Location (text, optional)

**2. Degree & Field**
- Degree (text, required, max 255)
  - Example: "Bachelor of Science", "Master of Arts"
- Field of Study (text, required, max 255)
  - Example: "Computer Science", "Software Engineering"
- Start Date (date picker, required, year/month)
- End Date (date picker, required, year/month)
  - Or checkbox: "Currently studying"

**3. Performance**
- Grade/GPA (text, optional, max 50)
  - Example: "3.8/4.0", "First Class Honours", "Cum Laude"
- Activities (textarea, optional)
  - Organizations, clubs, achievements

**4. Description**
- Description (textarea, optional)
  - Relevant coursework, thesis, projects

**Actions:**
- Save
- Cancel

---

#### 20. Edit Education
**Route:** `/admin/educations/{id}/edit`  
**Controller:** `Admin\EducationController@edit`

**Same as Create, pre-filled**

**Additional:**
- Delete button

---

### Inquiries Management

#### 21. Inquiries List
**Route:** `/admin/inquiries`  
**Controller:** `Admin\InquiryController@index`

**Filters:**
- Status filter (tabs atau dropdown):
  - All
  - New (badge count)
  - Read
  - Replied
  - Archived
  - Spam
- Date range filter (optional)
- Search by name, email, company

**Table Columns:**
- Status badge (color-coded):
  - New: blue, bold
  - Read: gray
  - Replied: green dengan checkmark icon
  - Archived: muted
  - Spam: red
- Name
- Email
- Phone (optional column)
- Company (optional column)
- Budget Range (optional column)
- Message (truncated, max 60 chars, "...")
- Date (relative time: "2 hours ago")
- Actions:
  - View (eye icon)
  - Mark as Spam (flag icon)
  - Delete (trash icon)

**Bulk Actions:**
- Select all checkbox
- Bulk mark as read/archived/spam
- Bulk delete

**Top Actions:**
- Status stats bar:
  - "X new inquiries"
  - "X unread"
  - "X need reply"

**Pagination:** 15 items per page

**UI Requirements:**
- Bold unread inquiries
- Color-coded status badges
- Quick action buttons (icon only)
- Row click → open detail view
- Empty state per status filter

---

#### 22. View Inquiry Detail
**Route:** `/admin/inquiries/{id}`  
**Controller:** `Admin\InquiryController@show`

**Layout:** Two-column atau single column

**Left Column / Top Section: Inquiry Details**

**1. Header**
- Name (h2)
- Status dropdown (inline edit):
  - New, Read, Replied, Archived, Spam
  - Auto-save on change
- Date (formatted: "Monday, Aug 18, 2026 at 10:30 AM")

**2. Contact Information**
- Email (clickable mailto link)
- Phone (clickable tel link, jika ada)
- Company (jika ada)
- Budget Range (jika ada)

**3. Message**
- Full message content
- Formatted with line breaks
- Copyable

**4. Metadata**
- IP Address (untuk spam detection)
- User Agent (browser info)
- Submitted on (full timestamp)
- Replied at (jika ada)
- Replied by (nama user, jika ada)

**Right Column / Bottom Section: Actions & Replies**

**1. Quick Actions**
- Status dropdown (duplicate dari header untuk mobile)
- Button: Reply via Email (open email client)
- Button: Mark as Spam
- Button: Archive
- Button: Delete (danger)

**2. Reply Section**
- Show jika sudah ada replies
- Thread style (conversation view)
- Each reply menampilkan:
  - Reply message
  - Replied by (user avatar & name)
  - Timestamp
  - Edit/Delete (jika baru post)

**3. Reply Form**
- Label: "Add Reply / Internal Note"
- Textarea (required, min 10 chars)
- Character counter (optional)
- Button: Send Reply
  - Auto-update status ke "replied"
  - Send notification (optional)

**Behavior:**
- Auto-mark as "read" saat page dibuka jika status = "new"
- Show success toast after actions
- Redirect to list after delete
- Stay on page after reply

**UI Requirements:**
- Sticky action bar (mobile)
- Collapsible sections (mobile)
- Copy buttons untuk email, phone
- Warning sebelum delete
- Rich text untuk reply (optional: bold, italic, links)

---

### Users Management

#### 23. Users List
**Route:** `/admin/users`  
**Controller:** `Admin\UserController@index`

**Filters:**
- Search by name, email
- Filter by role: All, Admin, Editor, User
- Filter by verification status: All, Verified, Unverified

**Table Columns:**
- Avatar (jika ada, atau initial)
- Name
- Email
- Role (badge):
  - Admin: red/purple
  - Editor: blue
  - User: gray
- Email Verified (icon: checkmark atau x)
- Created At (relative time)
- Last Login (optional)
- Actions:
  - Edit
  - Delete (cannot delete self, cannot delete last admin)

**Top Actions:**
- Create New User

**Pagination:** 20 items per page

**UI Requirements:**
- Cannot delete current user (disabled)
- Cannot delete last admin user (warning)
- Show online status (optional)
- Role color coding

---

#### 24. Create User
**Route:** `/admin/users/create`  
**Controller:** `Admin\UserController@create`

**Form Fields:**

**1. Basic Information**
- Name (text, required, max 255)
- Email (email, required, unique)
- Role (select, required):
  - User (default)
  - Editor
  - Admin
  - Show permission info untuk each role

**2. Password**
- Password (password, required, min 8)
- Password Confirmation (password, required)
- Show password strength indicator
- Password requirements tooltip

**3. Profile (optional)**
- Avatar (image upload, optional)
  - Max 2MB, jpg/png
  - Square crop preview
- Phone (text, optional)
- Bio (textarea, optional)

**4. Settings**
- Email Verified (checkbox)
  - Default: checked (manual create = auto verified)
- Send welcome email (checkbox)
  - Default: checked

**Actions:**
- Create User
- Create & Add Another
- Cancel

**Validation:**
- Unique email
- Password confirmation match
- Valid email format

---

#### 25. Edit User
**Route:** `/admin/users/{id}/edit`  
**Controller:** `Admin\UserController@edit`

**Same as Create, dengan perbedaan:**

**Password Section:**
- Password (optional, min 8)
  - Placeholder: "Leave blank to keep current password"
- Password Confirmation (required jika password diisi)

**Additional Info:**
- Show created_at
- Show updated_at
- Show last_login_at (optional)
- Show email_verified_at

**Additional Actions:**
- Send Password Reset Email
- Resend Verification Email (jika not verified)
- Delete User (bottom, danger)
  - Warning jika delete admin
  - Cannot delete self

**Restrictions:**
- Cannot change own role
- Cannot delete self
- Cannot demote last admin

---

### Settings

#### 26. Site Settings
**Route:** `/admin/settings`  
**Controller:** `Admin\SettingController@index`

**Layout:** Single form dengan tabs atau sections

**Tabs/Sections:**

**1. General Settings**
- Site Name (text, required, max 255)
  - Used in emails, page titles
- Site Tagline (text, optional, max 255)
  - Example: "Full-stack Developer & Designer"
- About/Bio (rich text, optional)
  - Full bio/about me content
  - Support: paragraphs, lists, links
- Profile Photo (image upload)
  - Max 5MB, jpg/png
  - Square crop, 500x500px recommended
  - Preview
- Resume/CV (file upload)
  - Max 10MB, PDF only
  - Current file display dengan download link
  - Replace or remove option

**2. Contact Information**
- Email (email, required)
  - Primary contact email
- Phone (text, optional)
  - With country code
- Address (textarea, optional)
  - Full address for contact page
- Timezone (select, optional)
  - For display purposes

**3. Social Media Links**
- LinkedIn URL (url, optional)
- GitHub URL (url, optional)
- Twitter/X URL (url, optional)
- Instagram URL (url, optional)
- Facebook URL (url, optional)
- YouTube URL (url, optional)
- Custom Link 1 (label + url)
- Custom Link 2 (label + url)

**4. SEO & Meta**
- Meta Description (textarea, optional, max 160)
  - For homepage & default
- Meta Keywords (text, optional)
  - Comma-separated
- Open Graph Image (image upload)
  - For social sharing
  - Recommended: 1200x630px
- Google Analytics ID (text, optional)
  - Example: "G-XXXXXXXXXX"
- Google Tag Manager ID (text, optional)

**5. Email Settings (optional)**
- Contact Form Recipient (email)
- Email Signature (textarea)
- Auto-reply Message (textarea)

**6. API Settings (optional)**
- API Rate Limit (number)
- Enable/Disable API endpoints
- API Documentation URL

**Actions:**
- Save Changes (submit)
- Reset to Defaults (with confirmation)

**UI Requirements:**
- Tab navigation atau accordion sections
- Auto-save indicator
- Validation per section
- Preview profile photo & OG image
- URL validation untuk social links
- Character counters untuk SEO fields
- Success toast after save

**Behavior:**
- Store settings in `settings` table
- Key-value pairs
- Cache settings untuk performance
- Clear cache after update

---

### Profile Management

#### 27. Edit Profile
**Route:** `/profile`  
**Controller:** `ProfileController@edit`  
**Middleware:** `auth` (all authenticated users)

**Layout:** Single page dengan sections

**Sections:**

**1. Profile Information**
- Form fields:
  - Name (text, required, max 255)
  - Email (email, required, unique)
    - Show warning jika email changed: "You'll need to verify your new email"
- Current Avatar (jika ada)
- Change Avatar (upload)
- Remove Avatar (button)
- Save Changes (button)

**2. Update Password**
- Current Password (password, required)
- New Password (password, required, min 8)
- Confirm New Password (password, required)
- Password strength indicator
- Update Password (button)

**3. Two-Factor Authentication (optional)**
- Enable/Disable 2FA
- QR Code untuk setup
- Backup codes

**4. Sessions (optional)**
- Active sessions list
  - Device, Browser, IP, Last active
- Logout other sessions (button)

**5. Delete Account**
- Warning message
- Consequences explanation
- Confirmation:
  - Enter password to confirm
  - Checkbox: "I understand this is permanent"
- Delete Account (danger button)

**UI Requirements:**
- Separate forms per section (tidak submit all at once)
- Success/error messages per section
- Current avatar preview
- Confirmation modal untuk delete account
- Show email verification notice jika email changed

**Behavior:**
- Update profile info → flash success
- Update password → logout all other sessions
- Delete account → soft delete, revoke tokens, logout

---

## C. Komponen Global

### 28. Sidebar Navigation

**Struktur Menu:**

```
Dashboard (icon: home)

Projects (icon: folder)
├─ All Projects
└─ Create New

Technologies (icon: code)

Work Experiences (icon: briefcase)

Educations (icon: graduation-cap)

Inquiries (icon: mail) [badge: count new]

Users (icon: users) [admin only]

Settings (icon: settings)

─── (divider)

Profile (icon: user)
Logout (icon: log-out)
```

**Features:**
- Collapsible pada mobile (hamburger toggle)
- Active state highlighting
- Badge untuk new inquiries
- Nested submenu dengan expand/collapse
- Icons untuk setiap item
- Tooltip on icon-only mode (collapsed sidebar)
- User info di top (avatar, name, role)

**Responsive:**
- Desktop: fixed sidebar, always visible atau collapsible
- Tablet: collapsible sidebar, icon only default
- Mobile: overlay sidebar, swipe to open/close

**States:**
- Active page highlight (different bg color)
- Hover state
- Collapsed state (icon only)
- Mobile open/closed state

---

### 29. Header/Navbar

**Left Section:**
- Logo / Site Name
- Mobile: Hamburger menu toggle

**Center Section:**
- Breadcrumbs navigation
  - Example: "Dashboard > Projects > Edit"

**Right Section:**
- Search (global, optional)
  - Quick search projects, inquiries
- Notifications (icon dengan badge count)
  - Dropdown list:
    - New inquiries
    - New users registered
    - System notifications
- User Profile Dropdown:
  - Avatar & Name
  - Role badge
  - Menu items:
    - View Profile
    - Settings
    - Logout

**Features:**
- Sticky/fixed top
- Notification dropdown dengan mark as read
- Click outside to close dropdowns
- Responsive layout

---

### 30. Flash Messages / Toast Notifications

**Types:**
- Success (green)
- Error (red)
- Warning (yellow)
- Info (blue)

**Display:**
- Top-right corner (desktop)
- Top center (mobile)
- Auto-dismiss after 5 seconds
- Close button (x)
- Progress bar untuk auto-dismiss countdown

**Content:**
- Icon matching type
- Title (optional)
- Message
- Action button (optional)
  - Example: "Undo", "View"

**Animation:**
- Slide in from right (desktop)
- Slide down from top (mobile)
- Fade out on dismiss

**Examples:**
```
✓ Project created successfully
✗ Failed to upload image. File too large.
⚠ You have unsaved changes
ℹ New inquiry received from John Doe
```

---

### Additional Reusable Components

#### 31. Confirmation Modal
**Used for:**
- Delete actions
- Destructive actions
- Logout confirmation

**Structure:**
- Overlay backdrop (semi-transparent)
- Modal card:
  - Icon (warning/danger)
  - Title
  - Message
  - Optional: checkbox for "don't ask again"
  - Actions:
    - Cancel (secondary)
    - Confirm (primary/danger)

#### 32. Loading States
- Page loading: full page spinner
- Button loading: spinner in button, disabled
- Table loading: skeleton rows
- Image loading: placeholder blur

#### 33. Empty States
**Used for:**
- Empty list (no projects, inquiries, etc)
- No search results
- No notifications

**Structure:**
- Illustration/icon
- Heading: "No projects yet"
- Message: "Get started by creating your first project"
- Call-to-action button

#### 34. Pagination Component
**Features:**
- Page numbers (with ellipsis)
- Previous/Next buttons
- First/Last buttons
- Items per page selector
- Total count display

**Example:**
```
< Previous | 1 2 3 ... 10 | Next >
Showing 1-10 of 95 items
```

#### 35. Data Table Component
**Features:**
- Sortable columns (click header)
- Selectable rows (checkbox)
- Bulk actions
- Responsive (stack/card view on mobile)
- Loading skeleton
- Empty state
- Actions column (dropdown or inline)

#### 36. Form Components
- Text Input (dengan label, error, helper text)
- Textarea (dengan character counter)
- Select Dropdown (dengan search)
- Multi-select (tag input)
- Checkbox & Radio
- Date Picker
- Image Upload (drag & drop)
- File Upload (dengan progress bar)
- Rich Text Editor
- Color Picker (optional)
- Slug Generator (auto dari text input)

#### 37. Breadcrumbs
**Examples:**
```
Dashboard > Projects > Edit Project

Dashboard > Inquiries > View Inquiry #123

Dashboard > Settings
```

---

## D. Fitur Tambahan

### UI/UX Features

#### Search Functionality
- Global search (navbar)
- Per-page search (projects, users, inquiries)
- Debounce input (300ms)
- Highlight search terms in results
- Clear search button

#### Sorting & Filtering
- Column header sort (asc/desc)
- Filter dropdowns/checkboxes
- Applied filters display (removable chips)
- Clear all filters button
- Remember filters in URL params

#### Form Features
- Client-side validation
- Inline error messages
- Success/error states
- Auto-save draft (optional)
- Unsaved changes warning
- Field dependencies (show/hide based on other field)
- Conditional fields

#### Image/File Upload
- Drag & drop area
- File browser fallback
- Multiple files upload
- Progress bar
- Preview before upload
- Crop/resize images (optional)
- Max size validation
- File type validation
- Remove uploaded file

#### Rich Text Editor
**Recommended:** TinyMCE, Quill, Tiptap, atau CKEditor

**Features needed:**
- Bold, Italic, Underline
- Headings (H1-H6)
- Bullet & Numbered lists
- Links (dengan URL validation)
- Images (inline upload)
- Code blocks
- Blockquotes
- Tables (optional)
- Undo/Redo
- HTML source view (optional)

#### Slug Generator
- Auto-generate dari title field
- Real-time update saat typing
- Editable (bisa override)
- Validation: unique, lowercase, hyphens only
- Preview URL

#### Date Picker
- Calendar popup
- Date range selection (untuk filters)
- Time picker (optional)
- Relative dates: "Today", "Yesterday"
- Format: customizable (DD/MM/YYYY atau MM/DD/YYYY)

#### Tooltips & Popovers
- Hover tooltips (help text)
- Click popover (more info)
- Keyboard accessible
- Mobile: tap to toggle

#### Keyboard Shortcuts (optional)
- `Ctrl+S`: Save
- `Ctrl+K`: Global search
- `Esc`: Close modal
- `/`: Focus search
- `?`: Show shortcuts help

### Accessibility (WCAG 2.1 Level AA)
- Semantic HTML
- ARIA labels
- Keyboard navigation
- Focus indicators
- Alt text untuk images
- Color contrast ratios
- Screen reader friendly
- Skip to main content link

### Performance
- Lazy load images
- Infinite scroll atau pagination
- Code splitting (route-based)
- Image optimization (WebP, lazy load)
- Cache static assets
- Debounce search inputs
- Throttle scroll events

### Dark Mode (optional)
- Toggle switch (navbar)
- Remember preference (localStorage)
- System preference detection
- Smooth transition animation

### Internationalization (optional)
- Multi-language support
- Language switcher
- Date/time localization
- Currency formatting

### Offline Support (optional)
- Service Worker
- Cache API responses
- Offline indicator
- Sync when online

---

## E. Teknologi Frontend

### Recommended Tech Stack

#### Option 1: Laravel Blade + Alpine.js + Tailwind CSS ⭐ (Recommended)
**Pros:**
- Sudah terintegrasi dengan Laravel
- Simple & lightweight
- No build complexity
- SSR (Server-Side Rendering) = SEO friendly
- Sudah ada template TailAdmin di project

**Cons:**
- Less interactive dibanding SPA
- Full page reload untuk navigation

**Best for:**
- Admin panels
- Content-heavy sites
- SEO important pages
- Teams familiar dengan Laravel

**Stack:**
- Blade Templates (Laravel)
- Alpine.js 3.x (for interactivity)
- Tailwind CSS 3.x (styling)
- Livewire (optional, untuk reactive components)

#### Option 2: Inertia.js + Vue 3 + Tailwind CSS
**Pros:**
- SPA experience dengan Laravel backend
- No API needed
- Share routes & data easily
- Vue ecosystem (Vue Router, Pinia)

**Cons:**
- Learning curve untuk Inertia
- Build step required
- SEO needs SSR setup

**Best for:**
- Modern SPA experience
- Teams familiar dengan Vue
- Complex interactive UIs

**Stack:**
- Inertia.js
- Vue 3 (Composition API)
- Tailwind CSS 3.x
- Vite (build tool)

#### Option 3: Inertia.js + React + Tailwind CSS
**Pros:**
- Same as Vue option
- React ecosystem
- TypeScript support

**Best for:**
- Teams familiar dengan React
- Component-heavy UIs

**Stack:**
- Inertia.js
- React 18
- Tailwind CSS 3.x
- Vite

#### Option 4: Laravel Livewire + Tailwind CSS
**Pros:**
- Full-stack Laravel (no separate frontend)
- Reactive components without much JS
- Real-time features easy
- No API needed

**Cons:**
- Not true SPA
- Less control dibanding Vue/React

**Best for:**
- Rapid development
- PHP developers
- Real-time features (websockets)

**Stack:**
- Livewire 3.x
- Alpine.js 3.x
- Tailwind CSS 3.x

---

### UI Component Library Options

#### For Blade + Alpine:
- **TailAdmin** (sudah ada di project) ✅
- Alpine Components
- Tailwind UI
- DaisyUI

#### For Vue:
- Headless UI (by Tailwind)
- PrimeVue
- Naive UI
- Element Plus

#### For React:
- Headless UI (by Tailwind)
- Radix UI
- shadcn/ui
- Mantine

---

### Development Tools

#### Required:
- Node.js (v18+)
- NPM atau Yarn atau PNPM
- Vite (build tool, sudah ada di Laravel)

#### Recommended:
- VS Code Extensions:
  - Tailwind CSS IntelliSense
  - Alpine.js IntelliSense
  - Blade Formatter
  - Laravel Blade Snippets
- Browser Extensions:
  - Vue/React DevTools
  - Lighthouse (performance audit)

---

### File Structure (Blade + Alpine example)

```
resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php (main layout)
│   │   ├── admin.blade.php (admin layout dengan sidebar)
│   │   └── guest.blade.php (untuk auth pages)
│   ├── components/
│   │   ├── sidebar.blade.php
│   │   ├── header.blade.php
│   │   ├── flash-message.blade.php
│   │   ├── form/
│   │   │   ├── input.blade.php
│   │   │   ├── textarea.blade.php
│   │   │   └── select.blade.php
│   │   └── table/
│   │       ├── table.blade.php
│   │       └── pagination.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── projects/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── technologies/
│   │   ├── work-experiences/
│   │   ├── educations/
│   │   ├── inquiries/
│   │   ├── users/
│   │   └── settings/
│   └── auth/
│       ├── login.blade.php
│       ├── register.blade.php
│       └── ...
├── css/
│   └── app.css (Tailwind imports)
└── js/
    ├── app.js (Alpine, axios, etc)
    └── components/
        └── alpine components
```

---

## Summary

**Total Halaman: 27 halaman utama**

**Breakdown:**
- Autentikasi: 5 halaman
- Admin Panel: 20 halaman
- Profile: 1 halaman
- Komponen Global: 10+ reusable components

**Prioritas Development:**

**Phase 1 - Essential (MVP):**
1. Login, Register
2. Admin Dashboard
3. Projects List, Create, Edit
4. Inquiries List, Detail
5. Sidebar, Header, Flash Messages

**Phase 2 - Core Features:**
6. Technologies Management
7. Work Experiences
8. Educations
9. Users Management
10. Settings

**Phase 3 - Enhancement:**
11. Search & Filter
12. Advanced UI Components
13. Dark Mode
14. Keyboard Shortcuts
15. Performance Optimization

---

## Next Steps

1. **Choose Frontend Stack** (recommended: Blade + Alpine + Tailwind)
2. **Setup Base Layout** (admin layout dengan sidebar & header)
3. **Create Component Library** (form inputs, buttons, cards, table)
4. **Implement Authentication Pages** (login, register)
5. **Build Dashboard** (with stats & tables)
6. **Implement CRUD Pages** (start dengan Projects)
7. **Add Interactions** (modals, dropdowns, form validation)
8. **Polish UI/UX** (loading states, empty states, animations)
9. **Testing** (responsiveness, accessibility, cross-browser)
10. **Deploy**

---

**Dokumentasi ini dibuat berdasarkan analisis:**
- Routes: `routes/web.php`, `routes/api.php`
- Controllers: `app/Http/Controllers/**`
- Migrations: `database/migrations/**`
- Existing template: `tailadmin-free-tailwind-dashboard-template-main/`

**Last Updated:** August 18, 2026
