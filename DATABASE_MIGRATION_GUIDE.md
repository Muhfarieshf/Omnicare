# Database Migration Guide: Enhanced Appointment Features

This guide will walk you through updating your database to support the new appointment management features.

## 📋 Prerequisites

1. **Backup your database** - This is CRITICAL!
2. Ensure you have database admin access
3. Test on a development/staging database first

## 🔍 Step 1: Check Current Database State

Before running the migration, check if any columns/tables already exist:

```sql
-- Check if duration_minutes column exists
SHOW COLUMNS FROM `appointments` LIKE 'duration_minutes';

-- Check if new tables exist
SHOW TABLES LIKE 'doctor_schedules';
SHOW TABLES LIKE 'waiting_list';
SHOW TABLES LIKE 'appointment_status_history';
```

## 📦 Step 2: Backup Your Database

**IMPORTANT: Always backup before migration!**

### Option A: Using phpMyAdmin
1. Select your database
2. Click "Export" tab
3. Choose "Quick" or "Custom" export method
4. Click "Go" to download the backup

### Option B: Using MySQL Command Line
```bash
mysqldump -u your_username -p hospital_appointment_system > backup_before_migration.sql
```

### Option C: Using Laragon (if you're using Laragon)
1. Open Laragon
2. Right-click on your database
3. Select "Backup" or use the backup tool

## 🚀 Step 3: Run the Migration

### Option A: Using phpMyAdmin (Recommended for beginners)
1. Open phpMyAdmin
2. Select your database (`hospital_appointment_system`)
3. Click on the "SQL" tab
4. Open the file `database_migration_safe.sql`
5. Copy the entire contents
6. Paste into the SQL query box
7. Click "Go" to execute

### Option B: Using MySQL Command Line
```bash
mysql -u your_username -p hospital_appointment_system < database_migration_safe.sql
```

### Option C: Using Laragon Terminal
```bash
# Navigate to your project directory
cd C:\laragon\www\OmniCare

# Run the SQL file
mysql -u root -p hospital_appointment_system < database_migration_safe.sql
```

### Option D: Run Section by Section (Safest)
If you encounter errors, you can run the migration in parts:

1. **Part 1**: Update appointments table (add columns)
2. **Part 2**: Add indexes
3. **Part 3**: Create doctor_schedules table
4. **Part 4**: Create waiting_list table
5. **Part 5**: Create appointment_status_history table
6. **Part 6**: Update existing data

## ✅ Step 4: Verify the Migration

Run these verification queries to ensure everything was created correctly:

```sql
-- 1. Check appointments table structure
DESCRIBE `appointments`;

-- 2. Verify new columns exist
SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
AND TABLE_NAME = 'appointments' 
AND COLUMN_NAME IN (
    'duration_minutes', 
    'confirmed_at', 
    'started_at', 
    'completed_at', 
    'cancelled_at',
    'cancelled_by',
    'cancellation_reason',
    'requires_approval',
    'approved_by',
    'approved_at'
);

-- 3. Check new tables exist
SHOW TABLES;

-- Should show:
-- - doctor_schedules
-- - waiting_list
-- - appointment_status_history

-- 4. Check indexes were created
SHOW INDEXES FROM `appointments` WHERE Key_name LIKE 'idx_%';

-- 5. Check foreign keys
SELECT 
    TABLE_NAME, 
    CONSTRAINT_NAME, 
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
WHERE TABLE_SCHEMA = DATABASE() 
AND TABLE_NAME IN ('appointments', 'doctor_schedules', 'waiting_list', 'appointment_status_history')
AND REFERENCED_TABLE_NAME IS NOT NULL;

-- 6. Verify existing appointments have duration
SELECT COUNT(*) as total_appointments,
       COUNT(duration_minutes) as with_duration,
       MIN(duration_minutes) as min_duration,
       MAX(duration_minutes) as max_duration
FROM `appointments`;
```

## ⚠️ Troubleshooting

### Error: "Duplicate column name"
**Solution**: The column already exists. You can either:
- Skip that part of the migration
- Or drop the column first (if you're sure it's safe):
  ```sql
  ALTER TABLE `appointments` DROP COLUMN `duration_minutes`;
  ```

