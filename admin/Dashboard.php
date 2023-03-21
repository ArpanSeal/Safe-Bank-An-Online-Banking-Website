<?php
session_start();
if (!isset($_SESSION['accountNo'])) {
    header("Location: ../user/login.php");
}


include '../user/connection.php';
include "../admin/Notification.php";
include "../admin/adminData.php";
include "../config.php";


$TotalCustomer = mysqli_query($conn, " SELECT * FROM customer_detail");
$TotalCustomer = mysqli_num_rows($TotalCustomer);

$ActiveAccount = mysqli_query($conn, " SELECT * FROM login where Status = 'Active' ");
$ActiveAccount = mysqli_num_rows($ActiveAccount);

$InactiveAccount = mysqli_query($conn, " SELECT * FROM login where Status = 'inactive' ");
$InactiveAccount = mysqli_num_rows($InactiveAccount);

$DeactiveAccount = mysqli_query($conn, " SELECT * FROM login where Status = 'Deactivated' ");
$DeactiveAccount = mysqli_num_rows($DeactiveAccount);

$query = "SELECT
DATE(Create_Date) AS DATE,
COUNT(C_No)
FROM
customer_detail
GROUP BY
DATE(Create_Date)
";

$result = mysqli_query($conn, $query);
$date = array();
$data = array();

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $date[] = $row['DATE'];
        $data[] = (int)$row['COUNT(C_No)'];
    }
}

mysqli_close($conn);

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>

    <!-- Favicons -->
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/animations.css">
    <link rel="stylesheet" href="../assets/vendor/boxicons/css/transformations.css">


    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../admin/css/AdminDash.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>

    <style>
        .btn-circle.btn-md {
            width: 65px;
            height: 65px;
            padding: 7px 10px;
            border-radius: 45px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;


        }

        @media (max-width: 768px) {
            .ShowHide {
                display: none;
            }
        }
    </style>


</head>

