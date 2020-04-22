<?php include_once '../wasilah-e-jannat/shared/header.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>

<?php
if ($_SESSION['role_id'] == 1)
{
    $donor_pending_query = "SELECT * FROM funding WHERE fund_confirmation = 0";

}
else
{
    $donor_pending_query = "SELECT * FROM funding WHERE fund_confirmation = 0 AND added_by= " . $_SESSION['id'];
}
$donor_result = mysqli_query($con, $donor_pending_query);

?>






<div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th>Donor Name</th>
                <th>Collect Amount</th>
                <th>Currency</th>
                <th>Purpose</th>
                <th>Date Of Collection</th>
            </tr>
                </thead>
                <tbody>

<?php if (!$donor_result)
{
    ?>
    <tr>
        <td>No record found.</td>
    </tr>
    <?php }
else
{
    while ($user_row = mysqli_fetch_assoc($donor_result))
    {
        ?>

<tr>

<td><?=$user_row['donor']?> </td>
<td><?=$user_row['amount']?></td>
<td><?=$user_row['currency']?></td>
<td><?=$user_row['purpose']?></td>
<td><?=$user_row['date']?></td>
</tr>
<?php
}
}
?>

</tbody>
                </table>
</div>








<?php include_once '../wasilah-e-jannat/shared/footer.php';?>