<?php
include "../connection.php";

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
$username = $_SESSION['username'];
$AccountNo = $_SESSION['AccountNo'];

$query = "SELECT `Username` from `login` where `AccountNo` = '$AccountNo'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['Username'];
}

$query = "SELECT * FROM customer_detail JOIN login ON customer_detail.Account_No = login.AccountNo JOIN accounts ON accounts.AccountNo = login.AccountNo WHERE login.Username = '$username'";
$result = mysqli_query($conn, $query) or mysqli_error($conn);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $AccountNo = $row['AccountNo'];
        $Fname = $row['C_First_Name'];
        $Lname = $row['C_Last_Name'];
        $color = $row['ProfileColor'];
    }
    $ProfileText = substr($Fname, 0, 1);
    $_SESSION['AccountNo'] = $AccountNo;
    $_SESSION['ProfileText'] = $ProfileText;
    $_SESSION['ProfileColor'] = $color;
}


$creditChart = "SELECT DateTime, SUM(Credit) AS credit, SUM(Debit) AS debit FROM transaction WHERE AccountNo = '$AccountNo' GROUP BY DateTime";


$result = mysqli_query($conn, $creditChart);
$datetime = array();
$credit = array();
$debit = array();

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $datetime[] = $row['DateTime'];
        $credit[] = $row['credit'];
        $debit[] = $row['debit'];
    }
}


$TotalCreditResult = mysqli_query($conn, "SELECT * FROM transaction WHERE AccountNo = '$AccountNo'") or mysqli_error($conn);
$CreditTotal = '0';
if (mysqli_num_rows($TotalCreditResult) > 0) {
    while ($row = mysqli_fetch_assoc($TotalCreditResult)) {

        $CreditAmount = $row['Amount'];

        $CreditTotal = $CreditTotal + $CreditAmount;
    }
    $CreditTotal;
}

$TotalDebitResult = mysqli_query($conn, "SELECT * FROM transaction WHERE AccountNo = '$AccountNo'") or mysqli_error($conn);
$DebitTotal = '0';
if (mysqli_num_rows($TotalDebitResult) > 0) {
    while ($row = mysqli_fetch_assoc($TotalDebitResult)) {

        $DebitAmount = $row['Amount'];

        $DebitTotal = $DebitTotal + $DebitAmount;
    }
    $DebitTotal;
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Favicons -->
    <link href="../../assets/img/favicon-32x32.png" rel="icon">
    <link href="../../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/vendor/boxicons/css/boxicons.css">
    <link rel="stylesheet" href="../../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/vendor/boxicons/css/animations.css">
    <link rel="stylesheet" href="../../assets/vendor/boxicons/css/transformations.css">



    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="../../assets/css/UserDash.css">
    <style>
        @media only screen and (min-width:992px) {
            #credit {
                display: block;
                box-sizing: border-box;
                height: 181px;
                width: 363px;
            }
        }
    </style>

</head>

