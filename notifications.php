<?php
$conn = new mysqli();


	
		//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$rendezCount = $_POST['rendez'];
	$friendcount = $_POST['added'];

	$sql = mysqli_prepare($conn, "SELECT * FROM " . $username . "Rendezvous WHERE username NOT LIKE ?");
	mysqli_stmt_bind_param($sql, "s", $username);
	mysqli_stmt_execute($sql);

	mysqli_stmt_store_result($sql);
	//whole count of rendezvous notifications that added you returned later to update prefs
	$rendezMax = $sql->num_rows;

	$sql1 = mysqli_prepare($conn, "SELECT * FROM " . $username . "Friends");
	mysqli_stmt_execute($sql1);

	mysqli_stmt_store_result($sql1);
	//whole count of friends that added you returned later to update prefs
	$friendMax = $sql1->num_rows;



//since i am a damn fool with counting and forgot sql tables start at 0 ~_~ elegiggle

	$temp1 = $rendezCount;
	$temp2 = $rendezMax;


//	$sql =  "SELECT * FROM User WHERE username = '$username' AND password = '$password'";


	$statement = mysqli_prepare($conn, "SELECT * FROM " . $username . "Rendezvous WHERE username NOT LIKE ? LIMIT ?,?");
	mysqli_stmt_bind_param($statement, "sii", $username, $temp1, $temp2);
	mysqli_stmt_execute($statement);

	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $username, $showname, $frienduser, $friendname, $title, $detail, $location, $time);


	//this holds the list of rendez notifications
	$statusArray = array();
	$user = array();

	while(mysqli_stmt_fetch($statement)){
		$user[username] = $username;
		$user[title] = $title;
		$user[detail] = $detail;
		$user[location] = $location;
		$user[timestamp] = $time;
		array_push($statusArray, $user);
		//echo json_encode($user);
	}


//i am a damn fool
	$temp3 = $friendcount;
	$temp4 = $friendMax;



//	$sql =  "SELECT * FROM User WHERE username = '$username' AND password = '$password'";
	$state= mysqli_prepare($conn, "SELECT * FROM " . $username . "Friends WHERE status = 3 LIMIT ?,?");
	mysqli_stmt_bind_param($state, "sii", $username, $temp3, $temp4);
	mysqli_stmt_execute($state);

	mysqli_stmt_store_result($state);
	mysqli_stmt_bind_result($state, $user, $friend1, $phone, $email, $status);


	//this holds the list of rendez notifications
	$friendArray = array();
	$friend = array();

	while(mysqli_stmt_fetch($state)){
		$friend[user] = $username;
		$friend[friend] = $friend1;
		$friend[phone] = $phone;
		$friend[email] = $email;
		$friend[status] = $status;
		array_push($friendArray, $friend);
	}


	//array that holds the array of count of rendezchat count, friends added count, rendeznotif array, friends added you array
	$notifications = array();

	$notifications[rendez] = $rendezMax;
	$notifications[friendcount] = $friendMax;
	$notifications[rendezArray] = $statusArray;
	$notifications[friendArray] = $friendArray;

	


	echo json_encode($notifications);
	

	$conn->close();
?>
