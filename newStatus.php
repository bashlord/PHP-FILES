<?php

$conn = new mysqli();

	$username = $_POST['username'];
	$title = $_POST['title'];
	$detail = $_POST['detail'];
	$location = $_POST['location'];
	$timefor = $_POST['timefor'];
	$type = $_POST['type'];

$newdate = date("y-mm-dd HH:MM:ss" ,strtotime($timefor));
	$sql = "INSERT INTO Status (user, title, details, location, timeset, timefor, type, response, fromuser) VALUES ('$username','$title', '$detail','$location', TIMESTAMP(UTC_TIMESTAMP), '$timefor', '$type', 1, '$username')";

if ($conn->query($sql) === TRUE) {
    echo "New status created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




	$conn->close();
?>
