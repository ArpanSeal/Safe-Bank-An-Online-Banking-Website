<?php
    $query = "SELECT * FROM login WHERE Status='Inactive'";
    $result = mysqli_query($conn, $query) or die("query fail");
    $count = mysqli_num_rows($result);
?>