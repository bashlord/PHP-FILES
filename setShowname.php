<?php
$conn = new mysqli();

if ($conn->connect_errno) {
   die("Failed to connect to MySQL: (" . $conn->connect_error);
	}
echo "WELCOME TO THE WONDERFUL REGISTER.PHP PAGE~~!~!~!~!~!~!~";


	//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$password = $_POST['password'];
	$param = $_POST['param'];
	
	//stores the values into the database with a sql query

	$sql = "UPDATE User SET showname = '$param' WHERE username = '$username' AND password = '$password'";

if ($conn->query($sql) === TRUE) {
    echo "New email register created successfully";
}
else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>
