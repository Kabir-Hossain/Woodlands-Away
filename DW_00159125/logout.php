<?php 
//logout
session_start();
unset($_SESSION['isLoggedIn']);
unset($_SESSION['user_role']);
header('location:LogIn.php');