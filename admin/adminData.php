<?php

// session_start();

$AccountNo = $_SESSION['accountNo'];

$query = "SELECT * FROM customer_detail WHERE Account_No = '$AccountNo'";

$Admin = null;
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $Fname = $row['C_First_Name'];
        $Lname = $row['C_Last_Name'];
        $MobileNo = $row['C_Mobile_No'];
        $Profile = $row['ProfileImage'];
    }

    $Admin = $Fname . " " . $Lname;
    $AdminProfile = "img/admin.svg";
    $AdminProfileInner = $AdminProfile;
}
