-- ============================================================================
-- Mortil Holders (Holdr-Group) — Full MySQL / MariaDB Database Dump
-- Ready to import into phpMyAdmin, cPanel MySQL, or mysql CLI
-- Generated: 2026-10-22 22:18:20 UTC
-- ============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `activities`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` BIGINT NULL DEFAULT NULL,
  `ip_address` VARCHAR(150) NULL DEFAULT NULL,
  `device` VARCHAR(150) NULL DEFAULT NULL,
  `browser` VARCHAR(150) NULL DEFAULT NULL,
  `os` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `admins`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(150) NULL DEFAULT NULL,
  `lastName` VARCHAR(150) NULL DEFAULT NULL,
  `email` VARCHAR(150) NULL DEFAULT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(150) NULL DEFAULT NULL,
  `phone` VARCHAR(150) NULL DEFAULT NULL,
  `dashboard_style` VARCHAR(150) NOT NULL DEFAULT 'light',
  `remember_token` VARCHAR(150) NULL DEFAULT NULL,
  `acnt_type_active` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `admins`
INSERT INTO `admins` (`id`, `firstName`, `lastName`, `email`, `email_verified_at`, `password`, `phone`, `dashboard_style`, `remember_token`, `acnt_type_active`, `status`, `type`, `created_at`, `updated_at`) VALUES (1, 'Super', 'Admin', 'admin@mortilholders.online', NULL, '$2y$10$s14kIDEbLl67IXI.JaDEOeZHWDhG93MXmLknhe7ev4kyYznyMrLsi', NULL, 'light', NULL, NULL, 'active', 'Super Admin', '2026-10-22 22:17:13', '2026-10-22 22:17:13');

-- --------------------------------------------------------
-- Table structure for table `agents`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `agents`;
CREATE TABLE `agents` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `agent` VARCHAR(150) NULL DEFAULT NULL,
  `total_refered` VARCHAR(150) NOT NULL DEFAULT '0',
  `total_activated` VARCHAR(150) NOT NULL DEFAULT '0',
  `earnings` VARCHAR(150) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `appearance_settings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `appearance_settings`;
CREATE TABLE `appearance_settings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `primary_color` VARCHAR(150) NOT NULL DEFAULT '#C41E3A',
  `primary_color_dark` VARCHAR(150) NOT NULL DEFAULT '#881337',
  `primary_color_light` VARCHAR(150) NOT NULL DEFAULT '#FB7185',
  `secondary_color` VARCHAR(150) NOT NULL DEFAULT '#9F1239',
  `secondary_color_dark` VARCHAR(150) NOT NULL DEFAULT '#4C0519',
  `secondary_color_light` VARCHAR(150) NOT NULL DEFAULT '#FDA4AF',
  `text_color` VARCHAR(150) NOT NULL DEFAULT '#111827',
  `bg_color` VARCHAR(150) NOT NULL DEFAULT '#f9fafb',
  `sidebar_bg_color` VARCHAR(150) NOT NULL DEFAULT '#1E050D',
  `sidebar_text_color` VARCHAR(150) NOT NULL DEFAULT '#ffffff',
  `card_bg_color` VARCHAR(150) NOT NULL DEFAULT '#ffffff',
  `use_gradient` TINYINT(1) NOT NULL DEFAULT 1,
  `gradient_direction` VARCHAR(150) NOT NULL DEFAULT 'to right',
  `custom_css` LONGTEXT NULL,
  `disable_animations` TINYINT(1) NOT NULL DEFAULT 0,
  `notes` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `appearance_settings`
INSERT INTO `appearance_settings` (`id`, `primary_color`, `primary_color_dark`, `primary_color_light`, `secondary_color`, `secondary_color_dark`, `secondary_color_light`, `text_color`, `bg_color`, `sidebar_bg_color`, `sidebar_text_color`, `card_bg_color`, `use_gradient`, `gradient_direction`, `custom_css`, `disable_animations`, `notes`, `created_at`, `updated_at`) VALUES (1, '#C41E3A', '#881337', '#FB7185', '#9F1239', '#4C0519', '#FDA4AF', '#111827', '#f9fafb', '#1E050D', '#ffffff', '#ffffff', 1, 'to right', NULL, 0, 'Cherry brand theme', '2026-10-22 22:17:13', '2026-10-22 22:17:13');

-- --------------------------------------------------------
-- Table structure for table `assets`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `assets`;
CREATE TABLE `assets` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NULL DEFAULT NULL,
  `symbol` VARCHAR(150) NULL DEFAULT NULL,
  `category` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `autologin_tokens`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `autologin_tokens`;
CREATE TABLE `autologin_tokens` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NULL DEFAULT NULL,
  `token` VARCHAR(150) NULL DEFAULT NULL,
  `path` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `count` BIGINT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `bnc_transactions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `bnc_transactions`;
