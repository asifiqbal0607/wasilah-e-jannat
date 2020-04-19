<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/shared/header.php';?>

<?php
$added_by = $_SESSION['id'];
$sel_query = "SELECT * FROM funding WHERE added_by=$added_by";
$sel_result = mysqli_query($con, $sel_query);

//$result = mysqli_fetch_array($sel_result);
// echo '<pre>', print_r($result), '</pre>';
// exit;

// Query for total Amount of all donors!
$m_query = "SELECT SUM(amount) as soma FROM funding WHERE added_by=$added_by";
$user_row = mysqli_query($con, $m_query);
$result = mysqli_fetch_array($user_row);
$sum = $result['soma'];
?>


<div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
            <tr>

                <th>Donor Name</th>
                <th>Purpose</th>
                <th>Currency</th>
                <th>Amount</th>
            </tr>
                </thead>
                <tbody>
            <?php if (!$sel_result)
{
    ?>
                <tr>
                    <td>No record found.</td>
                </tr>
                <?php }
else
{
    while ($user_row = mysqli_fetch_assoc($sel_result))
    {

        ?>
                <tr>
                <td><?=$user_row['donor']?> </td>
                <td><?=$user_row['purpose']?></td>
                <td><?=$user_row['currency']?></td>
                <td><?=$user_row['amount']?></td>
                </tr>


<?php

    }

}
?>

</tbody>
<tr>
<td style="font-weight:bold">Total Amount</td>
<td style="text-align: center">-------</td>
<td style="text-align: center">-------</td>
<td><?php echo $sum; ?></td>
</tr>

                </table>
                <table><tr>

</div>

<?php include_once '../wasilah-e-jannat/shared/footer.php';?>