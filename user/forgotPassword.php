<?php

// including files
include 'connection.php';
include "../config.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <!-- Favicons -->
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/forgotPass.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="../assets/js/sweetalert.min.js"></script>

    <!-- Extra CSS for external module -->
    <style>
        .swal-button {
            padding: 7px 19px;
            border-radius: 2px;
            background: linear-gradient(to right, #2c8eff, #0024d7);
            font-size: 12px;
            color: white;
        }

        .swal-button:hover {
            opacity: 0.8;
            background-color: transparent;
        }

        @media (max-width: 768px) {
            #forgot-img {
                display: none;
            }

            .login-card .card-body {
                padding: 35px 0px;
            }

            .login-card-description {
                font-size: 1rem;
                color: #000;
                font-weight: normal;
                margin-bottom: 23px;
            }
        }
    </style>


</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div id="forgot-img" class="col-md-5">
                        <img src="../assets/img/PageImage/forgotpass.gif" alt="login" class="login-card-img">
                    </div>
                    <div id="card-start" class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <a href="../index.php">
                                    <img src="../assets/img/logosafeb.svg" alt="logo" class="logo">
                                </a>
                                <p><?php echo BANKNAME ?></p>
                            </div>
                            <p class="login-card-description">Validate Your Credential</p>

                            <!-- Login Form -->
                            <!-- <form action="" method="POST"> -->

                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="Username" id="Username" class="form-control" placeholder="Username">
                                <!-- <p id="alert1" style="color: red;"></p> -->
                            </div>
                            <div class="form-group mb-4">
                                <label for="AccountNo" class="sr-only">Account Number</label>
                                <input type="number" name="AccountNo" id="AccountNo" class="form-control" placeholder="AccountNo">
                            </div>
                            <input name="next" id="next" class="btn btn-block login-btn mb-4" type="submit" value="Next >>">
                            <!-- </form> -->
                            <p class="login-card-footer-text">Go Back To <a href="../index.php" class="text-reset">Home</a></p>
                            <nav class="login-card-footer-nav">
                                <a href="../pages/terms.php">Terms of use.</a>
                                <a href="../pages/privacypolicy.php">Privacy policy</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <div class="modal fade" id="resetPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="ms-4 me-4 mt-4">
                    <label for="NewPassword" class="sr-only">New Password</label>
                    <input type="text" id="NewPassword" class="form-control" placeholder="New Password">
                </div>
                <div class="m-4">
                    <label for="ConfirmPassword" class="sr-only">Confirm Password</label>
                    <input type="text" id="ConfirmPassword" class="form-control" placeholder="ConfirmPassword">
                </div>
                <button id="reset" class="btn btn-success m-4">Reset</button>
            </div>
        </div>
    </div>

    <script>
        $("#next").click(function() {
            let Username = $("#Username").val();
            let AccountNo = $("#AccountNo").val();
            $.ajax({
                type: "POST",
                url: "code.php",
                data: {
                    forgot: "forgotPass",
                    Username: Username,
                    AccountNo: AccountNo
                },
                success: function(response) {
                    // console.log(response);
                    if (response == "success") {
                        $("#resetPass").modal('show');
                        $("#reset").click(function() {
                            let NewPassword = $("#NewPassword").val();
                            let ConfirmPassword = $("#ConfirmPassword").val();
                            // console.log(NewPassword + " " + ConfirmPassword);
                            $.ajax({
                                type: "POST",
                                url: "code.php",
                                data: {
                                    NewPassword: NewPassword,
                                    ConfirmPassword: ConfirmPassword,
                                    AccountNo: AccountNo
                                },
                                success: function(response) {
                                    // console.log(response);
                                    if (response == "success") {
                                        swal({
                                            title: "Hurray!",
                                            text: "Your Password has been changed successfully.",
                                            icon: "success",
                                        });
                                    } else {
                                        swal({
                                            title: "Ooops!",
                                            text: response,
                                            icon: "error",
                                        });
                                    }
                                    $("#resetPass").modal('hide');
                                }
                            });
                        });
                    } else {
                        swal({
                            title: "Ooops!",
                            text: response,
                            icon: "error",
                        });
                    }
                }
            });
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>

    <script>
        <?php if (isset($_GET['error'])) { ?>
            swal({
                title: "Account Alert!",
                text: "<?php echo $_GET['error'] ?>",
                icon: "error",
            });


        <?php } ?>
    </script>
</body>

</html>