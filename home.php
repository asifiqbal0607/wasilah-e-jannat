

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

<head>

<title> Task Manager - Welcome User </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <link href="<?=APPLICATION_URL . 'css/global.css';?>" rel="stylesheet">

     <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
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
            <div class="col-xl-3 col-md-6 mb-4">
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

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
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

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

</div>

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

            <a  type="button" class="btn btn-link" name="Process" href="home.php?userid=<?=$user_row['id']?>&status=1">Amount Confirm</a>
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
$m_query = "SELECT SUM(amount) as total_amount FROM funding";
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
</dive>


<?php include_once '../wasilah-e-jannat/shared/footer.php';?>