-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2023 at 10:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expenses`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `accounts` text NOT NULL,
  `group` text NOT NULL,
  `category` text NOT NULL,
  `subcategory` text NOT NULL,
  `date` text NOT NULL,
  `mode` text NOT NULL,
  `bank` text NOT NULL,
  `amount` int(20) NOT NULL,
  `details` text NOT NULL,
  `rate` int(10) NOT NULL,
  `quantity` int(50) NOT NULL,
  `payment_details` text NOT NULL,
  `payment_status` text NOT NULL,
  `receipt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `accounts`, `group`, `category`, `subcategory`, `date`, `mode`, `bank`, `amount`, `details`, `rate`, `quantity`, `payment_details`, `payment_status`, `receipt`) VALUES
(83, 54, 'Cash', 'School', 'Electricity', 'Home', '2023-07-22', 'Cash', 'HDFC', 5000, '                                    XYz    ', 1, 1, 'XYZ', 'done', 'uploads/users/54-expense-1690047180-Screenshot (332).png'),
(92, 58, 'Cash', 'Atharva Construction', 'none', 'none', '2023-05-12', 'Cash', 'SBI', 100000, '                                        Atharva Construction', 0, 0, 'Payment Done', 'done', 'uploads/users/58-expense-1690205027-Vedu.jpg'),
(93, 58, 'Cash', 'Atharva Construction', 'none', 'none', '2023-05-16', 'Cash', 'SBI', 100000, '                  Atharva Construction                      ', 0, 0, 'Payment Done', 'done', 'uploads/users/58-expense-1690205168-Vedu.jpg'),
(94, 58, 'Cash', 'Atharva Construction', 'none', 'none', '2023-06-23', 'Cash', 'SBI', 150000, '         Atharva Construction                               ', 0, 0, 'Payment Done', 'done', 'uploads/users/58-expense-1690205267-Vedu.jpg'),
(95, 58, 'Cash', 'Atharva Construction', 'none', 'none', '2023-07-24', 'Cash', 'SBI', 400000, '                                        Atharva Construction', 0, 0, 'Payment Done', 'done', 'uploads/users/58-expense-1690205354-Vedu.jpg'),
(135, 48, 'Cash', 'Bhusaval Farm', 'Cotton Seeds', 'Krushi Varsha Company  ', '2023-08-07', 'Online', 'SBI', 5000, 'Cotton Seed Purchased', 120, 1000, 'Payment Handover To K.V.Company', 'done', 'uploads/users/48-expense-1691424677-WhatsApp Image 2023-08-07 at 9.15.39 PM.jpeg'),
(138, 48, 'Cash', 'Chinuthon', 'Education ', 'Engineering Fees', '2023-08-05', 'Cash', 'SBI', 5000, 'Chinmay Fees Paid ', 0, 0, 'Payment Done By Pravin Karodpati ', 'done', 'uploads/users/48-expense-1691430550-expense_image_not_available.jpg'),
(142, 48, 'Cash', 'Shopping', 'D-Mart', 'None', '2023-08-02', 'Online', 'SBI', 10000, ' Monthly Grocery And Protine                     ', 1, 0, 'Payment Done By Brother', 'done', 'uploads/users/48-expense-1691431319-no_receipt.jpeg'),
(143, 48, 'Cash', 'Softanic Solutions', 'None', 'None', '2023-07-07', 'Check', 'SBI', 5000, 'Payment Done By Check                                        ', 7, 103, 'Softanic Electricity Bill', 'done', 'uploads/users/48-expense-1691484252-payment_done_in_check.jpeg'),
(144, 48, 'Cash', 'Atharva Construction', 'None', 'None', '2023-08-04', 'Check', 'HDFC', 10000, 'Workers Weekly Payment                             ', 0, 0, 'Payment Given To S.J.Patel', 'done', 'uploads/users/48-expense-1691569351-check_payment.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
