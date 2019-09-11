<!DOCTYPE html>
<!-- ACCOUNT PAGE -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" type="text/css">

  <link rel="icon" type="image/x-icon" size="16x16" href="./images/favicon.ico">
  <link rel="mask-icon" href="./images/safari-pinned-tab.svg" color="#5bbad5">
  <title>Account - Kamloops Bike Rental</title>

  <style>
  #personal-panel {
    background-color: white;
    color: #222233;
    border-radius: 5px;
    min-height: 300px;
  }
  #personal-panel .row:first-of-type {
    padding-top: 1rem;
  }
  </style>
</head>

<body>
  <header>
    <?php include 'header.php'; ?>
  </header>

  <main class="container-fluid">
  <div class='row'>

    <div class='col-sm-2'>
      <ul class='nav nav-pills flex-column'> <!-- flex-column for vertical pills -->
        <li class='nav-item'>
          <a class='nav-link active' data-toggle='pill' href="#itemsout-pane" id="itemsout-pill">Account</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' data-toggle='pill' href="#profile-pane" id='profile-pill'>Profile</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' data-toggle='pill' href="#password-pane" id='password-pill'>Change Password</a>
        </li>
      </ul>
    </div>

    <div class='col-sm-8' id='personal-panel'>
      <div class='tab-content'>

        <div class='tab-pane container active' id="itemsout-pane">
          <div class='row'>
            <strong>Checked Out</strong>
          </div>
          <div class='row'>
            <div class='col-xs-9'>
              <table class='table' id='list-items-out'></table>
            </div>
            <div class='col-xs-3'>
              <form id='return-form'>
                <input type='hidden' name='page' value='account' />
                <input type='hidden' name='command' value='ReturnItem' />
                <input type='hidden' name='item' id='return-item-id' />
                <button class='btn btn-warning' type='button' id='return-btn' style='margin-left:0.5rem'>Return (demo)</button>
              </form>
            </div>
          </div>

          <div class='row'>
            <strong>Fines</strong>
          </div>
          <div class='row'>
          <form class='form-inline' id='pay-form'>
            <input type='hidden' name='page' value='account' />
            <input type='hidden' name='command' value='PayFines' />
            <input type='text' class='form-control mr-2' name='update-fines' id='update-fines' style='width:100px' />
            <button type='button' class='btn btn-primary' id='pay-btn'>Pay</button>
            <script>
              <?php
                if (isset($_SESSION['email'])) {
                  $fines = get_user_fines($_SESSION['email']);
                  echo "document.getElementById('update-fines').value = $fines.toFixed(2);";
                }
                else echo "document.getElementById('update-fines').value = '9999.99';";
              ?>
              let fines = document.getElementById('update-fines').value;
              if (Number(fines) == 0) {
                document.getElementById('update-fines').disabled = true;
                document.getElementById('pay-btn').disabled = true;
              }
            </script>
          </form>
          </div>
	  <div class='form-error-msg' id='account-msg' style='padding-top:0.75rem'></div>
        </div>

        <div class='tab-pane container fade' id="profile-pane">
          <form id="change-profile-form">
            <input type='hidden' name='page' value='account' />
            <input type='hidden' name='command' value='UpdateProfile' />
            <div class='row'>
            <div class='col-sm-5'>
              <div class='form-group'>
                <label for='update-firstname'>First Name</label>
                <input type='text' class='form-control profile-input' name='newfirstname' id='update-firstname' />
              </div>
            </div>
            <div class='col-sm-5'>
              <div class='form-group'>
                <label for='update-lastname' class='control-label'>Last Name</label>
                <input type='text' class='form-control profile-input' name='newlastname' id='update-lastname' />
              </div>
            </div>
            </div>
            <div class='row'>
              <div class='form-group col-sm-5'>
                <label for='update-email' class='control-label'>Email</label>
                <input type='email' class='form-control profile-input' name='newemail' id='update-email' />
              </div>
              <div class='form-group col-sm-5'>
                <label for='update-date' class='control-label'>Membership Valid Until</label>
                <input type='date' class='form-control' name='update-date' id='update-date' disabled />
              </div>
            </div>
            <div class='row'>
              <div class='col'>
                <button class='btn btn-primary' type='button' id='update-btn'>Update</button>
                </form>
                <button class='btn btn-danger' type='button' id='pre-delete-btn'>Delete Account</button>
              </div>
            </div>
            <div class='form-error-msg' id='change-profile-msg' style='padding-top:0.75rem'> </div>
        </div>

          <div class='tab-pane container fade' id="password-pane">
            <form id="change-pwd-form">
              <input type='hidden' name='page' value='account' />
              <input type='hidden' name='command' value='ChangePassword' />
              <div class='form-group row'>
                  <label for='current-password' class='control-label col-md-3 col-sm-4'>Current password</label>
                  <div class='col-md-5 col-sm-8'>
                    <input type='password' class='form-control' name='currentpwd' id='current-password' />
                  </div>
              </div>
              <div class='form-group row'>
                <label for='update-password' class='control-label col-md-3 col-sm-4'>
		  <span class='light-underline' data-toggle='tooltip' data-placement='right' title='At least 8 characters, with a mix of upper- and lower-case letters and at least 1 number or special character'>New password</span></label>
                <div class='col-md-5 col-sm-8'>
                  <input type='password' class='form-control' name='updatepwd' id='update-password' />
                </div>
              </div>
              <div class='form-group row'>
                <label for='update-password-reenter' class='control-label col-md-3 col-sm-4'>Re-enter password</label>
                <div class='col-md-5 col-sm-8'>
                  <input type='password' class='form-control' name='updatepwd2' id='update-password-reenter' />
                </div>
              </div>
              <button type='button' class='btn btn-primary' id='change-pwd-btn'>Change</button>
            </form>
            <div class='form-error-msg' id='change-pwd-msg' style='padding-top:0.75rem'></div>
          </div>

        </div> <!-- end tab-content -->
      </div>

    </div> <!-- end big row -->

  </main>

  <div id='modal-delete' class='modal fade'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-body'>
          Are you sure? This action is permanent.
        </div>
        <div class='modal-footer'>
          <form id='modal-delete-form' method='post' action='bikerental.php'>
            <input type='hidden' name='page' value='account' />
            <input type='hidden' name='command' value='DeleteAccount' />
            <button class='btn btn-default' id='cancel-delete' data-dismiss='modal'>No, cancel</button>
            <button type='submit' class='btn btn-danger' id='delete-final-btn'>Yes, delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>

