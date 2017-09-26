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
if (isset($_SESSION['RegisterSuccess'])) {
  echo '<script language="javascript">';
  echo "alert('Register Successfully!\\nYou can now pay for the registered event.')";
  echo '</script>';
  unset($_SESSION['RegisterSuccess']);
}
if (isset($_SESSION['PaymentSuccess'])) {
  echo '<script language="javascript">';
  echo "alert('Payment Success!\\nThank You.')";
  echo '</script>';
  unset($_SESSION['PaymentSuccess']);
}
date_default_timezone_set("Asia/Hong_Kong");
$now = strtotime('now');
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
<a class="item" href="Runners_RDEvent.php">Re/De-Register Event</a>
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
<?php
require_once("dbInfo.php");
$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
  die("connection fail:".mysql_connect_error());
}
$sqlFindEvent = "SELECT * FROM `EventRegister` WHERE `RunnerID` = '$RunnerID'";
$resultEvent = mysqli_query($connection, $sqlFindEvent);
$row = mysqli_fetch_assoc($resultEvent);
if (mysqli_num_rows($resultEvent) == 0 ){
echo "<label class='title'>No event record found!</label>";
}
else {
  echo "<label class='title'>Event Record</label>";
    $table = <<< EOF
    <table >
      <tr>
        <th> Event ID </th>
        <th> Event Name </th>
        <th> RaceKit ID </th>
        <th> RaceKit Name </th>
        <th> Payment Total </th>
        <th> Make Payment </th>
      <tr>
EOF;
  echo $table;
  $sqlFindEvent = "SELECT * FROM `EventRegister` WHERE `RunnerID` = '$RunnerID'";
  $resultEvent = mysqli_query($connection, $sqlFindEvent);

while ($row = mysqli_fetch_assoc($resultEvent)) {
  $sqlFindEventName = "SELECT * FROM `Event` WHERE `EventID` = '$row[EventID]'";
  $resultEventName = mysqli_query($connection, $sqlFindEventName);
  $EventName = mysqli_fetch_assoc($resultEventName);
  $sqlFindRaceKitName = "SELECT * FROM `RaceKitChoice` WHERE `EventID` = '$row[EventID]'";
  $resultRaceKitName = mysqli_query($connection, $sqlFindRaceKitName);
  $RaceKitName = mysqli_fetch_assoc($resultRaceKitName);
  echo "<tr><td>". $row["EventID"] . "</td>";
  echo "<td>" . $EventName["Name"]. "</td><td>";
  echo $row["RaceKitID"];
  echo "</td><td>" ;
  echo $RaceKitName["Name"];
  echo "</td><td>";
  echo "$" . $row["PaymentTotal"];
  echo "</td><td>";
  if ($row["PaymentConfirmed"]=="1") {
    echo "PAID";
  }
  else {
    $RegID = $row["RegID"];
    echo "<a class='Register' href='Runners_MakePayments.php?RegID=$RegID'>Click to Pay<a/>";
  }
  echo"</td></tr>";
}
echo "</table>";
}

 ?>




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
