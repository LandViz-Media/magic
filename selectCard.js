$(document).ready(function() {
      console.clear();

      cardNameList = [];
      var cardSearchURL, jsonCardList, actionType;




      //manage visibility of tools




      //manage resets





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

          //reset card image

          $('#cardImage').attr("src", "images/magic_card_back.jpg");

          //reset the quantities to zero
          $("#cardQty").val(1);
          $("#qtyFree").val(0);
          $("#qtyScouts").val(0);

          $("#cardName").html("---");
          $("#info_rarity").html("-");
          $("#info_collector_number").html("-");
          $("#info_mana_cost").html("-");
          $("#info_cmc").html("-");
          $("#info_type_line").html("-");
          $("#info_games").html("-");
          $("#info_legalities").html("-");
          $("#info_oracle_text").html("-");

          $("#info_totalQty").html("-");
          $("#info_totalSets").html("-");

          //reset rusults footer
          $("#actionResult").html("")

        });


        $("#autoCrdNme").autocomplete({
          minLength: 3,
          source: function(request, response) {
            var results = $.ui.autocomplete.filter(cardNameList[3], request.term);
            response(results.slice(0, 14)); //limits to 12 names
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

      }); //end gety card name


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
            console.log("totalCards: " + totalCards);
            //create list of sets the card appears in
            for (i = 0; i < totalCards; i++) {
              released_at = cardPrintsData.data[i].released_at;
              set = cardPrintsData.data[i].set;
              set_name = cardPrintsData.data[i].set_name;

              //retrieves all the cards, limit to just those in english
              if (cardPrintsData.data[i].lang == "en") {
                console.log(i + " " + set + " " + set_name + " " + released_at);
                //add set options to select menu. If just one option then auto select it otherwise display the menu of options
                if (cardPrintsData.total_cards < 2) {
                  $('#selectCardSet').empty().append('<option value="' + i + '" selected>' + set + ': ' + set_name + ' ' + released_at + '</option>');
                  console.log("The selectCardSet has been emptied since there is just one set option. It was then refilled");

                  $('#selectCardSet').trigger('change');
                  //$("#submitBtn").show();  //show the button for submission since there is just one set
                 // actionSubmissionOptions();

                } else {
                  $('#selectCardSet').append('<option value="' + i + '">' + set + ': ' + set_name + ' ' + released_at + '</option>');
                } //end test for making option list for one or multiple cards
              } //end if english

            } //end for loop

          }); //end getJSON for cardPrintURL

        }); //end $.getJSON(cardSearchURL)

      } // end getCardSets


      $('#selectCardSet').change(function() {
        console.log("selectCardSet changed automatically");

        // ssi - this is the selected set index and allows reference back to the retrieced json

        ssi = parseInt($("#selectCardSet option:selected").val());
        console.log(ssi);

        //retrieve from inveentory stats on selected card
        getCollectionStats(jsonCardList.data[ssi].name);

        //console.log(jsonCardList.data[ssi]);
        image = jsonCardList.data[ssi].image_uris.small;
        console.log(image);

        $('#cardImage').attr("src", image);

        //jsonCardList.data[ssi].name;
        //jsonCardList.data[ssi].id;

        //Display Card Info and Collection Info rerieved from Scryfall
        $("#info_rarity").html(jsonCardList.data[ssi].rarity);
        $("#info_collector_number").html(jsonCardList.data[ssi].collector_number);
        $("#info_mana_cost").html(jsonCardList.data[ssi].mana_cost);
        $("#info_cmc").html(jsonCardList.data[ssi].cmc);
        $("#info_type_line").html(jsonCardList.data[ssi].type_line);
        $("#info_oracle_text").html(jsonCardList.data[ssi].oracle_text);
        $("#info_games").html(jsonCardList.data[ssi].games);
        console.log(jsonCardList.data[ssi].games);

        $("#info_collector_legalities").html(jsonCardList.data[ssi].legalities.standard);

        //Call actionFunction to determine which submission info to display
        actionSubmissionOptions();

      }); //end selectCardSet change function






      //determine which action is selected to allow for display of correct input features




		function actionSubmissionOptions() {

			actionType = $("input[name='actionType']:checked").val();
			console.log(actionType);

			if (actionType == "addInv") {
				$("#submitBtn").show(); //show the submit button
				$("#invOptions").show() //show the add to inventory options
				} else {
					alert("Select a different action as that one is not yet implemented")
				}
		}; //ENDS ACTIONSUBMISSSION FUNCTION





	  $("#submitBtn").click(function() {
          //console.log("submitted selectedSet_i: "+ssi + " " + jsonCardList.data[ssi].name);
          //console.log(jsonCardList.data[ssi].image_uris.small);
          //console.log(jsonCardList.data[ssi].id);
		  console.log("chris");


actionType = '';
            // Add to Inventory action option
            $.post('uploadInventory.php', {
              //actionType: actionType,
              name: jsonCardList.data[ssi].name,
              qty: $("#cardQty").val(),
              qtyFree: $("#qtyFree").val(),
              qtyScouts: $("#qtyScouts").val(),
              deckName: $("#deckName").val(),
              deckColor: $("#deckColor").val(),
              id: jsonCardList.data[ssi].id,
              set: jsonCardList.data[ssi].set,
              set_name: jsonCardList.data[ssi].set_name,
              image_small: jsonCardList.data[ssi].image_uris.small,
              image_normal: jsonCardList.data[ssi].image_uris.normal,
              image_large: jsonCardList.data[ssi].image_uris.large,
              collector_number: jsonCardList.data[ssi].collector_number,
              scryfall_api: jsonCardList.data[ssi].uri
            }).done(function(data) {
              //alert( "Data Loaded: " + data );
              $("#submitBtn").hide(); //since the submission has completed, hide the button
              $("#autoCrdNme").val("");

              if (data == "Inserted") {
                $("#actionResult").html("A new record was inserted!")
              } else if (data == "Updated") {
                $("#actionResult").html("The record was updated!")
              } else {
                alert(data+"<br>There was an error - check the DB and console.")
              }
              //call function to update the collection info
              getCollectionStats(jsonCardList.data[ssi].name);
			}); //end done function


		}); //end SUBMIT BUTTON FUNCTION




//upon success need to reset the form









        //establish action interface options


	// Get the Collection stats for info window  function

	function getCollectionStats(theCardName) {
		$.post('cardCollectionStat.php', {
			name: theCardName
			}).done(function(data) {
				cardCollectionInfo = data.split(";");
				//alert(cardCollectionInfo);
				//alert(cardCollectionInfo[0]+"-"+cardCollectionInfo[1]);
				//console.log("cci "+cardCollectionInfo[0]);
				$("#info_totalQty").html(cardCollectionInfo[0]);
				$("#info_totalSets").html(cardCollectionInfo[1]);
			});  //end the done function
		}; //end getCollectionStats function




}); // end jQuery on ready

