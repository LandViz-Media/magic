<!DOCTYPE html>
<html>

  <head>
    <meta name="description" content="MTG Card Search Test">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Database Manager2</title>

    <link href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="manager.css" rel="stylesheet" type="text/css" />

    <script src="selectCard.js?"></script>

  </head>

  <body>

    <div class="grid-container">
      <div class="header title">Card Database Manager</div>

      <div class="menuHeader">
        Menu Header
      </div>

      <!--Actions -->
      <div class="actions">

        Action:
        <br>
        <input type="radio" id="lookupCard" name="actionType" value="lookupCard" checked>Lookup Card
        <br>
        <input type="radio" id="addInv" name="actionType" value="addInv">Add to inventory
        <br>
        <input type="radio" id="AddWantList" name="actionType" value="AddWantList">Add to wanted list
        <br>
        <input type="radio" id="AddDeckInv" name="actionType" value="AddDeckInv">Add to inventory and deck
        <br>
        <input type="radio" id="MoveInv2Deck" name="actionType" value="MoveInv2Deck">Move from inventory to deck
        <br>
        <input type="radio" id="ReturnDeck2Inv" name="actionType" value="ReturnDeck2Inv">Return from deck to inventory
        <br>

      </div>

      <!--MainTop- card selector-->
      <div class="mainTopContent">
        Card Name:
        <input id="autoCrdNme">
        <br>
        <br> Select Card Set:
        <select id="selectCardSet" width="50px">
          <option value=""></option>
        </select>

      </div>

      <!--Card Image Display-->
      <div class="leftContent">
        <span id="cardImage"> <img src="https://img.scryfall.com/cards/small/front/4/5/457bc402-4c31-465c-95e1-694f686e257e.jpg?1557577122" width="146" height="204" alt="magic card image" /></span>
      </div>

      <div class="middleContent">
        <strong>Card Details</strong>
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
        <br> Qty: <span id="info_qty">0</span>
        <br> All Set Qty: <span id="info_allSetQty">allSetQty</span>
        <br>
      </div>

      <div class="mainBottomContent">

        <span class="deckOptions">
          Deck: <select id="">
            <option value="inventory">Inventory</option>
          </select>
        </span>

        <span class="invOptions">
          Qty: <input id="cardQty" name="cardQty" value=1 size=3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Qty Free: <input id="qtyFree" name="qtyFree" value=0 size=3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Scoutbox Qty: <input id="qtyScouts" name="qtyScouts" value=0 size=3><br>
        </span>

        <br>
        <button type="button" id="submitBtn">Submit</button>

      </div>

      <div class="footer">

        <span id="actionResult">---</span>

      </div>
    </div>

  </body>

</html>

