<?php
session_start();
$RunnerID = $_SESSION['RunnerID'];
$RunnerPW = $_SESSION['RunnerPW'];
$RunnerName = $_SESSION['RunnerName'];
$RunnerPP = $_SESSION['RunnerPP'];
$_SESSION['RunnerID'] = $RunnerID;
$_SESSION['RunnerPP'] = $RunnerPP;
$_SESSION['RunnerPW'] = $RunnerPW;
$_SESSION['RunnerName'] = $RunnerName;
if ( !isset($_SESSION['RunnerID']) || $_SESSION['timeout'] + 15 * 60 < time()){
  $_SESSION['invalidLogin'] = "1";
  header("Location: signin.php");
}
$_SESSION['timeout'] = time();
if (isset($_SESSION['UPDATESUCCESS'])) {
  echo '<script language="javascript">';
  echo "alert('Update Successfully!')";
  echo '</script>';
  unset($_SESSION['UPDATESUCCESS']);
}
if (isset($_SESSION['EmailRegistered'])) {
  echo '<script type="text/javascript">';
  echo 'alert("Email has already been registered\\nPlease try again.");';
  echo 'window.location.href = "Runners_Profile.php";';
  echo '</script>';
  unset($_SESSION['EmailRegistered']);
}
require_once("dbInfo.php");
$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
  die("connection fail:".mysql_connect_error());
}
  $sqlFindRunner = "SELECT * FROM `Runner` WHERE `RunnerID` = '$RunnerID'";
  $resultRunner = mysqli_query($connection, $sqlFindRunner);
  $row = mysqli_fetch_assoc($resultRunner);
  if ($RunnerPW!=$row["Password"]) {
      $_SESSION['invalidLogin'] = "1";
       header("Location: signin.php");
  }
  $Email = $row["Email"];
  $FName = $row["FirstName"];
  $LName = $row["LastName"];
  $Gender = $row["Gender"];
  $DOB = $row["DateOfBirth"];
  $Country = $row["Country"];
  $PP = $row["ProfilePicture"];
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
  <?php

   ?>

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

<label class="title">Profile</label>


<form class="runners_signup" name="runners_signup" action="Runners_Profile_Update.php" method="POST"
 enctype="multipart/form-data">

Email: <br>
<input class="signup_input" type="email" name="Email" id="Email"
placeholder="<?php echo $Email ?>"
title="name@domain" /><br>

First Name :<br>
<input class="signup_input" type="text" name="FirstName" id="FirstName"
placeholder="<?php echo $FName ?>"
/><br>

Last Name :<br>
<input class="signup_input" type="text" name="LastName" id="LastName"
placeholder="<?php echo $LName ?>"  /><br>

Password :<br>
<input class="signup_input" type="password" name="old_Password"
 pattern= "<?php echo $row['Password']; ?>" required
title="Please input your current password" /><br>

New Password :<br>
<input class="signup_input" type="password" name="Password" id="Password"
oninput="check(this.value)"
pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
title="At least 8 include UpperCase, LowerCase, Number/SpecialChar" /><br>

Confirm Password :<br>
<input class="signup_input" type="password"  id="confirm_password" pattern = ""
 title="Please input the same password."/><br>

Gender :<br>
<input type="radio" name="Gender" id="Gender" value="M"
<?php if ($row['Gender']=="M") echo "checked"; ?>
 />   M
<input type="radio" name="Gender" id="Gender" value="F"
<?php if ($row['Gender']=="F") echo "checked"; ?>
 />  F
<br>

