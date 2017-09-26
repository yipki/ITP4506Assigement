<?php
session_start();
$RunnerID = $_SESSION['RunnerID'];
$RunnerPW = $_SESSION['RunnerPW'];
$RunnerName = $_SESSION['RunnerName'];
$RunnerPP = $_SESSION['RunnerPP'];
$EventID = $_SESSION["EventID"];
$RacekitID = $_GET["RacekitID"];
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
 <html>

 <head>
 <title>Online Marathon Skills management system</title>
 <link rel="stylesheet" href="stylesheet/Runners_stylesheet.css" />
 <link rel="icon" type="image/png" href="icon/icon.png" />
 </head>

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
  <div class="racekit">
 <?php
 require_once("dbInfo.php");
 $connection = mysqli_connect($servername, $username, $password, $dbname);
 if (!$connection) {
   die("connection fail:".mysql_connect_error());
 }
 else{
   $sqlFindEvent = "SELECT * FROM `Event` WHERE `EventID` = '$EventID'";
  $sqlFindRacekit = "SELECT * FROM `RaceKitChoice` WHERE `RacekitID` = '$RacekitID'";
   $resultEvent = mysqli_query($connection, $sqlFindEvent);
   $Eventrow = mysqli_fetch_assoc($resultEvent);
   $resultRacekit = mysqli_query($connection, $sqlFindRacekit);
   $Racekitrow = mysqli_fetch_assoc($resultRacekit);
   if (mysqli_num_rows($resultEvent) == 0 || mysqli_num_rows($resultRacekit) == 0 ){
   echo "<label class='title'>Error!<br>Please try again.</label>";
}
else {
  echo "<label class='title'>Please confirm your register</label>";
  $resultEvent = mysqli_query($connection, $sqlFindEvent);
  $Eventrow = mysqli_fetch_assoc($resultEvent);
  $resultRacekit = mysqli_query($connection, $sqlFindRacekit);
  $Racekitrow = mysqli_fetch_assoc($resultRacekit);
  $total = $Eventrow["Price"]  +  $Racekitrow["Price"];
  echo "<table>" . "<tr>" ."<th>" . "Event ID:" . "</th>" .
  "<td>" . $Eventrow["EventID"] . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "Event Name:" . "</th>" .
  "<td>" . $Eventrow["Name"] . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "Date of Event:" . "</th>" .
  "<td>" . $Eventrow["DateOfEvent"] . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "Distance:" . "</th>" .
  "<td>" . $Eventrow["Distance"] . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "Time Start:" . "</th>" .
  "<td>" . $Eventrow["TimeStart"] . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "RaceKit ID:" . "</th>" .
  "<td>" . $Racekitrow["RaceKitID"] . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "RaceKit Name:" . "</th>" .
  "<td>" . $Racekitrow["Name"] . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "Photo:" . "</th>" .
  "<td>" . "<img src='" . $Racekitrow["Photo"] . "' alt='RacekitPhoto' height='80' width='110'>" . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "RaceKit Description:" . "</th>" .
  "<td>" . $Racekitrow["EventID"] . "</td>" . "</tr>" .
  "<tr>" ."<th>" . "Total Price:" . "</th>" .
  "<td>" . "$" . $total .
  " (Event: " . $Eventrow["Price"] . " + " . "Racekit: " . $Racekitrow["Price"] .")" .
  "</td>" . "</tr>";
  $_SESSION['EventID'] = $EventID;
  $_SESSION['RacekitID'] = $RacekitID;
  $_SESSION['PaymentTotal'] = $total;

}

 echo "</table>";

}
  ?>
</div >
<div class="TwoBtn">

<button type="button" class = "racekitbtn" onclick="window.location.href='Runners_ChooseRacekit.php?EventID=<?php echo $EventID;?>'">
    Back To Previous Page</button>
    <button type="button" class = "racekitbtn" onclick="window.location.href='Runners_RegisterEvent.php'">
        confirm</button>
</div>
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
