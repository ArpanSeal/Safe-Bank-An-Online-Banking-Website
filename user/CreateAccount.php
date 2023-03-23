<?php
session_start();
include "connection.php";

// checking Submit button is clicked or not by isset function


?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account</title>

    <!-- Favicons -->
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Project CSS -->
    <link rel="stylesheet" href="../assets/css/createAccount.css">


    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/createAc.js"></script>


</head>

<body>



    <form id="regForm" enctype="multipart/form-data">
        <div class="brand-wrapper">
            <a href="../index.php">
                <img src="../assets/img/logosafeb.svg" alt="logo" class="logo">
            </a>
        </div>
        <h1 class="mb-3">Register</h1>

        <!-- Tab 1 -->

        <div class="tab mb-3">
            <h3 class="mb-3 stepHead">Step 1/2</h3>
            <p class="SubAction">Personal Detail:</p>
            <div class="row g-2 mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="FName" placeholder="First Name">
                        <label for="floatingInputGrid">First Name</label>

                        <span id="FnameError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                        echo $First_Name_error;
                                                                    } ?></span>
                    </div>
                </div>
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">

                            <input type="text" class="form-control" id="Lname" placeholder="Last Name">
                            <label for="floatingInputGrid">Last Name</label>

                            <span id="LnameError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                            echo $Last_Name_error;
                                                                        } ?></span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">

                            <input type="text" class="form-control" id="FAname" placeholder="Father's Name">
                            <label for="floatingInputGrid">Father's Full Name</label>
                            <span id="FAnameError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                            echo $Father_Name_error;
                                                                        } ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">

                            <input type="text" class="form-control" id="MAname" placeholder="Mother's Name">
                            <label for="floatingInputGrid">Mother's Full Name</label>
                            <span id="MAnameError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                            echo $Mother_Name_error;
                                                                        } ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="BirthDate" placeholder="Birth Date">
                            <label for="floatingInputGrid">Date of Birth</label>
                            <span id="AgeError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                        echo $Birth_Date_error;
                                                                    } ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">
                            <input class="form-control" type="tel" id="MobileNo" pattern="[0-9]{10}" placeholder="Mobile Number" onkeypress="return isNumber(event)">
                            <label for="floatingInputGrid">Mobile Number</label>
                            <span id="MobileNoError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                                echo $Mobile_Number_error;
                                                                            } ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-md">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" placeholder="Email Address">
                            <label for="floatingInputGrid">Email Address</label>
                            <span id="EmailError" style="color: red;"><?php if (isset($_POST['submit'])) {
                                                                            echo $Email_error;
                                                                        } ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2 -->

        <div class="tab">
            <h3 class="mb-3 stepHead">Step 2/2</h3>
            <p class="SubAction">Create Username and Password</p>

            <div class="col-md mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="Username" placeholder="Create Username">
                        <label for="floatingInputGrid">Create Username</label>

                        <span style="color: red;" id="UsernameError"><?php if (isset($_POST['submit'])) {
                                                                            echo $UsernameError;
                                                                        } ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input class="form-control" type="password" id="Password" placeholder="Enter Password" data-toggle="tooltip" data-placement="top" title="Enter Password with atleast 8 charater long with 1 Capital 1 small 1 number and 1 special charater">
                        <label for="floatingInputGrid">Enter Password</label>

                        <span style="color: red;" id="PasswordError"><?php if (isset($_POST['submit'])) {
                                                                            echo $PasswordError;
                                                                        } ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input class="form-control" type="password" id="ConfirmPass" placeholder="Confirm Password">
                        <label for="floatingInputGrid">Confirm Password</label>

                        <span style="color: red;" id="ConfirmPassError"><?php if (isset($_POST['submit'])) {
                                                                            echo $ConfirmPassError;
                                                                        } ?></span>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" class="CustomButton me-3 mb-3" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" class="CustomButton" onclick="nextPrev(1)">Next</button>
                <button type="button" id="submitBtn" class="CustomButton" style="display: none;">Submit</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>


    <script src="../assets/js/createAccount.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $("#submitBtn").click(function() {
            let FName = $("#FName").val();
            let Lname = $("#Lname").val();
            let FAname = $("#FAname").val();
            let MAname = $("#MAname").val();
            let BirthDate = $("#BirthDate").val();
            let Password = $("#Password").val();
            let ConfirmPass = $("#ConfirmPass").val();
            let Username = $("#Username").val();
            let email = $("#email").val();
            let MobileNo = $("#MobileNo").val();

            if (Username == "") {
                document.getElementById("UsernameError").innerHTML = "*Please fill the username.";
            } else if (Password == "") {
                document.getElementById("PasswordError").innerHTML = "*Please fill the password.";
            } else if (ConfirmPass == "") {
                document.getElementById("ConfirmPassError").innerHTML = "*Please confirm the password.";
            } else {
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        check: "check",
                        Username: Username,
                        email: email,
                        MobileNo: MobileNo,
                    },
                    success: function(response) {
                        console.log("Inside Check");
                        if (response == "success") {
                            $.ajax({
                                type: "POST",
                                url: "code.php",
                                data: {
                                    submit: "submit",
                                    FName: FName,
                                    Lname: Lname,
                                    FAname: FAname,
                                    MAname: MAname,
                                    BirthDate: BirthDate,
                                    Password: Password,
                                    ConfirmPass: ConfirmPass,
                                    Username: Username,
                                    email: email,
                                    MobileNo: MobileNo,
                                },
                                success: function(response) {
                                    console.log("Inside submit");
                                    if (response == "success") {
                                        swal({
                                            title: "Hurray!",
                                            text: "Your account has been created successfully! Please wait for your account activation.",
                                            icon: "success",
                                            buttons: true,
                                        }).then((value) => {
                                            window.location = 'login.php';
                                        });
                                    } else {
                                        swal({
                                            title: "Ooops!",
                                            text: "Some Internal Error Occurred.",
                                            icon: "error",
                                            buttons: true
                                        }).then((value) => {
                                            window.location = 'CreateAccount.php';
                                        });
                                    }
                                },
                            });
                        } else {
                            swal({
                                title: "Ooops!",
                                text: response,
                                icon: "error",
                                buttons: true,
                            });
                        }
                    },
                });
            }
        });
    </script>


    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


</body>

</html>