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







<i class="ms ms-u"></i>
<i class="ms ms-g ms-cost"></i>
<i class="ms ms-r ms-cost ms-shadow"></i>


<i class="ms ms-wu ms-cost"></i>
<i class="ms ms-2b ms-cost ms-shadow"></i>



<?php
require("connect_local.php");

$database = 'landv_magic';


//Card icons
//https://andrewgioia.github.io/Mana/
//https://andrewgioia.github.io/Keyrune/icons.html





$setCode = "THB";
$rarity = "uncommon";

$displayText = "";


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



$colorIdentity = "B";
$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number, cards.isPromo, cards.isStarter FROM $table2 RIGHT JOIN $table1 ON cards.scryfallid = s_cardInventory.id WHERE cards.setCode = '$setCode' AND cards.rarity = '$rarity' AND cards.colorIdentity = '$colorIdentity' ORDER BY  s_cardInventory.qty ASC, cards.name ASC";
$result = $conn->query($sql);


$rowcount=mysqli_num_rows($result);
$output = "<br><i class='ms ms-".strtolower($colorIdentity)." ms-cost ms-shadow ms-fw'></i> $rowcount cards<br>";

while($row = $result->fetch_assoc()) {
	if ($row["qty"] == ''){
		$qty = 0;
	}else {
		$qty = $row["qty"];
	}
	if ($row["isPromo"] == '1'){
		$isPromo = "P";
	}
	if ($row["isStarter"] == '1'){
		$isStarter = "S";
	}


        $output.=  "" . $qty. " -".$isPromo.$isStarter."- ".$row["name"]." ".$row["number"]." -- ".$row["types"]."<br>";
        $set_name = $row["set_name"];
}

$displayText.= "<h3>$setCode: $set_name - $rarity </h3> <table style='width:100%'><tr>";
$displayText.= "<td valign='Top'>$output</td>" ;



$colorIdentity = "W";
$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number, cards.isPromo, cards.isStarter FROM $table2 RIGHT JOIN $table1 ON cards.scryfallid = s_cardInventory.id WHERE cards.setCode = '$setCode' AND cards.rarity = '$rarity' AND cards.colorIdentity = '$colorIdentity' ORDER BY  s_cardInventory.qty ASC, cards.name ASC";

$result = $conn->query($sql);


$rowcount=mysqli_num_rows($result);
$output = "<br><i class='ms ms-".strtolower($colorIdentity)." ms-cost ms-shadow ms-fw'></i> $rowcount cards<br>";

while($row = $result->fetch_assoc()) {
	if ($row["qty"] == ''){
		$qty = 0;
	}else {
		$qty = $row["qty"];
	}
	if ($row["isPromo"] == '1'){
		$isPromo = "P";
	}
	if ($row["isStarter"] == '1'){
		$isStarter = "S";
	}


        $output.=  "" . $qty. " -".$isPromo.$isStarter."- ".$row["name"]." ".$row["number"]." -- ".$row["types"]."<br>";
        $set_name = $row["set_name"];
}
$displayText.= "<td valign='Top'>$output</td></tr>" ;




$colorIdentity = "R";
$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number, cards.isPromo, cards.isStarter FROM $table2 RIGHT JOIN $table1 ON cards.scryfallid = s_cardInventory.id WHERE cards.setCode = '$setCode' AND cards.rarity = '$rarity' AND cards.colorIdentity = '$colorIdentity' ORDER BY  s_cardInventory.qty ASC, cards.name ASC";

$result = $conn->query($sql);


$rowcount=mysqli_num_rows($result);
$output = "<br><i class='ms ms-".strtolower($colorIdentity)." ms-cost ms-shadow ms-fw'></i> $rowcount cards<br>";

while($row = $result->fetch_assoc()) {
	if ($row["qty"] == ''){
		$qty = 0;
	}else {
		$qty = $row["qty"];
	}
	if ($row["isPromo"] == '1'){
		$isPromo = "P";
	}
	if ($row["isStarter"] == '1'){
		$isStarter = "S";
	}


        $output.=  "" . $qty. " -".$isPromo.$isStarter."- ".$row["name"]." ".$row["number"]." -- ".$row["types"]."<br>";
        $set_name = $row["set_name"];
}$displayText.= "<tr><td valign='Top'>$output</td>" ;






