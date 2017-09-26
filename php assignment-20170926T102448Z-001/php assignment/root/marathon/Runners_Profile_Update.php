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
extract($_POST);
  $DOB = $dobYear . "-" . $dobMonth . "-" . $dobDay;
  $sqlFindRunner = "SELECT * FROM `Runner` WHERE `RunnerID` = '$RunnerID'";
  $sqlEmail = "UPDATE `Runner` SET `Email` = '$Email' WHERE `RunnerID` = '$RunnerID'";
  $sqlFName = "UPDATE `Runner` SET `FirstName` = '$FirstName' WHERE `RunnerID` = '$RunnerID'";
  $sqlLname = "UPDATE `Runner` SET `LastName` = '$LastName' WHERE `RunnerID` = '$RunnerID'";
  $sqlPW = "UPDATE `Runner` SET `Password` = '$Password' WHERE `RunnerID` = '$RunnerID'";
  $sqlGender = "UPDATE `Runner` SET `Gender` = '$Gender' WHERE `RunnerID` = '$RunnerID'";
  $sqlDOB = "UPDATE `Runner` SET `DateOfBirth` = '$DOB' WHERE `RunnerID` = '$RunnerID'";
  $sqlCountry = "UPDATE `Runner` SET `Country` = '$Country' WHERE `RunnerID` = '$RunnerID'";

  $resultRunner = mysqli_query($connection, $sqlFindRunner);
  mysqli_query($connection, $sqlGender);
  mysqli_query($connection, $sqlDOB);
  mysqli_query($connection, $sqlCountry);


  $row = mysqli_fetch_assoc($resultRunner);
  if ($RunnerPW!=$row["Password"]) {
    $_SESSION['invalidLogin'] = "1";
      header("Location: signin.php");
  }


  if ($FirstName != null) {
  mysqli_query($connection, $sqlFName);
  $resultRunner = mysqli_query($connection, $sqlFindRunner);
  $row = mysqli_fetch_assoc($resultRunner);
  $RunnerName = $row["FirstName"] . " " . $row["LastName"];
  }

  if ($LastName != null) {
  mysqli_query($connection, $sqlLname);
  $resultRunner = mysqli_query($connection, $sqlFindRunner);
  $row = mysqli_fetch_assoc($resultRunner);
  $RunnerName = $row["FirstName"] . " " . $row["LastName"];
  }

  if ($Password != null) {
  mysqli_query($connection, $sqlPW);
  $resultRunner = mysqli_query($connection, $sqlFindRunner);
  $row = mysqli_fetch_assoc($resultRunner);
  $RunnerPW=$row["Password"];
  }

  $check = getimagesize($_FILES["pp"]["tmp_name"]);
  if ($check !== false && $PPOutput == "uploaded" ) {
    $target_dir = "pp/";
    $name = $_FILES["pp"]["name"];
    $ext = end((explode(".", $name)));
    $target_file = $target_dir . "Runner" . $RunnerID . "." . $ext;
    move_uploaded_file($_FILES["pp"]["tmp_name"], $target_file);
    $sqlPP = "UPDATE `Runner` SET `ProfilePicture` = '$target_file'
    WHERE `RunnerID` = '$RunnerID'";
    mysqli_query($connection, $sqlPP);
    $_SESSION['RunnerPP'] = $target_file;


  }
  else if ($PPOutput == "default"){
    $default = "pp/default.png";
    $sqlDefaultPP = "UPDATE `Runner` SET `ProfilePicture` = '$default'
    WHERE `RunnerID` = '$RunnerID'";
    mysqli_query($connection, $sqlDefaultPP);
    $_SESSION['RunnerPP'] = "pp/default.png";

  }
  else{
  $_SESSION['RunnerPP'] = $RunnerPP;
  }
  if ($Email != null) {
  $sqlRunner = "SELECT * FROM `runner` WHERE `Email` = '$Email'";
  $resultRunner = mysqli_query($connection, $sqlRunner);
  if (mysqli_num_rows($resultRunner) > 0 ){
    $_SESSION['PPOutput'] = $PPOutput;
    $_SESSION['RunnerID'] = $RunnerID;
    $_SESSION['RunnerPW'] = $RunnerPW;
    $_SESSION['RunnerName'] = $RunnerName;
    $_SESSION['EmailRegistered'] = "1";
    header("Location: Runners_Profile.php");

  }
  else {
    mysqli_query($connection, $sqlEmail);
    $_SESSION['PPOutput'] = $PPOutput;
    $_SESSION['RunnerID'] = $RunnerID;
    $_SESSION['RunnerPW'] = $RunnerPW;
    $_SESSION['RunnerName'] = $RunnerName;
    $_SESSION['UPDATESUCCESS'] = "1";
     header("Location: Runners_Profile.php");
  }
  }
  else{
    $_SESSION['PPOutput'] = $PPOutput;
    $_SESSION['RunnerID'] = $RunnerID;
    $_SESSION['RunnerPW'] = $RunnerPW;
    $_SESSION['RunnerName'] = $RunnerName;
    $_SESSION['UPDATESUCCESS'] = "1";
     header("Location: Runners_Profile.php");
  }

 ?>
