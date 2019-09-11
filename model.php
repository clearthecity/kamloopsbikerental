<?php

/*
Removed for public repository:
$db_name
$db_user
$db_password
*/

$conn = mysqli_connect('localhost', $dbname, $dbpassword, $dbname);
if (!$conn) {
  die("Could not connect to $dbname");
}

date_default_timezone_set('America/Vancouver');

function user_exists($email) {
  global $conn;
  $sql = "SELECT * FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if (!$result) return false;
  return (mysqli_num_rows($result) > 0);
}

function is_valid_password($email, $password) {
  global $conn;
  $sql = "SELECT Password FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  $hash = mysqli_fetch_row($result)[0];
  if (password_verify($password, $hash))
    return true;
  return false;
}

function get_user_first_name($email) {
  global $conn;
  $sql = "SELECT FirstName FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_row($result);
    return "$row[0]";
  }
  else return "firstName";
}

function get_user_last_name($email) {
  global $conn;
  $sql = "SELECT LastName FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_row($result);
    return $row[0];
  }
  else return "lastName";
}

function get_user_id($email) {
  global $conn;
  $sql = "SELECT ID FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_row($result);
    return $row[0];
  }
  else return 666;
}

function get_user_valid_date($email) {
  global $conn;
  $sql = "SELECT ValidUntil FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_row($result);
    return $row[0];
  }
  else return 1999-12-31;
}

function get_user_fines($email) {
  global $conn;
  $sql = "SELECT Fines FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_row($result);
    return $row[0];
  }
  else return 9999.99;
}

function user_has_items_out($email) {
  global $conn;
  $sql = "SELECT RentedItem FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_row($result);
  return ($row[0] != NULL);
}

function get_user_items_out($email) {
  global $conn;
  $sql = "SELECT RentedItem FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  $item_id = mysqli_fetch_row($result)[0];
  if ($item_id == NULL) return false;
  $itemsout = array();
  $sql = "SELECT ID, Name, DueDate FROM Inventory WHERE ID = $item_id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $itemsout[] = $row;
  }
  return json_encode($itemsout);
}

function change_password($email, $new_pwd) {
  global $conn;
  $hash = password_hash($new_pwd, PASSWORD_DEFAULT);
  $sql = "UPDATE Members SET Password='$hash' WHERE Email='$email'";
  $result = mysqli_query($conn, $sql);
  if ($result) return true;
  return false;
}

function set_temp_password($email) {
  global $conn;
  $new_pwd = random_password();
  if (change_password($email, $new_pwd))
    return $new_pwd;
  return false;
}

function random_password($length = 8) {
  $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#%^&*_-+';
  $pwd = '';
  for ($i = 0; $i < $length; $i++)
    $pwd .= $alpha[mt_rand(0,strlen($alpha))];
  return $pwd;
}

/*
function is_strong_password($pwd) {
  // At least 8 characters, with a mix of lower- and upper-case letters and at least one number OR special char
  $regex = '/(?=.{8,})(?=.*[a-z]+)(?=.*[A-Z]+)(?=.*[0-9!@#$%^&*_\-+]+)/';
  return (preg_match($regex, $pwd));
} */

function create_new_account($email, $pwd, $fname, $lname) {
  global $conn;
  $hash = password_hash($pwd, PASSWORD_DEFAULT);
  //  http://php.net/manual/en/function.strtotime.php
  $now = strtotime("now"); //timestamp
  $oneyear = strtotime("+1 year", $now);
  $valid = date('Y-m-d', $oneyear);
  $sql = "INSERT INTO Members VALUES (NULL, '$email', '$hash', '$fname', '$lname', '$valid', NULL, 0.00)";
  $result = mysqli_query($conn, $sql);
  if ($result) return true;
  return false;
}

function change_user_profile($uid, $new_email, $fname, $lname) {
  global $conn;
  $sql = "UPDATE Members SET Email = '$new_email', FirstName = '$fname', LastName = '$lname' WHERE ID = $uid";
  $result = mysqli_query($conn, $sql);
  if ($result) return true;
  return false;
}

