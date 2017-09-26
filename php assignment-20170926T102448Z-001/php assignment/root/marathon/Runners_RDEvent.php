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
if (isset($_SESSION['DeRegisterSUCCESS'])) {
  echo '<script language="javascript">';
  echo "alert('De-Register Successful.')";
  echo '</script>';
  unset($_SESSION['DeRegisterSUCCESS']);
}
if (isset($_SESSION['DeRegisterFAIL'])) {
  echo '<script language="javascript">';
  echo "alert('De-Register Fail.\\nPlease try again!')";
  echo '</script>';
  unset($_SESSION['DeRegisterFAIL']);
}
if (isset($_SESSION['RegisterFail'])) {
  echo '<script language="javascript">';
  echo "alert('Register Fail.\\nPlease try again!')";
  echo '</script>';
  unset($_SESSION['DeRegisterFAIL']);
}
date_default_timezone_set("Asia/Hong_Kong");
$now = strtotime('now');
$thisyear = date('Y', $now);
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

<?php
require_once("dbInfo.php");
$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
  die("connection fail:".mysql_connect_error());
}
$sqlFindEvent = "SELECT * FROM `Event`";
$resultEvent = mysqli_query($connection, $sqlFindEvent);
$row = mysqli_fetch_assoc($resultEvent);
if (mysqli_num_rows($resultEvent) == 0 ){
echo "<label class='title'>No event at this moment!</label>";
}
else {



  echo "<label class='title'>Event</label>";
    $table = <<< EOF
    <table >
      <tr>
        <th> Event ID </th>
        <th> Event Name </th>
        <th> Date of Event </th>
        <th> Distance </th>
        <th> Time Start </th>
        <th> Price </th>
        <th> Click to<br>Re/De-Register </th>
      </tr>
EOF;
  echo $table;
$resultEvent = mysqli_query($connection, $sqlFindEvent);
while ($row = mysqli_fetch_assoc($resultEvent)) {
  $date = $row["DateOfEvent"];
  $time = $row["TimeStart"];
  $StartTime = strtotime("$date $time");
  $Startyear = date('Y', $StartTime);

  echo "<tr><td>". $row["EventID"] . "</td><td>" .
    $row["Name"] . "</td><td>" .
    $row["DateOfEvent"] . "</td><td>" .
    $row["Distance"] . "km" . "</td><td>" .
    $row["TimeStart"] . "</td><td>" .
    "$" . $row["Price"] . "</td><td>";
    $EventID =  $row["EventID"];
    $sqlFindRegisteredEvent = "SELECT * FROM `EventRegister` WHERE `EventID` = '$EventID'
    AND `RunnerID` = '$RunnerID'";
    $resultRegisteredEvent = mysqli_query($connection, $sqlFindRegisteredEvent);
    $RegisteredRow = mysqli_fetch_assoc($resultRegisteredEvent);
    if ($now < $StartTime && $thisyear == $Startyear) {
  if (mysqli_num_rows($resultRegisteredEvent) == 0 ){

    echo "<a class='Register' href='Runners_ChooseRacekit.php?EventID=$row[EventID]'>
    Register now<a/>"
    . "</td></tr>";
  }
  else {
    $confirm = <<<EOF
    onclick="return confirm('Are You Sure You Want To De-Register?')"
EOF;
    echo "<a class='Register' href='Runners_DeRegisterEvent.php?EventID=$row[EventID]'
   $confirm'>De-Register<a/>"
    . "</td></tr>";
  }

}
else if($now > $StartTime ) {
echo "Event finished";
}
else {
echo "Register not open yet";
}
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
