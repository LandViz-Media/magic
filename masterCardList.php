<!DOCTYPE html>
<html>
<head>
<meta name="description" content="">
<meta charset="utf-8">
<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Card Inventory List</title>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>


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
$(document).ready(function(){
	//console.log(clear);
	$("#submitBtn").click(function() {
		url = "setRarityList.php";
		url = "cardCollectionList.php";
	    $.post(url, {
	      rarity: $("#raritySelector").val(),
		  set: $("#setSelector").val(),
		}).done(function( data ) {
			$("#result1").html(data);
		});
	});
});


</script>

</head>
<body>
<br>
<select id='setSelector'>
  <option value='thb'>Theros BD</option>
  <option value='eld'>Eld</option>
</select>

<select id='raritySelector'>
  <option value=''></option>
  <option value='common'>Common</option>
  <option value='uncommon'>Uncommon</option>
    <option value='rare'>Rare</option>
      <option value='mythic'>Mythic</option>
</select>
<button type="button" id="submitBtn">Submit</button>
<br>
<hr>

<div id="result1">
---</div>