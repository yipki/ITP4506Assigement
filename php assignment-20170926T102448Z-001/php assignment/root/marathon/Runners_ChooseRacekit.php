<?php
session_start();
$RunnerID = $_SESSION['RunnerID'];
$RunnerPW = $_SESSION['RunnerPW'];
$RunnerName = $_SESSION['RunnerName'];
$RunnerPP = $_SESSION['RunnerPP'];
$EventID = $_GET["EventID"];
$_SESSION['RunnerPP'] = $RunnerPP;
$_SESSION['RunnerID'] = $RunnerID;
$_SESSION['RunnerPW'] = $RunnerPW;
$_SESSION['RunnerName'] = $RunnerName;
$_SESSION['EventID'] = $EventID;
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
 <img onclick="menuDrop()" class="menu" src="icon/Menu_icon.png"  height="40" width="40" >
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

 $sqlFindRacekit = "SELECT * FROM `RaceKitChoice` WHERE `EventID` = '$EventID'";
 $resultRacekit = mysqli_query($connection, $sqlFindRacekit);
 $row = mysqli_fetch_assoc($resultRacekit);
 if (mysqli_num_rows($resultRacekit) == 0 ){
 echo "<label class='title'>Racekit not updated. Please try again later</label>";
 }
 else {
   echo "<label class='title'>Please choose a Racekit</label>";
     $table = <<< EOF
     <table >
       <tr>
         <th> RaceKit ID </th>
         <th> Name </th>
         <th> Photo </th>
         <th> Price </th>
         <th> Description </th>
         <th> Please click to choose </th>
       </tr>
EOF;
 echo $table;
   $resultRacekit = mysqli_query($connection, $sqlFindRacekit);
   while ($row = mysqli_fetch_assoc($resultRacekit)){
     $RacekitID = $row["RaceKitID"];
     $Name = $row["Name"];
     $Photo = $row["Photo"];
     $Price = $row["Price"];
     $Desc = $row["Description"];




     echo "<tr><td>". $RacekitID . "</td><td>" .
       $Name . "</td><td>" .
       "<img src='" . $Photo . "' alt='RacekitPhoto' height='80' width='110'>" . "</td><td>" .
       "$" . $Price . "</td><td>" .
       $Desc . "</td><td>" .
       "<a class='Register' href='Runners_RegisterEventConfirm.php?RacekitID=$RacekitID'>
       Choose it<a/>"
       . "</td></tr>";
   }
}
echo "</table>";
  ?>
</div>
<button type="button" class = "BTRD" onclick="window.location.href='Runners_RDEvent.php'">
    Back To Previous Page</button>

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