<body>

    <?php include "header.php" ?>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                        <?php
                            $query = "SELECT * FROM `accounts` WHERE AccountNo = '$AccountNo'";
                            $result = mysqli_query($conn, $query) or die("query fail");

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                            <div class="card-body">
                                <h5 class="card-title mb-4">Balance</h5>
                                <h1 id="BalanceDisplay" class="display-5 mt-1 mb-3">₹<?php echo $row['Balance'] ?></h1>
                                <div class="mb-1">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                                    <span class="text-muted">Your Total Balance</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Saving</h5>
                                <h1 id="SavingDisplay" class="display-5 mt-1 mb-3">₹<?php echo $row['SavingBalance'] ?></h1>
                                <div class="mb-1">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                                    <span class="text-muted">Save Money Monthly</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                            } 
                        }
                    ?>
                    <?php
                        $tot_credit = 0;
                        $tot_debit = 0;
                        $query = "SELECT * FROM `transaction` WHERE AccountNo = '$AccountNo' and `Status` = 'Credited' and MONTH(`DateTime`) = MONTH(now())";
                        $result = mysqli_query($conn, $query) or die("query fail");

                        if (mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $tot_credit += $row['Credit'];
                            }
                        }

                        $query = "SELECT * FROM `transaction` WHERE AccountNo = '$AccountNo' and `Status` = 'Debited' and MONTH(`DateTime`) = MONTH(now())";
                        $result = mysqli_query($conn, $query) or die("query fail");

                        if (mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $tot_debit += $row['Debit'];
                            }
                        }
                    ?>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4 ">Credited this Month</h5>
                                <h1 id="CreditDisplay" class="display-5 mt-1 mb-3 text-success">₹<?php echo $tot_credit;?></h1>
                                <div class="mb-1">
                                    <span id="CreditLastM" class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                                    <span class="text-muted">Since this Month</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Debited this Month</h5>
                                <h1 id="DebitDisplay" class="display-5 mt-1 mb-3 text-danger">₹<?php echo $tot_debit;?></h1>
                                <div class="mb-1">
                                    <span id="DebitLastM" class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> </span>
                                    <span class="text-muted">Since this Month</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>

            <!-- column -->
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Transaction History</h4>
                                <h5 class="card-subtitle">Overview of recent transaction</h5>
                            </div>
                            <div class="ml-auto">
                                <a href="T_history.php" class="btn btn-info" role="button">View More</a>
                            </div>
                        </div>
                        <!-- title -->
                    </div>

                    <div class="table-responsive">
                        <div class="container-fluid">
                        <table class="table v-middle">
                            <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">Sr.No</th>
                                    <th class="border-top-0">Name of Sender/Recipient</th>
                                    <th class="border-top-0">Account No. of Sender/Recipient</th>
                                    <th class="border-top-0">Date & Time</th>
                                    <th class="border-top-0">Amount</th>
                                    <th class="border-top-0">Status</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM transaction WHERE AccountNo = '$AccountNo' ORDER BY id DESC LIMIT 5";
                                $result = mysqli_query($conn, $query) or die("query fail");

                                if (mysqli_num_rows($result) > 0) {
                                    $increment = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {

                                ?>
                                        <tr>
                                            <td><?php echo $increment; ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10"><a style="font-size: 13px; background-color:<?php echo $row['ProfileColor'] ?>" class="btn btn-circle text-white"> <?php
                                                                                                                                                                                            $name = $row['Name'];
                                                                                                                                                                                            $pices = explode(" ", $name);
                                                                                                                                                                                            echo substr($pices[0], 0, 1);
                                                                                                                                                                                            echo substr($pices[1], 0, 1);
                                                                                                                                                                                            ?></a>
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16"><?php echo $row['Name'] ?></h4>
                                                    </div>
                                                </div>
                                            </td>

                                            <td><?php echo $row['FAccountNo'] ?></td>
                                            <td><?php
                                            $dateTime = $row['DateTime'];
                                            $i = 0;
                                            while($dateTime[$i]!=" ")
                                            {
                                                echo $row['DateTime'][$i];
                                                $i++;
                                            }
                                            echo " (";
                                            $i++;
                                            while($i<strlen($dateTime))
                                            {
                                                echo $row['DateTime'][$i];
                                                $i++;
                                            }
                                            echo ")";
                                             ?></td>
                                            <td>
                                                <label class="label label-danger"><?php echo $row['Amount'] ?></label>
                                            </td>

                                            <td>

                                                <span class="Status
                                            
                                            <?php
                                            if ($row['Status'] == 'Debited')
                                                echo "text-danger";
                                            else
                                                echo "text-success";
                                            ?>"><?php echo $row['Status'] ?></span>

                                            </td>


                                        </tr>
                                    <?php
                                        $increment++;
                                    } ?>
                                <?php } ?>

                            </tbody>
                        </table>
                        </div>
                    </div>
                
                </div>
            </div>


        </div>

    </div>

    <?php include "footer.php" ?>
    <!-- Wraper Ends Here -->





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
    <script src="../UserData/js/profileInfo.js"></script>
    <script src="../UserData/js/dashboard.js"></script>


    <script>
        $('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });
    </script>

</body>

</html>