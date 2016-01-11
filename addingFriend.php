<?php
$conn = new mysqli();


	
		//gets the username and password that has been send to this php file
	$username = $_POST['user'];
	$friend = $_POST['friend'];

	$sql = mysqli_prepare($conn, "UPDATE " . $username . "Friends SET status = 1 WHERE username = ?");
	mysqli_stmt_bind_param($sql, "s", $friend);
	mysqli_stmt_execute($sql);

	$contactcheck = mysqli_prepare($conn, "SELECT * FROM " . $friend . "Friends WHERE username = ?");
	mysqli_stmt_bind_param($contactcheck, "s", $username);
	mysqli_stmt_execute($contactcheck);
	mysqli_stmt_store_result($contactcheck);
	if($contactcheck->num_rows == 0){
		$sqll = mysqli_prepare($conn, "INSERT INTO " . $friend . "Friends SET status = 3 WHERE username = ?");
		mysqli_stmt_bind_param($sqll, "s", $username);
		mysqli_stmt_execute($sqll);
	}else{
		$sqll = mysqli_prepare($conn, "UPDATE " . $friend . "Friends SET status = 3 WHERE username = ?");
		mysqli_stmt_bind_param($sqll, "s", $username);
		mysqli_stmt_execute($sqll);

}
echo "???";

	$conn->close();
?>
