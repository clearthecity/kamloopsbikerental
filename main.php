<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" type="text/css">

  <link rel="icon" type="image/x-icon" size="16x16" href="./images/favicon.ico">
  <link rel="mask-icon" href="./images/safari-pinned-tab.svg" color="#5bbad5">
  <title>Kamloops Bike Rental</title>

</head>

<body>

  <header>
    <?php include 'header.php'; ?>
  </header>

  <main class="container-fluid">

    <div class='row'>

      <div class="col-sm-3">
        <form id='browse-form'> <!-- for AJAX: NO method='post' action='bikerental.php'-->
          <input type='hidden' name='page' value='main' />
          <input type='hidden' id='browse-command' name='command' value='BrowseByType'/>
          <span id='bike-selection-toggle'><a href='#selection-boxes' data-toggle="collapse">Categories</a></span>
          <div class='collapse show' id='selection-boxes'>
            <ul>
              <!--
              <li>
                <label for='selectallbikes'><input type='checkbox' class='select-all' id='selectallbikes'> All Bikes</input></label>
              </li> -->
              <li>
                <label for='selectroad'><input type='checkbox' name='biketype[]' id='selectroad' value="'Road'"> Road</input></label>
              </li>
              <li>
                <label for='selectmtn'><input type='checkbox' name='biketype[]' id='selectmtn' value="'Mountain'"> Mountain</input></label>
              </li>
              <li>
                <label for='selectcommuter'><input type='checkbox' name='biketype[]' id='selectcommuter' value="'Commuter'"> Commuter</input></label>
              </li>
              <li>
                <label for='selectebike'><input type='checkbox' name='biketype[]' id='selectebike' value="'Ebike'"> E-bikes</input></label>
              </li>
              <li>
                <label for='selectodd'><input type='checkbox' name='biketype[]' id='selectodd' value="'Odd'"> <span data-toggle='tooltip' data-placement='right' title='Unicycles, trikes, etc.'>Wheels != 2</span></input></label>
              </li>
            </ul>
            <ul class='secondary-selection'>
              <li>
                <label for='unisex'><input type='checkbox' id='unisex' name='gender[]' value="'Unisex'"> Unisex</input></label>
              </li>
              <li>
                <label for='men'><input type='checkbox' id='men' name='gender[]' value="'Men'"> Men</input></label>
              </li>
              <li>
                <label for='women'><input type='checkbox' id='women' name='gender[]' value="'Women'"> Women</input></label>
              </li>
            </ul>
            <ul class='secondary-selection'>
              <li>Frame size (inches)</li>
              <li>
                <input type='number' name='minframe' value='14' min='0' max='22'></input> &nbsp;to&nbsp;
                <input type='number' name='maxframe' value='22' min='0'></input>
              </li>
            </ul>
            <ul class='secondary-selection'>
              <li>
                <label for='in_stock_only'><input type='checkbox' id='in_stock_only' name='in_stock_only' value='Yes'> Currently In Stock</input></label>
              </li>
            </ul>
            <ul>
              <div class='btn-group'>
                <button class='btn btn-primary mr-sm-1' type='button' id='browse'>Browse</button> <!-- type=button prevents GET submit -->
                <button class='btn btn-default' type='button' id='reset-browse'>Reset</button>
              </div>
            </ul>
          </div> <!-- end collapsible -->
        </form>
      </div>

      <div class='col-sm-8'>
        <div class='row' style='padding-top:0'>
        <form class="form-inline" id="search-form">
          <input type='hidden' name='page' value='main' />
          <input type='hidden' name='command' value='SearchByKeyword' />
          <input class="form-control mr-sm-2" type="text" id='searchinput' name='searchinput' placeholder="Find an item" style='width:250px'>
        </form>
        </div>

        <div class='row' style='padding-top:1rem' id='search-results'> </div>
      </div>
    </div>
  </main>

  <div id='modal-item-detail' class='modal fade'>
    <div class='modal-dialog modal-lg'>
      <div class='modal-content container'>
        <div class='modal-header'>
          <h4></h4>
        </div>
        <div class='modal-body row'>
          <div class='col-6' id='bike-photo-area'></div>
          <div class='col-5 offset-md-1' id='bike-table-area'></div>
        </div>
        <div class='modal-footer'>
          <form id='checkout-form'>
            <input type='hidden' name='page' value='main' />
            <input type='hidden' name='command' value='CheckOutItem' />
            <input type='hidden' name='item' /> <!-- value set in JS writeItemDetails -->
            <button class='btn btn-success' type='button' id='checkout-btn'>Check Out</button>
            <button class='btn btn-default' type='button' data-dismiss='modal'>Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id='modal-checkout-result' class='modal fade'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-body'></div>
        <div class='modal-footer'>
          <button class='btn btn-default' data-dismiss='modal'>OK</button>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>

