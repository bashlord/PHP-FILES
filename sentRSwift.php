<?php
$conn = new mysqli("localhost","johnjink_name","coolio15", "johnjink_db");

if ($conn->connect_errno) {
   die("Failed to connect to MySQL: (" . $conn->connect_error);
	}
echo "WELCOME TO THE WONDERFUL REGISTER.PHP PAGE~~!~!~!~!~!~!~";



$handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);

$array = $decoded['json'];
$username = $array[0]['username'];
$usershow = $array[0]['showname'];

$statustitle = $array[1]['title'];
$statusdetail = $array[1]['detail'];
$statuslocation = $array[1]['location'];

$friendlist = $array[2]['array'];
$list = json_decode($array[2]['array'], true);

echo $username;
echo $usershow;
echo $statustitle;
echo $statusdetail;
echo $statuslocation;
echo $array[2]['array'];

foreach($friendlist as $val){

	$friendusername = $val['username'];
	$friendshowname = $val['showname'];

	$statement = "INSERT INTO " . $username . "Rendezvous (username, showname, frienduser, friendname, title, detail, location, time) VALUES ('$username', '$usershow', '$friendusername','$friendshowname', '$statustitle', '$statusdetail', '$statuslocation', TIMESTAMP(UTC_TIMESTAMP))";

		if($conn->query($statement) == TRUE){
				echo "sent rendez";
		}
		else echo "Error sending: " . $conn->error;


	$sql = "INSERT INTO " . $friendusername . "Rendezvous (username, showname, frienduser, friendname, title, detail, location, time) VALUES ('$username', '$usershow', '$friendusername','$friendshowname', '$statustitle', '$statusdetail', '$statuslocation',TIMESTAMP(UTC_TIMESTAMP))";

		if($conn->query($sql) == TRUE){
				echo "send R";
		}
		else echo "Error R: " . $conn->error;

}




	

echo "yay";

	$conn->close();
?>
