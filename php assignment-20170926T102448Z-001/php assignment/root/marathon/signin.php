<?php
session_start();
if (isset($_SESSION['invalidLogin'])) {
  echo '<script language="javascript">';
  echo "alert('Out Time!\\nPlease login again.')";
  echo '</script>';
  session_destroy();
}
if (isset($_SESSION['RID'])) {
$ID = $_SESSION['RID'];
echo '<script language="javascript">';
echo "alert('Your RunnerID is :' +  $ID + '\\n' + 'Please record it for login purpose.')";
echo '</script>';
unset($_SESSION['RID']);
}
if (isset($_SESSION['SID'])) {
$ID = $_SESSION['SID'];
echo '<script language="javascript">';
echo "alert('Your SponserID is :' +  $ID + '\\n' + 'Please record it for login purpose.')";
echo '</script>';
unset($_SESSION['SID']);
}
if (isset($_SESSION['VID'])) {
$ID = $_SESSION['VID'];
echo '<script language="javascript">';
echo "alert('Your VolunteerID is :' +  $ID + '\\n' + 'Please record it for login purpose.')";
echo '</script>';
unset($_SESSION['VID']);
}


 ?>
<html>
<head>
<title>Online Marathon Skills management system</title>
<link rel="stylesheet" href="stylesheet/stylesheet.css" />
<link rel="icon" type="image/png" href="icon/icon.png" />
</head>
<!-- <body background="bg.png"  background-repeat: no-repeat;> -->
<body bgcolor="#000000"  >


<div class="topbar" id="topbar">

<a class="img" href="main.html"><img src="icon/Main_icon.png" alt="logo" height="35" width="150"></a>


<div class="items" id="items">
  <a class="sign" href="signin.php">sign in</a>
  <label class="or">or</label>
  <a class="sign" href="Runners_signup.html">sign up</a>
  </div>
<div class="dropdown">
<img onclick="menuDrop()" class="menu" src="icon/menu_icon.png"  height="40" width="40" >
  <div id="myDropdown" class="dropdown-content">
   <a href="signin.php">sign in</a>
   <a href="Runners_signup.html">sign up</a>
  </div>
</div>
</div>
<div class="line">
</div>

<label class="signup">Sign in</label>


        <form class="signin_check" name="signin_check" action="signin_check.php" method="POST">
          <div class="type">
          <input type="radio" name="type" id="type" value="Runner"
         />   runners
          <input type="radio" name="type" id="type" value="Volunteer"
           />  volunteers
          <input type="radio" name="type" id="type" value="Sponsor"
           />  sponsors
          </div>
            <input type="radio" name="type" id="type" value="Admin" style="display:none" checked />
            <br>

        ID :<br>
        <input class="signin_input" type="text" name="ID" id="ID" required
        /><br>

        Password :<br>
        <input class="signin_input" type="password" name="PW" id="PW" required /><br><br>
        <input class="submit "type="submit" value="Sign in" />
      </form>







<script>
function menuDrop() {
    document.getElementById("myDropdown").classList.toggle("show");
}
</script>


</body>
</html>
