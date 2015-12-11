<?php
$conn = new mysqli("localhost","johnjink_name","coolio15", "johnjink_db");

if ($conn->connect_errno) {
   die("Failed to connect to MySQL: (" . $conn->connect_error);
	}
echo "WELCOME TO THE WONDERFUL REGISTER.PHP PAGE~~!~!~!~!~!~!~";

$data = $_POST['json'];

$array = json_decode($data, true);
$user = $array[0]['name'];

foreach($array as $val){
	$showname = $val['name'];
	$phone = $val['phonenumber'];
	$int = (int)$phone;

	$contactcheck = mysqli_prepare($conn, "SELECT * FROM " . $user . "Friends WHERE phone = ?");
	mysqli_stmt_bind_param($contactcheck, "i", $int);
	mysqli_stmt_execute($contactcheck);
	mysqli_stmt_store_result($contactcheck);
	if($contactcheck->num_rows == 0){

		echo $int;

		$void = null;
		$statement = mysqli_prepare($conn, "SELECT * FROM User WHERE phonenumber = ?");
		mysqli_stmt_bind_param($statement, "i", $int);
		mysqli_stmt_execute($statement);
		mysqli_stmt_store_result($statement);
		if($statement->num_rows > 0){
			mysqli_stmt_bind_result($statement, $pid,  $username, $password, $showname, $email, $phonenumber);
			while(mysqli_stmt_fetch($statement)){
					$sql = "INSERT INTO " . $user . "Friends (username, friendname, phone, email, status) VALUES ('$username' , '$showname', '$phonenumber', '$void', 4)";
					if($conn->query($sql) == TRUE){
						echo "Friends with an account created successfully";
					}
					else echo "Error creating table: " . $conn->error;
				}
		}
		else{
				$sql = "INSERT INTO " . $user . "Friends (username, friendname, phone, email, status) VALUES ('$void', '$showname', '$phone',  '$void', 0)";
					if($conn->query($sql) == TRUE){
						echo "Friends created successfully";
					}
					else echo "Error creating table: " . $conn->error;
		}
	}
	else{
		//do nothing
	}
	mysqli_stmt_close($statement);

}


$sql = "DELETE FROM ". $user . "Friends LIMIT 1";

if ($conn->query($sql) === TRUE) {
    echo "New status deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>
