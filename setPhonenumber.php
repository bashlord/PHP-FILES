<?php
$conn = new mysqli("localhost","johnjink_name","coolio15", "johnjink_db");

if ($conn->connect_errno) {
   die("Failed to connect to MySQL: (" . $conn->connect_error);
	}
echo "WELCOME TO THE WONDERFUL REGISTER.PHP PAGE~~!~!~!~!~!~!~";

//	$jsonString = file_get_contents('php://input');
//	$jsonArray = json_decode($jsonString, true);
//	 echo $jsonArray["username"];
// 	 echo $jsonArray["password"];
//	print("This should print");
 //   echo "on the command line";	
	
	//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$password = $_POST['password'];
	$param = $_POST['param'];
	
	//stores the values into the database with a sql query

	$sql = "UPDATE User SET phonenumber = '$param' WHERE username = '$username' AND password = '$password'";

if ($conn->query($sql) === TRUE) {
    echo "New email register created successfully";
}
else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//	$statement = mysqli_prepare($con, "INSERT INTO 'User' (username, password) VALUES ('jk','jk')");
//	mysqli_stmt_bind_param($statement, "ss", $username, $password);
//	mysqli_execute($statement);
//	mysqli_stmt_close($statement);

//	mysqli_close($con);
$conn->close();

?>
