<?php
$conn = new mysqli("localhost","johnjink_name","coolio15", "johnjink_db");


	
		//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$statement = mysqli_prepare($conn, "SELECT username, showname, max(time) FROM " . $username . "Rendezvous WHERE frienduser = ? GROUP BY username");
	mysqli_stmt_bind_param($statement, "s", $username);
	mysqli_stmt_execute($statement);

	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $username, $showname, $time);


	$user = array();
	$statusArray = array();
	while(mysqli_stmt_fetch($statement)){
		$user[username] = $username;
		$user[showname] = $showname;
		$user[timestamp] = $time;
		array_push($statusArray, $user);
		//echo json_encode($user);
	}
echo json_encode($statusArray);


	

	$conn->close();
?>
