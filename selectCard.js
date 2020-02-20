$(document).ready(function() {

  console.clear();

  cardNameList = [];
  var cardSearchURL, jsonCardList;

  //Create cardname list for card lookup
  $.getJSON("https://api.scryfall.com/catalog/card-names", function(data) {
    //console.log(data.data[12]);  //could make this into a random daily card
    //console.log(data.data.length);  //20453 cards in DB on 2/10/2020

    //Put each card into the array cardNameList
    $.each(data, function(key, val) {
      cardNameList.push(val);
    });


    $("#autoCrdNme").focusin(function() {
      //reset the other fields
      $('#selectCardSet').empty().append('<option selected="selected" value=""></option>');
      console.log("The selectCardSet has been emptied");

    });


    $("#autoCrdNme").autocomplete({
      minLength: 3,
      source: function(request, response) {
        var results = $.ui.autocomplete.filter(cardNameList[3], request.term);
        response(results.slice(0, 12)); //limits to 12 names
      },
      close: function(el) {
        //get the exact card name to use to search Scryfall DB
        $("#cardName").html(el.target.value + "<br>");
        cardSearchURL = "https://api.scryfall.com/cards/named?exact=" + el.target.value;
        console.log(cardSearchURL);

        getCardSets();

        $("#autoCrdNme").blur(); //unfocus the text search
      }
    }); //end aoutcomplete

  });


  //Get Card Sets
  function getCardSets() {
    //first get card print info
    $.getJSON(cardSearchURL, function(cardPrintURI) {
      cardPrintURL = cardPrintURI.prints_search_uri;
      console.log(cardPrintURL);

      //Next use URL to get info on the prints

      $.getJSON(cardPrintURL, function(cardPrintsData) {

        jsonCardList = cardPrintsData;
        //get length with either cardPrintsData.data.length or cardPrintsData.total_cards

        totalCards = cardPrintsData.total_cards;
        console.log("totalCards: "+totalCards);
        //create list of sets the card appears in
        for (i = 0; i < totalCards; i++) {
          released_at = cardPrintsData.data[i].released_at;
          set = cardPrintsData.data[i].set;
          set_name = cardPrintsData.data[i].set_name;

          //retrieves all the cards, limit to just those in english
          if (cardPrintsData.data[i].lang == "en") {
            console.log(i + " " + set + " " + set_name + " " + released_at);
            //add set options to select menu. If just one option then auto select it
            if (cardPrintsData.total_cards < 2) {
              $('#selectCardSet').empty().append('<option value="' + i + '" selected>' + set + ': ' + set_name + ' ' + released_at + '</option>');
              console.log("The selectCardSet has been emptied since there is just one set option. It waas then refilled");

              $('#selectCardSet').trigger('change');
               $("#submitBtn").show();  //show the button for submission since ther is just one set
            } else {
              $('#selectCardSet').append('<option value="' + i + '">' + set + ': ' + set_name + ' ' + released_at + '</option>');
            } //end test for making option list for one or multiple cards
          } //end if english

        } //end for loop

      }); //end getJSON

      //Jokulhaups
    }); //end $.getJSON(cardSearchURL

  } // end getCardSets


  $('#selectCardSet').change(function() {
    console.log("selectCardSet changed");

    $("#submitBtn").show();  //show the submit button

    selectedSet_i = parseInt($("#selectCardSet option:selected").val());
    console.log(selectedSet_i);

    //console.log(jsonCardList.data[selectedSet_i]);
    image = jsonCardList.data[selectedSet_i].image_uris.small;
    console.log(image);

    $('#cardImage').html('<img id="theImg" src="' + image + '" />');

    //jsonCardList.data[selectedSet_i].name;
    //jsonCardList.data[selectedSet_i].id;

    $("#info_rarity").html(jsonCardList.data[selectedSet_i].rarity);
    $("#info_collector_number").html(jsonCardList.data[selectedSet_i].collector_number);

  });




  $("#submitBtn").click(function() {
    //console.log("submitted selectedSet_i: "+selectedSet_i + " " + jsonCardList.data[selectedSet_i].name);
    //console.log(jsonCardList.data[selectedSet_i].image_uris.small);
    //console.log(jsonCardList.data[selectedSet_i].id);

    actionType = $("input[name='actionType']:checked").val();
    console.log(actionType);

    $.post('uploadInventory.php', {
      actionType: actionType,
      name: jsonCardList.data[selectedSet_i].name,
      qty: $("#cardQty").val(),
      qtyFree: $("#qtyFree").val(),
      qtyScouts: $("#qtyScouts").val(),
      id: jsonCardList.data[selectedSet_i].id,
      set: jsonCardList.data[selectedSet_i].set,
      set_name: jsonCardList.data[selectedSet_i].set_name,
      image_small: jsonCardList.data[selectedSet_i].image_uris.small,
      image_normal: jsonCardList.data[selectedSet_i].image_uris.normal,
      image_large: jsonCardList.data[selectedSet_i].image_uris.large,
      collector_number: jsonCardList.data[selectedSet_i].collector_number,
      scryfall_api: jsonCardList.data[selectedSet_i].uri

    }).done(function( data ) {
    	//alert( "Data Loaded: " + data );
		$("#submitBtn").hide();  //since the submission has completed, hide the button
		$("#autoCrdNme").val("");

		if (data == "Inserted") {
			$("#actionResult").html("A new record was inserted.")
		} else if (data == "Updated"){
			$("#actionResult").html("A new record was inserted.")
		}else{
				alert("There was an error - check the DB and console.")
			}
  });



    //upons success need to reset the form

  });


  //establish action interface options


// Get the Collection info to display in the info windo for the card



  var spinner = $("#spinners").spinner({
      max: 9,
      min: 0,
      numberFormat: "n",
      step: 1,

      //icons: { down: "custom-down-icon", up: "custom-up-icon" }
    }

  );




}); // end jQuery on ready