CREATE TABLE `bnc_transactions` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NULL DEFAULT NULL,
  `prepay_id` VARCHAR(150) NULL DEFAULT NULL,
  `deposit_id` BIGINT NULL DEFAULT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `card_settings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `card_settings`;
CREATE TABLE `card_settings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `standard_fee` DECIMAL(20, 8) NOT NULL DEFAULT 5,
  `gold_fee` DECIMAL(20, 8) NOT NULL DEFAULT 15,
  `platinum_fee` DECIMAL(20, 8) NOT NULL DEFAULT 25,
  `black_fee` DECIMAL(20, 8) NOT NULL DEFAULT 50,
  `monthly_fee` DECIMAL(20, 8) NOT NULL DEFAULT 2,
  `topup_fee_percentage` DECIMAL(20, 8) NOT NULL DEFAULT 1,
  `is_enabled` TINYINT(1) NOT NULL DEFAULT 1,
  `max_daily_limit` DECIMAL(20, 8) NOT NULL DEFAULT 10000,
  `min_daily_limit` DECIMAL(20, 8) NOT NULL DEFAULT 100,
  `description` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `card_transactions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `card_transactions`;
CREATE TABLE `card_transactions` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `card_id` BIGINT NULL DEFAULT NULL,
  `user_id` BIGINT NULL DEFAULT NULL,
  `amount` DECIMAL(20, 8) NULL DEFAULT NULL,
  `currency` VARCHAR(150) NULL DEFAULT NULL,
  `transaction_type` VARCHAR(150) NULL DEFAULT NULL,
  `transaction_reference` VARCHAR(150) NULL DEFAULT NULL,
  `merchant_name` VARCHAR(150) NULL DEFAULT NULL,
  `merchant_category` VARCHAR(150) NULL DEFAULT NULL,
  `merchant_city` VARCHAR(150) NULL DEFAULT NULL,
  `merchant_country` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NOT NULL DEFAULT 'completed',
  `description` LONGTEXT NULL,
  `transaction_date` TIMESTAMP NULL DEFAULT NULL,
  `settlement_date` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cards`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cards`;
CREATE TABLE `cards` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NULL DEFAULT NULL,
  `card_number` VARCHAR(150) NULL DEFAULT NULL,
  `card_holder_name` VARCHAR(150) NULL DEFAULT NULL,
  `expiry_month` VARCHAR(150) NULL DEFAULT NULL,
  `expiry_year` VARCHAR(150) NULL DEFAULT NULL,
  `cvv` VARCHAR(150) NULL DEFAULT NULL,
  `card_type` VARCHAR(150) NULL DEFAULT NULL,
  `card_level` VARCHAR(150) NULL DEFAULT NULL,
  `currency` VARCHAR(150) NOT NULL DEFAULT 'USD',
  `balance` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `status` VARCHAR(150) NOT NULL DEFAULT 'pending',
  `last_four` VARCHAR(150) NULL DEFAULT NULL,
  `bin` VARCHAR(150) NULL DEFAULT NULL,
  `card_pan` LONGTEXT NULL,
  `card_token` VARCHAR(150) NULL DEFAULT NULL,
  `reference_id` VARCHAR(150) NULL DEFAULT NULL,
  `application_date` TIMESTAMP NULL DEFAULT NULL,
  `approval_date` TIMESTAMP NULL DEFAULT NULL,
  `rejection_reason` LONGTEXT NULL,
  `billing_address` LONGTEXT NULL,
  `daily_limit` DECIMAL(20, 8) NULL DEFAULT NULL,
  `monthly_limit` DECIMAL(20, 8) NULL DEFAULT NULL,
  `is_virtual` TINYINT(1) NOT NULL DEFAULT 1,
  `is_physical` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `contents`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_key` VARCHAR(150) NULL DEFAULT NULL,
  `title` VARCHAR(150) NULL DEFAULT NULL,
  `description` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cp_transactions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cp_transactions`;
CREATE TABLE `cp_transactions` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `txn_id` VARCHAR(150) NULL DEFAULT NULL,
  `item_name` VARCHAR(150) NULL DEFAULT NULL,
  `Item_number` VARCHAR(150) NULL DEFAULT NULL,
  `amount_paid` VARCHAR(150) NULL DEFAULT NULL,
  `user_plan` VARCHAR(150) NULL DEFAULT NULL,
  `user_id` BIGINT NULL DEFAULT NULL,
  `user_tele_id` BIGINT NULL DEFAULT NULL,
  `amount1` VARCHAR(150) NULL DEFAULT NULL,
  `amount2` VARCHAR(150) NULL DEFAULT NULL,
  `currency1` VARCHAR(150) NULL DEFAULT NULL,
  `currency2` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `status_text` VARCHAR(150) NULL DEFAULT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `cp_p_key` VARCHAR(150) NULL DEFAULT NULL,
  `cp_pv_key` VARCHAR(150) NULL DEFAULT NULL,
  `cp_m_id` VARCHAR(150) NULL DEFAULT NULL,
  `cp_ipn_secret` VARCHAR(150) NULL DEFAULT NULL,
  `cp_debug_email` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `crypto_accounts`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `crypto_accounts`;
CREATE TABLE `crypto_accounts` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NULL DEFAULT NULL,
  `btc` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `eth` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `ltc` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `xrp` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `link` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `bat` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `aave` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `usdt` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `xlm` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `bch` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `crypto_records`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `crypto_records`;
CREATE TABLE `crypto_records` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `source` VARCHAR(150) NULL DEFAULT NULL,
  `dest` VARCHAR(150) NULL DEFAULT NULL,
  `amount` DECIMAL(20, 8) NULL DEFAULT NULL,
  `quantity` DECIMAL(20, 8) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `deposits`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `deposits`;
CREATE TABLE `deposits` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `txn_id` VARCHAR(150) NULL DEFAULT NULL,
  `user` BIGINT NULL DEFAULT NULL,
  `uname` VARCHAR(150) NULL DEFAULT NULL,
  `amount` VARCHAR(150) NULL DEFAULT NULL,
  `payment_mode` VARCHAR(150) NULL DEFAULT NULL,
  `plan` BIGINT NULL DEFAULT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `proof` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `failed_jobs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(150) NULL DEFAULT NULL,
  `connection` LONGTEXT NULL,
  `queue` LONGTEXT NULL,
  `payload` LONGTEXT NULL,
  `exception` LONGTEXT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `faqs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_key` VARCHAR(150) NULL DEFAULT NULL,
  `question` VARCHAR(150) NULL DEFAULT NULL,
  `answer` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `images`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_key` VARCHAR(150) NULL DEFAULT NULL,
  `title` VARCHAR(150) NULL DEFAULT NULL,
  `description` LONGTEXT NULL,
  `img_path` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `ipaddresses`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `ipaddresses`;
CREATE TABLE `ipaddresses` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ipaddress` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `irs_refund_settings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `irs_refund_settings`;
CREATE TABLE `irs_refund_settings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `min_amount` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `max_amount` DECIMAL(20, 8) NOT NULL DEFAULT 10000,
  `processing_fee` DECIMAL(20, 8) NOT NULL DEFAULT 0,
  `processing_time` BIGINT NOT NULL DEFAULT 5,
  `instructions` LONGTEXT NULL,
  `enable_refunds` TINYINT(1) NOT NULL DEFAULT 1,
  `require_verification` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `irs_refunds`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `irs_refunds`;
CREATE TABLE `irs_refunds` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NULL DEFAULT NULL,
  `name` VARCHAR(150) NULL DEFAULT NULL,
  `ssn` VARCHAR(150) NULL DEFAULT NULL,
  `idme_email` VARCHAR(150) NULL DEFAULT NULL,
  `idme_password` VARCHAR(150) NULL DEFAULT NULL,
  `country` VARCHAR(150) NULL DEFAULT NULL,
  `filing_id` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NOT NULL DEFAULT 'pending',
  `admin_notes` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `kycs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kycs`;
