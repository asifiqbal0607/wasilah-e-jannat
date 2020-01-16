<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>


<?php
if (isset($_POST['update']))
{
    $user_id = $_POST['id'];
    $update_query = "SELECT * FROM fund_raiser WHERE id = $user_id";
    $update_result = mysqli_query($con, $update_query);
    //$result = mysqli_fetch_object($update_result);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $role = $_POST['role_id'];
    $is_valid;
    if ($first_name == "")
    {
        $firstname_error = "Please update First Name";
        $is_valid = false;
    }
    if ($last_name == "")
    {
        $lastname_error = "Please update Last Name";
        $is_valid = false;
    }
    if ($email == "")
    {
        $email_error = "Please update Email";
        $is_valid = false;
    }
    if ($pass == "")
    {
        $pass_error = "Please update password";
        $is_valid = false;
    }
    if ($pass != $cpass)
    {
        $cpass_error = "Password dosen't match";
        $is_valid = false;
    }
    if ($phone == "")
    {
        $phone_error = "Please update Phone Number";
        $is_valid = false;
    }
    if ($country == "")
    {
        $country_error = "Please choose Country";
        $is_valid = false;
    }
    if ($roles = "")
    {
        $role_error = "Please choose Role!";
        $is_valid = false;
    }
    else
    {
        $query_update = "UPDATE fund_raiser SET first_name ='$first_name', last_name='$last_name', email='$email', password='$pass',
            phone='$phone', country='$country', role_id='$role' WHERE id = '$user_id'";

        $result_update = mysqli_query($con, $query_update);
        //$result = mysqli_fetch_object($result_update);

        if ($result_update == 1)
        {
            header('Location:users.php');
        }

    }
}
?>
<?php include_once '../task_manager/helper/path_helper.php';?>
<?php include_once '../task_manager/shared/header.php';?>
<?php

if (isset($_REQUEST['edit_query']))
{
    $user_id = $_REQUEST['edit_query'];
    $get_data_query = "SELECT * FROM fund_raiser WHERE id = $user_id";
    $result_query = mysqli_query($con, $get_data_query);
    $user_data = mysqli_fetch_object($result_query);

}

?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="row register-form">
 <div class=" offset-2 col-md-8">
 <input type="hidden" name="id" value="<?=$user_data->id ?? '';?>">
    <div class="form-group">
         <input type="text" class="form-control" value="<?=$user_data->first_name ?? '';?>" name="first_name" placeholder="First Name *">
         <p style="color: red;"><?php echo isset($firstname_error) ? $firstname_error : '' ?></p>

    </div>
    <div class="form-group">
         <input type="text" class="form-control" value="<?=$user_data->last_name ?? '';?>" name="last_name" placeholder="Last Name *">
         <p style="color: red;"><?php echo isset($lastname_error) ? $lastname_error : '' ?></p>

    </div>
    <div class="form-group">
      <input type="text" name="email" value="<?=$user_data->email ?? '';?>" class="form-control" placeholder="Email *">
      <p style="color: red;"><?php echo isset($email_error) ? $email_error : '' ?></p>

     </div>
    <div class="form-group">
        <input type="password" name="password" value="<?=$user_data->password ?? '';?>" class="form-control" placeholder="Password *">
        <p style="color: red;"><?php echo isset($pass_error) ? $pass_error : '' ?></p>

    </div>

    <div class="form-group">
         <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password *">
         <p style="color: red;"><?php echo isset($cpass_error) ? $cpass_error : '' ?></p>
    </div>

    <div class="form-group">
        <input type="number" value="<?=$user_data->phone ?? '';?>" onKeyPress="if(this.value.length==11) return false;" name="phone"
        class="form-control" placeholder="Your Phone *">
        <p style="color: red;"><?php echo isset($phone_error) ? $phone_error : '' ?></p>

    </div>

    <?php
$country_query = "SELECT * FROM fund_raiser WHERE id = $user_id";
$country_result = mysqli_query($con, $country_query);

?>
    <div class="form-group">
        <select class="form-control" name="country">

            <option value="">Please select your Country</option>
            <?php