Date Of Birth :<br>
<select name="dobDay" id="dobDay" required>
  <option value="<?php echo substr($DOB,8,2); ?>"><?php echo substr($DOB,8,2); ?></option>
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>
<select name="dobMonth" id="dobMonth" required>
  <option value="<?php echo substr($DOB,5,2); ?>"><?php echo substr($DOB,5,2); ?></option>
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
</select>
<select name="dobYear" id="dobYear" required>
  <option value="<?php echo substr($DOB,0,4); ?>"><?php echo substr($DOB,0,4); ?></option>
  <option value="2017">2017</option>
  <option value="2016">2016</option>
  <option value="2015">2015</option>
  <option value="2014">2014</option>
  <option value="2013">2013</option>
  <option value="2012">2012</option>
  <option value="2011">2011</option>
  <option value="2010">2010</option>
  <option value="2009">2009</option>
  <option value="2008">2008</option>
  <option value="2007">2007</option>
  <option value="2006">2006</option>
  <option value="2005">2005</option>
  <option value="2004">2004</option>
  <option value="2003">2003</option>
  <option value="2002">2002</option>
  <option value="2001">2001</option>
  <option value="2000">2000</option>
  <option value="1999">1999</option>
  <option value="1998">1998</option>
  <option value="1997">1997</option>
  <option value="1996">1996</option>
  <option value="1995">1995</option>
  <option value="1994">1994</option>
  <option value="1993">1993</option>
  <option value="1992">1992</option>
  <option value="1991">1991</option>
  <option value="1990">1990</option>
  <option value="1989">1989</option>
  <option value="1988">1988</option>
  <option value="1987">1987</option>
  <option value="1986">1986</option>
  <option value="1985">1985</option>
  <option value="1984">1984</option>
  <option value="1983">1983</option>
  <option value="1982">1982</option>
  <option value="1981">1981</option>
  <option value="1980">1980</option>
  <option value="1979">1979</option>
  <option value="1978">1978</option>
  <option value="1977">1977</option>
  <option value="1976">1976</option>
  <option value="1975">1975</option>
  <option value="1974">1974</option>
  <option value="1973">1973</option>
  <option value="1972">1972</option>
  <option value="1971">1971</option>
  <option value="1970">1970</option>
  <option value="1969">1969</option>
  <option value="1968">1968</option>
  <option value="1967">1967</option>
  <option value="1966">1966</option>
  <option value="1965">1965</option>
  <option value="1964">1964</option>
  <option value="1963">1963</option>
  <option value="1962">1962</option>
  <option value="1961">1961</option>
  <option value="1960">1960</option>
  <option value="1959">1959</option>
  <option value="1958">1958</option>
  <option value="1957">1957</option>
  <option value="1956">1956</option>
  <option value="1955">1955</option>
  <option value="1954">1954</option>
  <option value="1953">1953</option>
  <option value="1952">1952</option>
  <option value="1951">1951</option>
  <option value="1950">1950</option>
  <option value="1949">1949</option>
  <option value="1948">1948</option>
  <option value="1947">1947</option>
  <option value="1946">1946</option>
  <option value="1945">1945</option>
  <option value="1944">1944</option>
  <option value="1943">1943</option>
  <option value="1942">1942</option>
  <option value="1941">1941</option>
  <option value="1940">1940</option>
  <option value="1939">1939</option>
  <option value="1938">1938</option>
  <option value="1937">1937</option>
  <option value="1936">1936</option>
  <option value="1935">1935</option>
  <option value="1934">1934</option>
  <option value="1933">1933</option>
  <option value="1932">1932</option>
  <option value="1931">1931</option>
  <option value="1930">1930</option>
  <option value="1929">1929</option>
  <option value="1928">1928</option>
  <option value="1927">1927</option>
  <option value="1926">1926</option>
  <option value="1925">1925</option>
  <option value="1924">1924</option>
  <option value="1923">1923</option>
  <option value="1922">1922</option>
  <option value="1921">1921</option>
  <option value="1920">1920</option>
  <option value="1919">1919</option>
  <option value="1918">1918</option>
  <option value="1917">1917</option>
  <option value="1916">1916</option>
  <option value="1915">1915</option>
  <option value="1914">1914</option>
  <option value="1913">1913</option>
  <option value="1912">1912</option>
  <option value="1911">1911</option>
  <option value="1910">1910</option>
  <option value="1909">1909</option>
  <option value="1908">1908</option>
  <option value="1907">1907</option>
  <option value="1906">1906</option>
  <option value="1905">1905</option>
  <option value="1904">1904</option>
  <option value="1903">1903</option>
  <option value="1901">1901</option>
  <option value="1900">1900</option>
</select>
<br>

