<?php
session_start();
require_once("dbInfo.php");

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
  die("connection fail:".mysql_connect_error());
}
extract($_POST);
$sqlSponsor = "SELECT * FROM `Sponsor` WHERE `Email` = '$Email'";
$resultSponsor = mysqli_query($connection, $sqlSponsor);

if (mysqli_num_rows($resultSponsor) > 0){
  echo '<script type="text/javascript">';
  echo 'alert("Email has already been registered");';
  echo 'window.location.href = "Sponsors_signup.html";';
  echo '</script>';
}
  else {
    $sqlNewSponsor = "INSERT INTO `Sponsor` ( `Password`,
    `FirstName`, `LastName`, `Company`, `Email`)
    VALUES ( '$Password',
    '$FirstName', '$LastName', '$Company', '$Email')";
    $resultNewSponsor = mysqli_query($connection,$sqlNewSponsor);

 if (mysqli_affected_rows($connection) > 0){

 $resultSponsorID = mysqli_query($connection, $sqlSponsor);
 $row = mysqli_fetch_assoc($resultSponsorID);
 $SponsorID = $row["SponsorID"];
 $_SESSION['SID'] = $SponsorID;
 header("Location: signin.php");
}
 }


 ?>