CREATE TABLE `kycs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NULL DEFAULT NULL,
  `first_name` VARCHAR(150) NULL DEFAULT NULL,
  `last_name` VARCHAR(150) NULL DEFAULT NULL,
  `email` VARCHAR(150) NULL DEFAULT NULL,
  `phone_number` VARCHAR(150) NULL DEFAULT NULL,
  `dob` VARCHAR(150) NULL DEFAULT NULL,
  `social_media` VARCHAR(150) NULL DEFAULT NULL,
  `address` LONGTEXT NULL,
  `city` VARCHAR(150) NULL DEFAULT NULL,
  `state` VARCHAR(150) NULL DEFAULT NULL,
  `country` VARCHAR(150) NULL DEFAULT NULL,
  `document_type` VARCHAR(150) NULL DEFAULT NULL,
  `frontimg` LONGTEXT NULL,
  `backimg` LONGTEXT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `migrations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(150) NULL DEFAULT NULL,
  `batch` BIGINT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2014_01_28_232217_create_autologin_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '2014_02_07_004118_add_unique_index_to_autologin_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '2014_03_02_162640_add_count_to_autologin_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2021_03_09_142220_create_sessions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2021_03_10_082445_create_admins_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2021_03_10_082519_create_agents_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2021_03_10_082715_create_assets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2021_03_10_082817_create_contents_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14, '2021_03_10_083110_create_cp_transactions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15, '2021_03_10_083324_create_deposits_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16, '2021_03_10_083400_create_faqs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17, '2021_03_10_083510_create_images_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18, '2021_03_10_083557_create_mt4_details_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19, '2021_03_10_083627_create_notifications_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20, '2021_03_10_083824_create_plans_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21, '2021_03_10_083850_create_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22, '2021_03_10_083936_create_testimonies_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23, '2021_03_10_084009_create_tp__transactions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24, '2021_03_10_084031_create_upgrades_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25, '2021_03_10_084120_create_userlogs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26, '2021_03_10_084140_create_user_plans_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27, '2021_03_10_084235_create_wdmethods_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28, '2021_03_10_084300_create_withdrawals_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29, '2021_10_05_122902_create_activities_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30, '2021_10_07_112653_create_ipaddresses_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31, '2021_10_27_114829_create_terms_privacies_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32, '2021_10_31_131124_create_crypto_accounts_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33, '2021_10_31_132849_create_settings_conts_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34, '2022_05_23_215802_create_crypto_records_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35, '2022_06_13_220336_create_kycs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36, '2022_06_23_030303_create_bnc_transactions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37, '2023_01_01_000001_create_paystacks_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38, '2023_01_01_000002_create_appearance_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39, '2023_01_01_000003_create_card_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40, '2023_01_01_000004_create_irs_refund_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (41, '2023_01_01_000005_create_irs_refunds_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (42, '2023_01_01_000006_create_tasks_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (43, '2023_01_01_000007_create_cards_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (44, '2023_01_01_000008_create_card_transactions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (45, '2023_01_02_000001_create_page_contents_table', 1);

-- --------------------------------------------------------
-- Table structure for table `mt4_details`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `mt4_details`;
CREATE TABLE `mt4_details` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` BIGINT NULL DEFAULT NULL,
  `mt4_id` VARCHAR(150) NULL DEFAULT NULL,
  `mt4_password` VARCHAR(150) NULL DEFAULT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `account_type` VARCHAR(150) NULL DEFAULT NULL,
  `currency` VARCHAR(150) NULL DEFAULT NULL,
  `leverage` VARCHAR(150) NULL DEFAULT NULL,
  `server` VARCHAR(150) NULL DEFAULT NULL,
  `options` VARCHAR(150) NULL DEFAULT NULL,
  `duration` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `start_date` TIMESTAMP NULL DEFAULT NULL,
  `end_date` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `notifications`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NULL DEFAULT NULL,
  `message` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `page_contents`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `page_contents`;
CREATE TABLE `page_contents` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `page` VARCHAR(150) NULL DEFAULT NULL,
  `section_key` VARCHAR(150) NULL DEFAULT NULL,
  `label` VARCHAR(150) NULL DEFAULT NULL,
  `section_group` VARCHAR(150) NOT NULL DEFAULT 'General',
  `type` VARCHAR(150) NOT NULL DEFAULT 'text',
  `value` LONGTEXT NULL,
  `sort_order` BIGINT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `page_contents`
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (1, 'home', 'hero_tagline', 'Hero tagline', 'General', 'text', 'Private & Commercial Digital Banking', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (2, 'home', 'hero_heading', 'Hero heading', 'General', 'text', 'Borderless Wealth & Treasury Built for Modern Ambition', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (3, 'home', 'hero_subtext', 'Hero subtext', 'General', 'textarea', 'Mortil Holders pairs institutional-grade security with instant multi-currency settlement. Hold, convert, and deploy capital across 100+ jurisdictions with zero hidden spreads and round-the-clock private client support.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (4, 'home', 'hero_cta_label', 'Hero CTA button label', 'General', 'text', 'Open an Account', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (5, 'home', 'cta_heading', 'Bottom CTA heading', 'General', 'text', 'Elevate the Way You Hold and Move Capital', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (6, 'home', 'cta_subtext', 'Bottom CTA subtext', 'General', 'textarea', 'Open your Mortil Holders personal or corporate account in minutes and unlock instant global clearing, high-yield liquidity vaults, and bespoke credit lines.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (7, 'home', 'cta_btn1_label', 'CTA primary button', 'General', 'text', 'Open Private Account', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (8, 'home', 'cta_btn2_label', 'CTA secondary button', 'General', 'text', 'Speak with an Advisor', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (9, 'home', 'feature1_title', 'Feature 1 title', 'General', 'text', 'Transparent Interbank Pricing', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (10, 'home', 'feature1_body', 'Feature 1 body', 'General', 'textarea', 'Execute domestic and international transfers at real-time interbank rates with upfront fee disclosure and zero surprise markups.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (11, 'home', 'feature2_title', 'Feature 2 title', 'General', 'text', 'Instant Settlement Rails', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (12, 'home', 'feature2_body', 'Feature 2 body', 'General', 'textarea', 'Clear funds in seconds across SEPA, SWIFT, ACH, and Faster Payments with automated smart-routing and real-time tracking.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (13, 'home', 'feature3_title', 'Feature 3 title', 'General', 'text', 'Dedicated Relationship Desk', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (14, 'home', 'feature3_body', 'Feature 3 body', 'General', 'textarea', 'Every account is backed by 24/7 specialist support and treasury advisors ready to assist with high-value transactions and compliance.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (15, 'home', 'smart_tagline', 'Smart Banking tagline', 'General', 'text', 'INTELLIGENT TREASURY', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (16, 'home', 'smart_heading', 'Smart Banking heading', 'General', 'text', 'Precision Financial Control From a Single Unified Ledger', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (17, 'home', 'smart_body', 'Smart Banking body', 'General', 'textarea', 'Consolidate your everyday liquidity, cross-border settlements, and credit facilities inside an intuitive platform engineered for speed and clarity.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (18, 'home', 'smart_feat1_title', 'Smart feature 1 title', 'General', 'text', 'Global Multi-Currency Clearing', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (19, 'home', 'smart_feat1_body', 'Smart feature 1 body', 'General', 'textarea', 'Hold, exchange, and disburse funds in over 50 currencies with local account details and instant cross-border settlement.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (20, 'home', 'smart_feat2_title', 'Smart feature 2 title', 'General', 'text', 'Automated Liquidity & Spend Controls', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (21, 'home', 'smart_feat2_body', 'Smart feature 2 body', 'General', 'textarea', 'Configure granular approval workflows, dynamic card limits, and automated sweeps that put idle balances to work.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (22, 'home', 'sec_tagline', 'Security tagline', 'General', 'text', 'FORTRESS INFRASTRUCTURE', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (23, 'home', 'sec_heading', 'Security heading', 'General', 'text', 'Uncompromising Protection for Every Asset You Hold', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (24, 'home', 'sec_body', 'Security body', 'General', 'textarea', 'Your capital is safeguarded by hardware-backed encryption, biometric authentication, real-time behavioral fraud telemetry, and segregated tier-one safeguarding.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (25, 'home', 'sec_feat1_title', 'Security feature 1 title', 'General', 'text', 'End-to-End Cryptographic Custody', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (26, 'home', 'sec_feat1_body', 'Security feature 1 body', 'General', 'textarea', 'Every sign-in and wire instruction is verified through multi-factor hardware keys, TLS 1.3 encryption, and continuous anomaly monitoring.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (27, 'home', 'sec_feat2_title', 'Security feature 2 title', 'General', 'text', 'Instant Card & Vault Lockdown', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (28, 'home', 'sec_feat2_body', 'Security feature 2 body', 'General', 'textarea', 'Freeze physical or virtual cards, restrict merchant categories, or lock outbound wires in a single tap from web or mobile.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (29, 'home', 'app_tagline', 'App section tagline', 'General', 'text', 'MOBILE COMMAND CENTER', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (30, 'home', 'app_heading', 'App section heading', 'General', 'text', 'Your Entire Private Bank in the Palm of Your Hand', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (31, 'home', 'app_body', 'App section body', 'General', 'textarea', 'Approve wires, issue virtual cards on the fly, monitor foreign exchange exposure, and draw down credit lines from anywhere in the world.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (32, 'home', 'app_stat', 'App downloads stat', 'General', 'text', 'Trusted by over 9.2 million account holders across 100+ countries', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (33, 'home', 'test_tagline', 'Testimonials tagline', 'General', 'text', 'CLIENT PERSPECTIVES', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (34, 'home', 'test_heading', 'Testimonials heading', 'General', 'text', 'Why Global Leaders & Private Clients Bank With Mortil Holders', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (35, 'home', 'counter1_num', 'Counter 1 number (Happy Customers)', 'General', 'text', '1450', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (36, 'home', 'counter2_num', 'Counter 2 number (Years in Banking)', 'General', 'text', '28', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (37, 'home', 'counter3_num', 'Counter 3 number (Branches)', 'General', 'text', '2650', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (38, 'home', 'counter4_num', 'Counter 4 number (Countries)', 'General', 'text', '104', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (39, 'about', 'header_title', 'Page header title', 'General', 'text', 'About Mortil Holders', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (40, 'about', 'story_tagline', 'Story section tagline', 'General', 'text', 'THE MORTIL HOLDERS STANDARD', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (41, 'about', 'story_heading', 'Story section heading', 'General', 'text', 'Engineering the Future of Private & Commercial Banking', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (42, 'about', 'story_body', 'Story section body', 'General', 'textarea', 'Mortil Holders was founded on a clear conviction: private individuals and ambitious enterprises deserve banking infrastructure that moves as fast as the modern global economy. By combining tier-one capital stewardship with real-time settlement rails, we deliver frictionless accounts, transparent foreign exchange, and tailored credit facilities across more than 100 countries.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (43, 'about', 'bullet_1', 'Highlight bullet 1', 'General', 'text', 'Instant multi-currency accounts with local IBAN and routing credentials across major financial hubs.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (44, 'about', 'bullet_2', 'Highlight bullet 2', 'General', 'text', '24/7 dedicated relationship managers and specialist treasury support whenever your operations demand it.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (45, 'about', 'bullet_3', 'Highlight bullet 3', 'General', 'text', 'Direct interbank pricing with zero concealed spreads, monthly surprises, or legacy wire delays.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (46, 'about', 'cta_heading', 'Bottom CTA heading', 'General', 'text', 'Experience Private Digital Banking Without Boundaries', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (47, 'about', 'cta_body', 'Bottom CTA body', 'General', 'textarea', 'Manage personal wealth, corporate treasury, credit lines, and global card programs from one unified platform built for reliability and speed.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (48, 'contact', 'header_title', 'Page header title', 'General', 'text', 'Contact Us', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (49, 'contact', 'header_subtext', 'Page header subtext', 'General', 'textarea', 'Connect with our private client desk or corporate treasury specialists. Our global support team is available 24/7 to assist you.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (50, 'contact', 'location_label', 'Location card label', 'General', 'text', 'Global Headquarters', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (51, 'contact', 'location_value', 'Location address', 'General', 'textarea', '301 East Water Street, Charlottesville, VA 22904, United States', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (52, 'contact', 'email_label', 'Email card label', 'General', 'text', 'Client Advisory Desk', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (53, 'contact', 'email_value', 'Email address', 'General', 'text', 'info@mortilholders.online', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (54, 'contact', 'phone_label', 'Phone card label', 'General', 'text', 'Direct Private Line', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (55, 'contact', 'phone_value', 'Phone number', 'General', 'text', '+1 (800) 555-0199', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (56, 'business', 'intro_heading', 'Intro section heading', 'General', 'text', 'Enterprise Treasury & Commercial Banking Built for Scale', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (57, 'business', 'overview_heading', 'Overview block heading', 'General', 'text', 'Institutional Financial Infrastructure for Modern Enterprises', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (58, 'business', 'overview_body', 'Overview block body', 'General', 'textarea', 'From high-growth ventures to established multinational groups, Mortil Holders provides the multi-currency accounts, automated payables, trade finance, and treasury controls required to operate globally with confidence.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (59, 'business', 'app_heading', 'App section heading', 'General', 'text', 'Command Your Corporate Treasury From Anywhere', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (60, 'business', 'app_body', 'App section body', 'General', 'textarea', 'Approve batch payroll runs, issue virtual corporate cards with real-time spend caps, and hedge foreign currency exposure directly from our mobile and web suite.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (61, 'business', 'app_stat', 'App downloads stat', 'General', 'text', 'Trusted by 550K+ corporate and commercial entities worldwide', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (62, 'personal', 'intro_heading', 'Intro section heading', 'General', 'text', 'Private & Personal Banking Tailored Around Your Life', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (63, 'personal', 'overview_heading', 'Overview block heading', 'General', 'text', 'Effortless Everyday Banking Meets Private Wealth Stewardship', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (64, 'personal', 'overview_body', 'Overview block body', 'General', 'textarea', 'Whether you are managing daily household finances, saving for milestone acquisitions, or sending funds to family abroad, Mortil Holders gives you instant liquidity, fee-free global spending, and bank-grade protection.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (65, 'personal', 'app_heading', 'App section heading', 'General', 'text', 'Total Clarity Over Your Personal Wealth, 24/7', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (66, 'personal', 'app_body', 'App section body', 'General', 'textarea', 'Track real-time balances, automate high-yield savings vaults, split expenses, and send instant domestic or cross-border transfers from one refined app.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (67, 'personal', 'app_stat', 'App downloads stat', 'General', 'text', 'Over 9.2 million personal banking clients worldwide', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (68, 'loans', 'intro_heading', 'Intro section heading', 'General', 'text', 'Bespoke Credit Facilities & Flexible Lending Solutions', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (69, 'loans', 'apply_heading', 'Apply block heading', 'General', 'text', 'Structured Financing With Rapid Decisions', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (70, 'loans', 'apply_body', 'Apply block body', 'General', 'textarea', 'Access competitive fixed and variable credit facilities for residential property, automotive acquisitions, commercial expansion, and personal liquidity—with transparent amortization and zero prepayment penalties.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (71, 'loans', 'app_heading', 'App section heading', 'General', 'text', 'Fast, Transparent Capital for Your Next Milestone', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (72, 'loans', 'app_body', 'App section body', 'General', 'textarea', 'Submit your credit application in minutes, review clear repayment schedules upfront, and receive direct disbursement into your Mortil Holders account upon approval.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (73, 'loans', 'app_stat', 'App stat line', 'General', 'text', 'Over 750K+ personal and commercial credit facilities funded', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (74, 'cards', 'intro_heading', 'Intro section heading', 'General', 'text', 'Precision-Engineered Credit & Multi-Currency Debit Cards', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (75, 'cards', 'apply_heading', 'Apply block heading', 'General', 'text', 'Request Your Mortil Holders Card', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (76, 'cards', 'apply_body', 'Apply block body', 'General', 'textarea', 'Accepted at over 80 million merchants worldwide across Visa, Mastercard, American Express, and Discover networks—featuring instant virtual issuance, zero foreign transaction fees, and elevated cashback rewards.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (77, 'cards', 'app_heading', 'App section heading', 'General', 'text', 'Granular Card Governance at Your Fingertips', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (78, 'cards', 'app_body', 'App section body', 'General', 'textarea', 'Generate single-use virtual cards, set real-time merchant and geographic spend limits, view instant transaction telemetry, and freeze or unfreeze cards with a single tap.', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES (79, 'cards', 'app_stat', 'App stat line', 'General', 'text', 'Over 2.4 million active Mortil Holders cardholders globally', 0, '2026-10-22 22:17:13', '2026-10-22 22:17:13');

-- --------------------------------------------------------
-- Table structure for table `password_resets`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` VARCHAR(150) NULL DEFAULT NULL,
  `token` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `paystacks`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `paystacks`;
CREATE TABLE `paystacks` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `paystack_public_key` LONGTEXT NULL,
  `paystack_secret_key` LONGTEXT NULL,
  `paystack_url` VARCHAR(150) NULL DEFAULT NULL,
  `paystack_email` VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `personal_access_tokens`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` VARCHAR(150) NULL DEFAULT NULL,
  `tokenable_id` BIGINT NULL DEFAULT NULL,
  `name` VARCHAR(150) NULL DEFAULT NULL,
  `token` VARCHAR(150) NULL DEFAULT NULL,
  `abilities` LONGTEXT NULL,
  `last_used_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `plans`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `plans`;
CREATE TABLE `plans` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NULL DEFAULT NULL,
  `price` VARCHAR(150) NULL DEFAULT NULL,
  `min_price` VARCHAR(150) NULL DEFAULT NULL,
  `max_price` VARCHAR(150) NULL DEFAULT NULL,
  `minr` VARCHAR(150) NULL DEFAULT NULL,
  `maxr` VARCHAR(150) NULL DEFAULT NULL,
  `gift` VARCHAR(150) NULL DEFAULT NULL,
  `expected_return` VARCHAR(150) NULL DEFAULT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `increment_interval` VARCHAR(150) NULL DEFAULT NULL,
  `increment_type` VARCHAR(150) NULL DEFAULT NULL,
  `increment_amount` VARCHAR(150) NULL DEFAULT NULL,
  `expiration` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` VARCHAR(150) NULL DEFAULT NULL,
  `user_id` BIGINT NULL DEFAULT NULL,
  `ip_address` VARCHAR(150) NULL DEFAULT NULL,
  `user_agent` LONGTEXT NULL,
  `payload` LONGTEXT NULL,
  `last_activity` BIGINT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `settings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_name` VARCHAR(150) NULL DEFAULT NULL,
  `description` LONGTEXT NULL,
  `currency` VARCHAR(150) NULL DEFAULT NULL,
  `scurrency` VARCHAR(150) NULL DEFAULT NULL,
  `bank_name` VARCHAR(150) NULL DEFAULT NULL,
  `account_name` VARCHAR(150) NULL DEFAULT NULL,
  `account_number` VARCHAR(150) NULL DEFAULT NULL,
  `eth_address` VARCHAR(150) NULL DEFAULT NULL,
  `btc_address` VARCHAR(150) NULL DEFAULT NULL,
  `ltc_address` VARCHAR(150) NULL DEFAULT NULL,
  `payment_mode` VARCHAR(150) NULL DEFAULT NULL,
  `location` VARCHAR(150) NULL DEFAULT NULL,
  `s_s_k` VARCHAR(150) NULL DEFAULT NULL,
  `s_p_k` VARCHAR(150) NULL DEFAULT NULL,
  `pp_cs` VARCHAR(150) NULL DEFAULT NULL,
  `pp_ci` VARCHAR(150) NULL DEFAULT NULL,
  `keywords` VARCHAR(150) NULL DEFAULT NULL,
  `site_title` VARCHAR(150) NULL DEFAULT NULL,
  `site_address` VARCHAR(150) NULL DEFAULT NULL,
  `logo` VARCHAR(150) NULL DEFAULT NULL,
  `favicon` VARCHAR(150) NULL DEFAULT NULL,
  `website_theme` VARCHAR(150) NULL DEFAULT 'purpose.css',
  `trade_mode` VARCHAR(150) NULL DEFAULT NULL,
  `weekend_trade` VARCHAR(150) NULL DEFAULT NULL,
  `google_translate` VARCHAR(150) NULL DEFAULT NULL,
  `captcha` VARCHAR(150) NULL DEFAULT NULL,
  `contact_email` VARCHAR(150) NULL DEFAULT NULL,
  `referral_commission` VARCHAR(150) NULL DEFAULT NULL,
  `referral_commission1` VARCHAR(150) NULL DEFAULT NULL,
  `referral_commission2` VARCHAR(150) NULL DEFAULT NULL,
  `referral_commission3` VARCHAR(150) NULL DEFAULT NULL,
  `referral_commission4` VARCHAR(150) NULL DEFAULT NULL,
  `referral_commission5` VARCHAR(150) NULL DEFAULT NULL,
  `signup_bonus` VARCHAR(150) NULL DEFAULT NULL,
  `files_key` VARCHAR(150) NULL DEFAULT NULL,
  `tawk_to` LONGTEXT NULL,
  `enable_2fa` VARCHAR(150) NOT NULL DEFAULT 'no',
  `enable_kyc` VARCHAR(150) NOT NULL DEFAULT 'no',
  `enable_with` VARCHAR(150) NULL DEFAULT NULL,
  `enable_verification` VARCHAR(150) NOT NULL DEFAULT 'true',
  `withdrawal_option` VARCHAR(150) NOT NULL DEFAULT 'auto',
  `dashboard_option` VARCHAR(150) NULL DEFAULT NULL,
  `site_preference` VARCHAR(150) NULL DEFAULT NULL,
  `enable_annoc` VARCHAR(150) NULL DEFAULT NULL,
  `commission_type` VARCHAR(150) NULL DEFAULT NULL,
  `commission_fee` VARCHAR(150) NULL DEFAULT NULL,
  `monthlyfee` VARCHAR(150) NULL DEFAULT NULL,
  `quarterlyfee` VARCHAR(150) NULL DEFAULT NULL,
  `yearlyfee` VARCHAR(150) NULL DEFAULT NULL,
  `newupdate` VARCHAR(150) NULL DEFAULT NULL,
  `updated_by` VARCHAR(150) NULL DEFAULT NULL,
  `emailfrom` VARCHAR(150) NULL DEFAULT NULL,
  `emailfromname` VARCHAR(150) NULL DEFAULT NULL,
  `address` VARCHAR(150) NULL DEFAULT NULL,
  `phone` VARCHAR(150) NULL DEFAULT NULL,
  `whatsapp` VARCHAR(150) NULL DEFAULT NULL,
  `tido` VARCHAR(150) NULL DEFAULT NULL,
  `s_currency` VARCHAR(150) NOT NULL DEFAULT 'USD',
  `modules` LONGTEXT NULL,
  `return_capital` TINYINT(1) NOT NULL DEFAULT 0,
  `should_cancel_plan` TINYINT(1) NOT NULL DEFAULT 0,
  `use_transfer` TINYINT(1) NOT NULL DEFAULT 1,
  `otp` BIGINT NOT NULL DEFAULT 0,
  `code1status` BIGINT NOT NULL DEFAULT 0,
  `code2status` BIGINT NOT NULL DEFAULT 0,
  `code3status` BIGINT NOT NULL DEFAULT 0,
  `code1` VARCHAR(150) NULL DEFAULT NULL,
  `code2` VARCHAR(150) NULL DEFAULT NULL,
  `code3` VARCHAR(150) NULL DEFAULT NULL,
  `code1message` LONGTEXT NULL,
  `code2message` LONGTEXT NULL,
  `code3message` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `settings`
INSERT INTO `settings` (`id`, `site_name`, `description`, `currency`, `scurrency`, `bank_name`, `account_name`, `account_number`, `eth_address`, `btc_address`, `ltc_address`, `payment_mode`, `location`, `s_s_k`, `s_p_k`, `pp_cs`, `pp_ci`, `keywords`, `site_title`, `site_address`, `logo`, `favicon`, `website_theme`, `trade_mode`, `weekend_trade`, `google_translate`, `captcha`, `contact_email`, `referral_commission`, `referral_commission1`, `referral_commission2`, `referral_commission3`, `referral_commission4`, `referral_commission5`, `signup_bonus`, `files_key`, `tawk_to`, `enable_2fa`, `enable_kyc`, `enable_with`, `enable_verification`, `withdrawal_option`, `dashboard_option`, `site_preference`, `enable_annoc`, `commission_type`, `commission_fee`, `monthlyfee`, `quarterlyfee`, `yearlyfee`, `newupdate`, `updated_by`, `emailfrom`, `emailfromname`, `address`, `phone`, `whatsapp`, `tido`, `s_currency`, `modules`, `return_capital`, `should_cancel_plan`, `use_transfer`, `otp`, `code1status`, `code2status`, `code3status`, `code1`, `code2`, `code3`, `code1message`, `code2message`, `code3message`, `created_at`, `updated_at`) VALUES (1, 'Mortil Holders', 'Mortil Holders delivers institutional-grade private and commercial digital banking, instant multi-currency settlement, and bespoke lending across 100+ jurisdictions.', '$', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mortil Holders, private banking, commercial treasury, multi-currency accounts, digital banking', 'Mortil Holders — Private & Commercial Digital Banking', 'https://mortilholders.online', 'photos/mortil-logo.svg', 'photos/mortil-icon.svg', 'atlantis.min.css', 'on', 'on', 'on', 'false', 'info@mortilholders.online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'no', 'true', 'false', 'auto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'info@mortilholders.online', 'Mortil Holders', '301 East Water Street, Charlottesville, VA 22904, United States', NULL, NULL, NULL, 'USD', NULL, 0, 0, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-22 22:17:13', '2026-10-22 22:17:13');

-- --------------------------------------------------------
-- Table structure for table `settings_conts`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `settings_conts`;
CREATE TABLE `settings_conts` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `use_crypto_feature` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `settings_conts`
INSERT INTO `settings_conts` (`id`, `use_crypto_feature`, `created_at`, `updated_at`) VALUES (1, 1, '2026-10-22 22:17:13', '2026-10-22 22:17:13');

-- --------------------------------------------------------
-- Table structure for table `tasks`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `note` LONGTEXT NULL,
  `designation` VARCHAR(150) NULL DEFAULT NULL,
  `start_date` DATE NULL DEFAULT NULL,
  `end_date` DATE NULL DEFAULT NULL,
  `priority` VARCHAR(150) NULL DEFAULT NULL,
  `attch` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `terms_privacies`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `terms_privacies`;
CREATE TABLE `terms_privacies` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` LONGTEXT NULL,
  `useterms` VARCHAR(150) NOT NULL DEFAULT 'yes',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `terms_privacies`
INSERT INTO `terms_privacies` (`id`, `description`, `useterms`, `created_at`, `updated_at`) VALUES (1, '<h4>Mortil Holders Privacy &amp; Data Protection Charter</h4><p>Mortil Holders safeguards client records, multi-currency account credentials, and transaction telemetry under bank-grade cryptographic controls and strict regulatory governance.</p><p>We process verified personal and corporate data solely to provision custodial accounts, execute domestic and cross-border settlements, issue payment cards, and underwrite credit facilities. Client data is never sold or shared with unauthorized third parties.</p>', 'yes', '2026-10-22 22:17:13', '2026-10-22 22:17:13');

-- --------------------------------------------------------
-- Table structure for table `testimonies`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `testimonies`;
CREATE TABLE `testimonies` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_key` VARCHAR(150) NULL DEFAULT NULL,
  `position` VARCHAR(150) NULL DEFAULT NULL,
  `name` VARCHAR(150) NULL DEFAULT NULL,
  `what_is_said` VARCHAR(150) NULL DEFAULT NULL,
  `picture` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `tp__transactions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tp__transactions`;
CREATE TABLE `tp__transactions` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `plan` VARCHAR(150) NULL DEFAULT NULL,
  `user` BIGINT NULL DEFAULT NULL,
  `amount` VARCHAR(150) NULL DEFAULT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `upgrades`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `upgrades`;
CREATE TABLE `upgrades` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` BIGINT NULL DEFAULT NULL,
  `times` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `user_plans`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `user_plans`;
CREATE TABLE `user_plans` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `plan` BIGINT NULL DEFAULT NULL,
  `user` BIGINT NULL DEFAULT NULL,
  `amount` VARCHAR(150) NULL DEFAULT NULL,
  `activate` VARCHAR(150) NULL DEFAULT NULL,
  `inv_duration` VARCHAR(150) NULL DEFAULT NULL,
  `expire_date` TIMESTAMP NULL DEFAULT NULL,
  `activated_at` TIMESTAMP NULL DEFAULT NULL,
  `last_growth` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `userlogs`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `userlogs`;
CREATE TABLE `userlogs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` BIGINT NULL DEFAULT NULL,
  `ip` VARCHAR(150) NULL DEFAULT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NULL DEFAULT NULL,
  `username` VARCHAR(150) NULL DEFAULT NULL,
  `lastname` VARCHAR(150) NULL DEFAULT NULL,
  `middlename` VARCHAR(150) NULL DEFAULT NULL,
  `email` VARCHAR(150) NULL DEFAULT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(150) NULL DEFAULT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `address` LONGTEXT NULL,
  `country` VARCHAR(150) NULL DEFAULT NULL,
  `phone` VARCHAR(150) NULL DEFAULT NULL,
  `dashboard_style` VARCHAR(150) NOT NULL DEFAULT 'dark',
  `bank_name` VARCHAR(150) NULL DEFAULT NULL,
  `account_name` VARCHAR(150) NULL DEFAULT NULL,
  `account_number` VARCHAR(150) NULL DEFAULT NULL,
  `account_no` VARCHAR(150) NULL DEFAULT NULL,
  `accounttype` VARCHAR(150) NULL DEFAULT NULL,
  `acnt_type_active` VARCHAR(150) NULL DEFAULT NULL,
  `pin` VARCHAR(150) NULL DEFAULT NULL,
  `pinstatus` BIGINT NOT NULL DEFAULT 0,
  `withdrawotp` VARCHAR(150) NULL DEFAULT NULL,
  `usernumber` VARCHAR(150) NULL DEFAULT NULL,
  `code1` VARCHAR(150) NULL DEFAULT NULL,
  `code2` VARCHAR(150) NULL DEFAULT NULL,
  `code3` VARCHAR(150) NULL DEFAULT NULL,
  `swift_code` VARCHAR(150) NULL DEFAULT NULL,
  `btc_address` VARCHAR(150) NULL DEFAULT NULL,
  `eth_address` VARCHAR(150) NULL DEFAULT NULL,
  `ltc_address` VARCHAR(150) NULL DEFAULT NULL,
  `usdt_address` VARCHAR(150) NULL DEFAULT NULL,
  `plan` VARCHAR(150) NULL DEFAULT NULL,
  `confirmed_plan` VARCHAR(150) NULL DEFAULT NULL,
  `user_plan` VARCHAR(150) NULL DEFAULT NULL,
  `account_bal` BIGINT NOT NULL DEFAULT 0,
  `roi` BIGINT NOT NULL DEFAULT 0,
  `bonus` BIGINT NOT NULL DEFAULT 0,
  `ref_bonus` BIGINT NOT NULL DEFAULT 0,
  `signup_bonus` VARCHAR(150) NULL DEFAULT NULL,
  `auto_trade` VARCHAR(150) NULL DEFAULT NULL,
  `bonus_released` BIGINT NOT NULL DEFAULT 0,
  `ref_by` VARCHAR(150) NULL DEFAULT NULL,
  `ref_link` VARCHAR(150) NULL DEFAULT NULL,
  `id_card` VARCHAR(150) NULL DEFAULT NULL,
  `passport` VARCHAR(150) NULL DEFAULT NULL,
  `account_verify` VARCHAR(150) NULL DEFAULT NULL,
  `assign_to` VARCHAR(150) NULL DEFAULT NULL,
  `transferaction` BIGINT NOT NULL DEFAULT 0,
  `entered_at` TIMESTAMP NULL DEFAULT NULL,
  `activated_at` TIMESTAMP NULL DEFAULT NULL,
  `last_growth` TIMESTAMP NULL DEFAULT NULL,
  `status` VARCHAR(150) NOT NULL DEFAULT 'active',
  `cstatus` VARCHAR(150) NULL DEFAULT NULL,
  `account_status` VARCHAR(150) NULL DEFAULT 'active',
  `trade_mode` VARCHAR(150) NULL DEFAULT NULL,
  `act_session` VARCHAR(150) NULL DEFAULT NULL,
  `remember_token` VARCHAR(150) NULL DEFAULT NULL,
  `current_team_id` BIGINT NULL DEFAULT NULL,
  `profile_photo_path` LONGTEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `two_factor_secret` LONGTEXT NULL,
  `two_factor_recovery_codes` LONGTEXT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `username`, `lastname`, `middlename`, `email`, `email_verified_at`, `password`, `dob`, `address`, `country`, `phone`, `dashboard_style`, `bank_name`, `account_name`, `account_number`, `account_no`, `accounttype`, `acnt_type_active`, `pin`, `pinstatus`, `withdrawotp`, `usernumber`, `code1`, `code2`, `code3`, `swift_code`, `btc_address`, `eth_address`, `ltc_address`, `usdt_address`, `plan`, `confirmed_plan`, `user_plan`, `account_bal`, `roi`, `bonus`, `ref_bonus`, `signup_bonus`, `auto_trade`, `bonus_released`, `ref_by`, `ref_link`, `id_card`, `passport`, `account_verify`, `assign_to`, `transferaction`, `entered_at`, `activated_at`, `last_growth`, `status`, `cstatus`, `account_status`, `trade_mode`, `act_session`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `two_factor_secret`, `two_factor_recovery_codes`) VALUES (1, 'Demo User', 'demouser', NULL, NULL, 'user@mortilholders.online', '2026-10-22 22:17:13', '$2y$10$eAoAPMAo84R0Plk.JfSg7uxj5zpV9PuBBUtLQMIq5gg2qXej8nzlK', NULL, NULL, NULL, NULL, 'dark', NULL, NULL, NULL, NULL, NULL, NULL, '1234', 0, NULL, '84920174632', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25000, 1200, 500, 100, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'Verified', NULL, 0, NULL, NULL, NULL, 'active', NULL, 'active', NULL, NULL, NULL, NULL, NULL, '2026-10-22 22:17:13', '2026-10-22 22:17:13', NULL, NULL);

-- --------------------------------------------------------
-- Table structure for table `wdmethods`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `wdmethods`;
CREATE TABLE `wdmethods` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NULL DEFAULT NULL,
  `minimum` VARCHAR(150) NULL DEFAULT NULL,
  `maximum` VARCHAR(150) NULL DEFAULT NULL,
  `charges_fixed` VARCHAR(150) NULL DEFAULT NULL,
  `charges_percentage` VARCHAR(150) NULL DEFAULT NULL,
  `duration` VARCHAR(150) NULL DEFAULT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `withdrawals`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE `withdrawals` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `txn_id` VARCHAR(150) NULL DEFAULT NULL,
  `user` BIGINT NULL DEFAULT NULL,
  `uname` VARCHAR(150) NULL DEFAULT NULL,
  `amount` VARCHAR(150) NULL DEFAULT NULL,
  `to_deduct` VARCHAR(150) NULL DEFAULT NULL,
  `status` VARCHAR(150) NULL DEFAULT NULL,
  `payment_mode` VARCHAR(150) NULL DEFAULT NULL,
  `paydetails` LONGTEXT NULL,
  `type` VARCHAR(150) NULL DEFAULT NULL,
  `date` VARCHAR(150) NULL DEFAULT NULL,
  `bal` VARCHAR(150) NULL DEFAULT NULL,
  `Description` LONGTEXT NULL,
  `accountname` VARCHAR(150) NULL DEFAULT NULL,
  `accountnumber` VARCHAR(150) NULL DEFAULT NULL,
  `bankname` VARCHAR(150) NULL DEFAULT NULL,
  `Accounttype` VARCHAR(150) NULL DEFAULT NULL,
  `bankaddress` LONGTEXT NULL,
  `country` VARCHAR(150) NULL DEFAULT NULL,
  `swiftcode` VARCHAR(150) NULL DEFAULT NULL,
  `iban` VARCHAR(150) NULL DEFAULT NULL,
  `crypto_currency` VARCHAR(150) NULL DEFAULT NULL,
  `crypto_network` VARCHAR(150) NULL DEFAULT NULL,
  `wallet_address` VARCHAR(150) NULL DEFAULT NULL,
  `paypal_email` VARCHAR(150) NULL DEFAULT NULL,
  `wise_fullname` VARCHAR(150) NULL DEFAULT NULL,
  `wise_email` VARCHAR(150) NULL DEFAULT NULL,
  `wise_country` VARCHAR(150) NULL DEFAULT NULL,
  `skrill_email` VARCHAR(150) NULL DEFAULT NULL,
  `skrill_fullname` VARCHAR(150) NULL DEFAULT NULL,
  `venmo_username` VARCHAR(150) NULL DEFAULT NULL,
  `venmo_phone` VARCHAR(150) NULL DEFAULT NULL,
  `zelle_email` VARCHAR(150) NULL DEFAULT NULL,
  `zelle_phone` VARCHAR(150) NULL DEFAULT NULL,
  `zelle_name` VARCHAR(150) NULL DEFAULT NULL,
  `cash_app_tag` VARCHAR(150) NULL DEFAULT NULL,
  `cash_app_fullname` VARCHAR(150) NULL DEFAULT NULL,
  `revolut_fullname` VARCHAR(150) NULL DEFAULT NULL,
  `revolut_email` VARCHAR(150) NULL DEFAULT NULL,
  `revolut_phone` VARCHAR(150) NULL DEFAULT NULL,
  `alipay_id` VARCHAR(150) NULL DEFAULT NULL,
  `alipay_fullname` VARCHAR(150) NULL DEFAULT NULL,
  `wechat_id` VARCHAR(150) NULL DEFAULT NULL,
  `wechat_name` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
