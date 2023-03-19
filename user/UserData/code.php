<?php
include "../connection.php";
session_start();

$username = $_SESSION['username'];
// echo $username;
$AcNo = $_SESSION['AccountNo'];


// echo "run";

// ------------------------------------------------------- DASHBOARD DETAILS-------------------------------------

// if (isset($_POST['BalanceCheck'])) {
//     // Dashnoard / Query to get Total Balane and saving and AccountNO
//     $query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE login.Username = '$username'";
//     $result = mysqli_query($conn, $query) or mysqli_error($conn);

//     if (mysqli_num_rows($result) > 0) {
//         while ($row = mysqli_fetch_assoc($result)) {

//             $Balance = $row['Balance'];
//             $Saving = $row['SavingBalance'];
//             $AccountNo = $row['AccountNo'];
//         }


//         // Dashnoard / Query to get last Month Credit data
//         $CreditQery = "SELECT * FROM transaction WHERE month(Date)=month(now()) AND Status = 'Credited' AND AccountNo = '$AccountNo'";

//         $CreditResult = mysqli_query($conn, $CreditQery) or mysqli_error($conn);
//         $CreditTotal = '0';
//         if (mysqli_num_rows($CreditResult) > 0) {
//             while ($row = mysqli_fetch_assoc($CreditResult)) {

//                 $CreditAmount = $row['Amount'];

//                 $CreditTotal = $CreditTotal + $CreditAmount;
//             }
//             $CreditTotal;
//         }


//         // Dashnoard / Query to get last Month Debit data
//         $DebitQery = "SELECT * FROM transaction WHERE month(Date)=month(now()) AND Status = 'Debited' AND AccountNo = '$AccountNo'";

//         $DebitResult = mysqli_query($conn, $DebitQery) or mysqli_error($conn);
//         $DebitTotal = '0';
//         if (mysqli_num_rows($DebitResult) > 0) {
//             while ($row = mysqli_fetch_assoc($DebitResult)) {

//                 $DebitAmount = $row['Amount'];

//                 $DebitTotal = $DebitTotal + $DebitAmount;
//             }
//             $DebitTotal;
//         }


//         // Dashnoard / Query to get this Month Credit data
//         $CreditThisMonthResult = mysqli_query($conn, "SELECT * FROM transaction WHERE DateTime >= (LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 1 MONTH) AND DateTime < (LAST_DAY(NOW()) + INTERVAL 1 DAY) AND AccountNo='$AccountNo' AND Status='Credited'") or mysqli_error($conn);
//         $CreditThisMonthTotal = '0';
//         if (mysqli_num_rows($CreditThisMonthResult) > 0) {
//             while ($row = mysqli_fetch_assoc($CreditThisMonthResult)) {

//                 $CreditThisMonthAmount = $row['Amount'];

//                 $CreditThisMonthTotal = $CreditThisMonthTotal + $CreditThisMonthAmount;
//             }
//             $CreditThisMonthTotal;
//         }

//         // Dashnoard / Query to get this Month Debit data

//         $DebitThisMonthResult = mysqli_query($conn, "SELECT * FROM transaction WHERE DateTime >= (LAST_DAY(NOW()) + INTERVAL 1 DAY - INTERVAL 1 MONTH) AND DateTime < (LAST_DAY(NOW()) + INTERVAL 1 DAY) AND AccountNo='$AccountNo' AND Status='Debited'") or mysqli_error($conn);
//         $DebitThisMonthTotal = '0';
//         if (mysqli_num_rows($DebitThisMonthResult) > 0) {
//             while ($row = mysqli_fetch_assoc($DebitThisMonthResult)) {

//                 $DebitThisMonthAmount = $row['Amount'];

//                 $DebitThisMonthTotal = $DebitThisMonthTotal + $DebitThisMonthAmount;
//             }
//             $DebitThisMonthTotal;
//         }



