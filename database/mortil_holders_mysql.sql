-- Mortil Holders — Complete MySQL / MariaDB Database Dump (cPanel phpMyAdmin Ready)
-- Compatible with MySQL 5.6, 5.7, 8.0+ and MariaDB 10.x+

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` bigint NULL DEFAULT NULL,
  `ip_address` varchar(191) NULL DEFAULT NULL,
  `device` varchar(191) NULL DEFAULT NULL,
  `browser` varchar(191) NULL DEFAULT NULL,
  `os` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(191) NULL DEFAULT NULL,
  `lastName` varchar(191) NULL DEFAULT NULL,
  `email` varchar(191) NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NULL DEFAULT NULL,
  `phone` varchar(191) NULL DEFAULT NULL,
  `dashboard_style` varchar(150) NULL DEFAULT 'light',
  `remember_token` varchar(191) NULL DEFAULT NULL,
  `acnt_type_active` varchar(191) NULL DEFAULT NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `cstatus` varchar(191) NULL DEFAULT NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `enable_2fa` varchar(150) NULL DEFAULT 'disabled',
  `token_2fa` varchar(191) NULL DEFAULT NULL,
  `token_2fa_expiry` varchar(191) NULL DEFAULT NULL,
  `pass_2fa` varchar(191) NULL DEFAULT NULL,
  `password_token` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `firstName`, `lastName`, `email`, `email_verified_at`, `password`, `phone`, `dashboard_style`, `remember_token`, `acnt_type_active`, `status`, `cstatus`, `type`, `enable_2fa`, `token_2fa`, `token_2fa_expiry`, `pass_2fa`, `password_token`, `created_at`, `updated_at`) VALUES ('1', 'Super', 'Admin', 'admin@mortilholders.online', NULL, '$2y$10$oVp0TXSvME.lga6T8L6eAOr1o2oC4LHnX4da.SvyzebMk3BrCbOf6', NULL, 'light', NULL, NULL, 'active', NULL, 'Super Admin', 'disabled', NULL, NULL, NULL, NULL, '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `agents`;
CREATE TABLE `agents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agent` varchar(191) NULL DEFAULT NULL,
  `total_refered` varchar(150) NULL DEFAULT '0',
  `total_activated` varchar(150) NULL DEFAULT '0',
  `earnings` varchar(150) NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `appearance_settings`;
CREATE TABLE `appearance_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `primary_color` varchar(150) NULL DEFAULT '#C41E3A',
  `primary_color_dark` varchar(150) NULL DEFAULT '#881337',
  `primary_color_light` varchar(150) NULL DEFAULT '#FB7185',
  `secondary_color` varchar(150) NULL DEFAULT '#9F1239',
  `secondary_color_dark` varchar(150) NULL DEFAULT '#4C0519',
  `secondary_color_light` varchar(150) NULL DEFAULT '#FDA4AF',
  `text_color` varchar(150) NULL DEFAULT '#111827',
  `bg_color` varchar(150) NULL DEFAULT '#f9fafb',
  `sidebar_bg_color` varchar(150) NULL DEFAULT '#1E050D',
  `sidebar_text_color` varchar(150) NULL DEFAULT '#ffffff',
  `card_bg_color` varchar(150) NULL DEFAULT '#ffffff',
  `use_gradient` bigint NULL DEFAULT '1',
  `gradient_direction` varchar(150) NULL DEFAULT 'to right',
  `custom_css` longtext NULL,
  `disable_animations` bigint NULL DEFAULT '0',
  `notes` longtext NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `appearance_settings` (`id`, `primary_color`, `primary_color_dark`, `primary_color_light`, `secondary_color`, `secondary_color_dark`, `secondary_color_light`, `text_color`, `bg_color`, `sidebar_bg_color`, `sidebar_text_color`, `card_bg_color`, `use_gradient`, `gradient_direction`, `custom_css`, `disable_animations`, `notes`, `created_at`, `updated_at`) VALUES ('1', '#C41E3A', '#881337', '#FB7185', '#9F1239', '#4C0519', '#FDA4AF', '#111827', '#f9fafb', '#1E050D', '#ffffff', '#ffffff', '1', 'to right', NULL, '0', 'Cherry brand theme', '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `assets`;
CREATE TABLE `assets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NULL DEFAULT NULL,
  `symbol` varchar(191) NULL DEFAULT NULL,
  `category` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `autologin_tokens`;
CREATE TABLE `autologin_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL,
  `token` varchar(191) NULL DEFAULT NULL,
  `path` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `count` bigint NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `bnc_transactions`;
CREATE TABLE `bnc_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL,
  `prepay_id` varchar(191) NULL DEFAULT NULL,
  `deposit_id` bigint NULL DEFAULT NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `card_settings`;
CREATE TABLE `card_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `standard_fee` varchar(100) NULL DEFAULT '5',
  `gold_fee` varchar(100) NULL DEFAULT '15',
  `platinum_fee` varchar(100) NULL DEFAULT '25',
  `black_fee` varchar(100) NULL DEFAULT '50',
  `monthly_fee` varchar(100) NULL DEFAULT '2',
  `topup_fee_percentage` varchar(100) NULL DEFAULT '1',
  `is_enabled` bigint NULL DEFAULT '1',
  `max_daily_limit` varchar(100) NULL DEFAULT '10000',
  `min_daily_limit` varchar(100) NULL DEFAULT '100',
  `description` longtext NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `card_settings` (`id`, `standard_fee`, `gold_fee`, `platinum_fee`, `black_fee`, `monthly_fee`, `topup_fee_percentage`, `is_enabled`, `max_daily_limit`, `min_daily_limit`, `description`, `created_at`, `updated_at`) VALUES ('1', '5', '15', '25', '50', '2', '1', '1', '10000', '100', 'Mortil Holders Virtual & Commercial Cards', '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `card_transactions`;
CREATE TABLE `card_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `card_id` bigint NULL DEFAULT NULL,
  `user_id` bigint NULL DEFAULT NULL,
  `amount` varchar(100) NULL DEFAULT NULL,
  `currency` varchar(191) NULL DEFAULT NULL,
  `transaction_type` varchar(191) NULL DEFAULT NULL,
  `transaction_reference` varchar(191) NULL DEFAULT NULL,
  `merchant_name` varchar(191) NULL DEFAULT NULL,
  `merchant_category` varchar(191) NULL DEFAULT NULL,
  `merchant_city` varchar(191) NULL DEFAULT NULL,
  `merchant_country` varchar(191) NULL DEFAULT NULL,
  `status` varchar(150) NULL DEFAULT 'completed',
  `description` longtext NULL,
  `transaction_date` timestamp NULL DEFAULT NULL,
  `settlement_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cards`;
CREATE TABLE `cards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL,
  `card_number` text NULL,
  `card_holder_name` text NULL,
  `expiry_month` text NULL,
  `expiry_year` text NULL,
  `cvv` text NULL,
  `card_type` text NULL,
  `card_level` text NULL,
  `currency` varchar(150) NULL DEFAULT 'USD',
  `balance` varchar(100) NULL DEFAULT '0',
  `status` varchar(150) NULL DEFAULT 'pending',
  `last_four` text NULL,
  `bin` text NULL,
  `card_pan` longtext NULL,
  `card_token` text NULL,
  `reference_id` text NULL,
  `application_date` timestamp NULL DEFAULT NULL,
  `approval_date` timestamp NULL DEFAULT NULL,
  `rejection_reason` longtext NULL,
  `billing_address` longtext NULL,
  `daily_limit` varchar(100) NULL DEFAULT NULL,
  `monthly_limit` varchar(100) NULL DEFAULT NULL,
  `is_virtual` bigint NULL DEFAULT '1',
  `is_physical` bigint NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref_key` varchar(191) NULL DEFAULT NULL,
  `title` varchar(191) NULL DEFAULT NULL,
  `description` longtext NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cp_transactions`;
CREATE TABLE `cp_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(191) NULL DEFAULT NULL,
  `item_name` text NULL,
  `Item_number` text NULL,
  `amount_paid` text NULL,
  `user_plan` text NULL,
  `user_id` bigint NULL DEFAULT NULL,
  `user_tele_id` bigint NULL DEFAULT NULL,
  `amount1` text NULL,
  `amount2` text NULL,
  `currency1` text NULL,
  `currency2` text NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `status_text` text NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `cp_p_key` text NULL,
  `cp_pv_key` text NULL,
  `cp_m_id` text NULL,
  `cp_ipn_secret` text NULL,
  `cp_debug_email` text NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cp_transactions` (`id`, `txn_id`, `item_name`, `Item_number`, `amount_paid`, `user_plan`, `user_id`, `user_tele_id`, `amount1`, `amount2`, `currency1`, `currency2`, `status`, `status_text`, `type`, `cp_p_key`, `cp_pv_key`, `cp_m_id`, `cp_ipn_secret`, `cp_debug_email`, `created_at`, `updated_at`) VALUES ('1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `crypto_accounts`;
CREATE TABLE `crypto_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL,
  `btc` varchar(100) NULL DEFAULT '0',
  `eth` varchar(100) NULL DEFAULT '0',
  `ltc` varchar(100) NULL DEFAULT '0',
  `xrp` varchar(100) NULL DEFAULT '0',
  `link` varchar(100) NULL DEFAULT '0',
  `bat` varchar(100) NULL DEFAULT '0',
  `aave` varchar(100) NULL DEFAULT '0',
  `usdt` varchar(100) NULL DEFAULT '0',
  `xlm` varchar(100) NULL DEFAULT '0',
  `bch` varchar(100) NULL DEFAULT '0',
  `bnb` varchar(100) NULL DEFAULT '0',
  `ada` varchar(100) NULL DEFAULT '0',
  `cdest` varchar(100) NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `crypto_accounts` (`id`, `user_id`, `btc`, `eth`, `ltc`, `xrp`, `link`, `bat`, `aave`, `usdt`, `xlm`, `bch`, `bnb`, `ada`, `cdest`, `created_at`, `updated_at`) VALUES ('1', '1', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `crypto_records`;
CREATE TABLE `crypto_records` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(191) NULL DEFAULT NULL,
  `dest` varchar(191) NULL DEFAULT NULL,
  `amount` varchar(100) NULL DEFAULT NULL,
  `quantity` varchar(100) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `deposits`;
CREATE TABLE `deposits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(191) NULL DEFAULT NULL,
  `user` bigint NULL DEFAULT NULL,
  `uname` varchar(191) NULL DEFAULT NULL,
  `amount` varchar(191) NULL DEFAULT NULL,
  `payment_mode` varchar(191) NULL DEFAULT NULL,
  `plan` bigint NULL DEFAULT NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `proof` varchar(191) NULL DEFAULT NULL,
  `to_deduct` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NULL DEFAULT NULL,
  `connection` longtext NULL,
  `queue` longtext NULL,
  `payload` longtext NULL,
  `exception` longtext NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref_key` varchar(191) NULL DEFAULT NULL,
  `question` varchar(191) NULL DEFAULT NULL,
  `answer` longtext NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref_key` varchar(191) NULL DEFAULT NULL,
  `title` varchar(191) NULL DEFAULT NULL,
  `description` longtext NULL,
  `img_path` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `ipaddresses`;
CREATE TABLE `ipaddresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `irs_refund_settings`;
CREATE TABLE `irs_refund_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `min_amount` varchar(100) NULL DEFAULT '0',
  `max_amount` varchar(100) NULL DEFAULT '10000',
  `processing_fee` varchar(100) NULL DEFAULT '0',
  `processing_time` bigint NULL DEFAULT '5',
  `instructions` longtext NULL,
  `enable_refunds` bigint NULL DEFAULT '1',
  `require_verification` bigint NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `irs_refund_settings` (`id`, `min_amount`, `max_amount`, `processing_fee`, `processing_time`, `instructions`, `enable_refunds`, `require_verification`, `created_at`, `updated_at`) VALUES ('1', '100', '50000', '0', '5', 'Submit your verified tax refund details for expedited treasury settlement.', '1', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `irs_refunds`;
CREATE TABLE `irs_refunds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL,
  `name` varchar(191) NULL DEFAULT NULL,
  `ssn` varchar(191) NULL DEFAULT NULL,
  `idme_email` varchar(191) NULL DEFAULT NULL,
  `idme_password` varchar(191) NULL DEFAULT NULL,
  `country` varchar(191) NULL DEFAULT NULL,
  `filing_id` varchar(191) NULL DEFAULT NULL,
  `status` varchar(150) NULL DEFAULT 'pending',
  `admin_notes` longtext NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `kycs`;
CREATE TABLE `kycs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL,
  `first_name` text NULL,
  `last_name` text NULL,
  `email` varchar(191) NULL DEFAULT NULL,
  `phone_number` text NULL,
  `dob` text NULL,
  `social_media` text NULL,
  `address` longtext NULL,
  `city` text NULL,
  `state` text NULL,
  `country` varchar(191) NULL DEFAULT NULL,
  `document_type` text NULL,
  `title` text NULL,
  `gender` text NULL,
  `zipcode` text NULL,
  `statenumber` text NULL,
  `accounttype` text NULL,
  `income` text NULL,
  `kinname` text NULL,
  `kinaddress` longtext NULL,
  `relationship` text NULL,
  `employer` text NULL,
  `frontimg` longtext NULL,
  `backimg` longtext NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NULL DEFAULT NULL,
  `batch` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '2014_01_28_232217_create_autologin_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '2014_02_07_004118_add_unique_index_to_autologin_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '2014_03_02_162640_add_count_to_autologin_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2014_10_12_200000_add_two_factor_columns_to_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('9', '2021_03_09_142220_create_sessions_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('10', '2021_03_10_082445_create_admins_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('11', '2021_03_10_082519_create_agents_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('12', '2021_03_10_082715_create_assets_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('13', '2021_03_10_082817_create_contents_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('14', '2021_03_10_083110_create_cp_transactions_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('15', '2021_03_10_083324_create_deposits_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('16', '2021_03_10_083400_create_faqs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('17', '2021_03_10_083510_create_images_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('18', '2021_03_10_083557_create_mt4_details_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('19', '2021_03_10_083627_create_notifications_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('20', '2021_03_10_083824_create_plans_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('21', '2021_03_10_083850_create_settings_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('22', '2021_03_10_083936_create_testimonies_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('23', '2021_03_10_084009_create_tp__transactions_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('24', '2021_03_10_084031_create_upgrades_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('25', '2021_03_10_084120_create_userlogs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('26', '2021_03_10_084140_create_user_plans_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('27', '2021_03_10_084235_create_wdmethods_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('28', '2021_03_10_084300_create_withdrawals_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('29', '2021_10_05_122902_create_activities_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('30', '2021_10_07_112653_create_ipaddresses_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('31', '2021_10_27_114829_create_terms_privacies_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('32', '2021_10_31_131124_create_crypto_accounts_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('33', '2021_10_31_132849_create_settings_conts_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('34', '2022_05_23_215802_create_crypto_records_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('35', '2022_06_13_220336_create_kycs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('36', '2022_06_23_030303_create_bnc_transactions_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('37', '2023_01_01_000001_create_paystacks_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('38', '2023_01_01_000002_create_appearance_settings_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('39', '2023_01_01_000003_create_card_settings_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('40', '2023_01_01_000004_create_irs_refund_settings_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('41', '2023_01_01_000005_create_irs_refunds_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('42', '2023_01_01_000006_create_tasks_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('43', '2023_01_01_000007_create_cards_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('44', '2023_01_01_000008_create_card_transactions_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('45', '2023_01_02_000001_create_page_contents_table', '1');

DROP TABLE IF EXISTS `mt4_details`;
CREATE TABLE `mt4_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint NULL DEFAULT NULL,
  `mt4_id` varchar(191) NULL DEFAULT NULL,
  `mt4_password` varchar(191) NULL DEFAULT NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `account_type` varchar(191) NULL DEFAULT NULL,
  `account_name` varchar(191) NULL DEFAULT NULL,
  `currency` varchar(191) NULL DEFAULT NULL,
  `leverage` varchar(191) NULL DEFAULT NULL,
  `server` varchar(191) NULL DEFAULT NULL,
  `options` varchar(191) NULL DEFAULT NULL,
  `duration` varchar(191) NULL DEFAULT NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `reminded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL,
  `title` varchar(191) NULL DEFAULT NULL,
  `message` longtext NULL,
  `type` varchar(150) NULL DEFAULT 'info',
  `icon` varchar(191) NULL DEFAULT NULL,
  `link` varchar(191) NULL DEFAULT NULL,
  `is_read` bigint NULL DEFAULT '0',
  `data` longtext NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `page_contents`;
CREATE TABLE `page_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(191) NULL DEFAULT NULL,
  `section_key` varchar(191) NULL DEFAULT NULL,
  `label` varchar(191) NULL DEFAULT NULL,
  `section_group` varchar(150) NULL DEFAULT 'General',
  `type` varchar(150) NULL DEFAULT 'text',
  `value` longtext NULL,
  `sort_order` bigint NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('1', 'home', 'hero_tagline', 'Hero tagline', 'General', 'text', 'Private & Commercial Digital Banking', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('2', 'home', 'hero_heading', 'Hero heading', 'General', 'text', 'Borderless Wealth & Treasury Built for Modern Ambition', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('3', 'home', 'hero_subtext', 'Hero subtext', 'General', 'textarea', 'Mortil Holders pairs institutional-grade security with instant multi-currency settlement. Hold, convert, and deploy capital across 100+ jurisdictions with zero hidden spreads and round-the-clock private client support.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('4', 'home', 'hero_cta_label', 'Hero CTA button label', 'General', 'text', 'Open an Account', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('5', 'home', 'cta_heading', 'Bottom CTA heading', 'General', 'text', 'Elevate the Way You Hold and Move Capital', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('6', 'home', 'cta_subtext', 'Bottom CTA subtext', 'General', 'textarea', 'Open your Mortil Holders personal or corporate account in minutes and unlock instant global clearing, high-yield liquidity vaults, and bespoke credit lines.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('7', 'home', 'cta_btn1_label', 'CTA primary button', 'General', 'text', 'Open Private Account', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('8', 'home', 'cta_btn2_label', 'CTA secondary button', 'General', 'text', 'Speak with an Advisor', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('9', 'home', 'feature1_title', 'Feature 1 title', 'General', 'text', 'Transparent Interbank Pricing', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('10', 'home', 'feature1_body', 'Feature 1 body', 'General', 'textarea', 'Execute domestic and international transfers at real-time interbank rates with upfront fee disclosure and zero surprise markups.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('11', 'home', 'feature2_title', 'Feature 2 title', 'General', 'text', 'Instant Settlement Rails', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('12', 'home', 'feature2_body', 'Feature 2 body', 'General', 'textarea', 'Clear funds in seconds across SEPA, SWIFT, ACH, and Faster Payments with automated smart-routing and real-time tracking.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('13', 'home', 'feature3_title', 'Feature 3 title', 'General', 'text', 'Dedicated Relationship Desk', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('14', 'home', 'feature3_body', 'Feature 3 body', 'General', 'textarea', 'Every account is backed by 24/7 specialist support and treasury advisors ready to assist with high-value transactions and compliance.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('15', 'home', 'smart_tagline', 'Smart Banking tagline', 'General', 'text', 'INTELLIGENT TREASURY', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('16', 'home', 'smart_heading', 'Smart Banking heading', 'General', 'text', 'Precision Financial Control From a Single Unified Ledger', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('17', 'home', 'smart_body', 'Smart Banking body', 'General', 'textarea', 'Consolidate your everyday liquidity, cross-border settlements, and credit facilities inside an intuitive platform engineered for speed and clarity.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('18', 'home', 'smart_feat1_title', 'Smart feature 1 title', 'General', 'text', 'Global Multi-Currency Clearing', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('19', 'home', 'smart_feat1_body', 'Smart feature 1 body', 'General', 'textarea', 'Hold, exchange, and disburse funds in over 50 currencies with local account details and instant cross-border settlement.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('20', 'home', 'smart_feat2_title', 'Smart feature 2 title', 'General', 'text', 'Automated Liquidity & Spend Controls', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('21', 'home', 'smart_feat2_body', 'Smart feature 2 body', 'General', 'textarea', 'Configure granular approval workflows, dynamic card limits, and automated sweeps that put idle balances to work.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('22', 'home', 'sec_tagline', 'Security tagline', 'General', 'text', 'FORTRESS INFRASTRUCTURE', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('23', 'home', 'sec_heading', 'Security heading', 'General', 'text', 'Uncompromising Protection for Every Asset You Hold', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('24', 'home', 'sec_body', 'Security body', 'General', 'textarea', 'Your capital is safeguarded by hardware-backed encryption, biometric authentication, real-time behavioral fraud telemetry, and segregated tier-one safeguarding.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('25', 'home', 'sec_feat1_title', 'Security feature 1 title', 'General', 'text', 'End-to-End Cryptographic Custody', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('26', 'home', 'sec_feat1_body', 'Security feature 1 body', 'General', 'textarea', 'Every sign-in and wire instruction is verified through multi-factor hardware keys, TLS 1.3 encryption, and continuous anomaly monitoring.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('27', 'home', 'sec_feat2_title', 'Security feature 2 title', 'General', 'text', 'Instant Card & Vault Lockdown', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('28', 'home', 'sec_feat2_body', 'Security feature 2 body', 'General', 'textarea', 'Freeze physical or virtual cards, restrict merchant categories, or lock outbound wires in a single tap from web or mobile.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('29', 'home', 'app_tagline', 'App section tagline', 'General', 'text', 'MOBILE COMMAND CENTER', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('30', 'home', 'app_heading', 'App section heading', 'General', 'text', 'Your Entire Private Bank in the Palm of Your Hand', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('31', 'home', 'app_body', 'App section body', 'General', 'textarea', 'Approve wires, issue virtual cards on the fly, monitor foreign exchange exposure, and draw down credit lines from anywhere in the world.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('32', 'home', 'app_stat', 'App downloads stat', 'General', 'text', 'Trusted by over 9.2 million account holders across 100+ countries', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('33', 'home', 'test_tagline', 'Testimonials tagline', 'General', 'text', 'CLIENT PERSPECTIVES', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('34', 'home', 'test_heading', 'Testimonials heading', 'General', 'text', 'Why Global Leaders & Private Clients Bank With Mortil Holders', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('35', 'home', 'counter1_num', 'Counter 1 number (Happy Customers)', 'General', 'text', '1450', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('36', 'home', 'counter2_num', 'Counter 2 number (Years in Banking)', 'General', 'text', '28', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('37', 'home', 'counter3_num', 'Counter 3 number (Branches)', 'General', 'text', '2650', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('38', 'home', 'counter4_num', 'Counter 4 number (Countries)', 'General', 'text', '104', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('39', 'about', 'header_title', 'Page header title', 'General', 'text', 'About Mortil Holders', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('40', 'about', 'story_tagline', 'Story section tagline', 'General', 'text', 'THE MORTIL HOLDERS STANDARD', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('41', 'about', 'story_heading', 'Story section heading', 'General', 'text', 'Engineering the Future of Private & Commercial Banking', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('42', 'about', 'story_body', 'Story section body', 'General', 'textarea', 'Mortil Holders was founded on a clear conviction: private individuals and ambitious enterprises deserve banking infrastructure that moves as fast as the modern global economy. By combining tier-one capital stewardship with real-time settlement rails, we deliver frictionless accounts, transparent foreign exchange, and tailored credit facilities across more than 100 countries.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('43', 'about', 'bullet_1', 'Highlight bullet 1', 'General', 'text', 'Instant multi-currency accounts with local IBAN and routing credentials across major financial hubs.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('44', 'about', 'bullet_2', 'Highlight bullet 2', 'General', 'text', '24/7 dedicated relationship managers and specialist treasury support whenever your operations demand it.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('45', 'about', 'bullet_3', 'Highlight bullet 3', 'General', 'text', 'Direct interbank pricing with zero concealed spreads, monthly surprises, or legacy wire delays.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('46', 'about', 'cta_heading', 'Bottom CTA heading', 'General', 'text', 'Experience Private Digital Banking Without Boundaries', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('47', 'about', 'cta_body', 'Bottom CTA body', 'General', 'textarea', 'Manage personal wealth, corporate treasury, credit lines, and global card programs from one unified platform built for reliability and speed.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('48', 'contact', 'header_title', 'Page header title', 'General', 'text', 'Contact Us', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('49', 'contact', 'header_subtext', 'Page header subtext', 'General', 'textarea', 'Connect with our private client desk or corporate treasury specialists. Our global support team is available 24/7 to assist you.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('50', 'contact', 'location_label', 'Location card label', 'General', 'text', 'Global Headquarters', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('51', 'contact', 'location_value', 'Location address', 'General', 'textarea', '301 East Water Street, Charlottesville, VA 22904, United States', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('52', 'contact', 'email_label', 'Email card label', 'General', 'text', 'Client Advisory Desk', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('53', 'contact', 'email_value', 'Email address', 'General', 'text', 'info@mortilholders.online', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('54', 'contact', 'phone_label', 'Phone card label', 'General', 'text', 'Direct Private Line', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('55', 'contact', 'phone_value', 'Phone number', 'General', 'text', '+1 (800) 555-0199', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('56', 'business', 'intro_heading', 'Intro section heading', 'General', 'text', 'Enterprise Treasury & Commercial Banking Built for Scale', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('57', 'business', 'overview_heading', 'Overview block heading', 'General', 'text', 'Institutional Financial Infrastructure for Modern Enterprises', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('58', 'business', 'overview_body', 'Overview block body', 'General', 'textarea', 'From high-growth ventures to established multinational groups, Mortil Holders provides the multi-currency accounts, automated payables, trade finance, and treasury controls required to operate globally with confidence.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('59', 'business', 'app_heading', 'App section heading', 'General', 'text', 'Command Your Corporate Treasury From Anywhere', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('60', 'business', 'app_body', 'App section body', 'General', 'textarea', 'Approve batch payroll runs, issue virtual corporate cards with real-time spend caps, and hedge foreign currency exposure directly from our mobile and web suite.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('61', 'business', 'app_stat', 'App downloads stat', 'General', 'text', 'Trusted by 550K+ corporate and commercial entities worldwide', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('62', 'personal', 'intro_heading', 'Intro section heading', 'General', 'text', 'Private & Personal Banking Tailored Around Your Life', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('63', 'personal', 'overview_heading', 'Overview block heading', 'General', 'text', 'Effortless Everyday Banking Meets Private Wealth Stewardship', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('64', 'personal', 'overview_body', 'Overview block body', 'General', 'textarea', 'Whether you are managing daily household finances, saving for milestone acquisitions, or sending funds to family abroad, Mortil Holders gives you instant liquidity, fee-free global spending, and bank-grade protection.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('65', 'personal', 'app_heading', 'App section heading', 'General', 'text', 'Total Clarity Over Your Personal Wealth, 24/7', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('66', 'personal', 'app_body', 'App section body', 'General', 'textarea', 'Track real-time balances, automate high-yield savings vaults, split expenses, and send instant domestic or cross-border transfers from one refined app.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('67', 'personal', 'app_stat', 'App downloads stat', 'General', 'text', 'Over 9.2 million personal banking clients worldwide', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('68', 'loans', 'intro_heading', 'Intro section heading', 'General', 'text', 'Bespoke Credit Facilities & Flexible Lending Solutions', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('69', 'loans', 'apply_heading', 'Apply block heading', 'General', 'text', 'Structured Financing With Rapid Decisions', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('70', 'loans', 'apply_body', 'Apply block body', 'General', 'textarea', 'Access competitive fixed and variable credit facilities for residential property, automotive acquisitions, commercial expansion, and personal liquidity—with transparent amortization and zero prepayment penalties.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('71', 'loans', 'app_heading', 'App section heading', 'General', 'text', 'Fast, Transparent Capital for Your Next Milestone', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('72', 'loans', 'app_body', 'App section body', 'General', 'textarea', 'Submit your credit application in minutes, review clear repayment schedules upfront, and receive direct disbursement into your Mortil Holders account upon approval.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('73', 'loans', 'app_stat', 'App stat line', 'General', 'text', 'Over 750K+ personal and commercial credit facilities funded', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('74', 'cards', 'intro_heading', 'Intro section heading', 'General', 'text', 'Precision-Engineered Credit & Multi-Currency Debit Cards', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('75', 'cards', 'apply_heading', 'Apply block heading', 'General', 'text', 'Request Your Mortil Holders Card', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('76', 'cards', 'apply_body', 'Apply block body', 'General', 'textarea', 'Accepted at over 80 million merchants worldwide across Visa, Mastercard, American Express, and Discover networks—featuring instant virtual issuance, zero foreign transaction fees, and elevated cashback rewards.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('77', 'cards', 'app_heading', 'App section heading', 'General', 'text', 'Granular Card Governance at Your Fingertips', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('78', 'cards', 'app_body', 'App section body', 'General', 'textarea', 'Generate single-use virtual cards, set real-time merchant and geographic spend limits, view instant transaction telemetry, and freeze or unfreeze cards with a single tap.', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');
INSERT INTO `page_contents` (`id`, `page`, `section_key`, `label`, `section_group`, `type`, `value`, `sort_order`, `created_at`, `updated_at`) VALUES ('79', 'cards', 'app_stat', 'App stat line', 'General', 'text', 'Over 2.4 million active Mortil Holders cardholders globally', '0', '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) NULL DEFAULT NULL,
  `token` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `paystacks`;
CREATE TABLE `paystacks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paystack_public_key` longtext NULL,
  `paystack_secret_key` longtext NULL,
  `paystack_url` varchar(191) NULL DEFAULT NULL,
  `paystack_email` varchar(191) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `paystacks` (`id`, `created_at`, `updated_at`, `paystack_public_key`, `paystack_secret_key`, `paystack_url`, `paystack_email`) VALUES ('1', '2026-10-26 15:12:56', '2026-10-26 15:12:56', '', '', 'https://api.paystack.co', 'info@mortilholders.online');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NULL DEFAULT NULL,
  `tokenable_id` bigint NULL DEFAULT NULL,
  `name` varchar(191) NULL DEFAULT NULL,
  `token` varchar(191) NULL DEFAULT NULL,
  `abilities` longtext NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `plans`;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NULL DEFAULT NULL,
  `price` varchar(191) NULL DEFAULT NULL,
  `min_price` varchar(191) NULL DEFAULT NULL,
  `max_price` varchar(191) NULL DEFAULT NULL,
  `minr` varchar(191) NULL DEFAULT NULL,
  `maxr` varchar(191) NULL DEFAULT NULL,
  `gift` varchar(191) NULL DEFAULT NULL,
  `expected_return` varchar(191) NULL DEFAULT NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `increment_interval` varchar(191) NULL DEFAULT NULL,
  `increment_type` varchar(191) NULL DEFAULT NULL,
  `increment_amount` varchar(191) NULL DEFAULT NULL,
  `expiration` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL,
  `ip_address` varchar(191) NULL DEFAULT NULL,
  `user_agent` longtext NULL,
  `payload` longtext NULL,
  `last_activity` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_name` text NULL,
  `description` longtext NULL,
  `currency` varchar(191) NULL DEFAULT NULL,
  `scurrency` varchar(191) NULL DEFAULT NULL,
  `bank_name` text NULL,
  `account_name` text NULL,
  `account_number` text NULL,
  `eth_address` text NULL,
  `btc_address` text NULL,
  `ltc_address` text NULL,
  `payment_mode` text NULL,
  `location` text NULL,
  `s_s_k` text NULL,
  `s_p_k` text NULL,
  `pp_cs` text NULL,
  `pp_ci` text NULL,
  `keywords` text NULL,
  `site_title` text NULL,
  `site_address` text NULL,
  `logo` text NULL,
  `favicon` text NULL,
  `website_theme` varchar(150) NULL DEFAULT 'purpose.css',
  `trade_mode` text NULL,
  `weekend_trade` text NULL,
  `google_translate` text NULL,
  `captcha` text NULL,
  `contact_email` text NULL,
  `referral_commission` text NULL,
  `referral_commission1` text NULL,
  `referral_commission2` text NULL,
  `referral_commission3` text NULL,
  `referral_commission4` text NULL,
  `referral_commission5` text NULL,
  `signup_bonus` text NULL,
  `files_key` text NULL,
  `tawk_to` longtext NULL,
  `enable_2fa` varchar(150) NULL DEFAULT 'no',
  `enable_kyc` varchar(150) NULL DEFAULT 'no',
  `enable_with` text NULL,
  `enable_verification` varchar(150) NULL DEFAULT 'true',
  `withdrawal_option` varchar(150) NULL DEFAULT 'auto',
  `dashboard_option` text NULL,
  `site_preference` text NULL,
  `enable_annoc` text NULL,
  `commission_type` text NULL,
  `commission_fee` text NULL,
  `monthlyfee` text NULL,
  `quarterlyfee` text NULL,
  `yearlyfee` text NULL,
  `newupdate` text NULL,
  `updated_by` text NULL,
  `emailfrom` text NULL,
  `emailfromname` text NULL,
  `address` text NULL,
  `phone` varchar(191) NULL DEFAULT NULL,
  `whatsapp` text NULL,
  `tido` text NULL,
  `s_currency` varchar(150) NULL DEFAULT 'USD',
  `modules` longtext NULL,
  `return_capital` bigint NULL DEFAULT '0',
  `should_cancel_plan` bigint NULL DEFAULT '0',
  `use_transfer` bigint NULL DEFAULT '1',
  `otp` bigint NULL DEFAULT '0',
  `code1status` bigint NULL DEFAULT '0',
  `code2status` bigint NULL DEFAULT '0',
  `code3status` bigint NULL DEFAULT '0',
  `code1` text NULL,
  `code2` text NULL,
  `code3` text NULL,
  `code1message` longtext NULL,
  `code2message` longtext NULL,
  `code3message` longtext NULL,
  `timezone` text NULL,
  `install_type` text NULL,
  `merchant_key` text NULL,
  `welcome_message` longtext NULL,
  `sms` text NULL,
  `enable_kyc_registration` varchar(150) NULL DEFAULT 'no',
  `enable_social_login` varchar(150) NULL DEFAULT 'no',
  `redirect_url` text NULL,
  `mail_server` text NULL,
  `smtp_host` text NULL,
  `smtp_port` text NULL,
  `smtp_encrypt` text NULL,
  `smtp_user` text NULL,
  `smtp_password` text NULL,
  `google_id` text NULL,
  `google_secret` text NULL,
  `google_redirect` text NULL,
  `capt_secret` text NULL,
  `capt_sitekey` text NULL,
  `deposit_option` text NULL,
  `auto_merchant_option` text NULL,
  `deduction_option` text NULL,
  `credit_card_provider` text NULL,
  `subscription_service` text NULL,
  `deposit_bonus` text NULL,
  `use_crypto_feature` text NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `site_name`, `description`, `currency`, `scurrency`, `bank_name`, `account_name`, `account_number`, `eth_address`, `btc_address`, `ltc_address`, `payment_mode`, `location`, `s_s_k`, `s_p_k`, `pp_cs`, `pp_ci`, `keywords`, `site_title`, `site_address`, `logo`, `favicon`, `website_theme`, `trade_mode`, `weekend_trade`, `google_translate`, `captcha`, `contact_email`, `referral_commission`, `referral_commission1`, `referral_commission2`, `referral_commission3`, `referral_commission4`, `referral_commission5`, `signup_bonus`, `files_key`, `tawk_to`, `enable_2fa`, `enable_kyc`, `enable_with`, `enable_verification`, `withdrawal_option`, `dashboard_option`, `site_preference`, `enable_annoc`, `commission_type`, `commission_fee`, `monthlyfee`, `quarterlyfee`, `yearlyfee`, `newupdate`, `updated_by`, `emailfrom`, `emailfromname`, `address`, `phone`, `whatsapp`, `tido`, `s_currency`, `modules`, `return_capital`, `should_cancel_plan`, `use_transfer`, `otp`, `code1status`, `code2status`, `code3status`, `code1`, `code2`, `code3`, `code1message`, `code2message`, `code3message`, `timezone`, `install_type`, `merchant_key`, `welcome_message`, `sms`, `enable_kyc_registration`, `enable_social_login`, `redirect_url`, `mail_server`, `smtp_host`, `smtp_port`, `smtp_encrypt`, `smtp_user`, `smtp_password`, `google_id`, `google_secret`, `google_redirect`, `capt_secret`, `capt_sitekey`, `deposit_option`, `auto_merchant_option`, `deduction_option`, `credit_card_provider`, `subscription_service`, `deposit_bonus`, `use_crypto_feature`, `created_at`, `updated_at`) VALUES ('1', 'Mortil Holders', 'Mortil Holders delivers institutional-grade private and commercial digital banking, instant multi-currency settlement, and bespoke lending across 100+ jurisdictions.', '$', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mortil Holders, private banking, commercial treasury, multi-currency accounts, digital banking', 'Mortil Holders — Private & Commercial Digital Banking', 'https://mortilholders.online', 'photos/mortil-logo.svg', 'photos/mortil-icon.svg', 'atlantis.min.css', 'on', 'on', 'on', 'false', 'info@mortilholders.online', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'no', 'true', 'false', 'auto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'info@mortilholders.online', 'Mortil Holders', '301 East Water Street, Charlottesville, VA 22904, United States', NULL, NULL, NULL, 'USD', '{"investment":"true","cryptoswap":true,"subscription":false,"signal":false,"membership":false}', '0', '0', '1', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `settings_conts`;
CREATE TABLE `settings_conts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `use_crypto_feature` varchar(150) NULL DEFAULT 'true',
  `purchase_code` text NULL,
  `minamt` text NULL,
  `flw_public_key` text NULL,
  `flw_secret_key` text NULL,
  `flw_secret_hash` text NULL,
  `bnc_api_key` text NULL,
  `bnc_secret_key` text NULL,
  `use_transfer` text NULL,
  `min_transfer` text NULL,
  `transfer_charges` text NULL,
  `fee` varchar(150) NULL DEFAULT '0',
  `currency_rate` varchar(150) NULL DEFAULT '1',
  `s_currency` varchar(150) NULL DEFAULT 'USD',
  `telegram_bot_api` text NULL,
  `btc` varchar(150) NULL DEFAULT 'enabled',
  `eth` varchar(150) NULL DEFAULT 'enabled',
  `ltc` varchar(150) NULL DEFAULT 'enabled',
  `link` varchar(150) NULL DEFAULT 'enabled',
  `bnb` varchar(150) NULL DEFAULT 'enabled',
  `aave` varchar(150) NULL DEFAULT 'enabled',
  `usdt` varchar(150) NULL DEFAULT 'enabled',
  `bch` varchar(150) NULL DEFAULT 'enabled',
  `xrp` varchar(150) NULL DEFAULT 'enabled',
  `xlm` varchar(150) NULL DEFAULT 'enabled',
  `ada` varchar(150) NULL DEFAULT 'enabled',
  `bat` varchar(150) NULL DEFAULT 'enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings_conts` (`id`, `use_crypto_feature`, `purchase_code`, `minamt`, `flw_public_key`, `flw_secret_key`, `flw_secret_hash`, `bnc_api_key`, `bnc_secret_key`, `use_transfer`, `min_transfer`, `transfer_charges`, `fee`, `currency_rate`, `s_currency`, `telegram_bot_api`, `btc`, `eth`, `ltc`, `link`, `bnb`, `aave`, `usdt`, `bch`, `xrp`, `xlm`, `ada`, `bat`, `created_at`, `updated_at`) VALUES ('1', 'true', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', 'USD', NULL, 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', 'enabled', '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NULL DEFAULT NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `note` longtext NULL,
  `designation` varchar(191) NULL DEFAULT NULL,
  `start_date` varchar(191) NULL DEFAULT NULL,
  `end_date` varchar(191) NULL DEFAULT NULL,
  `priority` varchar(191) NULL DEFAULT NULL,
  `attch` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `terms_privacies`;
CREATE TABLE `terms_privacies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` longtext NULL,
  `useterms` varchar(150) NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `terms_privacies` (`id`, `description`, `useterms`, `created_at`, `updated_at`) VALUES ('1', '<h4>Mortil Holders Privacy &amp; Data Protection Charter</h4><p>Mortil Holders safeguards client records, multi-currency account credentials, and transaction telemetry under bank-grade cryptographic controls and strict regulatory governance.</p><p>We process verified personal and corporate data solely to provision custodial accounts, execute domestic and cross-border settlements, issue payment cards, and underwrite credit facilities. Client data is never sold or shared with unauthorized third parties.</p>', 'yes', '2026-10-26 15:12:56', '2026-10-26 15:12:56');

DROP TABLE IF EXISTS `testimonies`;
CREATE TABLE `testimonies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref_key` varchar(191) NULL DEFAULT NULL,
  `position` varchar(191) NULL DEFAULT NULL,
  `name` varchar(191) NULL DEFAULT NULL,
  `what_is_said` varchar(191) NULL DEFAULT NULL,
  `picture` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tp__transactions`;
CREATE TABLE `tp__transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan` varchar(191) NULL DEFAULT NULL,
  `user` bigint NULL DEFAULT NULL,
  `user_plan_id` bigint NULL DEFAULT NULL,
  `amount` varchar(191) NULL DEFAULT NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `upgrades`;
CREATE TABLE `upgrades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` bigint NULL DEFAULT NULL,
  `times` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `user_plans`;
CREATE TABLE `user_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan` bigint NULL DEFAULT NULL,
  `user` bigint NULL DEFAULT NULL,
  `amount` varchar(191) NULL DEFAULT NULL,
  `activate` varchar(191) NULL DEFAULT NULL,
  `active` varchar(150) NULL DEFAULT 'yes',
  `profit_earned` varchar(150) NULL DEFAULT '0',
  `income` varchar(191) NULL DEFAULT NULL,
  `purpose` longtext NULL,
  `duration` varchar(191) NULL DEFAULT NULL,
  `facility` varchar(191) NULL DEFAULT NULL,
  `inv_duration` varchar(191) NULL DEFAULT NULL,
  `expire_date` timestamp NULL DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_growth` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `userlogs`;
CREATE TABLE `userlogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` bigint NULL DEFAULT NULL,
  `ip` varchar(191) NULL DEFAULT NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NULL DEFAULT NULL,
  `username` varchar(191) NULL DEFAULT NULL,
  `lastname` varchar(191) NULL DEFAULT NULL,
  `middlename` varchar(191) NULL DEFAULT NULL,
  `email` varchar(191) NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` text NULL,
  `dob` text NULL,
  `address` longtext NULL,
  `country` varchar(191) NULL DEFAULT NULL,
  `phone` varchar(191) NULL DEFAULT NULL,
  `dashboard_style` varchar(150) NULL DEFAULT 'dark',
  `bank_name` text NULL,
  `account_name` text NULL,
  `account_number` text NULL,
  `account_no` text NULL,
  `accounttype` text NULL,
  `acnt_type_active` text NULL,
  `pin` varchar(191) NULL DEFAULT NULL,
  `pinstatus` bigint NULL DEFAULT '0',
  `withdrawotp` text NULL,
  `usernumber` varchar(191) NULL DEFAULT NULL,
  `code1` text NULL,
  `code2` text NULL,
  `code3` text NULL,
  `swift_code` text NULL,
  `btc_address` text NULL,
  `eth_address` text NULL,
  `ltc_address` text NULL,
  `usdt_address` text NULL,
  `plan` text NULL,
  `confirmed_plan` text NULL,
  `user_plan` text NULL,
  `account_bal` varchar(100) NULL DEFAULT '0',
  `roi` varchar(100) NULL DEFAULT '0',
  `bonus` varchar(100) NULL DEFAULT '0',
  `ref_bonus` varchar(100) NULL DEFAULT '0',
  `signup_bonus` text NULL,
  `auto_trade` text NULL,
  `bonus_released` bigint NULL DEFAULT '0',
  `bonus_matched` text NULL,
  `ref_by` text NULL,
  `ref_link` text NULL,
  `id_card` text NULL,
  `passport` text NULL,
  `account_verify` varchar(191) NULL DEFAULT NULL,
  `kyc_id` bigint NULL DEFAULT NULL,
  `irs_filing_id` text NULL,
  `limit` text NULL,
  `amount` text NULL,
  `action` text NULL,
  `signalamount` text NULL,
  `signalname` text NULL,
  `signalstatus` text NULL,
  `sendotpemail` varchar(150) NULL DEFAULT 'Yes',
  `sendroiemail` varchar(150) NULL DEFAULT 'Yes',
  `sendinvplanemail` varchar(150) NULL DEFAULT 'Yes',
  `userupdate` longtext NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `active` varchar(191) NULL DEFAULT NULL,
  `assign_to` text NULL,
  `transferaction` bigint NULL DEFAULT '0',
  `entered_at` timestamp NULL DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_growth` timestamp NULL DEFAULT NULL,
  `status` varchar(150) NULL DEFAULT 'active',
  `cstatus` varchar(191) NULL DEFAULT NULL,
  `account_status` varchar(150) NULL DEFAULT 'active',
  `trade_mode` text NULL,
  `act_session` text NULL,
  `remember_token` text NULL,
  `current_team_id` bigint NULL DEFAULT NULL,
  `profile_photo_path` longtext NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `two_factor_secret` longtext NULL,
  `two_factor_recovery_codes` longtext NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `username`, `lastname`, `middlename`, `email`, `email_verified_at`, `password`, `dob`, `address`, `country`, `phone`, `dashboard_style`, `bank_name`, `account_name`, `account_number`, `account_no`, `accounttype`, `acnt_type_active`, `pin`, `pinstatus`, `withdrawotp`, `usernumber`, `code1`, `code2`, `code3`, `swift_code`, `btc_address`, `eth_address`, `ltc_address`, `usdt_address`, `plan`, `confirmed_plan`, `user_plan`, `account_bal`, `roi`, `bonus`, `ref_bonus`, `signup_bonus`, `auto_trade`, `bonus_released`, `bonus_matched`, `ref_by`, `ref_link`, `id_card`, `passport`, `account_verify`, `kyc_id`, `irs_filing_id`, `limit`, `amount`, `action`, `signalamount`, `signalname`, `signalstatus`, `sendotpemail`, `sendroiemail`, `sendinvplanemail`, `userupdate`, `type`, `active`, `assign_to`, `transferaction`, `entered_at`, `activated_at`, `last_growth`, `status`, `cstatus`, `account_status`, `trade_mode`, `act_session`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `two_factor_secret`, `two_factor_recovery_codes`) VALUES ('1', 'Demo User', 'demouser', NULL, NULL, 'user@mortilholders.online', '2026-10-26 15:12:56', '$2y$10$rK/6eJI00zLuz/eZPJebv.CNEntDY0H14HA70E3e1/sceSDDPC7VS', NULL, NULL, NULL, NULL, 'dark', NULL, NULL, NULL, NULL, NULL, NULL, '1234', '0', NULL, '84920174632', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25000', '1200', '500', '100', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'Verified', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 'Yes', 'Yes', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, 'active', NULL, 'active', NULL, NULL, NULL, NULL, NULL, '2026-10-26 15:12:56', '2026-10-26 15:12:56', NULL, NULL);

DROP TABLE IF EXISTS `wdmethods`;
CREATE TABLE `wdmethods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NULL DEFAULT NULL,
  `minimum` text NULL,
  `maximum` text NULL,
  `charges_fixed` text NULL,
  `charges_percentage` text NULL,
  `charges_amount` text NULL,
  `charges_type` text NULL,
  `duration` text NULL,
  `methodtype` varchar(150) NULL DEFAULT 'crypto',
  `img_url` longtext NULL,
  `bankname` text NULL,
  `account_name` text NULL,
  `account_number` text NULL,
  `swift_code` text NULL,
  `wallet_address` text NULL,
  `barcode` longtext NULL,
  `network` text NULL,
  `defaultpay` varchar(150) NULL DEFAULT 'no',
  `type` varchar(191) NULL DEFAULT NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE `withdrawals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(191) NULL DEFAULT NULL,
  `user` bigint NULL DEFAULT NULL,
  `uname` text NULL,
  `amount` text NULL,
  `to_deduct` text NULL,
  `status` varchar(191) NULL DEFAULT NULL,
  `payment_mode` text NULL,
  `paydetails` longtext NULL,
  `type` varchar(191) NULL DEFAULT NULL,
  `date` text NULL,
  `bal` text NULL,
  `Description` longtext NULL,
  `accountname` text NULL,
  `accountnumber` text NULL,
  `bankname` text NULL,
  `Accounttype` text NULL,
  `bankaddress` longtext NULL,
  `country` varchar(191) NULL DEFAULT NULL,
  `swiftcode` text NULL,
  `iban` text NULL,
  `crypto_currency` text NULL,
  `crypto_network` text NULL,
  `wallet_address` text NULL,
  `paypal_email` text NULL,
  `wise_fullname` text NULL,
  `wise_email` text NULL,
  `wise_country` text NULL,
  `skrill_email` text NULL,
  `skrill_fullname` text NULL,
  `venmo_username` text NULL,
  `venmo_phone` text NULL,
  `zelle_email` text NULL,
  `zelle_phone` text NULL,
  `zelle_name` text NULL,
  `cash_app_tag` text NULL,
  `cash_app_fullname` text NULL,
  `revolut_fullname` text NULL,
  `revolut_email` text NULL,
  `revolut_phone` text NULL,
  `alipay_id` text NULL,
  `alipay_fullname` text NULL,
  `wechat_id` text NULL,
  `wechat_name` text NULL,
  `proof` text NULL,
  `plan` text NULL,
  `active` varchar(191) NULL DEFAULT NULL,
  `user_id` bigint NULL DEFAULT NULL,
  `client_id` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
