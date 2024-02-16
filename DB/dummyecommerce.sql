-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 07:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dummyecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_products`
--

CREATE TABLE `add_products` (
  `ap_id` int(11) NOT NULL,
  `ap_name` varchar(50) DEFAULT NULL,
  `ap_price` int(11) DEFAULT NULL,
  `ap_avail_stock` int(11) DEFAULT NULL,
  `ap_max_qty` int(11) DEFAULT NULL,
  `ap_prdct_dtl` varchar(200) DEFAULT NULL,
  `ap_date` datetime DEFAULT NULL,
  `ap_img_gal` varchar(200) DEFAULT NULL,
  `ap_desc` varchar(200) DEFAULT NULL,
  `su_id` int(11) DEFAULT NULL,
  `cty_id` int(11) DEFAULT NULL,
  `ap_updated` datetime DEFAULT NULL,
  `ap_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_products`
--

INSERT INTO `add_products` (`ap_id`, `ap_name`, `ap_price`, `ap_avail_stock`, `ap_max_qty`, `ap_prdct_dtl`, `ap_date`, `ap_img_gal`, `ap_desc`, `su_id`, `cty_id`, `ap_updated`, `ap_deleted`) VALUES
(1, 'Hoodie', 1000, 45, 5, 'good cloth,hoodie,good material,xyz', '2023-12-30 03:06:45', 'juan-carlos-bayocot-1PfaLLy83fA-unsplash.jpg', 'Good Stuff, Very Paidar, Description', 1, 2, '2023-12-30 03:06:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `c_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `c_qty` int(11) DEFAULT NULL,
  `buyAll` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cty_id` int(11) NOT NULL,
  `cty_name` varchar(55) DEFAULT NULL,
  `cty_max_products` int(11) DEFAULT NULL,
  `cty_img` varchar(255) DEFAULT NULL,
  `cty_date` datetime DEFAULT NULL,
  `cty_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cty_id`, `cty_name`, `cty_max_products`, `cty_img`, `cty_date`, `cty_deleted`) VALUES
(1, 'Technology', 100, 'img3.jpg', '2023-12-30 03:05:05', 0),
(2, 'New Category', 100, 'img4.jpg', '2023-12-30 03:05:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_table_low`
--

CREATE TABLE `dashboard_table_low` (
  `SaleID` int(11) NOT NULL DEFAULT 0,
  `OR_ID` int(11) NOT NULL DEFAULT 0,
  `SU_NAME` varchar(40) DEFAULT NULL,
  `CUS_NAME` varchar(50) DEFAULT NULL,
  `QTY` int(11) DEFAULT NULL,
  `PAY` varchar(10) DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL,
  `PRD_NAME` varchar(50) DEFAULT NULL,
  `TOTAL` bigint(21) DEFAULT NULL,
  `S_DATE` datetime DEFAULT NULL,
  `ap_avail_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `f_id` int(11) NOT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `f_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `o_date` datetime DEFAULT NULL,
  `o_status` varchar(30) DEFAULT NULL,
  `o_reciver_name` varchar(50) DEFAULT NULL,
  `o_reciver_contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `ap_id`, `u_id`, `o_date`, `o_status`, `o_reciver_name`, `o_reciver_contact`) VALUES
(1, 1, 1, '2024-02-04 11:43:19', 'Warehouse', 'Hassnain Ahmed', '03103582990');

-- --------------------------------------------------------

--
-- Table structure for table `print`
--

CREATE TABLE `print` (
  `p_id` int(11) NOT NULL,
  `o_id` int(11) DEFAULT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `removed_items`
--

CREATE TABLE `removed_items` (
  `ri_id` int(11) NOT NULL,
  `ri_date` datetime DEFAULT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `cty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `r_id` int(11) NOT NULL,
  `r_date` datetime DEFAULT NULL,
  `r_comment` varchar(255) DEFAULT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `r_ratting` int(11) DEFAULT NULL,
  `r_show` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`r_id`, `r_date`, `r_comment`, `ap_id`, `u_id`, `r_ratting`, `r_show`) VALUES
(1, '2024-02-04 03:44:00', 'this is okay', 1, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `s_id` int(11) NOT NULL,
  `s_date` datetime DEFAULT NULL,
  `s_payment_method` varchar(10) DEFAULT NULL,
  `s_sold_qty` int(11) DEFAULT NULL,
  `o_id` int(11) DEFAULT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`s_id`, `s_date`, `s_payment_method`, `s_sold_qty`, `o_id`, `ap_id`, `u_id`) VALUES
