<?php

// Defining constant php variable for local host

define('DB_host', 'localhost');
define('DB_username', 'id20461249_safebnk_user');
define('DB_password', 'n9<XL)A1[8xarITn');
define('DB_name', 'id20461249_safebnk');
$conn = mysqli_connect(DB_host, DB_username, DB_password, DB_name);



if (!$conn) {
    echo "Connection Fail ---> " . die("connection failed" . mysqli_connect_error());
}

?>