function searchByKeyword($input) {
  global $conn;
  $found = array();
  $input = strtolower($input);
  $flex_input = '%' . $input . '%';
  $search = "SELECT * FROM Inventory WHERE LOWER(Name) LIKE '$flex_input' ORDER BY Name";
  $result = mysqli_query($conn, $search);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result))
      $found[] = $row;
  }
  echo json_encode($found);
  return;
}

function searchByForm() {
  global $conn;
  $found = array();
  $search = writeSqlSearch();
  $result = mysqli_query($conn, $search);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result))
      $found[] = $row;
  }
  echo json_encode($found);
  return;
}

function writeSqlSearch() {
  $minframe = $_POST['minframe'];
  $maxframe = $_POST['maxframe'];
  $search = "SELECT * FROM Inventory ";
  $search .= "WHERE Frame IS NULL OR (Frame >= $minframe AND Frame <= $maxframe) ";
  if (countCheckboxGroup('biketype')) {
    $biketypes = countCheckboxGroup('biketype');
    $search .= "AND Category IN $biketypes ";
  }
  if (countCheckboxGroup('gender')) {
    $genders = countCheckboxGroup('gender');
    $search .= "AND Gender IN $genders ";
  }
  if (isset($_POST['in_stock_only']) && $_POST['in_stock_only'] == 'Yes')
    $search .= "AND DueDate IS NULL";
  return $search;
}

function countCheckboxGroup($groupname) {
  if (!isset($_POST[$groupname])) return false;
  $group = $_POST[$groupname]; //an array
  if (empty($group))
    return false;
  $groupStr = "(" . implode(", ", $group) . ")";
  return $groupStr;
}

function searchByItemId($id) {
  global $conn;
  $found = array();
  $sql = "SELECT * FROM Inventory WHERE ID = $id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $found[] = $row;
  }
  echo json_encode($found);
  return;
}

function checkOutItem($email, $item) {
  global $conn;
  $uid = get_user_id($email);
  $now = strtotime("now");
  $threedays = strtotime("+3 days", $now);
  $due = date('Y-m-d', $threedays);
  $sql = "UPDATE Inventory SET CheckedOutBy = $uid, DueDate = '$due' WHERE ID = $item";
  $result = mysqli_query($conn, $sql);
  if (!$result) return false;
  $sql = "UPDATE Members SET RentedItem = $item WHERE ID = $uid";
  $result = mysqli_query($conn, $sql);
  if (!$result) return false;
  return true;
}

function update_user_fines($email) {
  if (user_has_items_out($email)) {
    global $conn;
    $uid = get_user_id($email);
    $sql = "SELECT DueDate FROM Inventory WHERE CheckedOutBy = $uid";
    $result = mysqli_query($conn, $sql);
    $duestr = mysqli_fetch_row($result)[0];
    /*
    https://www.w3schools.com/php7/func_date_date_diff.asp
    http://php.net/manual/en/dateinterval.format.php
    */
    $due = date_create($duestr);
    $now = date_create("now");
    $interval = date_diff($due, $now); //DateInterval object
    $diff = intval($interval->format("%r%a"));
    if ($diff > 0) {
      $fines = 20*$diff;
      $sql = "UPDATE Members SET Fines = $fines WHERE Email = '$email'";
      $result = mysqli_query($conn, $sql);
    }
  }
  return;
}

function pay_fines($email, $pay) {
  global $conn;
  $owe = get_user_fines($email);
  if ($owe == 9999.99) return false;
  if ($pay <= $owe)
    $newfines = $owe - $pay;
  else $newfines = 0.00;
  $sql = "UPDATE Members SET Fines = $newfines WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if (!$result) return false;
  return $newfines;
}

function return_item($email, $item) {
  global $conn;
  $sql = "UPDATE Inventory SET DueDate = NULL, CheckedOutBy = NULL WHERE ID = $item";
  $result = mysqli_query($conn, $sql);
  if (!$result) return false;
  $sql = "UPDATE Members SET RentedItem = NULL WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if (!$result) return false;
  return true;
}

function delete_account($email) {
  global $conn;
  $sql = "DELETE FROM Members WHERE Email = '$email'";
  $result = mysqli_query($conn, $sql);
  if (!$result) return false;
  return true;
}

?>
