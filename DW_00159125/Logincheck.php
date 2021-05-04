<?php 

//Login Checker
	session_start();
	$okFlag = TRUE;
	$message = '';
	
	if(!isset($_REQUEST['email']) || $_REQUEST['email'] == ''){
		$message .= 'Please type your email.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['password']) || $_REQUEST['password'] == ''){
		$message .= 'Please type your password.\n';
		$okFlag = FALSE;
	}
	
	if($okFlag){
		$email 		= $_REQUEST['email'];
		$password 	= md5($_REQUEST['password']);
		
		if(!isset($_SESSION['login_counter']))
			$_SESSION['login_counter'] = 0;
		
		$sql = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
		
		include_once 'dbCon.php';
		$conn = connect();
		
		$result = $conn->query($sql);
		
		if($result->num_rows > 0){
			$_SESSION['isLoggedIn'] = TRUE;

			
			foreach($result as $row){
				$_SESSION['username'] = $row['name'];
				$_SESSION['user_role'] = $row['Role'];
				$_SESSION['email'] = $row['email'];
				
			}
			header('location:packages.php');
		}else{
			$sql = "SELECT * FROM users WHERE email='$email'";
			$result = $conn->query($sql);
			
			//Checking if the email is in database
			
			if($result->num_rows <= 0){
				$message .='Please Register.\n';
			}else{
				$_SESSION['input_email'] = $email;
				$message .='Password didn\'t match.\n';
			}
			
			$_SESSION['msg'] = $message;			
			header('location:LogIn.php');
		}
	}else{
		$_SESSION['msg'] = $message;
		header('location:LogIn.php');
	}