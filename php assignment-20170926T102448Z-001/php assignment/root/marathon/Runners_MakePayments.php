<?php
session_start();
$RunnerID = $_SESSION['RunnerID'];
$RunnerPW = $_SESSION['RunnerPW'];
$RunnerName = $_SESSION['RunnerName'];
$RunnerPP = $_SESSION['RunnerPP'];
$RegID = $_GET['RegID'];
$_SESSION['RunnerPP'] = $RunnerPP;
$_SESSION['RunnerID'] = $RunnerID;
$_SESSION['RunnerPW'] = $RunnerPW;
$_SESSION['RunnerName'] = $RunnerName;
$_SESSION['RegID'] = $RegID;

if ( !isset($_SESSION['RunnerID']) || $_SESSION['timeout'] + 15 * 60 < time()){
  $_SESSION['invalidLogin'] = "1";
  header("Location: signin.php");
}
$_SESSION['timeout'] = time();
if (isset($_SESSION['PaymentFail'])) {
  echo '<script language="javascript">';
  echo "alert('Payment Fail!\\nPlease try again.')";
  echo '</script>';
  unset($_SESSION['PaymentFail']);
}

?>
<script src="jquery-3.2.1.js"></script>
<html>

<head>
<title>Online Marathon Skills management system</title>
<link rel="stylesheet" href="Runners_stylesheet.css" />
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
$sqlFindEvent = "SELECT * FROM `EventRegister` WHERE `RegID` = '$RegID'";
$resultEvent = mysqli_query($connection, $sqlFindEvent);
$row = mysqli_fetch_assoc($resultEvent);
if (mysqli_num_rows($resultEvent) == 0 ){
echo "<label class='title'>Error!Pleas try again.</label>";
}
else {
  echo "<label class='title'>Make Payment</label>";
  $form = <<< EOF
  <form class="Payment" name="Payment" action="Runners_PaymentCheck.php" method="POST">
  Payment method <br>
  <select name="PaymentMethod" id="PaymentMethod" required>
  <option value="Visa">Visa</option>
  <option value="MasterCard">MasterCard</option>
  <option value="AE">American Express</option>
  </select>
  <br>
  Card number<br>
  <input class="payment_input" type="text" name="CardNumber" id="CardNumber" maxlength="16" required
   pattern="\d{16}"/><br>
  Expiration date and <br>security code:<br>
  <select name="XMonth" id="XMonth" required>
    <option value="">--</option>
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
  <select name="XMonth" id="XMonth" required>
    <option value="">----</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    <option value="2021">2021</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030</option>
    <option value="2031">2031</option>
    <option value="2032">2032</option>
    <option value="2033">2033</option>
    <option value="2034"2034</option>
    <option value="2035">2035</option>
    <option value="2036">2036</option>
    <option value="2037">2037</option>
    <option value="2038">2038</option>
    <option value="2039">2039</option>
    <option value="2040">2040</option>
    <option value="2041">2041</option>
    <option value="2042">2042</option>
  </select>
  <input class="SCode" type="text" name="SCode" id="SCode"
   maxlength="4" pattern="\d{3-4}" required /><br><br>

   <a class="BI">BILLING INFORMATION</a><br>
   <label>First name</label><label class="LastName">Last Name</label><br>
   <input class="FN" type="text" name="FirstName" id="FirstName" required
   />

   <input class="LN" type="text" name="LastName" id="LastName" required /><br>
   Billing address<br>
   <input class="BI" type="text" name="BA1" id="BA1" required /><br>
   Billing address, line 2<br>
   <input class="BI" type="text" name="BA2" id="BA2" required /><br>
   Country<br>
   <select name="Country" id="Country" required>
     <option value="">Country...</option>
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
   <label>City</label><label class="Zip">Zip code</label><br>
   <input class="City_input" type="text" name="City" id="City" required />

   <input class="Zip_input" type="text" name="Zip" id="Zip" required /><br>
   Phone number<br>
   <input class="BI" type="text" name="PhoneNumber" id="PhoneNumber" pattern="\d{1,%}"  required />
   <br><br>

   <input class="paybtn"type="submit" value="Pay" />
   </form>
EOF;
}
echo $form;
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
