<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/shared/header.php';?>

<?php
$fund_raiser_id = $_GET['id'];
$fund_detail_query = "SELECT * FROM funding WHERE added_by = $fund_raiser_id";
$result = mysqli_query($con, $fund_detail_query);
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
            <tr>
                <th>Donor Name</th>
                <th>Purpose</th>
                <th>Amount</th>
                <th>Currency Rate</th>
                <th>Currency</th>
                <th>Date Of Donation</th>
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
    while ($fund_raiser_id = mysqli_fetch_assoc($result))
    {
        ?>

        <tr>

            <td><?=$fund_raiser_id['donor']?> </td>
            <td><?=$fund_raiser_id['purpose']?></td>
            <td><?=$fund_raiser_id['amount']?></td>
            <td><?=$fund_raiser_id['rates']?></td>
            <td><?=$fund_raiser_id['currency']?></td>
            <td><?=$fund_raiser_id['date']?></td>
            <td>

            </td>


            <?php
}

    ?>



</tbody>
    </table>
    <?php
}

?>
</div>
<?php include_once '../wasilah-e-jannat/shared/footer.php';?>