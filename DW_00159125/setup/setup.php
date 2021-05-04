<?php
include_once('../dbCon.php'); 
$conn = connect(TRUE);

$sql = 'DROP DATABASE IF EXISTS dw_00159125';
if($conn->query($sql)){
	echo 'Database has been droped successfully<br>';
}

$sql = 'create database dw_00159125';
if($conn->query($sql)){
	echo 'Database dw_00159125 created successfully<br>';
}

$sql = 'USE dw_00159125';
if($conn->query($sql)){
	echo 'Database changed to dw_00159125<br>';
}

$sql = "CREATE TABLE `users` (
  `id` int(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `date` varchar(12) NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(300) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `Role` int(5) NOT NULL DEFAULT '1' COMMENT '0-Admin, 1-User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if($conn->query($sql)){
	echo 'Table users created successfully<br>';
}



$sql = "INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `date`, `gender`, `address`, `postcode`, `pass`, `Role`) VALUES
(1, 'Kabir', '1000313@daffodil.ac', '01747060854', '12-16-1996', 'Male', '47/A Panthapath, Dhaka', '7900', '202cb962ac59075b964b07152d234b70', 0),
(2, 'Konok', 'konok@gmail.com', '01747060854', '12/03/2017', 'Male', '47/A Panthapath, Dhaka', '1200', '202cb962ac59075b964b07152d234b70', 1),
(3, 'Mosharof', 'mosharof@gmail.com', '01971992800', '9/10/1997', 'Male', 'Panthapath', '1150', '202cb962ac59075b964b07152d234b70', 1),
(4, 'Arif', 'arif@gmail.com', '01971992800', '17/17/1996', 'Male', 'Square', '1200', '202cb962ac59075b964b07152d234b70', 1),
(5, 'Apu', 'apu@gmail.com', '01747060854', '16 Dec 1996', 'Male', '47/A Panthapath, Dhaka', '7900', '202cb962ac59075b964b07152d234b70', 1),
(6, 'Kabir', '313@daffodil.ac', '01747060854', '16 Dec 1996', 'Male', '47/A Panthapath, Dhaka', '1200', '202cb962ac59075b964b07152d234b70', 1)";

if($conn->query($sql)){
	echo 'User information inserted successfully<br>';
}


$sql = "CREATE TABLE `packages` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'no_image.jpg',
  `normal` int(1) NOT NULL DEFAULT '0',
  `special` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if($conn->query($sql)){
	echo 'Table Packages created successfully<br>';
}

$sql = "INSERT INTO `packages` (`id`, `name`, `price`, `location`, `image`, `normal`, `special`) VALUES
(1, 'ARACTIC Package', 4000, 'Longtown Carlisle Cumbria', '20171021012022_rsz_32.jpg', 1, 0),
(2, 'Forest Holiday', 7000, 'Sherwood Pines Forest Park', '20171021012447_rsz_33.jpg', 1, 0),
(3, 'Royal Deeside', 7500, 'Royal Deeside Woodland Lodges', '20171021012425_rsz_114.jpg', 1, 0),
(4, 'Footprints Lodge', 6000, 'White Cross Bay Holiday Park', '20171021012811_rsz_11.jpg', 1, 0),
(5, 'Bensfield Treehouse', 8000, 'Bensfield Farm Beech Hill', '20171021013508_s2.jpg', 0, 1),
(6, 'Into the Woods', 8500, 'Lower Westwood Brocks Copse Road', '20171021013646_s4.jpg', 0, 1),
(7, 'The Byfor Glamping ', 8500, 'The Nest Nr Honiton Devon', '20171021013855_s3.jpg', 0, 1),
(8, 'Hidden River Cabins', 9000, 'Hidden River Cottage Longtown Carlisle Cumbria', '20171021014040_s1.jpg', 0, 1),
(9, 'Wood Land Away', 3400, 'UK', '20171021025815_rsz_11.jpg', 0, 0)";

if($conn->query($sql)){
	echo 'Packages information inserted successfully<br>';
}


$sql = "CREATE TABLE `booking` (
  `booking_Id` int(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `book_by` varchar(50) NOT NULL,
  `package_name` varchar(50) NOT NULL,
  `cabin_type` varchar(100) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `adult` int(8) NOT NULL,
  `children` int(8) NOT NULL,
  `price` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if($conn->query($sql)){
	echo 'Table booking created successfully<br>';
}

$sql = "INSERT INTO `booking` (`booking_Id`, `book_by`, `package_name`, `cabin_type`, `start_date`, `end_date`, `adult`, `children`, `price`) VALUES
(1, 'Konok', 'ARACTIC Package', 'Contemporary Cabin', '10/23/2017', '10/27/2017', 2, 2, '4000'),
(2, 'Kabir', 'ARACTIC Package', 'Orignal Cabin', '11/06/2017', '11/10/2017', 3, 3, '4500'),
(3, 'Kabir', 'Forest Holiday', 'Luxury Cabin', '10/23/2017', '10/27/2017', 2, 2, '7000'),
(4, 'Kabir', 'Royal Deeside', 'Contemporary Cabin', '10/23/2017', '10/27/2017', 2, 2, '7500')";

if($conn->query($sql)){
	echo 'Booking information inserted successfully<br>';
}


$sql = "CREATE TABLE `forum_questions` (
  `q_id` int(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `question` varchar(200) NOT NULL,
  `customer_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if($conn->query($sql)){
	echo 'Table forum_questions created successfully<br>';
}

$sql = "INSERT INTO `forum_questions` (`q_id`, `question`, `customer_name`) VALUES
(1, 'I have a question about luxury cabin ', 'Kabir'),
(2, 'How is the food of the resturent.?', 'Kabir')";

if($conn->query($sql)){
	echo 'forum_questions information inserted successfully<br>';
}


$sql = "CREATE TABLE `forum_ans` (
  `ans_id` int(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `answer` varchar(500) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `q_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if($conn->query($sql)){
	echo 'Table forum_ans created successfully<br>';
}




$sql = "INSERT INTO `forum_ans` (`ans_id`, `answer`, `customer_name`, `q_id`) VALUES
(1, 'it has a pool', 'Kabir', 1),
(2, 'The food of the resturent is very tasty... you can try It.', 'Kabir', 2),
(3, 'I have tried it.....', 'Kabir', 2)";

if($conn->query($sql)){
	echo 'forum_ans information inserted successfully<br>';
	echo 'Admin login details<br>';
	echo 'Email: 1000313@daffodil.ac<br>';
	echo 'Password: 123<br>';
}

