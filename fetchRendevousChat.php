<?php
$conn = new mysqli();


	
		//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$friendname = $_POST['friend'];
	$statement = mysqli_prepare($conn, "SELECT * FROM " . $username . "Rendezvous WHERE frienduser = '$friendname' OR username = '$friendname' ORDER BY time DESC");
	mysqli_stmt_bind_param($statement, "ss", $friendname, $friendname);
	mysqli_stmt_execute($statement);

	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $username1, $showname, $frienduser, $friendname, $title, $detail, $location, $time);


	$user = array();
	$statusArray = array();
	while(mysqli_stmt_fetch($statement)){
		$user[username] = $username1;
		$user[title] = $title;
		$user[detail] = $detail;
		$user[location] = $location;
		$user[timestamp] = $time;
		array_push($statusArray, $user);
		//echo json_encode($user);
	}
echo json_encode($statusArray);


	

	$conn->close();
?>
