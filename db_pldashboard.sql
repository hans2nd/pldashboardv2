-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2026 at 09:20 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pldashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:40:{i:0;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:10:\"users edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:1;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:12:\"users create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:2;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:10:\"users view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:3;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:12:\"users delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:4;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:11:\"role create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:5;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:11:\"role delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:6;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:9:\"role edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:7;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:9:\"role view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:8;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:17:\"permission create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:9;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:15:\"permission edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:10;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:17:\"permission delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:11;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:15:\"permission view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:12;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:17:\"sales retail view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:7;i:1;i:10;i:2;i:13;i:3;i:15;i:4;i:20;i:5;i:24;i:6;i:25;}}i:13;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:14:\"sales fsm view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:7;i:1;i:10;i:2;i:15;i:3;i:20;i:4;i:24;i:5;i:25;}}i:14;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:20:\"operational pms view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:8:{i:0;i:7;i:1;i:9;i:2;i:10;i:3;i:15;i:4;i:19;i:5;i:20;i:6;i:24;i:7;i:25;}}i:15;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:20:\"sales dashboard view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:13:{i:0;i:7;i:1;i:8;i:2;i:10;i:3;i:11;i:4;i:12;i:5;i:13;i:6;i:14;i:7;i:15;i:8;i:20;i:9;i:24;i:10;i:25;i:11;i:26;i:12;i:27;}}i:16;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:19:\"sales sidoarjo view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:11:{i:0;i:7;i:1;i:8;i:2;i:10;i:3;i:11;i:4;i:12;i:5;i:13;i:6;i:14;i:7;i:15;i:8;i:20;i:9;i:24;i:10;i:25;}}i:17;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:22:\"sales all channel view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:7;i:1;i:10;i:2;i:11;i:3;i:15;i:4;i:20;i:5;i:24;i:6;i:25;}}i:18;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:22:\"sales distributor view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:7;i:1;i:10;i:2;i:14;i:3;i:15;i:4;i:20;i:5;i:24;i:6;i:25;}}i:19;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:24:\"sales food services view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:7;i:1;i:8;i:2;i:10;i:3;i:15;i:4;i:20;i:5;i:24;i:6;i:25;}}i:20;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:24:\"sales private label view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:7;i:1;i:10;i:2;i:12;i:3;i:15;i:4;i:20;i:5;i:24;i:6;i:25;}}i:21;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:23:\"logistic dashboard view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:12:{i:0;i:7;i:1;i:9;i:2;i:10;i:3;i:11;i:4;i:15;i:5;i:20;i:6;i:21;i:7;i:22;i:8;i:23;i:9;i:24;i:10;i:25;i:11;i:26;}}i:22;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:30:\"logistic inventory status view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:12:{i:0;i:7;i:1;i:9;i:2;i:10;i:3;i:11;i:4;i:15;i:5;i:20;i:6;i:21;i:7;i:22;i:8;i:23;i:9;i:24;i:10;i:25;i:11;i:26;}}i:23;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:27:\"logistic moi inventory view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:12:{i:0;i:7;i:1;i:9;i:2;i:10;i:3;i:11;i:4;i:15;i:5;i:20;i:6;i:21;i:7;i:22;i:8;i:23;i:9;i:24;i:10;i:25;i:11;i:26;}}i:24;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:26:\"operational dashboard view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:8:{i:0;i:7;i:1;i:9;i:2;i:10;i:3;i:15;i:4;i:19;i:5;i:20;i:6;i:24;i:7;i:25;}}i:25;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:9:\"menu view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:26;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:11:\"menu create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:27;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:9:\"menu edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:28;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:11:\"menu delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:29;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:11:\"iframe edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:20;}}i:30;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:25:\"management dashboard view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:7;i:1;i:15;i:2;i:20;i:3;i:24;i:4;i:25;}}i:31;a:3:{s:1:\"a\";i:102;s:1:\"b\";s:27:\"management dashboard update\";s:1:\"c\";s:3:\"web\";}i:32;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:30:\"overview financial report view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:7;i:1;i:15;i:2;i:20;i:3;i:24;i:4;i:25;}}i:33;a:3:{s:1:\"a\";i:104;s:1:\"b\";s:32:\"overview financial report update\";s:1:\"c\";s:3:\"web\";}i:34;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:31:\"overview sales performance view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:7;i:1;i:15;i:2;i:20;i:3;i:24;i:4;i:25;}}i:35;a:3:{s:1:\"a\";i:106;s:1:\"b\";s:33:\"overview sales performance update\";s:1:\"c\";s:3:\"web\";}i:36;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:12:\"jakarta view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:20;i:1;i:24;i:2;i:26;i:3;i:27;}}i:37;a:3:{s:1:\"a\";i:108;s:1:\"b\";s:14:\"jakarta update\";s:1:\"c\";s:3:\"web\";}i:38;a:3:{s:1:\"a\";i:109;s:1:\"b\";s:18:\"food services view\";s:1:\"c\";s:3:\"web\";}i:39;a:3:{s:1:\"a\";i:110;s:1:\"b\";s:20:\"food services update\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:18:{i:0;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:8:\"Director\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"Sales Retail\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"General Manager\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:3:\"CPD\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:24;s:1:\"b\";s:20:\"General Manager West\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:25;s:1:\"b\";s:20:\"General Manager East\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:8:\"Logistic\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:11:\"Operational\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:8:\"Sales FS\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:25:\"Regional Manager Sidoarjo\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:19:\"Sales Private Label\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:14;s:1:\"b\";s:17:\"Sales Distributor\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:26;s:1:\"b\";s:27:\"Regional Manager FS Jakarta\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:27;s:1:\"b\";s:16:\"Sales FS Jakarta\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:24:\"Regional Manager Jakarta\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:21:\"Regional Manager Bali\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:25:\"Regional Manager Semarang\";s:1:\"c\";s:3:\"web\";}}}', 1769840116);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_menus`
--

CREATE TABLE `dashboard_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dashboard',
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboard_menus`
--

INSERT INTO `dashboard_menus` (`id`, `name`, `key`, `icon`, `route`, `parent_id`, `type`, `order`, `is_active`, `permission_name`, `created_at`, `updated_at`) VALUES
(1, 'Sales Dashboard', 'sales', 'fas fa-chart-line', NULL, NULL, 'header', 1, 1, 'Sales Dashboard', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(2, 'Sidoarjo', 'sidoarjo', 'fas fa-map-marker-alt', NULL, 1, 'header', 1, 1, 'Sales Sidoarjo', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(3, 'Over All Channel', 'sdaAllSales', NULL, 'dashboard.sdaAllSales', 2, 'dashboard', 1, 1, 'Sales All Channel', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(4, 'Distributor', 'sidoarjoDist', NULL, 'dashboard.sidoarjo_distributor', 2, 'dashboard', 2, 1, 'Sales Distributor', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(5, 'Food Services', 'sidoarjoFs', NULL, 'dashboard.sidoarjo_fs', 2, 'dashboard', 3, 1, 'Sales Food Services', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(6, 'Private Label', 'sidoarjoPrivatelabel', NULL, 'dashboard.sidoarjo_privatelabel', 2, 'dashboard', 4, 1, 'Sales Private Label', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(7, 'Retail (MT & GT)', 'sidoarjoRetail', NULL, 'dashboard.sidoarjo_retail', 2, 'dashboard', 5, 1, 'Sales Retail', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(8, 'Food Services Manager', 'sidoarjoFsm', NULL, 'dashboard.sidoarjo_fsm', 2, 'dashboard', 6, 1, 'Sales FSM', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(9, 'Logistic Dashboard', 'logistics', 'fas fa-car-side', NULL, NULL, 'header', 2, 1, 'Logistic Dashboard', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(10, 'Inventory Status', 'logisticInventoryStatus', NULL, 'dashboard.logistic_inventory_status', 9, 'dashboard', 1, 1, 'Logistic Inventory Status', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(11, 'MOI Inventory', 'logisticInventoryMOI', NULL, 'dashboard.logistic_inventory_moi', 9, 'dashboard', 2, 1, 'Logistic MOI Inventory', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(12, 'Operational Dashboard', 'operational', 'fas fa-cogs', NULL, NULL, 'header', 3, 1, 'Operational Dashboard', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(13, 'PMS', 'operationalPms', NULL, 'dashboard.operational_pms', 12, 'dashboard', 1, 1, 'Operational PMS', '2026-01-21 02:16:33', '2026-01-21 02:42:27'),
(15, 'Management Dashboard', 'managementDashboard', 'fas fa-tachometer-alt', NULL, NULL, 'header', 0, 1, NULL, '2026-01-26 03:51:58', '2026-01-26 03:51:58'),
(16, 'Overview Financial Report', 'overviewFinancialReport', NULL, 'dashboard.management_overviewfinance', 15, 'dashboard', 1, 1, NULL, '2026-01-26 03:53:36', '2026-01-26 03:53:49'),
(17, 'Overview Sales Performance', 'overviewSalesPerformance', NULL, NULL, 15, 'dashboard', 2, 1, NULL, '2026-01-26 03:54:43', '2026-01-26 03:54:43'),
(18, 'Jakarta', 'jakarta', 'fas fa-map-marker-alt', NULL, 1, 'header', 2, 1, NULL, '2026-01-27 02:09:23', '2026-01-27 02:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_settings`
--

CREATE TABLE `dashboard_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboard_settings`
--

INSERT INTO `dashboard_settings` (`id`, `key`, `title`, `src`, `created_at`, `updated_at`) VALUES
(1, 'logisticInventoryStatus', 'Inventory Status', 'https://app.powerbi.com/view?r=eyJrIjoiZGZlNDI3ODAtMjIyNS00ZjQwLTgzM2ItZDhlYjkwNGI1NDQ3IiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:22:06', '2026-01-21 06:35:19'),
(2, 'logisticInventoryMOI', 'MOI Report', 'https://app.powerbi.com/view?r=eyJrIjoiMWU0MjIyMTAtZWI3OS00NDk2LTg4NTctOGIwZTk5MTRlOWYzIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:22:08', '2026-01-21 06:35:31'),
(3, 'sdaAllSales', 'LocalNew_PanganLestari_Sales1.11 Overall', 'https://app.powerbi.com/view?r=eyJrIjoiNzdjNDQ0YzMtMjA3Mi00ZTNlLTgyMjctMTg2OGUxODRjNDVhIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:22:12', '2026-01-21 06:24:41'),
(4, 'sidoarjoDist', 'LocalNew_PanganLestari_Sales1.11 SDA Distributor', 'https://app.powerbi.com/view?r=eyJrIjoiZjg5YjdiNGYtNjM0Ny00NjA2LWI3MDMtN2EwNzg4NmUwZWFjIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:22:14', '2026-01-21 06:24:56'),
(5, 'sidoarjoFs', 'LocalNew_PanganLestari_Sales1.11 SDA FS', 'https://app.powerbi.com/view?r=eyJrIjoiNTAzNGFjNWEtYzZlMi00ZDQ1LTk3YjYtMmMyODdkZjY5ZDI5IiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:22:15', '2026-01-21 06:25:09'),
(6, 'sidoarjoPrivatelabel', 'LocalNew_PanganLestari_Sales1.11 SDA PLM', 'https://app.powerbi.com/view?r=eyJrIjoiNDJjZTczYjAtMGYyZC00ODI2LWFmMDktMzRiMTgxNWM4MjgzIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:22:15', '2026-01-21 06:25:24'),
(7, 'sidoarjoFsm', 'LocalNew_PanganLestari_Sales1.11 SDA FSM', 'https://app.powerbi.com/view?r=eyJrIjoiOGJjZGZkMTItZjkwMy00OWYxLTliNjEtYmMwMmQwZjhlZDgxIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:22:16', '2026-01-21 06:26:00'),
(8, 'sidoarjoRetail', 'LocalNew_PanganLestari_Sales1.11 SDA Retail', 'https://app.powerbi.com/view?r=eyJrIjoiYjk4YzNlYTEtMjIwMi00ZjU3LTg1MDItNWM1NzJlMzc2MTAxIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:25:26', '2026-01-21 06:25:34'),
(9, 'logistic', 'Inventory Status', 'https://app.powerbi.com/view?r=eyJrIjoiZGZlNDI3ODAtMjIyNS00ZjQwLTgzM2ItZDhlYjkwNGI1NDQ3IiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:31:01', '2026-01-21 06:31:01'),
(10, 'inventoryMOI', 'MOI Report', 'https://app.powerbi.com/view?r=eyJrIjoiMWU0MjIyMTAtZWI3OS00NDk2LTg4NTctOGIwZTk5MTRlOWYzIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-21 06:31:13', '2026-01-21 06:31:13'),
(11, 'operationalPms', 'PL_Aktivitas', 'https://app.powerbi.com/reportEmbed?reportId=f052a70d-1011-49a4-b38d-29e430203dc7&autoAuth=true&ctid=ffb76b20-b480-4230-8bf5-23ec920b1ce3%22 frameborder=', '2026-01-21 06:35:39', '2026-01-21 06:35:46'),
(12, 'managementDashboard', 'Management Dashboard', 'about:blank', '2026-01-26 03:51:22', '2026-01-26 03:51:22'),
(13, 'overviewFinancialReport', 'PL Management Dashboard - Finance', 'https://app.powerbi.com/view?r=eyJrIjoiMjdmZmE1NWQtYTE1ZC00YmMxLTliMjktMTQ5OGNmNDczOGVlIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-26 03:53:57', '2026-01-26 03:55:06'),
(14, 'overviewSalesPerformance', 'PL Management Dashboard - Sales', 'https://app.powerbi.com/view?r=eyJrIjoiODhiMTYwYjgtYjVkNC00N2Q5LWFhMmQtZGYyZTkyYWRlYTg5IiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-26 03:54:50', '2026-01-26 03:55:24'),
(15, 'jakarta', 'LocalNew_PanganLestari_Sales1.11 Overall FS JKT', 'https://app.powerbi.com/view?r=eyJrIjoiY2Q1MjZiMzUtMGQxZi00ODZkLWJmMTktOTRkY2YyMWRjNWU3IiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D', '2026-01-27 02:17:20', '2026-01-27 02:22:07'),
(16, 'foodServices', 'Food Services', 'about:blank', '2026-01-27 02:17:22', '2026-01-27 02:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_20_092712_create_permission_tables', 1),
(5, '2025_11_20_152150_drop_role_column_from_users_table', 1),
(6, '2025_12_12_150559_create_dashboard_settings_table', 1),
(7, '2026_01_21_000001_create_dashboard_menus_table', 1),
(8, '2026_01_21_160000_add_permission_name_to_dashboard_menus', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(6, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 47),
(7, 'App\\Models\\User', 22),
(7, 'App\\Models\\User', 29),
(7, 'App\\Models\\User', 38),
(7, 'App\\Models\\User', 39),
(7, 'App\\Models\\User', 40),
(8, 'App\\Models\\User', 25),
(8, 'App\\Models\\User', 26),
(8, 'App\\Models\\User', 27),
(8, 'App\\Models\\User', 28),
(8, 'App\\Models\\User', 35),
(8, 'App\\Models\\User', 36),
(9, 'App\\Models\\User', 17),
(9, 'App\\Models\\User', 43),
(9, 'App\\Models\\User', 50),
(9, 'App\\Models\\User', 51),
(9, 'App\\Models\\User', 52),
(9, 'App\\Models\\User', 53),
(9, 'App\\Models\\User', 55),
(11, 'App\\Models\\User', 24),
(13, 'App\\Models\\User', 32),
(13, 'App\\Models\\User', 33),
(15, 'App\\Models\\User', 18),
(15, 'App\\Models\\User', 19),
(15, 'App\\Models\\User', 20),
(15, 'App\\Models\\User', 30),
(15, 'App\\Models\\User', 37),
(19, 'App\\Models\\User', 54),
(20, 'App\\Models\\User', 16),
(20, 'App\\Models\\User', 31),
(20, 'App\\Models\\User', 49),
(21, 'App\\Models\\User', 41),
(21, 'App\\Models\\User', 44),
(22, 'App\\Models\\User', 48),
(23, 'App\\Models\\User', 42),
(24, 'App\\Models\\User', 23),
(25, 'App\\Models\\User', 21),
(26, 'App\\Models\\User', 45),
(26, 'App\\Models\\User', 59),
(27, 'App\\Models\\User', 34),
(27, 'App\\Models\\User', 56),
(27, 'App\\Models\\User', 57),
(27, 'App\\Models\\User', 58);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(26, 'users edit', 'web', '2025-11-20 06:41:21', '2025-11-20 06:41:21'),
(27, 'users create', 'web', '2025-11-20 06:41:29', '2025-11-20 06:41:29'),
(28, 'users view', 'web', '2025-11-20 06:41:42', '2025-11-20 06:41:42'),
(29, 'users delete', 'web', '2025-11-20 06:41:51', '2025-11-20 06:41:51'),
(30, 'role create', 'web', '2025-11-20 06:55:30', '2025-11-20 06:55:30'),
(31, 'role delete', 'web', '2025-11-20 06:55:39', '2025-11-20 06:55:39'),
(32, 'role edit', 'web', '2025-11-20 06:55:48', '2025-11-20 06:55:59'),
(33, 'role view', 'web', '2025-11-20 06:56:06', '2025-11-20 06:56:06'),
(34, 'permission create', 'web', '2025-11-20 06:56:16', '2025-11-20 06:56:16'),
(35, 'permission edit', 'web', '2025-11-20 06:56:23', '2025-11-20 06:56:23'),
(36, 'permission delete', 'web', '2025-11-20 06:56:31', '2025-11-20 06:56:31'),
(37, 'permission view', 'web', '2025-11-20 06:56:37', '2025-11-20 06:56:37'),
(41, 'sales retail view', 'web', '2025-12-11 07:19:04', '2025-12-11 07:19:04'),
(44, 'sales fsm view', 'web', '2025-12-11 07:19:44', '2025-12-11 07:19:44'),
(49, 'operational pms view', 'web', '2026-01-21 06:18:35', '2026-01-21 06:18:35'),
(60, 'sales dashboard view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(62, 'sales sidoarjo view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(64, 'sales all channel view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(66, 'sales distributor view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(68, 'sales food services view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(70, 'sales private label view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(74, 'logistic dashboard view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(76, 'logistic inventory status view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(78, 'logistic moi inventory view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(80, 'operational dashboard view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(83, 'menu view', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(84, 'menu create', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(85, 'menu edit', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(86, 'menu delete', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(87, 'iframe edit', 'web', '2026-01-21 10:33:11', '2026-01-21 10:33:11'),
(101, 'management dashboard view', 'web', '2026-01-26 02:26:27', '2026-01-26 02:26:27'),
(102, 'management dashboard update', 'web', '2026-01-26 02:26:27', '2026-01-26 02:26:27'),
(103, 'overview financial report view', 'web', '2026-01-26 03:53:36', '2026-01-26 03:53:36'),
(104, 'overview financial report update', 'web', '2026-01-26 03:53:36', '2026-01-26 03:53:36'),
(105, 'overview sales performance view', 'web', '2026-01-26 03:54:43', '2026-01-26 03:54:43'),
(106, 'overview sales performance update', 'web', '2026-01-26 03:54:43', '2026-01-26 03:54:43'),
(107, 'jakarta view', 'web', '2026-01-27 02:09:23', '2026-01-27 02:09:23'),
(108, 'jakarta update', 'web', '2026-01-27 02:09:23', '2026-01-27 02:09:23'),
(109, 'food services view', 'web', '2026-01-27 02:14:12', '2026-01-27 02:14:12'),
(110, 'food services update', 'web', '2026-01-27 02:14:12', '2026-01-27 02:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'superadmin', 'web', '2025-11-20 07:51:33', '2025-11-20 07:51:33'),
(7, 'Director', 'web', '2025-11-20 05:01:51', '2025-12-11 08:29:22'),
(8, 'Sales FS', 'web', '2025-11-20 06:49:56', '2025-12-11 07:03:40'),
(9, 'Logistic', 'web', '2025-11-20 06:50:06', '2025-11-20 06:50:06'),
(10, 'Admin', 'web', '2025-11-20 06:50:26', '2025-11-20 06:50:26'),
(11, 'Regional Manager Sidoarjo', 'web', '2025-12-11 07:00:42', '2026-01-22 05:10:16'),
(12, 'Sales Private Label', 'web', '2025-12-11 07:03:47', '2025-12-11 07:06:40'),
(13, 'Sales Retail', 'web', '2025-12-11 07:04:00', '2025-12-11 07:04:00'),
(14, 'Sales Distributor', 'web', '2025-12-11 07:04:09', '2025-12-11 07:04:09'),
(15, 'General Manager', 'web', '2025-12-11 07:27:56', '2025-12-11 07:27:56'),
(19, 'Operational', 'web', '2026-01-21 07:12:25', '2026-01-21 07:12:25'),
(20, 'CPD', 'web', '2026-01-21 07:13:37', '2026-01-21 07:13:37'),
(21, 'Regional Manager Jakarta', 'web', '2026-01-22 05:06:44', '2026-01-22 05:06:44'),
(22, 'Regional Manager Bali', 'web', '2026-01-22 05:08:12', '2026-01-22 05:08:12'),
(23, 'Regional Manager Semarang', 'web', '2026-01-22 05:08:20', '2026-01-22 05:08:20'),
(24, 'General Manager West', 'web', '2026-01-22 05:15:25', '2026-01-22 05:15:25'),
(25, 'General Manager East', 'web', '2026-01-22 05:15:34', '2026-01-22 05:15:34'),
(26, 'Regional Manager FS Jakarta', 'web', '2026-01-27 02:26:22', '2026-01-27 02:26:22'),
(27, 'Sales FS Jakarta', 'web', '2026-01-27 02:29:04', '2026-01-27 02:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(26, 10),
(27, 10),
(28, 10),
(29, 10),
(30, 10),
(31, 10),
(32, 10),
(33, 10),
(34, 10),
(35, 10),
(36, 10),
(37, 10),
(41, 7),
(41, 10),
(41, 13),
(41, 15),
(41, 20),
(41, 24),
(41, 25),
(44, 7),
(44, 10),
(44, 15),
(44, 20),
(44, 24),
(44, 25),
(49, 7),
(49, 9),
(49, 10),
(49, 15),
(49, 19),
(49, 20),
(49, 24),
(49, 25),
(60, 7),
(60, 8),
(60, 10),
(60, 11),
(60, 12),
(60, 13),
(60, 14),
(60, 15),
(60, 20),
(60, 24),
(60, 25),
(60, 26),
(60, 27),
(62, 7),
(62, 8),
(62, 10),
(62, 11),
(62, 12),
(62, 13),
(62, 14),
(62, 15),
(62, 20),
(62, 24),
(62, 25),
(64, 7),
(64, 10),
(64, 11),
(64, 15),
(64, 20),
(64, 24),
(64, 25),
(66, 7),
(66, 10),
(66, 14),
(66, 15),
(66, 20),
(66, 24),
(66, 25),
(68, 7),
(68, 8),
(68, 10),
(68, 15),
(68, 20),
(68, 24),
(68, 25),
(70, 7),
(70, 10),
(70, 12),
(70, 15),
(70, 20),
(70, 24),
(70, 25),
(74, 7),
(74, 9),
(74, 10),
(74, 11),
(74, 15),
(74, 20),
(74, 21),
(74, 22),
(74, 23),
(74, 24),
(74, 25),
(74, 26),
(76, 7),
(76, 9),
(76, 10),
(76, 11),
(76, 15),
(76, 20),
(76, 21),
(76, 22),
(76, 23),
(76, 24),
(76, 25),
(76, 26),
(78, 7),
(78, 9),
(78, 10),
(78, 11),
(78, 15),
(78, 20),
(78, 21),
(78, 22),
(78, 23),
(78, 24),
(78, 25),
(78, 26),
(80, 7),
(80, 9),
(80, 10),
(80, 15),
(80, 19),
(80, 20),
(80, 24),
(80, 25),
(83, 10),
(84, 10),
(85, 10),
(86, 10),
(87, 20),
(101, 7),
(101, 15),
(101, 20),
(101, 24),
(101, 25),
(103, 7),
(103, 15),
(103, 20),
(103, 24),
(103, 25),
(105, 7),
(105, 15),
(105, 20),
(105, 24),
(105, 25),
(107, 20),
(107, 24),
(107, 26),
(107, 27);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1uupLhXoQb73XpGohxis0whVndrfP1EqpBSTKa4G', 49, '36.81.170.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZGJGUnJCeWRRSGlWRFZESDJQMzBUUkxROGNlVHo1TjFTQ2YxNWVJVyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjc4OiJodHRwczovL2Rhc2hib2FyZC5wYW5nYW5sZXN0YXJpLmNvbTo4MDg1L3BsZGFzaGJvYXJkL2xvZ2lzdGljX2ludmVudG9yeV9zdGF0dXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0OTt9', 1769759974),
('DYS7BABrNUmqopsq5wI75SSP2uglziRPhNp3Pmkh', 18, '103.182.235.162', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOGs1bzRseTZHbk9ZUXVEMjdRTWFpNURFOG85aVZVMVl0TkJLR2FWZiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjc4OiJodHRwczovL2Rhc2hib2FyZC5wYW5nYW5sZXN0YXJpLmNvbTo4MDg1L3BsZGFzaGJvYXJkL2xvZ2lzdGljX2ludmVudG9yeV9zdGF0dXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxODt9', 1769744961),
('Guq2Eii0yTUfgSsodDT5b8oajsxOuupqxYV7f9Al', 16, '36.81.170.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRG1Ed003SXhGckZMN2NPWFFaOWUxQmdpdHhteTVEUGpaUFp2S2U1MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHBzOi8vZGFzaGJvYXJkLnBhbmdhbmxlc3RhcmkuY29tOjgwODUvcGxkYXNoYm9hcmQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTY7fQ==', 1769756867),
('HsmlTiYxniK7GCnhFBZIX3rx7bVQiTA4UEgaoPjQ', NULL, '118.96.248.216', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVmwzV1JwWkt2Sm8yWXJmSGh4enJwV3k5VXhQRmN0TjhPN3ByQXZDTiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo3ODoiaHR0cHM6Ly9kYXNoYm9hcmQucGFuZ2FubGVzdGFyaS5jb206ODA4NS9wbGRhc2hib2FyZC9sb2dpc3RpY19pbnZlbnRvcnlfc3RhdHVzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHBzOi8vZGFzaGJvYXJkLnBhbmdhbmxlc3RhcmkuY29tOjgwODUvcGxkYXNoYm9hcmQvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1769738487),
('JL7EFyxmjXpZPaNu7AQ40ocYUbLb5wX6BbCTpCrT', 23, '118.96.248.216', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMEtZOWpHcWJRdEl6aEhtQXBKVVZFWXNQekZKcHhVcWg1RW1mOU9LOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzg6Imh0dHBzOi8vZGFzaGJvYXJkLnBhbmdhbmxlc3RhcmkuY29tOjgwODUvcGxkYXNoYm9hcmQvbG9naXN0aWNfaW52ZW50b3J5X3N0YXR1cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIzO30=', 1769758596),
('M4IRIbbqj0PO96C0Hok5G6iv6lrge0n3LQhT3AyW', 17, '192.168.5.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMGdLc2liVkFBQmtPa3lhOTJBWkVDRGVqWnJqQVFudDhveW5hYVpGYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHBzOi8vZGFzaGJvYXJkLnBhbmdhbmxlc3RhcmkuY29tOjgwODUvcGxkYXNoYm9hcmQvbG9naXN0aWNfaW52ZW50b3J5X21vaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE3O30=', 1769742205),
('TdFEVdKkTTMPIwdn1o4miJlP04nyRD4LzVmU0kfq', 1, '103.44.19.179', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNUtUdVJ0NmxMZ1VsN3F5c014aHR4Znl3MUpPanRkRUp6S1Vtb2NMYyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjY1OiJodHRwczovL2Rhc2hib2FyZC5wYW5nYW5sZXN0YXJpLmNvbTo4MDg1L3BsZGFzaGJvYXJkL3VzZXJzP3BhZ2U9MiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1769763570),
('Tv5HfJrajSibbhbG4McSM6PVSqPKTif8lQDYl647', 29, '165.85.203.206', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNG5aTmZWSk9TSXFES0ZWY3Z1Y21GVzI2c3pQc0tQZjhZdWdYTWdKRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHBzOi8vZGFzaGJvYXJkLnBhbmdhbmxlc3RhcmkuY29tOjgwODUvcGxkYXNoYm9hcmQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjk7fQ==', 1769746825),
('YaYWHHgCXqRtYQhYFBGe3pSxJAvkLsfADzeTNLCV', 29, '165.85.203.206', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRHdDc2tReWQ1TnlXQU1oVXZkT3pBd2hxczB4NVRhbzVSQm1xanNCZyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjgyOiJodHRwczovL2Rhc2hib2FyZC5wYW5nYW5sZXN0YXJpLmNvbTo4MDg1L3BsZGFzaGJvYXJkL21lbnUvb3ZlcnZpZXdTYWxlc1BlcmZvcm1hbmNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjk7fQ==', 1769686994);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'admin123@gmail.com', NULL, '$2y$12$VYuzySGs.KDk.5gP5kZTU..b7BtW84XoLMB4PYt485pSTeRQbdp9m', NULL, '2025-10-29 15:55:13', '2025-11-20 07:53:34'),
(16, 'husni', 'Husni', 'husni@sekar.co.id', NULL, '$2y$12$Zksi9qWfp8HxCi1rIa4puu1XXC90DJHBfWSP1bzWnlZ5K2xSX8jMC', NULL, '2025-10-29 16:21:15', '2025-10-29 16:21:15'),
(17, 'hendra', 'Hendra Jaya Putra', 'hendrajaya@sekar.co.id', NULL, '$2y$12$Pr/feCO7WKvMAWYFhXE2n.imaal4KShQ0AkrKuCVyLf7TSF0nQhPW', NULL, '2025-11-10 09:42:22', '2025-12-22 11:22:02'),
(18, 'karel', 'Karel Zefanya', 'user5@gmail.com', NULL, '$2y$12$Dv.We.a2uQCNxY1vYCJPp.aDbzILXKnpD3GF4B2kx7aZVfGY4ldOG', NULL, '2025-11-13 00:42:35', '2025-11-13 00:42:35'),
(19, 'feby', 'Feby Yuanita', 'feby@sekar.co.id', NULL, '$2y$12$IZUZ/X75Sd/X7mbUFd2Qdu2BYocTNybJTt76nfHV8MAwmuFvmhXVW', NULL, '2025-11-17 04:07:20', '2025-11-17 04:07:20'),
(20, 'erni', 'Erni Juliana', 'erni@sekar.co.id', NULL, '$2y$12$UG.60Lrb/a2P5QZ.KHFOUeYCJHBuqv5iD2/rbST5tZoKI2mnsNnH.', NULL, '2025-11-17 04:08:16', '2025-11-17 04:08:16'),
(21, 'albertus', 'Albertus Candi', 'albertus@sekar.co.id', NULL, '$2y$12$MGO8Gdrp.Th4XZ2iEfdpVOloHVruVSNUBQsWlxhOQzRdvhDFDamWe', NULL, '2025-11-17 04:08:48', '2025-11-17 04:08:48'),
(22, 'effendy', 'Effendy Hamdja', 'eff@sekar.co.id', NULL, '$2y$12$RgVV82dgXGMY.NjU3rN6tedS9aRC.TfjAkVq1MF0n0V5eLY2J9K0S', NULL, '2025-11-17 04:09:51', '2025-11-17 04:09:51'),
(23, 'agus', 'Agus Setianto', 'agus.setianto@sekar.co.id', NULL, '$2y$12$dmvzVydu.6UapWlG5wucBeB1nq/bZJlbagOoTbOyGJMcBUIZqBOKm', NULL, '2025-11-17 04:10:54', '2025-11-17 04:10:54'),
(24, 'heru', 'Heru Rayanto Soestrisno', 'heru.rayanto@sekar.co.id', NULL, '$2y$12$b5Yz5CBnWijha1ebd26MieOAwiy8Ou2EmDqn3MgPAa3.7a0w5/UWS', NULL, '2025-11-17 07:44:59', '2025-11-17 07:44:59'),
(25, 'tommy', 'Tommy Arifin Injo', 'tommyarifin@panganlestari.com', NULL, '$2y$12$CiC2l/Ebu26qfWIh3TLYtO6ZJCedM3FfseN.NAaXNA6c8s4KL5nPi', NULL, '2025-11-17 10:22:26', '2025-11-24 10:07:16'),
(26, 'yesica', 'Yesica', 'yesica@panganlestari.com', NULL, '$2y$12$OiZHuhqTgL.mWQm01biCe.rzmQjyYJ3yAvTFZYKICgF79G1MJFdMi', NULL, '2025-11-17 10:24:45', '2025-11-17 10:24:45'),
(27, 'nessa', 'Nessa Reka Novanda', 'nessa@panganlestari.com', NULL, '$2y$12$ZRHmNaiMR.fzofBZFc8Q.ehC1Bm1uNexTu/zdDz/Ob4OkXgMwJ4uq', NULL, '2025-11-17 10:25:28', '2025-11-17 10:25:28'),
(28, 'oktavianus', 'Oktavianus Adi Wijaya', 'tommyarifin2@panganlestari.com', NULL, '$2y$12$Sx8Goovl4YeVXAxGyQa1q.R0XOUZrnNcgkWyYMZbc7NKxFy.1VcBW', NULL, '2025-11-17 10:26:28', '2025-11-17 10:26:28'),
(29, 'fujii', 'Kenta Fujii', 'Kent.Fujii@mitsui.com', NULL, '$2y$12$q2hFWqcawA7dXuYeqOZ5deKmbd9J35QUCLChRdKliM2odc5Plcjv6', NULL, '2025-11-20 02:18:08', '2025-11-20 02:18:08'),
(30, 'daisy', 'Daisy Simorangkir', 'daisy.s@sekar.co.id', NULL, '$2y$12$Zu6iesnxuX7pVVCiUxkHD.7LqjntuI19JJrba9v7KAaNMiHpyd0a6', NULL, '2025-11-20 02:19:08', '2025-11-20 02:23:48'),
(31, 'edwin', 'Edwin Salim', 'husni.m@sekar.co.id', NULL, '$2y$12$lAddI/rPBvjbiYKcOje2AeVSjSaLvX1FqcvDvAZjlkH14UboaOQ6.', NULL, '2025-11-20 02:21:22', '2025-11-20 02:21:22'),
(32, 'rahendra', 'RAHENDRA PARAMADITA', 'rahendra.paramadita@panganlestari.com', NULL, '$2y$12$yRWHuOVyiLi4uyjlouspr.GzcD68sqtGj/y1NIyhmnyS9WYRk0cyO', NULL, '2025-11-24 10:11:06', '2025-11-24 10:11:06'),
(33, 'ketut', 'KETUT WINATA', 'ketutwinata@panganlestari.com', NULL, '$2y$12$S0WZXBnZx1mZaOk9VDLyaebu70aya0vgQobDT0q83xipv8Lv1iJQq', NULL, '2025-11-24 10:11:54', '2025-11-24 10:11:54'),
(34, 'hans', 'Hans', 'hans.pljkt@panganlestari.com', NULL, '$2y$12$njX/.CCtA.lSkw.cmRFSUuv0jDIv4CMS389LU2jAJcK./sIS3xMQ2', NULL, '2025-11-24 10:23:11', '2025-11-24 10:23:11'),
(35, 'andini', 'Andini Maya Sari', 'andini@panganlestari.com', NULL, '$2y$12$JCrGFx6G6urFHRF68smdpOSXNoyUgJcfiS9grZGhpHMZGPRx60DOu', NULL, '2025-12-02 02:56:51', '2025-12-02 02:56:51'),
(36, 'jeany', 'Jeany Prasetya Adi S.', 'jeany.prasetya@panganlestari.com', NULL, '$2y$12$b6ToS0d925fFxRbCzGMSSO9Q7zjmLwj/n1HBD3xLElqSJs75iNrgm', NULL, '2025-12-02 03:04:03', '2025-12-02 03:04:03'),
(37, 'yudinata', 'Yudi Natawijaya', 'yudinata@sekar.co.id', NULL, '$2y$12$eoRO2AHpr1lVmF7SRhuXVupk90Nm9pVjnmnRstYIFIPiUzssG7Msq', NULL, '2025-12-02 03:08:53', '2025-12-02 03:08:53'),
(38, 'tjahjono', 'Tjahjono Haryono', 'tj2004@sekar.co.id', NULL, '$2y$12$d6O9h/ba4vuarMdYA7gOROY9yMaT2WNlrwyriR.M8r1ogI9crIYpy', NULL, '2025-12-08 02:30:03', '2025-12-08 02:30:03'),
(39, 'iwi', 'Iwi Sumbada', 'isumbada@sekar.co.id', NULL, '$2y$12$wfMzd8ON/0QRDb/.6.j1b.8X3API.S7Mw9rngEkAQIuLm1IHJbNg6', NULL, '2025-12-08 02:37:45', '2025-12-08 02:37:45'),
(40, 'donny', 'Donny Kristianto', 'donny_k@sekar.co.id', NULL, '$2y$12$Zyx/LrAfskr9RDGTuUFU1OMEw2g.SFhH4gSDQEtpXW2c/R89qH2QW', NULL, '2025-12-08 02:40:43', '2025-12-08 02:40:43'),
(41, 'dhany', 'Dhany Wibowo', 'dhany.wibowo@sekar.co.id', NULL, '$2y$12$PBspQpmLb1iAf7lgA5URhunswotc7CnsZaJHtb0Wy.Va5oLYai4WK', NULL, '2025-12-08 02:44:23', '2025-12-08 02:44:23'),
(42, 'yohan', 'Yohan Eko Purnomo', 'yohan.plsmg@sekar.co.id', NULL, '$2y$12$wWtC3pn2b/rfQijn16TcsuIVi0.7.0HEILJGkxwVBupln1KqyQMsq', NULL, '2025-12-08 02:45:32', '2025-12-08 02:45:32'),
(43, 'mosi', 'Michael Mosi', 'mosi.plbdg@panganlestari.com', NULL, '$2y$12$p8XG.42Cw1k1D6xhChFz2udh5fn0hJCfOz7ITajAK5SIm6BpPlfjS', NULL, '2025-12-08 02:46:45', '2025-12-08 02:46:45'),
(44, 'mandy', 'Mandy Suryawidjaja', 'mandy@sekar.co.id', NULL, '$2y$12$mJ4EAHOxpINMhzawSr02dOrHyxTZ02IYxWoAm6dpBqVJDYpfYPmW6', NULL, '2025-12-10 02:55:47', '2025-12-10 02:55:47'),
(47, 'aji', 'Aji', 'sulton.aji@panganlestari.com', NULL, '$2y$12$WSxJwLD7OGKp2JYMbsOv7u6aVycOrywUsuWHC4mBQksQDe1MRH8t6', NULL, '2025-12-11 09:25:04', '2025-12-11 09:25:04'),
(48, 'leny', 'Leny Agustiningsih', 'leny@sekar.co.id', NULL, '$2y$12$6Ho6gHuqEDBZQEr1HXDdh.sdXepZS6Nv.mxksEwlm/F1Zjy5XQy6a', NULL, '2025-12-16 14:33:00', '2025-12-16 14:33:00'),
(49, 'noviyanti', 'Noviyanti', 'noviyanti@panganlestari.com', NULL, '$2y$12$z8YhVp6S8mCiOeGN.tGcK.xdYgk6m9QjaydXL/81mFxJ7IoE5TIaC', NULL, '2025-12-23 04:06:14', '2025-12-23 04:06:14'),
(50, 'reni', 'Reni Anggraeni', 'reni@sekar.co.id', NULL, '$2y$12$lmE7OEGxtenjPUNlNrsme.MjIQxAuA7FXvnGZJLit4407Nq0ODZcO', NULL, '2026-01-20 06:20:08', '2026-01-20 06:20:08'),
(51, 'melvina', 'Melvina Fedora', 'melvina.fedora@sekar.co.id', NULL, '$2y$12$vVouCCKvhsnjp1ZmVMpYveDL./GMWkzAd0weg9rKSdo3o0yLy8ys6', NULL, '2026-01-20 06:21:04', '2026-01-20 06:21:04'),
(52, 'ornella', 'Ornella', 'ornella.o@sekar.co.id', NULL, '$2y$12$FP89fbH30FiHAsE93L1XMutCnD.VVb9kv09pKnZIgS/K3hNAR9HCu', NULL, '2026-01-20 06:23:07', '2026-01-20 06:23:07'),
(53, 'felix', 'Felix Budiman', 'felix.budiman@panganlestari.com', NULL, '$2y$12$okTF5lBassE5yNhCMl7mtuXRSPf.YX0jACFX63.828r7CZHN470iq', NULL, '2026-01-20 06:24:10', '2026-01-21 13:49:59'),
(54, 'peri', 'Perisetiawan', 'peri@panganlestari.com', NULL, '$2y$12$.uXdVH7Jm02Fml3V3DJSVePHDdxq4AYo.oOGnm6JUt9l9gW/Tqu/y', NULL, '2026-01-21 07:08:50', '2026-01-21 07:08:50'),
(55, 'Fellik', 'Mohammad Fellik Abyan', 'fellik@sekar.co.id', NULL, '$2y$12$UJcyI9tjAnXlzSyE4wI53.oTgpHmNMRT.SsGGLsWnRsbIrss4Sh4m', NULL, '2026-01-21 13:47:20', '2026-01-21 13:47:20'),
(56, 'meisya', 'Meisya Meilanti Putri', 'meisya@panganlestari.com', NULL, '$2y$12$WW4xxSLPezEFcp1hS.Z5qOvqJv7u2mv2F4Nyv6yprbC3FjJaDzJGa', NULL, '2026-01-27 02:31:59', '2026-01-27 02:31:59'),
(57, 'yobel', 'Christian Yobel', 'christian.yobel@panganlestari.com', NULL, '$2y$12$zXQdkxxEhUo4Wq0u/rJf8.FjblobylQiakTIn7gqF94xVRQu1v.kq', NULL, '2026-01-27 02:32:33', '2026-01-27 02:32:33'),
(58, 'veisya', 'Veisya Mettayanto Viriya', 'veisya.viriya@panganlestari.com', NULL, '$2y$12$L4PyM6JH5Zjrx/nuiUOHuurU.pmPRQ5PGWWSpX2hKJI4qketstGzS', NULL, '2026-01-27 02:33:16', '2026-01-27 02:33:16'),
(59, 'yessica', 'Yessica Carolina Suzanty Thezar', 'yessica.carolina@sekar.co.id', NULL, '$2y$12$hwUFx3P6/UAii.sDUmH2B.VEg543S9EPpwE9XzZEEOuxghYoHKA1W', NULL, '2026-01-27 03:03:32', '2026-01-28 01:20:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dashboard_menus`
--
ALTER TABLE `dashboard_menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dashboard_menus_key_unique` (`key`),
  ADD KEY `dashboard_menus_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `dashboard_settings`
--
ALTER TABLE `dashboard_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dashboard_settings_key_unique` (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dashboard_menus`
--
ALTER TABLE `dashboard_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dashboard_settings`
--
ALTER TABLE `dashboard_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dashboard_menus`
--
ALTER TABLE `dashboard_menus`
  ADD CONSTRAINT `dashboard_menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `dashboard_menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
