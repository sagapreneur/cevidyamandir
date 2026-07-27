-- ============================================================
-- Channawar's e Vidya Mandir — database export
-- Import this into your Hostinger MySQL database (phpMyAdmin > Import).
-- Generated: 2026-07-12 14:03:40
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';

-- ----------------------------------------------------------
-- Table: cevm_activity_log
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_activity_log`;
CREATE TABLE `cevm_activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `action` varchar(60) NOT NULL,
  `entity` varchar(60) DEFAULT NULL,
  `entity_id` int(10) unsigned DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_log_user` (`user_id`),
  CONSTRAINT `fk_log_user` FOREIGN KEY (`user_id`) REFERENCES `cevm_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------------------------------------
-- Table: cevm_announcements
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_announcements`;
CREATE TABLE `cevm_announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lead_text` varchar(255) NOT NULL,
  `strong_text` varchar(190) DEFAULT NULL,
  `link_url` varchar(190) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_ann_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_announcements` (`id`,`lead_text`,`strong_text`,`link_url`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
('1','Admissions open for 2026-27','Limited seats available',NULL,'0','1','2026-07-07 10:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_calendar_pages
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_calendar_pages`;
CREATE TABLE `cevm_calendar_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `session` varchar(40) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_calendar_pages` (`id`,`title`,`image`,`session`,`sort_order`,`is_published`,`is_active`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Academic Calendar — Page 1','calendar/2026-27/page-01.jpg','2026-2027','1','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('2','Academic Calendar — Page 2','calendar/2026-27/page-02.jpg','2026-2027','2','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('3','Academic Calendar — Page 3','calendar/2026-27/page-03.jpg','2026-2027','3','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('4','Academic Calendar — Page 4','calendar/2026-27/page-04.jpg','2026-2027','4','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('5','Academic Calendar — Page 5','calendar/2026-27/page-05.jpg','2026-2027','5','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('6','Academic Calendar — Page 6','calendar/2026-27/page-06.jpg','2026-2027','6','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('7','Academic Calendar — Page 7','calendar/2026-27/page-07.jpg','2026-2027','7','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('8','Academic Calendar — Page 8','calendar/2026-27/page-08.jpg','2026-2027','8','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('9','Academic Calendar — Page 9','calendar/2026-27/page-09.jpg','2026-2027','9','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('10','Academic Calendar — Page 10','calendar/2026-27/page-10.jpg','2026-2027','10','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('11','Academic Calendar — Page 11','calendar/2026-27/page-11.jpg','2026-2027','11','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('12','Academic Calendar — Page 12','calendar/2026-27/page-12.jpg','2026-2027','12','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('13','Academic Calendar — Page 13','calendar/2026-27/page-13.jpg','2026-2027','13','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL),
('14','Academic Calendar — Page 14','calendar/2026-27/page-14.jpg','2026-2027','14','1','1','2026-07-09 15:19:46','2026-07-27 00:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_content_blocks
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_content_blocks`;
CREATE TABLE `cevm_content_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(60) NOT NULL,
  `block_key` varchar(80) NOT NULL,
  `eyebrow` varchar(190) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link_label` varchar(120) DEFAULT NULL,
  `link_url` varchar(190) DEFAULT NULL,
  `extra` longtext DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_block` (`page`,`block_key`),
  KEY `idx_block_page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_content_blocks` (`id`,`page`,`block_key`,`eyebrow`,`title`,`subtitle`,`body`,`image`,`link_label`,`link_url`,`extra`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
('1','index','hero','Welcome to C. E. Vidya Mandir','A Brighter Future <span class=\"text-gradient\">Starts Here</span>','','We nurture curious minds with a values-driven education, expert teachers and a safe, joyful campus where every child thrives.',NULL,'Apply for Admission','admissions.html',NULL,'0','1','2026-07-07 10:00:00',NULL),
('2','index','programs','Our programs','Academic Classes We Offer','A continuous learning journey from early years to senior school.','',NULL,'','',NULL,'1','1','2026-07-07 10:00:00',NULL),
('3','about','mission','','Mission','','To provide an inclusive, joyful and rigorous education that empowers every student to become a confident, compassionate and capable citizen.',NULL,'','',NULL,'0','1','2026-07-07 10:00:00',NULL),
('4','about','vision','','Vision','','To be a centre of learning excellence where tradition meets innovation and every child discovers their fullest potential.',NULL,'','',NULL,'1','1','2026-07-07 10:00:00',NULL),
('5','about','values','','Core Values','','Integrity, curiosity, respect, resilience and community — the values woven into everything we teach and do.',NULL,'','',NULL,'2','1','2026-07-07 10:00:00',NULL),
('6','index','about',NULL,NULL,NULL,NULL,'campus.jpg',NULL,NULL,NULL,'0','1','2026-07-09 15:36:41',NULL),
('7','about','intro',NULL,NULL,NULL,NULL,'campus.jpg',NULL,NULL,NULL,'0','1','2026-07-09 15:36:41',NULL),
('8','about','learning',NULL,NULL,NULL,NULL,'classroom.jpg',NULL,NULL,NULL,'0','1','2026-07-09 15:36:41',NULL),
('9','about','facilities',NULL,NULL,NULL,NULL,'development.jpg',NULL,NULL,NULL,'0','1','2026-07-09 15:36:41',NULL),
('10','about','cta',NULL,NULL,NULL,NULL,'development.jpg',NULL,NULL,NULL,'0','1','2026-07-09 15:36:41',NULL);

-- ----------------------------------------------------------
-- Table: cevm_cta_blocks
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_cta_blocks`;
CREATE TABLE `cevm_cta_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(60) NOT NULL,
  `heading` varchar(190) NOT NULL,
  `subtext` text DEFAULT NULL,
  `primary_label` varchar(60) DEFAULT NULL,
  `primary_url` varchar(190) DEFAULT NULL,
  `secondary_label` varchar(60) DEFAULT NULL,
  `secondary_url` varchar(190) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_cta_identifier` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_cta_blocks` (`id`,`identifier`,`heading`,`subtext`,`primary_label`,`primary_url`,`secondary_label`,`secondary_url`,`image`,`is_active`,`created_at`,`updated_at`) VALUES
('1','home_cta','Early-Bird Concession For The First 60 Admissions','Secure your child’s seat early and enjoy a special enrolment benefit for the new session.','Book a School Visit','admissions.html','Admissions 2026-27','admissions.html',NULL,'1','2026-07-07 10:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_decorations
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_decorations`;
CREATE TABLE `cevm_decorations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(60) NOT NULL,
  `shape` varchar(40) NOT NULL DEFAULT 'blob',
  `color` varchar(30) DEFAULT 'primary',
  `position` varchar(120) DEFAULT NULL,
  `size` varchar(60) DEFAULT NULL,
  `opacity` int(11) NOT NULL DEFAULT 40,
  `animation` varchar(30) DEFAULT 'floaty',
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_deco_section` (`section`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_decorations` (`id`,`section`,`shape`,`color`,`position`,`size`,`opacity`,`animation`,`image`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
('1','hero','blob','primary','left-[-120px] top-24','h-80 w-80','40','floaty',NULL,'0','1','2026-07-07 10:00:00',NULL),
('2','hero','blob','accent','right-[-100px] bottom-0','h-72 w-72','40','floaty',NULL,'1','1','2026-07-07 10:00:00',NULL),
('3','cta','blob','accent/40','left-10 top-[-30px]','h-48 w-48','100','none',NULL,'2','1','2026-07-07 10:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_documents
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_documents`;
CREATE TABLE `cevm_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(190) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `category` varchar(60) NOT NULL,
  `parent` varchar(80) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `doc_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_documents` (`id`,`title`,`description`,`category`,`parent`,`file`,`thumbnail`,`sort_order`,`is_published`,`is_featured`,`doc_date`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Curriculum 2026–2027','CBSE curriculum & syllabus for the session.','academic','Curriculum','documents/placeholder.pdf',NULL,'0','1','1','2026-06-15','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('2','Curriculum Declaration','Official declaration of the school curriculum.','academic','Curriculum','documents/placeholder.pdf',NULL,'1','1','0','2026-06-15','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('3','Declaration for Curriculum 2020–2021','Curriculum declaration for the 2020–21 session (historical record).','academic','Curriculum','documents/placeholder.pdf',NULL,'2','1','0','2021-04-10','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('4','Academic Calendar 2026–2027','Term dates, holidays and key events.','academic',NULL,'documents/placeholder.pdf',NULL,'3','1','0','2026-06-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('5','List of Books Prescribed in Various Classes','Class-wise list of prescribed textbooks.','academic','Book List','documents/placeholder.pdf',NULL,'4','1','0','2026-05-20','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('6','Book List 2026–2027','Session book list for all classes.','academic','Book List','documents/book-list-2026-27.pdf',NULL,'5','1','0','2026-05-20','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('7','Exam Plan 2026–2027','Assessment and examination schedule.','academic',NULL,'documents/exam-plan-2026-27.jpeg',NULL,'6','1','0','2026-07-05','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('8','Annual Report 2026–2027','School annual report and highlights.','academic',NULL,'documents/placeholder.pdf',NULL,'7','1','0','2026-04-30','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('9','Student Enrollment 2026–2027','Enrollment numbers for the session.','students',NULL,'documents/student-enrollment-2026-27.pdf',NULL,'8','1','0','2026-04-12','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('10','The Number of Students Class Wise','Class-wise student strength.','students',NULL,'documents/placeholder.pdf',NULL,'9','1','0','2026-06-10','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('11','Transfer Certificate Sample','Sample transfer certificate format.','students',NULL,'documents/transfer-certificate-sample.pdf',NULL,'10','1','0','2026-01-15','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('12','Details of Teachers Including Qualification','Faculty details with qualifications.','teachers',NULL,'documents/placeholder.pdf',NULL,'11','1','0','2026-06-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('13','Teachers List 2026–2027','List of teaching staff for the session.','teachers',NULL,'documents/teachers-list-2026-27.pdf',NULL,'12','1','0','2026-06-20','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('14','Staff Experience 2026–2027','Teaching experience of staff members.','teachers',NULL,'documents/placeholder.pdf',NULL,'13','1','0','2026-05-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('15','School Managing Committee','Members and details of the SMC.','administration',NULL,'board-of-directors.jpg',NULL,'14','1','0','2026-05-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('16','Society Registration','Society registration record.','administration',NULL,'documents/placeholder.pdf',NULL,'15','1','0','2019-03-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('17','Recognition Certificate','Government recognition certificate.','administration','Recognition','documents/placeholder.pdf',NULL,'16','1','0','2020-06-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('18','No Objection Certificate','NOC issued to the school.','administration','Recognition','documents/placeholder.pdf',NULL,'17','1','0','2020-06-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('19','Self Certification by the School','Self-certification statement.','administration',NULL,'documents/placeholder.pdf',NULL,'18','1','0','2026-04-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('20','Society, Trust, Company Registration Certificate','Trust/society registration certificate.','administration',NULL,'documents/placeholder.pdf',NULL,'19','1','0','2019-03-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('21','Office Memorandum','Official office memorandum.','administration',NULL,'documents/placeholder.pdf',NULL,'20','1','0','2025-11-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('22','School Fee Norms','Approved school fee norms.','administration',NULL,'documents/fees-structure-25-26-26-27.jpeg',NULL,'21','1','0','2026-04-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('23','Infrastructure Details CeVM','Overview of campus infrastructure.','infrastructure','Infrastructure','documents/infrastructure-details.pdf',NULL,'22','1','0','2026-05-10','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('24','Physical Infrastructure','Details of physical infrastructure.','infrastructure','Infrastructure','documents/physical-infrastructure.pdf',NULL,'23','1','0','2026-05-10','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('25','Infrastructure Measurement','Measurement of school infrastructure.','infrastructure','Infrastructure','documents/placeholder.pdf',NULL,'24','1','0','2026-05-10','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('26','Fire Safety Certificate','Valid fire safety certificate.','safety',NULL,'documents/fire-safety-certificate.pdf',NULL,'25','1','0','2026-02-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('27','Water Health and Sanitation Certificate','Water, health and sanitation certificate.','safety',NULL,'documents/water-health-sanitation-certificate.pdf',NULL,'26','1','0','2026-02-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('28','Valid Building Safety Certificate','Structural / building safety certificate.','safety',NULL,'documents/placeholder.pdf',NULL,'27','1','0','2026-02-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('29','Land Certificate','Land ownership / usage certificate.','safety',NULL,'documents/placeholder.pdf',NULL,'28','1','0','2019-01-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('30','Mandatory Disclosure Details','CBSE mandatory public disclosure.','cbse',NULL,'documents/placeholder.pdf',NULL,'29','1','0','2026-06-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('31','Affiliation / Upgradation Letter','CBSE affiliation / upgradation letter.','cbse','Affiliation','documents/placeholder.pdf',NULL,'30','1','0','2025-04-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('32','Affiliation Details','CBSE affiliation details (No. 1130539).','cbse','Affiliation','documents/placeholder.pdf',NULL,'31','1','0','2025-04-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('33','Self Affidavit of School','Self affidavit as per CBSE norms.','cbse',NULL,'documents/self-affidavit.pdf',NULL,'32','1','0','2026-04-01','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('34','Notice of the Meeting of Parent–Teachers Association (PTA) 2026–2027','Notice for the PTA general meeting.','pta',NULL,'notices/epta-formation-2026-27.jpeg',NULL,'33','1','1','2026-07-09','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL),
('35','Executive Committee PTA 2026–2027','Executive committee of the PTA for the session.','pta',NULL,'notices/epta-committee-2026-27.jpeg',NULL,'34','1','1','2026-07-09','2026-07-09 14:52:21','2026-07-27 00:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_downloads
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_downloads`;
CREATE TABLE `cevm_downloads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(190) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(60) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `download_count` int(10) unsigned NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_downloads` (`id`,`title`,`description`,`category`,`file`,`icon`,`download_count`,`is_featured`,`sort_order`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Admission Form 2026-27',NULL,'Forms',NULL,'','0','0','0','2026-07-07 10:00:00',NULL,NULL),
('2','School Prospectus',NULL,'General',NULL,'','0','0','1','2026-07-07 10:00:00',NULL,NULL),
('3','Academic Calendar',NULL,'General',NULL,'','0','0','2','2026-07-07 10:00:00',NULL,NULL),
('4','Fee Structure',NULL,'Fees','documents/fees-structure-25-26-26-27.jpeg','','0','0','3','2026-07-07 10:00:00',NULL,NULL),
('5','Transfer Certificate Request',NULL,'Forms',NULL,'','0','0','4','2026-07-07 10:00:00',NULL,NULL),
('6','Transport Routes',NULL,'General',NULL,'','0','0','5','2026-07-07 10:00:00',NULL,NULL),
('7','Uniform Guidelines',NULL,'General',NULL,'','0','0','6','2026-07-07 10:00:00',NULL,NULL),
('8','Code of Conduct',NULL,'Policy',NULL,'','0','0','7','2026-07-07 10:00:00',NULL,NULL);

-- ----------------------------------------------------------
-- Table: cevm_faqs
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_faqs`;
CREATE TABLE `cevm_faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `page` varchar(60) DEFAULT 'admissions',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_faq_page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_faqs` (`id`,`question`,`answer`,`page`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
('1','When does admission open?','Admissions for the 2026-27 session are currently open. Early applications are encouraged.','admissions','0','1','2026-07-07 10:00:00',NULL),
('2','Is there an entrance test?','For most grades we hold a friendly interaction rather than a formal test.','admissions','1','1','2026-07-07 10:00:00',NULL),
('3','Can I visit the campus first?','Absolutely. Book a guided campus tour through our contact page.','admissions','2','1','2026-07-07 10:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_form_submissions
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_form_submissions`;
CREATE TABLE `cevm_form_submissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_type` varchar(40) NOT NULL DEFAULT 'contact',
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(190) DEFAULT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `subject` varchar(190) DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_form_type` (`form_type`),
  KEY `idx_form_read` (`is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------------------------------------
-- Table: cevm_gallery_albums
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_gallery_albums`;
CREATE TABLE `cevm_gallery_albums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(190) NOT NULL,
  `category` varchar(60) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------------------------------------
-- Table: cevm_gallery_images
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_gallery_images`;
CREATE TABLE `cevm_gallery_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(190) NOT NULL,
  `category` varchar(60) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_video` tinyint(1) NOT NULL DEFAULT 0,
  `video_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_gimg_album` (`album_id`),
  CONSTRAINT `fk_gimg_album` FOREIGN KEY (`album_id`) REFERENCES `cevm_gallery_albums` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_gallery_images` (`id`,`album_id`,`title`,`category`,`image`,`is_featured`,`is_video`,`video_url`,`sort_order`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1',NULL,'U14 Netball Team — 2nd Place, Division Level','sports','gallery/netball-u14-division-2nd-place.jpg','1','0',NULL,'0','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('2',NULL,'Campus & School Life','campus','gallery/campus-7274.jpg','1','0',NULL,'1','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('3',NULL,'Campus & School Life','campus','gallery/campus-7407.jpg','1','0',NULL,'2','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('4',NULL,'Campus & School Life','campus','gallery/campus-7409.jpg','1','0',NULL,'3','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('5',NULL,'Campus & School Life','campus','gallery/campus-7051.jpg','0','0',NULL,'4','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('6',NULL,'Campus & School Life','campus','gallery/campus-7233.jpg','0','0',NULL,'5','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('7',NULL,'Campus & School Life','campus','gallery/campus-7239.jpg','0','0',NULL,'6','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('8',NULL,'Campus & School Life','campus','gallery/campus-7165.jpg','0','0',NULL,'7','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('9',NULL,'Campus & School Life','campus','gallery/campus-20181026.jpg','0','0',NULL,'8','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('10',NULL,'Fun with Emojis in the Classroom','classroom','gallery/classroom-fun-with-emojis.jpg','0','0',NULL,'9','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('11',NULL,'Students Enjoying Online Quiz Time','classroom','gallery/classroom-online-quiz.jpg','0','0',NULL,'10','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('12',NULL,'Save Animals — Environmental Awareness Activity','activities','gallery/env-save-animals.jpg','0','0',NULL,'11','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('13',NULL,'Campus & School Life','campus','gallery/campus-7148.jpg','0','0',NULL,'12','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('14',NULL,'Campus & School Life','campus','gallery/campus-7152.jpg','0','0',NULL,'13','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('15',NULL,'Campus & School Life','campus','gallery/campus-7410.jpg','0','0',NULL,'14','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('16',NULL,'Campus & School Life','campus','gallery/campus-7058.jpg','0','0',NULL,'15','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('17',NULL,'Campus & School Life','campus','gallery/campus-9024.jpg','0','0',NULL,'16','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('18',NULL,'Std X Toppers 2025–26 — 100% Result','achievements','achievements/std-x-toppers-2025-26.png','0','0',NULL,'17','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('19',NULL,'Pride of Our School — Selected to Premier Institutions','achievements','achievements/pride-of-our-school.png','0','0',NULL,'18','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('20',NULL,'National Abacus Olympiad — 5th Rank','achievements','achievements/national-abacus-olympiad.png','0','0',NULL,'19','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL),
('21',NULL,'District Swimming Competition — 1st Place','achievements','achievements/district-swimming.png','0','0',NULL,'20','2026-07-27 00:00:00','2026-07-27 00:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_job_openings
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_job_openings`;
CREATE TABLE `cevm_job_openings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `department` varchar(120) DEFAULT NULL,
  `type` varchar(60) DEFAULT NULL,
  `location` varchar(120) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_job_openings` (`id`,`title`,`department`,`type`,`location`,`description`,`is_active`,`sort_order`,`created_at`,`deleted_at`) VALUES
('1','PGT / TGT Teacher','Academics','Full-time','Wardha',NULL,'1','0','2026-07-09 10:24:29',NULL),
('2','Receptionist','Administration','Full-time','Wardha',NULL,'1','1','2026-07-09 10:24:29',NULL),
('3','Accountant','Administration','Full-time','Wardha',NULL,'1','2','2026-07-09 10:24:29',NULL),
('4','Office Assistant','Administration','Full-time','Wardha',NULL,'1','3','2026-07-09 10:24:29',NULL),
('5','Sports Coach','Co-curricular','Full-time','Wardha',NULL,'1','4','2026-07-09 10:24:29',NULL);

-- ----------------------------------------------------------
-- Table: cevm_media
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_media`;
CREATE TABLE `cevm_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(190) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(60) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(20) DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `file_size` int(10) unsigned DEFAULT 0,
  `uploaded_by` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_media_type` (`file_type`),
  KEY `idx_media_cat` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------------------------------------
-- Table: cevm_navigation
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_navigation`;
CREATE TABLE `cevm_navigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu` varchar(30) NOT NULL DEFAULT 'primary',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `label` varchar(120) NOT NULL,
  `url` varchar(190) NOT NULL DEFAULT '#',
  `nav_key` varchar(60) DEFAULT NULL,
  `is_mega` tinyint(1) NOT NULL DEFAULT 0,
  `mega_group` varchar(60) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_nav_menu` (`menu`),
  KEY `idx_nav_parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_navigation` (`id`,`menu`,`parent_id`,`label`,`url`,`nav_key`,`is_mega`,`mega_group`,`sort_order`,`is_active`) VALUES
('1','primary',NULL,'Home','index.html','home','0',NULL,'1','1'),
('2','primary',NULL,'About','about.html','about','0',NULL,'2','1'),
('3','primary','2','About Us','about.html',NULL,'0',NULL,'0','1'),
('4','primary','2','President\'s Desk','president-desk.html',NULL,'0',NULL,'1','1'),
('5','primary','2','Principal\'s Desk','principal-desk.html',NULL,'0',NULL,'2','1'),
('6','primary',NULL,'Academics','programs.html','academics','1',NULL,'6','1'),
('7','primary','6','Programs','programs.html',NULL,'0','Learning','0','1'),
('8','primary','6','Curriculum','curriculum.html',NULL,'0','Learning','1','1'),
('9','primary','6','Academic Calendar','academic-calendar.html',NULL,'0','Planning','2','1'),
('10','primary','6','Fees Structure','fees-structure.html',NULL,'0','Planning','3','1'),
('11','primary',NULL,'Admissions','admissions.html','admissions','0',NULL,'11','1'),
('12','primary',NULL,'Media','gallery.html','media','0',NULL,'12','1'),
('13','primary','12','Notices & Circulars','notices.html',NULL,'0',NULL,'0','1'),
('14','primary','12','Gallery','gallery.html',NULL,'0',NULL,'1','1'),
('15','primary','12','Downloads','downloads.html',NULL,'0',NULL,'2','1'),
('16','primary','12','Reviews','reviews.html',NULL,'0',NULL,'3','1'),
('17','primary',NULL,'Get Involved','engage.html','engage','0',NULL,'17','1'),
('18','primary','17','Engage With Us','engage.html',NULL,'0',NULL,'0','1'),
('19','primary','17','Career Opportunities','careers.html',NULL,'0',NULL,'1','1'),
('20','primary','17','Intern & Volunteer','intern-volunteer.html',NULL,'0',NULL,'2','1'),
('21','primary','17','Support Us','support-us.html',NULL,'0',NULL,'3','1'),
('22','primary',NULL,'Contact','contact.html','contact','0',NULL,'22','1'),
('23','primary','22','Contact Us','contact.html',NULL,'0',NULL,'0','1'),
('24','primary','22','Locate Us','locate-us.html',NULL,'0',NULL,'1','1'),
('25','primary','22','Bona Fide Request','bonafide.html',NULL,'0',NULL,'2','1'),
('26','footer',NULL,'Quick Links','#',NULL,'0',NULL,'26','1'),
('27','footer','26','About School','about.html',NULL,'0',NULL,'0','1'),
('28','footer','26','Admissions','admissions.html',NULL,'0',NULL,'1','1'),
('29','footer','26','Notices','notices.html',NULL,'0',NULL,'2','1'),
('30','footer','26','Gallery','gallery.html',NULL,'0',NULL,'3','1'),
('31','footer','26','Contact Us','contact.html',NULL,'0',NULL,'4','1'),
('32','footer',NULL,'Academics','#',NULL,'0',NULL,'32','1'),
('33','footer','32','Programs','programs.html',NULL,'0',NULL,'0','1'),
('34','footer','32','Curriculum','curriculum.html',NULL,'0',NULL,'1','1'),
('35','footer','32','Calendar','academic-calendar.html',NULL,'0',NULL,'2','1'),
('36','footer','32','Fees Structure','fees-structure.html',NULL,'0',NULL,'3','1'),
('37','footer','32','Downloads','downloads.html',NULL,'0',NULL,'4','1');

-- ----------------------------------------------------------
-- Table: cevm_notices
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_notices`;
CREATE TABLE `cevm_notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(190) NOT NULL,
  `category` varchar(60) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `body_html` longtext DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_pinned` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_notice_pub` (`publish_date`),
  KEY `idx_notice_cat` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_notices` (`id`,`title`,`category`,`excerpt`,`body_html`,`attachment`,`image`,`publish_date`,`expiry_date`,`is_featured`,`is_pinned`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Annual Day 2026 — schedule & guidelines','Events','Details of the programme, timings and seating for parents.',NULL,NULL,NULL,'2026-07-12',NULL,'1','1','2026-07-07 10:00:00',NULL,'2026-07-09 13:54:29'),
('2','Revised school timings for monsoon','Circular','Applicable from 15 July for all grades.',NULL,NULL,NULL,'2026-07-08',NULL,'0','0','2026-07-07 10:00:00',NULL,'2026-07-09 13:54:29'),
('3','Term 1 assessment datesheet','Academics','Grade-wise schedule now available for download.',NULL,NULL,NULL,'2026-07-04',NULL,'0','0','2026-07-07 10:00:00',NULL,'2026-07-09 13:54:29'),
('4','Admissions open for 2026-27','Admissions','Applications accepted for all grades. Limited seats.',NULL,NULL,NULL,'2026-07-01',NULL,'1','0','2026-07-07 10:00:00',NULL,'2026-07-09 13:54:29'),
('5','Inter-house football tournament','Sports','Trials begin next week; register with your house captain.',NULL,NULL,NULL,'2026-06-28',NULL,'0','0','2026-07-07 10:00:00',NULL,'2026-07-09 13:54:29'),
('6','Executive Parent Teachers Association (EPTA) Formation Notice','Circular','Official notice regarding the formation of the Executive Parent Teachers Association (EPTA) for the academic session 2026–2027.',NULL,'notices/epta-formation-2026-27.jpeg','notices/epta-formation-2026-27.jpeg','2026-07-06',NULL,'1','1','2026-07-09 10:24:29','2026-07-27 00:00:00',NULL),
('7','Executive Committee of Parent Teachers Association (EPTA) – Session 2026–2027','Notice','List of the Executive Committee members of the Parent Teachers Association (EPTA) for the academic session 2026–2027.',NULL,'notices/epta-committee-2026-27.jpeg','notices/epta-committee-2026-27.jpeg','2026-07-25',NULL,'1','1','2026-07-09 10:24:29','2026-07-27 00:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_pages
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_pages`;
CREATE TABLE `cevm_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) NOT NULL,
  `title` varchar(190) NOT NULL,
  `banner_title` varchar(190) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `body_html` longtext DEFAULT NULL,
  `meta_title` varchar(190) DEFAULT NULL,
  `meta_description` varchar(300) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `canonical` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_pages_slug` (`slug`),
  KEY `idx_pages_published` (`is_published`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_pages` (`id`,`slug`,`title`,`banner_title`,`banner_image`,`body_html`,`meta_title`,`meta_description`,`meta_keywords`,`og_image`,`canonical`,`is_published`,`sort_order`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','404','Page Not Found',NULL,NULL,'<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"mx-auto flex max-w-xl flex-col items-center text-center\" data-reveal-stagger=\"100\">\n <div class=\"text-gradient font-heading font-extrabold leading-none\" style=\"font-size:clamp(6rem,18vw,11rem)\" data-reveal>404</div>\n <h1 class=\"t-h2 mt-2\" data-reveal>Oops! Page Not Found</h1>\n <p class=\"t-body mt-3\" data-reveal>The page you&rsquo;re looking for may have been moved, renamed, or no longer exists.</p>\n <div class=\"mt-8 flex flex-wrap justify-center gap-4\" data-reveal>\n <a href=\"index.html\" class=\"btn-primary\">Back to Home</a>\n <a href=\"contact.html\" class=\"btn-outline\">Contact Us</a>\n </div>\n <div class=\"mt-10 w-full max-w-md\" data-reveal>\n <div class=\"search-field\"><span aria-hidden=\"true\"></span><input placeholder=\"Search the site\" aria-label=\"Search\" /><button class=\"btn-primary btn-sm\">Go</button></div>\n </div>\n </div>\n </div>\n</section>','Page Not Found','The page you are looking for could not be found.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('2','index','Home',NULL,NULL,'<!-- ============ HERO ============ -->\n<section class=\"hero\">\n <span class=\"hero-blob left-[-120px] top-24 h-80 w-80 bg-primary\" data-parallax data-speed=\"0.08\"></span>\n <span class=\"hero-blob right-[-100px] bottom-0 h-72 w-72 bg-accent\" data-parallax data-speed=\"0.12\"></span>\n <div class=\"container-edu\">\n <div class=\"hero-grid\">\n <div class=\"flex flex-col items-start gap-6\" data-reveal-stagger=\"120\">\n <span class=\"eyebrow\" data-reveal>Welcome to Channawar\'s e Vidya Mandir</span>\n <h1 class=\"t-display\" data-reveal>A Brighter Future <span class=\"text-gradient\">Starts Here</span></h1>\n <p class=\"t-lead max-w-xl\" data-reveal>We nurture curious minds with a values-driven education, expert teachers and a safe, joyful campus where every child thrives.</p>\n <div class=\"flex flex-wrap items-center gap-4\" data-reveal>\n <a href=\"admissions.html\" class=\"btn-primary btn-lg\">Apply for Admission</a>\n <button class=\"btn-link\" data-modal-open=\"#videoModal\" data-video=\"https://www.youtube.com/embed/ScMzIvxBSi4\">\n <span class=\"play-btn h-11 w-11\">\n <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"currentColor\" aria-hidden=\"true\"><path d=\"M8 5v14l11-7z\"/></svg>\n </span>\n Watch campus tour\n </button>\n </div>\n <div class=\"mt-4 flex flex-wrap gap-8\" data-reveal>\n <div><div class=\"stat-number\" data-count=\"35\">0</div><p class=\"stat-label\">Years of legacy</p></div>\n <div><div class=\"stat-number\" data-count=\"4500\" data-suffix=\"+\">0</div><p class=\"stat-label\">Happy students</p></div>\n <div><div class=\"stat-number\" data-count=\"98\" data-suffix=\"%\">0</div><p class=\"stat-label\">Board results</p></div>\n </div>\n </div>\n\n <div class=\"relative\" data-reveal=\"left\">\n <div class=\"img-zoom overflow-hidden rounded-xl shadow-card\">\n <img src=\"assets/images/placeholders/landscape.svg\" alt=\"Students on the Channawar\'s e Vidya Mandir campus\" width=\"720\" height=\"620\" fetchpriority=\"high\" class=\"h-full w-full object-cover\" decoding=\"async\" />\n </div>\n <div class=\"absolute -bottom-6 -left-6 hidden rounded-lg bg-white p-4 shadow-card sm:flex items-center gap-3 animate-floaty\">\n <span class=\"icon-circle h-12 w-12 bg-accent/20 text-accent-600 text-xl\"></span>\n <div><p class=\"font-bold text-ink leading-tight\">Award Winning</p><p class=\"t-small\">Academics &amp; Sports</p></div>\n </div>\n <div class=\"absolute -top-5 right-6 hidden rounded-lg bg-primary p-4 text-white shadow-lift md:flex items-center gap-3\">\n <span class=\"icon-circle h-11 w-11 bg-white/15 text-lg\"></span>\n <div><p class=\"font-bold leading-tight\">Since 1990</p><p class=\"text-white/80 text-sm\">Trusted by families</p></div>\n </div>\n </div>\n </div>\n </div>\n</section>\n\n<!-- ============ FEATURE STRIP ============ -->\n<section class=\"section !pt-0 -mt-8 relative z-10\">\n <div class=\"container-edu\">\n <div class=\"grid gap-6 md:grid-cols-3\" data-reveal-stagger=\"100\">\n <article class=\"card-feature !text-left flex items-start gap-4\" data-reveal>\n <span class=\"feature-icon !mx-0 !mb-0 shrink-0\"></span>\n <div><h3 class=\"t-h4 mb-1\">Modern Curriculum</h3><p class=\"t-small\">Concept-first learning aligned to national standards.</p></div>\n </article>\n <article class=\"card-feature !text-left flex items-start gap-4\" data-reveal>\n <span class=\"feature-icon !mx-0 !mb-0 shrink-0\"></span>\n <div><h3 class=\"t-h4 mb-1\">Expert Faculty</h3><p class=\"t-small\">Passionate, qualified mentors for every stage.</p></div>\n </article>\n <article class=\"card-feature !text-left flex items-start gap-4\" data-reveal>\n <span class=\"feature-icon !mx-0 !mb-0 shrink-0\"></span>\n <div><h3 class=\"t-h4 mb-1\">Safe Campus</h3><p class=\"t-small\">Secure, CCTV-monitored, child-friendly environment.</p></div>\n </article>\n </div>\n </div>\n</section>\n\n<!-- ============ WELCOME / ABOUT ============ -->\n<section class=\"section\">\n <div class=\"container-edu grid items-center gap-12 lg:grid-cols-2\">\n <div class=\"relative\" data-reveal=\"right\">\n <div class=\"img-zoom overflow-hidden rounded-xl shadow-card\">\n <img src=\"assets/images/placeholders/landscape.svg\" alt=\"Children learning together\" width=\"640\" height=\"560\" loading=\"lazy\" class=\"h-full w-full object-cover\" decoding=\"async\" />\n </div>\n <div class=\"absolute bottom-6 right-0 translate-x-4 rounded-lg bg-primary px-6 py-5 text-white shadow-lift\">\n <div class=\"stat-number !text-white\" data-count=\"120\" data-suffix=\"+\">0</div>\n <p class=\"text-white/80 text-sm\">Expert teachers</p>\n </div>\n </div>\n <div class=\"flex flex-col items-start gap-5\" data-reveal=\"left\">\n <span class=\"eyebrow\">Welcome to our school</span>\n <h2 class=\"t-h2\">The Best Place For Your Child To Learn &amp; Grow</h2>\n <p class=\"t-body\">For over three decades, Channawar\'s e Vidya Mandir has blended academic rigour with compassion, creativity and character. We believe every child is unique and deserves an education that helps them discover their strengths.</p>\n <ul class=\"feature-list\">\n <li>Individual attention with small class sizes</li>\n <li>Smart classrooms and well-equipped laboratories</li>\n <li>Sports, arts and life-skills for holistic growth</li>\n </ul>\n <a href=\"about.html\" class=\"btn-primary mt-2\">Learn more about us</a>\n </div>\n </div>\n</section>\n\n<!-- ============ ACADEMIC PROGRAMS ============ -->\n<section class=\"section section-soft\">\n <div class=\"container-edu\">\n <div class=\"section-head\">\n <span class=\"eyebrow\">Our programs</span>\n <h2 class=\"t-h2\">Academic Classes We Offer</h2>\n <p class=\"t-body\">A continuous learning journey from early years to senior school.</p>\n </div>\n <div class=\"grid gap-6 sm:grid-cols-2 lg:grid-cols-4\" data-reveal-stagger=\"90\">\n <article class=\"card card-hover card-blog\" data-reveal>\n <div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Pre-primary class\" loading=\"lazy\" decoding=\"async\" /></div>\n <div class=\"card-body\"><span class=\"badge-soft mb-3\">Ages 3–5</span><h3 class=\"t-h4 mb-2\">Pre-Primary</h3><p class=\"t-small mb-4\">Play-based foundation for joyful early learners.</p><a href=\"programs.html\" class=\"btn-link\">Explore →</a></div>\n </article>\n <article class=\"card card-hover card-blog\" data-reveal>\n <div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Primary class\" loading=\"lazy\" decoding=\"async\" /></div>\n <div class=\"card-body\"><span class=\"badge-soft mb-3\">Grades 1–5</span><h3 class=\"t-h4 mb-2\">Primary School</h3><p class=\"t-small mb-4\">Strong literacy, numeracy and curiosity.</p><a href=\"programs.html\" class=\"btn-link\">Explore →</a></div>\n </article>\n <article class=\"card card-hover card-blog\" data-reveal>\n <div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Middle school\" loading=\"lazy\" decoding=\"async\" /></div>\n <div class=\"card-body\"><span class=\"badge-soft mb-3\">Grades 6–8</span><h3 class=\"t-h4 mb-2\">Middle School</h3><p class=\"t-small mb-4\">Inquiry-led, concept-first exploration.</p><a href=\"programs.html\" class=\"btn-link\">Explore →</a></div>\n </article>\n <article class=\"card card-hover card-blog\" data-reveal>\n <div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Senior school\" loading=\"lazy\" decoding=\"async\" /></div>\n <div class=\"card-body\"><span class=\"badge-soft mb-3\">Grades 9–10</span><h3 class=\"t-h4 mb-2\">Senior School</h3><p class=\"t-small mb-4\">Board excellence and career readiness.</p><a href=\"programs.html\" class=\"btn-link\">Explore →</a></div>\n </article>\n </div>\n </div>\n</section>\n\n<!-- ============ CTA OFFER BANNER ============ -->\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"cta-band !text-left overflow-hidden\">\n <span class=\"hero-blob left-10 top-[-30px] h-48 w-48 bg-accent/40\"></span>\n <div class=\"grid items-center gap-8 lg:grid-cols-2\">\n <div class=\"relative z-10\" data-reveal=\"right\">\n <span class=\"badge-accent mb-4\">Admissions 2026-27</span>\n <h2 class=\"t-h2 !text-white\">Early-Bird Concession For The First 60 Admissions</h2>\n <p class=\"mt-3 text-white/85\">Secure your child&rsquo;s seat early and enjoy a special enrolment benefit for the new session.</p>\n <div class=\"mt-6 flex flex-wrap gap-4\">\n <a href=\"admissions.html\" class=\"btn-accent\">Book a School Visit</a>\n <a href=\"contact.html\" class=\"btn-outline border-white text-white hover:bg-white hover:text-primary\">Enquire Now</a>\n </div>\n </div>\n <div class=\"relative hidden lg:block\" data-reveal=\"left\">\n <img src=\"assets/images/placeholders/landscape.svg\" alt=\"Happy student\" loading=\"lazy\" class=\"ml-auto w-4/5 rounded-lg object-cover shadow-lift\" decoding=\"async\" />\n </div>\n </div>\n </div>\n </div>\n</section>\n\n<!-- ============ STATISTICS ============ -->\n<section class=\"section section-ink relative overflow-hidden\">\n <span class=\"hero-blob right-[-80px] top-[-60px] h-72 w-72 bg-primary/40\"></span>\n <div class=\"container-edu relative z-10\">\n <div class=\"stats-grid\" data-reveal-stagger=\"100\">\n <div class=\"stat\" data-reveal><div class=\"stat-icon\"></div><div class=\"stat-number\" data-count=\"4500\" data-suffix=\"+\">0</div><p class=\"stat-label\">Students enrolled</p></div>\n <div class=\"stat\" data-reveal><div class=\"stat-icon\"></div><div class=\"stat-number\" data-count=\"120\" data-suffix=\"+\">0</div><p class=\"stat-label\">Qualified teachers</p></div>\n <div class=\"stat\" data-reveal><div class=\"stat-icon\"></div><div class=\"stat-number\" data-count=\"250\" data-suffix=\"+\">0</div><p class=\"stat-label\">Awards won</p></div>\n <div class=\"stat\" data-reveal><div class=\"stat-icon\"></div><div class=\"stat-number\" data-count=\"30\" data-suffix=\"+\">0</div><p class=\"stat-label\">Clubs &amp; activities</p></div>\n </div>\n </div>\n</section>\n\n<!-- ============ GALLERY PREVIEW ============ -->\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\">\n <span class=\"eyebrow\">Campus life</span>\n <h2 class=\"t-h2\">Moments From Our Campus</h2>\n </div>\n <div class=\"gallery-grid lg:grid-cols-4\">\n <figure class=\"gallery-item\" data-reveal><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Chess activity\" loading=\"lazy\" decoding=\"async\" /><div class=\"gallery-overlay\"><span class=\"zoom\"></span></div></figure>\n <figure class=\"gallery-item\" data-reveal><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Library session\" loading=\"lazy\" decoding=\"async\" /><div class=\"gallery-overlay\"><span class=\"zoom\"></span></div></figure>\n <figure class=\"gallery-item\" data-reveal><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Sports day\" loading=\"lazy\" decoding=\"async\" /><div class=\"gallery-overlay\"><span class=\"zoom\"></span></div></figure>\n <figure class=\"gallery-item\" data-reveal><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Graduation\" loading=\"lazy\" decoding=\"async\" /><div class=\"gallery-overlay\"><span class=\"zoom\"></span></div></figure>\n </div>\n <div class=\"mt-10 text-center\"><a href=\"gallery.html\" class=\"btn-outline\">View full gallery</a></div>\n </div>\n</section>\n\n<!-- ============ TESTIMONIALS ============ -->\n<section class=\"section section-soft\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">What parents say</span><h2 class=\"t-h2\">Loved By Students &amp; Families</h2></div>\n <div class=\"slider mx-auto max-w-3xl\" data-slider data-autoplay=\"6000\">\n <div class=\"slider-track\">\n <div class=\"slider-slide px-2\"><div class=\"testimonial\"><div class=\"rating\"></div><p class=\"testimonial-quote\">The teachers genuinely care. My daughter looks forward to school every single day and has grown so confident.</p><div class=\"testimonial-author\"><img class=\"testimonial-avatar\" src=\"assets/images/placeholders/avatar.svg\" alt=\"\" loading=\"lazy\" decoding=\"async\" /><div><p class=\"testimonial-name\">Meera Nair</p><p class=\"testimonial-role\">Parent, Grade 4</p></div></div></div></div>\n <div class=\"slider-slide px-2\"><div class=\"testimonial\"><div class=\"rating\"></div><p class=\"testimonial-quote\">A perfect balance of academics, sports and values. The campus is safe and the staff are wonderfully supportive.</p><div class=\"testimonial-author\"><img class=\"testimonial-avatar\" src=\"assets/images/placeholders/avatar.svg\" alt=\"\" loading=\"lazy\" decoding=\"async\" /><div><p class=\"testimonial-name\">Arjun Deshmukh</p><p class=\"testimonial-role\">Parent, Grade 9</p></div></div></div></div>\n <div class=\"slider-slide px-2\"><div class=\"testimonial\"><div class=\"rating\"></div><p class=\"testimonial-quote\">Being an alumna, I still cherish the friendships and the values this school gave me. Highly recommended.</p><div class=\"testimonial-author\"><img class=\"testimonial-avatar\" src=\"assets/images/placeholders/avatar.svg\" alt=\"\" loading=\"lazy\" decoding=\"async\" /><div><p class=\"testimonial-name\">Sana Kapoor</p><p class=\"testimonial-role\">Alumna, Batch 2015</p></div></div></div></div>\n </div>\n <div class=\"slider-dots\"></div>\n </div>\n </div>\n</section>\n\n<!-- ============ TEACHERS ============ -->\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Our mentors</span><h2 class=\"t-h2\">Meet Our Dedicated Teachers</h2></div>\n <div class=\"grid gap-6 sm:grid-cols-2 lg:grid-cols-4\" data-reveal-stagger=\"90\">\n <article class=\"card-team\" data-reveal><div class=\"team-photo\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Teacher\" loading=\"lazy\" decoding=\"async\" /><div class=\"team-social\"><a href=\"#\">f</a><a href=\"#\">in</a><a href=\"#\">x</a></div></div><div class=\"card-body\"><h3 class=\"t-h4\">Priya Sharma</h3><p class=\"t-small text-primary\">Head of Science</p></div></article>\n <article class=\"card-team\" data-reveal><div class=\"team-photo\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Teacher\" loading=\"lazy\" decoding=\"async\" /><div class=\"team-social\"><a href=\"#\">f</a><a href=\"#\">in</a><a href=\"#\">x</a></div></div><div class=\"card-body\"><h3 class=\"t-h4\">Rakesh Menon</h3><p class=\"t-small text-primary\">Mathematics</p></div></article>\n <article class=\"card-team\" data-reveal><div class=\"team-photo\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Teacher\" loading=\"lazy\" decoding=\"async\" /><div class=\"team-social\"><a href=\"#\">f</a><a href=\"#\">in</a><a href=\"#\">x</a></div></div><div class=\"card-body\"><h3 class=\"t-h4\">Anita Roy</h3><p class=\"t-small text-primary\">English &amp; Literature</p></div></article>\n <article class=\"card-team\" data-reveal><div class=\"team-photo\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Teacher\" loading=\"lazy\" decoding=\"async\" /><div class=\"team-social\"><a href=\"#\">f</a><a href=\"#\">in</a><a href=\"#\">x</a></div></div><div class=\"card-body\"><h3 class=\"t-h4\">Vikram Iyer</h3><p class=\"t-small text-primary\">Sports Director</p></div></article>\n </div>\n </div>\n</section>\n\n<!-- ============ LATEST NEWS ============ -->\n<section class=\"section section-soft\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Latest updates</span><h2 class=\"t-h2\">News &amp; Announcements</h2></div>\n <div class=\"grid gap-6 md:grid-cols-3\" data-reveal-stagger=\"100\">\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Annual day\" loading=\"lazy\" decoding=\"async\" /><span class=\"post-date\"><strong class=\"block text-lg\">12</strong>Jul</span></div><div class=\"card-body\"><div class=\"card-meta mb-2\"><span> Events</span></div><h3 class=\"t-h4 mb-2\">Annual Day Celebrations 2026</h3><p class=\"t-small mb-4\">A vibrant showcase of talent across music, dance and drama.</p><a href=\"notices.html\" class=\"btn-link\">Read more →</a></div></article>\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Science fair\" loading=\"lazy\" decoding=\"async\" /><span class=\"post-date\"><strong class=\"block text-lg\">04</strong>Jul</span></div><div class=\"card-body\"><div class=\"card-meta mb-2\"><span> Academics</span></div><h3 class=\"t-h4 mb-2\">Inter-School Science Fair Winners</h3><p class=\"t-small mb-4\">Our young innovators bring home top honours.</p><a href=\"notices.html\" class=\"btn-link\">Read more →</a></div></article>\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Admissions\" loading=\"lazy\" decoding=\"async\" /><span class=\"post-date\"><strong class=\"block text-lg\">01</strong>Jul</span></div><div class=\"card-body\"><div class=\"card-meta mb-2\"><span> Notice</span></div><h3 class=\"t-h4 mb-2\">Admissions Now Open for 2026-27</h3><p class=\"t-small mb-4\">Applications are being accepted for all grades.</p><a href=\"admissions.html\" class=\"btn-link\">Read more →</a></div></article>\n </div>\n </div>\n</section>','Home','Channawar\'s e Vidya Mandir — a nurturing school shaping bright futures through academic excellence, expert faculty and holistic development.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('3','about','About Us',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>About Us</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><span class=\"current\">About Us</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<!-- ABOUT INTRO -->\n<section class=\"section\">\n <div class=\"container-edu grid items-center gap-12 lg:grid-cols-2\">\n <div class=\"relative\" data-reveal=\"right\">\n <div class=\"img-zoom overflow-hidden rounded-xl shadow-card\">\n <img src=\"assets/images/placeholders/landscape.svg\" alt=\"Students celebrating\" width=\"640\" height=\"540\" class=\"h-full w-full object-cover\" decoding=\"async\" loading=\"lazy\" />\n </div>\n <div class=\"absolute -right-4 bottom-8 hidden w-64 rounded-lg bg-white p-5 shadow-card sm:block\">\n <p class=\"eyebrow mb-3\">We support your ambition</p>\n <ul class=\"feature-list text-sm\">\n <li>Holistic curriculum</li>\n <li>Trusted mentors</li>\n </ul>\n <a href=\"admissions.html\" class=\"btn-primary btn-sm btn-block mt-4\">Join us today</a>\n </div>\n </div>\n <div class=\"flex flex-col items-start gap-5\" data-reveal=\"left\">\n <span class=\"eyebrow\">About the school</span>\n <h2 class=\"t-h2\">About Channawar\'s e Vidya Mandir</h2>\n <p class=\"t-body\">Founded in 1990, Channawar\'s e Vidya Mandir has grown into one of the region&rsquo;s most respected schools. We combine a strong academic foundation with sports, arts and community values to prepare students for life, not just examinations.</p>\n <p class=\"t-body\">Our campus is a place where curiosity is celebrated, effort is rewarded, and every child is known by name.</p>\n <div class=\"grid grid-cols-2 gap-6\">\n <div><div class=\"stat-number\" data-count=\"35\">0</div><p class=\"stat-label\">Years of trust</p></div>\n <div><div class=\"stat-number\" data-count=\"4500\" data-suffix=\"+\">0</div><p class=\"stat-label\">Alumni network</p></div>\n </div>\n <a href=\"admissions.html\" class=\"btn-primary mt-2\">Start admission</a>\n </div>\n </div>\n</section>\n\n<!-- MISSION / VISION / VALUES TABS -->\n<section class=\"section section-soft\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">What drives us</span><h2 class=\"t-h2\">Our Mission, Vision &amp; Values</h2></div>\n <div class=\"tabs items-center\" data-tabs>\n <div class=\"tablist mx-auto\" role=\"tablist\" aria-label=\"About tabs\">\n <button class=\"tab\" role=\"tab\" id=\"ab1\" aria-controls=\"ap1\" aria-selected=\"true\">Mission</button>\n <button class=\"tab\" role=\"tab\" id=\"ab2\" aria-controls=\"ap2\" aria-selected=\"false\" tabindex=\"-1\">Vision</button>\n <button class=\"tab\" role=\"tab\" id=\"ab3\" aria-controls=\"ap3\" aria-selected=\"false\" tabindex=\"-1\">Core Values</button>\n </div>\n <div class=\"tabpanel is-active mx-auto max-w-3xl text-center\" role=\"tabpanel\" id=\"ap1\" aria-labelledby=\"ab1\"><p class=\"t-lead\">To provide an inclusive, joyful and rigorous education that empowers every student to become a confident, compassionate and capable citizen.</p></div>\n <div class=\"tabpanel mx-auto max-w-3xl text-center\" role=\"tabpanel\" id=\"ap2\" aria-labelledby=\"ab2\"><p class=\"t-lead\">To be a centre of learning excellence where tradition meets innovation and every child discovers their fullest potential.</p></div>\n <div class=\"tabpanel mx-auto max-w-3xl text-center\" role=\"tabpanel\" id=\"ap3\" aria-labelledby=\"ab3\"><p class=\"t-lead\">Integrity, curiosity, respect, resilience and community &mdash; the values woven into everything we teach and do.</p></div>\n </div>\n </div>\n</section>\n\n<!-- LEADERSHIP CARDS -->\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Leadership</span><h2 class=\"t-h2\">Guided By Experienced Leaders</h2></div>\n <div class=\"grid gap-6 md:grid-cols-2 lg:grid-cols-3\" data-reveal-stagger=\"100\">\n <a href=\"president-desk.html\" class=\"card card-hover card-body flex items-center gap-4\" data-reveal><img src=\"assets/images/placeholders/avatar.svg\" alt=\"President\" class=\"h-20 w-20 rounded-full object-cover\" loading=\"lazy\" decoding=\"async\" /><div><h3 class=\"t-h4\">Dr. R. Krishnan</h3><p class=\"t-small text-primary mb-1\">President</p><span class=\"btn-link text-sm\">Read message →</span></div></a>\n <a href=\"principal-desk.html\" class=\"card card-hover card-body flex items-center gap-4\" data-reveal><img src=\"assets/images/placeholders/avatar.svg\" alt=\"Principal\" class=\"h-20 w-20 rounded-full object-cover\" loading=\"lazy\" decoding=\"async\" /><div><h3 class=\"t-h4\">Mrs. Latha Menon</h3><p class=\"t-small text-primary mb-1\">Principal</p><span class=\"btn-link text-sm\">Read message →</span></div></a>\n <div class=\"card card-body bg-grad-primary text-white flex flex-col justify-center\" data-reveal><h3 class=\"t-h4 !text-white mb-2\">Want to visit us?</h3><p class=\"text-white/85 mb-4 text-sm\">Book a guided campus tour with our team.</p><a href=\"contact.html\" class=\"btn-accent btn-sm self-start\">Schedule a visit</a></div>\n </div>\n </div>\n</section>\n\n<!-- WHY CHOOSE + IMAGE -->\n<section class=\"section section-soft\">\n <div class=\"container-edu grid items-center gap-12 lg:grid-cols-2\">\n <div data-reveal=\"right\">\n <span class=\"eyebrow\">Why families choose us</span>\n <h2 class=\"t-h2 mt-3 mb-5\">The Next Level Of School Education</h2>\n <p class=\"t-body mb-6\">We go beyond textbooks with experiential learning, technology-enabled classrooms and a caring pastoral system that supports every learner.</p>\n <div class=\"grid gap-4 sm:grid-cols-2\">\n <div class=\"card card-body\"><span class=\"feature-icon mb-3\"></span><h3 class=\"t-h4 mb-1\">Skill Development</h3><p class=\"t-small\">Future-ready skills built into daily learning.</p></div>\n <div class=\"card card-body\"><span class=\"feature-icon mb-3\"></span><h3 class=\"t-h4 mb-1\">Real Guidance</h3><p class=\"t-small\">Mentorship and counselling for every student.</p></div>\n </div>\n </div>\n <div class=\"relative overflow-hidden rounded-xl shadow-card\" data-reveal=\"left\">\n <img src=\"assets/images/placeholders/landscape.svg\" alt=\"School campus\" class=\"h-full w-full object-cover\" loading=\"lazy\" decoding=\"async\" />\n <div class=\"absolute inset-0 flex items-end bg-gradient-to-t from-ink/70 to-transparent p-8\">\n <div class=\"text-white\"><p class=\"font-bold text-xl mb-1\">Find a path that suits your child</p><a href=\"programs.html\" class=\"btn-accent btn-sm mt-2\">Explore programs</a></div>\n </div>\n </div>\n </div>\n</section>','About Us','Learn about Channawar\'s e Vidya Mandir — our mission, vision, values and three decades of educational excellence.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('4','president-desk','President\'s Desk',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>President\'s Desk</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"about.html\">About</a><span class=\"sep\">&raquo;</span><span class=\"current\">President\'s Desk</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu grid items-start gap-12 lg:grid-cols-[380px_1fr]\">\n <aside class=\"lg:sticky lg:top-28\" data-reveal=\"right\">\n <div class=\"overflow-hidden rounded-xl shadow-card\">\n <img src=\"assets/images/placeholders/landscape.svg\" alt=\"President\" class=\"w-full object-cover\" loading=\"lazy\" decoding=\"async\" />\n </div>\n <div class=\"mt-5 rounded-lg bg-surface-soft p-6 text-center\">\n <h2 class=\"t-h4\">Dr. R. Krishnan</h2>\n <p class=\"text-primary font-medium\">President &amp; Chairman</p>\n <div class=\"footer-social mt-4 justify-center [&_a]:bg-primary/10 [&_a]:text-primary\"><a href=\"#\">f</a><a href=\"#\">in</a><a href=\"#\">x</a></div>\n </div>\n </aside>\n\n <div class=\"prose-edu\" data-reveal=\"left\">\n <span class=\"eyebrow\">Message from the President</span>\n <h2 class=\"t-h2 mt-3\">Building Character, One Child At A Time</h2>\n <p class=\"t-lead\">Dear parents and well-wishers, welcome to Channawar\'s e Vidya Mandir — a school built on the belief that education is the most powerful gift we can give a child.</p>\n <p>When we opened our doors in 1990, we set out to create more than an institution of academics. We wanted a home for values, a playground for ideas, and a launchpad for dreams. Three decades on, that mission continues to guide every decision we make.</p>\n <p>We remain deeply committed to nurturing not just successful students, but good human beings — curious, kind and courageous. I invite you to be part of our growing family.</p>\n <ul>\n <li>A legacy of academic and co-curricular excellence</li>\n <li>Investment in modern infrastructure and teacher training</li>\n <li>A values-first approach to every child&rsquo;s growth</li>\n </ul>\n <div class=\"mt-8 flex items-center gap-4\">\n <img src=\"assets/images/placeholders/landscape.svg\" alt=\"Signature\" class=\"h-14 w-auto\" loading=\"lazy\" decoding=\"async\" />\n <div><p class=\"font-bold text-ink\">Dr. R. Krishnan</p><p class=\"t-small\">President, Channawar\'s e Vidya Mandir</p></div>\n </div>\n <a href=\"admissions.html\" class=\"btn-primary mt-8\">Join our family</a>\n </div>\n </div>\n</section>','President\'s Desk','A message from the President of Channawar\'s e Vidya Mandir on our vision and commitment to education.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('5','principal-desk','Principal\'s Desk',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n  <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\"  decoding=\"async\" />\n  <span class=\"hero-banner__overlay\"></span>\n  <div class=\"container-edu hero-banner__content\">\n    <h1 class=\"hero-banner__title\" data-reveal>Principal\'s Desk</h1>\n    <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"about.html\">About</a><span class=\"sep\">&raquo;</span><span class=\"current\">Principal\'s Desk</span></nav>\n  </div>\n  <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n  <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n  <div class=\"container-edu grid items-start gap-12 lg:grid-cols-[380px_1fr]\">\n    <aside class=\"lg:sticky lg:top-28\" data-reveal=\"right\">\n      <div class=\"overflow-hidden rounded-xl shadow-card\">\n        <img src=\"assets/images/placeholders/landscape.svg\" alt=\"Principal\" class=\"w-full object-cover\" loading=\"lazy\"  decoding=\"async\" />\n      </div>\n      <div class=\"mt-5 rounded-lg bg-surface-soft p-6 text-center\">\n        <h2 class=\"t-h4\">Mrs. Latha Menon</h2>\n        <p class=\"text-primary font-medium\">Principal</p>\n        <div class=\"footer-social mt-4 justify-center [&_a]:bg-primary/10 [&_a]:text-primary\"><a href=\"#\">f</a><a href=\"#\">in</a><a href=\"#\">x</a></div>\n      </div>\n    </aside>\n\n    <div class=\"prose-edu\" data-reveal=\"left\">\n      <span class=\"eyebrow\">Message from the Principal</span>\n      <h2 class=\"t-h2 mt-3\">Where Every Child Is Seen, Heard &amp; Valued</h2>\n      <p class=\"t-lead\">A warm welcome to our school. As Principal, my greatest joy is watching students walk in curious and leave confident, capable and kind.</p>\n      <p>Our classrooms are lively spaces where questions are welcomed and mistakes are treated as stepping stones. We balance strong academics with sports, arts, and social-emotional learning so that children grow in every dimension.</p>\n      <p>Our teachers are mentors first. They know each student personally and work closely with families to support learning at every step. Together, we create an environment where children feel safe to try, to fail, and to flourish.</p>\n      <ul>\n        <li>Small class sizes and personal attention</li>\n        <li>Continuous, stress-free assessment</li>\n        <li>Strong home-school partnership</li>\n      </ul>\n      <div class=\"mt-8 flex items-center gap-4\">\n        <img src=\"assets/images/placeholders/landscape.svg\" alt=\"Signature\" class=\"h-14 w-auto\" loading=\"lazy\"  decoding=\"async\" />\n        <div><p class=\"font-bold text-ink\">Mrs. Latha Menon</p><p class=\"t-small\">Principal, Channawar\'s e Vidya Mandir</p></div>\n      </div>\n      <a href=\"contact.html\" class=\"btn-primary mt-8\">Talk to us</a>\n    </div>\n  </div>\n</section>','Principal\'s Desk','A message from the Principal of Channawar\'s e Vidya Mandir on academics, care and student life.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('6','programs','Programs',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Academic Programs</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"programs.html\">Academics</a><span class=\"sep\">&raquo;</span><span class=\"current\">Programs</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Learning journey</span><h2 class=\"t-h2\">Programs For Every Stage</h2><p class=\"t-body\">A carefully designed progression that grows with your child.</p></div>\n <div class=\"grid gap-6 sm:grid-cols-2 lg:grid-cols-3\" data-reveal-stagger=\"90\">\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Pre-primary\" loading=\"lazy\" decoding=\"async\" /><span class=\"card-badge badge-accent\">Ages 3–5</span></div><div class=\"card-body\"><h3 class=\"t-h4 mb-2\">Pre-Primary</h3><p class=\"t-small mb-4\">A play-based, sensory-rich start that builds curiosity, motor skills and social confidence.</p><a href=\"curriculum.html\" class=\"btn-link\">View curriculum →</a></div></article>\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Primary\" loading=\"lazy\" decoding=\"async\" /><span class=\"card-badge badge-accent\">Grades 1–5</span></div><div class=\"card-body\"><h3 class=\"t-h4 mb-2\">Primary School</h3><p class=\"t-small mb-4\">Foundational literacy and numeracy with hands-on, activity-led learning.</p><a href=\"curriculum.html\" class=\"btn-link\">View curriculum →</a></div></article>\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Middle\" loading=\"lazy\" decoding=\"async\" /><span class=\"card-badge badge-accent\">Grades 6–8</span></div><div class=\"card-body\"><h3 class=\"t-h4 mb-2\">Middle School</h3><p class=\"t-small mb-4\">Concept-first exploration across sciences, humanities and the arts.</p><a href=\"curriculum.html\" class=\"btn-link\">View curriculum →</a></div></article>\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Secondary\" loading=\"lazy\" decoding=\"async\" /><span class=\"card-badge badge-accent\">Grades 9–10</span></div><div class=\"card-body\"><h3 class=\"t-h4 mb-2\">Secondary School</h3><p class=\"t-small mb-4\">Rigorous board preparation with mentoring and career guidance.</p><a href=\"curriculum.html\" class=\"btn-link\">View curriculum →</a></div></article>\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Senior\" loading=\"lazy\" decoding=\"async\" /><span class=\"card-badge badge-accent\">Grades 9–10</span></div><div class=\"card-body\"><h3 class=\"t-h4 mb-2\">Secondary</h3><p class=\"t-small mb-4\">Science, Commerce and Humanities streams with expert faculty.</p><a href=\"curriculum.html\" class=\"btn-link\">View curriculum →</a></div></article>\n <article class=\"card card-hover card-blog\" data-reveal><div class=\"card-image\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Co-curricular\" loading=\"lazy\" decoding=\"async\" /><span class=\"card-badge badge-accent\">All grades</span></div><div class=\"card-body\"><h3 class=\"t-h4 mb-2\">Co-Curricular</h3><p class=\"t-small mb-4\">Sports, music, coding, robotics and 30+ clubs.</p><a href=\"curriculum.html\" class=\"btn-link\">View curriculum →</a></div></article>\n </div>\n </div>\n</section>\n\n<section class=\"section section-soft\">\n <div class=\"container-edu\">\n <div class=\"cta-band\">\n <h2 class=\"t-h2 !text-white\">Not Sure Which Program Fits?</h2>\n <p class=\"mt-3 text-white/85\">Our admissions team will help you find the right stage for your child.</p>\n <div class=\"mt-6 flex justify-center gap-4\"><a href=\"admissions.html\" class=\"btn-accent\">Apply now</a><a href=\"contact.html\" class=\"btn-outline border-white text-white hover:bg-white hover:text-primary\">Ask a question</a></div>\n </div>\n </div>\n</section>','Programs','Explore academic programs at Channawar\'s e Vidya Mandir from pre-primary to senior school.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('7','admissions','Admissions',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Admissions</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><span class=\"current\">Admissions</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<!-- PROCESS -->\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">How to apply</span><h2 class=\"t-h2\">A Simple 4-Step Admission Process</h2></div>\n <div class=\"steps\" data-reveal-stagger=\"100\">\n <div class=\"step\" data-reveal><span class=\"step-number\">1</span><h3 class=\"t-h4 mb-2\">Enquire</h3><p class=\"t-small\">Submit the enquiry form or visit our campus.</p></div>\n <div class=\"step\" data-reveal><span class=\"step-number\">2</span><h3 class=\"t-h4 mb-2\">Apply</h3><p class=\"t-small\">Complete the application with required documents.</p></div>\n <div class=\"step\" data-reveal><span class=\"step-number\">3</span><h3 class=\"t-h4 mb-2\">Interaction</h3><p class=\"t-small\">A friendly interaction with the child and parents.</p></div>\n <div class=\"step\" data-reveal><span class=\"step-number\">4</span><h3 class=\"t-h4 mb-2\">Confirm</h3><p class=\"t-small\">Receive your offer and complete enrolment.</p></div>\n </div>\n </div>\n</section>\n\n<!-- FORM + REQUIREMENTS -->\n<section class=\"section section-soft\">\n <div class=\"container-edu grid items-start gap-12 lg:grid-cols-2\">\n <div data-reveal=\"right\">\n <span class=\"eyebrow\">Requirements</span>\n <h2 class=\"t-h2 mt-3 mb-5\">What You&rsquo;ll Need</h2>\n <ul class=\"feature-list mb-8\">\n <li>Completed application form</li>\n <li>Birth certificate (copy)</li>\n <li>Previous school report card / transfer certificate</li>\n <li>Passport-size photographs</li>\n <li>Address and ID proof of parents</li>\n </ul>\n <div class=\"card card-body flex items-center justify-between gap-4\">\n <div><p class=\"font-semibold text-ink\">Fee structure 2026-27</p><p class=\"t-small\">Transparent, all-inclusive fees.</p></div>\n <a href=\"fees-structure.html\" class=\"btn-outline btn-sm\">View fees</a>\n </div>\n </div>\n\n <div class=\"card card-body !p-8\" data-reveal=\"left\">\n <h3 class=\"t-h3 mb-6\">Admission Enquiry</h3>\n <form class=\"flex flex-col gap-5\" novalidate>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"a-child\">Child&rsquo;s Name <span class=\"req\">*</span></label><input class=\"input\" id=\"a-child\" required placeholder=\"Full name\" /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"a-grade\">Grade Applying For</label><select class=\"select\" id=\"a-grade\"><option>Pre-Primary</option><option>Primary (1–5)</option><option>Middle (6–8)</option><option>Secondary (9–10)</option><option>Senior (9–10)</option></select></div>\n </div>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"a-parent\">Parent&rsquo;s Name <span class=\"req\">*</span></label><input class=\"input\" id=\"a-parent\" required placeholder=\"Full name\" /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"a-phone\">Phone <span class=\"req\">*</span></label><input class=\"input\" id=\"a-phone\" type=\"tel\" required placeholder=\"+91\" /></div>\n </div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"a-email\">Email</label><input class=\"input\" id=\"a-email\" type=\"email\" placeholder=\"you@example.com\" /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"a-msg\">Message</label><textarea class=\"textarea\" id=\"a-msg\" placeholder=\"Anything you\'d like us to know\"></textarea></div>\n <label class=\"checkbox\"><input type=\"checkbox\" required /> I agree to be contacted by the school regarding this enquiry.</label>\n <button class=\"btn-primary btn-block\" type=\"submit\">Submit Enquiry</button>\n </form>\n </div>\n </div>\n</section>\n\n<!-- FAQ -->\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Good to know</span><h2 class=\"t-h2\">Admission FAQs</h2></div>\n <div class=\"accordion mx-auto max-w-3xl\" data-accordion data-single>\n <div class=\"accordion-item is-open\"><button class=\"accordion-trigger\" aria-expanded=\"true\" aria-controls=\"fq1\">When does admission open? <span class=\"accordion-icon\">+</span></button><div class=\"accordion-panel\" id=\"fq1\" role=\"region\"><div><div class=\"accordion-content\">Admissions for the 2026-27 session are currently open. Early applications are encouraged as seats are limited.</div></div></div></div>\n <div class=\"accordion-item\"><button class=\"accordion-trigger\" aria-expanded=\"false\" aria-controls=\"fq2\">Is there an entrance test? <span class=\"accordion-icon\">+</span></button><div class=\"accordion-panel\" id=\"fq2\" role=\"region\"><div><div class=\"accordion-content\">For most grades we hold a friendly interaction rather than a formal test. Senior grades may include a short assessment.</div></div></div></div>\n <div class=\"accordion-item\"><button class=\"accordion-trigger\" aria-expanded=\"false\" aria-controls=\"fq3\">Can I visit the campus first? <span class=\"accordion-icon\">+</span></button><div class=\"accordion-panel\" id=\"fq3\" role=\"region\"><div><div class=\"accordion-content\">Absolutely. Book a guided campus tour through our contact page and our team will host you.</div></div></div></div>\n </div>\n </div>\n</section>','Admissions','Admission process, eligibility and enquiry form for Channawar\'s e Vidya Mandir, 2026-27 session.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('8','curriculum','Curriculum & Documents','Curriculum & Documents',NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Curriculum</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"programs.html\">Academics</a><span class=\"sep\">&raquo;</span><span class=\"current\">Curriculum</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Academic framework</span><h2 class=\"t-h2\">A Balanced, Future-Ready Curriculum</h2><p class=\"t-body\">Concept-driven learning that blends knowledge, skills and values at every stage.</p></div>\n\n <div class=\"tabs\" data-tabs>\n <div class=\"tablist mx-auto\" role=\"tablist\" aria-label=\"Curriculum stages\">\n <button class=\"tab\" role=\"tab\" id=\"cu1\" aria-controls=\"cup1\" aria-selected=\"true\">Pre-Primary</button>\n <button class=\"tab\" role=\"tab\" id=\"cu2\" aria-controls=\"cup2\" aria-selected=\"false\" tabindex=\"-1\">Primary</button>\n <button class=\"tab\" role=\"tab\" id=\"cu3\" aria-controls=\"cup3\" aria-selected=\"false\" tabindex=\"-1\">Middle</button>\n <button class=\"tab\" role=\"tab\" id=\"cu4\" aria-controls=\"cup4\" aria-selected=\"false\" tabindex=\"-1\">Senior</button>\n </div>\n\n <div class=\"tabpanel is-active\" role=\"tabpanel\" id=\"cup1\" aria-labelledby=\"cu1\">\n <div class=\"grid gap-6 lg:grid-cols-2 items-center\">\n <div class=\"img-zoom overflow-hidden rounded-xl shadow-card\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Pre-primary learning\" loading=\"lazy\" class=\"w-full object-cover\" decoding=\"async\" /></div>\n <div><h3 class=\"t-h3 mb-3\">Early Years Foundation</h3><p class=\"t-body mb-4\">Learning through play, stories and exploration to build language, motor skills and social confidence.</p><ul class=\"feature-list\"><li>Phonics &amp; early literacy</li><li>Numeracy through play</li><li>Art, music and movement</li><li>Social-emotional learning</li></ul></div>\n </div>\n </div>\n <div class=\"tabpanel\" role=\"tabpanel\" id=\"cup2\" aria-labelledby=\"cu2\">\n <div class=\"grid gap-6 lg:grid-cols-2 items-center\">\n <div class=\"img-zoom overflow-hidden rounded-xl shadow-card\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Primary learning\" loading=\"lazy\" class=\"w-full object-cover\" decoding=\"async\" /></div>\n <div><h3 class=\"t-h3 mb-3\">Primary (Grades 1–5)</h3><p class=\"t-body mb-4\">Strong foundations with hands-on, activity-led classrooms.</p><ul class=\"feature-list\"><li>English, Hindi &amp; regional language</li><li>Mathematics &amp; Environmental Studies</li><li>Computer literacy</li><li>Sports &amp; visual arts</li></ul></div>\n </div>\n </div>\n <div class=\"tabpanel\" role=\"tabpanel\" id=\"cup3\" aria-labelledby=\"cu3\">\n <div class=\"grid gap-6 lg:grid-cols-2 items-center\">\n <div class=\"img-zoom overflow-hidden rounded-xl shadow-card\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Middle learning\" loading=\"lazy\" class=\"w-full object-cover\" decoding=\"async\" /></div>\n <div><h3 class=\"t-h3 mb-3\">Middle (Grades 6–8)</h3><p class=\"t-body mb-4\">Deeper inquiry across the sciences, humanities and languages.</p><ul class=\"feature-list\"><li>Sciences &amp; Social Sciences</li><li>Mathematics &amp; coding</li><li>Second &amp; third languages</li><li>Robotics &amp; project work</li></ul></div>\n </div>\n </div>\n <div class=\"tabpanel\" role=\"tabpanel\" id=\"cup4\" aria-labelledby=\"cu4\">\n <div class=\"grid gap-6 lg:grid-cols-2 items-center\">\n <div class=\"img-zoom overflow-hidden rounded-xl shadow-card\"><img src=\"assets/images/placeholders/landscape.svg\" alt=\"Senior learning\" loading=\"lazy\" class=\"w-full object-cover\" decoding=\"async\" /></div>\n <div><h3 class=\"t-h3 mb-3\">Senior (Grades 9–10)</h3><p class=\"t-body mb-4\">Board-focused academics with career guidance and stream specialisation.</p><ul class=\"feature-list\"><li>Science, Commerce &amp; Humanities streams</li><li>Career counselling &amp; mentoring</li><li>Competitive-exam readiness</li><li>Internships &amp; leadership</li></ul></div>\n </div>\n </div>\n </div>\n </div>\n</section>','Curriculum','Access all official school documents, CBSE records, curriculum information, certificates, reports and important downloads.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('9','academic-calendar','Academic Calendar','Academic Calendar',NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n  <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\"  decoding=\"async\" />\n  <span class=\"hero-banner__overlay\"></span>\n  <div class=\"container-edu hero-banner__content\">\n    <h1 class=\"hero-banner__title\" data-reveal>Academic Calendar</h1>\n    <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"programs.html\">Academics</a><span class=\"sep\">&raquo;</span><span class=\"current\">Academic Calendar</span></nav>\n  </div>\n  <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n  <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n  <div class=\"container-edu grid gap-12 lg:grid-cols-[1fr_360px]\">\n    <div>\n      <div class=\"section-head section-head--left\"><span class=\"eyebrow\">Session 2026-27</span><h2 class=\"t-h2\">Key Dates &amp; Events</h2></div>\n      <div class=\"timeline\" data-reveal-stagger=\"90\">\n        <div class=\"timeline-item\" data-reveal><p class=\"timeline-date\">June 2026</p><h3 class=\"timeline-title\">Term 1 Begins</h3><p class=\"t-small\">New session commences with orientation week for all grades.</p></div>\n        <div class=\"timeline-item\" data-reveal><p class=\"timeline-date\">August 2026</p><h3 class=\"timeline-title\">Independence Day &amp; Cultural Week</h3><p class=\"t-small\">Flag hoisting, performances and inter-house events.</p></div>\n        <div class=\"timeline-item\" data-reveal><p class=\"timeline-date\">October 2026</p><h3 class=\"timeline-title\">Term 1 Assessments</h3><p class=\"t-small\">Continuous assessment and parent-teacher meetings.</p></div>\n        <div class=\"timeline-item\" data-reveal><p class=\"timeline-date\">December 2026</p><h3 class=\"timeline-title\">Annual Day &amp; Winter Break</h3><p class=\"t-small\">Annual Day celebrations followed by the winter vacation.</p></div>\n        <div class=\"timeline-item\" data-reveal><p class=\"timeline-date\">February 2027</p><h3 class=\"timeline-title\">Sports Meet</h3><p class=\"t-small\">Annual athletics meet and inter-school tournaments.</p></div>\n        <div class=\"timeline-item\" data-reveal><p class=\"timeline-date\">March 2027</p><h3 class=\"timeline-title\">Final Examinations &amp; Results</h3><p class=\"t-small\">Year-end examinations and promotion to the next grade.</p></div>\n      </div>\n    </div>\n\n    <aside class=\"flex flex-col gap-6\">\n      <div class=\"card card-body\" data-reveal=\"left\"><h3 class=\"t-h4 mb-4\">At a glance</h3><ul class=\"feature-list text-sm\"><li>3 academic terms</li><li>Parent-teacher meetings each term</li><li>2 major cultural events</li><li>Annual sports meet</li></ul></div>\n      <div class=\"card card-body bg-grad-primary text-white\" data-reveal=\"left\"><h3 class=\"t-h4 !text-white mb-2\">Download calendar</h3><p class=\"text-white/85 text-sm mb-4\">Get the full-year PDF with all holidays and events.</p><a href=\"downloads.html\" class=\"btn-accent btn-sm\">Go to downloads</a></div>\n    </aside>\n  </div>\n</section>','Academic Calendar','Stay informed about the academic year with our official school calendar. Browse each months schedule, holidays, examinations and important academic activities.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('10','fees-structure','Fees Structure',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Fees Structure</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"programs.html\">Academics</a><span class=\"sep\">&raquo;</span><span class=\"current\">Fees Structure</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Transparent pricing</span><h2 class=\"t-h2\">Annual Fee Structure 2026-27</h2><p class=\"t-body\">All-inclusive fees with no hidden charges. Payable in three termly instalments.</p></div>\n\n <div class=\"overflow-x-auto rounded-lg border border-border\" data-reveal>\n <table class=\"w-full min-w-[640px] text-left\">\n <thead class=\"bg-surface-soft text-ink\">\n <tr class=\"[&>th]:px-6 [&>th]:py-4 [&>th]:font-semibold\">\n <th>Grade / Stage</th><th>Admission (one-time)</th><th>Tuition (annual)</th><th>Total (annual)</th>\n </tr>\n </thead>\n <tbody class=\"[&>tr]:border-t [&>tr]:border-border [&_td]:px-6 [&_td]:py-4 text-muted\">\n <tr><td class=\"!text-ink font-medium\">Pre-Primary</td><td>&#8377; 15,000</td><td>&#8377; 48,000</td><td class=\"!text-primary font-semibold\">&#8377; 63,000</td></tr>\n <tr class=\"bg-surface-soft/50\"><td class=\"!text-ink font-medium\">Primary (1–5)</td><td>&#8377; 18,000</td><td>&#8377; 56,000</td><td class=\"!text-primary font-semibold\">&#8377; 74,000</td></tr>\n <tr><td class=\"!text-ink font-medium\">Middle (6–8)</td><td>&#8377; 20,000</td><td>&#8377; 64,000</td><td class=\"!text-primary font-semibold\">&#8377; 84,000</td></tr>\n <tr class=\"bg-surface-soft/50\"><td class=\"!text-ink font-medium\">Secondary (9–10)</td><td>&#8377; 22,000</td><td>&#8377; 72,000</td><td class=\"!text-primary font-semibold\">&#8377; 94,000</td></tr>\n <tr><td class=\"!text-ink font-medium\">Senior (9–10)</td><td>&#8377; 25,000</td><td>&#8377; 84,000</td><td class=\"!text-primary font-semibold\">&#8377; 1,09,000</td></tr>\n </tbody>\n </table>\n </div>\n <p class=\"t-small mt-4\">* Fees are indicative. Transport, meals and optional activities are billed separately. Please contact the office for the latest schedule.</p>\n </div>\n</section>\n\n<section class=\"section section-soft\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Included in fees</span><h2 class=\"t-h2\">What Your Fees Cover</h2></div>\n <div class=\"grid gap-6 md:grid-cols-3\" data-reveal-stagger=\"100\">\n <div class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Academics</h3><p class=\"t-small\">Tuition, learning materials, labs and library access.</p></div>\n <div class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Activities</h3><p class=\"t-small\">Sports, arts, clubs and most co-curricular programs.</p></div>\n <div class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Technology</h3><p class=\"t-small\">Smart classrooms and digital learning platforms.</p></div>\n </div>\n <div class=\"mt-12 text-center\"><a href=\"admissions.html\" class=\"btn-primary\">Proceed to admission</a></div>\n </div>\n</section>','Fees Structure','Transparent, all-inclusive fee structure for the 2026-27 academic year at Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('11','notices','Notices & Circulars','Notices & Circulars',NULL,'','Notices & Circulars','Latest notices, circulars and announcements from Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('12','gallery','Gallery','Gallery',NULL,'','Gallery','Explore photos from campus life at Channawar\'s e Vidya Mandir — events, classrooms, sports and celebrations.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('13','downloads','Downloads','Downloads',NULL,'','Downloads','Download forms, prospectus, calendar and circulars from Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('14','reviews','Reviews','Reviews',NULL,'','Reviews','What parents, students and alumni say about Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('15','contact','Contact Us',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Contact Us</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><span class=\"current\">Contact Us</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu grid items-start gap-12 lg:grid-cols-2\">\n <!-- Info card -->\n <div class=\"overflow-hidden rounded-xl shadow-card\" data-reveal=\"right\">\n <div class=\"bg-grad-primary p-8 text-white sm:p-10\">\n <div class=\"flex flex-col gap-7\">\n <div class=\"flex items-center gap-4\">\n <span class=\"icon-circle h-14 w-14 bg-white/15 text-xl\"></span>\n <div><p class=\"text-white/70 text-sm\">Call Us 7/24</p><p class=\"text-xl font-semibold\">+91 8551061975</p></div>\n </div>\n <div class=\"divider !bg-white/15\"></div>\n <div class=\"flex items-center gap-4\">\n <span class=\"icon-circle h-14 w-14 bg-white/15 text-xl\"></span>\n <div><p class=\"text-white/70 text-sm\">Write to us</p><p class=\"text-xl font-semibold\">cevidyamandir@gmail.com</p></div>\n </div>\n <div class=\"divider !bg-white/15\"></div>\n <div class=\"flex items-center gap-4\">\n <span class=\"icon-circle h-14 w-14 bg-white/15 text-xl\"></span>\n <div><p class=\"text-white/70 text-sm\">Location</p><p class=\"text-xl font-semibold\">Varco World, Wardha</p></div>\n </div>\n </div>\n </div>\n <div class=\"relative\">\n <img src=\"assets/images/placeholders/landscape.svg\" alt=\"Students learning\" class=\"h-64 w-full object-cover\" loading=\"lazy\" decoding=\"async\" />\n <button class=\"play-btn absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2\" data-modal-open=\"#videoModal\" data-video=\"https://www.youtube.com/embed/ScMzIvxBSi4\" aria-label=\"Play video\">\n <svg width=\"18\" height=\"18\" viewBox=\"0 0 24 24\" fill=\"currentColor\" aria-hidden=\"true\"><path d=\"M8 5v14l11-7z\"/></svg>\n </button>\n </div>\n </div>\n\n <!-- Form -->\n <div data-reveal=\"left\">\n <span class=\"eyebrow\">Get in touch</span>\n <h2 class=\"t-h2 mt-3 mb-3\">Ready to Get Started?</h2>\n <p class=\"t-body mb-8\">Have a question about admissions, curriculum or a campus visit? Send us a message and our team will get back to you shortly.</p>\n <form class=\"flex flex-col gap-5\" novalidate>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"c-name\">Your Name <span class=\"req\">*</span></label><input class=\"input\" id=\"c-name\" name=\"name\" placeholder=\"Your name\" required /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"c-email\">Your Email <span class=\"req\">*</span></label><input class=\"input\" id=\"c-email\" name=\"email\" type=\"email\" placeholder=\"you@example.com\" required /></div>\n </div>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"c-phone\">Phone</label><input class=\"input\" id=\"c-phone\" name=\"phone\" type=\"tel\" placeholder=\"+91\" /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"c-subject\">Subject</label><select class=\"select\" id=\"c-subject\" name=\"subject\"><option>Admission enquiry</option><option>Campus visit</option><option>General question</option></select></div>\n </div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"c-msg\">Your Message <span class=\"req\">*</span></label><textarea class=\"textarea\" id=\"c-msg\" name=\"message\" placeholder=\"How can we help?\" required></textarea></div>\n <button class=\"btn-primary self-start\" type=\"submit\">Send Message\n <svg width=\"18\" height=\"18\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><path d=\"M5 12h14m-6-6 6 6-6 6\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg>\n </button>\n </form>\n </div>\n </div>\n</section>\n\n<!-- MAP -->\n<section class=\"section !pt-0\">\n <div class=\"container-edu\">\n <div class=\"overflow-hidden rounded-xl shadow-card\" data-reveal>\n <iframe title=\"School location map\" class=\"h-[420px] w-full\" style=\"border:0\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\" src=\"https://www.google.com/maps?q=Pune&output=embed\"></iframe>\n </div>\n </div>\n</section>','Contact Us','Get in touch with Channawar\'s e Vidya Mandir. Call, email or send us a message and our team will respond promptly.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('16','engage','Engage With Us',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Engage With Us</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"engage.html\">Get Involved</a><span class=\"sep\">&raquo;</span><span class=\"current\">Engage With Us</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Be part of it</span><h2 class=\"t-h2\">Ways To Engage With Our School</h2><p class=\"t-body\">Our community thrives when families, alumni and neighbours get involved.</p></div>\n <div class=\"grid gap-6 md:grid-cols-2 lg:grid-cols-3\" data-reveal-stagger=\"90\">\n <article class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Parent Community</h3><p class=\"t-small mb-4\">Join the PTA, volunteer for events and shape school life.</p><a href=\"#\" class=\"btn-link\">Get started →</a></article>\n <article class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Alumni Network</h3><p class=\"t-small mb-4\">Reconnect, mentor students and give back.</p><a href=\"#\" class=\"btn-link\">Join alumni →</a></article>\n <article class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Guest Talks</h3><p class=\"t-small mb-4\">Share your expertise with our students.</p><a href=\"careers.html\" class=\"btn-link\">Volunteer →</a></article>\n <article class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Partnerships</h3><p class=\"t-small mb-4\">Collaborate on programs and community projects.</p><a href=\"contact.html\" class=\"btn-link\">Partner with us →</a></article>\n <article class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Support Us</h3><p class=\"t-small mb-4\">Contribute to scholarships and infrastructure.</p><a href=\"support-us.html\" class=\"btn-link\">Donate →</a></article>\n <article class=\"card-feature\" data-reveal><span class=\"feature-icon\"></span><h3 class=\"t-h4 mb-2\">Careers</h3><p class=\"t-small mb-4\">Build your career with a school that cares.</p><a href=\"careers.html\" class=\"btn-link\">View roles →</a></article>\n </div>\n </div>\n</section>\n\n<section class=\"section section-soft\">\n <div class=\"container-edu\">\n <div class=\"cta-band\">\n <h2 class=\"t-h2 !text-white\">Have An Idea To Collaborate?</h2>\n <p class=\"mt-3 text-white/85\">We&rsquo;d love to hear from parents, alumni and organisations.</p>\n <div class=\"mt-6 flex justify-center gap-4\"><a href=\"contact.html\" class=\"btn-accent\">Reach out</a></div>\n </div>\n </div>\n</section>','Engage With Us','Ways for parents, alumni and the community to engage with Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('17','careers','Career Opportunities',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Career Opportunities</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"engage.html\">Get Involved</a><span class=\"sep\">&raquo;</span><span class=\"current\">Career Opportunities</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu grid gap-12 lg:grid-cols-[1fr_360px]\">\n <div>\n <div class=\"section-head section-head--left\"><span class=\"eyebrow\">Join our team</span><h2 class=\"t-h2\">Current Openings</h2></div>\n <div class=\"flex flex-col gap-4\" data-reveal-stagger=\"80\">\n <div class=\"card card-body flex flex-wrap items-center justify-between gap-4\" data-reveal><div><span class=\"badge-soft mb-2\">Teaching · Full-time</span><h3 class=\"t-h4\">PGT — Physics (Senior School)</h3><p class=\"t-small\">Master&rsquo;s in Physics with B.Ed and 3+ years experience.</p></div><a href=\"#apply\" class=\"btn-primary btn-sm\">Apply</a></div>\n <div class=\"card card-body flex flex-wrap items-center justify-between gap-4\" data-reveal><div><span class=\"badge-soft mb-2\">Teaching · Full-time</span><h3 class=\"t-h4\">TGT — Mathematics (Middle School)</h3><p class=\"t-small\">Graduate in Mathematics with B.Ed and passion for teaching.</p></div><a href=\"#apply\" class=\"btn-primary btn-sm\">Apply</a></div>\n <div class=\"card card-body flex flex-wrap items-center justify-between gap-4\" data-reveal><div><span class=\"badge-soft mb-2\">Early Years · Full-time</span><h3 class=\"t-h4\">Pre-Primary Educator</h3><p class=\"t-small\">NTT/Montessori certification preferred.</p></div><a href=\"#apply\" class=\"btn-primary btn-sm\">Apply</a></div>\n <div class=\"card card-body flex flex-wrap items-center justify-between gap-4\" data-reveal><div><span class=\"badge-soft mb-2\">Administration</span><h3 class=\"t-h4\">Admissions Counsellor</h3><p class=\"t-small\">Excellent communication and organisation skills.</p></div><a href=\"#apply\" class=\"btn-primary btn-sm\">Apply</a></div>\n </div>\n\n <div id=\"apply\" class=\"card card-body !p-8 mt-10\" data-reveal>\n <h3 class=\"t-h3 mb-6\">Apply Now</h3>\n <form class=\"flex flex-col gap-5\" novalidate>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"j-name\">Full Name <span class=\"req\">*</span></label><input class=\"input\" id=\"j-name\" required /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"j-role\">Position</label><select class=\"select\" id=\"j-role\"><option>PGT — Physics</option><option>TGT — Mathematics</option><option>Pre-Primary Educator</option><option>Admissions Counsellor</option></select></div>\n </div>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"j-email\">Email <span class=\"req\">*</span></label><input class=\"input\" id=\"j-email\" type=\"email\" required /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"j-cv\">Upload CV</label><input class=\"input !py-2.5\" id=\"j-cv\" type=\"file\" /></div>\n </div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"j-msg\">Cover Note</label><textarea class=\"textarea\" id=\"j-msg\"></textarea></div>\n <button class=\"btn-primary self-start\" type=\"submit\">Submit Application</button>\n </form>\n </div>\n </div>\n\n <aside class=\"flex flex-col gap-6\">\n <div class=\"card card-body\" data-reveal=\"left\"><h3 class=\"t-h4 mb-3\">Why work with us</h3><ul class=\"feature-list text-sm\"><li>Supportive leadership</li><li>Professional development</li><li>Collaborative culture</li><li>Competitive benefits</li></ul></div>\n <div class=\"card card-body bg-grad-primary text-white\" data-reveal=\"left\"><h3 class=\"t-h4 !text-white mb-2\">Don&rsquo;t see a role?</h3><p class=\"text-white/85 text-sm mb-4\">Send us your résumé and we&rsquo;ll keep it on file.</p><a href=\"contact.html\" class=\"btn-accent btn-sm\">Contact HR</a></div>\n </aside>\n </div>\n</section>','Career Opportunities','Current job openings and career opportunities at Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('18','intern-volunteer','Intern & Volunteer',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Intern & Volunteer</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"engage.html\">Get Involved</a><span class=\"sep\">&raquo;</span><span class=\"current\">Intern & Volunteer</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"section-head\"><span class=\"eyebrow\">Give your time</span><h2 class=\"t-h2\">Intern &amp; Volunteer With Us</h2><p class=\"t-body\">Make a difference while gaining meaningful experience.</p></div>\n <div class=\"grid gap-6 md:grid-cols-3\" data-reveal-stagger=\"90\">\n <article class=\"card card-hover card-body\" data-reveal><span class=\"feature-icon mb-4\"></span><h3 class=\"t-h4 mb-2\">Teaching Interns</h3><p class=\"t-small\">Support classroom learning under mentor teachers.</p></article>\n <article class=\"card card-hover card-body\" data-reveal><span class=\"feature-icon mb-4\"></span><h3 class=\"t-h4 mb-2\">Activity Volunteers</h3><p class=\"t-small\">Help run arts, sports and cultural events.</p></article>\n <article class=\"card card-hover card-body\" data-reveal><span class=\"feature-icon mb-4\"></span><h3 class=\"t-h4 mb-2\">Skill Mentors</h3><p class=\"t-small\">Lead workshops in coding, music, public speaking and more.</p></article>\n </div>\n </div>\n</section>\n\n<section class=\"section section-soft\">\n <div class=\"container-edu grid items-start gap-12 lg:grid-cols-2\">\n <div data-reveal=\"right\">\n <span class=\"eyebrow\">The experience</span>\n <h2 class=\"t-h2 mt-3 mb-5\">What You&rsquo;ll Gain</h2>\n <ul class=\"feature-list\">\n <li>Hands-on experience in a school setting</li>\n <li>Mentorship from experienced educators</li>\n <li>A certificate of contribution</li>\n <li>The joy of shaping young lives</li>\n </ul>\n </div>\n <div class=\"card card-body !p-8\" data-reveal=\"left\">\n <h3 class=\"t-h3 mb-6\">Express Your Interest</h3>\n <form class=\"flex flex-col gap-5\" novalidate>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"v-name\">Name <span class=\"req\">*</span></label><input class=\"input\" id=\"v-name\" required /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"v-type\">I want to</label><select class=\"select\" id=\"v-type\"><option>Intern</option><option>Volunteer</option><option>Mentor</option></select></div>\n </div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"v-email\">Email <span class=\"req\">*</span></label><input class=\"input\" id=\"v-email\" type=\"email\" required /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"v-msg\">Tell us about yourself</label><textarea class=\"textarea\" id=\"v-msg\"></textarea></div>\n <button class=\"btn-primary btn-block\" type=\"submit\">Submit</button>\n </form>\n </div>\n </div>\n</section>','Intern & Volunteer','Internship and volunteering opportunities at Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('19','support-us','Support Us',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n  <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\"  decoding=\"async\" />\n  <span class=\"hero-banner__overlay\"></span>\n  <div class=\"container-edu hero-banner__content\">\n    <h1 class=\"hero-banner__title\" data-reveal>Support Us</h1>\n    <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"engage.html\">Get Involved</a><span class=\"sep\">&raquo;</span><span class=\"current\">Support Us</span></nav>\n  </div>\n  <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n  <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n  <div class=\"container-edu\">\n    <div class=\"section-head\"><span class=\"eyebrow\">Give back</span><h2 class=\"t-h2\">Your Support Changes Lives</h2><p class=\"t-body\">Every contribution helps us fund scholarships, facilities and opportunities for deserving students.</p></div>\n    <div class=\"grid gap-6 md:grid-cols-3\" data-reveal-stagger=\"100\">\n      <article class=\"card-price\" data-reveal><span class=\"badge-soft mb-4\">Friend</span><div class=\"t-h2 text-primary\">&#8377; 2,500</div><p class=\"t-small mb-6\">One-time gift</p><ul class=\"feature-list text-left text-sm mb-6\"><li>Support learning materials</li><li>Thank-you note</li></ul><a href=\"#give\" class=\"btn-outline btn-block\">Give</a></article>\n      <article class=\"card-price is-featured\" data-reveal><span class=\"badge-accent mb-4\">Patron</span><div class=\"t-h2 !text-white\">&#8377; 10,000</div><p class=\"text-white/80 mb-6\">One-time gift</p><ul class=\"feature-list text-left text-sm mb-6 [&_li]:text-white/90 [&_li::before]:bg-white/20 [&_li::before]:text-white\"><li>Fund a partial scholarship</li><li>Invitation to school events</li><li>Recognition on donor wall</li></ul><a href=\"#give\" class=\"btn-accent btn-block\">Give</a></article>\n      <article class=\"card-price\" data-reveal><span class=\"badge-soft mb-4\">Benefactor</span><div class=\"t-h2 text-primary\">&#8377; 50,000</div><p class=\"t-small mb-6\">One-time gift</p><ul class=\"feature-list text-left text-sm mb-6\"><li>Fund a full scholarship</li><li>Named recognition</li><li>Annual impact report</li></ul><a href=\"#give\" class=\"btn-outline btn-block\">Give</a></article>\n    </div>\n  </div>\n</section>\n\n<section class=\"section section-soft\" id=\"give\">\n  <div class=\"container-edu\">\n    <div class=\"mx-auto max-w-2xl text-center\" data-reveal>\n      <h2 class=\"t-h2 mb-4\">Make A Contribution</h2>\n      <p class=\"t-body mb-8\">For donations, endowments or CSR partnerships, please reach out to our development office.</p>\n      <a href=\"contact.html\" class=\"btn-primary\">Contact the office</a>\n    </div>\n  </div>\n</section>','Support Us','Support scholarships, infrastructure and programs at Channawar\'s e Vidya Mandir through giving.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('20','locate-us','Locate Us',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Locate Us</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"contact.html\">Contact</a><span class=\"sep\">&raquo;</span><span class=\"current\">Locate Us</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu\">\n <div class=\"grid gap-6 md:grid-cols-3\" data-reveal-stagger=\"90\">\n <div class=\"card-contact\" data-reveal><span class=\"contact-icon\"></span><div><p class=\"font-semibold text-ink mb-1\">Address</p><p class=\"t-small\">Varco World, Wardha, Maharashtra</p></div></div>\n <div class=\"card-contact\" data-reveal><span class=\"contact-icon\"></span><div><p class=\"font-semibold text-ink mb-1\">Phone</p><p class=\"t-small\">+91 8551061975<br />+91 8551061975</p></div></div>\n <div class=\"card-contact\" data-reveal><span class=\"contact-icon\"></span><div><p class=\"font-semibold text-ink mb-1\">Office Hours</p><p class=\"t-small\">MonSat: 8:00 AM — 4:00 PM</p></div></div>\n </div>\n </div>\n</section>\n\n<section class=\"section !pt-0\">\n <div class=\"container-edu grid items-center gap-12 lg:grid-cols-2\">\n <div class=\"overflow-hidden rounded-xl shadow-card\" data-reveal=\"right\">\n <iframe title=\"School location map\" class=\"h-[420px] w-full\" style=\"border:0\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\" src=\"https://www.google.com/maps?q=Kothrud,Pune&output=embed\"></iframe>\n </div>\n <div data-reveal=\"left\">\n <span class=\"eyebrow\">Getting here</span>\n <h2 class=\"t-h2 mt-3 mb-5\">How To Reach Us</h2>\n <ul class=\"feature-list mb-6\">\n <li>5 minutes from Kothrud bus depot</li>\n <li>Ample parking for visitors</li>\n <li>School bus routes across the city</li>\n <li>Wheelchair-accessible entrance</li>\n </ul>\n <a href=\"https://www.google.com/maps?q=Kothrud,Pune\" target=\"_blank\" rel=\"noopener\" class=\"btn-primary\">Open in Google Maps</a>\n </div>\n </div>\n</section>','Locate Us','Find directions, address and contact details for Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL),
('21','bonafide','Bona Fide Request',NULL,NULL,'<section class=\"hero-banner\" data-cms=\"banner\">\n <img class=\"hero-banner__bg\" src=\"assets/images/placeholders/banner.svg\" alt=\"\" fetchpriority=\"high\" decoding=\"async\" />\n <span class=\"hero-banner__overlay\"></span>\n <div class=\"container-edu hero-banner__content\">\n <h1 class=\"hero-banner__title\" data-reveal>Bona Fide Request</h1>\n <nav class=\"breadcrumb\" aria-label=\"Breadcrumb\" data-reveal><a href=\"index.html\">Home</a><span class=\"sep\">&raquo;</span><a href=\"contact.html\">Contact</a><span class=\"sep\">&raquo;</span><span class=\"current\">Bona Fide Request</span></nav>\n </div>\n <span class=\"hero-deco\"><svg width=\"70\" height=\"70\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"7\" cy=\"17\" r=\"3\" stroke=\"currentColor\" stroke-width=\"1.4\"/><path d=\"M11 13 20 4m0 0h-6m6 0v6\" stroke=\"currentColor\" stroke-width=\"1.4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/></svg></span>\n <div class=\"hero-wave\"><svg viewBox=\"0 0 1440 60\" preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\"><path fill=\"#ffffff\" d=\"M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z\"/></svg></div>\n</section>\n<section class=\"section\">\n <div class=\"container-edu grid items-start gap-12 lg:grid-cols-[1fr_360px]\">\n <div class=\"card card-body !p-8\" data-reveal=\"right\">\n <span class=\"eyebrow\">Certificate request</span>\n <h2 class=\"t-h2 mt-3 mb-2\">Request A Bona Fide Certificate</h2>\n <p class=\"t-body mb-8\">Complete the form below. Certificates are usually issued within 3–5 working days and can be collected from the school office.</p>\n <form class=\"flex flex-col gap-5\" novalidate>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"b-student\">Student Name <span class=\"req\">*</span></label><input class=\"input\" id=\"b-student\" required /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"b-admno\">Admission No. <span class=\"req\">*</span></label><input class=\"input\" id=\"b-admno\" required /></div>\n </div>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"b-grade\">Grade / Class</label><input class=\"input\" id=\"b-grade\" placeholder=\"e.g. Grade 8-B\" /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"b-purpose\">Purpose</label><select class=\"select\" id=\"b-purpose\"><option>Passport / Visa</option><option>Bank / Scholarship</option><option>Address proof</option><option>Other</option></select></div>\n </div>\n <div class=\"grid gap-5 sm:grid-cols-2\">\n <div class=\"form-group\"><label class=\"form-label\" for=\"b-parent\">Parent/Guardian Name <span class=\"req\">*</span></label><input class=\"input\" id=\"b-parent\" required /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"b-phone\">Contact Number <span class=\"req\">*</span></label><input class=\"input\" id=\"b-phone\" type=\"tel\" required /></div>\n </div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"b-email\">Email</label><input class=\"input\" id=\"b-email\" type=\"email\" /></div>\n <div class=\"form-group\"><label class=\"form-label\" for=\"b-notes\">Additional Notes</label><textarea class=\"textarea\" id=\"b-notes\" placeholder=\"Any specific details for the certificate\"></textarea></div>\n <label class=\"checkbox\"><input type=\"checkbox\" required /> I confirm the details above are accurate.</label>\n <button class=\"btn-primary self-start\" type=\"submit\">Submit Request</button>\n </form>\n </div>\n\n <aside class=\"flex flex-col gap-6\">\n <div class=\"card card-body\" data-reveal=\"left\"><h3 class=\"t-h4 mb-3\">Processing time</h3><p class=\"t-small\">Requests are processed within 3–5 working days. You&rsquo;ll be notified by phone or email when ready.</p></div>\n <div class=\"card card-body\" data-reveal=\"left\"><h3 class=\"t-h4 mb-3\">Need help?</h3><p class=\"t-small mb-4\">Contact the school office for urgent requests.</p><a href=\"contact.html\" class=\"btn-outline btn-sm\">Contact office</a></div>\n </aside>\n </div>\n</section>','Bona Fide Request','Request a bona fide / student verification certificate from Channawar\'s e Vidya Mandir.',NULL,NULL,NULL,'1','0','2026-07-07 10:00:00',NULL,NULL);

-- ----------------------------------------------------------
-- Table: cevm_programs
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_programs`;
CREATE TABLE `cevm_programs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(190) NOT NULL,
  `badge` varchar(60) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link_url` varchar(190) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_programs` (`id`,`title`,`badge`,`excerpt`,`image`,`link_url`,`sort_order`,`is_active`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Pre-Primary','Nursery · Jr KG · Sr KG','Play-based learning focused on creativity, communication, and early childhood development.','programs/pre-primary.png','curriculum.html','0','1','2026-07-07 10:00:00','2026-07-27 00:00:00',NULL),
('2','Primary School','Classes I–IV','Building strong academic foundations through interactive learning, creative thinking, and holistic development.','programs/primary-school.png','curriculum.html','1','1','2026-07-07 10:00:00','2026-07-27 00:00:00',NULL),
('3','Middle School','Classes V–VII','Developing analytical thinking, scientific curiosity, teamwork, and leadership.','programs/middle-school.png','curriculum.html','2','1','2026-07-07 10:00:00','2026-07-27 00:00:00',NULL),
('4','Senior School','Classes VIII–X','Preparing students for CBSE success, competitive examinations, career readiness, and lifelong learning.','programs/senior-school.png','curriculum.html','3','1','2026-07-07 10:00:00','2026-07-27 00:00:00',NULL),
('5','Senior Secondary','Grades 11–12','Science, Commerce and Humanities streams.',NULL,'curriculum.html','4','1','2026-07-07 10:00:00',NULL,'2026-07-09 13:54:29'),
('6','Co-Curricular','All grades','Arts, music, sports, science club, chess, dance and 30+ clubs and activities.','programs/co-curricular.png','curriculum.html','5','1','2026-07-07 10:00:00','2026-07-27 00:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_reviews
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_reviews`;
CREATE TABLE `cevm_reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `designation` varchar(120) DEFAULT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `avatar` varchar(255) DEFAULT NULL,
  `review` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_reviews_approved` (`is_approved`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_reviews` (`id`,`name`,`designation`,`rating`,`avatar`,`review`,`is_approved`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Neha Gupta','Parent','5',NULL,'The best decision we made for our son. Caring teachers and a wonderful community.','1','2026-07-07 10:00:00',NULL,NULL),
('2','Sameer Khan','Parent','5',NULL,'Excellent academics balanced with sports and arts. My daughter loves going to school.','1','2026-07-07 10:00:00',NULL,NULL),
('3','Divya R.','Alumna','5',NULL,'As an alumna, I owe my confidence to the mentors here. Forever grateful.','1','2026-07-07 10:00:00',NULL,NULL),
('4','Rohit Verma','Parent','4',NULL,'Safe, warm and academically strong. Communication with parents is excellent.','1','2026-07-07 10:00:00',NULL,NULL);

-- ----------------------------------------------------------
-- Table: cevm_settings
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_settings`;
CREATE TABLE `cevm_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(120) NOT NULL,
  `setting_value` longtext DEFAULT NULL,
  `setting_group` varchar(60) NOT NULL DEFAULT 'general',
  `setting_type` varchar(30) NOT NULL DEFAULT 'text',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_settings_key` (`setting_key`),
  KEY `idx_settings_group` (`setting_group`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_settings` (`id`,`setting_key`,`setting_value`,`setting_group`,`setting_type`,`updated_at`) VALUES
('1','site_name','Channawar\'s e Vidya Mandir','general','text','2026-07-07 10:00:00'),
('2','tagline','Dedicated to Excellence','general','text','2026-07-07 10:00:00'),
('3','footer_blurb','A CBSE school in Wardha nurturing every child from Nursery to Class X with care, values and academic excellence.','general','text','2026-07-07 10:00:00'),
('4','newsletter_blurb','Subscribe for admission updates, events and circulars.','general','text','2026-07-07 10:00:00'),
('5','copyright_year','2026','general','text','2026-07-07 10:00:00'),
('6','contact_email','cevidyamandir@gmail.com','contact','text','2026-07-07 10:00:00'),
('7','contact_phone','+91 8551061975','contact','text','2026-07-07 10:00:00'),
('8','contact_phone_href','+918551061975','contact','text','2026-07-07 10:00:00'),
('9','contact_address','Arvi Road, near Vyanktesh Polytechnic, Wardha, Maharashtra 442001','contact','text','2026-07-07 10:00:00'),
('10','contact_hours','Monday – Saturday: 8:00 AM – 4:00 PM','contact','text','2026-07-07 10:00:00'),
('11','google_map','https://www.google.com/maps?q=Channawar%27s+e+Vidya+Mandir%2C+Arvi+Road%2C+Wardha%2C+Maharashtra+442001&output=embed','contact','text','2026-07-08 14:41:42'),
('12','announcement_lead','Admissions Open for Session 2026-27','contact','text','2026-07-07 10:00:00'),
('13','announcement_strong','Nursery to Class IX','contact','text','2026-07-07 10:00:00'),
('14','seo_title','Channawar\'s e Vidya Mandir','seo','text','2026-07-07 10:00:00'),
('15','seo_description','Channawar\'s e Vidya Mandir is a CBSE-affiliated school in Wardha offering classes from Nursery to Class X, with a safe, joyful and value-driven learning environment.','seo','text','2026-07-07 10:00:00'),
('16','seo_keywords','school, education, admissions, Pune','seo','text','2026-07-07 10:00:00'),
('17','twitter_handle',NULL,'seo','text','2026-07-07 10:00:00'),
('18','primary_color','#1c3f94','appearance','text','2026-07-07 10:00:00'),
('19','secondary_color','#d21f26','appearance','text','2026-07-07 10:00:00'),
('20','accent_color','#c8a24a','appearance','text','2026-07-07 10:00:00'),
('21','anim_enabled','1','appearance','text','2026-07-07 10:00:00'),
('22','anim_duration','700','appearance','text','2026-07-07 10:00:00'),
('23','anim_offset','15','appearance','text','2026-07-07 10:00:00'),
('24','social_instagram','https://www.instagram.com/cevidyamandir/','social','text','2026-07-07 10:00:00'),
('25','social_facebook','https://www.facebook.com/cevmwardha/','social','text','2026-07-07 10:00:00'),
('26','social_youtube','https://www.youtube.com/@channawarsevidyamandir7398','social','text','2026-07-07 10:00:00'),
('27','address_street','Arvi Road, near Vyanktesh Polytechnic','contact','text','2026-07-08 14:41:42'),
('28','address_city','Wardha','contact','text','2026-07-08 14:41:42'),
('29','address_region','Maharashtra','contact','text','2026-07-08 14:41:42'),
('30','address_postal','442001','contact','text','2026-07-08 14:41:42');

-- ----------------------------------------------------------
-- Table: cevm_sliders
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_sliders`;
CREATE TABLE `cevm_sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eyebrow` varchar(120) DEFAULT NULL,
  `title` varchar(190) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `primary_label` varchar(60) DEFAULT NULL,
  `primary_url` varchar(190) DEFAULT NULL,
  `secondary_label` varchar(60) DEFAULT NULL,
  `secondary_url` varchar(190) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------------------------------------
-- Table: cevm_staff
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_staff`;
CREATE TABLE `cevm_staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `role` varchar(120) DEFAULT NULL,
  `category` varchar(40) DEFAULT 'Teacher',
  `photo` varchar(255) DEFAULT NULL,
  `bio` longtext DEFAULT NULL,
  `quote` text DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `socials` varchar(500) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_staff_cat` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_staff` (`id`,`name`,`role`,`category`,`photo`,`bio`,`quote`,`signature`,`socials`,`sort_order`,`is_active`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Prof. Mr. Dinesh Ji Channawar','President','Leadership','president.jpg','<p>When we opened our doors in 1990, we set out to create more than an institution of academics — a home for values, a playground for ideas, and a launchpad for dreams.</p><p>We remain deeply committed to nurturing good human beings — curious, kind and courageous.</p>','Education is the most powerful gift we can give a child.',NULL,NULL,'0','1','2026-07-07 10:00:00',NULL,NULL),
('2','Ms. Apurva Pande','Principal','Leadership','principal.jpg','<p>Our classrooms are lively spaces where questions are welcomed and mistakes are treated as stepping stones.</p><p>Our teachers are mentors first, working closely with families to support every learner.</p>','My greatest joy is watching students walk in curious and leave confident, capable and kind.',NULL,NULL,'1','1','2026-07-07 10:00:00',NULL,NULL),
('3','Priya Sharma','Head of Science','Teacher',NULL,'','',NULL,NULL,'2','1','2026-07-07 10:00:00',NULL,NULL),
('4','Rakesh Menon','Mathematics','Teacher',NULL,'','',NULL,NULL,'3','1','2026-07-07 10:00:00',NULL,NULL),
('5','Anita Roy','English & Literature','Teacher',NULL,'','',NULL,NULL,'4','1','2026-07-07 10:00:00',NULL,NULL),
('6','Vikram Iyer','Sports Director','Teacher',NULL,'','',NULL,NULL,'5','1','2026-07-07 10:00:00',NULL,NULL);

-- ----------------------------------------------------------
-- Table: cevm_statistics
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_statistics`;
CREATE TABLE `cevm_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(60) DEFAULT NULL,
  `value` int(11) NOT NULL DEFAULT 0,
  `suffix` varchar(10) DEFAULT NULL,
  `label` varchar(120) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_statistics` (`id`,`icon`,`value`,`suffix`,`label`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
('1','fa-user-graduate','4500','+','Students enrolled','0','1','2026-07-07 10:00:00',NULL),
('2','fa-chalkboard-user','120','+','Qualified teachers','1','1','2026-07-07 10:00:00',NULL),
('3','fa-trophy','250','+','Awards won','2','1','2026-07-07 10:00:00',NULL),
('4','fa-people-group','30','+','Clubs & activities','3','1','2026-07-07 10:00:00',NULL);

-- ----------------------------------------------------------
-- Table: cevm_testimonials
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_testimonials`;
CREATE TABLE `cevm_testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `role` varchar(120) DEFAULT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `avatar` varchar(255) DEFAULT NULL,
  `quote` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_testimonials` (`id`,`name`,`role`,`rating`,`avatar`,`quote`,`sort_order`,`is_active`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Meera Nair','Parent, Grade 4','5',NULL,'The teachers genuinely care. My daughter looks forward to school every single day.','0','1','2026-07-07 10:00:00',NULL,NULL),
('2','Arjun Deshmukh','Parent, Grade 9','5',NULL,'A perfect balance of academics, sports and values. The campus is safe and supportive.','1','1','2026-07-07 10:00:00',NULL,NULL),
('3','Sana Kapoor','Alumna, Batch 2015','5',NULL,'I still cherish the friendships and the values this school gave me. Highly recommended.','2','1','2026-07-07 10:00:00',NULL,NULL);

-- ----------------------------------------------------------
-- Table: cevm_users
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `cevm_users`;
CREATE TABLE `cevm_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','editor') NOT NULL DEFAULT 'editor',
  `avatar` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_email` (`email`),
  KEY `idx_users_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cevm_users` (`id`,`name`,`email`,`password`,`role`,`avatar`,`is_active`,`reset_token`,`reset_expires`,`last_login_at`,`created_at`,`updated_at`,`deleted_at`) VALUES
('1','Administrator','admin@cevidyamandir.com','$2y$10$t6WWlQS/h7z4Fcwzz8OQh.mpPNyTwtrNOa6WuSWnPmmVqDhGKiMjO','admin',NULL,'1',NULL,NULL,NULL,'2026-07-07 10:00:00',NULL,NULL);

SET FOREIGN_KEY_CHECKS=1;

-- ----------------------------------------------------------
-- Fees Structure page: official document viewer (2025-26 & 2026-27)
-- ----------------------------------------------------------
UPDATE `cevm_pages` SET `body_html` = '<section class="hero-banner" data-cms="banner">
 <img class="hero-banner__bg" src="assets/images/placeholders/banner.svg" alt="" fetchpriority="high" decoding="async" />
 <span class="hero-banner__overlay"></span>
 <div class="container-edu hero-banner__content">
 <h1 class="hero-banner__title" data-reveal>Fees Structure</h1>
 <nav class="breadcrumb" aria-label="Breadcrumb" data-reveal><a href="index.html">Home</a><span class="sep">&raquo;</span><a href="programs.html">Academics</a><span class="sep">&raquo;</span><span class="current">Fees Structure</span></nav>
 </div>
 <span class="hero-deco"><svg width="70" height="70" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="7" cy="17" r="3" stroke="currentColor" stroke-width="1.4"/><path d="M11 13 20 4m0 0h-6m6 0v6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
 <div class="hero-wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path fill="#ffffff" d="M0 60V22c180 34 360 34 540 8S900-8 1080 2s300 30 360 34v24H0Z"/></svg></div>
</section>

<section class="section">
  <div class="container-edu">
    <div class="section-head"><span class="eyebrow">Transparent pricing</span><h2 class="t-h2">Official Fee Structure &mdash; Sessions 2025-26 &amp; 2026-27</h2><p class="t-body">The official, school-approved fee structure. Tap the document to view it full screen.</p></div>
    <figure class="fee-doc" role="button" tabindex="0" data-notice-zoom="storage/uploads/documents/fees-structure-25-26-26-27.jpeg" aria-label="Open the official fee structure full screen">
      <img src="storage/uploads/documents/fees-structure-25-26-26-27.jpeg" alt="Official Fee Structure &ndash; Sessions 2025-26 and 2026-27" loading="lazy" decoding="async" />
      <span class="fee-doc__zoom"><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i></span>
    </figure>
    <div class="mt-6 text-center"><a class="btn-outline btn-sm" href="storage/uploads/documents/fees-structure-25-26-26-27.jpeg" target="_blank" rel="noopener"><i class="fa-solid fa-eye" aria-hidden="true"></i> View Full Document</a></div>
    <p class="t-small mt-4 text-center">* Official fee structure approved by the school. For any clarification, please contact the school office.</p>
  </div>
</section>
<section class="section section-soft">
 <div class="container-edu">
 <div class="section-head"><span class="eyebrow">Included in fees</span><h2 class="t-h2">What Your Fees Cover</h2></div>
 <div class="grid gap-6 md:grid-cols-3" data-reveal-stagger="100">
 <div class="card-feature" data-reveal><span class="feature-icon"></span><h3 class="t-h4 mb-2">Academics</h3><p class="t-small">Tuition, learning materials, labs and library access.</p></div>
 <div class="card-feature" data-reveal><span class="feature-icon"></span><h3 class="t-h4 mb-2">Activities</h3><p class="t-small">Sports, arts, clubs and most co-curricular programs.</p></div>
 <div class="card-feature" data-reveal><span class="feature-icon"></span><h3 class="t-h4 mb-2">Technology</h3><p class="t-small">Smart classrooms and digital learning platforms.</p></div>
 </div>
 <div class="mt-12 text-center"><a href="admissions.html" class="btn-primary">Proceed to admission</a></div>
 </div>
</section>

<div class="notice-lightbox" data-notice-lightbox aria-hidden="true">
  <button class="notice-lightbox__close" data-notice-lightbox-close aria-label="Close"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
  <img src="" alt="Official Fee Structure" />
</div>' WHERE `slug` = 'fees-structure';
