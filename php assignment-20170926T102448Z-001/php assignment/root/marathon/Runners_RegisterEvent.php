<?php
session_start();
$RunnerID = $_SESSION['RunnerID'];
$RunnerPW = $_SESSION['RunnerPW'];
$RunnerName = $_SESSION['RunnerName'];
$RunnerPP = $_SESSION['RunnerPP'];
$EventID = $_SESSION["EventID"];
$RacekitID = $_SESSION["RacekitID"];
$PaymentTotal = $_SESSION["PaymentTotal"];
$_SESSION['RunnerPP'] = $RunnerPP;
$_SESSION['RunnerID'] = $RunnerID;
$_SESSION['RunnerPW'] = $RunnerPW;
$_SESSION['RunnerName'] = $RunnerName;

if ( !isset($_SESSION['RunnerID']) || $_SESSION['timeout'] + 15 * 60 < time()){
  $_SESSION['invalidLogin'] = "1";
  header("Location: signin.php");
}
$_SESSION['timeout'] = time();


require_once("dbInfo.php");

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
  die("connection fail:".mysql_connect_error());
}

$sqlNewEventRegister = "INSERT INTO `EventRegister` ( `RunnerID`,
`EventID`, `PaymentTotal`, `RaceKitID`, `PaymentConfirmed`, `RaceKitSent`)
VALUES ( '$RunnerID', '$EventID', '$PaymentTotal', '$RacekitID', '0', '0')";

$resultNewEventRegister = mysqli_query($connection, $sqlNewEventRegister);
unset($_SESSION["EventID"]);
unset($_SESSION["RacekitID"]);
unset($_SESSION["PaymentTotal"]);
if (mysqli_affected_rows($connection) > 0){
$_SESSION['RegisterSuccess'] = "1";
header("Location: Runners_Payments.php");
}
else{
  $_SESSION['RegisterFail'] = "1";
  header("Location: RDEvent.php");
}

 ?>
