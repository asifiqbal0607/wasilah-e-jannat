<?php include_once '../wasilah-e-jannat/shared/header.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<div class="row register-form">
<div class=" offset-2 col-md-8">
   <div class="form-group">
   <label for="amount_confirm">Please Enter Currency Exchange Rate<span class="error" style="font-size: 15px;color:red">*</span> </label>
        <input type="number" class="form-control" value="" name="amount_confirm" placeholder="Exchange Rate">

   </div>

   <a  type="button" class="btn btn-link" name="Amount Confirm" href="home.php">Amount Confirm</a>


</div>
</div>
</form>



<?php include_once '../wasilah-e-jannat/shared/footer.php';?>
