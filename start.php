<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">

  <link rel="icon" type="image/x-icon" size="16x16" href="./images/favicon.ico">
  <link rel="mask-icon" href="./images/safari-pinned-tab.svg" color="#5bbad5">
  <title>Kamloops Bike Rental</title>

  <style>

  @media screen and (min-width: 600px) {
    html {
      background: #222233 url("./images/rockpile.jpg") no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
  }

  @media screen and (max-width: 599px) {
    html {
      background-color: #222233;
    }
  }

  #half-blanket {
    position: fixed;
    height: 100%;
    width: 100%;
    background-color: rgba(0,0,0,0.5);
    display: none;
  }

  #click-to-login {
    position: fixed;
    display: block;
    top: 15%;
    left: 10%;
    font-size: 1.5em;
    font-family: "Special Elite", serif;
    color: white;
  }

  #click-to-login:hover {
    color: #FF8B8B;
  }

  #login-box {
    position: fixed;
    display: none;
    background-color: white;
    width: 500px;
    height: 450px;
    top: 15%;
    left: calc(50vw - 250px);
    padding: 1em;
  }

  form {
    padding-top: 1rem;
    padding-bottom: 1rem;
  }

  .form-error-msg {
    padding-left: 15px;
  }

  .light-underline {
    text-decoration: underline;
    text-decoration-style: dotted;
  }

  </style>

</head>

