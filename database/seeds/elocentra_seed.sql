-- ============================================================================
-- ELOCENTRA English Academy - Initial Data Seeding
-- Matches user reference image and prompt requirements
-- ============================================================================

SET NAMES utf8mb4;
SET time_zone = '+05:30';

-- Standard Demo Password Hash: 'Demo@12345'
SET @demo_hash = '$2y$10$hOZwUwyTLdDQz9VMi1XaoOV3P3OXxD5SSP4hr4oLf/04E6a0VqguS';

-- 1. Academy Institute
INSERT INTO `institutes` (`id`, `name`, `location`, `phone1`, `phone2`, `public_description`, `status`)
VALUES (1, 'ELOCENTRA – English Academy (PVT) LTD', 'No. 123, Education Lane, Colombo, Sri Lanka', '+94 77 123 4567', '+94 11 234 5678', 'Premier English and multidisciplinary academy dedicated to professional competence and global confidence.', 'active')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- 2. Update Super Admin user
UPDATE `users` SET 
    `full_name` = 'System Administrator',
    `email` = 'superadmin@elocentra.academy',
    `password_hash` = @demo_hash,
    `status` = 'active'
WHERE `id` = 1;

-- 3. Teachers / Resource Persons Users
INSERT INTO `users` (`id`, `user_id_display`, `role`, `full_name`, `email`, `phone1`, `whatsapp`, `password_hash`, `status`, `created_by`) VALUES
(2, 'TCH20260001', 'teacher', 'Prof. Senaka Rajapakse', 'senaka@elocentra.academy', '+94 77 234 5678', '+94 77 234 5678', @demo_hash, 'active', 1),
(3, 'TCH20260002', 'teacher', 'Dr. Anoma Wickramasinghe', 'anoma@elocentra.academy', '+94 77 345 6789', '+94 77 345 6789', @demo_hash, 'active', 1)
ON DUPLICATE KEY UPDATE `full_name` = VALUES(`full_name`), `password_hash` = VALUES(`password_hash`), `status` = 'active';

-- 4. Sample Student
INSERT INTO `students` (`id`, `student_id_display`, `username`, `full_name`, `email`, `phone1`, `whatsapp`, `address`, `password_hash`, `status`) VALUES
(1, 'STU20260001', 'kasun_perera', 'Kasun Perera', 'student@elocentra.academy', '+94 77 890 1234', '+94 77 890 1234', 'No. 45/2, Temple Road, Colombo 03', @demo_hash, 'active')
ON DUPLICATE KEY UPDATE `username` = VALUES(`username`), `password_hash` = VALUES(`password_hash`), `status` = 'active';

-- 5. Subject Areas
INSERT INTO `subject_areas` (`id`, `name`, `slug`, `description`, `icon`, `sort_order`, `status`) VALUES
(1, 'English & Communication', 'english-communication', 'Comprehensive English mastery, spoken fluency, academic English and international test preparation.', 'chat-bubble-bottom-center-text', 1, 'active'),
(2, 'Psychology', 'psychology', 'Foundational and behavioral psychology, cognitive development, emotional intelligence, and interpersonal dynamics.', 'academic-cap', 2, 'active'),
(3, 'Business Accounting', 'business-accounting', 'Modern financial accounting, management reporting, bookkeeping principles, and decision analysis.', 'calculator', 3, 'active'),
(4, 'Professional Development', 'professional-development', 'Executive presentation, corporate correspondence, negotiation tactics, and international career readiness.', 'briefcase', 4, 'active')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `description` = VALUES(`description`);

