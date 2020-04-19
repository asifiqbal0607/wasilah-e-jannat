<?php include_once '../wasilah-e-jannat/shared/header.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>

<?php
$added_by = $_SESSION['id'];
$conf_query = "SELECT * FROM fund_raiser INNER JOIN funding ON fund_raiser.id=funding.added_by";
$result = mysqli_query($con, $conf_query);

// Query for total Amount of all fundraisers!

?>
<!DOCTYPE html>
<html lang="en">

<div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-8 mb-5">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-8 mb-5">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-8 mb-5">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                </div>
</html>
<div class="table-responsive">
<?php
if ($_SESSION['role_id'] == 1)
{
    ?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
            <tr>
                <th>Fund Raiser</th>
                <th>Donor Name</th>
                <th>Purpose</th>
                <th>Amount Confirm</th>
                <th>Total Funding</th>
            </tr>
                </thead>
                <tbody>
            <?php if (!$result)
    {
        ?>
                <tr>
                    <td>No record found.</td>
                </tr>
                <?php }
    else
    {
        while ($user_row = mysqli_fetch_assoc($result))
        {
            ?>
                <tr>
                <td><?=$user_row['first_name']?> </td>
                <td><?=$user_row['donor']?> </td>
                <td><?=$user_row['purpose']?></td>
                <td>
                <?php
if ($user_row['fund_confirmation'] == 0): ?>

            <a  type="button" class="btn btn-link" name="Process" href="home.php?fund_id=<?=$user_row['fund_id']?>&status=1">Amount Confirm</a>
            <?php
else:
            ?>


            <?php
endif;
            ?>
</td>
                <td><?=$user_row['amount']?></td>

                </tr>
<?php
}
    }
    ?>
</tbody>
<?php
$m_query = "SELECT SUM(amount) as total_amount FROM funding where fund_confirmation=1";
    $user_row = mysqli_query($con, $m_query);
    $result = mysqli_fetch_array($user_row);
    $sum = $result['total_amount'];
    ?>
<tr>
<td style="font-weight:bold">Total Amount</td>
<td style="text-align: center">-------</td>
<td style="text-align: center">-------</td>
<td style="text-align: center">-------</td>
<td><?php echo $sum; ?></td>
</tr>
    </table>
    <?php
}
?>
</div>



<?php
if (isset($_GET['fund_id']))
{
    $user_id = $_GET['fund_id'];
    $user_status = $_GET['status'];

    $fund_approval_query = "UPDATE funding SET fund_confirmation = $user_status WHERE fund_id = $user_id";
    $update_result = mysqli_query($con, $fund_approval_query);

    if ($update_result == 1)
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