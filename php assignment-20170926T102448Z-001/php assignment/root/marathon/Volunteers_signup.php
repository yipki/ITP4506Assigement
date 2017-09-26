<?php
session_start();
require_once("dbInfo.php");

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
  die("connection fail:".mysql_connect_error());
}
extract($_POST);
$sqlVolunteer = "SELECT * FROM `volunteer` WHERE `Email` = '$Email'";
$resultVolunteer = mysqli_query($connection, $sqlVolunteer);

if (mysqli_num_rows($resultVolunteer) > 0){
echo '<script type="text/javascript">';
echo 'alert("Email has already been registered");';
echo 'window.location.href = "Volunteers_signup.html";';
echo '</script>';
}
  else {
    $sqlNewVolunteer = "INSERT INTO `volunteer` ( `Password`,
    `FirstName`, `LastName`, `Gender`, `Email`)
    VALUES ( '$Password',
    '$FirstName', '$LastName', '$Gender', '$Email')";
    $resultNewVolunteer = mysqli_query($connection,$sqlNewVolunteer);

 if (mysqli_affected_rows($connection) > 0){

 $resultVolunteerID = mysqli_query($connection, $sqlVolunteer);
 $row = mysqli_fetch_assoc($resultVolunteerID);
 $VolunteerID = $row["VolunteerID"];
 $_SESSION['VID'] = $VolunteerID;
 header("Location: signin.php");
}
 }


 ?>
