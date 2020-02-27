<!DOCTYPE html>
<html>
<head>
<meta name="description" content="">
<meta charset="utf-8">
<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Card Inventory List</title>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<link href="mana-master/css/mana.min.css" rel="stylesheet" type="text/css" />


<style>
html, body {
    /*height:100%;*/
    margin:0;
    padding:0;
	height: 100vh;
}
</style>

<script>

</script>

</head>
<body>



<?php
require("connect_local.php");

$database = 'landv_magic';


// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
	print "Error";
	print $conn->connect_error;
    //die("Connection failed: " . $conn->connect_error);
}else{
	//print "success connecting!<br><br>";
}

$table1 = 'cards';
$table2 = 's_cardInventory';

$displayText = "";
$colors = "W";

$displayText.= "<td valign='Top'><strong> $colors</strong><br>";
		$output = "";


$sql = "SELECT s_cardInventory.qty, s_cardInventory.qtyScouts, s_cardInventory.name FROM $table1 JOIN $table2 ON cards.scryfallid = s_cardInventory.id WHERE cards.colors = '$colors' ORDER BY s_cardInventory.name ASC";



//$sql = "SELECT s_cardInventory.qty, s_cardInventory.name FROM $table2";


$result = $conn->query($sql);

$rowcount=mysqli_num_rows($result);
print $rowcount." rows.<br>";

while($row = $result->fetch_assoc()) {

	if ($row["qty"] > 1){
	//$output.=  " " . $row["qty"] . " - ".$row["name"]." ".$row["number"]."<br>";
	}

$output.=  " " . $row["qty"] . " / ".$row["qtyScouts"] . " - ".$row["name"]." ".$row["number"]."<br>";

}


$displayText.= "$output" ;
$displayText.= "</td>" ;


echo "<table style='width:100%'><tr>".$displayText."</tr></table>";

?>





</body>
</html>