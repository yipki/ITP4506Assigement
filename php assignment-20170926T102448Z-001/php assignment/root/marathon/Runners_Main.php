<?php
session_start();
$RunnerID = $_SESSION['RunnerID'];
$RunnerPW = $_SESSION['RunnerPW'];
$RunnerName = $_SESSION['RunnerName'];
$RunnerPP = $_SESSION['RunnerPP'];
$_SESSION['RunnerPP'] = $RunnerPP;
$_SESSION['RunnerID'] = $RunnerID;
$_SESSION['RunnerPW'] = $RunnerPW;
$_SESSION['RunnerName'] = $RunnerName;
if ( !isset($_SESSION['RunnerID']) || $_SESSION['timeout'] + 15 * 60 < time()){
  $_SESSION['invalidLogin'] = "1";
  header("Location: signin.php");
}
$_SESSION['timeout'] = time();
 ?>
	<script src="jquery-3.2.1.js"></script>
<html>

<head>
<title>Online Marathon Skills management system</title>
<link rel="stylesheet" href="stylesheet/Runners_stylesheet.css" />
<link rel="icon" type="image/png" href="icon/icon.png" />
</head>
<!-- <body background="bg.png"  background-repeat: no-repeat;> -->
<body bgcolor="#000000"  >


<div class="topbar" id="topbar">

  <a class="mediaPP">
    <img src="<?php echo $RunnerPP; ?>" alt="ProfilePicture" height="30" width="30">
  </a>

<a class="img" href="Runners_Main.php"><img src="icon/Main_icon.png" alt="logo" height="35" width="150"></a>


<div class="items" id="items">
  <a class="item" href="Runners_Profile.php">Profile</a>
  <a class="item" href="Runners_EventRecord.php">Event Record</a>
  <a class="item" href="Runners_RDEvent.php" >Re/De-Register Event</a>
  <a class="item" href="Runners_Payments.php">Payments</a>
</div>

<div class="logout">
  <a onclick="logoutDrop()" class="logout">
    <?php
    echo"<label class='user'>". $RunnerName . "</label>"; ?>

    <img src="<?php echo $RunnerPP; ?>" alt="ProfilePicture" height="30" width="30">
    <img class="logout" src="icon/drop_icon.png" alt="drop" height="10" width="10">
  </a>



  <div id="logout" class="dropdown-content">
   <a href="logout.php">Log out</a>
  </div>
  </div>
  </div>
<div class="dropdown">
<img onclick="menuDrop()" class="menu" src="icon/menu_icon.png"  height="40" width="40" >
  <div id="myDropdown" class="dropdown-content">
    <a href="Runners_Profile.php">Profile</a>
    <a href="Runners_EventRecord.php">Event Record</a>
    <a href="Runners_RDEvent.php" >Re/De-Register Event</a>
    <a href="Runners_Payments.php">Payments</a>
    <a href="logout.php">Log out</a>
  </div>
</div>


<div class="line">
</div>

<center>
<div class="Slide">
  <img class="mySlides" src="main/sponsors.png" style="width:100%">
  <img class="mySlides" src="main/runners.jpg" style="width:100% ">
  <img class="mySlides" src="main/volunteers.jpg" style="width:100%; ">
</div>
</center>
<h2 class="LMP">
  <font color="#FCAF17"><center>Lastest Marathon promotion</center>
  </font></h2>
<video class="Promo" width= 100% controls autoplay>
  <source src="main/Promo.mp4" type="video/mp4">
</video>


<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 3000); // Change image every 3 seconds
}

function menuDrop() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function logoutDrop() {
    document.getElementById("logout").classList.toggle("show");
}

</script>


</body>
</html>
