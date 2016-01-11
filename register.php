<?php
$conn = new mysqli();

if ($conn->connect_errno) {
   die("Failed to connect to MySQL: (" . $conn->connect_error);
	}
	
	//gets the username and password that has been send to this php file
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//stores the values into the database with a sql query

	$sql = mysqli_prepare($conn, "INSERT INTO User (username, password, showname, email, phonenumber) VALUES ( ?, ?, null, null, null)");
	mysqli_stmt_bind_param($sql, "ss", $username, $password);
	mysqli_stmt_execute($sql);

	if ($sql->error) {error_log("Error: " . $sql->error); }

	$success = mysqli_stmt_affected_rows($sql);
	mysqli_stmt_close($sql);


if ($success > 0) {
	echo '{"success":1}';
	$statement = "CREATE TABLE " . $username . "Status (username VARCHAR(16) NOT NULL, title VARCHAR(30) DEFAULT NULL, detail VARCHAR(255) NOT NULL, location VARCHAR(30))";
	if ($conn->query($statement) === TRUE) {
		$stmt = "CREATE TABLE " . $username . "Friends (username VARCHAR(16), friendname VARCHAR(16), phone VARCHAR(16), email VARCHAR(30), status INT(5), time TIMESTAMP DEFAULT NULL)";
		if($conn->query($stmt) == TRUE){
				$state =  "CREATE TABLE " . $username . "Rendezvous (username VARCHAR(16) NOT NULL, showname VARCHAR(16) NOT NULL, frienduser VARCHAR(16) NOT NULL, friendname VARCHAR(16) NOT NULL,  title VARCHAR(30) DEFAULT NULL, detail VARCHAR(255) NOT NULL, location VARCHAR(30), time TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
				if($conn->query($state) == TRUE){
				}
				else{ 
				echo "Error creating RENDEZVOUS table: " . $conn->error;
				}	
		}
		else{ 
			echo "Error creating table: " . $conn->error;
		}		
		} 
	else {
    echo "Error creating table: " . $conn->error;
	}
} 
else{
   	echo '{"success":0,"error_message":"Apple sucks"}';
}




$conn->close();

?>

