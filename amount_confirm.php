<?php include_once '../wasilah-e-jannat/shared/header.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="row register-form">
<div class=" offset-2 col-md-8">
   <div class="form-group">
   <label for="amount_confirm">Please Enter Currency Exchange Rate<span class="error" style="font-size: 15px;color:red">*</span> </label>
        <input type="number" min="0.01" max="2500" value="1.00" required class="form-control" name="amount" placeholder="Exchange Rate">
   </div>
   <!-- <a  type="button" class="btn btn-primary" name="amount_confirm">Amount Confirm</a> -->

   <input type="hidden" name="fund_id" value="<?=$_GET['fund_id'] ?? '';?>">
   <input type="submit" name="amount_confirm" class="btn btn-primary reg-btn" value="Amount Confirm">
</div>
</div>
</form>

<?php

if (isset($_POST['amount_confirm']))
{
    $fund_id = $_POST['fund_id'];
    $amount_confirm = $_POST['amount'];
    $amount_query = "UPDATE funding SET rates = $amount_confirm, fund_confirmation=1 WHERE fund_id = $fund_id";
    $result_amount = mysqli_query($con, $amount_query);

    if ($result_amount == 1)
    {
        $success_message = "User Sucessfully Amount Confirmed";
        echo "<script>window.location.href='home.php'</script>";
    }
    else
    {
        $error_message = "Unable to Approve User Amount!";
    }
}

?>

<?php include_once '../wasilah-e-jannat/shared/footer.php';?>
