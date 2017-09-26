<?php
session_start();
$VolunteerID = $_SESSION['VolunteerID'];
$VolunteerPW = $_SESSION['VolunteerPW'];
$VolunteerName = $_SESSION['VolunteerName'];
$_SESSION['VolunteerID'] = $VolunteerID;
$_SESSION['VolunteerPW'] = $VolunteerPW;
$_SESSION['VolunteerName'] = $VolunteerName;
if ( !isset($_SESSION['VolunteerID']) || $_SESSION['timeout'] + 15 * 60 < time()){
  $_SESSION['invalidLogin'] = "1";
  header("Location: signin.php");
}
$_SESSION['timeout'] = time();
 ?>
	<script src="jquery-3.2.1.js"></script>
<html>

<head>
<title>Online Marathon Skills management system</title>
<link rel="stylesheet" href="stylesheet/Volunteers_stylesheet.css" />
<link rel="icon" type="image/png" href="icon/icon.png" />
</head>
<!-- <body background="bg.png"  background-repeat: no-repeat;> -->
<body bgcolor="#000000"  >


<div class="topbar" id="topbar">
  <a class="mediaPP">
    <?php
    echo"<label class='user'>". $VolunteerName . "</label>"; ?>
  </a>
<a class="img" href="Volunteers_Main.php"><img src="icon/Main_icon.png" alt="logo" height="35" width="150"></a>


<div class="items" id="items">
  <a class="item" href="Volunteers_RunnersEventRecord.php">Runner Event Records</a>
  <a class="item" href="Volunteers_SendRaceKit.php" >Racekit Released Record</a>
  <a class="item" href="Volunteers_RaceKit.php">RaceKit Manage</a>
</div>

<div class="logout">
  <a onclick="logoutDrop()" class="logout">
    <?php
    echo"<label class='user'>". $VolunteerName . "</label>"; ?>


    <img class="logout" src="icon/drop_icon.png" alt="drop" height="10" width="10">
  </a>

  <div id="logout" class="dropdown-content">
   <a href="logout.php">Log out</a>
  </div>
  </div>
  <?php

   ?>

  </div>
<div class="dropdown">
<img onclick="menuDrop()" class="menu" src="icon/menu_icon.png"  height="40" width="40" >
  <div id="myDropdown" class="dropdown-content">
    <a class="item" href="Volunteers_RunnersEventRecord.php">Runner Event Records</a>
    <a class="item" href="Volunteers_SendRaceKit.php" >Racekit Released Record</a>
    <a class="item" href="Volunteers_RaceKit.php">RaceKit Manage</a>
    <a href="logout.php">Log out</a>
  </div>
</div>


<div class="line">
</div>





<script>

function menuDrop() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function logoutDrop() {
    document.getElementById("logout").classList.toggle("show");
}


</script>


</body>
</html>