//         $data = array(
//             'Balance' => $Balance,
//             'Saving' => $Saving,
//             'AccountNo' => $AccountNo,
//             'CreditTotal' => $CreditTotal,
//             'DebitTotal' => $DebitTotal,
//             'CreditThisMonth' => $CreditThisMonthTotal,
//             'DebitThisMonth' => $DebitThisMonthTotal

//         );

//         echo json_encode($data);
//     } else {
//         echo "No Return";
//     }
// }



// ------------------------------------------------------- TRANSFER MONEY -------------------------------------

// Receiver Details Ajax

if (isset($_POST['AcNo'])) {
    $CAccountNo = $_POST['AcNo'];

    $query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE customer_detail.Account_No = '$CAccountNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $Fname = $row['C_First_Name'];
            $Lname = $row['C_Last_Name'];
            $MobileNo = $row['C_Mobile_No'];
            $Balance = $row['Balance'];
            $Status = $row['Status'];
        }

        $flag = "success";

        $Customerdata = array(

            'Flag' => $flag,
            'Fname' => $Fname,
            'Lname' => $Lname,
            'MobileNo' => $MobileNo,
            'Balance' => $Balance,
            'Status' => $Status
        );

        echo json_encode($Customerdata);
    } else {
        $flag = "fail";
        $Customerdata = array(
            'Flag' => $flag

        );

        echo json_encode($Customerdata);
    }
}


// Checking Status 
if (isset($_POST['AcState'])) {
    $AccountNo = $_POST['AcState'];

    $query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE customer_detail.Account_No = '$AccountNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $Status = $row['Status'];
        }

        echo $Status;
    } else {
        echo "fail";
    }
}


// Sending Money to receiver
if (isset($_POST['DepositAc'])) {
    $ReceiverAc = $_POST['DepositAc'];
    $Amount = $_POST['MainAmount'];
    $SenderAc = $AcNo;

    if ($Amount > 0) {

        if ($SenderAc == $ReceiverAc) {
            echo "Can't Transfer Money in same account";
        } else {
            $SenderResult = mysqli_query($conn, "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE customer_detail.Account_No = '$SenderAc'") or die(mysqli_error($conn));
            if (mysqli_num_rows($SenderResult) > 0) {

                while ($row = mysqli_fetch_assoc($SenderResult)) {
                    $SStatus = $row['Status'];
                    $SBalance = $row['Balance'];
                    $SName = $row['C_First_Name'];
                    $SLName = $row['C_Last_Name'];
                    $SEmail = $row['C_Email'];
                    $SProColor = $row['ProfileColor'];
                }
                $ReceiverResult = mysqli_query($conn, "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE customer_detail.Account_No = '$ReceiverAc'") or die(mysqli_error($conn));
                if (mysqli_num_rows($ReceiverResult) > 0) {
                    while ($row = mysqli_fetch_assoc($ReceiverResult)) {
                        $RStatus = $row['Status'];
                        $RBalance = $row['Balance'];
                        $RName = $row['C_First_Name'];
                        $RLName = $row['C_Last_Name'];
                        $REmail = $row['C_Email'];
                        $RProColor = $row['ProfileColor'];
                    }

                    if ($SBalance != "0") {
                        if ($SBalance > $Amount) {

                            if ($SStatus == "Active" && $RStatus == "Active") {


                                (string)$Rtotal = (float)$Amount + (float)$RBalance;
                                (string)$Stotal = (float)$SBalance - (float)$Amount;
                                $SenderName = $SName . " " . $SLName;
                                $ReceiverName = $RName . " " . $RLName;
                                $DebitAmount = '-' . $Amount;

                                // Check How to roll back perform testing and send email both side

                                try {

                                    mysqli_begin_transaction($conn);

                                    mysqli_query($conn, "UPDATE accounts SET Balance='$Rtotal' WHERE AccountNo = '$ReceiverAc'") or die(mysqli_error($conn));
                                    mysqli_query($conn, "UPDATE accounts SET Balance='$Stotal' WHERE AccountNo = '$SenderAc'") or die(mysqli_error($conn));
                                    mysqli_query($conn, "INSERT INTO transaction(AccountNo, FAccountNo, Name, Amount, Status, ProfileColor, Credit, Debit) VALUES ('$ReceiverAc', '$SenderAc','$SenderName', '$Amount', 'Credited', '$SProColor',$Amount,'0.0')");
                                    mysqli_query($conn, "INSERT INTO transaction(AccountNo, FAccountNo, Name, Amount, Status, ProfileColor, Credit, Debit) VALUES ('$SenderAc', $ReceiverAc,'$ReceiverName', '$DebitAmount', 'Debited', '$RProColor', '0.0', $Amount)");
                                    mysqli_commit($conn);

                                    $datetime = date("d/m/Y : H/M/S");
                                    $Rmasked =  str_pad(substr($ReceiverAc, -4), strlen($ReceiverAc), 'X', STR_PAD_LEFT);
                                    $Smasked =  str_pad(substr($SenderAc, -4), strlen($SenderAc), 'X', STR_PAD_LEFT);
                                    // echo $REmail." ".$RName." ".$Amount." ".$Rtotal." ".$date." ".$masked;

                                    echo "Success";
                                } catch (\Throwable $th) {
                                    mysqli_rollback($conn);
                                    echo "fail";
                                }
                            } else {
                                echo "Transaction Fail";
                            }
                        } else {
                            echo "Transaction Fail. Not Sufficient Balance!";
                        }
                    } else {
                        echo "Transaction Fail. No Money in Your Account!";
                    }
                }
            }
        }
    }
}



