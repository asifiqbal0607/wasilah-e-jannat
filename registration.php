<?php include_once '../task_manager/helper/path_helper.php';?>
<?php include_once '../task_manager/shared/header.php';?>
<?php include_once '../task_manager/helper/db_helper.php';?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $error_message = "";
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $phone = $_POST['phone'];
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];
    $role = $_POST['role_id'];
    $is_valid = true;
    if ($first_name == "")
    {
        $firstname_error = "Please Enter the First Name";
        $is_valid = false;
    }
    if ($last_name == "")
    {
        $lastname_error = "Please Enter the Last Name";
        $is_valid = false;
    }
    if ($email == "")
    {
        $email_error = "Please Enter the Email";
        $is_valid = false;
    }
    if ($pass == "")
    {
        $pass_error = "Please Enter the Password";
        $is_valid = false;
    }
    if ($pass != $cpass)
    {
        $cpass_error = "Password Doesn't match";
    }
    if ($phone == "")
    {
        $phone_error = "Please Enter the Phone Number";
        $is_valid = false;
    }
    if ($cnic == "")
    {
        $cnic_error = "Please Enter the CNIC Number";
        $is_valid = false;
    }
    if ($address == "")
    {
        $address_error = "Please Enter the Address";
        $is_valid = false;
    }
    if ($role == "")
    {
        $role_error = "Please Choose Role ID!";
        $is_valid = false;
    }

    if ($is_valid == true)
    {
        $email_query = "Select * from users where email='$email'";
        $result = mysqli_query($con, $email_query);
        if ($result->num_rows == 0)
        {

            $insert_query = "Insert into users(`first_name`,`last_name`,`email`,`password`,`phone`,`cnic`,`address`,`role_id`) VALUES ('$first_name','$last_name','$email','$pass','$phone','$cnic','$address','$role')";
            $insert_result = mysqli_query($con, $insert_query);
            if ($insert_result == 1)
            {
                $success_message = "User added successfully!";
            }
            else
            {
                $error_message = "Unable to add User";
            }
        }
        else
        {
            $error_message = "Email already exists";
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
        <input type="number" onKeyPress="if(this.value.length==10) return false;" value="<?php echo isset($phone) ? $phone : '' ?>" name="phone" class="form-control" placeholder="Your Phone *">
        <p style="color: red;"><?php echo isset($phone_error) ? $phone_error : '' ?></p>

    </div>
    <div class="form-group">
        <input type="number"  onKeyPress="if(this.value.length==13) return false;" value="<?php echo isset($cnic) ? $cnic : '' ?>" name="cnic" class="form-control" placeholder="Your CNIC *">
        <p style="color: red;"><?php echo isset($cnic_error) ? $cnic_error : '' ?></p>

    </div>

    <div class="form-group">
        <input type="text" name="address" value="<?php echo isset($address) ? $address : '' ?>" class="form-control" placeholder="Enter Address Here *">
        <p style="color: red;"> <?php echo isset($address_error) ? $address_error : '' ?></p>
    </div>

    <div>
         <select class="form-control" name="role_id">
            <option value="">Please select your Role</option>
            <option value="1">Admin</option>
            <option value="2">Manager</option>
            <option value="3">Resource</option>
        </select>
        <p style="color: red;"><?php echo isset($role_error) ? $role_error : '' ?></p>
        <p style="color: red;"><?php echo isset($error_message) ? $error_message : '' ?></p>
        <p style="color: green;"><?php echo isset($success_message) ? $success_message : '' ?></p>
    </div>

        <input type="submit" class="btn btn-primary reg-btn" value="Register">
    </div>
</div>
    <?php include_once '../task_manager/shared/footer.php';?>
</form>