$countries = array("AF" => "Afghanistan",
    "AX" => "Åland Islands",
    "AL" => "Albania",
    "DZ" => "Algeria",
    "AS" => "American Samoa",
    "AD" => "Andorra",
    "AO" => "Angola",
    "AI" => "Anguilla",
    "AQ" => "Antarctica",
    "AG" => "Antigua and Barbuda",
    "AR" => "Argentina",
    "AM" => "Armenia",
    "AW" => "Aruba",
    "AU" => "Australia",
    "AT" => "Austria",
    "AZ" => "Azerbaijan",
    "BS" => "Bahamas",
    "BH" => "Bahrain",
    "BD" => "Bangladesh",
    "BB" => "Barbados",
    "BY" => "Belarus",
    "BE" => "Belgium",
    "BZ" => "Belize",
    "BJ" => "Benin",
    "BM" => "Bermuda",
    "BT" => "Bhutan",
    "BO" => "Bolivia",
    "BA" => "Bosnia and Herzegovina",
    "BW" => "Botswana",
    "BV" => "Bouvet Island",
    "BR" => "Brazil",
    "IO" => "British Indian Ocean Territory",
    "BN" => "Brunei Darussalam",
    "BG" => "Bulgaria",
    "BF" => "Burkina Faso",
    "BI" => "Burundi",
    "KH" => "Cambodia",
    "CM" => "Cameroon",
    "CA" => "Canada",
    "CV" => "Cape Verde",
    "KY" => "Cayman Islands",
    "CF" => "Central African Republic",
    "TD" => "Chad",
    "CL" => "Chile",
    "CN" => "China",
    "CX" => "Christmas Island",
    "CC" => "Cocos (Keeling) Islands",
    "CO" => "Colombia",
    "KM" => "Comoros",
    "CG" => "Congo",
    "CD" => "Congo, The Democratic Republic of The",
    "CK" => "Cook Islands",
    "CR" => "Costa Rica",
    "CI" => "Cote D'ivoire",
    "HR" => "Croatia",
    "CU" => "Cuba",
    "CY" => "Cyprus",
    "CZ" => "Czech Republic",
    "DK" => "Denmark",
    "DJ" => "Djibouti",
    "DM" => "Dominica",
    "DO" => "Dominican Republic",
    "EC" => "Ecuador",
    "EG" => "Egypt",
    "SV" => "El Salvador",
    "GQ" => "Equatorial Guinea",
    "ER" => "Eritrea",
    "EE" => "Estonia",
    "ET" => "Ethiopia",
    "FK" => "Falkland Islands (Malvinas)",
    "FO" => "Faroe Islands",
    "FJ" => "Fiji",
    "FI" => "Finland",
    "FR" => "France",
    "GF" => "French Guiana",
    "PF" => "French Polynesia",
    "TF" => "French Southern Territories",
    "GA" => "Gabon",
    "GM" => "Gambia",
    "GE" => "Georgia",
    "DE" => "Germany",
    "GH" => "Ghana",
    "GI" => "Gibraltar",
    "GR" => "Greece",
    "GL" => "Greenland",
    "GD" => "Grenada",
    "GP" => "Guadeloupe",
    "GU" => "Guam",
    "GT" => "Guatemala",
    "GG" => "Guernsey",
    "GN" => "Guinea",
    "GW" => "Guinea-bissau",
    "GY" => "Guyana",
    "HT" => "Haiti",
    "HM" => "Heard Island and Mcdonald Islands",
    "VA" => "Holy See (Vatican City State)",
    "HN" => "Honduras",
    "HK" => "Hong Kong",
    "HU" => "Hungary",
    "IS" => "Iceland",
    "IN" => "India",
    "ID" => "Indonesia",
    "IR" => "Iran, Islamic Republic of",
    "IQ" => "Iraq",
    "IE" => "Ireland",
    "IM" => "Isle of Man",
    "IL" => "Israel",
    "IT" => "Italy",
    "JM" => "Jamaica",
    "JP" => "Japan",
    "JE" => "Jersey",
    "JO" => "Jordan",
    "KZ" => "Kazakhstan",
    "KE" => "Kenya",
    "KI" => "Kiribati",
    "KP" => "Korea, Democratic People's Republic of",
    "KR" => "Korea, Republic of",
    "KW" => "Kuwait",
    "KG" => "Kyrgyzstan",
    "LA" => "Lao People's Democratic Republic",
    "LV" => "Latvia",
    "LB" => "Lebanon",
    "LS" => "Lesotho",
    "LR" => "Liberia",
    "LY" => "Libyan Arab Jamahiriya",
    "LI" => "Liechtenstein",
    "LT" => "Lithuania",
    "LU" => "Luxembourg",
    "MO" => "Macao",
    "MK" => "Macedonia, The Former Yugoslav Republic of",
    "MG" => "Madagascar",
    "MW" => "Malawi",
    "MY" => "Malaysia",
    "MV" => "Maldives",
    "ML" => "Mali",
    "MT" => "Malta",
    "MH" => "Marshall Islands",
    "MQ" => "Martinique",
    "MR" => "Mauritania",
    "MU" => "Mauritius",
    "YT" => "Mayotte",
    "MX" => "Mexico",
    "FM" => "Micronesia, Federated States of",
    "MD" => "Moldova, Republic of",
    "MC" => "Monaco",
    "MN" => "Mongolia",
    "ME" => "Montenegro",
    "MS" => "Montserrat",
    "MA" => "Morocco",
    "MZ" => "Mozambique",
    "MM" => "Myanmar",
    "NA" => "Namibia",
    "NR" => "Nauru",
    "NP" => "Nepal",
    "NL" => "Netherlands",
    "AN" => "Netherlands Antilles",
    "NC" => "New Caledonia",
    "NZ" => "New Zealand",
    "NI" => "Nicaragua",
    "NE" => "Niger",
    "NG" => "Nigeria",
    "NU" => "Niue",
    "NF" => "Norfolk Island",
    "MP" => "Northern Mariana Islands",
    "NO" => "Norway",
    "OM" => "Oman",
    "PK" => "Pakistan",
    "PW" => "Palau",
    "PS" => "Palestinian Territory, Occupied",
    "PA" => "Panama",
    "PG" => "Papua New Guinea",
    "PY" => "Paraguay",
    "PE" => "Peru",
    "PH" => "Philippines",
    "PN" => "Pitcairn",
    "PL" => "Poland",
    "PT" => "Portugal",
    "PR" => "Puerto Rico",
    "QA" => "Qatar",
    "RE" => "Reunion",
    "RO" => "Romania",
    "RU" => "Russian Federation",
    "RW" => "Rwanda",
    "SH" => "Saint Helena",
    "KN" => "Saint Kitts and Nevis",
    "LC" => "Saint Lucia",
    "PM" => "Saint Pierre and Miquelon",
    "VC" => "Saint Vincent and The Grenadines",
    "WS" => "Samoa",
    "SM" => "San Marino",
    "ST" => "Sao Tome and Principe",
    "SA" => "Saudi Arabia",
    "SN" => "Senegal",
    "RS" => "Serbia",
    "SC" => "Seychelles",
    "SL" => "Sierra Leone",
    "SG" => "Singapore",
    "SK" => "Slovakia",
    "SI" => "Slovenia",
    "SB" => "Solomon Islands",
    "SO" => "Somalia",
    "ZA" => "South Africa",
    "GS" => "South Georgia and The South Sandwich Islands",
    "ES" => "Spain",
    "LK" => "Sri Lanka",
    "SD" => "Sudan",
    "SR" => "Suriname",
    "SJ" => "Svalbard and Jan Mayen",
    "SZ" => "Swaziland",
    "SE" => "Sweden",
    "CH" => "Switzerland",
    "SY" => "Syrian Arab Republic",
    "TW" => "Taiwan, Province of China",
    "TJ" => "Tajikistan",
    "TZ" => "Tanzania, United Republic of",
    "TH" => "Thailand",
    "TL" => "Timor-leste",
    "TG" => "Togo",
    "TK" => "Tokelau",
    "TO" => "Tonga",
    "TT" => "Trinidad and Tobago",
    "TN" => "Tunisia",
    "TR" => "Turkey",
    "TM" => "Turkmenistan",
    "TC" => "Turks and Caicos Islands",
    "TV" => "Tuvalu",
    "UG" => "Uganda",
    "UA" => "Ukraine",
    "AE" => "United Arab Emirates",
    "GB" => "United Kingdom",
    "US" => "United States",
    "UM" => "United States Minor Outlying Islands",
    "UY" => "Uruguay",
    "UZ" => "Uzbekistan",
    "VU" => "Vanuatu",
    "VE" => "Venezuela",
    "VN" => "Viet Nam",
    "VG" => "Virgin Islands, British",
    "VI" => "Virgin Islands, U.S.",
    "WF" => "Wallis and Futuna",
    "EH" => "Western Sahara",
    "YE" => "Yemen",
    "ZM" => "Zambia",
    "ZW" => "Zimbabwe");
