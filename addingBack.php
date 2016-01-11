<?php
$conn = new mysqli();
		//gets the username and password that has been send to this php file
	$username = $_POST['user'];
	$friend = $_POST['friend'];

	$sql = mysqli_prepare($conn, "UPDATE " . $username . "Friends SET status = 2 WHERE username = ?");
	mysqli_stmt_bind_param($sql, "s", $friend);
	mysqli_stmt_execute($sql);


	$sqll = mysqli_prepare($conn, "UPDATE " . $friend . "Friends SET status = 2 WHERE username = ?");
	mysqli_stmt_bind_param($sqll, "s", $username);
	mysqli_stmt_execute($sqll);




	$conn->close();
?>
