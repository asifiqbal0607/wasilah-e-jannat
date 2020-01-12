<?php include_once '../task_manager/helper/db_helper.php';?>

<?php

?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="row register-form">
 <div class=" offset-2 col-md-8">
 <input type="hidden" name="id" value="<?=$user_update->id ?? '';?>">
    <div class="form-group">
         <input type="text" class="form-control" value="<?=$user_update->first_name ?? '';?>" name="first_name" placeholder="First Name *">
         <p style="color: red;"><?php echo isset($firstname_error) ? $firstname_error : '' ?></p>

    </div>
    <div class="form-group">
         <input type="text" class="form-control" value="<?=$user_update->last_name ?? '';?>" name="last_name" placeholder="Last Name *">
         <p style="color: red;"><?php echo isset($lastname_error) ? $lastname_error : '' ?></p>

    </div>
    <div class="form-group">
      <input type="text" name="email" value="<?=$user_update->email ?? '';?>" class="form-control" placeholder="Email *">
      <p style="color: red;"><?php echo isset($email_error) ? $email_error : '' ?></p>

     </div>
    <div class="form-group">
        <input type="password" name="password" value="<?=$user_update->password ?? '';?>" class="form-control" placeholder="Password *">
        <p style="color: red;"><?php echo isset($pass_error) ? $pass_error : '' ?></p>

    </div>

    <div class="form-group">
         <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password *">
         <p style="color: red;"><?php echo isset($cpass_error) ? $cpass_error : '' ?></p>
    </div>

    <div class="form-group">
        <input type="number" value="<?=$user_update->phone ?? '';?>" onKeyPress="if(this.value.length==11) return false;" name="phone" class="form-control" placeholder="Your Phone *">
        <p style="color: red;"><?php echo isset($phone_error) ? $phone_error : '' ?></p>

    </div>
    <div class="form-group">
        <input type="number" value="<?=$user_update->cnic ?? '';?>"  onKeyPress="if(this.value.length==13) return false;" name="cnic" class="form-control" placeholder="Your CNIC *">
        <p style="color: red;"><?php echo isset($cnic_error) ? $cnic_error : '' ?></p>

    </div>

    <div class="form-group">
        <input type="text" name="address" value="<?=$user_update->address ?? '';?>" class="form-control" placeholder="Enter Address Here *">
        <p style="color: red;"> <?php echo isset($address_error) ? $address_error : '' ?></p>
    </div>
<?php $app_roles =
// array(
//     "1" => "Admin",
//     "2" => "Manager",
//     "3" => "Resource",
// );
$get_roles_query = "SELECT * FROM role_type";
$roles_result = mysqli_query($con, $get_roles_query);
?>
    <div>
        <?php /* <select class="form-control" name="role_id">
<option value="">Please select your Role</option>
<option value="1" <?php echo $user_update->role_id == "1" ? "selected='selected'" : "" ?>>Admin</option>
<option value="2" <?php echo $user_update->role_id == "2" ? "selected='selected'" : "" ?>>Manager</option>
<option value="3 <?php echo $user_update->role_id == "3" ? "selected='selected'" : "" ?>">Resource</option>
</select>
 */?>
         <select class="form-control" name="role_id">
            <option value="">Please select your Role</option>
            <?php while ($row = mysqli_fetch_assoc($roles_result))
{
    ?>
            <option value="<?php echo $row['id']; ?>" <?php echo $user_update->role_id == $row['id'] ? "selected='selected'" : "" ?>>
                <?php echo $row['roles']; ?>
            </option>
            <?php
}
?>
        </select>
        <p style="color: red;"><?php echo isset($role_error) ? $role_error : '' ?></p>
        <p style="color: red;"><?php echo isset($error_message) ? $error_message : '' ?></p>
        <p style="color: green;"><?php echo isset($success_message) ? $success_message : '' ?></p>
    </div>

        <input type="submit" name="update" class="btn btn-primary reg-btn" value="Update">
    </div>
</div>
    <?php include_once '../task_manager/shared/footer.php';?>
</form>

