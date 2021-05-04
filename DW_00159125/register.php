<?php 
	session_start();
	
	$okFlag = TRUE;
	$message = '';
	if(!isset($_REQUEST['name']) || $_REQUEST['name'] == ''){
		$message .= 'Please type your Name.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['email']) || $_REQUEST['email'] == ''){
		$message .= 'Please type your E-mail.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['mobilenumber']) || $_REQUEST['mobilenumber'] == ''){
		$message .= 'Please type your Mobile Number.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['dateofbirth']) || $_REQUEST['dateofbirth'] == ''){
		$message .= 'Please type your Date of Birth.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['gender']) || $_REQUEST['gender'] == ''){
		$message .= 'Please select Gender.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['address']) || $_REQUEST['address'] == ''){
		$message .= 'Please type your Address.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['postcode']) || $_REQUEST['postcode'] == ''){
		$message .= 'Please type your Postcode.\n';
		$okFlag = FALSE;
	}
	if(!isset($_REQUEST['password']) || $_REQUEST['password'] == ''){
		$message .= 'Please type your Password.\n';
		$okFlag = FALSE;
	}
	
	if(isset($_REQUEST['password']) && isset($_REQUEST['confirm-password'])){
		if($_REQUEST['password'] != $_REQUEST['confirm-password']){
			$message .= 'Password didn\'t match.\n';
			$okFlag = FALSE;
		}
	}
	
	if($okFlag){
		$name 		= $_REQUEST['name'];
		$email 		= $_REQUEST['email'];
		$mobile 		= $_REQUEST['mobilenumber'];
		$dateofbirth 		= $_REQUEST['dateofbirth'];
		$gender 		= $_REQUEST['gender'];
		$address 		= $_REQUEST['address'];
		$postcode 	= $_REQUEST['postcode'];
		$password 	= md5($_REQUEST['password']);
		
			
		
		include_once "dbCon.php";
		$conn = connect();
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = $conn->query($sql);
		
		
		
		
		if($result->num_rows <= 0){
			$sql = "INSERT INTO users(name,email,mobile,date,gender,address,postcode,pass) VALUES ('$name','$email','$mobile','$dateofbirth','$gender','$address','$postcode','$password')";
			
			if($conn->query($sql)){
				$_SESSION['msg'] = 'Successfully Registered';
				header('location:LogIn.php?');
			}else{
				$_SESSION['msg'] = 'Database Error';
				header('location:LogIn.php');
			}
		}else{
			$_SESSION['msg'] = 'email already exist.\n';
			header('location:LogIn.php');
		}
	}else{
		$_SESSION['msg'] = $message;
		header('location:LogIn.php?msg='.$message);
	}