-- 6. Resource Persons
INSERT INTO `resource_persons` (`id`, `user_id`, `name`, `title`, `qualifications`, `subject_area_id`, `bio`, `email`, `phone`, `photo`, `sort_order`, `status`) VALUES
(1, 2, 'Prof. Senaka Rajapakse', 'Senior Lecturer in English & Global Communication', 'MA in Linguistics (UK), BA (Hons) English, Cambridge CELTA Fellow', 1, 'Over 18 years of academic teaching experience specializing in communicative language teaching, accent reduction, and international presentation mastery.', 'senaka@elocentra.academy', '+94 77 234 5678', '/assets/img/teachers/senaka.jpg', 1, 'active'),
(2, 3, 'Dr. Anoma Wickramasinghe', 'Senior Consultant & Psychology Educator', 'PhD in Applied Psychology, MSc Cognitive Science, Certified Corporate Coach', 2, 'Specializes in behavioral psychology, cognitive performance, and workplace emotional intelligence with extensive international research background.', 'anoma@elocentra.academy', '+94 77 345 6789', '/assets/img/teachers/anoma.jpg', 2, 'active'),
(3, NULL, 'Mr. Kaveen Jayawardena', 'Lead Lecturer in Business & Accounting', 'FCA (Chartered Accountant), MBA (PIM), BSc Finance (Special)', 3, 'Senior financial consultant with 15 years guiding corporate leaders and students through practical business accounting and financial acumen.', 'kaveen@elocentra.academy', '+94 77 456 7890', '/assets/img/teachers/kaveen.jpg', 3, 'active'),
(4, NULL, 'Ms. Dinithi Senanayake', 'Head of Communication & IELTS Master Trainer', 'MA in TESL, BEd (English), Cambridge Certified DELTA Instructor', 1, 'Empowered over 5,000 learners to achieve Band 8+ in IELTS and excel in multinational corporate communication roles.', 'dinithi@elocentra.academy', '+94 77 567 8901', '/assets/img/teachers/dinithi.jpg', 4, 'active')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `title` = VALUES(`title`), `qualifications` = VALUES(`qualifications`);

-- 7. Courses (Classes table)
INSERT INTO `classes` (`id`, `course_code`, `class_name`, `subject`, `subject_area_id`, `institute_id`, `teacher_id`, `delivery_mode`, `duration_weeks`, `course_level`, `has_certificate`, `monthly_fee`, `price`, `description`, `course_thumbnail`, `is_featured`, `status`) VALUES
(1, 'ENG-101', 'English for Global Communication', 'English & Communication', 1, 1, 2, 'online', '12 Weeks', 'Intermediate', 1, 25000.00, 25000.00, 'A comprehensive course to improve your English language skills, confidence, language proficiency, communication confidence, and real-world communication for academic, professional, and global opportunities.', '/assets/img/courses/english-global.jpg', 1, 'active'),
(2, 'PSY-201', 'Foundations of Psychology', 'Psychology', 2, 1, 3, 'online', '10 Weeks', 'Beginner', 1, 28000.00, 28000.00, 'Explore foundational psychology, human behavioral dynamics, cognitive patterns, emotional intelligence, and mental wellbeing in modern life.', '/assets/img/courses/psychology.jpg', 1, 'active'),
(3, 'ACC-301', 'Business Accounting Essentials', 'Business Accounting', 3, 1, NULL, 'online', '14 Weeks', 'Intermediate', 1, 32000.00, 32000.00, 'Master financial accounting, ledger management, balance sheets, cashflow modeling, and budgeting for career success and business acumen.', '/assets/img/courses/accounting.jpg', 1, 'active'),
(4, 'ENG-202', 'Professional Communication Skills', 'English & Communication', 1, 1, 2, 'online', '8 Weeks', 'Advanced', 1, 20000.00, 20000.00, 'Refine high-impact verbal fluency, executive meeting participation, persuasive speech craft, and email drafting for international business.', '/assets/img/courses/communication.jpg', 1, 'active')
ON DUPLICATE KEY UPDATE `class_name` = VALUES(`class_name`), `price` = VALUES(`price`), `description` = VALUES(`description`);

-- 8. Bank Accounts
INSERT INTO `bank_accounts` (`id`, `bank_name`, `branch_name`, `account_name`, `account_number`, `swift_code`, `instructions`, `sort_order`, `status`) VALUES
(1, 'Commercial Bank of Ceylon', 'Kollupitiya Branch', 'ELOCENTRA – English Academy (PVT) LTD', '8001234567', 'CCEYLKFX', 'Please include your full name and student ID or username as the payment description/reference.', 1, 'active'),
(2, 'Bank of Ceylon', 'Corporate Branch Colombo', 'ELOCENTRA – English Academy (PVT) LTD', '007123456789', 'BCEYLKLX', 'Online transfers or cash deposits accepted. Upload the payment receipt/slip after transferring.', 2, 'active')
ON DUPLICATE KEY UPDATE `bank_name` = VALUES(`bank_name`), `account_number` = VALUES(`account_number`);
