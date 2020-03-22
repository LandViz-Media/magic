<!DOCTYPE html>
<html>

  <head>
    <meta name="description" content="MTG Card Search Test">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Database Manager</title>

    <link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="manager.css" rel="stylesheet" type="text/css" />

    <script src="selectCard.js?version=1.24"></script>

  </head>

  <body>

    <div class="grid-container">
      <div class="header title">Card Database Manager v1.24</div>

      <div class="menuHeader">
        Menu Header
      </div>

      <!--Actions -->
      <div class="actions">

        <strong>Review Collection</strong><br>
        <input type="radio" id="lookupCollectionStats" name="actionType" value="lookupCollectionStats" checked> Lookup Collection Stats
        <br>
        <input type="radio" id="lookupCard" name="actionType" value="lookupCard" checked> Lookup card
        <br>
        <br>
         <strong>Modify Collection</strong><br>
        <input type="radio" id="addInv" name="actionType" value="addInv" checked> Add to inventory
        <br>
        <input type="radio" id="AddWantList" name="actionType" value="AddWantList"> Add to wanted list
        <br>
        <br>
        <strong>Deck Management</strong><br>
        <input type="radio" id="makeDeck" name="actionType" value="AddDeckInv"> Create a deck
        <br>
        <input type="radio" id="AddDeckInv" name="actionType" value="AddDeckInv"> Add to inventory and deck
        <br>
        <input type="radio" id="MoveInv2Deck" name="actionType" value="MoveInv2Deck"> Move from inventory to deck
        <br>
        <input type="radio" id="ReturnDeck2Inv" name="actionType" value="ReturnDeck2Inv"> Return from deck to inventory
        <br>

      </div>

      <!--MainTop- card selector-->
      <div class="mainTopContent">
        Card Name:
        <input id="autoCrdNme" spellcheck="false">
        <br>
        <br> Select Card Set:
        <select id="selectCardSet" width="50px">
          <option value=""></option>
        </select><br><br>

      </div>

      <!--Card Image Display-->
      <div class="leftContent">
        <span > <img id="cardImage" src="images/magic_card_back.jpg" width="146" height="204" alt="magic card image" /></span>
      </div>

      <div class="middleContent">
        <span id="cardName">---</span>
        <br> Rarity: <span id="info_rarity">-</span> &nbsp;&nbsp;&nbsp; #<span id="info_collector_number">-</span>

        <br> Mana Cost: <span id="info_mana_cost">-</span>
        <br> CMC: <span id="info_cmc">-</span>
        <br> Type: <span id="info_type_line">-</span>

        <br> Games: <span id="info_games">-</span>
        <br> Legalities: <span id="info_legalities">-</span>

        <br> <br> <span id="info_oracle_text">-</span>



      </div>
      <div class="rightContent">
        <strong>Collection Info</strong>
        <br> Card Total Qty: <span id="info_totalQty">-</span>

        <br>
        <br>Card Sets: <br>
        <span id="info_totalSets">-</span>
        <br>
      </div>









      <div class="mainBottomContent">

        <span class="deckOptions">
          Deck: <select id="">
            <option value="inventory">Inventory</option>
          </select>
        </span>



        <span id="invOptions">
          Qty: <input id="cardQty" name="cardQty" value=1 size=3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Qty Free: <input id="qtyFree" name="qtyFree" value=0 size=3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Scoutbox Qty: <input id="qtyScouts" name="qtyScouts" value=0 size=3><br><br>
          		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Deck Name: <input id="deckName" name="deckName" value="CJS Theros Prerelease" size=15>
          Deck Color: <input id="deckColor" name="deckColor" value="Unsleeved" size=10><br>
        </span>



        <br>
        <button type="button" id="submitBtn">Submit</button>

      </div>  <!--end the mainBottomContent Area -->

      <div class="footer">

        <span id="actionResult">---</span>

      </div>
    </div>

  </body>

</html>