### Error: "Table already exists"
**Solution**: The table already exists. You can either:
- Skip creating that table
- Or drop it first (WARNING: This will delete data):
  ```sql
  DROP TABLE IF EXISTS `doctor_schedules`;
  ```

### Error: "Cannot add foreign key constraint"
**Solution**: Check that:
1. Referenced tables exist (`users`, `doctors`, `patients`, `departments`)
2. Referenced columns exist and have the same data type
3. There's no existing data violating the constraint

### Error: "Duplicate key name"
**Solution**: The index already exists. You can either:
- Skip creating that index
- Or drop it first:
  ```sql
  DROP INDEX `idx_doctor_datetime_status` ON `appointments`;
  ```

## 🔄 Rollback (If Needed)

If you need to rollback the migration, use this script:

```sql
-- WARNING: This will delete data and tables!

-- Drop new tables
DROP TABLE IF EXISTS `appointment_status_history`;
DROP TABLE IF EXISTS `waiting_list`;
DROP TABLE IF EXISTS `doctor_schedules`;

-- Remove foreign keys
ALTER TABLE `appointments` 
DROP FOREIGN KEY `fk_appointments_cancelled_by`,
DROP FOREIGN KEY `fk_appointments_approved_by`;

-- Drop indexes
ALTER TABLE `appointments` 
DROP INDEX `idx_doctor_datetime_status`,
DROP INDEX `idx_patient_datetime_status`,
DROP INDEX `idx_status_workflow`,
DROP INDEX `idx_conflict_detection`;

-- Remove columns
ALTER TABLE `appointments` 
DROP COLUMN `duration_minutes`,
DROP COLUMN `confirmed_at`,
DROP COLUMN `started_at`,
DROP COLUMN `completed_at`,
DROP COLUMN `cancelled_at`,
DROP COLUMN `cancelled_by`,
DROP COLUMN `cancellation_reason`,
DROP COLUMN `requires_approval`,
DROP COLUMN `approved_by`,
DROP COLUMN `approved_at`;
```

## 📊 What Was Added

### Appointments Table Updates:
- ✅ `duration_minutes` - Appointment duration (default: 30 minutes)
- ✅ `confirmed_at` - When appointment was confirmed
- ✅ `started_at` - When appointment started
- ✅ `completed_at` - When appointment was completed
- ✅ `cancelled_at` - When appointment was cancelled
- ✅ `cancelled_by` - User who cancelled
- ✅ `cancellation_reason` - Reason for cancellation
- ✅ `requires_approval` - Whether cancellation needs approval
- ✅ `approved_by` - User who approved cancellation
- ✅ `approved_at` - When cancellation was approved

### New Tables:
- ✅ `doctor_schedules` - Doctor availability schedules
- ✅ `waiting_list` - Patient waiting list/queue
- ✅ `appointment_status_history` - Audit trail for status changes

### New Indexes:
- ✅ `idx_doctor_datetime_status` - Fast doctor availability checks
- ✅ `idx_patient_datetime_status` - Fast patient availability checks
- ✅ `idx_status_workflow` - Fast status-based queries
- ✅ `idx_conflict_detection` - Optimized conflict detection

## 🎯 Next Steps

After successfully running the migration:

1. **Update CakePHP Models** - We'll need to update the Entity and Table classes
2. **Implement Conflict Detection** - Add the service class and validation
3. **Implement Smart Scheduling** - Add scheduling service and controllers
4. **Implement Status Workflow** - Add workflow service and status management

## 📞 Need Help?

If you encounter any issues:
1. Check the error message carefully
2. Verify your database user has proper permissions
3. Ensure all referenced tables exist
4. Check that you're using the correct database name

## ✅ Checklist

Before proceeding with code implementation:
- [ ] Database backup created
- [ ] Migration script executed successfully
- [ ] All new columns added to appointments table
- [ ] All new tables created (doctor_schedules, waiting_list, appointment_status_history)
- [ ] All indexes created
- [ ] All foreign keys created
- [ ] Verification queries passed
- [ ] Existing data updated (duration_minutes set to 30)

---

**Ready to proceed?** Once the migration is complete, we can start implementing the PHP code for conflict detection, smart scheduling, and status workflow!