// ------------------------------------------------------- SAVING SECTION ------------------------------------

// fetching Basic Details

if (isset($_POST['BasicDetail'])) {
    $query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE customer_detail.Account_No = '$AcNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $SavingBalance = $row['SavingBalance'];
            $SavingTarget = $row['SavingTarget'];
        }

        $data = array(
            'SavingBalance' => $SavingBalance,
            'SavingTarget' => $SavingTarget
        );

        echo json_encode($data);
    } else {
        echo "No Data Found";
    }

    mysqli_close($conn);
}

// Add Amount To saving 


if (isset($_POST['Amount'])) {

    $Amount = $_POST['Amount'];

    $query = "SELECT SavingBalance FROM `accounts` WHERE AccountNo = '$AcNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $row = mysqli_fetch_assoc($result);
    $Saving = $row['SavingBalance'];

    (string)$tot_amount = (float)$Saving + (float)$Amount;

    $query = "UPDATE `accounts` set SavingBalance = '$tot_amount' WHERE AccountNo = '$AcNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    echo "Success";
    mysqli_close($conn);
}


// Saving Target

if (isset($_POST['SavingTarget'])) {

    $SavingTarget = $_POST['SavingTarget'];

    $query = "UPDATE `accounts` set SavingTarget = '$SavingTarget' WHERE AccountNo = '$AcNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    echo "Success";
    mysqli_close($conn);
}


// Transfer Balance

// Transfer Saving to main account

if (isset($_POST['TransferBalance'])) {

    $TransferBalance = $_POST['TransferBalance'];

    $query = "SELECT * FROM `accounts` WHERE AccountNo = '$AcNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    (string)$Saving = (float)$row['SavingBalance'] - (float)$TransferBalance;
    (string)$Balance = (float)$row['Balance'] + (float)$TransferBalance;

    if ($Saving >= 0) {
        $query = "UPDATE `accounts` set Balance = '$Balance' , SavingBalance = '$Saving' WHERE AccountNo = '$AcNo'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        echo "Success";
    } else {
        echo "Transaction Fail. Not Sufficient Balance!";
    }
    mysqli_close($conn);
}


// --------------------------------------------------- Profile Section ------------------------------------------------

