
<?php
define('DB_CON', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'wasilah-e-jannat');

$con = mysqli_connect(DB_CON, USERNAME, PASSWORD, DB_NAME);

if (!$con)
{
    echo "unable to connect";
}