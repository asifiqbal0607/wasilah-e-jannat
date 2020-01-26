<?php include_once '../wasilah-e-jannat/helper/db_helper.php';?>
<?php include_once '../wasilah-e-jannat/helper/path_helper.php';?>
<?php include_once '../wasilah-e-jannat/shared/header.php';?>

<?php

$user_query = "SELECT fund_raiser.id,fund_raiser.first_name,fund_raiser.last_name,fund_raiser.email,fund_raiser.password,fund_raiser.phone,fund_raiser.country,
admin.roles FROM fund_raiser INNER JOIN admin ON fund_raiser.role_id=admin.id";
$result = mysqli_query($con, $user_query);

?>

<div class="table-responsive">
        <table class="table">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>Roles</th>
            </tr>

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
            <td class="hide_id"><?=$user_row['id']?></td>
            <td><?=$user_row['first_name']?> </td>
            <td><?=$user_row['last_name']?></td>
            <td><?=$user_row['email']?></td>
            <td><?=$user_row['phone']?></td>
            <td><?=$user_row['country']?></td>
            <td><?=$user_row['roles']?></td>
            <td>
         <select class="dropdown-item" name="user_approval">
            <option value="">User Status</option>
            <option value="0">Diss Approval</option>
            <option value="1">Approval</option>
        </select></td>
        <td><input type ="submit" value="Process"></td>

        </tr>


<?php
}
}
?>
        </table>




























<?php include_once '../wasilah-e-jannat/shared/footer.php';?>