<body class="dark_bg">

    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
            <div class="simplebar-content" style="padding: 0px;">
                <a class="sidebar-brand" href="../index.php">
                    <span class="align-middle"><?php echo BANKNAME ?></span>
                </a>

                <ul class="navbar-nav align-self-stretch">

                    <li class="">

                        <a class="nav-link text-left active" role="button" aria-haspopup="true" aria-expanded="false">
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
                                                    <li><a href="../admin/wallet/Withdraw.php">Withdraw Money</a></li>
                                                    <li><a href="../admin/wallet/Deposit.php">Deposit Money</a></li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>


                    <li class="menuHover">
                        <a href="../admin/TransferMoney.php" class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i><i class="bx bx-transfer ico"></i> Transfer
                        </a>
                    </li>

                    <li class="has-sub menuHover">
                        <a class="nav-link collapsed text-left" href="#collapseExample2" role="button" data-toggle="collapse">
                            <i class="flaticon-user"></i> <i class="bx bx-user-circle Profile ico"></i> Customer Accounts
                        </a>
                        <div class="collapse menu mega-dropdown" id="collapseExample2">
                            <div class="dropmenu" aria-labelledby="navbarDropdown">
                                <div class="container-fluid ">
                                    <div class="row">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box">
                                                <ul class="list-unstyled m-0">
                                                    <li><a href="../admin/accounts/EditAccount.php">Edit Account</a></li>
                                                    <li><a href="../admin/accounts/ActivateAccount.php">Activate Account</a></li>
                                                    <li><a href="../admin/accounts/DeactivateAccount.php">Deactivate Account</a></li>
                                                    <li><a href="../admin/accounts/CloseAccount.php">Close Account</a></li>


                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="menuHover box-icon">
                        <a href="../admin/VerifyAccount.php" class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i> <i class="bx bx-check-circle ico"></i> Verify Account <span class="badge badge-success" style="font-size: 12px; margin-left: 50px;"> <?php echo $count; ?> new</span>
                        </a>
                    </li>


                    <li class="menuHover">
                        <a class="nav-link text-left" role="button" href="../user/logout.php">
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

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown  d-sm-none">

                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>


                            <li>
                                <a class="nav-link" role="button">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                                    <img style="cursor: pointer" id="AdminDropdown" class="img-profile rounded-circle" src="<?php echo $AdminProfile; ?>">
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
                                    <h1 class="h3 mb-0 light">Dashboard</h1>
                                    <div>
                                        <a href="../admin/wallet/Deposit.php" role="button" class="btn btn-success btn-circle btn-md ShowHide mr-5">
                                            <div><i class='bx bxs-down-arrow-alt bx-sm'></i></div>Deposit
                                        </a>
                                        <a href="../admin/wallet/Withdraw.php" role="button" class="btn btn-danger btn-circle btn-md ShowHide mr-5">
                                            <div><i class='bx bxs-up-arrow-alt bx-sm'></i></div>Withdraw
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="card lightGray_bg">
                                            <div class="card-body card-shadow">
                                                <h5 class="card-title light mb-4 ">Total Customer</h5>
                                                <h1 class="display-5 mt-1 mb-3 light"><?php echo "$TotalCustomer"; ?></h1>
                                                <div class="mb-1">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                                                    <span class="text-muted light"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card lightGray_bg">
                                            <div class="card-body card-shadow">
                                                <h5 class="card-title light mb-4">Active Accounts</h5>
                                                <h1 class="display-5 mt-1 mb-3 light"><?php echo $ActiveAccount; ?></h1>
                                                <div class="mb-1">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                                                    <span class="text-muted light"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card lightGray_bg">
                                            <div class="card-body card-shadow">
                                                <h5 class="card-title light mb-4">Accounts for Verification</h5>
                                                <h1 class="display-5 mt-1 mb-3 light"><?php echo $InactiveAccount; ?></h1>
                                                <div class="mb-1">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                                                    <span class="text-muted light"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card lightGray_bg">
                                            <div class="card-body card-shadow">
                                                <h5 class="card-title light mb-4">Deactivated Accounts</h5>
                                                <h1 class="display-5 mt-1 mb-3 light"><?php echo $DeactiveAccount; ?></h1>
                                                <div class="mb-1">
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span>
                                                    <span class="text-muted light"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>


                            </div>

                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card lightGray_bg">
                                            <div class="card-body card-shadow">
                                                <h5 class="card-title light mb-4 ">Daily Account Created</h5>
                                                <div style="background-color: white">
                                                    <canvas id="Customer" width="600" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card lightGray_bg">
                                                            <div class="card-body card-shadow">

                                                                <div class="d-flex justify-content-center">
                                                                    <a role="button" href="../admin/accounts/EditAccount.php" class="btn text-decoration-none btn-custo mt-3 mb-3"><i class='bx bxs-pencil'></i> Edit Account</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="card lightGray_bg">
                                                            <div class="card-body card-shadow">

                                                                <div class="d-flex justify-content-center">
                                                                    <a role="button" href="../admin/accounts/ActivateAccount.php" class="btn text-decoration-none btn-custo mt-3 mb-3"><i class='bx bx-power-off'></i> Activate Account</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-6">
                                                <div class="card lightGray_bg">
                                                    <div class="card-body card-shadow">
                                                        <h5 class="card-title light mb-4">Account Status</h5>
                                                        <div style="background-color: white">
                                                            <canvas id="Accounts"></canvas>
                                                        </div>
                                                    </div>
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
                                    <a href="../index.php" class="text-muted light"><strong><?php echo BANKNAME ?>
                                        </strong></a> &copy
                                </p>
                            </div>
                            <div class="col-6 text-right">
                                <ul class="list-inline">

                                    <li class="footer-item">
                                        <a class="text-muted light" href="../pages/privacypolicy.php">Privacy</a>
                                    </li>
                                    <li class="footer-item">
                                        <a class="text-muted light" href="../pages/terms.php">Terms</a>
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


    <script>
        $('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });

        // logout popover on profile 

        $("#AdminDropdown").popover({
            html: true,
            container: "body",
            placement: 'bottom',
            content: ` <a href="../user/logout.php" role="button" class="btn btn-danger nav-link">Logout</a>`

        });
    </script>

    <script>
        var ctx = document.getElementById('Accounts').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive', 'Deactivated'],
                datasets: [{
                    label: '# of Votes',
                    data: [<?php echo $ActiveAccount ?>, <?php echo $InactiveAccount ?>, <?php echo $DeactiveAccount ?>],
                    backgroundColor: [
                        'rgba(76, 175, 80, 0.2)',
                        'rgba(102, 31, 255, 0.2)',
                        'rgb(221, 0, 114, 0.2)'

                    ],
                    borderColor: [
                        'rgba(47, 202, 53, 0.86)',
                        'rgba(54, 162, 235, 1)',
                        'rgb(221, 0, 114, 1)'

                    ],
                    borderWidth: 1,
                    barThickness: 70,

                }]
            },
            options: {
                cutout: "70%",
                radius: "90%",
                layout: {
                    padding: {
                        left: -40,
                    },

                }
            }
        });


        var ctx = document.getElementById('Customer').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($date); ?>,
                datasets: [{
                    label: '# Account Created',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(98,0,238,1)',

                    ],
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }]
            },
        });
    </script>


</body>

</html>