if (isset($_POST['profileDetail'])) {

    $query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = '$AcNo' JOIN accounts ON accounts.AccountNo = '$AcNo' WHERE customer_detail.Account_No = '$AcNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $FName = $row['C_First_Name'];
            $LName = $row['C_Last_Name'];
            $ProfileColor = $row['ProfileColor'];
            $ProfileImage = $row['ProfileImage'];
            $Balance = $row['Balance'];
            $SavingBalance = $row['SavingBalance'];
            $AccountNo = $row['Account_No'];
            $MobileNo = $row['C_Mobile_No'];
            $Email = $row['C_Email'];
            $Status = $row['Status'];
            $AccountType = $row['AccountType'];
            $Bio = $row['Bio'];
            $Gender = $row['C_Gender'];
        }

        $TagName = substr($FName, 0, 1);

        $data = array(
            'FName' => $FName,
            'LName' => $LName,
            'ProfileColor' => $ProfileColor,
            'ProfileImage' => $ProfileImage,
            'TagName' =>  $TagName,
            'Balance' =>  $Balance,
            'SavingBalance' => $SavingBalance,
            'AccountNo' =>  $AccountNo,
            'MobileNo' => $MobileNo,
            'Email' => $Email,
            'Status' => $Status,
            'AccountType' => $AccountType,
            'Bio' => $Bio,
            'Gender' => $Gender
        );

        echo json_encode($data);
    } else {
        echo "No Data Found";
    }

    mysqli_close($conn);
}

// Edit Profile

if (isset($_POST['deleteImgAcc'])) {
    $query = "SELECT * FROM customer_detail WHERE Account_No = '$AcNo'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['ProfileImage'] != '') {
            unlink($row['ProfileImage']);
            $query = "UPDATE customer_detail SET ProfileImage= '' WHERE Account_No = '$AcNo'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if ($result) {
                echo "success";
            } else {
                echo "Internal Issue";
            }
        }else{
            echo 'There is no Profile Image!';
        }
    }

    mysqli_close($conn);
}

if (isset($_POST['filesize'])) {
    $fileSize = $_POST['filesize'];
    $fileName = $_POST['filename'];
    $Valid_Extention = array('png', 'jpg', 'jpeg');
    $file_extention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileSize <= 1000000){
        if (in_array($file_extention, $Valid_Extention)) {
            echo "success";
        }
        else{
            echo "Invalid file extention (Only jpg/jpeg/png file is allowed)";
        }
    }
    else{
        echo "File is too large (Size Limit: 1MB)";
    }

    mysqli_close($conn);
}

if (isset($_POST['submit'])) {

    if (!isset($_POST['gender'])) {
        $gender = "Not Defined";
    } else {
        $gender = $_POST['gender'];
    }

    $bio = $_POST['bio'];

    // File Variables
    $Files = $_FILES['upload'];
    $fileName = $Files['name'];
    $fileName = preg_replace('/\s/', '_', $fileName); // replacing space with underscore
    $fileType = $Files['type'];
    $fileError = $Files['error'];
    $fileTempName = $Files['tmp_name'];
    $fileSize = $Files['size'];
    $Up_error = false;
    $Delete_Files = $_POST['delete'];

    $Valid_Extention = array('png', 'jpg', 'jpeg');

    // use built in function ( pathinfo() ) to seprate file name and store them in seprate variable

    $file_extention = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $file_Name = pathinfo($fileName, PATHINFO_FILENAME);

    // Generating unique name with date and time 
    $Unique_Name = $username . $file_Name . "." . $file_extention;

    $query = "UPDATE customer_detail SET C_Gender= '$gender', Bio='$bio' WHERE Account_No = '$AcNo' ";
    mysqli_query($conn, $query) or mysqli_error($conn);


    if (!empty($file_Name)) {

        // Setting file size condition
        if ($fileSize <= 1000000) {

            // checking file extention
            if (in_array($file_extention, $Valid_Extention)) {

                // Destination Variable
                $destinationFile = 'uploadProfileImg/' . $Unique_Name;
                // move_uploaded_file($fileTempName, $destinationFile);
                $query = "SELECT * FROM customer_detail WHERE Account_No = '$AcNo'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['ProfileImage'] != '') {
                        unlink($row['ProfileImage']);
                    }
                }
                if (move_uploaded_file($fileTempName, $destinationFile)) {

                    $query = "UPDATE customer_detail SET ProfileImage= '$destinationFile' WHERE Account_No = '$AcNo'";
                    mysqli_query($conn, $query) or mysqli_error($conn);
                    mysqli_close($conn);
                }
            } 
        //     else {
        //         echo $Up_error = 'invalid file extention';
        //     }
        // } else {
        //     echo $Up_error = 'File is too large (Size Limit: 200kb)';
        }
    }
    header("Location: profile.php");
}