<?php
  if (isset($_SESSION['fname']))
    $fn = $_SESSION['fname'];
  else $fn = 'FirstName';
  if (isset($_SESSION['email'])) {
    $ln = get_user_last_name($_SESSION['email']);
    $em = $_SESSION['email'];
    $date = get_user_valid_date($_SESSION['email']);
  }
  else {
    $ln = 'LastName';
    $em = 'you@domain.com';
    $date = 1999-12-31;
  }
  $js = "document.getElementById('update-firstname').value = '{$fn}'; ";
  $js .= "document.getElementById('update-lastname').value = '{$ln}'; ";
  $js .= "document.getElementById('update-email').value = '{$em}'; ";
  $js .= "document.getElementById('update-date').value = '{$date}'; ";
  echo $js;
?>

function showAccountForm() {
  document.getElementById("itemsout-pane").classList.add('active','show');
  document.getElementById("password-pane").classList.remove('active','show');
  document.getElementById("profile-pane").classList.remove('active','show');
  document.getElementById("itemsout-pill").classList.add('active');
  document.getElementById("password-pill").classList.remove('active');
  document.getElementById("profile-pill").classList.remove('active');
}

function showProfileForm() {
  document.getElementById("itemsout-pane").classList.remove('active','show');
  document.getElementById("password-pane").classList.remove('active','show');
  document.getElementById("profile-pane").classList.add('active','show');
  document.getElementById("itemsout-pill").classList.remove('active');
  document.getElementById("password-pill").classList.remove('active');
  document.getElementById("profile-pill").classList.add('active');
}

function showPasswordForm() {
  document.getElementById("itemsout-pane").classList.remove('active','show');
  document.getElementById("password-pane").classList.add('active','show');
  document.getElementById("profile-pane").classList.remove('active','show');
  document.getElementById("itemsout-pill").classList.remove('active');
  document.getElementById("password-pill").classList.add('active');
  document.getElementById("profile-pill").classList.remove('active');
}

function writeCheckoutTable(data) {
  let tab = "";
  for (let i = 0; i < data.length; i++) {
    tab += '<tr>';
    tab += "<td id='itemid'>" + data[i]['ID'] + "</td>";
    tab += "<td>" + data[i]['Name'] + "</td>";
    tab += "<td> Due " + data[i]['DueDate'] + "</td>";
    tab += "</tr>";
  }
  document.getElementById('list-items-out').innerHTML = tab;
}

