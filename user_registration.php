

<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/shared/header.php';?>

<?php

if (isset($_POST['btn_regis']))
{
    $error_message = "";
    $added_by = $_SESSION['id'];
    $donor = $_POST['donor'];
    $amount = $_POST['amount'];
    $currency = $_POST['currency'];
    $purpose = $_POST['purpose'];
    $is_valid;

    if ($donor == "")
    {
        $donor_error = "Please Enter Donor Name";
        $is_valid = false;
    }

    if ($amount == "")
    {
        $amount_error = "Please Enter Your Amount";
        $is_valid = false;
    }
    if ($currency == "")
    {
        $currency_error = "Please Select Your Currency";
        $is_valid = false;
    }
    if ($purpose == "")
    {
        $purpose_error = "Please Enter Purpose For Donation";
        $is_valid = false;
    }
    date_default_timezone_set('Asia/Karachi');
    $date = date("Y-m-d H:i:s");
    $don_query = "insert into funding(`added_by`,`donor`,`amount`,`currency`,`purpose`,`date`)VALUES('$added_by','$donor','$amount','$currency','$purpose','$date')";
    $don_result = mysqli_query($con, $don_query);

    if ($don_result == 1)
    {
        $success_message = "Doner Sucessfully Registered";
    }
    else
    {
        $error_message = "Unable to Add Donor !";
    }

}

?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="row register-form">
<div class=" offset-2 col-md-8">
   <div class="form-group">
   <label for="amount">Donor<span class="error" style="font-size: 15px;color:red">*</span> </label>
        <input type="text" class="form-control" value="<?php echo isset($donor) ? $donor : '' ?>" name="donor" placeholder="Bill Gates">
        <p style="color: red;"><?php echo isset($donor_error) ? $donor_error : '' ?></p>
   </div>


    <div class="form-group">
        <label for="amount">Amonut<span class="error" style="font-size: 15px;color:red">*</span> </label>
        <input type="number" class="form-control" value="<?php echo isset($amount) ? $amount : '' ?>" name="amount" placeholder="$1000">
        <p style="color: red;"><?php echo isset($amount_error) ? $amount_error : '' ?></p>
        </div>



        <div class="form-group">
        <label for="amount">Currency<span class="error" style="font-size: 15px;color:red">*</span> </label>
        <select name="currency" value="<?php echo isset($currency) ? $currency : '' ?>" id="" class="form-control">
        <option value="">Please select your Currency</option>
            <option value="PKR">Pakistan (PKR)</option>
            <option value="SR">SaudiArabia (SR)</option>
            <option value="AED">UAE (AED)</option>
            <option value="AUD">Australia (AUD)</option>
            <option value="NOK">Norway (NOK)</option>
            <option value="GBP">Great Britain (GBP)</option>
        </option>
        </select>
        <p style="color: red;"><?php echo isset($amount_error) ? $amount_error : '' ?></p>
        </div>


   <div class="form-group">
   <label for="amount" >Purpose<span class="error" style="font-size: 15px;color:red">*</span> </label>
   <textarea class="form-control" id="w3mission" value="<?php echo isset($purpose) ? $purpose : '' ?>" name="purpose" rows="4" cols="87">
</textarea>
<p style="color: red;"><?php echo isset($purpose_error) ? $purpose_error : '' ?></p>
    </div>


       <input type="submit" name="btn_regis" class="btn btn-primary reg-btn" value="Register">
       <p style="color: red;"><?php echo isset($success_message) ? $success_message : '' ?></p>
       <p style="color: red;"><?php echo isset($error_message) ? $error_message : '' ?></p>

   </div>
</div>

</form>

<?php include_once '../wasilah-e-jannat/shared/footer.php';?>