Country :<br>
<select name="Country" id="Country" required>
  <option value="<?php echo $Country ?>"><?php echo $Country ?></option>
  <option value="Afganistan">Afghanistan</option>
  <option value="Albania">Albania</option>
  <option value="Algeria">Algeria</option>
  <option value="American Samoa">American Samoa</option>
  <option value="Andorra">Andorra</option>
  <option value="Angola">Angola</option>
  <option value="Anguilla">Anguilla</option>
  <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
  <option value="Argentina">Argentina</option>
  <option value="Armenia">Armenia</option>
  <option value="Aruba">Aruba</option>
  <option value="Australia">Australia</option>
  <option value="Austria">Austria</option>
  <option value="Azerbaijan">Azerbaijan</option>
  <option value="Bahamas">Bahamas</option>
  <option value="Bahrain">Bahrain</option>
  <option value="Bangladesh">Bangladesh</option>
  <option value="Barbados">Barbados</option>
  <option value="Belarus">Belarus</option>
  <option value="Belgium">Belgium</option>
  <option value="Belize">Belize</option>
  <option value="Benin">Benin</option>
  <option value="Bermuda">Bermuda</option>
  <option value="Bhutan">Bhutan</option>
  <option value="Bolivia">Bolivia</option>
  <option value="Bonaire">Bonaire</option>
  <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
  <option value="Botswana">Botswana</option>
  <option value="Brazil">Brazil</option>
  <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
  <option value="Brunei">Brunei</option>
  <option value="Bulgaria">Bulgaria</option>
  <option value="Burkina Faso">Burkina Faso</option>
  <option value="Burundi">Burundi</option>
  <option value="Cambodia">Cambodia</option>
  <option value="Cameroon">Cameroon</option>
  <option value="Canada">Canada</option>
  <option value="Canary Islands">Canary Islands</option>
  <option value="Cape Verde">Cape Verde</option>
  <option value="Cayman Islands">Cayman Islands</option>
  <option value="Central African Republic">Central African Republic</option>
  <option value="Chad">Chad</option>
  <option value="Channel Islands">Channel Islands</option>
  <option value="Chile">Chile</option>
  <option value="China">China</option>
  <option value="Christmas Island">Christmas Island</option>
  <option value="Cocos Island">Cocos Island</option>
  <option value="Colombia">Colombia</option>
  <option value="Comoros">Comoros</option>
  <option value="Congo">Congo</option>
  <option value="Cook Islands">Cook Islands</option>
  <option value="Costa Rica">Costa Rica</option>
  <option value="Cote DIvoire">Cote D'Ivoire</option>
  <option value="Croatia">Croatia</option>
  <option value="Cuba">Cuba</option>
  <option value="Curaco">Curacao</option>
  <option value="Cyprus">Cyprus</option>
  <option value="Czech Republic">Czech Republic</option>
  <option value="Denmark">Denmark</option>
  <option value="Djibouti">Djibouti</option>
  <option value="Dominica">Dominica</option>
  <option value="Dominican Republic">Dominican Republic</option>
  <option value="East Timor">East Timor</option>
  <option value="Ecuador">Ecuador</option>
  <option value="Egypt">Egypt</option>
  <option value="El Salvador">El Salvador</option>
  <option value="Equatorial Guinea">Equatorial Guinea</option>
  <option value="Eritrea">Eritrea</option>
  <option value="Estonia">Estonia</option>
  <option value="Ethiopia">Ethiopia</option>
  <option value="Falkland Islands">Falkland Islands</option>
  <option value="Faroe Islands">Faroe Islands</option>
  <option value="Fiji">Fiji</option>
  <option value="Finland">Finland</option>
  <option value="France">France</option>
  <option value="French Guiana">French Guiana</option>
  <option value="French Polynesia">French Polynesia</option>
  <option value="French Southern Ter">French Southern Ter</option>
  <option value="Gabon">Gabon</option>
  <option value="Gambia">Gambia</option>
  <option value="Georgia">Georgia</option>
  <option value="Germany">Germany</option>
  <option value="Ghana">Ghana</option>
  <option value="Gibraltar">Gibraltar</option>
  <option value="Great Britain">Great Britain</option>
  <option value="Greece">Greece</option>
  <option value="Greenland">Greenland</option>
  <option value="Grenada">Grenada</option>
  <option value="Guadeloupe">Guadeloupe</option>
  <option value="Guam">Guam</option>
  <option value="Guatemala">Guatemala</option>
  <option value="Guinea">Guinea</option>
  <option value="Guyana">Guyana</option>
  <option value="Haiti">Haiti</option>
  <option value="Hawaii">Hawaii</option>
  <option value="Honduras">Honduras</option>
  <option value="Hong Kong">Hong Kong</option>
  <option value="Hungary">Hungary</option>
  <option value="Iceland">Iceland</option>
  <option value="India">India</option>
  <option value="Indonesia">Indonesia</option>
  <option value="Iran">Iran</option>
  <option value="Iraq">Iraq</option>
  <option value="Ireland">Ireland</option>
  <option value="Isle of Man">Isle of Man</option>
  <option value="Israel">Israel</option>
  <option value="Italy">Italy</option>
  <option value="Jamaica">Jamaica</option>
  <option value="Japan">Japan</option>
  <option value="Jordan">Jordan</option>
  <option value="Kazakhstan">Kazakhstan</option>
  <option value="Kenya">Kenya</option>
  <option value="Kiribati">Kiribati</option>
  <option value="Korea North">Korea North</option>
  <option value="Korea Sout">Korea South</option>
  <option value="Kuwait">Kuwait</option>
  <option value="Kyrgyzstan">Kyrgyzstan</option>
  <option value="Laos">Laos</option>
  <option value="Latvia">Latvia</option>
  <option value="Lebanon">Lebanon</option>
  <option value="Lesotho">Lesotho</option>
  <option value="Liberia">Liberia</option>
  <option value="Libya">Libya</option>
  <option value="Liechtenstein">Liechtenstein</option>
  <option value="Lithuania">Lithuania</option>
  <option value="Luxembourg">Luxembourg</option>
  <option value="Macau">Macau</option>
  <option value="Macedonia">Macedonia</option>
  <option value="Madagascar">Madagascar</option>
  <option value="Malaysia">Malaysia</option>
  <option value="Malawi">Malawi</option>
  <option value="Maldives">Maldives</option>
  <option value="Mali">Mali</option>
  <option value="Malta">Malta</option>
  <option value="Marshall Islands">Marshall Islands</option>
  <option value="Martinique">Martinique</option>
  <option value="Mauritania">Mauritania</option>
  <option value="Mauritius">Mauritius</option>
  <option value="Mayotte">Mayotte</option>
  <option value="Mexico">Mexico</option>
  <option value="Midway Islands">Midway Islands</option>
  <option value="Moldova">Moldova</option>
  <option value="Monaco">Monaco</option>
  <option value="Mongolia">Mongolia</option>
  <option value="Montserrat">Montserrat</option>
  <option value="Morocco">Morocco</option>
  <option value="Mozambique">Mozambique</option>
  <option value="Myanmar">Myanmar</option>
  <option value="Nambia">Nambia</option>
  <option value="Nauru">Nauru</option>
  <option value="Nepal">Nepal</option>
  <option value="Netherland Antilles">Netherland Antilles</option>
  <option value="Netherlands">Netherlands (Holland, Europe)</option>
  <option value="Nevis">Nevis</option>
  <option value="New Caledonia">New Caledonia</option>
  <option value="New Zealand">New Zealand</option>
  <option value="Nicaragua">Nicaragua</option>
  <option value="Niger">Niger</option>
  <option value="Nigeria">Nigeria</option>
  <option value="Niue">Niue</option>
  <option value="Norfolk Island">Norfolk Island</option>
  <option value="Norway">Norway</option>
  <option value="Oman">Oman</option>
  <option value="Pakistan">Pakistan</option>
  <option value="Palau Island">Palau Island</option>
  <option value="Palestine">Palestine</option>
  <option value="Panama">Panama</option>
  <option value="Papua New Guinea">Papua New Guinea</option>
  <option value="Paraguay">Paraguay</option>
  <option value="Peru">Peru</option>
  <option value="Phillipines">Philippines</option>
  <option value="Pitcairn Island">Pitcairn Island</option>
  <option value="Poland">Poland</option>
  <option value="Portugal">Portugal</option>
  <option value="Puerto Rico">Puerto Rico</option>
  <option value="Qatar">Qatar</option>
  <option value="Republic of Montenegro">Republic of Montenegro</option>
  <option value="Republic of Serbia">Republic of Serbia</option>
  <option value="Reunion">Reunion</option>
  <option value="Romania">Romania</option>
  <option value="Russia">Russia</option>
  <option value="Rwanda">Rwanda</option>
  <option value="St Barthelemy">St Barthelemy</option>
  <option value="St Eustatius">St Eustatius</option>
  <option value="St Helena">St Helena</option>
  <option value="St Kitts-Nevis">St Kitts-Nevis</option>
  <option value="St Lucia">St Lucia</option>
  <option value="St Maarten">St Maarten</option>
  <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
  <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
  <option value="Saipan">Saipan</option>
  <option value="Samoa">Samoa</option>
  <option value="Samoa American">Samoa American</option>
  <option value="San Marino">San Marino</option>
  <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
  <option value="Saudi Arabia">Saudi Arabia</option>
  <option value="Senegal">Senegal</option>
  <option value="Serbia">Serbia</option>
  <option value="Seychelles">Seychelles</option>
  <option value="Sierra Leone">Sierra Leone</option>
  <option value="Singapore">Singapore</option>
  <option value="Slovakia">Slovakia</option>
  <option value="Slovenia">Slovenia</option>
  <option value="Solomon Islands">Solomon Islands</option>
  <option value="Somalia">Somalia</option>
  <option value="South Africa">South Africa</option>
  <option value="Spain">Spain</option>
  <option value="Sri Lanka">Sri Lanka</option>
  <option value="Sudan">Sudan</option>
  <option value="Suriname">Suriname</option>
  <option value="Swaziland">Swaziland</option>
  <option value="Sweden">Sweden</option>
  <option value="Switzerland">Switzerland</option>
  <option value="Syria">Syria</option>
  <option value="Tahiti">Tahiti</option>
  <option value="Taiwan">Taiwan</option>
  <option value="Tajikistan">Tajikistan</option>
  <option value="Tanzania">Tanzania</option>
  <option value="Thailand">Thailand</option>
  <option value="Togo">Togo</option>
  <option value="Tokelau">Tokelau</option>
  <option value="Tonga">Tonga</option>
  <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
  <option value="Tunisia">Tunisia</option>
  <option value="Turkey">Turkey</option>
  <option value="Turkmenistan">Turkmenistan</option>
  <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
  <option value="Tuvalu">Tuvalu</option>
  <option value="Uganda">Uganda</option>
  <option value="Ukraine">Ukraine</option>
  <option value="United Arab Erimates">United Arab Emirates</option>
  <option value="United Kingdom">United Kingdom</option>
  <option value="United States of America">United States of America</option>
  <option value="Uraguay">Uruguay</option>
  <option value="Uzbekistan">Uzbekistan</option>
  <option value="Vanuatu">Vanuatu</option>
  <option value="Vatican City State">Vatican City State</option>
  <option value="Venezuela">Venezuela</option>
  <option value="Vietnam">Vietnam</option>
  <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
  <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
  <option value="Wake Island">Wake Island</option>
  <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
  <option value="Yemen">Yemen</option>
  <option value="Zaire">Zaire</option>
  <option value="Zambia">Zambia</option>
  <option value="Zimbabwe">Zimbabwe</option>
</select><br>

ProfilePicture :<br>
<img id="output" src="<?php echo $RunnerPP; ?>"  height="72" width="72"/>
<input class="hidden" name="PPOutput" id="PPOutput" type="text" value="<?php echo $RunnerPP; ?>" />
<button <?php if ($RunnerPP=="pp/default.png")
{echo 'class="hidden"';} ?> type="button" onclick="RemovePP();" >Remove picture</button><br>
<input type="file" name="pp" id="pp" onchange="loadFile(event)" accept="image/*">

<br><br>

<input class="submit "type="submit" value="Update" />
</form>
<?php

 ?>

<script>

  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
      var PPOutput = document.getElementById('PPOutput');
      PPOutput.value = "uploaded"
    };
    reader.readAsDataURL(event.target.files[0]);

  };

  function RemovePP() {
  var output = document.getElementById('output');
  output.src = "pp/default.png";
  var PPOutput = document.getElementById('PPOutput');
  PPOutput.value = "default";
}

  function check(password) {
  document.getElementById('confirm_password').pattern = password ;
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
