-- =====================================================================
-- SustainLife Foundation (SLF) — MySQL schema
-- Charset: utf8mb4 / Engine: InnoDB
-- Import:  mysql -u root -p slf_site < database/schema.sql
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `slf_site`
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `slf_site`;

SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Admins
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username`      VARCHAR(60)  NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `full_name`     VARCHAR(120) DEFAULT NULL,
  `email`         VARCHAR(150) DEFAULT NULL,
  `created_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_admins_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- News
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`        VARCHAR(200) NOT NULL,
  `slug`         VARCHAR(220) NOT NULL,
  `category`     VARCHAR(80)  DEFAULT NULL,
  `excerpt`      VARCHAR(500) DEFAULT NULL,
  `body`         MEDIUMTEXT   DEFAULT NULL,
  `image`        VARCHAR(255) DEFAULT NULL,
  `published_at` DATETIME     DEFAULT NULL,
  `status`       ENUM('draft','published') NOT NULL DEFAULT 'draft',
  `created_at`   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_news_slug` (`slug`),
  KEY `idx_news_status_pub` (`status`,`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Events
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(200) NOT NULL,
  `slug`        VARCHAR(220) NOT NULL,
  `location`    VARCHAR(200) DEFAULT NULL,
  `start_at`    DATETIME     DEFAULT NULL,
  `end_at`      DATETIME     DEFAULT NULL,
  `description` MEDIUMTEXT   DEFAULT NULL,
  `image`       VARCHAR(255) DEFAULT NULL,
  `status`      ENUM('draft','published','cancelled') NOT NULL DEFAULT 'draft',
  `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_events_slug` (`slug`),
  KEY `idx_events_start` (`start_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Announcements
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`        VARCHAR(200) NOT NULL,
  `body`         MEDIUMTEXT   DEFAULT NULL,
  `published_at` DATETIME     DEFAULT NULL,
  `status`       ENUM('draft','published') NOT NULL DEFAULT 'draft',
  `created_at`   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_ann_status` (`status`,`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Promotions
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE `promotions` (
  `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`      VARCHAR(200) NOT NULL,
  `body`       MEDIUMTEXT   DEFAULT NULL,
  `image`      VARCHAR(255) DEFAULT NULL,
  `starts_on`  DATE         DEFAULT NULL,
  `ends_on`    DATE         DEFAULT NULL,
  `status`     ENUM('draft','active','expired') NOT NULL DEFAULT 'draft',
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_promo_dates` (`starts_on`,`ends_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Projects
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`      VARCHAR(200) NOT NULL,
  `slug`       VARCHAR(220) NOT NULL,
  `sector`     VARCHAR(80)  DEFAULT NULL,
  `summary`    VARCHAR(500) DEFAULT NULL,
  `body`       MEDIUMTEXT   DEFAULT NULL,
  `image`      VARCHAR(255) DEFAULT NULL,
  `status`     ENUM('draft','active','completed') NOT NULL DEFAULT 'draft',
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_projects_slug` (`slug`),
  KEY `idx_projects_sector` (`sector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Service categories + services
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `services`;
DROP TABLE IF EXISTS `service_categories`;

CREATE TABLE `service_categories` (
  `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(150) NOT NULL,
  `slug`       VARCHAR(160) NOT NULL,
  `icon`       VARCHAR(60)  DEFAULT NULL,
  `intro`      VARCHAR(500) DEFAULT NULL,
  `sort_order` INT          NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_svc_cat_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `services` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT UNSIGNED NOT NULL,
  `title`       VARCHAR(180) NOT NULL,
  `slug`        VARCHAR(200) NOT NULL,
  `description` VARCHAR(500) DEFAULT NULL,
  `sort_order`  INT          NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_svc_slug` (`slug`),
  KEY `fk_svc_cat` (`category_id`),
  CONSTRAINT `fk_svc_cat` FOREIGN KEY (`category_id`)
    REFERENCES `service_categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Contact messages + quote requests
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(120) NOT NULL,
  `email`      VARCHAR(150) NOT NULL,
  `phone`      VARCHAR(40)  DEFAULT NULL,
  `subject`    VARCHAR(200) DEFAULT NULL,
  `message`    TEXT         NOT NULL,
  `type`       ENUM('general','partner','media','volunteer') NOT NULL DEFAULT 'general',
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_contact_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `quote_requests`;
CREATE TABLE `quote_requests` (
  `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization` VARCHAR(180) DEFAULT NULL,
  `contact_name` VARCHAR(120) NOT NULL,
  `email`        VARCHAR(150) NOT NULL,
  `phone`        VARCHAR(40)  DEFAULT NULL,
  `service_id`   INT UNSIGNED DEFAULT NULL,
  `scope`        TEXT         NOT NULL,
  `budget`       VARCHAR(80)  DEFAULT NULL,
  `timeline`     VARCHAR(120) DEFAULT NULL,
  `created_at`   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_quote_service` (`service_id`),
  CONSTRAINT `fk_quote_service` FOREIGN KEY (`service_id`)
    REFERENCES `services`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================================
-- Seed data
-- =====================================================================

-- Default admin: username = admin / password = admin
-- Replace the hash in production using:
--   php -r "echo password_hash('your-password', PASSWORD_BCRYPT);"
INSERT INTO `admins` (`username`,`password_hash`,`full_name`,`email`) VALUES
('admin', '$2y$10$E9p1wT0w0d6F5YvXgQy3ze9b6PwzI8m4r2xJX1hXq2wY9cBq8G6Iu', 'SLF Administrator', 'admin@sustainlife.or.tz');

-- Service categories
INSERT INTO `service_categories` (`id`,`name`,`slug`,`icon`,`intro`,`sort_order`) VALUES
(1,'Strategic & Business Consultancy','strategic-business','bi-briefcase','Direction, structure and compliance for impact-driven organisations.',1),
(2,'Technical & IT Services','technical-it','bi-cpu','Practical technology — advice, build and rollout.',2),
(3,'Social & Development Consultancy','social-development','bi-people','Sector expertise rooted in years of community work.',3),
(4,'Research & Innovation','research-innovation','bi-search','Evidence you can act on.',4),
(5,'Agricultural & Field Services','agriculture-field','bi-tree','Field-level support across value chains.',5);

-- Services
INSERT INTO `services` (`category_id`,`title`,`slug`,`description`,`sort_order`) VALUES
(1,'Strategic Planning','strategic-planning','Long-term roadmaps, theory of change and board-ready strategy documents.',1),
(1,'Organisation & Change Management','org-change-management','Restructuring, culture change and hands-on support through transitions.',2),
(1,'Human Resources','human-resources','HR policies, recruitment, performance systems and staff development.',3),
(1,'Tax Consultancy','tax-consultancy','TRA-aligned tax advisory, compliance reviews and filings for NGOs and SMEs.',4),

(2,'IT Consultancy','it-consultancy','Digital strategy, infrastructure assessments and technology selection.',1),
(2,'Software Development','software-development','Custom web and mobile platforms, MIS and data dashboards.',2),
(2,'Systems Implementation','systems-implementation','End-to-end deployment, integration and user training for new systems.',3),

(3,'Health Care Consultancy','health-care-consultancy','Public health programme design, facility assessments and quality improvement.',1),
(3,'Educational Consultancy','educational-consultancy','Curriculum reviews, school improvement plans and teacher training.',2),
(3,'Food & Nutrition Services','food-nutrition-services','Nutrition assessments, school-feeding design and food-security programming.',3),
(3,'Environmental Consultancy','environmental-consultancy','EIAs, climate adaptation strategies and natural resource management.',4),

(4,'Research, Survey & Development Consultancy','research-survey-development','Baselines, evaluations, market research and applied R&D for development programmes.',1),

(5,'Crop Cultivation Services','crop-cultivation','Climate-smart cultivation, agronomy advisory and demonstration plots.',1);

-- ---------------------------------------------------------------------
-- Resources (Strategic Plan, Annual Reports, Publications, Policies, Downloads)
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `resources`;
CREATE TABLE `resources` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`         VARCHAR(200) NOT NULL,
  `slug`          VARCHAR(220) NOT NULL,
  `type`          ENUM('strategic-plan','annual-report','publication','policy','download') NOT NULL DEFAULT 'download',
  `summary`       VARCHAR(500) DEFAULT NULL,
  `body`          MEDIUMTEXT   DEFAULT NULL,
  `years_covered` VARCHAR(40)  DEFAULT NULL,
  `file_path`     VARCHAR(255) NOT NULL,
  `file_size`     INT UNSIGNED DEFAULT NULL,
  `cover_image`   VARCHAR(255) DEFAULT NULL,
  `status`        ENUM('draft','published') NOT NULL DEFAULT 'draft',
  `published_at`  DATETIME     DEFAULT NULL,
  `created_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_resources_slug` (`slug`),
  KEY `idx_resources_type_status` (`type`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
