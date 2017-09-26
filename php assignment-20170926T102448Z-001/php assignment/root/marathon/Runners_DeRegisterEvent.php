<?php
session_start();
$RunnerID = $_SESSION['RunnerID'];
$RunnerPW = $_SESSION['RunnerPW'];
$RunnerName = $_SESSION['RunnerName'];
$RunnerPP = $_SESSION['RunnerPP'];

if ( !isset($_SESSION['RunnerID'])){
  $_SESSION['invalidLogin'] = "1";
  header("Location: signin.php");
}
require_once("dbInfo.php");

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
  die("connection fail:".mysql_connect_error());
}
$EventID = $_GET["EventID"];

$sql = "DELETE FROM `EventRegister` WHERE `EventID` = '$EventID'";

$result = mysqli_query($connection, $sql);

if (mysqli_affected_rows($connection) > 0) {
  $_SESSION['PPOutput'] = $PPOutput;
  $_SESSION['RunnerID'] = $RunnerID;
  $_SESSION['RunnerPW'] = $RunnerPW;
  $_SESSION['RunnerName'] = $RunnerName;
  $_SESSION['DeRegisterSUCCESS'] = "1";
  header("Location: Runners_RDEvent.php");
}
else {
  $_SESSION['PPOutput'] = $PPOutput;
  $_SESSION['RunnerID'] = $RunnerID;
  $_SESSION['RunnerPW'] = $RunnerPW;
  $_SESSION['RunnerName'] = $RunnerName;
  $_SESSION['DeRegisterFAIL'] = "1";
  header("Location: Runners_RDEvent.php");
}
 ?>
