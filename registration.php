<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/shared/header.php';?>
<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>
<?php require_once "../wasilah-e-jannat/vendor/phpmailer/phpmailer/src/PHPMailer.php";?>
<?php require_once "../wasilah-e-jannat/vendor/phpmailer/phpmailer/src/SMTP.php";?>
<?php

if (isset($_POST['btn_reg']))
{
    $error_message = "";
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
        $firstname_error = "Please Enter First Name";
        $is_valid = false;
    }
    if ($last_name == "")
    {
        $lastname_error = "Please Enter Last Name";
        $is_valid = false;
    }
    if ($email == "")
    {

        $email_error = "Please Enter Email";
        $is_valid = false;

        // if (!preg_match("/^[a-zA-Z]*$/", $email))
        // {
        //     $email_error = "Only letters Allowed";
        // }
    }
    if ($pass == "")
    {
        $pass_error = "Please Enter Password";
        $is_valid = false;
    }

    if ($pass != $cpass)
    {
        $cpass_error = "Password Dosen't match";
    }
    if ($phone == "")
    {
        $phone_error = "Please Enter Phone Number";
        $is_valid = false;
    }
    if ($country == "")
    {
        $location_error = "Please Select Location";
        $is_valid = false;
    }
    if ($role == "")
    {
        $role_error = "Please choose role ID!";
        $is_valid = false;
    }

    $query_email = "SELECT email from fund_raiser where email='$email'";
    $query_phone = "SELECT phone from fund_raiser where phone='$phone'";
    $result_email = mysqli_query($con, $query_email);
    $result_phone = mysqli_query($con, $query_phone);

    if ($result_email->num_rows > 0)
    {
        $is_valid = false;
        $email_error = "Email Already Exists!";
    }
    if ($result_phone->num_rows > 0)
    {
        $is_valid = false;
        $phone_error = "Phone Number Already Exists!";
    }
    if ($is_valid = true)
    {
        $query = "insert into fund_raiser(`first_name`,`last_name`,`email`,`password`,`phone`,`country`,`role_id`)VALUES
        ('$first_name','$last_name','$email','$pass','$phone','$country','$role')";

        $result = mysqli_query($con, $query);

        if ($result == 1)
        {

            $mail = new PHPMailer\PHPMailer\PHPMailer();

            //Enable SMTP debugging.
            $mail->SMTPDebug = 0;
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name
            $mail->Host = "smtp.gmail.com";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password
            $mail->Username = "asif.iqbal0607@gmail.com";
            $mail->Password = "Ziyadasif123";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";
            //Set TCP port to connect to
            $mail->Port = 587;

            $mail->From = "$email";
            $mail->FromName = "$first_name,$last_name,$email";

            $mail->addAddress("asif.iqbal0607@gmail.com", "test email");

            $mail->isHTML(true);

            $mail->Subject = "User Added and Pending For Aproval";
            $mail->Body = "<i>Mail body in HTML</i>";
            $mail->AltBody = "This is the plain text version of the email content";

            if (!$mail->send())
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            else
            {
                $success_message = "User Sucessfully Registered & Email Sent For Aproval";
            }
        }
        else
        {
            $error_message = "Unable to Add Users!";
        }

    }
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="row register-form">
 <div class=" offset-2 col-md-8">
    <div class="form-group">
         <input type="text" class="form-control" value="<?php echo isset($first_name) ? $first_name : '' ?>" name="first_name" placeholder="First Name *">
         <p style="color: red;"><?php echo isset($firstname_error) ? $firstname_error : '' ?></p>

    </div>
    <div class="form-group">
         <input type="text" class="form-control" value="<?php echo isset($last_name) ? $last_name : '' ?>" name="last_name" placeholder="Last Name *">
         <p style="color: red;"><?php echo isset($lastname_error) ? $lastname_error : '' ?></p>

    </div>
    <div class="form-group">
      <input type="text" name="email" value="<?php echo isset($email) ? $email : '' ?>" class="form-control" placeholder="Email *">
      <p style="color: red;"><?php echo isset($email_error) ? $email_error : '' ?></p>

     </div>
    <div class="form-group">
        <input type="password" name="password" value="<?php echo isset($pass) ? $pass : '' ?>" class="form-control" placeholder="Password *">
        <p style="color: red;"><?php echo isset($pass_error) ? $pass_error : '' ?></p>

    </div>

    <div class="form-group">
         <input type="password" name="cpassword" value="<?php echo isset($cpass) ? $cpass : '' ?>" class="form-control" placeholder="Confirm Password *">
         <p style="color: red;"><?php echo isset($cpass_error) ? $cpass_error : '' ?></p>
    </div>

    <div class="form-group">
        <input type="number" onKeyPress="if(this.value.length==11) return false;" value="<?php echo isset($phone) ? $phone : '' ?>"
        name="phone" class="form-control" placeholder="Your Phone *">
        <p style="color: red;"><?php echo isset($phone_error) ? $phone_error : '' ?></p>

    </div>

    <div>
         <select class="form-control" name="country">
            <option value="">Please select your Country</option>
            <option>
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
            </option>
        </select>
        <p style="color: red;"><?php echo isset($location_error) ? $location_error : '' ?></p>
    </div>

    <div>
         <select class="form-control" name="role_id">
            <option value="">Please select your Role</option>
            <option value="1">Admin</option>
            <option value="2">Fund Raiser</option>
        </select>
        <p style="color: red;"><?php echo isset($role_error) ? $role_error : '' ?></p>
        <p style="color: red;"><?php echo isset($error_message) ? $error_message : '' ?></p>
        <p style="color: green;"><?php echo isset($success_message) ? $success_message : '' ?></p>
    </div>

        <input type="submit" name="btn_reg" class="btn btn-primary reg-btn" value="Register">
    </div>
</div>
    <?php include_once '../wasilah-e-jannat/shared/footer.php';?>
</form>

