<?php
include "connection.php";

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

<?php

include "connection.php";

session_start();
session_unset();
session_destroy();

header("Location: login.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">
</head>
<body>
    <script>
        window.location.reload();
    </script>
</body>
</html>