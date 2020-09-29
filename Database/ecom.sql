-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 29, 2020 at 02:19 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(2) NOT NULL,
  `brandname` varchar(50) NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `uptime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brandname`, `addtime`, `uptime`) VALUES
(8, 'hp', '2020-09-21 05:54:35', '2020-09-21 05:54:35'),
(9, 'asus', '2020-09-21 05:54:41', '2020-09-21 05:54:41'),
(15, 'LG', '2020-09-21 13:23:32', '2020-09-21 13:23:32'),
(16, 'Dell', '2020-09-21 13:23:48', '2020-09-21 13:23:48'),
(20, 'Acer', '2020-09-22 03:37:39', '2020-09-22 03:37:39'),
(26, 'KFC', '2020-09-22 16:29:48', '2020-09-22 16:29:48'),
(27, 'Apple', '2020-09-22 16:32:56', '2020-09-22 16:32:56'),
(28, 'Panasonic', '2020-09-23 05:25:43', '2020-09-23 05:25:43'),
(29, 'MR. Bekary', '2020-09-23 07:04:51', '2020-09-23 07:04:51'),
(30, 'Food Villa', '2020-09-23 07:05:03', '2020-09-23 07:05:03'),
(31, 'Bata', '2020-09-23 07:05:22', '2020-09-23 07:05:22'),
(32, 'Samsung', '2020-09-25 04:00:41', '2020-09-25 04:00:41'),
(33, 'Yamaha', '2020-09-28 15:53:55', '2020-09-28 15:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(2) NOT NULL,
  `p_id` int(2) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `u_id` int(2) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_image` varchar(255) NOT NULL,
  `avilavle` int(5) NOT NULL,
  `quantity` int(2) NOT NULL,
  `price` float(10,2) NOT NULL,
  `total_amnt` float(10,2) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `p_id`, `ip_add`, `u_id`, `p_name`, `p_image`, `avilavle`, `quantity`, `price`, `total_amnt`, `add_date`) VALUES
(97, 33, '0', 4, 'Samsung Galaxy A30s', 'e6f53d3395.png', 43, 1, 205.65, 205.65, '2020-09-28 07:16:14'),
(98, 31, '0', 4, 'Keyboard RAZR', 'b682318fd4.jpg', 5, 1, 100.00, 100.00, '2020-09-28 07:17:13'),
(100, 28, '0', 4, 'ACER VivoBook N550', '4311f25f8c.jpg', 19, 1, 502.25, 502.25, '2020-09-28 13:22:07'),
(102, 37, '0', 3, 'Yamaha YZF R15 v3', '396a1643a7.jpg', 100, 1, 500.25, 500.25, '2020-09-28 16:13:00'),
(121, 26, '0', 9, 'Asus VivoBook N550', 'c9cb1ab9fb.jpg', 14, 1, 502.25, 502.25, '2020-09-29 07:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(2) NOT NULL,
  `catname` varchar(50) NOT NULL,
  `parent_cat` int(2) NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `uptime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `catname`, `parent_cat`, `addtime`, `uptime`) VALUES