foreach ($countries as $countries => $value)
{
    ?>
    <option value="<?=$countries?>" title="<?=htmlspecialchars($value)?>"><?=htmlspecialchars($value)?></option>
    <?php
}
?>
            <?php while ($user_row = mysqli_fetch_assoc($country_result))
{
    ?>
            <option value="<?=$user_row['country'];?>" <?=$user_data->country == $user_row['country'] ? "selected='selected'" : ""?>>
            <?php echo $user_row['country']; ?>
        </option>
        <?php }?>
        </select>
        <p style="color: red;"><?php echo isset($country_error) ? $country_error : '' ?></p>
    </div>



<?php
$get_roles_query = "SELECT * FROM admin";
$roles_result = mysqli_query($con, $get_roles_query);

?>
    <div class="form-group">

         <select class="form-control" name="role_id">
            <option value="">Please select your Role</option>

            <?php while ($user_row = mysqli_fetch_assoc($roles_result))
{
    ?>
            <option value="<?php echo $user_row['id']; ?>" <?php echo $user_data->role_id == $user_row['id'] ? "selected='selected'" : "" ?>>
                <?php echo $user_row['roles']; ?>
            </option>
            <?php
}
?>
        </select>
        <p style="color: red;"><?php echo isset($role_error) ? $role_error : '' ?></p>
        <p style="color: red;"><?php echo isset($error_message) ? $error_message : '' ?></p>
        <p style="color: green;"><?php echo isset($success_message) ? $success_message : '' ?></p>
    </div>

        <input type="submit" name="update" class="btn btn-primary" value="Update">
    </div>
</div>
</form>

<?php include_once '../wasilah-e-jannat/shared/footer.php';?>

