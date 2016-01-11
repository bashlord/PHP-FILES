<?php
$conn = new mysqli();


	
		//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$statement = mysqli_prepare($conn, "SELECT * FROM Status WHERE user = ?");
	mysqli_stmt_bind_param($statement, "s", $username);
	mysqli_stmt_execute($statement);

	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $user,$title, $detail, $location, $timeset, $timefor, $type, $response, $from);


	$user = array();
	$statusArray = array();
	while(mysqli_stmt_fetch($statement)){
		$user[username] = $username;
		$user[title] = $title;
		$user[detail] = $detail;
		$user[location] = $location;
		$user[timeset] = $timeset;
		$user[timefor] = $timefor;
		$user[type] = $type;
		$user[response] = $response;
		$user[from] = $from;
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