(1, '2024-02-04 11:43:19', 'COD', 5, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `s_id` int(11) NOT NULL,
  `s_img` varchar(200) DEFAULT NULL,
  `s_title` varchar(50) DEFAULT NULL,
  `s_about` varchar(100) DEFAULT NULL,
  `s_status` varchar(20) DEFAULT NULL,
  `s_date` datetime DEFAULT NULL,
  `s_ori_img` varchar(255) DEFAULT NULL,
  `ap_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`s_id`, `s_img`, `s_title`, `s_about`, `s_status`, `s_date`, `s_ori_img`, `ap_id`) VALUES
(1, 'carousel1.jpg', 'Iphone 12 Pro', 'Good Stuff, Very Paidar, Description', 'Primary', '2023-12-30 03:03:35', '', 0),
(2, 'carousel3.jpg', 'New Slider Demo', 'Demo TEXT', 'Secondary', '2023-12-30 03:03:58', '', 0),
(3, 'img5.jpg', 'Apple Macbook', 'Apple Rizz', 'Secondary', '2023-12-30 03:04:28', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `su_id` int(11) NOT NULL,
  `su_name` varchar(40) DEFAULT NULL,
  `su_contact` varchar(20) DEFAULT NULL,
  `su_email` varchar(20) DEFAULT NULL,
  `su_companyname` varchar(30) DEFAULT NULL,
  `su_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`su_id`, `su_name`, `su_contact`, `su_email`, `su_companyname`, `su_date`) VALUES
(1, 'Supplier', '09876543', 'supplier@gmail.com', 'Company', '2023-12-30 03:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(50) DEFAULT NULL,
  `u_email` varchar(50) DEFAULT NULL,
  `u_phone` varchar(50) DEFAULT NULL,
  `u_username` varchar(50) DEFAULT NULL,
  `u_password` varchar(50) DEFAULT NULL,
  `u_profilepicture` varchar(255) DEFAULT NULL,
  `u_shippingaddr` varchar(40) DEFAULT NULL,
  `u_city` varchar(50) DEFAULT NULL,
  `u_postal` varchar(50) DEFAULT NULL,
  `u_province` varchar(50) DEFAULT NULL,
  `u_ban` tinyint(1) DEFAULT NULL,
  `u_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_email`, `u_phone`, `u_username`, `u_password`, `u_profilepicture`, `u_shippingaddr`, `u_city`, `u_postal`, `u_province`, `u_ban`, `u_date`) VALUES
(1, 'Hassnain Ahmed', 'ahmedhasnina625@gmail.com', '03103582990', 'hassnain.exe', 'Password123', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `w_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `ap_id` int(11) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_products`
--
ALTER TABLE `add_products`
  ADD PRIMARY KEY (`ap_id`),
  ADD KEY `cty_id` (`cty_id`),
  ADD KEY `fk_su_id` (`su_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `ap_id` (`ap_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cty_id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `ap_id` (`ap_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `fk_ap_id` (`ap_id`),
  ADD KEY `fk_u_id_orders` (`u_id`);

--
-- Indexes for table `print`
--
ALTER TABLE `print`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `par_ind` (`p_id`);

--
-- Indexes for table `removed_items`
--
ALTER TABLE `removed_items`
  ADD PRIMARY KEY (`ri_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `ap_id` (`ap_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `ap_id` (`ap_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `ap_id` (`ap_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`su_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `ap_id` (`ap_id`),
  ADD KEY `fk_u_id` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_products`
--
ALTER TABLE `add_products`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `print`
--
ALTER TABLE `print`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `removed_items`
--
ALTER TABLE `removed_items`
  MODIFY `ri_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `su_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_products`
--
ALTER TABLE `add_products`
  ADD CONSTRAINT `add_products_ibfk_1` FOREIGN KEY (`su_id`) REFERENCES `supplier` (`su_id`),
  ADD CONSTRAINT `add_products_ibfk_2` FOREIGN KEY (`cty_id`) REFERENCES `category` (`cty_id`),
  ADD CONSTRAINT `fk_su_id` FOREIGN KEY (`su_id`) REFERENCES `supplier` (`su_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ap_id`) REFERENCES `add_products` (`ap_id`);

--
-- Constraints for table `feature`
--
ALTER TABLE `feature`
  ADD CONSTRAINT `feature_ibfk_1` FOREIGN KEY (`ap_id`) REFERENCES `add_products` (`ap_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_ap_id` FOREIGN KEY (`ap_id`) REFERENCES `add_products` (`ap_id`),
  ADD CONSTRAINT `fk_u_id_orders` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`ap_id`) REFERENCES `sale` (`ap_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`o_id`) REFERENCES `orders` (`o_id`),
  ADD CONSTRAINT `sale_ibfk_4` FOREIGN KEY (`ap_id`) REFERENCES `orders` (`ap_id`),
  ADD CONSTRAINT `sale_ibfk_5` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_u_id` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`),
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`ap_id`) REFERENCES `add_products` (`ap_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
