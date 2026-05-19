-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2026 at 07:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `balancedbodywellness`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `slug`, `title`, `heading`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'about-us', 'About', 'Perry Grant', '26-02-19-002111.png', '1', NULL, '2026-02-18 19:21:11', '2026-02-18 19:21:11'),
(2, 'resume', 'Perry\'s', 'Resume', '26-02-19-002351.png', '1', NULL, '2026-02-18 19:23:51', '2026-02-18 19:43:40'),
(3, 'gallery', NULL, 'Gallery', '26-02-20-170956.png', '1', NULL, '2026-02-20 12:09:56', '2026-02-20 12:20:44'),
(4, 'videos', NULL, 'Videos', '26-02-20-172146.png', '1', NULL, '2026-02-20 12:21:46', '2026-02-20 12:22:51'),
(5, 'latest-news', NULL, 'Latest news', '26-02-20-172333.png', '1', NULL, '2026-02-20 12:23:33', '2026-02-20 12:24:12'),
(6, 'testimonials', NULL, 'Testimonials', '26-02-20-172446.png', '1', NULL, '2026-02-20 12:24:46', '2026-02-20 12:26:37'),
(7, 'shop-and-contact', 'Schedule', 'Shop & Contact', '26-02-20-172805.png', '1', NULL, '2026-02-20 12:28:05', '2026-02-20 12:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `created_by`, `name`, `slug`, `url`, `email`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'The Tech Designers', 'the-tech-designers', 'https://thetechdesigners.com/', 'bryan@thetechdesigners.com', '20250212170130.png', '1', NULL, '2025-02-12 12:01:30', '2025-02-12 12:01:30'),
(2, NULL, 'Elite Pro Website', 'elite-pro-website', 'https://eliteprowebsite.com/', 'josh@eliteprowebsite.com', '20250212172123.png', '1', NULL, '2025-02-12 12:21:23', '2025-02-12 12:21:23'),
(3, NULL, 'Web Harmony', 'web-harmony', 'https://web-harmony.com/', 'info@web-harmony.com', '20250212172432.webp', '1', NULL, '2025-02-12 12:24:32', '2025-02-12 12:24:32'),
(4, NULL, 'Pixels and the Beast', 'pixels-and-the-beast', 'https://pixelsandthebeast.com/', 'noah@pixelsandthebeast.com', '20250212172733.png', '1', NULL, '2025-02-12 12:27:33', '2025-02-12 12:27:33'),
(5, NULL, 'Web Designs Lab', 'web-designs-lab', 'https://webdesignslab.com/', 'Saulwynn@webdesignslab.com', '20250212172859.webp', '1', NULL, '2025-02-12 12:28:59', '2025-02-12 12:28:59'),
(6, NULL, 'Designs Lord', 'designs-lord', 'https://designslord.com/', 'Steve@designslord.com', '20250212173021.png', '1', NULL, '2025-02-12 12:30:21', '2025-02-12 12:30:21'),
(7, NULL, 'American Brand Designer', 'american-brand-designer', 'https://americanbranddesigner.com/', 'Patrick@americanbranddesigner.com', '20250212173138.png', '1', NULL, '2025-02-12 12:31:38', '2025-02-12 12:31:38'),
(8, NULL, 'American Digital Publishers', 'american-digital-publishers', 'https://www.americandigitalpublishers.com/', 'Lance@americandigitalpublishers.com', '20250212173242.png', '1', NULL, '2025-02-12 12:32:42', '2025-02-12 12:32:42'),
(9, NULL, 'The Web Sense', 'the-web-sense', 'https://thewebsense.com/', 'Mark@thewebsense.com', '20250212173400.png', '1', NULL, '2025-02-12 12:34:00', '2025-02-12 12:34:00'),
(10, NULL, 'Liberty Web Studio', 'liberty-web-studio', 'https://libertywebstudio.com/', 'adam@libertywebstudio.com', '20250212173627.png', '1', NULL, '2025-02-12 12:36:27', '2025-02-12 12:36:27'),
(11, NULL, 'American Digital Agency', 'american-digital-agency', 'https://americandigitalagency.us/', 'support@americandigitalagency.us', '20250212173746.png', '1', NULL, '2025-02-12 12:37:46', '2025-02-12 12:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `message`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Tatiana', 'Patrick', 'qigetylova@mailinator.com', '+1 (104) 308-4146', 'Id et voluptatum co', 'Numquam quidem sit', '1', '2026-02-26 16:58:03', '2026-02-25 13:35:35', '2026-02-26 11:58:03'),
(2, 'Solomon', 'Wooten', 'zodyw@mailinator.com', '+1 (867) 988-5696', 'Ezekiel Todd', 'Ducimus ut ullam fu', '1', NULL, '2026-04-16 18:44:01', '2026-04-16 18:44:01'),
(3, 'Iris', 'Carpenter', 'asjadmmc67@gmail.com', '+1 (342) 322-3924', 'Voluptatem Voluptas dolor neque asperiores qui quia iusto est vel magnam excepteur ullamco at impedit laborum deleniti esse', 'Preferred date: 1984-12-07\n\nTempor porro similique nisi optio labore maxime ullam ex facere aut et maxime', '1', NULL, '2026-05-14 14:26:59', '2026-05-14 14:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `created_by`, `question`, `answer`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'What IV Drips do you offer?', 'We offer an extensive menu of IV Drips, including New Myers, Hangover, and Amplified Beauty. You can always work with your studio\'s registered nurse to create a custom blend tailored for your needs.', '1', NULL, '2026-05-14 12:24:24', '2026-05-18 14:31:54'),
(2, 1, 'What is IV Therapy?', 'IV is an abbreviation for intravenous. It refers to a method of administering saline solution fluids, vitamin infusions or nutrients directly into your bloodstream for maximum absorption using a needle or small tube inserted into the vein.', '1', NULL, '2026-05-14 12:25:32', '2026-05-18 14:32:17'),
(3, 1, 'How much does IV Drip Therapy cost?', 'Prices vary by studio. Visit your local studio or check out your studio\'s local page for pricing menus.\r\nFor all active Members: A $30 up-charge will be added to Universal Membership IV appointments in California Studios for all visiting Members.', '1', NULL, '2026-05-14 12:26:30', '2026-05-18 14:33:15'),
(4, 1, 'Are there any potential side effects of IV Drip Therapy?', 'Side effects are rare and usually limited to local irritation and swelling of the insertion area. The most common sensations are heat and flushing (from magnesium). Your medical history and concerns should be shared during your Telemed call.', '1', NULL, '2026-05-14 12:27:16', '2026-05-18 14:33:41'),
(5, 1, 'Is IV Drip Therapy safe?', 'For healthy adults, intravenous therapy is generally considered safe and effective. However, it can cause side effects. Please discuss concerns with your healthcare provider before receiving IV infusions', '1', NULL, '2026-05-14 12:27:43', '2026-05-18 14:34:18'),
(6, 1, 'What is the typical duration of an IV Drip Therapy session?', 'IV infusions typically take between 60-90 minutes.', '1', NULL, '2026-05-14 12:28:12', '2026-05-18 14:34:48'),
(7, 1, 'When should I get IV Drip Therapy?', 'There are many reasons to get an IV Drip. Many clients get IV infusions before they travel to help boost their immunity. Some clients like to schedule their IV vitamin therapy after an Infrared Sauna session to help replenish their hydration hi and essential nutrients after sweating. Depending on your goals and with the help of expert guidance, you can choose potent vitamin infusions packed with ingredients that can help improve your skin\'s youthful glow, enhance your athletic performance and recovery and increase your energy.', '1', NULL, '2026-05-14 12:28:38', '2026-05-18 14:38:21'),
(8, 1, 'What are some commonly used ingredients in IV Drip Therapy?', 'While ingredients vary by studio, clients will likely find immune-boosting Vitamin C, energy-boosting B Complex, antioxidants like Glutathione and a variety of essential minerals. No matter your goal, this therapy can help restore your body with critical nutrients to help you perform at your best.', '1', NULL, '2026-05-14 12:29:05', '2026-05-18 14:38:45'),
(9, 1, 'What is IV Drip Therapy like?', 'IV vitamin therapy or IV hydration therapy is a relaxing, 60-90 minute experience that may leave you feeling energized, hydrated and ready to take on your next challenge.', '1', NULL, '2026-05-18 14:39:44', '2026-05-18 14:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `title`, `heading`, `description`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Perry Grant Singer', '<p><span>PIANIST &amp; CABARET ENTERTAINER</span></p>', '20-02-2026-190653.png', 1, '2026-04-15 23:56:56', '2026-02-20 14:06:53', '2026-04-15 18:56:56'),
(2, NULL, 'Perry Grant Singer', '<p><span>PIANIST &amp; CABARET ENTERTAINER</span></p>', '20-02-2026-190728.png', 1, '2026-04-15 23:56:53', '2026-02-20 14:07:28', '2026-04-15 18:56:53'),
(3, NULL, 'Perry Grant Singer', '<p><span>PIANIST &amp; CABARET ENTERTAINE</span></p>', '20-02-2026-192931.png', 1, '2026-02-20 19:30:55', '2026-02-20 14:29:31', '2026-02-20 14:30:55'),
(4, NULL, 'Let Us Worry About the Mess While You Enjoy the Clean!', '<p><span>Professional commercial &amp; residential cleaning across Arizona, Nevada, and New Mexico.</span></p>', '15-04-2026-235608.jpg', 1, NULL, '2026-02-20 14:31:27', '2026-04-15 18:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `latest_news`
--

CREATE TABLE `latest_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `heading` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `section_type` varchar(255) DEFAULT NULL COMMENT '0=one image and text below it, 1=two images side by side and text below it, 2=three images side by side and text below it, 3=four images side by side and text below it',
  `section_background` varchar(50) NOT NULL DEFAULT 'detailed-about-section' COMMENT 'detailed-about-section or black-about-section',
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `image_4` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `latest_news`
--

INSERT INTO `latest_news` (`id`, `title`, `heading`, `description`, `section_type`, `section_background`, `image_1`, `image_2`, `image_3`, `image_4`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ea esse ab quia qua', '08-Jun-1992', 'Placeat aliqua Ad Placeat aliqua Ad Placeat aliqua Ad Placeat aliqua Ad Placeat aliqua Ad \r\nPlaceat aliqua Ad \r\nPlaceat aliqua Ad Placeat aliqua Ad', '1', 'black-about-section', '1772754523_69aa165bb3e30.png', '1772754301_69aa157ddf4c0.jpeg', NULL, NULL, '1', '2026-03-05 18:50:44', '2026-03-05 17:01:57', '2026-03-05 18:50:44'),
(2, 'Laborum quia volupta', '03-May-1984', 'Adipisicing harum il Adipisicing harum ilAdipisicing harum ilAdipisicing harum ilAdipisicing harum ilAdipisicing harum il \r\nAdipisicing harum ilAdipisicing harum il\r\nAdipisicing harum il\r\nAdipisicing harum ilAdipisicing harum ilAdipisicing harum ilAdipisicing harum il', '2', 'black-about-section', '1772748566_69a9ff1602dc8.png', '1772748566_69a9ff1603002.png', '1772748566_69a9ff160313f.png', NULL, '1', '2026-03-06 13:56:38', '2026-03-05 17:09:26', '2026-03-06 13:56:38'),
(3, 'Optio ut saepe cill', '17-Apr-1978', 'Quia aperiam et nost Quia aperiam et nost Quia aperiam et nost Quia aperiam et nost', '0', 'detailed-about-section', '1772748646_69a9ff66f305e.png', NULL, NULL, NULL, '1', '2026-03-06 13:56:30', '2026-03-05 17:10:46', '2026-03-06 13:56:30'),
(4, 'Incidunt sunt sunt', '02-Apr-1988', 'Reprehenderit aliqu Reprehenderit aliquReprehenderit aliquReprehenderit aliquReprehenderit aliquReprehenderit aliqu\r\nReprehenderit aliquReprehenderit aliqu\r\nReprehenderit aliquReprehenderit aliquReprehenderit aliqu', '3', 'black-about-section', '1772749192_69aa0188283fe.png', '1772749192_69aa0188285df.png', '1772749192_69aa018828725.png', '1772749192_69aa01882885c.png', '0', '2026-03-06 13:56:27', '2026-03-05 17:19:52', '2026-03-06 13:56:27'),
(5, 'Corporis ex dolor de', '25-Apr-2011', 'Lorem tempore paria', '1', 'black-about-section', '1772753465_69aa123989346.png', '1772753465_69aa123989506.jpg', NULL, NULL, '1', '2026-03-06 13:56:24', '2026-03-05 18:31:05', '2026-03-06 13:56:24'),
(6, 'Nobis ea a non quide', '26-Jan-1998', 'Ullam voluptatem pr', '0', 'detailed-about-section', '1772753485_69aa124d99878.png', NULL, NULL, NULL, '1', '2026-03-06 13:56:41', '2026-03-05 18:31:25', '2026-03-06 13:56:41'),
(7, 'Labore nobis aliquip', '26-Mar-1970', 'Vero fugiat dolores', '1', 'black-about-section', '1772753513_69aa12691b55c.png', '1772753513_69aa12691b6f2.png', NULL, NULL, '1', '2026-03-06 13:56:51', '2026-03-05 18:31:53', '2026-03-06 13:56:51'),
(8, 'Eos temporibus quis', '31-Jan-2002', 'Id ratione et simili', '3', 'black-about-section', '1772753553_69aa129185144.png', '1772753553_69aa129185681.png', '1772753553_69aa1291858d0.png', '1772753553_69aa129185a68.png', '1', '2026-03-06 13:56:48', '2026-03-05 18:32:33', '2026-03-06 13:56:48'),
(9, 'Omnis et aliquam dol', '28-Sep-1984', 'Sint molestias maio', '1', 'detailed-about-section', '1772753578_69aa12aa59f6a.png', '1772753578_69aa12aa5a165.png', NULL, NULL, '1', '2026-03-06 13:56:45', '2026-03-05 18:32:58', '2026-03-06 13:56:45'),
(10, 'Cumque eu cillum exp', '08-Jul-1975', 'Saepe eos cum aut l', '0', 'black-about-section', '1772754658_69aa16e2c2994.png', NULL, NULL, NULL, '1', '2026-03-06 13:56:54', '2026-03-05 18:50:58', '2026-03-06 13:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_06_183800_create_permission_tables', 1),
(13, '2022_04_19_205847_create_vehicles_table', 6),
(14, '2022_03_09_150353_create_categories_table', 7),
(15, '2022_03_09_150337_create_blogs_table', 8),
(18, '2022_04_25_174651_create_r_v_s_table', 10),
(19, '2022_04_25_211456_create_virtual_tours_table', 11),
(23, '2022_04_27_183505_create_about_us_table', 13),
(24, '2022_04_27_220336_create_car_rents_table', 14),
(25, '2022_04_27_220336_create_steps_of_rent_table', 15),
(26, '2022_02_03_080357_create_settings_table', 16),
(29, '2022_05_09_174141_create_cetagories_table', 19),
(32, '2022_03_09_150353_create_blogcategories_table', 21),
(34, '2022_05_09_190227_blog_categories', 22),
(40, '2022_05_11_213649_create_deals_table', 25),
(45, '2022_03_14_084656_create_pages_table', 30),
(46, '2022_03_14_143426_create_page_settings_table', 31),
(49, '2022_05_17_200135_create_products_table', 34),
(50, '2022_05_17_200819_create_product_details_table', 35),
(52, '2022_05_17_201443_create_product_images_table', 36),
(54, '2022_05_09_174141_create_categories_table', 38),
(55, '2022_05_09_174141_create_car_types_table', 39),
(56, '2022_04_27_220336_create_how_to_rents_table', 40),
(57, '2022_05_18_192740_create_cities_table', 41),
(58, '2022_05_18_193028_create_states_table', 42),
(61, '2022_05_17_184901_create_bookings_table', 44),
(62, '2022_05_18_203240_create_appointments_table', 45),
(63, '2022_05_18_194530_create_pick_drop_locations_table', 46),
(66, '2022_05_16_180452_create_payments_table', 47),
(67, '2022_05_23_172759_create_payment_details_table', 48),
(68, '2022_06_10_230308_create_our_locations_table', 49),
(70, '2022_04_20_195848_create_properties_table', 50),
(72, '2022_08_02_154123_create_properties_details_table', 52),
(79, '2022_07_30_003954_create_agents_table', 54),
(80, '2014_10_12_000000_create_users_table', 55),
(82, '2022_08_12_164939_create_properties_areas_table', 56),
(85, '2022_08_22_183555_create_client_contacts_table', 58),
(93, '2022_09_06_170412_create_home_browse_table', 59),
(94, '2022_10_06_161808_create_home_sliders_table', 60),
(95, '2022_10_07_205942_create_our_services_table', 61),
(96, '2022_04_26_181343_create_galleries_table', 62),
(97, '2022_05_30_171946_create_gallery_details_table', 63),
(99, '2022_10_26_160340_create_packages_table', 65),
(103, '2023_05_18_231449_create_paragon_logistics_table', 67),
(104, '2023_05_19_233156_create_express_shippings_table', 68),
(105, '2023_05_22_211211_create_skyway_shippings_table', 69),
(106, '2023_05_22_205237_create_mass_shippings_table', 70),
(107, '2023_05_22_205953_create_six_star_logistics_table', 71),
(110, '2022_10_24_181813_create_bookings_table', 73),
(111, '2022_09_20_164856_create_leeds_table', 74),
(112, '2022_05_18_190010_create_contacts_table', 75),
(113, '2022_05_04_171218_create_news_letters_table', 76),
(115, '2024_02_01_214156_create_staging_links_table', 77),
(119, '2024_05_21_151445_create_quotations_table', 78),
(124, '2024_08_13_183626_create_billing_addresses_table', 80),
(125, '2024_08_13_183748_create_shipping_addresses_table', 81),
(126, '2024_08_13_232959_create_invoice_items_table', 82),
(128, '2024_08_12_172745_create_invoices_table', 83),
(131, '2024_08_19_210031_create_purchase_order_items_table', 85),
(134, '2024_08_19_174001_create_purchase_orders_table', 88),
(137, '2024_08_19_210726_create_p__o__shippings_table', 91),
(138, '2024_08_19_210448_create_p__o__vendors_table', 92),
(143, '2025_02_11_204943_create_web_links_table', 97),
(144, '2025_02_12_152941_create_brands_table', 98),
(145, '2022_05_19_182732_create_banners_table', 99),
(147, '2022_02_03_082236_create_testimonials_table', 100),
(148, '2026_02_23_174600_fix_testimonials_deleted_at_column', 101),
(149, '2022_05_18_190058_create_contact_us_table', 102),
(150, '2026_02_23_180000_change_contact_us_message_to_text', 103),
(152, '2026_02_24_201800_create_audio_table', 105),
(153, '2026_02_24_201807_create_photo_galleries_table', 106),
(154, '2026_02_25_174313_create_shop_contacts_table', 107),
(157, '2026_03_05_202415_create_latest_news_table', 108),
(159, '2026_03_11_194327_create_schedule_shop_contacts_table', 109),
(160, '2026_02_24_201750_create_videos_table', 110),
(161, '2026_05_06_000001_add_thumbnail_url_to_videos_table', 111),
(162, '2026_05_06_120000_add_thumbnail_url_to_videos_table', 112),
(163, '2022_04_12_203003_create_faqs_table', 113),
(164, '2026_05_14_175626_create_policies_table', 114),
(165, '2026_05_18_200321_create_services_table', 115),
(166, '2026_05_19_120000_alter_services_questions_benefits_to_text', 116);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 24),
(2, 'App\\Models\\User', 25),
(2, 'App\\Models\\User', 26),
(2, 'App\\Models\\User', 27),
(2, 'App\\Models\\User', 28),
(2, 'App\\Models\\User', 29),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 31),
(2, 'App\\Models\\User', 32),
(2, 'App\\Models\\User', 33),
(2, 'App\\Models\\User', 34),
(2, 'App\\Models\\User', 35);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `created_by`, `title`, `slug`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Header', 'header', '<p>Website Header</p>', NULL, NULL, NULL, 1, NULL, '2022-06-03 18:22:30', '2026-03-03 12:40:35'),
(22, 1, 'Home About', 'home-about', '<p>About detail on home page</p>', NULL, NULL, NULL, 1, '2026-05-14 19:31:12', '2026-02-24 13:59:33', '2026-05-14 14:31:12'),
(23, 1, 'Latest News', 'latest-news', '<p>Latest News Page&nbsp;</p>\r\n<div>\r\n<div>2026 Future assignments</div>\r\n</div>', NULL, NULL, NULL, 1, '2026-04-29 22:18:15', '2026-03-03 12:38:40', '2026-04-29 17:18:15'),
(24, 1, 'Schedule Shop & Contact', 'schedule-shop-contact', '<p>Schedule Shop &amp; Contact Page</p>', NULL, NULL, NULL, 1, '2026-04-29 22:18:19', '2026-03-11 15:10:09', '2026-04-29 17:18:19'),
(25, 1, 'Home Shows & Appearances', 'shows-appearances', '<div>\r\n<div>Shows &amp; Appearances on home page</div>\r\n</div>', NULL, NULL, NULL, 1, '2026-04-29 22:18:23', '2026-04-03 18:49:05', '2026-04-29 17:18:23'),
(26, 1, 'Britains Got Talent', 'britains-got-talent', '<p>Perry Grant On Britains Got Talent</p>', NULL, NULL, NULL, 1, '2026-04-29 22:18:26', '2026-04-10 14:45:19', '2026-04-29 17:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `page_settings`
--

CREATE TABLE `page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_slug` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(2000) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_settings`
--

INSERT INTO `page_settings` (`id`, `parent_slug`, `key`, `value`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'header', '_token', 'dfYLVJ7m5v909OKmOxjUbLtzYSLynv6Oq2e2YJiJ', NULL, '2022-06-03 18:31:33', '2026-02-20 12:30:05'),
(2, 'header', 'parent_slug', 'header', NULL, '2022-06-03 18:31:33', '2022-06-03 18:31:33'),
(3, 'header', 'form_blog', NULL, NULL, '2022-06-03 18:31:33', '2022-06-03 18:31:33'),
(4, 'header', 'header_favicon', '13052026235412.png', NULL, '2022-06-03 18:31:33', '2026-05-13 18:54:12'),
(5, 'header', 'header_logo', '13052026235412.png', NULL, '2022-06-03 18:31:33', '2026-05-13 18:54:12'),
(6, 'footer', '_token', 'xEi2jZ3Kr1YPMfDlXuClmqFqa1bzdcXjay8JAo4b', NULL, '2022-06-03 18:41:30', '2023-05-18 17:45:43'),
(7, 'footer', 'parent_slug', 'footer', NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(8, 'footer', 'footer_description', '<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>', NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(9, 'footer', 'footer_whatsapp', 'https://web.whatsapp.com/', NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(10, 'footer', 'footer_facebook', 'https://www.facebook.com/', NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(11, 'footer', 'footer_youtube', 'https://www.youtube.com/', NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(12, 'footer', 'footer_instagram', 'https://www.instagram.com/', NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(13, 'footer', 'footer_copy_right_right_side', '<p style=\"margin-bottom:0\">Site Design and Developed by <a href=\"https://pixelslogo.com/\" target=\"_blank\" style=\"color: #ffffff;\">Pixels Logo</a></p>', NULL, '2022-06-03 18:41:30', '2022-10-07 11:39:10'),
(14, 'footer', 'footer_copy_right_left_side', '© 2022 CARMALITA M MCQUEENAll Rights Reserved', NULL, '2022-06-03 18:41:30', '2022-10-07 11:31:45'),
(15, 'footer', 'form_blog', NULL, NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(16, 'footer', 'footer_image', '18052023224610.png', NULL, '2022-06-03 18:41:30', '2023-05-18 17:46:10'),
(17, 'privacy-policy', '_token', '82dfeZpiFjxHDPqgysPMaPkzUl1oawSchT9wNuXk', NULL, '2022-06-11 00:27:29', '2022-08-03 15:26:11'),
(18, 'privacy-policy', 'parent_slug', 'privacy-policy', NULL, '2022-06-11 00:27:29', '2022-06-11 00:27:29'),
(19, 'privacy-policy', 'mt_service', 'CHAFF MISSION', NULL, '2022-06-11 00:27:29', '2022-06-11 00:27:29'),
(20, 'privacy-policy', 'mk_service', 'WELCOME TO COMPANY', NULL, '2022-06-11 00:27:29', '2022-06-11 00:27:29'),
(21, 'privacy-policy', 'md_service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', NULL, '2022-06-11 00:44:47', '2022-06-11 00:44:47'),
(22, 'privacy-policy', 'service_heading', 'SED UT PERSPICIATIS', NULL, '2022-06-11 00:44:47', '2022-06-11 00:44:47'),
(23, 'privacy-policy', 'service_content', '<div class=\"row about-row-first flex-row-reverse\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>\r\n<div class=\"row last-para\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>', NULL, '2022-06-11 00:45:21', '2022-06-11 00:45:21'),
(24, 'privacy-policy', 'form_service', NULL, NULL, '2022-06-11 00:45:21', '2022-06-11 00:45:21'),
(25, 'terms-conditions', '_token', 'hhgxtxQppQrKlX9z6avTd3VmmZsRHIdv7E2Sy7mR', NULL, '2022-06-11 00:46:41', '2022-08-30 05:00:18'),
(26, 'terms-conditions', 'parent_slug', 'terms-conditions', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(27, 'terms-conditions', 'mt_service', 'CHAFF MISSION', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(28, 'terms-conditions', 'mk_service', 'WELCOME TO COMPANY', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(29, 'terms-conditions', 'md_service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(30, 'terms-conditions', 'service_heading', 'SED UT PERSPICIATIS', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(31, 'terms-conditions', 'service_content', '<div class=\"row about-row-first flex-row-reverse\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>\r\n<div class=\"row last-para\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(32, 'terms-conditions', 'form_service', NULL, NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(79, 'privacy-policy', 'mt_privacy', 'DGT PROPERTIES', NULL, '2022-06-14 17:01:12', '2022-08-03 15:32:25'),
(80, 'privacy-policy', 'mk_privacy', 'WELCOME TO COMPANY', NULL, '2022-06-14 17:01:12', '2022-06-14 17:01:12'),
(81, 'privacy-policy', 'md_privacy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', NULL, '2022-06-14 17:01:12', '2022-06-14 17:01:12'),
(82, 'privacy-policy', 'privacy_heading', 'SED UT PERSPICIATIS', NULL, '2022-06-14 17:01:12', '2022-06-14 17:01:12'),
(83, 'privacy-policy', 'privacy_content', '<div class=\"row about-row-first flex-row-reverse\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>', NULL, '2022-06-14 17:01:12', '2022-08-03 15:32:25'),
(84, 'terms-conditions', 'mt_term', 'DGT PROPERTIES', NULL, '2022-06-14 17:13:09', '2022-08-03 15:55:06'),
(85, 'terms-conditions', 'mk_term', 'WELCOME TO COMPANY', NULL, '2022-06-14 17:13:09', '2022-08-30 05:00:30'),
(86, 'terms-conditions', 'md_term', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', NULL, '2022-06-14 17:13:09', '2022-06-14 17:13:09'),
(87, 'terms-conditions', 'term_heading', 'SED UT PERSPICIATIS', NULL, '2022-06-14 17:13:09', '2022-06-14 17:13:09'),
(88, 'terms-conditions', 'term_content', '<div class=\"row about-row-first flex-row-reverse\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>\r\n<div class=\"row last-para\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>\r\n</div>', NULL, '2022-06-14 17:13:09', '2022-08-03 15:57:12'),
(105, 'home', '_token', 'gMYos8lEZeZjK34FBjZqhCprNmOXqqi7nsuHo3DV', NULL, '2022-06-14 18:23:16', '2022-09-06 11:36:57'),
(106, 'home', 'parent_slug', 'home', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(107, 'home', 'banner_heading', NULL, NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(108, 'home', 'location_title', 'OUR LOCATION', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(109, 'home', 'location_keyword', 'CLICK THE PIN TO FIND', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(110, 'home', 'location_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(111, 'home', 'form_home_blog', NULL, NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(112, 'footer', 'footer_twitter', 'https://twitter.com/', NULL, '2022-07-29 17:06:58', '2022-07-29 17:06:58'),
(113, 'footer', 'footer_linkedin', 'https://www.linkedin.com/', NULL, '2022-07-29 17:06:58', '2022-07-29 17:06:58'),
(114, 'header', 'header_call_us_now', NULL, NULL, '2022-07-29 17:27:09', '2024-05-14 16:39:56'),
(115, 'header', 'header_email', NULL, NULL, '2022-07-29 17:27:09', '2024-05-14 16:39:56'),
(116, 'footer', 'footer_address', 'Office # 123, Street 123, Country Xyz.', NULL, '2022-07-29 17:58:12', '2022-07-29 17:58:12'),
(117, 'about-us', '_token', 'otQTHPRlVALxIr4ETRqaxbh9VuCdN7y35ZfojWLj', NULL, '2022-08-15 11:45:13', '2022-10-10 12:15:30'),
(118, 'about-us', 'parent_slug', 'about-us', NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(119, 'about-us', 'about_heading', 'More About Us', NULL, '2022-08-15 11:45:13', '2022-08-23 13:50:45'),
(120, 'about-us', 'about_head_description', '<p>We are an upcoming real estate company, and we want you to grow and partner with us. With a solid foundation in the word of God in everything we do, our main focus is to treat everyone with integrity, compassion, care and to always put others interest above our own. Regardless of race, color, national origin, religion, or sexual orientation, we are here to help and to put every customer in a home of there choice. &nbsp;&nbsp;&nbsp;</p>', NULL, '2022-08-15 11:45:13', '2022-08-23 13:01:51'),
(121, 'about-us', 'title_one', 'Our Mission', NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(122, 'about-us', 'about_title_one_description', '<p>To be there when you need us. You can trust, believe, and count on us. We will always be driving the distance for you.</p>', NULL, '2022-08-15 11:45:13', '2022-08-23 13:00:31'),
(123, 'about-us', 'title_two', 'Our Vision', NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(124, 'about-us', 'about_title_two_description', '<p>Always looking forward to finding and building an authentic and lasting relationship with every customer, agent, and employee by being a faithful steward and with devotion to helping others.</p>', NULL, '2022-08-15 11:45:13', '2022-08-23 13:00:31'),
(125, 'about-us', 'title_three', 'Our Values', NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(126, 'about-us', 'about_title_three_description', '<p>We stand on the word of God which instills Integrity, Compassion, and Respect in all that we do. Managers, agents, and employees put our customers first above all else to help them find their Dream Home. &nbsp;&nbsp;</p>', NULL, '2022-08-15 11:45:13', '2022-08-23 13:00:31'),
(127, 'about-us', 'title_four', NULL, NULL, '2022-08-15 11:45:13', '2022-08-23 11:41:48'),
(128, 'about-us', 'about_title_four_description', NULL, NULL, '2022-08-15 11:45:13', '2022-08-23 11:41:48'),
(129, 'about-us', 'about_status', '1', NULL, '2022-08-15 11:45:13', '2022-08-15 12:15:38'),
(130, 'about-us', 'form_about', NULL, NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(131, 'faqs', '_token', 'nyT5Y8lJ7rVQmsPPP174ncnUhmWdREYx7eSSEELA', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(132, 'faqs', 'parent_slug', 'faqs', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(133, 'faqs', 'faqs_title', 'LOREM IPSUM DOLOR SIT AMET', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(134, 'faqs', 'faqs_description', 'FREQUENTLY ASKED QUESTIONS', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(135, 'faqs', 'faqs_question', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(136, 'faqs', 'faqs_answer', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(137, 'faqs', 'form_service', NULL, NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(138, 'header', 'footer_facebook', NULL, NULL, '2022-08-29 18:03:41', '2026-03-27 17:50:54'),
(139, 'header', 'footer_twitter', NULL, NULL, '2022-08-29 18:03:41', '2026-03-27 17:50:54'),
(140, 'header', 'footer_instagram', NULL, NULL, '2022-08-29 18:03:41', '2024-05-14 16:39:56'),
(141, 'header', 'footer_linkedin', NULL, NULL, '2022-08-29 18:03:41', '2026-03-27 17:50:54'),
(142, 'home', 'browse_title', 'Browse Listings by Category', NULL, '2022-09-06 11:36:57', '2022-09-06 11:36:57'),
(143, 'home', 'browse_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod\r\nincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nexercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum\r\nfugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,\r\nsunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '2022-09-06 11:36:57', '2022-09-06 11:38:24'),
(144, 'listing', '_token', 'R5kzP3maR6L8pAgC96dKKzANab6RkQdCBpp7VN4h', NULL, '2022-09-07 12:11:46', '2022-09-07 12:11:46'),
(145, 'listing', 'parent_slug', 'listing', NULL, '2022-09-07 12:11:46', '2022-09-07 12:11:46'),
(146, 'listing', 'for_sale_title', 'For Sale', NULL, '2022-09-07 12:11:46', '2022-09-07 13:00:38'),
(147, 'listing', 'for_sale_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '2022-09-07 12:11:46', '2022-09-07 13:00:38'),
(148, 'listing', 'for_rent_title', 'For Rent', NULL, '2022-09-07 12:11:46', '2022-09-07 13:01:07'),
(149, 'listing', 'for_rent_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '2022-09-07 12:11:46', '2022-09-07 13:01:07'),
(150, 'listing', 'form_blog', NULL, NULL, '2022-09-07 12:11:46', '2022-09-07 12:11:46'),
(151, 'listing', 'for_sale', '07092022171146.jfif', NULL, '2022-09-07 12:11:46', '2022-09-07 12:11:46'),
(152, 'listing', 'for_rent', '07092022171146.png', NULL, '2022-09-07 12:11:46', '2022-09-07 12:11:46'),
(153, 'listing', 'image_for_sale', '07092022180038.png', NULL, '2022-09-07 12:27:33', '2022-09-07 13:00:38'),
(154, 'listing', 'image_for_rent', '07092022180139.png', NULL, '2022-09-07 12:37:09', '2022-09-07 13:01:39'),
(155, 'contact-us', '_token', 'RDorzeuLM1QZzwM75QJtEj30punMWHaZNMxbrMff', NULL, '2022-09-07 16:02:46', '2022-10-24 16:24:32'),
(156, 'contact-us', 'parent_slug', 'contact-us', NULL, '2022-09-07 16:02:46', '2022-09-07 16:02:46'),
(157, 'contact-us', 'contact_map', '<iframe src=\"https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', NULL, '2022-09-07 16:02:46', '2022-10-24 16:24:32'),
(158, 'contact-us', 'form_contact', NULL, NULL, '2022-09-07 16:02:46', '2022-09-07 16:02:46'),
(159, 'home-about', '_token', 'BMbTSiusxUNjI6iKXSbJiLbwoQspZUBAgIU9k6if', NULL, '2022-10-06 18:22:20', '2022-10-06 18:22:20'),
(160, 'home-about', 'parent_slug', 'home-about', NULL, '2022-10-06 18:22:20', '2022-10-06 18:22:20'),
(161, 'home-about', 'home_about_title', NULL, NULL, '2022-10-06 18:22:20', '2026-04-29 17:14:24'),
(162, 'home-about', 'home_about_heading', 'We Plan The Most Beautiful Event And Organized That Event', NULL, '2022-10-06 18:22:20', '2022-10-06 18:29:58'),
(163, 'home-about', 'home_about_description', NULL, NULL, '2022-10-06 18:22:20', '2026-04-29 17:14:24'),
(164, 'home-about', 'form_about', NULL, NULL, '2022-10-06 18:22:20', '2022-10-06 18:22:20'),
(165, 'home-about', 'short_description', 'Carmalita M Mcqueen', NULL, '2022-10-06 18:28:24', '2022-10-06 18:29:58'),
(166, 'about-us', 'aboutus_heading', 'ABOUT ME', NULL, '2022-10-10 12:15:30', '2022-10-10 14:17:00'),
(167, 'about-us', 'aboutus_description', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. &nbsp;amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. &nbsp;amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>', NULL, '2022-10-10 12:15:30', '2022-10-10 14:17:00'),
(168, 'about-us', 'aboutus_title', 'Carmalita M Mcqueen', NULL, '2022-10-10 12:15:30', '2022-10-10 12:15:30'),
(169, 'about-us', 'heading_two', 'We Plan The Most Beautiful Event And Organized That Event', NULL, '2022-10-10 12:15:30', '2022-10-10 14:05:09'),
(170, 'about-us', 'about_description_two', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. &nbsp;amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. &nbsp;amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus comm odo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipis cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Risus commodo vivrra maecenas accumsan lacus vel facilisis. &nbsp;amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>', NULL, '2022-10-10 12:15:30', '2022-10-10 12:20:34'),
(171, 'about-us', 'about_first_image', '10102022183751.png', NULL, '2022-10-10 12:15:30', '2022-10-10 13:37:51'),
(172, 'about-us', 'about_second_image', '10102022171530.png', NULL, '2022-10-10 12:15:30', '2022-10-10 12:15:30'),
(173, 'wedding-packages', '_token', 'otQTHPRlVALxIr4ETRqaxbh9VuCdN7y35ZfojWLj', NULL, '2022-10-10 13:26:31', '2022-10-10 13:26:31'),
(174, 'wedding-packages', 'parent_slug', 'wedding-packages', NULL, '2022-10-10 13:26:31', '2022-10-10 13:26:31'),
(178, 'wedding-packages', 'wedding_heading', 'Wedding Packages', NULL, '2022-10-10 13:31:00', '2022-10-10 13:54:11'),
(179, 'wedding-packages', 'wedding_description', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo&nbsp; viverra maecenas accumsan lacus vel facilisis.</p>', NULL, '2022-10-10 13:31:00', '2022-10-10 13:54:11'),
(180, 'contact-us', 'contact_heading', 'Feel Free To Contact Us', NULL, '2022-10-24 16:24:32', '2022-10-24 16:24:32'),
(181, 'contact-us', 'contact_address', 'Office # 123, Street 123, Country Xyz.', NULL, '2022-10-24 16:24:32', '2022-10-24 16:24:32'),
(182, 'contact-us', 'contact_phone', '+0112345678', NULL, '2022-10-24 16:24:32', '2022-10-24 16:24:32'),
(183, 'contact-us', 'contact_email', 'Info@ourinfomail.com', NULL, '2022-10-24 16:24:32', '2022-10-24 16:24:32'),
(184, 'home-about', 'home_about_bullets', '[null]', NULL, '2026-02-24 14:07:20', '2026-04-29 17:14:24'),
(185, 'home-about', 'home_about_image', '24022026191319.png', NULL, '2026-02-24 14:13:19', '2026-02-24 14:13:19'),
(186, 'home-about', 'home_about_active_status', '1', NULL, '2026-02-24 14:25:09', '2026-02-24 15:06:28'),
(187, 'latest-news', 'latest_news_title', '2026 Future assignments', NULL, '2026-03-03 12:46:26', '2026-03-03 12:46:26'),
(188, 'latest-news', 'latest_news_description', NULL, NULL, '2026-03-03 12:46:26', '2026-03-03 12:54:43'),
(189, 'latest-news', 'latest_news_bullets', '[\"Enchantment of the Seas ; Royal Caribbean out of Tampa Jan31-April 25 2026\",\"Vision of the Seas Aug 1st-Sept 24 2024\",\"Jane McDonald Charter Cruise 2-9th Oct 2026\",\"Yeadon Town hall Christmas show Dec 5 2026 ( In discussion -not confirmed )\"]', NULL, '2026-03-03 12:46:27', '2026-03-03 12:46:27'),
(190, 'latest-news', 'latest_news_active_status', '1', NULL, '2026-03-03 12:46:27', '2026-03-03 15:31:23'),
(191, 'latest-news', 'form_latest_news', NULL, NULL, '2026-03-03 12:46:27', '2026-03-03 12:46:27'),
(192, 'latest-news', 'latest_news_image', '03032026175641.png', NULL, '2026-03-03 12:46:27', '2026-03-03 12:56:41'),
(193, 'schedule-shop-contact', 'schedule_shop_contact_title', 'Future Engagements and Schedule', NULL, '2026-03-11 15:16:03', '2026-03-11 15:16:03'),
(194, 'schedule-shop-contact', 'schedule_shop_contact_description', '<p>2026 Future assignments</p>', NULL, '2026-03-11 15:16:03', '2026-03-11 15:16:03'),
(195, 'schedule-shop-contact', 'schedule_shop_contact_bullets', '[\"Enchantment of the Seas ; Royal Caribbean out of Tampa Jan31-April 25 2026\",\"Vision of the Seas Aug 1st-Sept 24 2024\",\"Jane McDonald Charter Cruise 2-9th Oct 2025\",\"Yeadon Town hall Christmas show Dec 5 2025 ( In discussion -not confirmed )\"]', NULL, '2026-03-11 15:16:03', '2026-03-11 15:29:55'),
(196, 'schedule-shop-contact', 'schedule_shop_contact_active_status', '1', NULL, '2026-03-11 15:16:03', '2026-03-11 15:30:23'),
(197, 'schedule-shop-contact', 'form_schedule_shop_contact', NULL, NULL, '2026-03-11 15:16:03', '2026-03-11 15:16:03'),
(198, 'schedule-shop-contact', 'schedule_shop_contact_image', '11032026201603.webp', NULL, '2026-03-11 15:16:03', '2026-03-11 15:16:03'),
(199, 'schedule-shop-contact', 'schedule_shop_contact_contact_email_1', 'perrygmusic@hotmail.com', NULL, '2026-03-13 18:23:12', '2026-03-13 18:52:53'),
(200, 'schedule-shop-contact', 'schedule_shop_contact_contact_email_2', 'perrygmusic@gmail.com', NULL, '2026-03-13 18:23:12', '2026-03-13 18:23:12'),
(201, 'schedule-shop-contact', 'schedule_shop_contact_youtube_text', 'For Youtube Channel and to follow click the link here for videos of performances etc', NULL, '2026-03-13 18:52:54', '2026-03-13 18:54:00'),
(202, 'schedule-shop-contact', 'schedule_shop_contact_youtube_url', 'https://www.youtube.com/@mrperrygrant', NULL, '2026-03-13 18:52:54', '2026-03-13 19:01:16'),
(203, 'schedule-shop-contact', 'schedule_shop_contact_facebook_heading', 'There are a number of Facebook Pages.', NULL, '2026-03-13 18:52:55', '2026-03-13 19:01:40'),
(204, 'schedule-shop-contact', 'schedule_shop_contact_facebook1_text', '1. Perry Grant ( Most popular ..followers only now )', NULL, '2026-03-13 18:52:55', '2026-03-13 19:03:48'),
(205, 'schedule-shop-contact', 'schedule_shop_contact_facebook1_url', 'https://www.facebook.com/perry.grant.58', NULL, '2026-03-13 18:52:55', '2026-03-13 19:03:48'),
(206, 'schedule-shop-contact', 'schedule_shop_contact_facebook2_text', '2. The Official Facebook Page of Perry Grant', NULL, '2026-03-13 18:52:55', '2026-03-13 19:03:49'),
(207, 'schedule-shop-contact', 'schedule_shop_contact_facebook2_url', 'https://www.facebook.com/perrygrantentertainer', NULL, '2026-03-13 18:52:55', '2026-03-13 19:03:49'),
(208, 'schedule-shop-contact', 'schedule_shop_contact_facebook3_text', '3. The Fans of Perry Grant', NULL, '2026-03-13 18:52:55', '2026-03-13 19:03:49'),
(209, 'schedule-shop-contact', 'schedule_shop_contact_facebook3_url', 'https://www.facebook.com/share/g/182LVEXsLF/', NULL, '2026-03-13 18:52:55', '2026-03-13 19:03:49'),
(210, 'schedule-shop-contact', 'schedule_shop_contact_instagram_text', 'Stay in touch on Instagram', NULL, '2026-03-13 18:52:55', '2026-03-13 19:05:31'),
(211, 'schedule-shop-contact', 'schedule_shop_contact_instagram_url', 'https://www.instagram.com/perrygmusic/', NULL, '2026-03-13 18:52:55', '2026-03-13 19:05:31'),
(212, 'schedule-shop-contact', 'schedule_shop_contact_twitter_title', 'For X /Twitter', NULL, '2026-03-13 18:52:55', '2026-03-13 19:05:31'),
(213, 'schedule-shop-contact', 'schedule_shop_contact_twitter_url', 'https://x.com/PerryG', NULL, '2026-03-13 18:52:55', '2026-03-13 19:05:31'),
(214, 'schedule-shop-contact', 'schedule_shop_contact_starnow_title', 'Star Now Link', NULL, '2026-03-13 18:52:56', '2026-03-13 19:05:31'),
(215, 'schedule-shop-contact', 'schedule_shop_contact_starnow_url', 'https://www.starnow.com/u/perrygrant/', NULL, '2026-03-13 18:52:56', '2026-03-13 19:05:31'),
(216, 'schedule-shop-contact', 'schedule_shop_contact_gary_heading1', 'Perry Grant Is represented by Gary Parkes of Gary Parkes Music International', NULL, '2026-03-13 18:52:56', '2026-03-13 19:06:29'),
(217, 'schedule-shop-contact', 'schedule_shop_contact_gary_tel', '+44 (0) 207-794-1581', NULL, '2026-03-13 18:52:56', '2026-03-13 19:06:29'),
(218, 'schedule-shop-contact', 'schedule_shop_contact_gary_email', 'gary@garyparkes.com', NULL, '2026-03-13 18:52:56', '2026-03-13 19:06:29'),
(219, 'schedule-shop-contact', 'schedule_shop_contact_usa_heading', 'In The USA Perry Grant is represented by', NULL, '2026-03-13 18:52:56', '2026-03-13 19:08:10'),
(220, 'schedule-shop-contact', 'schedule_shop_contact_usa_address', 'The Entertainment Agency • 172 Main Street • Spencer, MA 01562-2117 USA', NULL, '2026-03-13 18:52:56', '2026-03-13 19:08:10'),
(221, 'schedule-shop-contact', 'schedule_shop_contact_usa_phone_fax', '+1 508-885-6911 • Fax: +1 508-885-6912 • enquiries@entagency.com(link sends e-mail)', NULL, '2026-03-13 18:52:56', '2026-03-13 19:08:10'),
(222, 'schedule-shop-contact', 'schedule_shop_contact_usa_url', 'https://www.entagency.com/grant', NULL, '2026-03-13 18:52:56', '2026-03-13 19:08:10'),
(223, 'schedule-shop-contact', 'schedule_shop_contact_usa_image', '14032026000810.png', NULL, '2026-03-13 19:08:10', '2026-03-13 19:08:10'),
(224, 'schedule-shop-contact', 'schedule_shop_contact_bottom_image', '14032026000907.png', NULL, '2026-03-13 19:09:07', '2026-03-13 19:09:07'),
(225, 'header', 'form_header', NULL, NULL, '2026-03-27 17:50:54', '2026-03-27 17:50:54'),
(226, 'shows-appearances', 'home_about_title', 'Shows & Appearances', NULL, '2026-04-03 19:27:52', '2026-04-03 19:27:52'),
(227, 'shows-appearances', 'shows_appearances_left_video', 'https://www.youtube.com/embed/yz1VumL5IL0', NULL, '2026-04-03 19:27:52', '2026-04-03 20:13:52'),
(228, 'shows-appearances', 'shows_appearances_right_video', 'https://www.youtube.com/embed/zcBu7_TqAXA', NULL, '2026-04-03 19:27:52', '2026-04-03 20:14:19'),
(229, 'shows-appearances', 'shows_appearances_active_status', '1', NULL, '2026-04-03 19:27:52', '2026-04-03 19:27:52'),
(230, 'shows-appearances', 'form_shows_appearances', NULL, NULL, '2026-04-03 19:27:52', '2026-04-03 19:27:52'),
(231, 'shows-appearances', 'experience_the_music', '04042026002804.png', NULL, '2026-04-03 19:27:52', '2026-04-03 19:28:04'),
(232, 'shows-appearances', 'upcoming_performances', '04042026002823.png', NULL, '2026-04-03 19:27:52', '2026-04-03 19:28:23'),
(233, 'shows-appearances', 'schedule_shop', '04042026002832.png', NULL, '2026-04-03 19:27:52', '2026-04-03 19:28:32'),
(234, 'shows-appearances', 'shows_card1_title', 'Experience the Music.', NULL, '2026-04-03 19:38:02', '2026-04-03 19:38:02'),
(235, 'shows-appearances', 'experience_the_music_read_more', '#audio', NULL, '2026-04-03 19:38:02', '2026-04-03 19:38:02'),
(236, 'shows-appearances', 'shows_card2_title', 'Upcoming Performances', NULL, '2026-04-03 19:38:02', '2026-04-03 19:40:30'),
(237, 'shows-appearances', 'upcoming_performances_read_more', 'shop-and-contact', NULL, '2026-04-03 19:38:02', '2026-04-03 19:44:22'),
(238, 'shows-appearances', 'shows_card3_title', 'Schedule/Shop', NULL, '2026-04-03 19:38:02', '2026-04-03 19:40:30'),
(239, 'shows-appearances', 'schedule_shop_read_more', 'shop-and-contact', NULL, '2026-04-03 19:38:02', '2026-04-03 19:44:22'),
(240, 'britains-got-talent', 'home_bgt_images', '[\"10042026203455_69d95eefc7c446.21944366_0.png\",\"10042026203455_69d95eefc7f4e4.18928933_1.png\",\"10042026203455_69d95eefc80914.82813756_2.png\",\"10042026203455_69d95eefc81b21.65319423_3.png\",\"10042026203455_69d95eefc82ec0.95576109_4.png\",\"10042026203455_69d95eefc83f73.63231518_5.png\"]', NULL, '2026-04-10 15:34:55', '2026-04-10 15:34:55'),
(241, 'britains-got-talent', 'home_bgt_title', '<p><span class=\"d-block mb-3\">Perry Grant On </span>Britains Got Talent</p>', NULL, '2026-04-10 15:34:55', '2026-04-10 17:54:07'),
(242, 'britains-got-talent', 'home_bgt_description', '<p>Simon Cowell described Perry Grant as &ldquo;The happiest performer we have ever ever had on BGT. <br />An amazing appearance on the show received praise from the panelists and Simon described Perry&rsquo;s performance as &ldquo;Bruno&rsquo;s vision of Heaven &ldquo;</p>', NULL, '2026-04-10 15:34:56', '2026-04-10 17:55:42'),
(243, 'britains-got-talent', 'home_bgt_active_status', '1', NULL, '2026-04-10 15:34:56', '2026-04-10 17:36:53'),
(244, 'header', 'footer_fieldlevel', NULL, NULL, '2026-05-13 18:54:12', '2026-05-13 18:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `permission`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'permission-list', 'web', 'list', NULL, '2022-04-22 14:29:13', '2022-04-22 14:29:13'),
(2, 'permission-create', 'web', 'create', NULL, '2022-04-22 14:29:13', '2022-04-22 14:29:13'),
(3, 'permission-edit', 'web', 'edit', NULL, '2022-04-22 14:29:13', '2022-04-22 14:29:13'),
(4, 'permission-delete', 'web', 'delete', NULL, '2022-04-22 14:29:13', '2022-04-22 14:29:13'),
(5, 'role-list', 'web', 'list', NULL, '2022-04-22 14:29:41', '2022-04-22 14:29:41'),
(6, 'role-create', 'web', 'create', NULL, '2022-04-22 14:29:41', '2022-04-22 14:29:41'),
(7, 'role-edit', 'web', 'edit', NULL, '2022-04-22 14:29:41', '2022-04-22 14:29:41'),
(8, 'role-delete', 'web', 'delete', NULL, '2022-04-22 14:29:41', '2022-04-22 14:29:41'),
(49, 'page-list', 'web', 'list', NULL, '2022-04-28 20:12:47', '2022-04-28 20:12:47'),
(50, 'page-create', 'web', 'create', NULL, '2022-04-28 20:12:47', '2022-04-28 20:12:47'),
(51, 'page-edit', 'web', 'edit', NULL, '2022-04-28 20:12:47', '2022-04-28 20:12:47'),
(52, 'page-delete', 'web', 'delete', NULL, '2022-04-28 20:12:47', '2022-04-28 20:12:47'),
(105, 'user-list', 'web', 'list', NULL, '2022-06-06 16:59:05', '2022-06-06 16:59:05'),
(106, 'user-create', 'web', 'create', NULL, '2022-06-06 16:59:05', '2022-06-06 16:59:05'),
(107, 'user-edit', 'web', 'edit', NULL, '2022-06-06 16:59:05', '2022-06-06 16:59:05'),
(108, 'user-delete', 'web', 'delete', NULL, '2022-06-06 16:59:05', '2022-06-06 16:59:05'),
(177, 'quotations-list', 'web', 'list', NULL, '2024-05-21 10:03:54', '2024-05-21 10:03:54'),
(178, 'quotations-create', 'web', 'create', NULL, '2024-05-21 10:03:54', '2024-05-21 10:03:54'),
(179, 'quotations-edit', 'web', 'edit', NULL, '2024-05-21 10:03:54', '2024-05-21 10:03:54'),
(180, 'quotations-delete', 'web', 'delete', NULL, '2024-05-21 10:03:54', '2024-05-21 10:03:54'),
(181, 'invoice-list', 'web', 'list', NULL, '2024-08-12 12:23:01', '2024-08-12 12:23:01'),
(182, 'invoice-create', 'web', 'create', NULL, '2024-08-12 12:23:01', '2024-08-12 12:23:01'),
(183, 'invoice-edit', 'web', 'edit', NULL, '2024-08-12 12:23:01', '2024-08-12 12:23:01'),
(184, 'invoice-delete', 'web', 'delete', NULL, '2024-08-12 12:23:01', '2024-08-12 12:23:01'),
(185, 'purchase_order-list', 'web', 'list', NULL, '2024-08-19 15:44:17', '2024-08-19 15:44:17'),
(186, 'purchase_order-create', 'web', 'create', NULL, '2024-08-19 15:44:17', '2024-08-19 15:44:17'),
(187, 'purchase_order-edit', 'web', 'edit', NULL, '2024-08-19 15:44:17', '2024-08-19 15:44:17'),
(188, 'purchase_order-delete', 'web', 'delete', NULL, '2024-08-19 15:44:17', '2024-08-19 15:44:17'),
(189, 'weblinks-list', 'web', 'list', NULL, '2025-02-11 18:55:43', '2025-02-11 18:55:43'),
(190, 'weblinks-create', 'web', 'create', NULL, '2025-02-11 18:55:43', '2025-02-11 18:55:43'),
(191, 'weblinks-edit', 'web', 'edit', NULL, '2025-02-11 18:55:43', '2025-02-11 18:55:43'),
(192, 'weblinks-delete', 'web', 'delete', NULL, '2025-02-11 18:55:43', '2025-02-11 18:55:43'),
(193, 'brands-list', 'web', 'list', NULL, '2025-02-12 11:01:01', '2025-02-12 11:01:01'),
(194, 'brands-create', 'web', 'create', NULL, '2025-02-12 11:01:01', '2025-02-12 11:01:01'),
(195, 'brands-edit', 'web', 'edit', NULL, '2025-02-12 11:01:01', '2025-02-12 11:01:01'),
(196, 'brands-delete', 'web', 'delete', NULL, '2025-02-12 11:01:01', '2025-02-12 11:01:01'),
(197, 'banner-list', 'web', 'list', NULL, '2026-02-18 18:12:23', '2026-02-18 18:12:23'),
(198, 'banner-create', 'web', 'create', NULL, '2026-02-18 18:12:23', '2026-02-18 18:12:23'),
(199, 'banner-edit', 'web', 'edit', NULL, '2026-02-18 18:12:23', '2026-02-18 18:12:23'),
(200, 'banner-delete', 'web', 'delete', NULL, '2026-02-18 18:12:23', '2026-02-18 18:12:23'),
(201, 'homeslider-list', 'web', 'list', NULL, '2026-02-18 18:12:36', '2026-02-18 18:12:36'),
(202, 'homeslider-create', 'web', 'create', NULL, '2026-02-18 18:12:36', '2026-02-18 18:12:36'),
(203, 'homeslider-edit', 'web', 'edit', NULL, '2026-02-18 18:12:36', '2026-02-18 18:12:36'),
(204, 'homeslider-delete', 'web', 'delete', NULL, '2026-02-18 18:12:36', '2026-02-18 18:12:36'),
(205, 'testimonial-list', 'web', 'list', NULL, '2026-02-20 18:24:54', '2026-02-20 18:24:54'),
(206, 'testimonial-create', 'web', 'create', NULL, '2026-02-20 18:24:54', '2026-02-20 18:24:54'),
(207, 'testimonial-edit', 'web', 'edit', NULL, '2026-02-20 18:24:54', '2026-02-20 18:24:54'),
(208, 'testimonial-delete', 'web', 'delete', NULL, '2026-02-20 18:24:54', '2026-02-20 18:24:54'),
(209, 'contactus-list', 'web', 'list', NULL, '2026-02-23 14:27:31', '2026-02-23 14:27:31'),
(210, 'contactus-create', 'web', 'create', NULL, '2026-02-23 14:27:31', '2026-02-23 14:27:31'),
(211, 'contactus-edit', 'web', 'edit', NULL, '2026-02-23 14:27:31', '2026-02-23 14:27:31'),
(212, 'contactus-delete', 'web', 'delete', NULL, '2026-02-23 14:27:31', '2026-02-23 14:27:31'),
(213, 'video-list', 'web', 'list', NULL, '2026-02-24 15:29:02', '2026-02-24 15:29:02'),
(214, 'video-create', 'web', 'create', NULL, '2026-02-24 15:29:02', '2026-02-24 15:29:02'),
(215, 'video-edit', 'web', 'edit', NULL, '2026-02-24 15:29:02', '2026-02-24 15:29:02'),
(216, 'video-delete', 'web', 'delete', NULL, '2026-02-24 15:29:02', '2026-02-24 15:29:02'),
(217, 'audio-list', 'web', 'list', NULL, '2026-02-24 16:08:38', '2026-02-24 16:08:38'),
(218, 'audio-create', 'web', 'create', NULL, '2026-02-24 16:08:38', '2026-02-24 16:08:38'),
(219, 'audio-edit', 'web', 'edit', NULL, '2026-02-24 16:08:38', '2026-02-24 16:08:38'),
(220, 'audio-delete', 'web', 'delete', NULL, '2026-02-24 16:08:38', '2026-02-24 16:08:38'),
(221, 'photogallery-list', 'web', 'list', NULL, '2026-02-24 18:44:01', '2026-02-24 18:44:01'),
(222, 'photogallery-create', 'web', 'create', NULL, '2026-02-24 18:44:01', '2026-02-24 18:44:01'),
(223, 'photogallery-edit', 'web', 'edit', NULL, '2026-02-24 18:44:01', '2026-02-24 18:44:01'),
(224, 'photogallery-delete', 'web', 'delete', NULL, '2026-02-24 18:44:01', '2026-02-24 18:44:01'),
(225, 'shopcontact-list', 'web', 'list', NULL, '2026-02-25 13:14:37', '2026-02-25 13:14:37'),
(226, 'shopcontact-create', 'web', 'create', NULL, '2026-02-25 13:14:37', '2026-02-25 13:14:37'),
(227, 'shopcontact-edit', 'web', 'edit', NULL, '2026-02-25 13:14:37', '2026-02-25 13:14:37'),
(228, 'shopcontact-delete', 'web', 'delete', NULL, '2026-02-25 13:14:37', '2026-02-25 13:14:37'),
(233, 'latestnews-list', 'web', 'list', NULL, '2026-03-05 16:09:07', '2026-03-05 16:09:07'),
(234, 'latestnews-create', 'web', 'create', NULL, '2026-03-05 16:09:07', '2026-03-05 16:09:07'),
(235, 'latestnews-edit', 'web', 'edit', NULL, '2026-03-05 16:09:07', '2026-03-05 16:09:07'),
(236, 'latestnews-delete', 'web', 'delete', NULL, '2026-03-05 16:09:07', '2026-03-05 16:09:07'),
(241, 'scheduleshopcontact-list', 'web', 'list', NULL, '2026-03-11 15:08:08', '2026-03-11 15:08:08'),
(242, 'scheduleshopcontact-create', 'web', 'create', NULL, '2026-03-11 15:08:08', '2026-03-11 15:08:08'),
(243, 'scheduleshopcontact-edit', 'web', 'edit', NULL, '2026-03-11 15:08:08', '2026-03-11 15:08:08'),
(244, 'scheduleshopcontact-delete', 'web', 'delete', NULL, '2026-03-11 15:08:08', '2026-03-11 15:08:08'),
(249, 'showsandappearances-list', 'web', 'list', NULL, '2026-04-03 18:46:45', '2026-04-03 18:46:45'),
(250, 'showsandappearances-create', 'web', 'create', NULL, '2026-04-03 18:46:46', '2026-04-03 18:46:46'),
(251, 'showsandappearances-edit', 'web', 'edit', NULL, '2026-04-03 18:46:46', '2026-04-03 18:46:46'),
(252, 'showsandappearances-delete', 'web', 'delete', NULL, '2026-04-03 18:46:46', '2026-04-03 18:46:46'),
(253, 'homebgt-list', 'web', 'list', NULL, '2026-04-10 14:42:30', '2026-04-10 14:42:30'),
(254, 'homebgt-create', 'web', 'create', NULL, '2026-04-10 14:42:30', '2026-04-10 14:42:30'),
(255, 'homebgt-edit', 'web', 'edit', NULL, '2026-04-10 14:42:30', '2026-04-10 14:42:30'),
(256, 'homebgt-delete', 'web', 'delete', NULL, '2026-04-10 14:42:31', '2026-04-10 14:42:31'),
(257, 'faq-list', 'web', 'list', NULL, '2026-05-14 12:23:01', '2026-05-14 12:23:01'),
(258, 'faq-create', 'web', 'create', NULL, '2026-05-14 12:23:01', '2026-05-14 12:23:01'),
(259, 'faq-edit', 'web', 'edit', NULL, '2026-05-14 12:23:01', '2026-05-14 12:23:01'),
(260, 'faq-delete', 'web', 'delete', NULL, '2026-05-14 12:23:01', '2026-05-14 12:23:01'),
(261, 'policy-list', 'web', 'list', NULL, '2026-05-14 13:08:12', '2026-05-14 13:08:12'),
(262, 'policy-create', 'web', 'create', NULL, '2026-05-14 13:08:12', '2026-05-14 13:08:12'),
(263, 'policy-edit', 'web', 'edit', NULL, '2026-05-14 13:08:12', '2026-05-14 13:08:12'),
(264, 'policy-delete', 'web', 'delete', NULL, '2026-05-14 13:08:12', '2026-05-14 13:08:12'),
(265, 'service-list', 'web', 'list', NULL, '2026-05-18 15:32:28', '2026-05-18 15:32:28'),
(266, 'service-create', 'web', 'create', NULL, '2026-05-18 15:32:28', '2026-05-18 15:32:28'),
(267, 'service-edit', 'web', 'edit', NULL, '2026-05-18 15:32:28', '2026-05-18 15:32:28'),
(268, 'service-delete', 'web', 'delete', NULL, '2026-05-18 15:32:28', '2026-05-18 15:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_galleries`
--

CREATE TABLE `photo_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `created_by`, `title`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Medical Clearance', 'All clients must complete a health intake and receive medical clearance from our supervising provider prior to any IV, peptide, or injection service. We may request additional information or decline service when appropriate for your safety.', '1', NULL, '2026-05-14 13:13:41', '2026-05-14 13:13:41'),
(2, 1, 'Appointments & Booking', 'Appointments are scheduled by phone, email, or via our contact form. We do not currently offer online booking. A confirmation will be sent once your visit is reserved.', '1', NULL, '2026-05-14 13:14:03', '2026-05-14 13:14:03'),
(3, 1, 'Cancellations & No-Shows', 'We ask for at least [24–48 hours] notice for cancellations or rescheduling. Late cancellations and no-shows may be subject to a [fee]. Repeated no-shows may affect your ability to book future appointments.', '1', NULL, '2026-05-14 13:14:20', '2026-05-14 13:14:20'),
(4, 1, 'Payment', 'Payment is collected in person at the time of service. We accept [cash, major credit cards, etc.]. We do not process payments online and do not store payment information.', '1', NULL, '2026-05-14 13:14:38', '2026-05-14 13:14:38'),
(5, 1, 'Late Arrivals', 'If you arrive more than [15 minutes] late, your appointment may need to be shortened or rescheduled to respect other clients\' bookings.', '1', NULL, '2026-05-14 13:14:54', '2026-05-14 13:14:54'),
(6, 1, 'Privacy', 'Your health information is kept confidential and handled in accordance with applicable privacy laws. We do not sell or share your information with third parties for marketing purposes.', '1', NULL, '2026-05-14 13:15:11', '2026-05-14 13:15:11'),
(7, 1, 'Disclaimer', 'Services offered at Balanced Body IV Wellness are intended to support general wellness and are not a substitute for medical diagnosis or treatment. Always consult your primary care provider for medical concerns.', '1', NULL, '2026-05-14 13:15:30', '2026-05-14 13:15:30'),
(8, 1, 'Disclaimer', 'Services offered at Balanced Body IV Wellness are intended to support general wellness and are not a substitute for medical diagnosis or treatment. Always consult your primary care provider for medical concerns.', '1', '2026-05-14 18:36:15', '2026-05-14 13:15:30', '2026-05-14 13:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', NULL, NULL, '2022-04-06 14:41:39', '2022-04-06 14:41:39'),
(2, 'Agent', 'web', 'Normal agent from website.', NULL, '2022-04-22 14:46:54', '2022-08-15 17:29:35');

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
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(49, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(198, 1),
(199, 1),
(200, 1),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(205, 1),
(206, 1),
(207, 1),
(208, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(217, 1),
(218, 1),
(219, 1),
(220, 1),
(221, 1),
(222, 1),
(223, 1),
(224, 1),
(225, 1),
(226, 1),
(227, 1),
(228, 1),
(233, 1),
(234, 1),
(235, 1),
(236, 1),
(241, 1),
(242, 1),
(243, 1),
(244, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(253, 1),
(254, 1),
(255, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(263, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1),
(268, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_shop_contacts`
--

CREATE TABLE `schedule_shop_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `heading` longtext DEFAULT NULL,
  `heading_2` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `description_2` longtext DEFAULT NULL,
  `section_type` varchar(255) DEFAULT NULL COMMENT '0=one image and text below it, 1=two images side by side and text below it,',
  `section_background` varchar(50) NOT NULL DEFAULT 'black-about-section' COMMENT 'black-about-section or black-about-section-2',
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'For section_type 2: array of image filenames' CHECK (json_valid(`images`)),
  `button_url` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_shop_contacts`
--

INSERT INTO `schedule_shop_contacts` (`id`, `title`, `heading`, `heading_2`, `description`, `description_2`, `section_type`, `section_background`, `image_1`, `image_2`, `images`, `button_url`, `button_text`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Other DVD’S and Merchandise will soon be digitalized for purchase on line ..stay tuned.', NULL, NULL, NULL, NULL, '3', 'black-about-section-2', NULL, NULL, '[\"1773365442_69b368c250932.webp\",\"1773365442_69b368c250aff.webp\",\"1773365442_69b368c250c1a.webp\",\"1773365442_69b368c250d2b.webp\",\"1773365442_69b368c250e52.webp\",\"1773365442_69b368c251005.webp\",\"1773365442_69b368c251179.webp\",\"1773365442_69b368c2512ee.webp\",\"1773365442_69b368c251441.webp\"]', NULL, NULL, '1', NULL, '2026-03-12 20:30:42', '2026-03-12 20:30:42'),
(2, 'Once I had a Dream..Available for download from Amazon and Apple Music', NULL, 'New Album “Frankly Perry” available for download and purchase very soon', NULL, NULL, '2', 'black-about-section-2', '1773365771_69b36a0b67c42.webp', '1773365771_69b36a0b67ef7.webp', NULL, 'https://www.amazon.com/music/player/albums/B08CYBJ1GV', 'Buy On Amazon', '1', NULL, '2026-03-12 20:36:11', '2026-03-12 20:36:11'),
(3, 'By Request …Available for download from Amazon and Apple Music', NULL, NULL, NULL, NULL, '1', 'black-about-section', '1773366057_69b36b2911681.webp', '1773366057_69b36b2911835.webp', NULL, 'https://music.amazon.com/albums/B09J1XSPCY', 'Buy On Amazon', '1', NULL, '2026-03-12 20:40:57', '2026-03-12 20:40:57'),
(4, 'Perry Grant Merchandise and Shop:', 'CD/DVD/MEDIA', NULL, 'Available for download from Amazon and Apple Music', NULL, '0', 'black-about-section-2', '1773366615_69b36d57286c6.webp', NULL, NULL, 'https://music.amazon.com/albums/B09J1XSPCY', 'Buy On Amazon', '1', NULL, '2026-03-12 20:50:15', '2026-03-12 20:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `questions` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `created_by`, `heading`, `questions`, `description`, `benefits`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'ALA (Alpha Lipoic Acid)', '[\"Are you a diabetic?\",\"Do you take medication (often a \\u201cstatin\\u201d drug) to treat high cholesterol?\",\"Do you often feel fatigued?\",\"Do you often feel fatigued?\",\"Do you suffer from inflammation?\",\"Do you have an autoimmune disorder\\/condition?\",\"Do you have a history of a neurological condition?\",\"Do you want to lose weight?\",\"Do you struggle with PCOS and\\/or infertility?\",\"Do you have a neurological disease?\"]', 'ALA is known as the “universal antioxidant”—meaning it is a free radical scavenger. Free radicals are an aging accelerator and form when the body is under a significant amount of physical or chemical stress. ALA can only be purchased as a 3-pack or 6-pack and cannot be added as a single ingredient to an IV Drip.', '[\"Potentiating other antioxidants\\u2014glutathione, vitamin C and vitamin E\",\"Blood sugar control\",\"Inhibiting fat cell formation\",\"Decreased LDL (\\u201cbad cholesterol\\u201d), Increases HDL (\\u201cgood cholesterol\\u201d)\",\"Energy production\",\"Crosses the blood brain barrier\\u2014helpful in neurological conditions (Alzheimer\\u2019s, multiple sclerosis, neuropathy, traumatic brain injury, and seizure)\",\"Liver regeneration\",\"Symptom management of certain cancers (ex. Mucositis)\"]', '1', NULL, '2026-05-18 15:44:23', '2026-05-18 15:44:23'),
(2, 1, 'Amino Blend (Arginine + Citrulline + Lysine + Proline', '[\"Are you an athlete?\",\"Do you exercise regularly?\",\"Do you have erectile dysfunction?\",\"Do you have a slow metabolism\",\"Do you often feel fatigued?\",\"Do you have sore muscles and achy joints?\",\"Do you have heart disease?\"]', 'These amino acids may help maximize performance by supporting the function of healthy joints and muscles.', '[\"Arginine\\r\\n\\u2022 Improved blood flow by creating nitric oxide (NO), a gas that helps dilate blood vessels\\r\\n\\u2022 Improved arteries for people with heart disease or clogged arteries due to its vessel-widening abilities\\r\\n\\u2022 Improved symptoms of erectile dysfunction (ED)\",\"Citrulline\\r\\n\\u2022 Longer lasting effects than just arginine alone, this nutrient is converted to arginine in the kidneys\\r\\n\\u2022 Improved vasodilation, blood flow and immune function\",\"Lysine\\r\\n\\u2022 Improved carnitine creation, which converts fatty acids into energy and also lowers cholesterol levels\\r\\n\\u2022 Improved calcium absorption and collagen formation, which aids in growth and maintenance of bones and connective tissues\",\"Proline\\r\\n\\u2022 Improved skin health\\r\\n\\u2022 Improved joint and tissue health\"]', '1', NULL, '2026-05-18 16:17:11', '2026-05-18 16:17:11'),
(3, 1, 'B5 (Dexpanthenonol)', '[\"Do you take medication to treat acne?\",\"Do you take a \\u201cstatin\\u201d drug to treat high cholesterol?\",\"Do you follow a plant-based diet?\",\"Do you have stress in your life?\",\"Are you interested in better gut health?\"]', 'B5 is a water-soluble B vitamin that helps the body use fats and proteins. It is often called the “Energy Vitamin.”', '[\"Boosted energy and metabolism\",\"Increased manufacturing of red blood cells\",\"Increased cholesterol synthesis\",\"Improved skin health\",\"Hormone production assistance\",\"A healthy digestive tract\",\"Boosted energy from breaking down carbs and fats\",\"Increased sex hormones\",\"Healthy skin and reduced signs of aging with moisture retention\"]', '1', NULL, '2026-05-18 16:22:27', '2026-05-18 16:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_logo` varchar(255) DEFAULT NULL,
  `photo_favicon` varchar(255) DEFAULT NULL,
  `top_bar_email` varchar(255) DEFAULT NULL,
  `top_bar_phone` varchar(255) DEFAULT NULL,
  `footer_col1_title` varchar(255) DEFAULT NULL,
  `footer_col2_title` varchar(255) DEFAULT NULL,
  `footer_col3_title` varchar(255) DEFAULT NULL,
  `footer_col4_title` varchar(255) DEFAULT NULL,
  `footer_copyright` longtext DEFAULT NULL,
  `footer_address` longtext DEFAULT NULL,
  `footer_email` varchar(255) DEFAULT NULL,
  `footer_phone` varchar(255) DEFAULT NULL,
  `footer_recent_news_item` varchar(255) DEFAULT NULL,
  `footer_recent_portfolio_item` longtext DEFAULT NULL,
  `newsletter_text` longtext DEFAULT NULL,
  `cta_text` varchar(255) DEFAULT NULL,
  `cta_button_text` longtext DEFAULT NULL,
  `cta_button_url` longtext DEFAULT NULL,
  `cta_background_photo` varchar(255) DEFAULT NULL,
  `send_email_from` varchar(255) DEFAULT NULL,
  `receive_email_to` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `photo5` varchar(255) DEFAULT NULL,
  `photo6` varchar(255) DEFAULT NULL,
  `photo7` varchar(255) DEFAULT NULL,
  `photo8` varchar(255) DEFAULT NULL,
  `photo9` varchar(255) DEFAULT NULL,
  `photo10` varchar(255) DEFAULT NULL,
  `photo11` varchar(255) DEFAULT NULL,
  `photo12` varchar(255) DEFAULT NULL,
  `photo13` varchar(255) DEFAULT NULL,
  `photo14` varchar(255) DEFAULT NULL,
  `photo15` varchar(255) DEFAULT NULL,
  `sidebar_total_recent_post` varchar(255) DEFAULT NULL,
  `sidebar_news_heading_category` varchar(255) DEFAULT NULL,
  `sidebar_news_heading_recent_post` varchar(255) DEFAULT NULL,
  `sidebar_total_upcoming_event` varchar(255) DEFAULT NULL,
  `sidebar_total_past_event` varchar(255) DEFAULT NULL,
  `sidebar_event_heading_upcoming` varchar(255) DEFAULT NULL,
  `sidebar_event_heading_past` varchar(255) DEFAULT NULL,
  `sidebar_service_heading_service` varchar(255) DEFAULT NULL,
  `sidebar_service_heading_quick_contact` varchar(255) DEFAULT NULL,
  `sidebar_portfolio_heading_project_detail` varchar(255) DEFAULT NULL,
  `sidebar_portfolio_heading_quick_contact` varchar(255) DEFAULT NULL,
  `front_end_color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_contacts`
--

CREATE TABLE `shop_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_contacts`
--

INSERT INTO `shop_contacts` (`id`, `name`, `email`, `phone`, `message`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Miranda Ingram', 'rapah@mailinator.com', '+1 (899) 943-6603', 'Exercitationem in do', '1', '2026-02-25 18:57:23', '2026-02-25 13:20:54', '2026-02-25 13:57:23'),
(2, 'Victoria Velasquez', 'huxisiriqa@mailinator.com', '+1 (361) 643-7188', 'Vel pariatur Soluta', '1', '2026-02-26 17:30:02', '2026-02-25 13:22:16', '2026-02-26 12:30:02'),
(3, 'Kirestin Cobb', 'kexenic@mailinator.com', '+1 (865) 471-3288', 'Non pariatur Sint f', '1', '2026-02-26 17:31:04', '2026-02-25 13:24:31', '2026-02-26 12:31:04'),
(4, 'Kaseem Hughes', 'jitecohud@mailinator.com', '+1 (901) 796-6342', 'Lorem quia impedit', '1', NULL, '2026-02-25 13:28:39', '2026-02-25 13:28:39'),
(5, 'Yardley Gentry', 'miroten@mailinator.com', '+1 (645) 733-2316', 'Voluptate expedita p', '1', '2026-02-25 18:57:18', '2026-02-25 13:30:48', '2026-02-25 13:57:18'),
(6, 'Karly Sweeney', 'micabyra@mailinator.com', '+1 (626) 741-1275', 'Tempore tenetur eum', '1', NULL, '2026-02-25 13:33:33', '2026-02-25 13:33:33'),
(7, 'Zenia Harrison', 'qokyqa@mailinator.com', '+1 (612) 281-1457', 'Qui assumenda irure', '1', NULL, '2026-02-25 13:37:45', '2026-02-25 13:37:45'),
(8, 'Christen Gamble', 'gutytolity@mailinator.com', '+1 (809) 196-4286', 'Corrupti ipsa moll', '1', NULL, '2026-02-25 13:41:56', '2026-02-25 13:41:56'),
(9, 'Nasim Simon', 'sofy@mailinator.com', '+1 (708) 736-8496', 'Fugiat eiusmod place', '1', NULL, '2026-02-25 13:44:11', '2026-02-25 13:44:11'),
(10, 'Dolan Love', 'suvaweqe@mailinator.com', '+1 (253) 333-2037', 'Natus dolore volupta', '1', NULL, '2026-02-25 13:46:06', '2026-02-25 13:46:06'),
(11, 'Whitney Bell', 'zexujinit@mailinator.com', '+1 (342) 942-1561', 'Soluta rerum aute pl', '1', NULL, '2026-02-25 13:48:39', '2026-02-25 13:48:39'),
(12, 'Austin Hull', 'qodoqowozu@mailinator.com', '+1 (183) 224-3666', 'Ad sunt eum nulla ne', '1', NULL, '2026-02-25 13:54:55', '2026-02-25 13:54:55'),
(13, 'Dara Frye', 'ryxuk@mailinator.com', '+1 (535) 852-8516', 'Autem modi natus et', '1', NULL, '2026-02-25 13:55:59', '2026-02-25 13:55:59'),
(14, 'Bethany Chan', 'givyzokyj@mailinator.com', '+1 (123) 653-9089', 'Ipsum incididunt dol', '1', NULL, '2026-02-25 13:57:01', '2026-02-25 13:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `slug`, `designation`, `image`, `comment`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Joyce Dowd', 'joyce-dowd', NULL, '23-02-2026-180932.png', '<p>Perry is a gifted entertainer who relates to all age groups! he has a multitude of fans who thoroughly enjoy his entertaining ways! He is a gifted pianist,singer and cabaret entertainer as well as having a fabulous stage show! He gives 100% of himself to entertaining others and is an asset to anyone he works for Many of his fans book only to see him many book a year before too As a performer I would say that he is one of the best performing of cruise ships!</p>', 1, '2026-02-23 13:09:32', '2026-02-23 13:37:49', NULL),
(2, 'Edwin Rojas', 'edwin-rojas', NULL, '23-02-2026-181045.png', '<p>IMPLE: There is NO FINER entertainer in any piano bar, on any cruise ship, in the world. NONE!<br /><br />have worked with Perry at Holland America Line on many cruises, including Grand Voyages at 30+ days and including a world cruise in 1998 with 100+ days with the same guests. Who did they love the best? PERRY. I also worked with Perry at Celebrity Cruises. Who had the highest revenue of any bar musician? PERRY.<br /><br />He\'s funny, a great talent, and a gem to work with.</p>', 1, '2026-02-23 13:10:45', '2026-02-23 13:10:45', NULL),
(3, 'Aaron Mandelbaum', 'aaron-mandelbaum', NULL, '23-02-2026-181128.png', '<p>There are many items to consider when booking a great vacation. For my family, we often make sure we book a cruise that Perry is involved with. I have been on dozens of cruises and you see lots of amazing places but the best part is the people you meet. Perry is fantastic. He is funny and a terrific performer. He will be a highlight of your trip.<br /><br />I can\'t recommend him enough.</p>', 1, '2026-02-23 13:11:28', '2026-02-23 13:11:28', NULL),
(4, 'Ellen O\'Byrne', 'ellen-obyrne', NULL, '23-02-2026-181201.png', '<p>Perry Grant is a highly engaging entertainer who consistently delights his audiences for several hours each evening. He plays the piano magnificently, sings beautifully, has fabulous rapport with his audiences and also can put on a wonderful stage show. He has a huge fan following among cruisers and people will often only book their cruise only if Perry Grant will be the onboard entertainer. I highly recommend Perry Grant!</p>', 1, '2026-02-23 13:12:01', '2026-02-23 13:12:01', NULL),
(5, 'Elizabeth Minton', 'elizabeth-minton', NULL, '23-02-2026-181232.png', '<p>Perry is a fantastic entertainer. His knowledge of music is amazing and his ability to provide instrumental and vocal entertainment to large crowds of people in all age ranges and nationalities is unique.. He is very creative and keeps his audiences laughing with his chatter and conversations with the audience. I highly recommend him as the best entertainer on the high seas.</p>', 1, '2026-02-23 13:12:32', '2026-02-23 13:12:32', NULL),
(6, 'Eric Oliver', 'eric-oliver', NULL, '23-02-2026-181307.png', '<p>Perry is an extraordinarily gifted performer and entertainer. He is always a pleasure to work with, and his attention to detail assures a splendid performance every time. He always leaves the audiences wanting more, loving him more with every show. I always look forward to the opportunity to play with Perry!</p>', 1, '2026-02-23 13:13:07', '2026-02-23 13:13:07', NULL),
(7, 'Tom Jackson', 'tom-jackson', NULL, '23-02-2026-181335.png', '<p>Perry and I worked together on board the Celebrity Constellation back in 2008. At the time I was the musical director and this meant I was in direct contact with Perry during this time, in which case Perry proved to be an integral member of our entertainment team.<br /><br />Perry was well liked by all of the guests on board, and he constantly performed to capacity crowds in Michael\'s Club. Worth noting is the fact that many guests specifically booked their cruises, knowing that Perry was performing on board.<br /><br />If you are looking for an entertainer that delivers, Perry is certainly an act that I would recommend. Sincerely Yours.</p>', 1, '2026-02-23 13:13:35', '2026-02-23 13:31:16', '2026-02-23 13:31:16'),
(8, 'Jeffrey Gabel', 'jeffrey-gabel', NULL, '23-02-2026-181408.png', '<p>Perry is one of the most entertaining club singers I\'ve ever seen in my long career. His fans adore him so much they follow him from cruise to cruise all around the world.</p>', 1, '2026-02-23 13:14:08', '2026-02-23 13:14:08', NULL),
(9, 'Julie Williams', 'julie-williams', NULL, '23-02-2026-181522.png', '<p class=\"testimonial-text mt-2\">Outstanding performer, who touches everyone in the audiences hearts for sure! Grand Entertainer/musician/singer!</p>', 1, '2026-02-23 13:15:22', '2026-02-23 13:15:22', NULL),
(10, 'Norman Popa', 'norman-popa', NULL, '23-02-2026-181552.png', '<p>Perry was a great entertainer who was outstanding and filled Micheal\'s Club every single night and was loved by all those in attendance.</p>', 1, '2026-02-23 13:15:52', '2026-02-23 13:15:52', NULL),
(11, 'Michael Pye', 'michael-pye', NULL, '23-02-2026-181623.png', '<p>Perry is a consummate professional, extremely hard working and popular with all who meet him. This combination of his exceptional musical and entertainment skills with his general \"joie de vivre\" and his continual quest to research and learn new materials has meant he has been wowing and delighting his audiences throughout his international career. An entertainer not to be missed!</p>', 1, '2026-02-23 13:16:23', '2026-02-23 13:16:23', NULL),
(12, 'Dana Leslie', 'dana-leslie', NULL, '23-02-2026-181654.png', '<p>Perry Grant is a true showman! He is a real treasure for Celebrity Cruises, not only for his wonderful musical talent, but for his professionalism, courtesy and integrity as well! Perry is an absolute delight as he engages his audiences from performing in the grand theatres to intimate cabaret settings on various vessels. When out and about around the ship, you can always count on Perry to be smiling and friendly! I loved working alongside Perry on the Celebrity Constellation, and now I can\'t wait to bring my group on board the Celebrity Eclipse to see Perry perform in all of his glory! His show is NOT to be missed!</p>', 1, '2026-02-23 13:16:54', '2026-02-23 13:16:54', NULL),
(13, 'Cliff Mason', 'cliff-mason', NULL, '23-02-2026-181727.png', '<p>Perry is an exceptionally talented performer who captivates and delights audiences with his flamboyant showbiz style, which was already firmly established when we improvised jazz together as teenagers. It has been a pleasure to follow his development as a first rate entertainer and to see the huge following of supporters who enjoy his shows and keep coming back for more - perhaps the best measure of success a performer can ask for.</p>', 1, '2026-02-23 13:17:27', '2026-02-23 13:17:27', NULL),
(14, 'Donna Marks', 'donna-marks', NULL, '23-02-2026-182028.png', '<p>All though your form does not have the correct way for me to talk about Perry Grant, I will do with what was presented to me. I have never hired him, worked with him or done business with him, he has entertained me to a point I feel I have to make a recommendation!<br /><br />Perry is an excellent entertainer that I have had the pleasure to meet and enjoy for the last 5 years or so whenever I go on celebrity cruise ships, he has a talent that is hard to compare. He attracts a crowd like I\'ve never seen and it seems we follow him wherever he goes! It\'s called being \"perrified\" I think you have to be there to understand, but he is one in a million, his music is from the past and sublime, his comedy is strange and wonderful and his heart is as big as the moon.<br /><br />I can\'t wait to see him again wherever that may be, on land or sea, but wherever it\'s a treat! Thank you for all the happy times Perry!</p>', 1, '2026-02-23 13:20:28', '2026-02-23 13:20:28', NULL),
(15, 'Stasia Meyers', 'stasia-meyers', NULL, '23-02-2026-182101.png', '<p>Perry Grant is a most remarkable entertainer. I\'ve had the distinct pleasure of having sailed on several cruises with this legendary performer. Each evening he presides over the piano bar/lounge, singing, playing the piano and generally keeping us all laughing with his unique sense of humor. I\'ve never experienced an entertainer who so cleverly connects with his audience. I say \"audience\" but truly, by the end of the cruise, he has formed friendships with so many of those lucky enough to have secured a seat each evening.<br /><br />Perry has a seemingly endless \"bag of tricks\" to keep his following engaged, to bring them into his sphere and literally to keep all laughing with him and at ourselves. His appeal spans all age groups, from octogenarians down to adolescents, and no matter where one is from, he can \"speak\" the language. He simply enjoys entertaining all ages and all ages gravitate towards him. It is amazing to witness this, night after night. To say that he is a welcoming person is not to do justice to his endearing personality. A warm and sweet man can be found under those crazy hats he will suddenly don. All feel happy to be in the room and speaking for many, I choose only cruises where Perry will be on board. Any venue would do well to have Perry Grant as entertainer. A true professional!</p>', 1, '2026-02-23 13:21:01', '2026-02-23 13:21:01', NULL),
(16, 'Gabriele Miller Urban', 'gabriele-miller-urban', NULL, '23-02-2026-182623.png', '<p>I would like to give Perry a different recommendation. When I met Perry for the first time on Holland America Line he played his piano just around the corner from the Casino and his crowed in there were in hysteric, because the way he can entertain is never the same. Perry is a very creative person starts with his outfits and I did wonder where can I find this clothes? Perry is truly a fine person fantasic to have him around and a asset to any organisation.</p>', 1, '2026-02-23 13:26:23', '2026-02-23 13:26:23', NULL),
(17, 'Michael Faber', 'michael-faber', NULL, '23-02-2026-182654.png', '<p>I have known Perry Grant for almost 15 years... both as an entertainer (at which he is incredible) but more importantly as a friend!! Perry is one of the most decent and hard working people I have ever known. His work ethic and genuinely always wanting to please his audience is nothing less than incredible. I would not only highly, but most strongly, recommend Perry Grant to anyone who only want the very best possible!</p>', 1, '2026-02-23 13:26:54', '2026-02-23 13:26:54', NULL),
(18, 'Tom Jackson', 'tom-jackson', NULL, '23-02-2026-182739.png', '<p>Perry and I worked together on board the Celebrity Constellation back in 2008. At the time I was the musical director and this meant I was in direct contact with Perry during this time, in which case Perry proved to be an integral member of our entertainment team.<br />Perry was well liked by all of the guests on board, and he constantly performed to capacity crowds in Michael\'s Club. Worth noting is the fact that many guests specifically booked their cruises, knowing that Perry was performing on board.<br />If you are looking for an entertainer that delivers, Perry is certainly an act that I would recommend. Sincerely yours,</p>', 1, '2026-02-23 13:27:39', '2026-02-23 13:27:39', NULL),
(19, 'Randi Kline', 'randi-kline', NULL, '23-02-2026-182921.jpg', '<p>I had the pleasure of working with Perry over the course of several contracts with Celebrity Cruises. He was a consummate professional and took immense pride in pleasing his audience. Perry was able to connect intimately with his audience in both the smaller club venues as well as in large theater venues. It was truly a pleasure to work with Perry and to witness the joy he brought to our guests.</p>', 1, '2026-02-23 13:29:21', '2026-02-23 13:29:21', NULL),
(20, 'MARK PRESTON', 'mark-preston', NULL, '23-02-2026-183001.jpg', '<p>In all my 45 plus years in this industry, I have never seen someone control a room like Perry Grant. From the moment he begins, till the last note is sung....he\'s got the room in the palm of his hand. real pro</p>', 1, '2026-02-23 13:30:01', '2026-02-26 14:06:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `phone`, `email`, `address`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', NULL, 'admin@gmail.com', NULL, NULL, '$2y$10$QowHn04SUEIx8Lo.kQahTehd1cmYS2NnLkwDlqRARD7bVtpnNg/mi', NULL, NULL, '1', NULL, '2024-05-14 20:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `thumbnail_url` varchar(500) DEFAULT NULL,
  `featured` varchar(255) NOT NULL DEFAULT '0' COMMENT '0=not featured, 1=featured',
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `heading`, `title`, `video_url`, `thumbnail_url`, `featured`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2025 Season Highlight — Vol. 1', 'Rio Hondo College · Women\'s Volleyball', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3585866', 'https://i.ytimg.com/vi/bYk2sY8dBvA/mqdefault.jpg', '1', '1', NULL, '2026-05-01 12:04:10', '2026-05-05 18:02:51'),
(3, 'Match Footage — Vol. 2', 'Defense & Serve Receive', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3549002', 'https://image.mux.com/zxZnsLN9o95WczXJDfiIpQ9vNJig3jv5fZhIWIIIvEQ/thumbnail.png', '0', '1', NULL, '2026-05-05 17:10:00', '2026-05-05 18:02:53'),
(4, 'Match Footage — Vol. 3', 'Digs & Court Coverage', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3546474', 'https://image.mux.com/7M6UaAaZe7XUQSRrFlT5DFsM8hizKTn95FeHi01mEgUI/thumbnail.png', '0', '1', NULL, '2026-05-05 17:10:37', '2026-05-05 18:02:55'),
(5, 'Match Footage — Vol. 4', 'Passing & Communication', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3546473', 'https://image.mux.com/GQBS00N0202bvNol46WAnatFqx5v00NtXCx02WWrRld2yu00M/thumbnail.png', '0', '1', NULL, '2026-05-05 17:11:25', '2026-05-05 18:02:56'),
(6, 'Match Footage — Vol. 5', 'Serve & Receive', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3546472', 'https://image.mux.com/V23xZQVMsZSSlvIfuIBkae9hoiqf00rGF6hUGUMjbHJE/thumbnail.png', '0', '1', NULL, '2026-05-05 17:12:01', '2026-05-05 18:02:57'),
(7, 'Match Footage — Vol. 6', 'Full Match', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3546441', 'https://image.mux.com/ZaqWK84BfI3AYQC3sIzetJgaVrkEon01EuoNv4bZkT00o/thumbnail.png', '0', '1', NULL, '2026-05-05 17:13:19', '2026-05-05 18:02:59'),
(8, 'Match Footage — Vol. 7', 'Defense Highlights', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3546432', 'https://image.mux.com/xZgxpIV9wWp2A5WjaoW02Nc2MUwUCxhweYsrvEcR00OLg/thumbnail.png', '0', '1', NULL, '2026-05-05 17:13:59', '2026-05-05 18:03:00'),
(9, 'Match Footage — Vol. 8', 'Aces & Serve', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3546421', 'https://image.mux.com/TNHVmpHhxjIPSHy2UlVNfEUPekNWBg0000fvmPgakJShA/thumbnail.png', '0', '1', NULL, '2026-05-05 17:15:36', '2026-05-05 18:03:01'),
(10, 'Match Footage — Vol. 9', 'Season Recap', 'https://www.fieldlevel.com/app/profile/lyllianna.aguayo/volleyballwomen/videos/3546418', 'https://image.mux.com/IDEQNRbrS3tULHRDtQgFwwruQyOlmCZvKpBrfYP9A9A/thumbnail.png', '0', '1', NULL, '2026-05-05 17:16:32', '2026-05-05 18:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `web_links`
--

CREATE TABLE `web_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_links`
--

INSERT INTO `web_links` (`id`, `slug`, `name`, `brand_name`, `description`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'testing', 'testing', 'Elite Pro Website', 'hvmnvm', '20250212174046.png', '1', '2025-02-18 18:28:18', '2025-02-12 12:40:46', '2025-02-18 18:28:18'),
(2, 'xyz', 'xyz', 'The Tech Designers', 'test', '20250217181120.jpg', '1', '2025-02-18 18:28:14', '2025-02-17 18:11:20', '2025-02-18 18:28:14'),
(3, 'because-i-care-inc', 'Because I Care, Inc', 'Pixels and the Beast', 'Because I Care, Inc', '20250217182718.jpg', '1', NULL, '2025-02-17 18:27:18', '2025-02-17 18:27:18'),
(4, 'avalon-entertainment', 'Avalon Entertainment', 'Liberty Web Studio', 'Avalon Entertainment', '20250219013341.jpg', '1', '2025-03-05 19:20:10', '2025-02-19 01:33:41', '2025-03-05 19:20:10'),
(5, 'avalon-entertainment-2', 'Avalon Entertainment 2', 'Liberty Web Studio', 'Avalon Entertainment 2', '20250226193333.jpg', '1', '2025-03-05 19:20:05', '2025-02-19 01:34:38', '2025-03-05 19:20:05'),
(6, 'the-eye-spa', 'The Eye Spa', 'Liberty Web Studio', 'The Eye Spa', '20250219013612.jpg', '1', '2025-03-05 19:19:26', '2025-02-19 01:36:12', '2025-03-05 19:19:26'),
(7, 'never-forget-custom-home', 'Never Forget Custom - Home', 'American Digital Agency', 'Final Revision', '20250225234458.jpg', '1', '2025-03-05 22:53:11', '2025-02-21 16:48:02', '2025-03-05 22:53:11'),
(8, 'edgar-sarrate-midwxst-llc', 'Edgar Sarrate - midwxst, LLC', 'The Web Sense', 'Edgar Sarrate - midwxst, LLC', '20250224173033.jpg', '1', NULL, '2025-02-24 17:30:33', '2025-02-24 17:30:33'),
(9, 'starzpsychics', 'starzpsychics', 'Web Harmony', 'starzpsychics', '20250313161716.jpg', '1', NULL, '2025-02-24 21:40:11', '2025-03-13 16:17:17'),
(10, 'eric-koch', 'Eric Koch', 'American Digital Agency', 'Eric Koch', '20250225153423.jpg', '1', '2025-03-05 19:22:20', '2025-02-25 15:34:23', '2025-03-05 19:22:20'),
(11, 'eric-koch-1', 'Eric Koch 1', 'American Digital Agency', 'Eric Koch 1', '20250225153520.jpg', '1', '2025-03-05 19:22:14', '2025-02-25 15:35:20', '2025-03-05 19:22:14'),
(12, 'merlin-of-the-marina', 'Merlin of the Marina', 'Liberty Web Studio', 'Merlin of the Marina', '20250225215111.jpg', '1', '2025-03-05 19:22:01', '2025-02-25 21:51:11', '2025-03-05 19:22:01'),
(13, 'whopchopzmusicnvideos-llc', 'WhopChopzMusicnVideos LLC', 'Web Harmony', 'WhopChopzMusicnVideos LLC', '20250226165924.jpg', '1', NULL, '2025-02-26 16:59:24', '2025-02-26 16:59:24'),
(14, 'kristy-brito', 'Kristy Brito', 'The Web Sense', 'Initial Mockup Design', '20250226182440.jpg', '1', NULL, '2025-02-26 18:24:40', '2025-02-26 18:24:40'),
(15, 'alex-devin', 'Alex & Devin', 'The Web Sense', 'Alex & Devin', '20250227181552.jpg', '1', NULL, '2025-02-27 18:15:52', '2025-02-27 18:15:52'),
(16, 'spotless-surface-cleaning', 'Spotless Surface Cleaning', 'Liberty Web Studio', 'Spotless Surface Cleaning', '20250227200403.jpg', '1', '2025-03-05 19:26:23', '2025-02-27 20:04:03', '2025-03-05 19:26:23'),
(17, 'cystine-cnc-medical-billing', 'Cystine - CNC Medical Billing', 'The Web Sense', 'Cystine - CNC Medical Billing', '20250228213111.jpg', '1', NULL, '2025-02-28 21:31:11', '2025-02-28 21:31:11'),
(18, 'miguel-inoidealist', 'Miguel - Inoidealist', 'American Brand Designer', 'Miguel - Inoidealist', '20250228214223.jpg', '1', NULL, '2025-02-28 21:42:23', '2025-02-28 21:42:23'),
(19, 'colorscape-arts', 'Colorscape Arts', 'Web Harmony', 'Colorscape Arts', '20250301193802.jpg', '1', NULL, '2025-03-01 19:38:02', '2025-03-01 19:38:02'),
(20, 'never-forget-custom-about-us', 'Never Forget Custom - About Us', 'American Digital Agency', 'Initial Mock', '20250306170758.jpg', '1', NULL, '2025-03-03 19:54:28', '2025-03-06 17:07:58'),
(21, 'integrated-healing', 'Integrated Healing', 'American Digital Agency', 'Integrated Healing', '20250303214139.jpg', '1', NULL, '2025-03-03 21:41:39', '2025-03-03 21:41:39'),
(22, 'indian-agri-talent', 'Indian Agri Talent', 'American Digital Agency', 'Indian Agri Talent', '20250303222255.jpg', '1', NULL, '2025-03-03 22:22:55', '2025-03-03 22:22:55'),
(23, 'michael-varela-vanderbilt-masonry', 'Michael Varela - Vanderbilt Masonry', 'Pixels and the Beast', 'Michael Varela - Vanderbilt Masonry', '20250312221846.jpg', '1', NULL, '2025-03-04 17:59:12', '2025-03-12 22:18:46'),
(24, 'kristin-mccullough', 'Kristin McCullough', 'American Digital Agency', 'Website Mockup', '20250304225720.jpg', '1', NULL, '2025-03-04 22:57:20', '2025-03-04 22:57:20'),
(25, 'never-forget-custom-how-it-works', 'Never Forget Custom - How it works', 'American Digital Agency', 'Initial Mock', '20250306170855.jpg', '1', NULL, '2025-03-04 23:08:08', '2025-03-06 17:08:55'),
(26, 'ethan-bibb-river-valley-cleanings', 'Ethan Bibb - River Valley Cleanings', 'Elite Pro Website', 'Ethan Bibb - River Valley Cleanings', '20250305191804.jpg', '1', NULL, '2025-03-05 19:18:04', '2025-03-05 19:18:04'),
(27, 'plantae-ipm', 'Plantae IPM', 'Liberty Web Studio', 'Plantae IPM', '20250305215537.jpg', '1', '2025-03-05 23:08:52', '2025-03-05 21:55:37', '2025-03-05 23:08:52'),
(28, 'plantae-ipm', 'Plantae IPM', 'Liberty Web Studio', 'Plantae IPM', '20250305230913.jpg', '1', '2025-03-12 21:41:28', '2025-03-05 23:09:13', '2025-03-12 21:41:28'),
(29, 'never-forget-custom-shop', 'Never Forget Custom - Shop', 'American Digital Agency', 'Initial Mock', '20250306171121.jpg', '1', NULL, '2025-03-06 15:52:31', '2025-03-06 17:11:21'),
(30, 'never-forget-custom-home', 'Never Forget Custom - Home', 'American Digital Agency', 'Finalized Page', '20250306171040.jpg', '1', NULL, '2025-03-06 17:10:40', '2025-03-06 17:10:40'),
(31, 'never-forget-custom-corporate-solutions', 'Never Forget Custom - Corporate Solutions', 'American Digital Agency', 'Initial Mock', '20250306171226.jpg', '1', NULL, '2025-03-06 17:12:26', '2025-03-06 17:12:26'),
(32, 'never-forget-custom-testimonials', 'Never Forget Custom - Testimonials', 'American Digital Agency', 'Initial Mock', '20250306171332.jpg', '1', NULL, '2025-03-06 17:13:32', '2025-03-06 17:13:32'),
(33, 'never-forget-custom-blog', 'Never Forget Custom - Blog', 'American Digital Agency', 'Initial Mock', '20250306171416.jpg', '1', NULL, '2025-03-06 17:14:16', '2025-03-06 17:14:16'),
(34, 'never-forget-custom-contact-us', 'Never Forget Custom - Contact Us', 'American Digital Agency', 'Initial Mock', '20250306171533.jpg', '1', NULL, '2025-03-06 17:15:33', '2025-03-06 17:15:33'),
(35, 'edgar-sarrate', 'Edgar Sarrate', 'The Web Sense', 'Edgar Sarrate', '20250310185420.jpg', '1', NULL, '2025-03-10 18:54:20', '2025-03-10 18:54:20'),
(36, 'design-1', 'Design 1', 'American Digital Agency', 'Mockup1', '20250311172631.jpg', '1', NULL, '2025-03-11 17:26:31', '2025-03-11 17:26:31'),
(37, 'design-2', 'Design 2', 'American Digital Agency', 'Mockup2', '20250311172730.jpg', '1', NULL, '2025-03-11 17:27:30', '2025-03-11 17:27:30'),
(38, 'high-class-realty-sb', 'High Class Realty sb', 'American Digital Agency', 'High Class Realty sb', '20250311193353.jpg', '1', NULL, '2025-03-11 19:33:53', '2025-03-11 19:33:53'),
(39, 'mapetitemer', 'Mapetitemer', 'American Brand Designer', 'Mapetitemer', '20250311213712.jpg', '1', NULL, '2025-03-11 21:37:12', '2025-03-11 21:37:12'),
(40, 'replenish-concierge-medical-aesthetics-and-wellness', 'Replenish Concierge Medical Aesthetics and Wellness', 'Liberty Web Studio', 'Website Design', '20250312181506.jpg', '1', NULL, '2025-03-12 18:15:06', '2025-03-12 18:15:06'),
(41, 'plantae-ipm', 'Plantae IPM', 'Liberty Web Studio', 'Plantae IPM', '20250312214250.jpg', '1', NULL, '2025-03-12 21:42:50', '2025-03-12 21:42:50'),
(42, '23ld', '23LD', 'American Brand Designer', '23LD', '20250312215812.jpg', '1', '2025-05-08 18:23:13', '2025-03-12 21:58:12', '2025-05-08 18:23:13'),
(43, 'starz-psychics', 'Starz Psychics', 'Web Harmony', 'Starz Psychics', '20250313161540.png', '1', '2025-03-13 16:17:55', '2025-03-13 16:15:40', '2025-03-13 16:17:55'),
(44, 'pcmountaintop-services', 'PCMountaintop Services', 'Liberty Web Studio', 'PCMountaintop Services', '20250313174229.png', '1', NULL, '2025-03-13 17:42:29', '2025-03-13 17:42:29'),
(45, 'mapetitemer-1', 'Mapetitemer-1', 'American Brand Designer', 'Mapetitemer-1', '20250313185249.jpg', '1', '2025-03-13 18:58:40', '2025-03-13 18:52:49', '2025-03-13 18:58:40'),
(46, 'mapetitemer-2', 'Mapetitemer-2', 'American Brand Designer', 'Mapetitemer-2', '20250313185335.jpg', '1', '2025-03-13 18:58:35', '2025-03-13 18:53:35', '2025-03-13 18:58:35'),
(47, 'hc-consulting-llc', 'HC Consulting LLC', 'American Brand Designer', 'HC Consulting LLC', '20250319230341.jpg', '1', NULL, '2025-03-13 23:14:11', '2025-03-19 23:03:41'),
(48, 'aces-plumbing-heating-and-cooling', 'Aces Plumbing Heating and Cooling', 'American Brand Designer', 'Aces Plumbing Heating and Cooling', '20250314182600.jpg', '1', NULL, '2025-03-14 18:26:00', '2025-03-14 18:26:00'),
(49, 'mapetitemer-1', 'Mapetitemer-1', 'American Brand Designer', 'Mapetitemer-1', '20250314193600.jpg', '1', NULL, '2025-03-14 19:36:00', '2025-03-14 19:36:00'),
(50, 'mapetitemer-2', 'Mapetitemer-2', 'American Brand Designer', 'Mapetitemer-2', '20250314193620.jpg', '1', NULL, '2025-03-14 19:36:20', '2025-03-14 19:36:20'),
(51, 'carlo-cammisano', 'Carlo Cammisano', 'The Web Sense', 'Carlo Cammisano', '20250317215415.jpg', '1', NULL, '2025-03-17 21:54:15', '2025-03-17 21:54:15'),
(52, 'ronita-glow-body-gloss', 'Ronita - Glow Body Gloss', 'American Brand Designer', 'Ronita - Glow Body Gloss', '20250318215443.png', '1', NULL, '2025-03-18 21:54:43', '2025-03-18 21:54:43'),
(53, 'sandi-madison', 'Sandi Madison', 'American Digital Publishers', 'Sandi Madison', '20250403204227.jpg', '1', NULL, '2025-03-19 19:03:38', '2025-04-03 20:42:27'),
(54, 'timothy-cordell-the-behavior-architects-llc', 'Timothy Cordell - The Behavior Architects LLC', 'Liberty Web Studio', 'Timothy Cordell - The Behavior Architects LLC', '20250319192910.jpg', '1', NULL, '2025-03-19 19:29:10', '2025-03-19 19:29:10'),
(55, 'assembly-technology-inc', 'Assembly Technology Inc', 'Web Harmony', 'Assembly Technology Inc', '20250319210228.jpg', '1', NULL, '2025-03-19 21:02:28', '2025-03-19 21:02:28'),
(56, 'simply-swift-landing-page', 'Simply Swift Landing Page', 'Elite Pro Website', 'Initial Mock', '20250320203700.jpg', '1', NULL, '2025-03-20 20:37:00', '2025-03-20 20:37:00'),
(57, 'hawaii-eye-weddings', 'Hawaii Eye Weddings', 'American Brand Designer', 'Hawaii Eye Weddings', '20250320215903.jpg', '1', NULL, '2025-03-20 21:59:04', '2025-03-20 21:59:04'),
(58, 'zen-salon-studios-llc', 'Zen Salon Studios LLC', 'Pixels and the Beast', 'Zen Salon Studios LLC', '20250324152408.jpg', '1', NULL, '2025-03-24 15:24:08', '2025-03-24 15:24:08'),
(59, 'kimberly-seymore', 'Kimberly Seymore', 'American Brand Designer', 'Kimberly Seymore', '20250325202242.jpg', '1', NULL, '2025-03-25 20:22:42', '2025-03-25 20:22:42'),
(60, 'hop-skip-jump', 'Hop Skip & Jump', 'The Tech Designers', 'Hop Skip & Jump', '20250325211239.jpg', '1', NULL, '2025-03-25 21:12:39', '2025-03-25 21:12:39'),
(61, 'larissa-sisti', 'Larissa Sisti', 'American Brand Designer', 'Book publishing', '20250326222209.jpg', '1', NULL, '2025-03-26 22:22:09', '2025-03-26 22:22:09'),
(62, 'suuvo', 'Suuvo', 'The Tech Designers', 'Suuvo', '20250327020340.jpg', '1', NULL, '2025-03-27 02:03:40', '2025-03-27 02:03:40'),
(63, 'bet-transport', 'Bet Transport', 'The Tech Designers', 'Homepage Design', '20250328205216.jpg', '1', NULL, '2025-03-28 17:22:21', '2025-03-28 20:52:16'),
(64, 'john-wetzel', 'John Wetzel', 'American Brand Designer', 'Pool repair and Maintenace', '20250328175925.jpg', '1', NULL, '2025-03-28 17:59:25', '2025-03-28 17:59:25'),
(65, 'touch-21', 'Touch 21', 'Pixels and the Beast', 'Homepage', '20250402205311.jpg', '1', NULL, '2025-03-28 18:20:43', '2025-04-02 20:53:11'),
(66, 'spiritual-kairos', 'Spiritual Kairos', 'American Digital Agency', 'Spiritual Kairos', '20250328184652.jpg', '1', NULL, '2025-03-28 18:46:52', '2025-03-28 18:46:52'),
(67, 'julio-hippos-landscape', 'Julio - Hippos Landscape', 'The Tech Designers', 'Julio - Hippos Landscape', '20250328222252.jpg', '1', NULL, '2025-03-28 22:17:21', '2025-03-28 22:22:52'),
(68, 'spiritual-kairos-1', 'Spiritual Kairos- 1', 'American Digital Agency', 'Spiritual Kairos- 1', '20250329225239.jpg', '1', NULL, '2025-03-29 22:52:39', '2025-03-29 22:52:39'),
(69, 'spiritual-kairos-2', 'Spiritual Kairos- 2', 'American Digital Agency', 'Spiritual Kairos- 2', '20250329225334.jpg', '1', NULL, '2025-03-29 22:53:34', '2025-03-29 22:53:34'),
(70, 'pet-care', 'Pet Care', 'The Web Sense', 'Pet Care', '20250401204257.jpg', '1', NULL, '2025-04-01 20:42:57', '2025-04-01 20:42:57'),
(71, 'temecula-valey-luxury-car-service', 'TEMECULA VALEY LUXURY CAR SERVICE', 'The Web Sense', 'TEMECULA VALEY LUXURY CAR SERVICE', '20250402173551.jpg', '1', NULL, '2025-04-02 17:35:51', '2025-04-02 17:35:51'),
(72, 'spiritual-kairos-3', 'Spiritual Kairos- 3', 'American Digital Agency', 'Spiritual Kairos- 3', '20250402190636.jpg', '1', NULL, '2025-04-02 19:06:36', '2025-04-02 19:06:36'),
(73, 'mba-financials', 'MBA Financials', 'American Brand Designer', 'MBA Financials', '20250402191024.jpg', '1', NULL, '2025-04-02 19:10:24', '2025-04-02 19:10:24'),
(74, 'spiritual-kairos-4', 'Spiritual Kairos-4', 'American Digital Agency', 'Spiritual Kairos-4', '20250402235027.jpg', '1', NULL, '2025-04-02 23:50:27', '2025-04-02 23:50:27'),
(75, 'express-alert-systems', 'Express Alert Systems', 'Liberty Web Studio', 'Express Alert Systems', '20250403174043.jpg', '1', NULL, '2025-04-03 17:40:43', '2025-04-03 17:40:43'),
(76, 'scvba-custom-home', 'SCVBA Custom_Home', 'American Digital Agency', 'Homepage Design', '20250403175425.jpg', '1', NULL, '2025-04-03 17:54:25', '2025-04-03 17:55:11'),
(77, 'scvba-custom-about', 'SCVBA Custom_About', 'American Digital Agency', 'About Us page', '20250403175650.jpg', '1', NULL, '2025-04-03 17:56:50', '2025-04-03 17:56:50'),
(78, 'scvba-custom-benefits', 'SCVBA Custom Benefits', 'American Digital Agency', 'Benefits Page', '20250403175847.jpg', '1', NULL, '2025-04-03 17:58:47', '2025-04-03 17:58:47'),
(79, 'scvba-custom-members-directory', 'SCVBA Custom Members Directory', 'American Digital Agency', 'Members Directory', '20250403175958.jpg', '1', NULL, '2025-04-03 17:59:58', '2025-04-03 17:59:58'),
(80, 'scvba-custom-registration', 'SCVBA Custom Registration', 'American Digital Agency', 'Registration Page', '20250403180111.jpg', '1', NULL, '2025-04-03 18:01:11', '2025-04-03 18:01:11'),
(81, 'scvba-custom-events', 'SCVBA Custom Events', 'American Digital Agency', 'Events Page', '20250403180349.jpg', '1', NULL, '2025-04-03 18:03:49', '2025-04-03 18:03:49'),
(82, 'scvba-custom-project-hub', 'SCVBA Custom Project Hub', 'American Digital Agency', 'Project Hub', '20250403180848.jpg', '1', NULL, '2025-04-03 18:08:48', '2025-04-03 18:08:48'),
(83, 'scbva-custom-contact-us', 'SCBVA Custom Contact Us', 'American Digital Agency', 'Contact Us Page', '20250403180957.jpg', '1', NULL, '2025-04-03 18:09:57', '2025-04-03 18:09:57'),
(84, 'hey-buddy-dog', 'Hey Buddy Dog', 'Web Harmony', 'Hey Buddy Dog', '20250408002023.jpg', '1', NULL, '2025-04-08 00:20:23', '2025-04-08 00:20:23'),
(85, 'care4u', 'Care4U', 'Pixels and the Beast', 'Care4U', '20250408202222.jpg', '1', NULL, '2025-04-08 20:22:22', '2025-04-08 20:22:22'),
(86, 'nagog', 'Nagog', 'The Tech Designers', 'Nagog', '20250409020452.jpg', '1', NULL, '2025-04-09 02:04:52', '2025-04-09 02:04:52'),
(87, 'cpp-solutions-llc', 'CPP Solutions LLC', 'The Web Sense', 'CPP Solutions LLC', '20250409174920.jpg', '1', NULL, '2025-04-09 17:49:20', '2025-04-09 17:49:20'),
(88, '23-ld-new-design', '23 LD - New Design', 'American Brand Designer', '23 LD - New Design', '20250409191503.jpg', '1', '2025-05-08 18:23:08', '2025-04-09 19:15:03', '2025-05-08 18:23:08'),
(89, 'von-z-max', 'Von Z Max', 'The Tech Designers', 'Von Z Max homepage design', '20250410173949.jpg', '1', NULL, '2025-04-09 19:46:41', '2025-04-10 17:39:49'),
(90, 'high-class-reality-sb', 'High Class Reality sb', 'American Digital Agency', 'High Class Reality sb', '20250409220255.jpg', '1', NULL, '2025-04-09 22:02:55', '2025-04-09 22:02:55'),
(91, 'okkee', 'Okkee', 'American Brand Designer', 'Okkee', '20250409233538.jpg', '1', NULL, '2025-04-09 23:35:38', '2025-04-09 23:35:38'),
(92, 'hey-buddy-2', 'Hey Buddy 2', 'The Tech Designers', 'Hey Buddy 2', '20250410182349.jpg', '1', NULL, '2025-04-10 18:23:49', '2025-04-10 18:23:49'),
(93, 'philis', 'Philis', 'American Digital Agency', 'Philis', '20250410225037.jpg', '1', '2025-04-11 22:50:15', '2025-04-10 22:50:37', '2025-04-11 22:50:15'),
(94, 'philis-2', 'Philis-2', 'American Digital Agency', 'Philis-2', '20250411203448.jpg', '1', '2025-04-11 22:50:21', '2025-04-11 20:34:48', '2025-04-11 22:50:21'),
(95, 'airborne-counseling-and-psychological-services', 'Airborne Counseling and Psychological Services', 'Liberty Web Studio', 'Airborne Counseling and Psychological Services', '20250411225223.jpg', '1', NULL, '2025-04-11 22:52:23', '2025-04-11 22:52:23'),
(96, 'cpp-solutions', 'CPP Solutions', 'The Web Sense', 'CPP Solutions', '20250411230030.jpg', '1', NULL, '2025-04-11 23:00:30', '2025-04-11 23:00:30'),
(97, 'flood-force', 'Flood Force', 'The Tech Designers', 'Flood Force', '20250412020417.jpg', '1', NULL, '2025-04-12 02:04:18', '2025-04-12 02:04:18'),
(98, 'flood-force-2', 'Flood Force 2', 'The Tech Designers', 'Flood Force 2', '20250415013558.jpg', '1', NULL, '2025-04-15 01:35:58', '2025-04-15 01:35:58'),
(99, 'flood-force-3', 'Flood Force 3', 'The Tech Designers', 'Flood Force 3', '20250415204915.jpg', '1', NULL, '2025-04-15 20:49:15', '2025-04-15 20:49:15'),
(100, 'leon-olen-miraj', 'Leon - Olen Miraj', 'The Web Sense', 'Leon - Olen Miraj', '20250416154226.jpg', '1', NULL, '2025-04-16 15:42:26', '2025-04-16 15:42:26'),
(101, 'emily-aichele', 'Emily Aichele', 'American Digital Agency', 'Emily Aichele', '20250416205532.jpg', '1', NULL, '2025-04-16 20:55:32', '2025-04-16 20:55:32'),
(102, 'bronzewood-getting-it-done', 'Bronzewood Getting It Done', 'Pixels and the Beast', 'Bronzewood Getting It Done', '20250416211009.jpg', '1', NULL, '2025-04-16 21:10:09', '2025-04-16 21:10:09'),
(103, 'water-pure-products', 'Water Pure Products', 'American Digital Agency', 'Water Pure Products', '20250417173317.jpg', '1', NULL, '2025-04-17 17:33:17', '2025-04-17 17:33:17'),
(104, 'sa-transnational-investments-llc', 'SA TRANSNATIONAL INVESTMENTS LLC', 'American Digital Agency', 'Website Design', '20250423185145.jpg', '1', NULL, '2025-04-17 19:52:10', '2025-04-23 18:51:45'),
(105, 'temico-godbold', 'Temico Godbold', 'Pixels and the Beast', 'Temico Godbold', '20250423164953.jpg', '1', NULL, '2025-04-23 16:49:53', '2025-04-23 16:49:53'),
(106, 'temico-godbold-1', 'Temico Godbold 1', 'Pixels and the Beast', 'Temico Godbold 1', '20250423165014.jpg', '1', NULL, '2025-04-23 16:50:14', '2025-04-23 16:50:14'),
(107, 'anthony-water-pure-products', 'Anthony- Water Pure Products', 'The Tech Designers', 'Anthony- Water Pure Products', '20250423200239.jpg', '1', NULL, '2025-04-23 20:02:39', '2025-04-23 20:02:39'),
(108, 'anthony', 'Anthony', 'The Tech Designers', 'Anthony', '20250423200309.jpg', '1', '2025-04-23 20:03:21', '2025-04-23 20:03:09', '2025-04-23 20:03:21'),
(109, 'lambert-lewis', 'Lambert Lewis', 'Pixels and the Beast', 'Lambert Lewis', '20250429164201.jpg', '1', NULL, '2025-04-24 19:36:33', '2025-04-29 16:42:01'),
(110, 'forever-dogs', 'Forever Dogs', 'Pixels and the Beast', 'Forever Dogs', '20250425213328.jpg', '1', NULL, '2025-04-25 21:33:28', '2025-04-25 21:33:28'),
(111, 'lovender-spa', 'Lovender Spa', 'The Tech Designers', 'Lovender Spa Homepage', '20250428203146.jpg', '1', '2025-05-01 17:26:33', '2025-04-28 20:31:46', '2025-05-01 17:26:33'),
(112, 'lovender-spa', 'Lovender Spa', 'The Tech Designers', 'Lovenderspa_homepage', '20250501172816.jpg', '1', NULL, '2025-05-01 17:28:16', '2025-05-01 17:28:16'),
(113, 'anita-estes-123', 'Anita Estes 123', 'Pixels and the Beast', 'Anita Estes 123', '20250602160857.jpg', '1', NULL, '2025-05-05 18:09:32', '2025-06-02 16:08:57'),
(114, 'tyrone-tidwell', 'Tyrone Tidwell', 'American Digital Agency', 'Tyrone Tidwell', '20250505182459.jpg', '1', NULL, '2025-05-05 18:24:59', '2025-05-12 15:32:50'),
(115, 'matt-wash-and-repair', 'Matt- WASH AND REPAIR', 'Pixels and the Beast', 'Matt- WASH AND REPAIR', '20250505183358.jpg', '1', NULL, '2025-05-05 18:33:58', '2025-05-05 18:33:58'),
(116, 'situs', 'SITUS', 'Web Harmony', 'SITUS_Homepage_design_Rev', '20250512175159.jpg', '1', NULL, '2025-05-05 19:21:02', '2025-05-12 17:51:59'),
(117, 'skinja-med-spa', 'Skinja Med Spa', 'Pixels and the Beast', 'Medspa', '20250507020840.jpg', '1', NULL, '2025-05-07 02:08:40', '2025-05-07 02:08:40'),
(118, 'persa-floor-covering', 'Persa Floor Covering', 'Web Harmony', 'Floor Covering', '20250507021834.jpg', '1', NULL, '2025-05-07 02:18:34', '2025-05-07 02:18:34'),
(119, 'pain-management-inc', 'Pain Management Inc', 'Pixels and the Beast', 'Pain Management', '20250507223238.jpg', '1', NULL, '2025-05-07 22:32:38', '2025-05-07 22:32:38'),
(120, '23-ld', '23 LD', 'American Brand Designer', '23 LD', '20250508182347.jpg', '1', NULL, '2025-05-08 18:23:47', '2025-05-08 18:23:47'),
(121, 'total-medicare-savings', 'Total Medicare Savings', 'The Tech Designers', 'Total Medicare Savings', '20250509185311.jpg', '1', '2025-05-20 01:34:37', '2025-05-09 18:53:11', '2025-05-20 01:34:37'),
(122, 'prochefs-world', 'Prochef\'s World', 'The Tech Designers', 'Prochef\'s World connect chefs, Restaurant Operators, And Hospitality Business.', '20250513221059.png', '1', NULL, '2025-05-13 22:10:59', '2025-05-13 22:10:59'),
(123, 'isadore-smith', 'Isadore Smith', 'Liberty Web Studio', 'Isadore Smith', '20250513230153.jpg', '1', NULL, '2025-05-13 23:01:53', '2025-05-13 23:01:53'),
(124, 'beic', 'BEIC', 'American Digital Agency', 'BEIC', '20250514014033.jpg', '1', '2025-06-05 02:04:32', '2025-05-14 01:40:33', '2025-06-05 02:04:32'),
(125, 'anita-estes-anita-estes', 'Anita Estes - Anita Estes', 'Pixels and the Beast', 'Anita Estes - Anita Estes', '20250515184207.jpg', '1', NULL, '2025-05-15 18:42:07', '2025-05-15 18:42:07'),
(126, 'anita-estes-anita-estes-1', 'Anita Estes - Anita Estes 1', 'Pixels and the Beast', 'Anita Estes - Anita Estes 1', '20250515184248.jpg', '1', NULL, '2025-05-15 18:42:48', '2025-05-15 18:42:48'),
(127, 'country-to-countries', 'Country to Countries', 'Pixels and the Beast', 'Travel Blog', '20250515191911.jpg', '1', NULL, '2025-05-15 19:19:11', '2025-05-15 19:19:11'),
(128, 'anita-estes-anita-estes-2', 'Anita Estes - Anita Estes 2', 'Pixels and the Beast', 'Anita Estes - Anita Estes 2', '20250516190623.jpg', '1', NULL, '2025-05-16 19:06:23', '2025-05-16 19:06:23'),
(129, 'anita-estes-anita-estes-website', 'Anita Estes - Anita Estes - Website', 'Pixels and the Beast', 'Anita Estes - Anita Estes - Website', '20250519203808.png', '1', NULL, '2025-05-19 20:38:08', '2025-05-19 20:38:08'),
(130, 'total-medicare-savings', 'Total Medicare Savings', 'The Tech Designers', 'Total Medicare Savings', '20250520013530.jpg', '1', NULL, '2025-05-20 01:35:30', '2025-05-20 01:35:30'),
(131, 'global-integrated-medical-services', 'Global Integrated Medical Services', 'American Digital Agency', 'Global Integrated Medical Services', '20250520181507.jpg', '1', NULL, '2025-05-20 18:15:07', '2025-05-20 18:15:07'),
(132, 'honest-pool-care', 'Honest Pool Care', 'The Tech Designers', 'Honest Pool Care', '20250520235616.jpg', '1', NULL, '2025-05-20 23:56:16', '2025-05-20 23:56:16'),
(133, 'anita-estes-anita-estes-3', 'Anita Estes - Anita Estes 3', 'Pixels and the Beast', 'Anita Estes - Anita Estes 3', '20250521171647.jpg', '1', NULL, '2025-05-21 17:16:47', '2025-05-21 17:16:47'),
(134, 'honest-pool', 'Honest Pool', 'The Tech Designers', 'Care', '20250522013305.jpg', '1', NULL, '2025-05-22 01:33:05', '2025-05-22 01:33:05'),
(135, 'mitra-korramian', 'Mitra Korramian', 'Liberty Web Studio', 'Mitra Korramian', '20250522232432.png', '1', NULL, '2025-05-22 23:24:32', '2025-05-22 23:24:32'),
(136, 'suzan-lisa', 'Suzan/ Lisa', 'American Brand Designer', 'Health care / Franchises', '20250523211352.jpg', '1', NULL, '2025-05-23 21:13:52', '2025-05-23 21:13:52'),
(137, 'anita-estes-05', 'Anita Estes 05', 'Pixels and the Beast', 'Anita Estes 05', '20250527183315.jpg', '1', NULL, '2025-05-27 18:33:15', '2025-05-27 18:33:15'),
(138, 'all-seasons', 'All Seasons', 'Web Harmony', 'All Seasons', '20250527183409.jpg', '1', NULL, '2025-05-27 18:34:09', '2025-05-27 18:34:09'),
(139, 'anita-estes-anita-estes-111', 'Anita Estes - Anita Estes 111', 'Pixels and the Beast', 'Anita Estes - Anita Estes 111', '20250527235358.jpg', '1', NULL, '2025-05-27 23:53:58', '2025-05-27 23:53:58'),
(140, 'forever-dogs-2', 'Forever Dogs (2)', 'American Digital Agency', 'Forever Dogs (2)', '20250528155403.jpg', '1', NULL, '2025-05-28 15:54:03', '2025-05-28 15:54:03'),
(141, 'suzan-lisa', 'Suzan /Lisa', 'American Digital Agency', 'Health Care business', '20250528155524.jpg', '1', NULL, '2025-05-28 15:55:24', '2025-05-28 15:55:24'),
(142, 'mitra-korramian-01', 'Mitra Korramian 01', 'Liberty Web Studio', 'Mitra Korramian 01', '20250528184055.jpg', '1', NULL, '2025-05-28 18:38:57', '2025-05-28 18:40:55'),
(143, 'baltimore', 'Baltimore', 'American Digital Agency', 'Help Kep Baltimore Clean', '20250528185414.jpg', '1', '2025-06-05 02:03:58', '2025-05-28 18:54:14', '2025-06-05 02:03:58'),
(144, 'motherland-art', 'Motherland Art', 'Liberty Web Studio', 'Art Website', '20250529014351.jpg', '1', NULL, '2025-05-29 01:43:51', '2025-05-29 01:43:51'),
(145, 'honest-pool-care-3', 'Honest Pool Care 3', 'The Tech Designers', 'Honest Pool Care', '20250530214945.jpg', '1', NULL, '2025-05-30 20:39:38', '2025-05-30 21:49:45'),
(146, 'joe-alexander', 'Joe Alexander', 'Pixels and the Beast', 'Joe Alexander', '20250602155859.jpg', '1', NULL, '2025-06-02 15:58:59', '2025-06-02 15:58:59'),
(147, 'anita-estes', 'Anita Estes -', 'Pixels and the Beast', 'Anita Estes -', '20250602160751.jpg', '1', NULL, '2025-06-02 16:07:51', '2025-06-02 16:07:51'),
(148, 'motherland-art-2', 'Motherland Art 2', 'Liberty Web Studio', 'Art', '20250602214757.jpg', '1', NULL, '2025-06-02 21:47:57', '2025-06-02 21:47:57'),
(149, 'motherland-art-3', 'Motherland Art 3', 'Liberty Web Studio', 'Art', '20250602220201.png', '1', NULL, '2025-06-02 22:02:01', '2025-06-02 22:02:01'),
(150, 'vidalinks-llc', 'Vidalinks LLC', 'The Tech Designers', 'Vidalinks LLC', '20250603232413.jpg', '1', NULL, '2025-06-03 23:24:13', '2025-06-03 23:24:13'),
(151, 'princess-dora-soap-company', 'Princess Dora Soap Company', 'Pixels and the Beast', 'Princess Dora Soap Company', '20250604193426.jpg', '1', NULL, '2025-06-04 16:32:30', '2025-06-04 19:34:26'),
(152, 'steamed-up', 'Steamed Up', 'Web Harmony', 'Carpet Cleaning', '20250605015720.png', '1', NULL, '2025-06-05 01:57:20', '2025-06-05 01:57:20'),
(153, 'mitra-korramian-011', 'Mitra Korramian 011', 'Liberty Web Studio', 'Mitra Korramian 011', '20250605164819.jpg', '1', NULL, '2025-06-05 16:46:43', '2025-06-05 16:48:19'),
(154, 'breakwater', 'Breakwater', 'Web Harmony', 'Breakwater', '20250605165014.jpg', '1', NULL, '2025-06-05 16:50:14', '2025-06-05 16:50:14'),
(155, 'christine', 'Christine', 'American Digital Agency', 'Art Gallery (Dark Room)', '20250606165041.jpg', '1', NULL, '2025-06-06 16:50:41', '2025-06-06 16:50:41'),
(156, 'subra-make-in-america', 'Subra- Make in America', 'American Digital Agency', 'Subra- Make in America', '20250609185228.jpg', '1', NULL, '2025-06-09 18:52:28', '2025-06-09 18:52:40'),
(157, 'asheville-01', 'asheville 01', 'Pixels and the Beast', 'asheville 01', '20250609212237.png', '1', NULL, '2025-06-09 21:22:37', '2025-06-09 21:22:37'),
(158, 'make-in-america', 'Make in America', 'American Digital Agency', 'Make in America', '20250609214242.jpg', '1', NULL, '2025-06-09 21:23:50', '2025-06-09 21:42:42'),
(159, 'james-breakwater-psychiatry-and-mental-health', 'James- Breakwater Psychiatry and Mental Health', 'Web Harmony', 'James- Breakwater Psychiatry and Mental Health', '20250611161234.jpg', '1', NULL, '2025-06-11 16:12:34', '2025-06-11 16:12:34'),
(160, 'job-speak-labradors', 'Job Speak Labradors', 'Web Harmony', 'Website Demo Link', '20250611182051.jpg', '1', NULL, '2025-06-11 18:20:51', '2025-06-11 18:20:51'),
(161, 'merit-coaching', 'Merit Coaching', 'Pixels and the Beast', 'MERIT Coaching Communications Consulting', '20250611204103.jpg', '1', '2025-06-13 17:20:01', '2025-06-11 20:41:03', '2025-06-13 17:20:01'),
(162, 'asheville-food-safety', 'Asheville Food Safety', 'Pixels and the Beast', 'Website Demo Link', '20250612161908.jpg', '1', NULL, '2025-06-12 16:19:08', '2025-06-12 16:19:08'),
(163, 'ruby-molly', 'Ruby Molly', 'Liberty Web Studio', 'Ruby Molly', '20250613162701.jpg', '1', NULL, '2025-06-13 16:27:01', '2025-06-13 16:27:01'),
(164, 'merit-coaching-center', 'Merit Coaching Center', 'Pixels and the Beast', 'Jennifer', '20250613172303.jpg', '1', NULL, '2025-06-13 17:23:03', '2025-06-13 17:23:03'),
(165, 'the-pelvister', 'The Pelvister', 'Web Harmony', 'Physical Therapist', '20250617192001.jpg', '1', '2025-06-19 02:20:54', '2025-06-17 19:20:01', '2025-06-19 02:20:54'),
(166, 'ruby-molly-hawkins', 'Ruby Molly Hawkins', 'Liberty Web Studio', 'Ruby Molly Hawkins', '20250623165349.jpg', '1', NULL, '2025-06-18 16:01:01', '2025-06-23 16:53:49'),
(167, 'website-revised-layout', 'Website Revised Layout', 'The Tech Designers', 'Website Revised Layout', '20250618164634.jpg', '1', NULL, '2025-06-18 16:46:34', '2025-06-18 16:46:34'),
(168, 'cameron', 'Cameron', 'Pixels and the Beast', 'Revised Draft', '20250618210718.jpg', '1', '2025-06-19 22:44:19', '2025-06-18 21:07:18', '2025-06-19 22:44:19'),
(169, 'merit', 'Merit', 'Pixels and the Beast', 'Revised Draft', '20250618212716.jpg', '1', NULL, '2025-06-18 21:27:16', '2025-06-18 21:27:16'),
(170, 'the-pelvister', 'The Pelvister', 'Web Harmony', 'Nimisha', '20250619022344.jpg', '1', NULL, '2025-06-19 02:23:44', '2025-06-19 02:23:44'),
(171, 'bernadette-bloom-space', 'Bernadette- Bloom Space', 'Web Harmony', 'Bernadette- Bloom Space', '20250619212634.jpg', '1', NULL, '2025-06-19 21:26:34', '2025-06-19 21:26:34'),
(172, 'cameron', 'Cameron', 'Pixels and the Beast', 'Kellie', '20250619224451.jpg', '1', NULL, '2025-06-19 22:44:51', '2025-06-19 22:44:51'),
(173, 'anthony-innovative-chemical-technologies', 'Anthony- Innovative Chemical Technologies', 'American Digital Agency', 'Anthony- Innovative Chemical Technologies', '20250621001138.jpg', '1', NULL, '2025-06-21 00:11:38', '2025-06-21 00:11:38'),
(174, 'ruby-molly-hawkins', 'Ruby-Molly-Hawkins', 'Liberty Web Studio', 'Ruby-Molly-Hawkins', '20250623164555.jpg', '1', NULL, '2025-06-23 16:45:55', '2025-06-23 16:45:55'),
(175, 'jenbyrne', 'JenByrne', 'Pixels and the Beast', 'Merit Coaching', '20250625015018.jpg', '1', NULL, '2025-06-25 01:50:18', '2025-06-25 01:50:18'),
(176, 'oil-by-bruce', 'Oil By Bruce', 'Pixels and the Beast', 'Art Work', '20250625020919.jpg', '1', NULL, '2025-06-25 02:09:19', '2025-06-25 02:09:19'),
(177, 'veritas-data-analytica', 'Veritas Data Analytica', 'American Digital Agency', 'Homepage Design', '20250627211651.jpg', '1', '2025-06-27 22:08:50', '2025-06-27 21:16:51', '2025-06-27 22:08:50'),
(178, 'veritas-data-analytica', 'Veritas Data Analytica', 'American Digital Agency', 'Homepage', '20250627232614.jpg', '1', NULL, '2025-06-27 23:26:14', '2025-06-27 23:26:14'),
(179, 'jamayia-willison', 'Jamayia Willison', 'American Digital Agency', 'Event Planning', '20250630161445.jpg', '1', NULL, '2025-06-30 16:14:45', '2025-06-30 16:14:45'),
(180, 'century-pro-restoration', 'Century Pro Restoration', 'American Digital Agency', 'Homepage', '20250710001446.jpg', '1', NULL, '2025-06-30 22:10:11', '2025-07-10 00:14:46'),
(181, 'plastic-muse', 'Plastic Muse', 'The Tech Designers', 'Landing page', '20250630233753.jpg', '1', NULL, '2025-06-30 23:37:53', '2025-06-30 23:37:53'),
(182, 'century-pro-restoration-ii', 'Century Pro Restoration II', 'American Digital Agency', 'Homepage_BLACK', '20250710192223.jpg', '1', NULL, '2025-07-10 19:22:23', '2025-07-10 19:22:23'),
(183, 'fam-jam', 'Fam Jam', 'Liberty Web Studio', 'Homepage_Revision', '20250711194516.jpg', '1', NULL, '2025-07-11 19:29:38', '2025-07-11 19:45:16'),
(184, 'veritasdataanalytica', 'VeritasDataAnalytica', 'American Digital Agency', 'Updated_homepage', '20250714185823.jpg', '1', NULL, '2025-07-14 18:58:23', '2025-07-14 18:58:23'),
(185, 'blue-goddess-dream', 'Blue Goddess Dream', 'American Brand Designer', 'Blue Goddess Dream', '20250714192748.jpg', '1', NULL, '2025-07-14 19:27:48', '2025-07-14 19:27:48'),
(186, 'sandra-crewe', 'Sandra Crewe', 'American Digital Agency', 'Homepage', '20250718225048.jpg', '1', NULL, '2025-07-17 17:13:20', '2025-07-18 22:50:48'),
(187, 'lambert', 'Lambert', 'Pixels and the Beast', 'Lambert', '20250718171754.jpg', '1', NULL, '2025-07-18 17:17:54', '2025-07-18 17:17:54'),
(188, 'talley-woodmark-branching-out-publishing', 'Talley Woodmark Branching Out Publishing', 'American Digital Agency', 'Branching Out Publishing', '20250718235116.png', '1', NULL, '2025-07-18 23:51:16', '2025-07-18 23:51:16'),
(189, 'fair-pet-foundation', 'Fair Pet Foundation', 'The Tech Designers', 'Fair Pet Foundation', '20250721221321.jpg', '1', '2025-07-22 18:29:55', '2025-07-21 22:13:21', '2025-07-22 18:29:55'),
(190, 'fair-pet-foundation-new', 'Fair Pet Foundation New', 'The Tech Designers', 'Fair Pet Foundation New', '20250722183018.jpg', '1', '2025-07-22 18:45:26', '2025-07-22 18:30:18', '2025-07-22 18:45:26'),
(191, 'fair-pet-foundation', 'Fair Pet Foundation', 'The Tech Designers', 'Fair Pet Foundation', '20250722184549.jpg', '1', NULL, '2025-07-22 18:45:49', '2025-07-22 18:45:49'),
(192, 'fair-pet-foundation-2', 'Fair Pet Foundation 2', 'The Tech Designers', 'Fair Pet Foundation 2', '20250723184821.jpg', '1', NULL, '2025-07-23 18:48:21', '2025-07-23 18:48:21'),
(193, 'sonic-bloom-imaging', 'Sonic Bloom Imaging', 'The Web Sense', 'Homepage Design', '20250731211149.jpg', '1', NULL, '2025-07-25 16:32:01', '2025-07-31 21:11:49'),
(194, 'tiaba-crawford-cares', 'Tiaba - Crawford Cares', 'American Digital Agency', 'Tiaba - Crawford Cares', '20250725201231.jpg', '1', NULL, '2025-07-25 20:12:31', '2025-07-25 20:12:31'),
(195, 'tiaba-crawford-cares-01', 'Tiaba - Crawford Cares 01', 'American Digital Agency', 'Tiaba - Crawford Cares 01', '20250805174357.jpg', '1', NULL, '2025-08-05 17:43:57', '2025-08-05 17:43:57'),
(196, 'nature-of-the-dog', 'Nature of the Dog', 'American Digital Agency', 'Nature of the Dog', '20250806212914.jpg', '1', NULL, '2025-08-06 21:29:14', '2025-08-06 21:29:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latest_news`
--
ALTER TABLE `latest_news`
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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_settings`
--
ALTER TABLE `page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photo_galleries`
--
ALTER TABLE `photo_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `schedule_shop_contacts`
--
ALTER TABLE `schedule_shop_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_contacts`
--
ALTER TABLE `shop_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_links`
--
ALTER TABLE `web_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `latest_news`
--
ALTER TABLE `latest_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `page_settings`
--
ALTER TABLE `page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_galleries`
--
ALTER TABLE `photo_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule_shop_contacts`
--
ALTER TABLE `schedule_shop_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_contacts`
--
ALTER TABLE `shop_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `web_links`
--
ALTER TABLE `web_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- Constraints for dumped tables
--

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