const controller = 'bikerental.php';

function writeSearchResultTable(data) {
  let table = "<table class='table'>";
  if (data.length == 0)
    table += "<tr><td style='color:lightgrey'>Nothing to see here</td></tr>";
  else {
    for (let i = 0; i < data.length; i++) {
      table += "<tr class='bike-row' id= '" + data[i]['ID'] + "'>";
      table += "<td>" + data[i]['Name'] + "</td>";
      if (data[i]['Frame'] == null)
        table += "<td> n/a </td>";
      else
        table += "<td>" + data[i]['Frame'] + "&rdquo; </td>";
      if (data[i]['DueDate'] == null)
        table += "<td> In Stock </td>";
      else
        table += "<td> Due " + data[i]['DueDate'] + "</td>";
      table += "</tr>";
    }
  }
  table += "</table>";
  return table;
}

function writeItemDetails(id) {
  let request = {page: "main", command: "ShowItemDetails", item: id};
  $.post(controller, request, function(data) {
    let item = JSON.parse(data)[0];
    $("#modal-item-detail h4").text(item['Name']);
    $("#checkout-form input[name='item']").val(id);
    if (item['Picture'] != null) {
      let pic = "<img src='";
      pic += item['Picture'];
      pic += "' alt='Bicycle' style='max-width:100%; max-height:100%'>";
      $("#modal-item-detail #bike-photo-area").html(pic);
    }
    else {
      let pic = "<img src='./images/generic1.png' alt='' style='max-width:100%; max-height:100%'>";
      $("#modal-item-detail #bike-photo-area").html(pic);
    }
    let table = "<table class='table' id='bike-detail'>";
    table += "<tr> <th> Type </th>";
    table += "<td>" + item['Category'] + "</td></tr>";
    table += "<tr><th> Gender </th>";
    table += "<td>" + item['Gender'] + "</td>";
    table += "<tr> <th> Frame </th>";
    table += "<td>" + item['Frame'] + "&rdquo; </td></tr>";
    if (item['DueDate'] == null) {
      table += "<tr><td colspan='2' style='color:green'>In Stock</td></tr>";
      $('#checkout-btn').prop('disabled', false);
    }
    else {
      table += "<tr><td colspan='2' style='color:darkred'>Due " + item['DueDate'] + "</td></tr>";
      $('#checkout-btn').prop('disabled', true);
    }
    table += "</table>";

    $("#bike-table-area").html(table);
    $("#modal-item-detail").modal();
  });
}

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();

  $("header .navbar-brand").removeAttr("onclick");
  $("header .nav-link[href='#main']").addClass('disabled');

  if ($(window).width() >= 768)
    $("#bike-selection-toggle").hide();
  else
    $("#selection-boxes").removeClass("show");

  /*
  $('.select-all').on('change', function() {
    if ($(this).attr('checked', true)) {
      $("input[name='biketype[]']").attr('checked', true);
    }
  }); */

  $('#browse').click(function() {
    // http://api.jquery.com/serialize/
    $.post(controller, $("#browse-form").serialize(), function(data) {
      data = JSON.parse(data);
      let table = writeSearchResultTable(data);
      $("#search-results").html(table);
      $(".bike-row").click(function() {
        writeItemDetails(Number($(this).attr('id')));
      });
    });
  });

  $('#reset-browse').click(function() {
    $('#browse-form').find(':checkbox').prop('checked', false);
    $("#browse-form input[type='number']").first().val(14);
    $("#browse-form input[type='number']").last().val(22);
    $.post(controller, $("#browse-form").serialize(), function(data) {
      data = JSON.parse(data);
      let table = writeSearchResultTable(data);
      $("#search-results").html(table);
      $(".bike-row").click(function() {
        writeItemDetails(Number($(this).attr('id')));
      });
    });
  });

  $('#searchinput').on('keyup', function() {
    $.post(controller, $('#search-form').serialize(), function(data) {
      data = JSON.parse(data);
      let table = writeSearchResultTable(data);
      $("#search-results").html(table);
      $(".bike-row").click(function() {
        writeItemDetails(Number($(this).attr('id')));
      });
    });
  });

  $('#checkout-btn').click(function() {
    $.post(controller, $('#checkout-form').serialize(), function(data) {
      $('#modal-checkout-result .modal-body').text(data);
      $('#modal-checkout-result').modal();
      $('#modal-item-detail').modal('hide');
    });
  });

});
</script>
