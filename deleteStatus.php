<?php
$conn = new mysqli("localhost","johnjink_name","coolio15", "johnjink_db");
echo "HI";

	$username = $_POST['username'];
	$title = $_POST['title'];
	$detail = $_POST['detail'];
	$location = $_POST['location'];

//	$statement = mysqli_prepare("DELETE FROM ". $username . "Status WHERE username = ? AND title = ? AND detail = ? AND location = ?");
//	mysqli_stmt_bind_param($statment, "ssss", $username, $title, $detail, $location);
//	mysqli_stmt_execute($statement);

	$sql = "DELETE FROM Status WHERE user = '$username' AND title = '$title' AND details = '$detail' AND location = '$location'";

if ($conn->query($sql) === TRUE) {
    echo "New status deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
