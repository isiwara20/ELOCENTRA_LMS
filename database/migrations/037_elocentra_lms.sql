-- ============================================================================
-- Migration 037: ELOCENTRA English Academy LMS Core Extensions
-- Rebranding, Subject Areas, Courses, Resource Persons, Bank Accounts,
-- DirectPay Gateway Configuration, Course Orders, and OTP Password Recovery
-- ============================================================================

SET NAMES utf8mb4;
SET time_zone = '+05:30';

-- 1. Subject Areas
CREATE TABLE IF NOT EXISTS `subject_areas` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `icon` VARCHAR(100) DEFAULT 'book-open',
    `sort_order` INT NOT NULL DEFAULT 0,
    `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_subject_slug` (`slug`),
    INDEX `idx_subject_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Resource Persons / Teachers
CREATE TABLE IF NOT EXISTS `resource_persons` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED DEFAULT NULL,
    `name` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL COMMENT 'e.g. Senior Lecturer in English & Communication',
    `qualifications` TEXT NOT NULL COMMENT 'e.g. MA in English (Kelaniya), B.Ed (Hons), Cambridge CELTA',
    `subject_area_id` INT UNSIGNED DEFAULT NULL,
    `bio` TEXT DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `phone` VARCHAR(50) DEFAULT NULL,
    `photo` VARCHAR(500) DEFAULT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_rp_status` (`status`),
    INDEX `idx_rp_sort` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Extend `classes` table with Course attributes
ALTER TABLE `classes`
    ADD COLUMN IF NOT EXISTS `course_code` VARCHAR(50) DEFAULT NULL AFTER `id`,
    ADD COLUMN IF NOT EXISTS `subject_area_id` INT UNSIGNED DEFAULT NULL AFTER `subject`,
    ADD COLUMN IF NOT EXISTS `description` TEXT DEFAULT NULL AFTER `notes`,
    ADD COLUMN IF NOT EXISTS `duration_weeks` VARCHAR(50) DEFAULT '12 Weeks' AFTER `description`,
    ADD COLUMN IF NOT EXISTS `course_level` ENUM('Beginner','Intermediate','Advanced') DEFAULT 'Intermediate' AFTER `duration_weeks`,
    ADD COLUMN IF NOT EXISTS `has_certificate` TINYINT(1) NOT NULL DEFAULT 1 AFTER `course_level`,
    ADD COLUMN IF NOT EXISTS `course_thumbnail` VARCHAR(500) DEFAULT NULL AFTER `has_certificate`,
    ADD COLUMN IF NOT EXISTS `overview_video_url` VARCHAR(500) DEFAULT NULL AFTER `course_thumbnail`,
    ADD COLUMN IF NOT EXISTS `price` DECIMAL(10,2) DEFAULT NULL AFTER `monthly_fee`,
    ADD COLUMN IF NOT EXISTS `is_featured` TINYINT(1) NOT NULL DEFAULT 1 AFTER `price`;

-- 4. Bank Accounts for Bank Transfer Course Payments
CREATE TABLE IF NOT EXISTS `bank_accounts` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `bank_name` VARCHAR(150) NOT NULL,
    `branch_name` VARCHAR(150) NOT NULL,
    `account_name` VARCHAR(255) NOT NULL,
    `account_number` VARCHAR(100) NOT NULL,
    `swift_code` VARCHAR(50) DEFAULT NULL,
    `instructions` TEXT DEFAULT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_ba_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. DirectPay Configuration
CREATE TABLE IF NOT EXISTS `directpay_config` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `merchant_id` VARCHAR(100) NOT NULL DEFAULT 'DP_ELOCENTRA_TEST',
    `api_key` VARCHAR(255) NOT NULL DEFAULT 'dp_live_sec_key_elocentra',
    `secret_key` VARCHAR(255) NOT NULL DEFAULT 'dp_live_secret_elocentra',
    `environment` ENUM('sandbox','production') NOT NULL DEFAULT 'sandbox',
    `currency` VARCHAR(10) NOT NULL DEFAULT 'LKR',
    `is_enabled` TINYINT(1) NOT NULL DEFAULT 1,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Course Orders / Enrollments
