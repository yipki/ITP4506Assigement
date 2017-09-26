<?php
session_start();
require_once("dbInfo.php");

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
  die("connection fail:".mysql_connect_error());
}
extract($_POST);
$sqlRunner = "SELECT * FROM `runner` WHERE `Email` = '$Email'";
$resultRunner = mysqli_query($connection, $sqlRunner);

if (mysqli_num_rows($resultRunner) > 0 ){
  echo '<script type="text/javascript">';
  echo 'alert("Email has already been registered");';
  echo 'window.location.href = "Runners_signup.html";';
  echo '</script>';
}
  else {
    $DOB = $dobYear . "-" . $dobMonth . "-" . $dobDay;
    $sqlNewRunner = "INSERT INTO `runner` ( `Password`,
    `FirstName`, `LastName`, `Gender`, `DateOfBirth`, `Email` , `Country` )
    VALUES ( '$Password',
    '$FirstName', '$LastName', '$Gender', '$DOB',
    '$Email', '$Country' )";
$resultNewRunner = mysqli_query($connection,$sqlNewRunner);


$resultRunnerID = mysqli_query($connection, $sqlRunner);
$row = mysqli_fetch_assoc($resultRunnerID);
$RunnerID = $row["RunnerID"];


    $check = getimagesize($_FILES["pp"]["tmp_name"]);
    if ($check !== false) {
      $target_dir = "pp/";
      $name = $_FILES["pp"]["name"];
      $ext = end((explode(".", $name)));
      $target_file = $target_dir . "Runner" . $RunnerID . "." . $ext;
      move_uploaded_file($_FILES["pp"]["tmp_name"], $target_file);
      $sqlNewRunnerPP = "UPDATE `Runner` SET `ProfilePicture` = '$target_file'
      WHERE `RunnerID` = '$RunnerID'";
    }
    else {
      $sqlNewRunnerPP = "UPDATE `Runner` SET `ProfilePicture` = 'pp/default.png'
      WHERE `RunnerID` = '$RunnerID'";
    }

mysqli_query($connection,$sqlNewRunnerPP);
if (mysqli_affected_rows($connection) > 0){
$_SESSION['RID'] = $RunnerID;
 header("Location: signin.php");
}
 }


 ?>
