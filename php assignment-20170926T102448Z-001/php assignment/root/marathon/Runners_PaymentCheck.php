<?php
session_start();
$RunnerID = $_SESSION['RunnerID'];
$RunnerPW = $_SESSION['RunnerPW'];
$RunnerName = $_SESSION['RunnerName'];
$RunnerPP = $_SESSION['RunnerPP'];
$RegID = $_SESSION['RegID'];
$_SESSION['RunnerPP'] = $RunnerPP;
$_SESSION['RunnerID'] = $RunnerID;
$_SESSION['RunnerPW'] = $RunnerPW;
$_SESSION['RunnerName'] = $RunnerName;

if ( !isset($_SESSION['RunnerID']) || $_SESSION['timeout'] + 15 * 60 < time()){
  $_SESSION['invalidLogin'] = "1";
  header("Location: signin.php");
}
$_SESSION['timeout'] = time();
if (isset($_SESSION['RegisterSuccess'])) {
  echo '<script language="javascript">';
  echo "alert('Register Successfully!\\nYou can now pay for the registered event.')";
  echo '</script>';
  unset($_SESSION['RegisterSuccess']);
}
if (isset($_POST['SCode'])){
  require_once("dbInfo.php");
  $connection = mysqli_connect($servername, $username, $password, $dbname);
  if (!$connection) {
    die("connection fail:".mysql_connect_error());
  }
  $sqlPAID = "UPDATE `EventRegister` SET `PaymentConfirmed` = '1' WHERE `RegID` = '$RegID'";
  mysqli_query($connection, $sqlPAID);
  unset($_SESSION['RegID']);
  if (mysqli_affected_rows($connection) > 0){
  $_SESSION['PaymentSuccess'] = "1";
  header("Location: Runners_Payments.php");
  }
  else{
    $_SESSION['PaymentFail'] = "1";
    header("Location: Runners_MakePayments.php");
  }
}
else{
  $_SESSION['PaymentFail'] = "1";
  header("Location: Runners_MakePayments.php");
}

?>
