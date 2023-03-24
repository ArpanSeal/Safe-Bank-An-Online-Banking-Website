$(document).ready(function () {
    $("#NewPasswordR").change(function () {
        let Password = $(this).val();

        if (!Password == "") {

            let regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m;
            if (!regex.test(Password)) {
                $("#PasswordErrorR").text("*Password must be 8 charaters long with 1 uppercase 1 lowercase and 1 letter and 1 special charater");
                $("#reset").attr('disabled', true);
            }
            else {
                $("#PasswordErrorR").text("");
                $("#reset").attr('disabled', false);
            }
        }
        else {
            $("#PasswordErrorR").text("*Password Can not be Empty");
            $("#reset").attr('disabled', true);
        }

    });

    $("#ConfirmPasswordR").change(function () {
        let ConfirmPassword = $(this).val();
        let Password = $("#NewPasswordR").val();

        if (!ConfirmPassword == "") {

            if (Password == ConfirmPassword) {
                $("#ConfirmPassErrorR").text("");
                $("#reset").attr('disabled', false);
            }
            else {

                $("#ConfirmPassErrorR").text("*Please Enter the Same Password");
                $("#reset").attr('disabled', true);
            }
        }
        else {
            $("#ConfirmPassErrorR").text("*Please Confirm the Password");
            $("#reset").attr('disabled', true);
        }

    });

});