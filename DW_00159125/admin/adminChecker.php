<?php 
	if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 0){
		header('location:'.BASE_URL);
	}
?>