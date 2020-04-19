<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/shared/header.php';?>

<?php
$user_query = "SELECT fund_raiser.id,fund_raiser.first_name,fund_raiser.last_name,fund_raiser.email,fund_raiser.password,
fund_raiser.phone,fund_raiser.country,fund_raiser.user_approval,admin.roles FROM fund_raiser INNER JOIN admin ON fund_raiser.role_id=admin.id";
$result = mysqli_query($con, $user_query);

?>

<div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
            <tr>

                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>Roles</th>
                <th>Actions</th>
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
            <td><?=$user_row['last_name']?></td>
            <td><?=$user_row['email']?></td>
            <td><?=$user_row['phone']?></td>
            <td><?=$user_row['country']?></td>
            <td><?=$user_row['roles']?></td>
            <td>
            <?php
if ($user_row['user_approval'] == 0): ?>

            <a  type="button" class="btn btn-secondary" name="Process" href="approval.php?userid=<?=$user_row['id']?>&status=1">Approve</a>
            <?php
else:
        ?>
        <a  type="button" class="btn btn-secondary" name="Process" href="approval.php?userid=<?=$user_row['id']?>&status=0">Diss Approve</a>


            <?php
endif;
        ?>
            </td>
        </tr>

<?php
}
}
?>
                </tbody>
        </table>
</div>
<?php include_once '../wasilah-e-jannat/shared/footer.php';?>

<?php
if (isset($_GET['userid']))
{
    $user_id = $_GET['userid'];
    $user_status = $_GET['status'];

    $approval_query = "UPDATE fund_raiser SET user_approval = $user_status WHERE id = $user_id";
    $update_result = mysqli_query($con, $approval_query);

    if ($update_result == 1)
    {
        $success_message = "User Sucessfully Approved";
    }
    else
    {
        $error_message = "Unable to Approve User!";
    }

}

?>
























<?php include_once '../wasilah-e-jannat/shared/footer.php';?>