// ------------------------------------------------------- Profile Info Js ---------------------------------------

if (isset($_POST['ProfileData'])) {


    $query = "SELECT * FROM customer_detail WHERE Account_No = '$AcNo'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $ProfileImage = $row['ProfileImage'];
        }

        echo $ProfileImage;
    } else {
        echo "No Data Found";
    }

    mysqli_close($conn);
}



// --------------------------------------------------- Secure Account ----------------------------------------

// ------------------------------------------- Change Password -------------------------------------------------


if (isset($_POST['Switch'])) {


    $query = "SELECT * FROM login WHERE AccountNo = '$AcNo' ";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $Status = $row['Status'];
        }
        echo $Status;
    } else {
        echo "Invalid Username and Password";
    }
    mysqli_close($conn);
}

if (isset($_POST['NewUsernameCheck'])) {

    $NewUsername = $_POST['NewUsernameCheck'];

    $query = "SELECT * FROM login WHERE Username = '$NewUsername'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            echo "pass";
        }
    } else {
        echo "fail";
    }

    mysqli_close($conn);
}

// change username

if (isset($_POST['UpdateNewUsername'])) {

    $UpdateNewUsername = $_POST['UpdateNewUsername'];
    $OldUsername = $_POST['OldUsername'];
    $UserPassword = $_POST['UserPassword'];

    $query = "SELECT * from `login` where `AccountNo` = '$AcNo'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Password'] == md5($UserPassword)) {
            $query = "UPDATE `login` SET `Username` = '$UpdateNewUsername' WHERE `AccountNo` = '$AcNo'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if ($result) {
                echo "success";
            } else {
                echo "Internal Issue";
            }
        } else {
            echo "Enter correct password!";
        }
    }

    mysqli_close($conn);
}

// Remaining POSTs: PasswordCheck, UpdatePass, UpdateStatus

if (isset($_POST['PasswordCheck'])) {

    $PasswordCheck = $_POST['PasswordCheck'];

    $query = "SELECT * from `login` where `AccountNo` = '$AcNo'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Password'] == md5($PasswordCheck)) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    mysqli_close($conn);
}
if (isset($_POST['UpdatePass'])) {

    $UpdatePass = md5($_POST['UpdatePass']);

    $query = "UPDATE `login` SET `Password` = '$UpdatePass' WHERE `AccountNo` = '$AcNo'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($result) {
        echo "success";
    } else {
        echo "Internal Issue";
    }

    mysqli_close($conn);
}

// // --------------------------------------------------- DebitCard Application -----------------------------------------


// if (isset($_POST['DebitCardApp'])) {

//     $query = "SELECT * FROM customer_detail WHERE Account_No = $AcNo";

//     $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
//     if (mysqli_num_rows($result) > 0) {
//         while ($row = mysqli_fetch_assoc($result)) {
//             $FName = $row['C_First_Name'];
//             $CName = $row['C_Last_Name'];
//         }

//         $Name = strtoupper($FName . " " . $CName);

//         $sufix = substr($AcNo, 0, 2);
//         $prefix = substr($AcNo, 2, 2);

//         $DebitCard_No = $prefix . date('ndyHisL') . $sufix;

//         $RandomNO = strval(rand(10000, 99999));
//         $cvv = substr($RandomNO, 0, 3);

//         $query = "INSERT INTO cards(AccountNo, Name, CardNo, cvv, IssuedDate, ExpiryDate, Status, Verified) VALUES ('$AcNo', '$Name', '$DebitCard_No', $cvv,'', '', 'Inactive', 'No')";
//         $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
//         echo $result;
//     } else {
//         echo "fail";
//     }
// }
