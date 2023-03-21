<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: ../../user/login.php");
}
unset($_SESSION['EditAccountNo']);
include "../connection.php";
include "../Notification.php";
include "../adminData.php";
include "../../config.php";

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Deactivate Account</title>

    <!-- Favicons -->
    <link href="../../assets/img/favicon-32x32.png" rel="icon">
    <link href="../../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../css/accounts/OpenAccount.css">

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body class="dark_bg">

    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
            <div class="simplebar-content" style="padding: 0px;">
                <a class="sidebar-brand" href="../../index.php">
                    <span class="align-middle"><?php echo BANKNAME ?></span>
                </a>

                <ul class="navbar-nav align-self-stretch">
                    <li class="menuHover">

                        <a href="../Dashboard.php" class="nav-link text-left" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="flaticon-bar-chart-1"></i><i class="bx bxs-dashboard ico"></i> Dashboard
                        </a>
                    </li>

                    <li class="has-sub menuHover">
                        <!-- this link href="collapseExample1" shows submenue  -->
                        <a class="nav-link collapsed text-left" href="#collapseExample1" role="button" data-toggle="collapse">
                            <i class="flaticon-user"></i> <i class="bx bxs-wallet-alt Profile ico"></i> Wallet
                        </a>
                        <!-- id is a collapseExample1 -->
                        <div class="collapse menu mega-dropdown" id="collapseExample1">
                            <div class="dropmenu" aria-labelledby="navbarDropdown">
                                <div class="container-fluid ">
                                    <div class="row">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box">
                                                <ul class="list-unstyled m-0">
                                                    <li><a href="../wallet/Withdraw.php">Withdraw Money</a></li>
                                                    <li><a href="../wallet/Deposit.php">Deposit Money</a></li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>


                    <li class="menuHover">
                        <a href="../TransferMoney.php" class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i><i class="bx bx-transfer ico"></i> Transfer
                        </a>
                    </li>

                    <li class="has-sub menuHover">
                        <a class="nav-link collapsed text-left" href="#collapseExample2" role="button" data-toggle="collapse">
                            <i class="flaticon-user"></i> <i class="bx bx-user-circle Profile ico"></i> Customer Accounts
                        </a>
                        <!-- Show class show dropdown by default -->
                        <div class="collapse show menu mega-dropdown " id="collapseExample2">
                            <div class="dropmenu" aria-labelledby="navbarDropdown">
                                <div class="container-fluid ">
                                    <div class="row">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box">
                                                <ul class="list-unstyled m-0">
                                                    <li><a href="../accounts/EditAccount.php">Edit Account</a></li>
                                                    <li><a href="../accounts/ActivateAccount.php">Activate Account</a></li>
                                                    <li><a class="active" href="../accounts/DeactivateAccount.php">Deactivate Account</a></li>
                                                    <li><a href="../accounts/CloseAccount.php">Close Account</a></li>


                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="menuHover box-icon">
                        <a href="../VerifyAccount.php" class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i> <i class="bx bx-check-circle ico"></i> Verify Account <span class="badge badge-success" style="font-size: 12px; margin-left: 50px;"> <?php echo $count; ?> new</span>
                        </a>
                    </li>

                    <li class="menuHover">
                        <a class="nav-link text-left" role="button" href="../../user/logout.php">
                            <i class="flaticon-map"></i><i class="bx bx-log-out ico"></i> Logout
                        </a>
                    </li>

                </ul>


            </div>


        </nav>
        <!-- /#sidebar-wrapper -->


        <!-- Page Content -->
        <div id="page-content-wrapper">


            <div id="content">

                <div class="container-fluid p-0 px-lg-0 px-md-0">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light gray_bg my-navbar">

                        <!-- Sidebar Toggle (Topbar) -->
                        <div type="button" id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                            <span class="light_bg"></span>
                            <span class="light_bg"></span>
                            <span class="light_bg"></span>
                        </div>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item">
                                <a class="nav-link" role="button">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                    <img style="cursor: pointer" id="AdminDropdown" class="img-profile rounded-circle" src="<?php echo  '../' . $AdminProfileInner ?>">
                                </a>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid px-lg-4 dark_bg light">
                        <div class="row">
                            <div class="col-md-12 mt-lg-4 mt-4">
                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 light">Customer Accounts</h1>
                                </div>
                                <?php
                                if (isset($_POST['deactivate_btn'])) {
                                    $DAccountNo = $_POST['deactivate_id'];
                                    $Dquery = "UPDATE login SET Status = 'Deactivated' WHERE AccountNo = '$DAccountNo'";
                                    $result = mysqli_query($conn, $Dquery) or die('Query Fail');
                                    if ($result) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Account Deactivated!</strong>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>';
                                    } else {
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Account not Deactivated!</strong>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>';
                                    }
                                }

                                if (isset($_POST['Sdeactivate_btn'])) {
                                    $DAccountNo = $_SESSION['De_ActiveAccountNo'];
                                    $Dquery = "UPDATE login SET Status = 'Deactivated' WHERE AccountNo = '$DAccountNo'";
                                    $result = mysqli_query($conn, $Dquery) or die('Query Fail');
                                    if ($result) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Account Deactivated!</strong>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>';
                                    } else {
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Account not Deactivated!</strong>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>';
                                    }
                                }
                                ?>


                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card lightGray_bg">
                                            <div class="card-body ">
                                                <h5 class="card-title light mb-4 ">Deactivate Account</h5>

                                                <!-- Search Box -->
                                                <form action="ActivateAccount.php" method="POST" class="d-none d-sm-inline-block form-inline navbar-search">
                                                    <div class="input-group">

                                                        <input id="SearchText" name="SearchText" style="margin: bottom 30px;" type="text" class="form-control gray_bg light border-bg" placeholder="Search for Account ..." aria-label="Search">

                                                        <div class="input-group-append">
                                                            <button id="search" name="search" class="btn btn-custo" type="button">
                                                                <i class="fas fa-search fa-sm"></i>
                                                            </button>
                                                        </div>

                                                        <!-- Refresh Button -->
                                                        <button style="margin-left: 10px;" id="refresh" class="btn btn-primary" type="button" onclick="reload();">
                                                            Refresh <i class="bx bx-refresh bx-10 ico" style="font-size: 18px;"></i>
                                                        </button>
                                                    </div>

                                                </form>

                                                <div class="table-responsive">

                                                    <table id="EditTable" class="table v-middle" style="margin-top: 30px;">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">#ID</th>
                                                                <th scope="col">Account No</th>
                                                                <th scope="col">Username</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Verify</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="dark_bg">

                                                            <?php

                                                            $query = "SELECT * FROM login WHERE Status='Active'";
                                                            $result = mysqli_query($conn, $query) or die("query fail");

                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($row = mysqli_fetch_assoc($result)) {



                                                            ?>
                                                                    <tr>
                                                                        <th class="light" scope="row"><?php echo $row['ID']; ?></th>

                                                                        <td class="light"><?php echo $row['AccountNo']; ?></td>

                                                                        <td class="light"><?php echo $row['Username']; ?></td>

                                                                        <td class="light"><?php echo $row['Status']; ?></td>

                                                                        <td class="light">
                                                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                                                <input type="hidden" name="deactivate_id" id="deactivate_id" value="<?php echo $row['AccountNo']; ?>">
                                                                                <button name="deactivate_btn" id="deactivate_btn" type="submit" data-toggle="modal" data-target="#Verify" class="btn btn-warning"><i class='bx bx-error'></i>Deactivate</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>

                                                            <?php
                                                                }
                                                            }

                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <div class="table-responsive">

                                                    <!-- Search Table -->
                                                    <table hidden id="SearchTable" class="table v-middle" style="margin-top: 30px;">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">#ID</th>
                                                                <th scope="col">Account No</th>
                                                                <th scope="col">Username</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Deactivate</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="dark_bg">

                                                            <tr>
                                                                <th id="id" class="light" scope="row"></th>

                                                                <td id="AccountNo" class="light"></td>

                                                                <td id="Username" class="light"></td>

                                                                <td id="Status" class="light"></td>

                                                                <td class="light">

                                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                                                                        <input id="Sdeactivate_id" type="hidden" name="Sdeactivate_id" value="<?php echo $AccountNo ?>">
                                                                        <button name="Sdeactivate_btn" type="submit" class="btn btn-warning"><i class='bx bx-error'></i>Deactivate</button>
                                                                    </form>
                                                                </td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>




                                            </div>
                                        </div>

                                    </div>


                                </div>


                            </div>

                        </div>

                    </div>


                </div>






                <footer class="footer gray_bg">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-left">
                                <p class="mb-0">
                                    <a href="../../index.php" class="text-muted light"><strong><?php echo BANKNAME ?>
                                        </strong></a> &copy
                                </p>
                            </div>
                            <div class="col-6 text-right">
                                <ul class="list-inline">
                                    <li class="footer-item">
                                        <a class="text-muted light" href="../../pages/privacypolicy.php">Privacy</a>
                                    </li>
                                    <li class="footer-item">
                                        <a class="text-muted light" href="../../pages/terms.php">Terms</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="../js/deactivateAc.js"></script>
    <script>
        $('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });

        $("#AdminDropdown").popover({

            // title: 'Profile Detail',
            html: true,
            container: "body",
            placement: 'bottom',
            content: ` <a href="../../user/logout.php" role="button" class="btn btn-danger nav-link">Logout</a>`

        });
    </script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>