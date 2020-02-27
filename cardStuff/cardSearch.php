<!DOCTYPE html>
<html>
<head>
<meta name="description" content="MTG Card Search">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>MTG Cards</title>


<link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

<label for="autocomplete">Card Name: </label>
<input id="autocomplete">

</body>


	<script>
console.clear();

cardNameList = [];

$.getJSON( "https://api.scryfall.com/catalog/card-names", function( data ) {
	//console.log(data.data[5])
	//console.log(data.data.length);

  $.each( data, function( key, val ) {
    cardNameList.push( val);
  });



	console.log(cardNameList[3]);


$( "#autocomplete" ).autocomplete({
  source: cardNameList[3]
});





 	/*
  $( "<ul/>", {
    "class": "my-new-list",
    html: items.join( "" )
  }).appendTo( "body" );

  */
});


</script>





</html>