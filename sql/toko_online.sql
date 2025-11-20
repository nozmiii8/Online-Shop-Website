-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 10:50 AM
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
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` enum('canva','website') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image`, `file_path`, `created_at`) VALUES
(7, 'Responsive Portfolio Website Alexa', 'Responsive Portfolio Website Alexa\r\nResponsive Personal Portfolio Website Using HTML CSS & JavaScript\r\nSmooth scrolling in each section.\r\nIncludes a light and dark mode.\r\nDeveloped first with the Mobile First methodology, then for desktop.\r\nCompatible with all mobile devices and with a beautiful and pleasant user interface.', 10.00, 'website', 'assets/img/template_website/1763585053_Alexa.png', 'assets/uploads/template_website/1763585053_responsive-portfolio-website-Alexa-main.zip', '2025-11-19 20:44:13'),
(8, 'Astrofy | Personal Portfolio Website Template', 'Astrofy is a free and open-source template for your Personal Portfolio Website built with Astro and TailwindCSS. Create in minutes a website with a Blog, CV, Project Section, Store, and RSS Feed.', 10.00, 'website', 'assets/img/template_website/1763631027_social_img.webp', 'assets/uploads/template_website/1763631027_astrofy-main.zip', '2025-11-20 09:30:27'),
(9, 'Next.Js Website Tutorial: Create a Stunning Portfolio Website with Nextjs, Tailwind CSS and Framer-m', 'Resources Used in This Project\r\nProfile image in the home page created by using https://www.midjourney.com/ tool.\r\nProfile image in the about page by Albert Dera on Unsplash.\r\nFonts from https://fonts.google.com/\r\nIcons from https://iconify.design/\r\nLightBulb Svg from https://lukaszadam.com/illustrations\r\nExternal Libraries used in this project:\r\nframer-motion\r\nTailwind css', 5.00, 'website', 'assets/img/template_website/1763631139_home-dark-desktop.png', 'assets/uploads/template_website/1763631139_Next.js-Developer-Portfolio-Starter-Code-main.zip', '2025-11-20 09:32:19'),
(10, 'Fimbo Template', 'Everyone needs a website to express themselves so i made free website templates. All you need to do is download them and customize them according to your need.\r\n\r\nHave Fun. 😄\r\n\r\nAdd your template\r\nIf you have a template you want to be on this repo create a PR', 1.00, 'website', 'assets/img/template_website/1763631233_fimbo.png', 'assets/uploads/template_website/1763631233_fimbo-master.zip', '2025-11-20 09:33:53'),
(11, 'Odyseey Template', 'Odyssey Theme is a modern theme/starter for a business or startup\'s marketing website. It provides landing page examples, a full-featured blog, contact forms, and more. It is fully themeable to match your business\' branding and style. It even includes a theme switcher component to show how easily the entire style of the site can be changed with only a few lines of CSS.', 25.00, 'website', 'assets/img/template_website/1763631372_gh-banner.png', 'assets/uploads/template_website/1763631372_odyssey-theme-main.zip', '2025-11-20 09:36:12'),
(12, 'NFT Collection Website', 'npm run eject\r\nNote: this is a one-way operation. Once you eject, you can\'t go back!\r\n\r\nIf you aren\'t satisfied with the build tool and configuration choices, you can eject at any time. This command will remove the single build dependency from your project.\r\n\r\nInstead, it will copy all the configuration files and the transitive dependencies (webpack, Babel, ESLint, etc) right into your project so you have full control over them. All of the commands except eject will still work, but they will point to the copied scripts so you can tweak them. At this point you\'re on your own.\r\n\r\nYou don\'t have to ever use eject. The curated feature set is suitable for small and middle deployments, and you shouldn\'t feel obligated to use this feature. However we understand that this tool wouldn\'t be useful if you couldn\'t customize it when you are ready for it.', 20.00, 'website', 'assets/img/template_website/1763631528_Home - Desktop.png', 'assets/uploads/template_website/1763631528_The-Weirdos-NFT-Website-Starter-Code-main.zip', '2025-11-20 09:38:48'),
(13, 'Hugo Website', 'Software\r\nThe website is built with Hugo v0.147.2 via GitHub Actions.\r\nThe website was developed locally with Hugo v0.147.2 on macOS Sequoia.\r\nThe website was tested on the following browsers:\r\nSafari 18.4 on macOS Sequoia\r\nMobile Safari on iOS 18\r\nOther Hugo versions, operating systems, and web browsers may require minor adjustments. Please report any issues to help improve compatibility.', 16.00, 'website', 'assets/img/template_website/1763631658_e3f70599-7617-4f66-a44c-3773150f2de5.png', 'assets/uploads/template_website/1763631658_hugo-website-main.zip', '2025-11-20 09:40:58'),
(14, 'Foxi - Astro Theme', 'Foxi is a free, highly customizable, and production-ready template for Astro, utilizing Tailwind CSS components. Designed with developers in mind, Foxi offers a solid foundation for building modern, high-performance websites quickly and efficiently.', 18.00, 'website', 'assets/img/template_website/1763631922_68747470733a2f2f6f787967656e6e612d7468656d65732e622d63646e2e6e65742f666f78692d617374726f2f666f78692e706e67.png', 'assets/uploads/template_website/1763631922_foxi-astro-theme-main.zip', '2025-11-20 09:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `profile_photo`, `role`, `created_at`) VALUES
(1, 'admin@example.com', 'admin@example.com', '$2y$10$d6rjahK54JnAbol7Wc686O5NSoWKLJiyexD6CMI7sLu9O4b19T0FK', '087885122942', 'assets/uploads/profile_photos/1763629517_1-685278c2809aff95140b078e8009d0e3a6c70075a980544e23175260f2e219d8.jpg', 'admin', '2025-11-19 17:34:45'),
(2, 'users', 'users@gmail.com', '$2y$10$imZL6Ea64wY/JzWX2YYlYeVL5947MmEhfQMSQ.XLRf1dPM9Glmabe', '087885122942', 'assets/uploads/profile_photos/1763575960_Screenshot 2025-09-13 132139.png', 'user', '2025-11-19 17:41:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
