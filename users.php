<?php include_once '../task_manager/helper/path_helper.php';?>
<?php include_once '../task_manager/shared/header.php';?>
<?php include_once '../task_manager/helper/db_helper.php';?>
<?php include_once '../task_manager/shared/footer.php';?>


<html>


<?php
$query = "SELECT users.id,users.first_name,users.last_name,users.email,users.phone,users.address,users.cnic,role_type.roles FROM users
INNER JOIN role_type ON users.role_id=role_type.id";
$result = mysqli_query($con, $query);
?>

        <table class="table">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>CNIC</th>
                <th>Address</th>
                <th>Roles</th>
            </tr>

            <?php if (!$result)
{
    ?>
                <tr>
                    <td>No record found.</td>
                </tr>
            <?php
}
else
{
    while ($row = mysqli_fetch_assoc($result))
    {
        ?>
    <tr>
        <td><?=$row['first_name']?></td>
        <td><?=$row['last_name']?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['phone']?></td>
        <td><?=$row['cnic']?></td>
        <td><?=$row['address']?></td>
        <td><?=$row['roles']?></td>
    </tr>

    <?php

    }
}

?>
</table>