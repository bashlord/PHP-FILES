<?php
$conn = new mysqli();


	
		//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$statement = mysqli_prepare($conn, "SELECT * FROM " . $username . "Friends WHERE status = 4");
	mysqli_stmt_bind_param($statement, "s", $username);
	mysqli_stmt_execute($statement);

	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $username1, $friendname, $phone, $email, $status, $time);


	$user = array();
	$statusArray = array();
	while(mysqli_stmt_fetch($statement)){
		$user[username] = $username1;
		$user[friendname] = $friendname;
		$user[phone] = $phone;
		$user[email] = $email;
		$user[status] = $status;
		$user[timestamp] = $time;
		array_push($statusArray, $user);
		//echo json_encode($user);
	}
echo json_encode($statusArray);

//	if($conn->query($sql) == TRUE){
	//	$user[username] = $username;
	//	$user[password] = $password;
//	}
//	echo json_encode($user);
	

	$conn->close();
?>
