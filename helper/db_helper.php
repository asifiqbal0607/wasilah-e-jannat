
<?php
define('DB_CON', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'task_manager');

$con = mysqli_connect(DB_CON, USERNAME, PASSWORD, DB_NAME);

if (!$con)
{
    echo "unable to connect";
}