<?php
session_start();
require_once("dbInfo.php");

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
  die("connection fail:".mysql_connect_error());
}
extract($_POST);

if ($type=="Admin") {
  $sqlcheckID = "SELECT * FROM `Administrator` WHERE `AdministratorID` = '$ID'";
  $resultCheck = mysqli_query($connection, $sqlcheckID);
    if (mysqli_num_rows($resultCheck) == 0 ){
    echo '<script type="text/javascript">';
    echo 'alert("Wrong Login Type/ID/Password. \\nPlease try again.");';
    echo 'window.location.href = "signin.php";';
    echo '</script>';
  }
  else {
      $row = mysqli_fetch_assoc($resultCheck);
    if ($PW==$row["Password"]) {
        header("Location: main.html");
    }
    else {
      echo '<script type="text/javascript">';
      echo 'alert("Wrong Login Type/ID/Password. \\nPlease try again.");';
      echo 'window.location.href = "signin.php";';
      echo '</script>';
    }
  }
}
elseif ($type=="Runner") {
  $sqlcheckID = "SELECT * FROM `Runner` WHERE `RunnerID` = '$ID'";
  $resultCheck = mysqli_query($connection, $sqlcheckID);
  if (mysqli_num_rows($resultCheck) == 0 ){
    echo '<script type="text/javascript">';
    echo 'alert("Wrong Login Type/ID/Password. \\nPlease try again.");';
    echo 'window.location.href = "signin.php";';
    echo '</script>';
  }
  else {

    $row = mysqli_fetch_assoc($resultCheck);
    if ($PW==$row["Password"]) {
        $RunnerID = $row["RunnerID"];
        $RunnerF = $row["FirstName"];
        $RunnerL = $row["LastName"];
        $RunnerPP = $row["ProfilePicture"];
        $_SESSION['RunnerName'] = $RunnerF . " " . $RunnerL;
        $_SESSION['RunnerID'] = $RunnerID;
        $_SESSION['RunnerPW'] = $PW;
        $_SESSION['RunnerPP'] = $RunnerPP;
        $_SESSION['timeout'] = time();
        header("Location: Runners_main.php");
    }
    else {
      echo '<script type="text/javascript">';
      echo 'alert("Wrong Login Type/ID/Password. \\nPlease try again.");';
      echo 'window.location.href = "signin.php";';
      echo '</script>';
    }
  }
}
elseif ($type=="Volunteer") {
  $sqlcheckID = "SELECT * FROM `Volunteer` WHERE `VolunteerID` = '$ID'";
  $resultCheck = mysqli_query($connection, $sqlcheckID);
  if (mysqli_num_rows($resultCheck) == 0 ){
    echo '<script type="text/javascript">';
    echo 'alert("Wrong Login Type/ID/Password. \\nPlease try again.");';
    echo 'window.location.href = "signin.php";';
    echo '</script>';
  }
  else {

    $row = mysqli_fetch_assoc($resultCheck);
    if ($PW==$row["Password"]) {
      $VolunteerID = $row["VolunteerID"];
      $VolunteerF = $row["FirstName"];
      $VolunteerL = $row["LastName"];
      $_SESSION['VolunteerName'] = $VolunteerF . " " . $VolunteerL;
      $_SESSION['VolunteerID'] = $VolunteerID;
      $_SESSION['VolunteerPW'] = $PW;
      $_SESSION['timeout'] = time();
      header("Location: Volunteers_Main.php");
    }
    else {
      echo '<script type="text/javascript">';
      echo 'alert("Wrong Login Type/ID/Password. \\nPlease try again.");';
      echo 'window.location.href = "signin.php";';
      echo '</script>';
    }
  }
}
elseif ($type=="Sponsor") {
  $sqlcheckID = "SELECT * FROM `Sponsor` WHERE `SponsorID` = '$ID'";
  $resultCheck = mysqli_query($connection, $sqlcheckID);
  if (mysqli_num_rows($resultCheck) == 0 ){
    echo '<script type="text/javascript">';
    echo 'alert("Wrong Login Type/ID/Password. \\nPlease try again.");';
    echo 'window.location.href = "signin.php";';
    echo '</script>';
  }
  else {

    $row = mysqli_fetch_assoc($resultCheck);
    if ($PW==$row["Password"]) {
      $SponsorID = $row["SponsorID"];
      $SponsorF = $row["FirstName"];
      $SponsorL = $row["LastName"];
      $_SESSION['SponsorName'] = $SponsorF . " " . $SponsorL;
      $_SESSION['SponsorID'] = $SponsorID;
      $_SESSION['SponsorPW'] = $PW;
      $_SESSION['timeout'] = time();
      header("Location: Sponsors_Main.php");
    }
    else {
      echo '<script type="text/javascript">';
      echo 'alert("Wrong Login Type/ID/Password. \\nPlease try again.");';
      echo 'window.location.href = "signin.php";';
      echo '</script>';
    }
  }

}



 ?>
