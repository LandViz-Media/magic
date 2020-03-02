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
}else{
	//echo "all connected";
}

$table = 's_cardInventory';


$sql = "SELECT SUM(qty) AS sumCards, COUNT(invID) AS countRecords FROM $table";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
        $sumCards = $row['sumCards'];
        $countRecords = $row['countRecords'];
    }


$sql = "SELECT COUNT(DISTINCT(name)) AS distinctCardNames FROM $table";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
        $distinctCardNames = $row['distinctCardNames'];
    }


$sql = "SELECT COUNT(DISTINCT(set_short)) AS distinctSets FROM $table";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
        $distinctSets = $row['distinctSets'];
    }


//Get the percent of top three
$sql = "select SUM(qty) as sumSetQty, set_short FROM $table GROUP BY set_short ORDER By SUM(qty) DESC LIMIT 3";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
        $sumSetQty = $row['sumSetQty'];
        $set_short = $row['set_short'];

        $setCountOutput .= $set_short.": ".$sumSetQty.", <br>";
        $y = $y + $sumSetQty;
    }

$percentInSets = $y/$sumCards *100;
$percentInSets = number_format($percentInSets, 2);


//generate list of sets
$sql = "select SUM(qty) as sumSetQty, set_short FROM $table GROUP BY set_short ORDER By SUM(qty) DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
        $sumSetQty = $row['sumSetQty'];
        $set_short = $row['set_short'];

        $setCountOutput .= $set_short.": ".$sumSetQty.", <br>";
    }




//$setCountOutput = substr($setCountOutput, 0, -2);




echo "The $server database contains $sumCards cards, $countRecords unique card IDs and $distinctCardNames card names across $distinctSets  sets. The largest three sets based on total cards is $percentInSets% of the inventory.<br>$setCountOutput";


?>