<?php
	 //header("Access-Control-Allow-Origin: *");

$server = $_SERVER['SERVER_NAME'];
if ($server == "localhost") {
	require("connect_local.php");

}else{
	require("../conn1.php");
}


$database = 'landv_magic';

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);


// Check connection
if ($conn->connect_error) {
	print "Error";
	print $conn->connect_error;
    //die("Connection failed: " . $conn->connect_error);
}

$table = 's_cardInventory';


//make sure there is data to add otherwise end.
//if (isset($_POST['id']) AND !empty($_POST['id'])) {
	$name = addslashes($_POST['name']);

	//$name = "Mountain";


	$sql = "SELECT qty, set_short FROM $table WHERE name = '$name' ORDER BY set_short, collector_number";
	//$sql = "SELECT * FROM $table ";
$result = $conn->query($sql);




$rowcount=mysqli_num_rows($result);
//print $rowcount;

$qtySum = 0;

while($row = $result->fetch_assoc()) {
$qty = $row['qty'];
$set_short = $row['set_short'];

$qtySum = $qtySum + $qty;

$returnResult .= $set_short.": ".$qty."<br>";

	}

//$returnResult = rtrim($returnResult, ",");

print $qtySum.";".$returnResult;



	$conn->close();




	?>