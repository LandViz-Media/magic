<?php
	 //header("Access-Control-Allow-Origin: *");

require("connect_local.php");



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
	$actionType = $_POST['actionType'];
	$id = $_POST['id'];
	$name = addslashes($_POST['name']);
	$qty = $_POST['qty'];
	$qtyFree = $_POST['qtyFree'];
	$qtyScouts = $_POST['qtyScouts'];
	$set_short = $_POST['set'];
	$set_name = addslashes($_POST['set_name']);
	$image_small = $_POST['image_small'];
	$image_normal = $_POST['image_normal'];
	$image_large = $_POST['image_large'];
	$image_small = $_POST['image_small'];
	$collector_number = $_POST['collector_number'];
	$scryfall_api = $_POST['scryfall_api'];



	//$qtyFree  = $qty;
	//$qtyScouts = 0;
	//$qtyScouts = $qty;

/*
	$id = "abcdefg";
	$set_short= "theSet";
	$name = "theName";
	$qty = 27;
	$image_small = "small image URI";
*/

//$qty = 27;
//$qtyFree = 2;
//$qtyScouts = 99;



//$actionType

$sql = "SELECT * FROM $table WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

	$sql = "UPDATE s_cardInventory SET qty = qty + $qty, qtyFree = qtyFree + $qtyFree, qtyScouts = qtyScouts + $qtyScouts WHERE id = '$id'";
	$theResult = "Updated";

} else {

	$sql = "INSERT INTO $table (id, name, qty, qtyFree, qtyScouts, set_short, set_name, image_small, image_normal, image_large, collector_number, scryfall_api ) VALUES ('$id', '$name', '$qty', '$qtyFree', '$qtyScouts', '$set_short', '$set_name', '$image_small', '$image_normal', '$image_large', '$collector_number', '$scryfall_api' )";
		$theResult = "Inserted";
}

	if ($conn->query($sql) === TRUE) {
	    echo $theResult;
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();


//}else{
//	print "There is no data to work with dude!";
//}

	?>