<body>

  <div id='half-blanket'> </div>
  <div id="click-to-login">Ready to go?</div>

  <div id="login-box">
    <ul class='nav nav-tabs'>
      <li class='nav-item active'>
        <a class='nav-link' data-toggle='tab' href='#login-form' id='login-tab'>Log In</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' data-toggle='tab' href='#signup-form' id='signup-tab'>Sign Up</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' data-toggle='tab' href='#forgot-pane' id='forgot-tab'>Forgot Password</a>
      </li>
    </ul>

    <div class='tab-content'>

      <div id='login-form' class='tab-pane active fade show'>
        <form class='form-horizontal' method="post" action='bikerental.php'>
          <input type='hidden' name='page' value='start' />
          <input type='hidden' name='command' value='LogIn' />
          <div class='form-group'>
            <label for='email' class='control-label col-sm-3'>Email </label>
            <div class='col-sm-9' style='float: right'>
              <input type='email' name='email' id='login-email' class='form-control' autocomplete='email' placeholder='you@domain.com' required />
            </div>
          </div>
          <div class='form-group'>
            <label for='password' class='control-label col-sm-3'>Password </label>
            <div class='col-sm-9' style='float: right'>
              <input type='password' name='password' class='form-control' autocomplete='off' required />
            </div>
          </div>
          <div class='form-group'>
            <label for='RememberMe' class='form-check-label col-sm-7'>Remember my email address </label>
            <div class='col-sm-5' style='float: right; padding-left:0'>
              <input type='checkbox' class='form-check-input' name='RememberMe' id='RememberMe' value='Yes' />
            </div>
          </div>
          <div class='form-group' style='padding-top:0.5rem'>
            <div class='col-sm-9'>
              <input type='submit' class='btn btn-primary' name='LogIn' value='Log In' />
            </div>
          </div>
            <?php
              if (isset($_COOKIE['kbr_em'])) {
                $dec = base64_decode($_COOKIE['kbr_em']);
                echo "<script> document.getElementById('login-email').value = '$dec'; ";
                echo "document.getElementById('RememberMe').checked = true; </script>";
              }
            ?>
        </form>
        <div class="form-error-msg" id="login-error-msg"></div>
      </div>

      <div id='signup-form' class='tab-pane fade'>
        <form method='post' action='bikerental.php' style='padding-bottom:0.5rem'>
          <input type='hidden' name='page' value='start' />
          <input type='hidden' name='command' value='CreateNewAccount' />
          <div class='form-group'>
            <label for='fname' class='control-label col-sm-3'>First name</label>
            <div class='col-sm-9' style='float:right'>
              <input type='text' name='fname' id='fname' class='form-control' required />
            </div>
          </div>
          <div class='form-group'>
            <label for='lname' class='control-label col-sm-3'>Last name</label>
            <div class='col-sm-9' style='float:right'>
              <input type='text' name='lname' id='lname' class='form-control' required />
            </div>
          </div>
          <div class='form-group'>
            <label for='new-email' class='control-label col-sm-3'>Email </label>
            <div class='col-sm-9' style='float:right'>
              <input type='email' name='email' id='new-email' class='form-control' required />
            </div>
          </div>
          <div class='form-group'>
            <label for='new-password' class='control-label col-sm-3'><span class='light-underline' data-toggle='tooltip' data-placement='left' title='At least 8 characters, with a mix of upper- and lower-case letters and at least 1 number'>Password </label>
            <div class='col-sm-9' style='float:right'>
              <input type='password' name='password' id='new-password' class='form-control' autocomplete='off' required />
            </div>
          </div>
          <div class='form-group'>
            <label for='password-reenter' class='control-label col-sm-3'>Re-enter password </label>
            <div class='col-sm-9' style='float:right'>
              <input type='password' name='password-reenter' id='password-reenter' class='form-control' autocomplete='off' required />
            </div>
          </div>
          <div class='form-group' style='padding-top:0.5rem; margin-bottom:0'>
            <div class='col-sm-9'>
              <button class='btn btn-primary' id='join-btn' />Join</button>
              <button class='btn btn-default' id='cancel-btn'>Cancel</button>
            </div>
          </div>
        </form>
        <div class="form-error-msg" id="createnew-error-msg">
        </div>
      </div>

      <div id='forgot-pane' class='tab-pane fade'>
        <form id='forgot-form'>
          <input type='hidden' name='page' value='start' />
          <input type='hidden' name='command' value='ResetPassword' />
          <div class='form-group'>
            <label for='email' class='control-label col-sm-3'>Email </label>
            <div class='col-sm-9' style='float:right'>
              <input type='email' name='email' id='email-forgot' class='form-control' required />
            </div>
          </div>
          <div class='form-group' style='padding-top:0.5rem'>
            <div class='col-sm-9'>
              <button type='button' class='btn btn-primary' id='reset-pwd-btn'>Reset</button>
            </div>
          </div>
        </form>
        <div class='form-error-msg' id="pw-reset-result">
          <!-- ?php if (isset($reset_result)) echo $reset_result; ? -->
        </div>
      </div>
    </div>
  </div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>

  window.addEventListener('load', function() {
    <?php
      if (!isset($display_mode))
        $display_mode = 'nomodal';
      switch($display_mode) {
        case "login":
          echo "document.getElementById('login-box').style.display = 'block';";
          echo "document.getElementById('half-blanket').style.display = 'block';";
          echo "document.getElementById('click-to-login').style.display = 'none';";
          break;
        case "createnew":
          echo "showSignupForm();";
          break;
        case "forgot":
          echo "showForgotForm();";
          break;
        default: //includes 'nomodal'
          echo "document.getElementById('login-box').style.display = 'none';";
          echo "document.getElementById('half-blanket').style.display = 'none';";
          echo "document.getElementById('click-to-login').style.display = 'block';";
          echo "document.getElementById('login-tab').classList.add('active');";
          $errmsg = "";
          $reset_result = "";
          break;
      }
    ?>

  });

  function showForgotForm() {
    document.getElementById('login-box').style.display = 'block';
    document.getElementById('half-blanket').style.display = 'block';
    document.getElementById('click-to-login').style.display = 'none';
    document.getElementById('forgot-pane').classList.add('active', 'show');
    document.getElementById('login-form').classList.remove('active', 'show');
    document.getElementById('signup-form').classList.remove('active', 'show');
    document.getElementById('signup-tab').classList.remove('active');
    document.getElementById('login-tab').classList.remove('active');
    document.getElementById('forgot-tab').classList.add('active');
  }

  function showSignupForm() {
    document.getElementById('login-box').style.display = 'block';
    document.getElementById('half-blanket').style.display = 'block';
    document.getElementById('click-to-login').style.display = 'none';
    document.getElementById('forgot-pane').classList.remove('active', 'show');
    document.getElementById('login-form').classList.remove('active', 'show');
    document.getElementById('signup-form').classList.add('active', 'show');
    document.getElementById('signup-tab').classList.add('active');
    document.getElementById('login-tab').classList.remove('active');
    document.getElementById('forgot-tab').classList.remove('active');
  }

  document.getElementById('click-to-login').addEventListener('click', function() {
    document.getElementById('half-blanket').style.display = 'block';
    document.getElementById('login-box').style.display = 'block';
    document.getElementById('click-to-login').style.display = 'none';
  });

  document.getElementById('cancel-btn').addEventListener('click', function() {
    document.getElementById('new-email').value = "";
    document.getElementById('new-password').value = "";
    document.getElementById('password-reenter').value = "";
    document.getElementById('login-box').style.display = 'none';
    document.getElementById('half-blanket').style.display = 'none';
    document.getElementById('click-to-login').style.display = 'block';
  });

  document.getElementById('half-blanket').addEventListener('click', function() {
    document.getElementById('login-box').style.display = 'none';
    document.getElementById('half-blanket').style.display = 'none';
    document.getElementById('click-to-login').style.display = 'block';
    document.getElementById('login-error-msg').innerHTML = "";
    document.getElementById('createnew-error-msg').innerHTML = "";
    document.getElementById('pw-reset-result').innerHTML = "";
  });

  const regex = /(?=.{8,})(?=.*[a-z]+)(?=.*[A-Z]+)(?=.*[0-9!@#$%^&*_\-+]+)/;
  // At least 8 characters, with a mix of lower- and upper-case letters and at least one number OR special char
  function isStrongPassword(pwd) {
    return (regex.test(pwd));
  }

  const controller = 'bikerental.php';

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $('#password-reenter').on('blur', function() {
      let pwd = $('#new-password').val();
      let pwd2 = $("#password-reenter").val();
      if (pwd != pwd2) {
        $("#password-reenter").css("border", "2px solid red");
      }
      else if (pwd == pwd2 && pwd != "") {
        $("#new-password").css("border", "1px solid green")
        $("#password-reenter").css("border", "1px solid green")
      }
    });

    $('#join-btn').click(function() {
      let pwd = $('#new-password').val();
      let pwd2 = $("#password-reenter").val();
      if (pwd != pwd2 || pwd == "") {
        $('#createnew-error-msg').html("<span style='color: red; font-size:0.9em'>The passwords do not match</span>");
        $("#new-password").val("");
        $("#password-reenter").val("");
        return false;
      }
      else if (!isStrongPassword(pwd)) {
        $('#createnew-error-msg').html("<span style='color: red; font-size:0.9em'>Passwords must be at least 8 characters long, with a mix of upper- and lower-case letters and at least 1 number or special character</span>");
        $("#new-password").val("");
        $("#password-reenter").val("");
        return false;
      }
      else {
        $("#signup-form form").submit();
      }
    });

    $("#reset-pwd-btn").on("click", function() {
      $.post(controller, $('#forgot-form').serialize(), function(data) {
        $('#pw-reset-result').html(data);
      });
    });
  });
</script>