CREATE TABLE IF NOT EXISTS `course_orders` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_number` VARCHAR(50) NOT NULL,
    `student_id` INT UNSIGNED NOT NULL,
    `course_id` INT UNSIGNED NOT NULL,
    `amount` DECIMAL(10,2) NOT NULL,
    `currency` VARCHAR(10) NOT NULL DEFAULT 'LKR',
    `payment_method` ENUM('directpay','bank_transfer') NOT NULL,
    `payment_status` ENUM('pending','approved','paid','failed','rejected') NOT NULL DEFAULT 'pending',
    `gateway_transaction_id` VARCHAR(150) DEFAULT NULL,
    `bank_account_id` INT UNSIGNED DEFAULT NULL,
    `bank_reference` VARCHAR(100) DEFAULT NULL,
    `slip_path` VARCHAR(500) DEFAULT NULL,
    `review_notes` TEXT DEFAULT NULL,
    `reviewed_by` INT UNSIGNED DEFAULT NULL,
    `reviewed_at` DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_order_number` (`order_number`),
    INDEX `idx_order_student` (`student_id`),
    INDEX `idx_order_course` (`course_id`),
    INDEX `idx_order_status` (`payment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Add `username` to `students` table and `email` & `raw_code` to `password_resets`
ALTER TABLE `students`
    ADD COLUMN IF NOT EXISTS `username` VARCHAR(100) DEFAULT NULL AFTER `student_id_display`,
    ADD UNIQUE KEY `uk_student_username` (`username`);

ALTER TABLE `password_resets`
    ADD COLUMN IF NOT EXISTS `email` VARCHAR(255) DEFAULT NULL AFTER `account_id`,
    ADD COLUMN IF NOT EXISTS `raw_code` VARCHAR(20) DEFAULT NULL AFTER `code_hash`,
    ADD INDEX `idx_reset_email` (`email`);

-- 8. Seed Academy Information and Site Settings for ELOCENTRA
INSERT INTO `system_settings` (`setting_key`, `setting_value`) VALUES
('academy_name', 'ELOCENTRA – English Academy (PVT) LTD'),
('academy_slogan', 'Learn English. Speak Confidently. Succeed Globally.'),
('academy_email', 'info@elocentra.academy'),
('academy_phone', '+94 77 123 4567'),
('academy_whatsapp', '+94 77 123 4567'),
('academy_address', 'No. 123, Education Lane, Colombo, Sri Lanka'),
('academy_office_hours', 'Mon - Fri: 9.00 AM - 5.00 PM'),
('academy_vision', 'To be the premier English academy empowering students with fluent communication, critical thinking, and global competence.'),
('academy_mission', 'To provide transformative, accessible, and high-standard English language and multidisciplinary education that enables learners to excel academically, professionally, and internationally.'),
('academy_main_goal', 'Equip every learner with fluent English communication, confidence, and real-world skills to thrive in global academic and career environments.'),
('academy_supporting_goals', '[\"Provide comprehensive, practical language curriculum from foundational to advanced levels.\", \"Foster interactive learning environments guided by experienced educators.\", \"Integrate multidisciplinary knowledge including psychology and business communication.\", \"Deliver accessible, modern online and blended learning opportunities.\"]')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);

-- 9. Seed DirectPay Initial Settings
INSERT INTO `directpay_config` (`id`, `merchant_id`, `api_key`, `secret_key`, `environment`, `currency`, `is_enabled`)
VALUES (1, 'DP_ELOCENTRA_TEST', 'sec_key_elocentra_live_2026', 'sec_secret_elocentra_live_2026', 'sandbox', 'LKR', 1)
ON DUPLICATE KEY UPDATE `merchant_id` = VALUES(`merchant_id`);
