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




//make sure there is data to add otherwise end.
//if (isset($_POST['id']) AND !empty($_POST['id'])) {
	$actionType = $_POST['actionType'];
	$id = $_POST['id'];
	$name = addslashes($_POST['name']);
	$qty = $_POST['qty'];
	$qtyFree = $_POST['qtyFree'];
	$qtyScouts = $_POST['qtyScouts'];
	$deckName = $_POST['deckName'];
	$deckColor = $_POST['deckColor'];
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



$qtyFoil = 0;
$qtyDeck = 0;




$table = 's_cardDeckInventory';

//if there is a deck then add it to the deck list
if ($deckName != "") {

	$qtyDeck = 1;

	$sql = "INSERT INTO $table (id, name, set_short, set_name, image_small, image_normal, image_large, collector_number, scryfall_api, deckName, deckColor) VALUES ('$id', '$name', '$set_short', '$set_name', '$image_small', '$image_normal', '$image_large', '$collector_number', '$scryfall_api', '$deckName', '$deckColor')";

	$result = $conn->query($sql);

}








$table = 's_cardInventory';



//$actionType

$sql = "SELECT * FROM $table WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

	$sql = "UPDATE s_cardInventory SET qty = qty + $qty, qtyFree = qtyFree + $qtyFree, qtyScouts = qtyScouts + $qtyScouts, qtyDeck = qtyDeck + $qtyDeck, qtyFoil = qtyFoil + $qtyFoil WHERE id = '$id'";
	$theResult = "Updated";

} else {

	$sql = "INSERT INTO $table (id, name, qty, qtyFree, qtyScouts, set_short, set_name, image_small, image_normal, image_large, collector_number, scryfall_api, qtyDeck, qtyFoil) VALUES ('$id', '$name', '$qty', '$qtyFree', '$qtyScouts', '$set_short', '$set_name', '$image_small', '$image_normal', '$image_large', '$collector_number', '$scryfall_api', '$qtyDeck', '$qtyFoil')";
		$theResult = "Inserted";
}

if ($conn->query($sql) === TRUE) {
    echo $theResult;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}







$conn->close();



	?>