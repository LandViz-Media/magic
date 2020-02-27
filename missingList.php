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
<br><br>


<?php
require("connect_local.php");

$database = 'landv_magic';


//Card icons
//https://andrewgioia.github.io/Mana/
//https://andrewgioia.github.io/Keyrune/icons.html



$setCodesArray = array("THB", "ELD", "M20", "WAR", "RNA", "GRN", "M19", "DOM", "XLN", "HOU", "AKH", "KTK");
$setCodessNamesArray = array("Theros Beyond Death", "Throne of Eldraine", "Core Set 2020", "War of the Spark", "Ravnica Allegiance", "Guilds of Ravnica", "Core Set 2019", "Dominaria", "Ixalan", "Hour of Devastation", "Amonkhet", "Khans of Tarkir");
$raritiesArray = array("common", "uncommon", "rare", "mythic");
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

$displayText = "";
$i = 0;


foreach ( $setCodesArray as $setCodesValue ) {

	$displayText.= "<td valign='Top'><strong> $setCodessNamesArray[$i] ($setCodesValue)</strong><br>";

	foreach ( $raritiesArray as $raritiesValue ) {
		$displayText.= "<br><strong>$raritiesValue</strong><br>";
		$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number FROM $table2 RIGHT JOIN $table1 ON cards.scryfallid = s_cardInventory.id WHERE cards.setCode = '$setCodesValue' AND cards.rarity = '$raritiesValue' ORDER BY s_cardInventory.qty ASC, cards.name ASC";
		$result = $conn->query($sql);


		$rowcount=mysqli_num_rows($result);
		$output = "";


		while($row = $result->fetch_assoc()) {
			if ($row["qty"] == ''){
				$qty = 0;
				$output.=  " " . $qty. " - ".$row["name"]." ".$row["number"]."<br>";
			}else {
				$qty = $row["qty"];
			}

		}
$displayText.= "$output" ;

	} // end raritiesArray for each
	$displayText.= "</td>" ;
	$i++;
} //end setCodesArray for each





//$manaCost = $row["manaCost"];


echo "<table style='width:100%'><tr>".$displayText."</tr></table>";

?>





</body>
</html>