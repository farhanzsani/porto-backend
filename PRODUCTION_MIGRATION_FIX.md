# Production Migration Fix - Step by Step Guide

## Problem Summary
3 migration files were attempting to drop columns that never existed in the database, causing production deployment failures.

**Error Message:**
```
SQLSTATE[42000]: Syntax error or access violation: 1091 Can't DROP COLUMN `start_date`; check that it exists
```

## Migrations Removed
1. `2026_08_13_150451_drop_seo_columns_from_projects_and_settings_table.php`
2. `2026_08_13_152100_drop_order_status_and_date_columns_from_projects_table.php`
3. `2026_08_13_153000_drop_order_columns_from_technologies_work_experiences_educations_and_project_media_table.php`

## Git Changes Applied
- **Commit:** `2a7769d`
- **Message:** "fix: remove invalid drop column migrations that cause production errors"
- **Files Deleted:** 3 migration files (108 deletions)
- **Status:** ✅ Pushed to `main` branch

---

## Production Server Fix Instructions

### Step 1: Backup Database (CRITICAL!)
```bash
# SSH ke production server
ssh user@production-server

# Backup database sebelum melakukan perubahan apapun
mysqldump -u root -p vellysia_porto-backend-nachaa > backup_before_migration_fix_$(date +%Y%m%d_%H%M%S).sql
```

### Step 2: Remove Invalid Migration Records from Database
```sql
-- Connect to production database
mysql -u root -p vellysia_porto-backend-nachaa

-- Check if the problematic migrations exist in migrations table
SELECT id, migration, batch 
FROM migrations 
WHERE migration IN (
    '2026_08_13_150451_drop_seo_columns_from_projects_and_settings_table',
    '2026_08_13_152100_drop_order_status_and_date_columns_from_projects_table',
    '2026_08_13_153000_drop_order_columns_from_technologies_work_experiences_educations_and_project_media_table'
);

-- If records exist, delete them
DELETE FROM migrations 
WHERE migration IN (
    '2026_08_13_150451_drop_seo_columns_from_projects_and_settings_table',
    '2026_08_13_152100_drop_order_status_and_date_columns_from_projects_table',
    '2026_08_13_153000_drop_order_columns_from_technologies_work_experiences_educations_and_project_media_table'
);

-- Verify deletion
SELECT COUNT(*) as remaining_count 
FROM migrations 
WHERE migration LIKE '%drop%';

-- Exit MySQL
exit;
```

### Step 3: Pull Latest Code Changes
```bash
# Navigate to project directory
cd /path/to/porto-backend

# Check current status
git status
git log --oneline -5

# Pull latest changes from main branch
git pull origin main

# Verify the migration files are deleted
ls -la database/migrations/ | grep drop
# Should return nothing or only valid drop migrations
```

### Step 4: Verify Migration Files
```bash
# Count migration files (should be 13)
ls database/migrations/ | wc -l

# List all migration files to confirm
ls -1 database/migrations/
```

Expected output (13 files):
```
0001_01_01_000000_create_users_table.php
0001_01_01_000001_create_cache_table.php
0001_01_01_000002_create_jobs_table.php
2026_08_13_074907_add_role_to_users_table.php
2026_08_13_074908_create_technologies_table.php
2026_08_13_074911_create_projects_table.php
2026_08_13_074914_create_project_media_table.php
2026_08_13_074915_create_project_technology_table.php
2026_08_13_074922_create_work_experiences_table.php
2026_08_13_074923_create_educations_table.php
2026_08_13_074924_create_inquiries_table.php
2026_08_13_074925_create_inquiry_replies_table.php
2026_08_13_074926_create_settings_table.php
```

### Step 5: Run Migrations
```bash
# Check migration status
php artisan migrate:status

# Run pending migrations
php artisan migrate

# Expected output: All migrations should run successfully without errors
```

### Step 6: Verify Database Schema
```bash
# Check that all tables exist with correct columns
php artisan db:show

# Or manually verify key tables
mysql -u root -p vellysia_porto-backend-nachaa -e "DESCRIBE projects;"
mysql -u root -p vellysia_porto-backend-nachaa -e "DESCRIBE technologies;"
mysql -u root -p vellysia_porto-backend-nachaa -e "DESCRIBE work_experiences;"
mysql -u root -p vellysia_porto-backend-nachaa -e "DESCRIBE educations;"
mysql -u root -p vellysia_porto-backend-nachaa -e "DESCRIBE project_media;"
```

### Step 7: Clear Application Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize
```

### Step 8: Test Application
```bash
# Test API endpoints
curl -X GET http://your-production-domain.com/api/projects
curl -X GET http://your-production-domain.com/api/technologies

# Check application logs
tail -f storage/logs/laravel.log
```

---

## Rollback Plan (If Something Goes Wrong)

### Option 1: Restore Database from Backup
```bash
mysql -u root -p vellysia_porto-backend-nachaa < backup_before_migration_fix_YYYYMMDD_HHMMSS.sql
```

### Option 2: Revert Git Commit
```bash
git revert 2a7769d
git push origin main
```

---

## Bug Analysis Summary

### Bug #1: projects table
**Migration:** `2026_08_13_152100_drop_order_status_and_date_columns_from_projects_table.php`

Attempted to drop:
- `start_date` ❌ (never existed)
- `end_date` ❌ (never existed)
- `is_featured` ❌ (never existed)
- `status` ❌ (never existed)
- `order` ❌ (never existed)

Actual columns in `projects`:
- id, slug, title, description, content, featured_image, client, project_url, github_url, view_count, timestamps, softDeletes

### Bug #2: projects + settings tables
**Migration:** `2026_08_13_150451_drop_seo_columns_from_projects_and_settings_table.php`

Attempted to drop from `projects`:
- `meta_title` ❌ (never existed)
- `meta_description` ❌ (never existed)

### Bug #3: Multiple tables
**Migration:** `2026_08_13_153000_drop_order_columns_from_technologies_work_experiences_educations_and_project_media_table.php`

Attempted to drop `order` column from:
- `technologies` ❌ (never existed)
- `work_experiences` ❌ (never existed)
- `educations` ❌ (never existed)
- `project_media` ❌ (never existed)

---

## Root Cause

These migrations were created to drop columns that were never added to the database in the first place. This indicates:
1. Schema design changed during development
2. "Add column" migrations were never created
3. "Drop column" migrations were created prematurely
4. Missing synchronization between planned schema and actual implementation

---

## Prevention Measures

1. **Always verify columns exist before creating drop migrations:**
   ```bash
   php artisan db:show --table=table_name
   ```

2. **Use Schema::hasColumn() for defensive migrations:**
   ```php
   if (Schema::hasColumn('table_name', 'column_name')) {
       $table->dropColumn('column_name');
   }
   ```

3. **Review migration order and dependencies:**
   ```bash
   php artisan migrate:status
   ```

4. **Test migrations in staging before production:**
   ```bash
   php artisan migrate:fresh
   php artisan migrate
   ```

5. **Always backup production database before migrations**

---

## Verification Checklist

- [x] Git commit created and pushed
- [ ] Production database backed up
- [ ] Invalid migration records removed from `migrations` table
- [ ] Latest code pulled to production
- [ ] Migrations run successfully
- [ ] Database schema verified
- [ ] Application cache cleared
- [ ] API endpoints tested
- [ ] Application logs checked for errors

---

## Contact Information

**Issue Fixed By:** OpenAgentic AI
**Date:** August 18, 2026
**Commit:** 2a7769d
**Repository:** https://github.com/farhanzsani/porto-backend

For questions or issues, refer to this document and verify each step carefully.