$colorIdentity = "U";
$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number, cards.isPromo, cards.isStarter FROM $table2 RIGHT JOIN $table1 ON cards.scryfallid = s_cardInventory.id WHERE cards.setCode = '$setCode' AND cards.rarity = '$rarity' AND cards.colorIdentity = '$colorIdentity' ORDER BY  s_cardInventory.qty ASC, cards.name ASC";

$result = $conn->query($sql);


$rowcount=mysqli_num_rows($result);
$output = "<br><i class='ms ms-".strtolower($colorIdentity)." ms-cost ms-shadow ms-fw'></i> $rowcount cards<br>";






while($row = $result->fetch_assoc()) {
	if ($row["qty"] == ''){
		$qty = 0;
	}else {
		$qty = $row["qty"];
	}
	if ($row["isPromo"] == '1'){
		$isPromo = "P";
	}
	if ($row["isStarter"] == '1'){
		$isStarter = "S";
	}


        $output.=  "" . $qty. " -".$isPromo.$isStarter."- ".$row["name"]." ".$row["number"]." -- ".$row["types"]."<br>";
        $set_name = $row["set_name"];
}
$displayText.= "<td valign='Top'>$output</td></tr>" ;






$colorIdentity = "G";
$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number, cards.isPromo, cards.isStarter FROM $table2 RIGHT JOIN $table1 ON cards.scryfallid = s_cardInventory.id WHERE cards.setCode = '$setCode' AND cards.rarity = '$rarity' AND cards.colorIdentity = '$colorIdentity' ORDER BY  s_cardInventory.qty ASC, cards.name ASC";

$result = $conn->query($sql);


$rowcount=mysqli_num_rows($result);
$output = "<br><i class='ms ms-".strtolower($colorIdentity)." ms-cost ms-shadow ms-fw'></i> $rowcount cards<br>";

while($row = $result->fetch_assoc()) {
	if ($row["qty"] == ''){
		$qty = 0;
	}else {
		$qty = $row["qty"];
	}
	if ($row["isPromo"] == '1'){
		$isPromo = "P";
	}
	if ($row["isStarter"] == '1'){
		$isStarter = "S";
	}


        $output.=  "" . $qty. " -".$isPromo.$isStarter."- ".$row["name"]." ".$row["number"]." -- ".$row["types"]."<br>";
        $set_name = $row["set_name"];
}
$displayText.= "<tr><td valign='Top'>$output</td>" ;


//Multi colors
$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number, cards.isPromo, cards.isStarter, cards.manaCost FROM $table2 RIGHT JOIN $table1 ON cards.scryfallid = s_cardInventory.id WHERE cards.setCode = '$setCode' AND cards.rarity = '$rarity' AND cards.colorIdentity NOT IN ('B', 'W', 'R', 'U', 'G') ORDER BY  s_cardInventory.qty ASC, cards.name ASC";

$result = $conn->query($sql);


$rowcount=mysqli_num_rows($result);
$output = "<br>$rowcount Multicolor cards<br>";

while($row = $result->fetch_assoc()) {
	if ($row["qty"] == ''){
		$qty = 0;
	}else {
		$qty = $row["qty"];
	}
	if ($row["isPromo"] == '1'){
		$isPromo = "P";
	}
	if ($row["isStarter"] == '1'){
		$isStarter = "S";
	}


$manaCost = $row["manaCost"];


$output.=  "" . $qty. " -".$isPromo.$isStarter."- ".$row["name"]." ".$row["number"]." -- ".$manaCost." -- ".$row["types"]."<br>";
        $set_name = $row["set_name"];
}
$displayText.= "<td valign='Top'>$output</td>" ;



echo $displayText."</tr></table>";

?>





</body>
</html>