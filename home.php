<?php include_once '../wasilah-e-jannat/shared/header.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>

<?php
$added_by = $_SESSION['id'];
//$conf_query = "SELECT * FROM fund_raiser INNER JOIN funding ON fund_raiser.id=funding.added_by";
$conf_query = "SELECT distinct added_by FROM funding where fund_confirmation = 1";
$result = mysqli_query($con, $conf_query);
$user_data = array();
while ($user_row = mysqli_fetch_assoc($result))
{
    $user_row_dd = $user_row["added_by"];

    $user_fund_query = mysqli_query($con, "SELECT * FROM fund_raiser INNER JOIN funding ON fund_raiser.id=funding.added_by
    WHERE added_by = $user_row_dd AND fund_confirmation = 1");
    $user_total_data = array('user_amount' => 0);
    $amount = 0;
    while ($user_row_data = mysqli_fetch_assoc($user_fund_query))
    {
        if (!array_key_exists('fund_raiser', $user_total_data))
        {
            $user_total_data['fund_raiser'] = $user_row_data['first_name'];
            $user_total_data['added_by'] = $user_row_data['added_by'];
            $user_total_data['fund_donor'] = $user_row_data['donor'];
            $user_total_data['fund_purpose'] = $user_row_data['purpose'];
            $user_total_data['fund_currency'] = $user_row_data['currency'];

        }
        if ($user_row_data['currency'] == "PKR")
        {
            $user_total_data['user_amount'] += ($user_total_data['user_amount']);
        }
        else
        {
            $user_total_data['user_amount'] += ($user_row_data['amount'] * $user_row_data['rates']);
        }

    }
    array_push($user_data, $user_total_data);

}

?>

<div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-8 mb-5">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
$amount_query = "SELECT SUM(amount) as total_amount FROM funding where fund_confirmation=1";
$result_total = mysqli_query($con, $amount_query);
$result_t = mysqli_fetch_assoc($result_total);
$sum = $result_t['total_amount'];
echo "PKR" . '&nbsp' . $sum;
?>

                      </div>
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
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                      <a href="pending_funds.php">Pending Requests</a>
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php
if ($_SESSION['role_id'] == 1)
{
    $pending_query = "SELECT * FROM funding WHERE fund_confirmation = 0";

}
else
{
    $pending_query = "SELECT * FROM funding WHERE fund_confirmation = 0 AND added_by= " . $_SESSION['id'];
}

// $pending_query = "SELECT * FROM funding WHERE fund_confirmation = 0 AND added_by= " . $_SESSION['id'];
$result_pending = mysqli_query($con, $pending_query);
$result_pen = mysqli_num_rows($result_pending);
echo $result_pen;

?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                </div>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

<thead>
<tr>

<th>Fund Raiser</th>
<th>Purpose</th>
<th>Currency</th>
<th>Total Funding</th>
<th>Funding Detail</th>
</tr>
</thead>
<tbody>
<?php
foreach ($user_data as $row)
{
    ?>
          <tr>

                <td><?=$row['fund_raiser']?> </td>
                <td><?=$row['fund_purpose']?></td>
                <td><?=$row['fund_currency']?></td>
                <td><?=$row['user_amount']?></td>
                <td>

                <a type="button" class="btn btn-link" name="fund_detail" href="fund_detail.php?id=<?=$row['added_by']?>">Fund Detail</a></td>
          </tr>


  <?php
}

?>

</tbody>

                </table>

                <?php include_once '../wasilah-e-jannat/shared/footer.php';?>
