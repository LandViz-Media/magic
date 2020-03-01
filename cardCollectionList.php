<?php
require("connect_local.php");

$database = 'landv_magic';


$setCodesArray = array("THB", "ELD", "M20", "WAR", "RNA", "GRN", "M19", "DOM", "XLN", "HOU", "AKH", "KTK");
$setCodessNamesArray = array("Theros Beyond Death", "Throne of Eldraine", "Core Set 2020", "War of the Spark", "Ravnica Allegiance", "Guilds of Ravnica", "Core Set 2019", "Dominaria", "Ixalan", "Hour of Devastation", "Amonkhet", "Khans of Tarkir");
$raritiesArray = array("common", "uncommon", "rare", "mythic");



$setCode = "THB";
$setCodessNamesArray = array("Theros Beyond Death");
$raritiesArray = array("common", "uncommon", "rare", "mythic");







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



	$displayText.= "<td valign='Top'><strong> $setCodessNamesArray[0] </strong><br>";

//	foreach ( $raritiesArray as $raritiesValue ) {


	$raritiesValue = "mythic";


		//$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number FROM $table2 RIGHT JOIN $table1 ON cards.scryfallid = s_cardInventory.id WHERE cards.setCode = '$setCode' AND cards.rarity = '$raritiesValue' ORDER BY s_cardInventory.qty ASC, cards.name ASC GROUP BY cards.name";


$sql = "SELECT s_cardInventory.qty, s_cardInventory.name, s_cardInventory.set_name, cards.name, cards.rarity, cards.setCode, cards.types, cards.number FROM $table2 RIGHT JOIN $table1 ON cards.name = s_cardInventory.name WHERE cards.setCode = '$setCode' GROUP BY cards.name";



$sql = "SELECT cards.name, cards.rarity, cards.setCode, cards.number FROM $table1 WHERE cards.setCode = '$setCode' AND cards.rarity =  '$raritiesValue' GROUP BY cards.name ";


$sql = "SELECT name FROM cards WHERE rarity = 'mythic' AND setCode = 'thb' GROUP BY name";


//GROUP BY cards.name




		$result = $conn->query($sql);
		$rowcount=mysqli_num_rows($result);


		$displayText.= "<br><strong>$raritiesValue: $rowcount</strong><br>";

		$output = "";


		while($row = $result->fetch_assoc()) {
			//if ($row["qty"] == ''){
			//	$qty = 0;
			//	$output.=  " " . $qty. " - ".$row["name"]." ".$row["number"]."<br>";

			$output.=  $row["name"]." ".$row["number"]."<br>";
			//}else {
				$qty = $row["qty"];
			//}

		}
$displayText.= "$output" ;

//	} // end raritiesArray for each
	$displayText.= "</td>" ;






//$manaCost = $row["manaCost"];


echo "<table style='width:100%'><tr>".$displayText."</tr></table>";

?>
