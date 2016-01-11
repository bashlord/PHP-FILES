<?php
$conn = new mysqli();


	
		//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$password = $_POST['password'];

//	$sql =  "SELECT * FROM User WHERE username = '$username' AND password = '$password'";
	$statement = mysqli_prepare($conn, "SELECT * FROM User WHERE username = ? AND password = ?");
	mysqli_stmt_bind_param($statement, "ss", $username, $password);
	mysqli_stmt_execute($statement);

	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $userID,$username, $password,$showname, $email, $phonenumber);


	$user = array();
	$statusArray = array();

	while(mysqli_stmt_fetch($statement)){
		$user[username] = $username;
		$user[password] = $password;
		$user[showname] = $showname;
		$user[email] = $email;
		$user[phonenumber] = $phonenumber;
	}

	array_push($statusArray, $user);

	$state = mysqli_prepare($conn, "SELECT * FROM " . $username . "Friends WHERE status = 2");
	mysqli_stmt_bind_param($state);
	mysqli_stmt_execute($state);

	mysqli_stmt_store_result($state);
	mysqli_stmt_bind_result($state, $frienduser, $friendname, $phone, $email, $status, $time);

//	$friend = array();
	while(mysqli_stmt_fetch($state)){
		$friend = array();

		$friend[frienduser] = $frienduser;
		$friend[friendname] = $friendname;
		$friend[phone] = $phone;
		$friend[email] = $email;
		$friend[status] = $status;
		$friend[timestamp] = $time;
		array_push($statusArray, $friend);
	}


	echo json_encode($statusArray);
	

	$conn->close();
?>