(1, 'Electronics', 0, '2020-09-21 13:20:25', '2020-09-21 13:20:25'),
(2, 'Laptop', 1, '2020-09-21 13:20:39', '2020-09-21 13:20:39'),
(4, 'Hardware', 0, '2020-09-21 13:21:16', '2020-09-21 13:21:16'),
(16, 'Accessories  ', 0, '2020-09-22 16:22:56', '2020-09-22 16:22:56'),
(17, 'food', 0, '2020-09-22 16:23:21', '2020-09-22 16:23:21'),
(22, 'Software', 16, '2020-09-23 05:21:36', '2020-09-23 05:21:36'),
(23, 'Anti Virus', 22, '2020-09-23 05:23:47', '2020-09-23 05:23:47'),
(24, 'Gadgets', 0, '2020-09-23 05:25:19', '2020-09-23 05:25:19'),
(26, 'Mobile', 1, '2020-09-25 04:00:32', '2020-09-25 04:00:32'),
(27, 'Vehicle ', 0, '2020-09-28 15:53:22', '2020-09-28 15:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cmnt_id` int(11) NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmnt_id`, `cus_name`, `cus_email`, `pro_id`, `date`, `comment`) VALUES
(1, 'Tanzim', 'tanzim@gmail.com', 21, '2020-09-29 06:29:06', 'yammy!'),
(2, 'Tanzim', 'tanzim@gmail.com', 38, '2020-09-29 07:43:21', 'nice'),
(3, 'Tanzim', 't@gmail.com', 26, '2020-09-29 08:40:57', 'nice');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(3) NOT NULL,
  `cus_fname` varchar(255) NOT NULL,
  `cus_lname` varchar(255) NOT NULL,
  `cus_uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cus_pass` varchar(255) NOT NULL,
  `cus_phone` varchar(20) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `cus_address_2` varchar(200) NOT NULL,
  `cus_city` varchar(200) NOT NULL,
  `cus_zip` int(20) NOT NULL,
  `total_order` int(2) NOT NULL DEFAULT 0,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_fname`, `cus_lname`, `cus_uname`, `email`, `cus_pass`, `cus_phone`, `cus_address`, `cus_address_2`, `cus_city`, `cus_zip`, `total_order`, `add_date`) VALUES
(3, 'Asik ', 'Newaz', 'Asik', 'asik@gmail.com', '$2y$10$YyYGlo8PPGn0NMbdE1MWTuuyz2lJopcLZj3byyc6Ja91l/rBFi8Ty', '+88001266666666', 'Khalipara', 'Majibari', 'Pabna', 126, 0, '2020-09-25 00:50:48'),
(4, 'Shahin', 'Khan', 'shahin', 'shahin@gmail.com', '$2y$10$h8mTDcOOLa3J4K.IgBXUaebuR0AzZQHVdb4zNd954KXvt4iskgtGa', '01754100439', 'Dhaka', 'Nikujjo', 'dhaka', 336, 0, '2020-09-25 00:55:58'),
(5, 'omi', 'dev', 'omi', 'omi@gmail.com', '$2y$10$WNWM8tz8FqzWJSVR6CDrv.0byGQkfVvG0iqU9FDERhSX.9G/DAg2W', '1458', 'dd', '', '', 0, 0, '2020-09-25 00:59:08'),
(6, 'Kanak ', 'Miji', 'kanok', 'k@gmail.com', '$2y$10$rflsznLM5HYfKcPHgSmaj.phPIpyzjpYJYveD7mFPRV9XdJNliPhu', '86566666', 'rkjsdlx', '', '', 0, 0, '2020-09-25 01:29:39'),
(7, 'Tanzim', 'Hasan', 'Tanzim', 'tanzim@gmail.com', '$2y$10$UCdh8mOJLWgnEEtDJ2S.kerF92CkzrUweIiVQpDgapzbCccVEFnB2', '+88012369856', 'Srimangal,Sylhet,Bangladesh', 'Sylhet', 'Jaflong', 19652, 0, '2020-09-29 00:24:17'),
(8, 'Shawon', 'Khan', 'Shahwon', 'shahwon@gmail.com', '$2y$10$SxQth5zQ6wkvtVFgNtBmU.gjDTqnko5/eJjPP031/p4kAntLYLthG', '+880145856', 'Dhaka', '', '', 0, 0, '2020-09-29 02:34:11'),
(9, 'Tanzim', 'Hasan', 'Tanzim007', 't@gmail.com', '$2y$10$n8u3eC25Xzd17yD6GFOXZeBylBke.4NTtUECaJu6LPCr7XQuTCaq.', '+880123698564', 'Dhaka,Bangladesh', 'Mirpur', 'Mirpur-1', 1256, 0, '2020-09-29 02:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `odr_id` int(2) NOT NULL,
  `cus_id` int(2) NOT NULL,
  `pro_id` int(2) NOT NULL,
  `pro_name` varchar(200) NOT NULL,
  `quantity` int(2) NOT NULL,
  `price` float(10,2) NOT NULL,
  `total_amnt` float(10,2) NOT NULL,
  `pro_image` varchar(200) NOT NULL,
  `status` int(2) NOT NULL,
  `process` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`odr_id`, `cus_id`, `pro_id`, `pro_name`, `quantity`, `price`, `total_amnt`, `pro_image`, `status`, `process`, `date`, `comment`) VALUES
(1, 7, 38, 'Car YZF R15 v3', 2, 500.25, 1000.50, '594a0ac174.jpg', 3, 0, '2020-09-29 05:45:18', 'order'),
(2, 7, 39, 'Motherboard Core i11', 1, 500.25, 500.25, '6f822f8e6d.jpg', 3, 0, '2020-09-29 05:45:18', 'order'),
(3, 7, 37, 'Yamaha YZF R15 v3', 1, 500.25, 500.25, '396a1643a7.jpg', 3, 0, '2020-09-29 05:45:19', 'order'),
(4, 7, 22, 'MotherBoard', 1, 255.25, 255.25, 'bcd53729f9.jpg', 3, 0, '2020-09-29 05:45:19', 'order'),
(5, 7, 34, 'KFC Salad', 2, 20.00, 40.00, '1083eb7490.jpg', 3, 0, '2020-09-29 05:45:19', 'order'),
(6, 9, 26, 'Asus VivoBook N550', 2, 502.25, 1004.50, 'c9cb1ab9fb.jpg', 3, 0, '2020-09-29 06:43:27', 'order'),
(7, 9, 39, 'Motherboard Core i11', 2, 500.25, 1000.50, '6f822f8e6d.jpg', 3, 0, '2020-09-29 06:43:27', 'order'),
(8, 9, 38, 'Car YZF R15 v3', 1, 500.25, 500.25, '594a0ac174.jpg', 3, 0, '2020-09-29 06:43:27', 'order'),
(9, 9, 37, 'Yamaha YZF R15 v3', 1, 500.25, 500.25, '396a1643a7.jpg', 3, 0, '2020-09-29 06:43:27', 'order'),
(10, 9, 36, 'Bicyle R721', 1, 100.00, 100.00, '320f7a450f.jpg', 0, 0, '2020-09-29 06:43:27', 'order'),
(11, 9, 28, 'ACER VivoBook N550', 1, 502.25, 502.25, '4311f25f8c.jpg', 3, 0, '2020-09-29 06:43:27', 'order');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(3) NOT NULL,
  `productname` varchar(200) NOT NULL,
  `cat_id` tinyint(2) NOT NULL,
  `brand_id` tinyint(2) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(2) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `description` text NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `productname`, `cat_id`, `brand_id`, `price`, `quantity`, `keywords`, `image`, `status`, `type`, `description`, `add_date`, `up_date`) VALUES
(16, 'Apple Desktop with Package', 2, 27, 500.50, 19, 'laptop apple mac package', '270e64932e.jpg', 0, 2, 'Apple : The Macintosh is a family of personal computers designed, manufactured, and sold by Apple Inc. since January 1984. The original Macintosh is the first successful mass-market personal computer to have featured a graphical user interface, built-in scre\r\nThe Macintosh is a family of personal computers designed, manufactured, and sold by Apple Inc. since January 1984. The original Macintosh is the first successful mass-market personal computer to have featured a graphical user interface, built-in scre\r\nThe Macintosh is a family of personal computers designed, manufactured, and sold by Apple Inc. since January 1984. The original Macintosh is the first successful mass-market personal computer to have featured a graphical user interface, built-in scre', '2020-09-22 16:34:18', '2020-09-28 01:04:00'),
(17, 'Chocolate Cake', 17, 26, 45.25, 20, 'Chocolate Cake food', '07f16d6eca.jpg', 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:31:16', '2020-09-25 13:15:31'),
(18, 'Brownie Cake', 17, 26, 45.25, 19, 'Brownie  Cake  food', '302208c502.jpg', 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:31:54', '2020-09-28 05:32:51'),
(19, 'Dinner Fish', 17, 26, 45.25, 19, 'Dinner Fish', '0ee3d9f34b.jpg', 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:34:44', '2020-09-28 01:03:58'),
(20, 'Lettuce Salad', 17, 26, 45.25, 19, 'Lettuce Salad', 'dc9ffb3aa0.jpg', 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:35:17', '2020-09-28 05:32:51'),
(21, 'Healty Salad', 17, 26, 45.25, 18, 'Healthy Salad', '0fe3f72952.jpg', 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:35:44', '2020-09-28 04:10:38'),
(22, 'MotherBoard', 16, 9, 255.25, 17, 'Healthy Salad', 'bcd53729f9.jpg', 0, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:39:24', '2020-09-29 05:45:19'),
(23, 'MacBook Pro', 2, 27, 255.25, 19, 'laptop apple mac package', 'ce1f2258b0.jpg', 0, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:40:00', '2020-09-28 01:03:51'),
(24, 'Anti Virus 2020', 23, 9, 202.25, 16, 'laptop apple mac package', '7e4c2539ad.jpg', 0, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:40:51', '2020-09-28 05:32:52'),
(25, 'Asus VivoBook N580', 2, 9, 502.25, 17, 'Asus VivoBook N580', '869d16173c.jpg', 0, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:41:27', '2020-09-28 05:32:51'),
(26, 'Asus VivoBook N550', 2, 9, 502.25, 14, 'Asus VivoBook N550', 'c9cb1ab9fb.jpg', 0, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:41:44', '2020-09-29 06:43:27'),
(27, 'LG VivoBook N550', 2, 15, 502.25, 16, 'LG VivoBook N550', '98f22c478f.jpg', 0, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:42:13', '2020-09-28 03:04:32'),
(28, 'ACER VivoBook N550', 2, 20, 502.25, 18, 'ACER  VivoBook N550', '4311f25f8c.jpg', 1, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:43:06', '2020-09-29 06:45:43'),
(29, 'Beauty Girl', 24, 32, 502.25, 16, 'Beauty Girl', 'f74ba719d3.jpg', 0, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 05:44:05', '2020-09-28 05:32:51'),
(30, 'Glass', 16, 28, 50.00, 17, 'product_auto_load', '7ca9b5d6d0.jpg', 0, 0, 'product_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_loadproduct_auto_load', '2020-09-23 05:47:14', '2020-09-28 05:32:51'),
(31, 'Keyboard RAZR', 16, 20, 100.00, 5, 'keyboard', 'b682318fd4.jpg', 0, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-09-23 06:07:02', '2020-09-28 05:32:51'),
(33, 'Samsung Galaxy A30s', 26, 32, 205.65, 41, 'Samsung Galaxy A30s', 'e6f53d3395.png', 0, 1, 'Network 	Technology 	\r\nGSM / HSPA / LTE\r\nLaunch 	Announced 	2019, February 25\r\nStatus 	Available. Released 2019, March\r\nBody 	Dimensions 	158.5 x 74.7 x 7.7 mm (6.24 x 2.94 x 0.30 in)\r\nWeight 	165 g (5.82 oz)\r\nBuild 	Glass front (Gorilla Glass 3), plastic back, plastic frame\r\nSIM 	Single SIM (Nano-SIM) or Dual SIM (Nano-SIM, dual stand-by)\r\nDisplay 	Type 	Super AMOLED capacitive touchscreen, 16M colors\r\nSize 	6.4 inches, 100.5 cm2 (~84.9% screen-to-body ratio)\r\nResolution 	1080 x 2340 pixels, 19.5:9 ratio (~403 ppi density)\r\nProtection 	Corning Gorilla Glass 3\r\nPlatform 	OS 	Android 9.0 (Pie), upgradable to Android 10, One UI 2.0\r\nChipset 	Exynos 7904 (14 nm)\r\nCPU 	Octa-core (2x1.8 GHz Cortex-A73 &amp; 6x1.6 GHz Cortex-A53)\r\nGPU 	Mali-G71 MP2\r\nMemory 	Card slot 	microSDXC (dedicated slot)\r\nInternal 	32GB 3GB RAM, 64GB 4GB RAM\r\n 	eMMC 5.1\r\nMain Camera 	Dual 	16 MP, f/1.7, 27mm (wide), PDAF\r\n5 MP, f/2.2, 12mm, (ultrawide)\r\nFeatures 	LED flash, panorama, HDR\r\nVideo 	1080p@30fps\r\nSelfie camera 	Single 	16 MP, f/2.0, 26mm (wide), 1/3.06&quot;, 1.0µm\r\nVideo 	1080p@30fps\r\nSound 	Loudspeaker 	Yes\r\n3.5mm jack 	Yes', '2020-09-25 04:09:43', '2020-09-28 12:39:47'),
(34, 'KFC Salad', 22, 26, 20.00, 18, 'food kfc salad vegetable', '1083eb7490.jpg', 0, 1, 'A crispy fillet of 100% real veggies, topped with lettuce &amp; mayo, served in a soft sesame bun. It’s juicy, spicy, and crunchy! An exciting addition developed specially for our fans in Bangladesh.', '2020-09-28 15:47:11', '2020-09-29 05:45:19'),
(35, 'Smart Gadget Apple', 24, 27, 50.00, 20, 'Smart Gadget Apple  Iphone', '789e99d1b7.jpg', 0, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2020-09-28 15:50:28', '2020-09-28 15:50:54'),
(36, 'Bicyle R721', 16, 32, 100.00, 49, 'Bicyle R721 Bike', '320f7a450f.jpg', 0, 1, 'Bicyle R721Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2020-09-28 15:52:49', '2020-09-29 06:43:27'),
(37, 'Yamaha YZF R15 v3', 27, 33, 500.25, 98, 'Bike Yamaha vehicle', '396a1643a7.jpg', 0, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2020-09-28 15:55:41', '2020-09-29 06:43:27'),
(38, 'Car YZF R15 v3', 27, 33, 500.25, 97, 'Bike Yamaha vehicle car', '594a0ac174.jpg', 0, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2020-09-28 15:56:13', '2020-09-29 06:43:27'),
(39, 'Motherboard Core i11', 4, 27, 500.25, 95, 'motherboard', '6f822f8e6d.jpg', 0, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2020-09-28 15:57:01', '2020-09-29 06:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(2) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `sign_date` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `email`, `password`, `status`, `sign_date`, `last_login`) VALUES
(1, 'Anisur Rahman Shahin', 'shahin', 'shahin@gmail.com', '$2y$10$egAWJWtUcseOvyF3IjxSS.RxOVVCWvx5te.7ZOYga7clBtTTDCMgi', 0, '2020-09-20 18:23:02', '2020-09-20 18:23:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brandname` (`brandname`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `catname` (`catname`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmnt_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cus_uname` (`cus_uname`),
  ADD UNIQUE KEY `cus_email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`odr_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `productname` (`productname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cmnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `odr_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
