<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/shared/header.php';?>
<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>
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

        $insert_query = "INSERT INTO fund_raiser(`first_name`,`last_name`,`email`,`password`,`phone`,`country`,`role_id`)
        VALUES ('$first_name','$last_name','$email','$pass','$phone','$country','$role')";
        print_r($insert_query);
        exit;
        $result = mysqli_query($con, $insert_query);
        if ($result == 1)
        {
            $success_message = "User Sucessfully Registered";
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
    "AG" => "Antigua and Barbuda");
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

