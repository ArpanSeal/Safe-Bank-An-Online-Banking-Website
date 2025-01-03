<?php
include 'connection.php';
include "../config.php";

session_start();


if (isset($_SESSION['username'])) {
    header("Location: ../user/UserData/Dashboard.php");
} else {



    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];
        $hashPassword = md5($password);
        $password_err = $username_err = "";

        if (empty(trim($_POST['password'])) && empty(trim($_POST['username']))) {

            header("Location: ../user/login.php?error=Username and Password required");
            exit();
        } elseif (empty(trim($_POST['username']))) {

            $username_err = "Username cannot be blank";
            header("Location: ../user/login.php?error=Username required");
            exit();
        } elseif (empty(trim($_POST['password']))) {

            header("Location: ../user/login.php?error=Password required");
            exit();
        } else {
            $query_email = "SELECT Account_No FROM customer_detail WHERE C_Email = '$email'";
            $result_email = mysqli_query($conn, $query_email) or die("Query Fail.");
            
            if (mysqli_num_rows($result_email) > 0) {
                $AccountNo_email = mysqli_fetch_assoc($result_email)['Account_No'];
                $query_user = "SELECT Username FROM login WHERE AccountNo = '$AccountNo_email'";
                $result_user = mysqli_query($conn, $query_user) or die("Query Fail.");
                $username = mysqli_fetch_assoc($result_user)['Username'];
            }

            $query = "SELECT ID, Username, Password, AccountNo, Status, State FROM login WHERE Username= '{$username}' AND Password= '{$hashPassword}'";

            $result = mysqli_query($conn, $query) or die("Query Fail.");

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $status = $row['Status'];
                    $state = $row['State'];

                    if ($state == 0) {
                        if ($status == "Active") {

                            session_start();
                            $_SESSION['username'] = $row['Username'];
                            $login_username = $row['Username'];
                            $query = "SELECT `AccountNo` from `login` where `Username` = '$login_username'";
                            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $_SESSION['AccountNo'] = $row['AccountNo'];
                            }       
                            header("Location: UserData/Dashboard.php");
                            mysqli_close($conn);
                        } else {
                            header("Location: login.php?error=Account is not Activated");
                            exit();
                        }
                    } else if ($state == 1) {

                        if ($status == "Super") {
                            session_start();
                            $_SESSION['accountNo'] = $row['AccountNo'];
                            header("Location: ../admin/Dashboard.php");
                            mysqli_close($conn);
                        } else {
                            header("Location: login.php?error=Account is not Activated");
                            exit();
                        }
                    }
                }
            } else {
                header("Location: ../user/login.php?error=Invalid Credential");
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Favicons -->
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">

    <!-- Extra CSS for external module -->
    <style>
        .swal-button {
            padding: 7px 19px;
            border-radius: 2px;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            font-size: 12px;
            color: white;
        }

        .swal-button:hover {
            opacity: 0.8;
            background-color: transparent;
        }
    </style>


</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="../assets/img/PageImage/loginImage.gif" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <a href="../index.php">
                                    <img src="../assets/img/logosafeb.svg" alt="logo" class="logo">
                                </a>
                                <p><?php echo BANKNAME ?></p>
                            </div>
                            <p class="login-card-description">Login to your account</p>

                            <!-- Login Form -->
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                                <?php if (isset($_GET['error'])) {  ?>

                                    <p style="color: red;"> *<?php echo $_GET['error'] ?> ! </p>

                                <?php } ?>

                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" id="Username" class="form-control" placeholder="Username or Email" required>
                                    <p id="alert1" style="color: red;"></p>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                            </form>
                            <div style="color: green">
                                <div>For testing purpose, use this:</div>
                                <hr>
                                <div>Username: test1234</div>
                                <div>Password: Test@1234</div>
                                <hr>
                            </div>
                            <a href="../user/forgotPassword.php" class="forgot-password-link">Forgot password?</a>
                            <p class="login-card-footer-text">Don't have an account? <a href="../user/CreateAccount.php" class="text-reset">Register here</a></p>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/showHidePass.js"></script>
    <script>
        <?php if (isset($_GET['error'])) { ?>
            swal({
                title: "Account Alert!",
                text: "<?php echo $_GET['error'] ?>",
                icon: "error",
            });


        <?php } ?>
    </script>
    <script>
        $(document).ready(function() {
            $('input[type=\'password\']').showHidePassword();
        });
    </script>
</body>

</html>