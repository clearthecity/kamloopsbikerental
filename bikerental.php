<?php

if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: " . $url);
    exit;
}

if (empty($_POST['page'])) {
  $display_mode = 'nomodal';
  include 'start.php';
  exit;
}

session_start();
require 'model.php';

/*
 Commands from start page: login or create new acct
*/
if ($_POST['page'] == 'start') {
  $command = $_POST['command'];
  $errmsg = "";
  $reset_result = "";
  $email = $_POST['email'];
  if (isset($_POST['password']))
    $password = $_POST['password'];
  switch($command) {
    case 'LogIn':
      if (user_exists($email)) {
        if (is_valid_password($email, $password)) {
          $_SESSION['email'] = $email;
          $_SESSION['fname'] = get_user_first_name($email);
          if (isset($_POST['RememberMe']) && $_POST['RememberMe'] == 'Yes') {
            $enc = base64_encode($email);
            setcookie("kbr_em", $enc, time() + 60*60*24*30, "/");
          }
          if (isset($_COOKIE['kbr_em']) && isset($_POST['RememberMe']) && $_POST['RememberMe'] != 'Yes') {
            setcookie("kbr_em", "", time() - 60);
          }
          update_user_fines($email);
          include 'main.php';
        } else {
          $display_mode = "login";
          $errmsg = "The password is incorrect";
          include "start.php";
          echo "<script> $('#login-error-msg').text('$errmsg'); </script>";
        }
      }
      else {
        $errmsg = 'That email address is not in our system. Would you like to ';
        $errmsg .= '<a href="#login" onclick="showSignupForm()">create an account</a>?';
        $display_mode = "login";
        include "start.php";
        echo "<script> $('#login-error-msg').html('$errmsg'); </script>";
      }
      exit;

    case 'CreateNewAccount':
      if (!user_exists($email)) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        if (create_new_account($email, $password, $fname, $lname)) {
          $_SESSION['email'] = $email;
          $_SESSION['fname'] = $fname;
          include 'main.php';
        }
        else {
          $errmsg = "Error: " . mysqli_error($conn);
          $display_mode = "createnew";
          include "start.php";
          echo "<script> $('#createnew-error-msg').text(\"$errmsg\"); </script>";
        }
      }
      else {
        $errmsg = "Your email address is already in our system. Did you <a href='#' onclick='showForgotForm()'>forget your password</a>?";
        $display_mode = "createnew";
        include "start.php";
        echo "<script> $('#createnew-error-msg').html(\"$errmsg\"); </script>";
      }
      exit;

    case 'ResetPassword':
      if (user_exists($email)) {
        $new_pwd = set_temp_password($email);
        if ($new_pwd)
          $reset_result = "Wow, this is insecure! Your temporary password is {$new_pwd}. You can change it in your account settings.";
        else
          $reset_result = "An error occurred: " . $mysqli_error($conn);
      }
      else {
        $reset_result = "That email address is not in our system. Would you like to <a href='#' onclick='showSignupForm()'>create an account</a>?";
      }
      echo $reset_result;
      exit;

    default:
      exit();
  }
}

/*
 Commands from main page: search inventory, check out
*/
else if ($_POST['page'] == 'main') {
  $command = $_POST['command'];

  switch($command) {

    case 'BrowseByType': //incl reset
      echo searchByForm();
      exit;

    case 'SearchByKeyword':
      $input = $_POST['searchinput'];
      echo searchByKeyword($input);
      exit;

    case 'ShowItemDetails':
      echo searchByItemId($_POST['item']);
      exit;

    case 'CheckOutItem':
      if (!user_has_items_out($_SESSION['email'])) {
        if (get_user_fines($_SESSION['email']) > 0)
          $checkout_msg = "You have outstanding late fines.";
        else {
          if (checkOutItem($_SESSION['email'], $_POST['item']))
            $checkout_msg = "Success! The bike is waiting for you at our shop.";
          else
            $checkout_msg = mysqli_error($conn);
        }
      }
      else {
        $checkout_msg = "Sorry, you can only rent one item at a time.";
      }
      echo $checkout_msg;
      exit;

    default:
      exit;

  }
}

