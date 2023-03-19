// JQuery Start from Here


let FnameError = 0;
let LnameError = 0;
let FAnameError = 0;
let MAnameError = 0;
let AgeError = 0;
let MobileNoError = 0;
let EmailError = 0;
let UsernameError = 0;
let PasswordError = 0;
let ConfirmPass = 0;

let FNxt=0, LNxt=0, FANxt=0, MANxt=0, DBNxt=0, MobNxt=0, ENxt=0, GNxt=0;





$(document).ready(function () {

    // ****************************** First Name Validation *******************************************
    $("#FirstName").blur(function () {
        let Fname = $(this).val();
        let Expression = /^[a-zA-Z\s]+$/;
        if (Fname == "") {
            $("#FnameError").text("Please Enter your Name");
            $("#nextBtn").attr('disabled', true);
            FnameError = 1;
        }
        else {
            $("#FnameError").text("");
            $("#nextBtn").prop('disabled', false);
            if (!Expression.test(Fname)) {
                $("#FnameError").text("Name doesn't contain Numbers");
                $("#nextBtn").attr('disabled', true);
                FnameError = 1;
            }
            else {
                $("#FnameError").text("");
                $("#nextBtn").attr('disabled', false);
                FnameError = 0;
                FNxt=1;
            }

        }

    });

    // ************************************************** Last Name Validation ****************************************
    $("#Lname").blur(function () {
        let Lname = $(this).val();
        let Expression1 = /^[a-zA-Z\s]+$/;
        if (Lname == "") {
            $("#LnameError").text("Please Enter your Last Name");
            $("#nextBtn").attr('disabled', true);
            LnameError = 1;
        }
        else {
            $("#LnameError").text("");
            $("#nextBtn").prop('disabled', false);
            LnameError = 0;
            if (!Expression1.test(Lname)) {
                $("#LnameError").text("Last Name doesn't contain Numbers");
                $("#nextBtn").attr('disabled', true);
                LnameError = 1;
            }
            else {
                $("#LnameError").text("");
                $("#nextBtn").prop('disabled', false);
                LnameError = 0;
                LNxt=1;
            }

        }

    });
    // ******************************************** Father Name Validation ********************************************
    $("#FAname").blur(function () {
        let FAname = $(this).val();
        let Expression2 = /^[a-zA-Z\s]+$/;
        if (FAname == "") {
            $("#FAnameError").text("Please Enter your Father's Full Name");
            $("#nextBtn").attr('disabled', true);
            FAnameError = 1;
        }
        else {
            $("#FAnameError").text("");
            $("#nextBtn").prop('disabled', false);
            FAnameError = 0;
            if (!Expression2.test(FAname)) {
                $("#FAnameError").text("Name doesn't contain Numbers");
                $("#nextBtn").attr('disabled', true);
                FAnameError = 1;
            }
            else {
                $("#FAnameError").text("");
                $("#nextBtn").prop('disabled', false);
                FAnameError = 0;
                FANxt=1;
            }

        }

    });

    // ***************************************** Mother Name Validation *********************************************
    $("#MAname").blur(function () {
        let MAname = $(this).val();
        let Expression3 = /^[a-zA-Z\s]+$/;
        if (MAname == "") {
            $("#MAnameError").text("Please Enter your Mother's Full Name");
            $("#nextBtn").attr('disabled', true);
            MAnameError = 1;
        }
        else {
            $("#MAnameError").text("");
            $("#nextBtn").prop('disabled', false);
            MAnameError = 0;
            if (!Expression3.test(MAname)) {
                $("#MAnameError").text("Name doesn't contain Numbers");
                $("#nextBtn").attr('disabled', true);
                MAnameError = 1;
            }
            else {
                $("#MAnameError").text("");
                $("#nextBtn").prop('disabled', false);
                MAnameError = 0;
                MANxt=1;
            }

        }

    });


    // ***********************************  Birthdate Validation  **************************************

    $("#BirthDate").blur(function () {
        // storing date into variable
        let Bdate = new Date($("#BirthDate").val());

        // extracting day from date
        let day = Bdate.getDay();

        // Extracting Month from date
        let month = Bdate.getMonth();

        // Extracting Year from Date
        let year = Bdate.getFullYear();

        // required age
        let age = 18;

        // Fromula to calulate date 
        let setDate = new Date(year + age, month - 1, day);

        // Storing Current date in variable
        let today = new Date();

        // checking the user is 18 or 18+ or not
        if (today < setDate) {
            $("#AgeError").text("You are not Eligible for net Baniking");
            $("#nextBtn").attr('disabled', true);
            AgeError = 1;
        }
        else {
            $("#AgeError").text("");
            $("#nextBtn").attr('disabled', false);
            AgeError = 0;
            DBNxt=1;
        }


    });


    // ********************************** Mobile Number Validation *************************************

    $("#MobileNo").blur(function () {
        let MobileNo = $(this).val();

        if (MobileNo == "") {

            $("#MobileNoError").text("Please Enter Your Mobile Number");
            $("#nextBtn").attr('disabled', true);
            MobileNoError = 1;
        }
        else if (MobileNo.length > 10 || MobileNo.length < 10) {

            $("#MobileNoError").text("Invalid Mobile Number");
            $("#nextBtn").attr('disabled', true);
            MobileNoError = 1;
        }
        else {
            $("#MobileNoError").text("");
            $("#nextBtn").attr('disabled', false);
            MobileNoError = 0;
            MobNxt=1;
        }

    });

    // ************************************ Email Validation ******************************************

    $("#email").blur(function () {
        let email = $(this).val();

        if (email == "") {

            $("#EmailError").text("Please Enter Your Email");
            $("#nextBtn").attr('disabled', true);
            // $(this).attr('required', true);
            EmailError = 1;
        }
        else {
            let match = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

            if (!match.test(email)) {

                $('#EmailError').text('Invalid Email Format');
                $("#nextBtn").attr('disabled', true);
                EmailError = 1;
            }
            else {
                $("#EmailError").text("");
                $("#nextBtn").attr('disabled', false);
                EmailError = 0;
                ENxt=1;
            }
            // else {

            //     // Fire Ajax query here to check whether the Pan number is aready in database or not
            //     $.ajax({
            //         type: "POST",
            //         url: "AccountValidation.php",
            //         data: { EmailAddress: email },
            //         success: function (response) {
            //             if (response != "0") {
            //                 $("#EmailError").text("Email Address Already Exist");
            //                 $("#nextBtn").attr('disabled', true);
            //                 EmailError = 1;
            //             }
            //             else {
            //                 $("#EmailError").text("");
            //                 $("#nextBtn").attr('disabled', false);
            //                 EmailError = 0;
            //             }
            //         }
            //     });
            // }
        }

    });


    // ************************************* Validating Username and Password *******************************


    // username Validation
    $("#Username").change(function () {
        let Username = $(this).val();

        if (!Username == "") {
            let regex = /^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/;
            if (!regex.test(Username)) {
                $("#UsernameError").text("Please Enter Valid Username conatining letters and number");
                $("#submitBtn").attr('disabled', true);
            }
            else {
                $("#UsernameError").text("");
                $("#submitBtn").attr('disabled', false);
                UsernameError = 0;
            }
        }
        else {
            $("#UsernameError").text("Username Can not Empty");
            $("#submitBtn").attr('disabled', true);
        }

    });

    // password Validation
    $("#Password").change(function () {
        let Password = $(this).val();

        if (!Password == "") {

            let regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m;
            if (!regex.test(Password)) {
                $("#PasswordError").text("Password must contain Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character");
                $("#submitBtn").attr('disabled', true);
            }
            else {
                $("#PasswordError").text("");
                $("#submitBtn").attr('disabled', false);
            }
        }
        else {
            $("#PasswordError").text("Password Can not Empty");
            $("#submitBtn").attr('disabled', true);
        }

    });

// Confirm Password
    $("#ConfirmPass").change(function () {
        let ConfirmPassword = $(this).val();
        let Password = $("#Password").val();

        if (!ConfirmPassword == "") {

            if (Password == ConfirmPassword) {
                $("#ConfirmPassError").text("");
                $("#submitBtn").attr('disabled', false);
            }
            else {

                $("#ConfirmPassError").text("Please Enter Same Password");
                $("#submitBtn").attr('disabled', true);
            }
        }
        else {
            $("#ConfirmPassError").text("Please Confirm Password");
            $("#submitBtn").attr('disabled', true);
        }

    });




});