<?php
  $itemsout = get_user_items_out($_SESSION['email']);
  if (!$itemsout) {
    echo "document.getElementById('list-items-out').innerHTML = '<tr><td>No items out</td></tr>';";
    echo "document.getElementById('return-btn').style.display = 'none';";
  }
  else {
    $js = "let itemsout = $itemsout;";
    $js .= "writeCheckoutTable(itemsout);";
    echo $js;
    echo "document.getElementById('return-btn').style.display = 'inline-block';";
  }
?>

const regex = /(?=.{8,})(?=.*[a-z]+)(?=.*[A-Z]+)(?=.*[0-9!@#$%^&*_\-+]+)/;
function isStrongPassword(pwd) {
  return (regex.test(pwd));
}

const controller = 'bikerental.php';

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();

  $("header .dropdown-item[href='#account']").addClass("disabled");

  $("#update-password-reenter").on("blur", function() {
    let pwd2 = $(this).val();
    let pwd1 = $("#update-password").val();
    if (pwd1 != "" && pwd2 == "")
      $(this).css("border", "2px solid red");
    else if (pwd1 == "" && pwd2 != "")
      $('#update-password').css("border", "2px solid red");
    else if (pwd1 != pwd2) {
      $(this).css("border", "2px solid red");
    }
    else if (pwd1 != "" && pwd1 == pwd2) {
      $("#update-password").css("border", "1px solid green");
      $(this).css("border", "1px solid green");
    }
    else {
      $("#update-password").css("border", "1px solid #ced4da");
      $(this).css("border", "1px solid #ced4da");
    }
  });

  $('#change-pwd-btn').on('click', function() {
    let newpwd = $("#update-password").val();
    let pwd2 = $('#update-password-reenter').val();
    if (newpwd == pwd2 && isStrongPassword(newpwd)) {
      $.post(controller, $('#change-pwd-form').serialize(), function(data) {
        $('#change-pwd-msg').html(data);
      });
    }
    else if (newpwd != pwd2) {
      $("#update-password").val("");
      $("#update-password-reenter").val("");
      $('#update-password').css("border", "1px solid red");
      $('#update-password-reenter').css("border", "1px solid red");
      $('#change-pwd-msg').html("<span style='color: red; font-size:0.9em'>Passwords do not match</span>");
      return false;
    }
    else {
      $("#update-password").val("");
      $("#update-password-reenter").val("");
      $('#update-password').css("border", "1px solid red");
      $('#update-password-reenter').css("border", "1px solid red");
      $('#change-pwd-msg').html("<span style='color: red; font-size:0.9em'>Passwords must be at least 8 characters long, with a mix of upper- and lower-case letters and at least 1 number or special character</span>");
      return false;
    }
  });

  $(".profile-input").on("blur", function() {
    if ($(this).val() == "")
      $(this).css("border", "2px solid red");
    else $(this).css("border", "1px solid #ced4da");
  });

  $('#update-btn').on("click", function() {
    if ($("#update-email").val() == "" || $("#update-firstname").val() == "" || $("#update-lastname").val() == "")
      alert("Missing form data");
    else {
      $.post(controller, $('#change-profile-form').serialize(), function() {
        let msg = <?php if (mysqli_error($conn)) echo "'" . mysqli_error($conn) . "'"; else echo "'Profile updated.'"; ?>;
        $("#change-profile-msg").text(msg);
      });
    }
  });

  $('#return-btn').on('click', function() {
    let item = Number($("td#itemid").text());
    $('#return-item-id').val(item);
    $.post(controller, $('#return-form').serialize(), function(data) {
      $('#list-items-out').html(data);
    });
  });

  $("#update-fines").on("blur", function() {
    let payment = $(this).val();
    if (isNaN(payment))
      $(this).css("border", "2px solid red");
    else $(this).css("border", "1px solid #ced4da");
  });

  $('#pay-btn').on('click', function() {
    let payment = Number($("#update-fines").val());
    if (isNaN(payment) || payment <= 0) {
      $('#account-msg').html("<span style='color:red'>Invalid payment amount</span>");
    }
    else {
      $.post(controller, $('#pay-form').serialize(), function(data) {
        data = Number(data);
        if (isNaN(data))
          $('#account-msg').html(data); //mysqli_error
        else {
          $("#update-fines").val(data.toFixed(2));
          let msg = "$" + payment.toFixed(2);
          msg += " has been successfully applied to your account";
          $('#account-msg').html(msg);
        }
      });
    }

  });

  $('#pre-delete-btn').on('click', function() {
    let request = {page: "account", command: "PrepareToDelete"};
    $.post(controller, request, function(data) {
      $('#modal-delete .modal-body').html(data);
      $('#modal-delete').modal('show');
    });
  });

});
</script>