/*
  Header navigation
*/
else if ($_POST['page'] == 'any') {
  $command = $_POST['command'];
  switch($command) {
    case 'LogOut':
      session_unset();
      session_destroy();
      $errmsg = "";
      $display_mode = 'nomodal';
      include 'start.php';
      exit;

    case 'GoToAccount':
      $change_pwd_msg = "";
      include 'account.php';
      exit;

    case 'GoToLocation':
      include 'location.php';
      exit;

    case 'GoToPolicies':
      include 'policies.php';
      exit;

    default: //includes GoHome
      include 'main.php';
      exit;
  }
}

/*
 Commands from account page
*/
else if ($_POST['page'] == 'account') {
  $command = $_POST['command'];
  switch($command) {

    case 'PrepareToDelete':
      if (user_has_items_out($_SESSION['email'])) {
        $msg = "<span style='color:darkred'>You must return items before closing your account.</span>";
        $msg .= "<script> $('#cancel-delete').text('OK'); $('#delete-final-btn').css('display', 'none'); </script>";
      }
      else if (get_user_fines($_SESSION['email']) > 0) {
        $msg = "<span style='color:darkred'>You must pay your overdue fines before closing your account.</span>";
        $msg .= "<script> $('#cancel-delete').text('OK'); $('#delete-final-btn').hide(); </script>";
      }
      else {
        $msg = "Are you sure? This action is permanent.";
        $msg .= "<script> $('#cancel-delete').text('No, cancel'); $('#delete-final-btn').text('Yes, delete'); $('#delete-final-btn').show(); </script>";
      }
      echo $msg;
      exit;

    case 'DeleteAccount':
      if (delete_account($_SESSION['email'])) {
        if (isset($_COOKIE['kbr_em']))
          setcookie("kbr_em", "", time() - 60);
        session_unset();
        session_destroy();
        $errmsg = "";
        $display_mode = 'nomodal';
        include 'start.php';
      }
      else {
        $msg = mysqli_error($conn);
        include 'account.php';
        echo "<script> showProfileForm(); alert('$msg'); </script>";
      }
      exit;

    case 'ChangePassword':
      if (is_valid_password($_SESSION['email'], $_POST['currentpwd'])) {
        if (!empty($_POST['updatepwd']) && ($_POST['updatepwd'] === $_POST['updatepwd2'])) {
          if (change_password($_SESSION['email'], $_POST['updatepwd']))
            $change_pwd_msg = "Your password has been succesfully updated.";
          else
            $change_pwd_msg = "Error: " . mysqli_error($conn);
        }
        else $change_pwd_msg = 'The new passwords do not match.';
      }
      else $change_pwd_msg = 'Current password is incorrect.';
      echo $change_pwd_msg;
      echo "<script> showPasswordForm(); </script>";
      exit;

    case 'UpdateProfile':
      $uid = get_user_id($_SESSION['email']);
      $new_email = $_POST['newemail'];
      $fname = $_POST['newfirstname'];
      $lname = $_POST['newlastname'];
      if (change_user_profile($uid, $new_email, $fname, $lname)) {
        if ($new_email != $_SESSION['email'])
          $_SESSION['email'] = $new_email;
        if ($fname != $_SESSION['fname'])
          $_SESSION['fname'] = $fname;
      }
      exit;

    case 'ReturnItem':
      if (return_item($_SESSION['email'], $_POST['item'])) {
        echo "<script> $('#return-btn').hide(); </script>";
        echo "<tr><td>No items out</td></tr>";
      }
      else
        echo "<tr><td>" . mysqli_error($conn) . "</td></tr>";
      exit;

    case 'PayFines':
      $newfines = pay_fines($_SESSION['email'], $_POST['update-fines']);
      if ($newfines) echo $newfines;
      else echo mysqli_error($conn);
      exit;

    default:
      exit;
  }
}

?>
