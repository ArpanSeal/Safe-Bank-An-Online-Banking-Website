// This is the best methd to perfrom crud operation multiple varibles
$(document).ready(function () {

    $(document).on('click', '.view_data', function () {

        let AccountNo = $(this).attr("id");
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {

                CAccountNo: AccountNo
            },
            dataType: 'json',
            success: function (response) {
                $("#Fname").text(response['Fname']);
                $("#Lname").text(response['Lname']);
                $("#Faname").text(response['Faname']);
                $("#Maname").text(response['Maname']);
                $("#Bdate").text(response['Bdate']);
                $("#MobileNo").text(response['MobileNo']);
                $("#Email").text(response['Email']);

                $("#Email").text(response['Email']);
            }
        });
    });

    $(document).on('click', '.verify_data', function () {
        let AccountNo = $(this).attr("id");
        swal({
            title: "Are you sure?",
            text: "After Verified, This Account Will Be Activated.",
            icon: "info",
            buttons: true,
            dangerMode: false,
        }).then((value) => {
            if (value) {

                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: { VerifyAc: AccountNo },
                    success: function (response) {

                        if (response == "Success") {
                            swal("Account Activated Sucessfully!", {
                                icon: "success",
                                buttons: [false]
                            });
                            setTimeout(function () {

                                location.reload();

                            }, 1000);
                        }
                        else {
                            swal({
                                title: "Account Not Activated !",
                                text: "Please Check Connection or after some time!",
                                icon: "error",
                                buttons: true,
                            }).then((value) => {
                                location.reload();
                            });

                        }
                    }
                });
            }
            else {
                swal("The Account is not Activated !");
            }

        });

    });
    $(document).on('click', '.reject_data', function () {
        let AccountNo = $(this).attr("id");
        swal({
            title: "Are you sure?",
            text: "Once Rejected, This Account Can Never Be Recoverd!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: { RejectAc: AccountNo },
                    success: function (response) {

                        if (response == "Success") {
                            swal("Account Rejected Sucessfully!", {
                                icon: "success",
                                buttons: [false]
                            });

                            $.ajax({
                                type: "POST",
                                url: "code.php",
                                data: {done: "done"},
                                success: function (response) {
                                    
                                }
                            });
                            setTimeout(function () {

                                location.reload();

                            }, 1000);
                        }
                        else {
                            swal({
                                title: "Account is Not Activated !",
                                text: "Please Check Connection or after some time!",
                                icon: "error",
                                buttons: true,
                            }).then((value) => {
                                location.reload();
                            });
                        }
                    }
                });
            }
            else {
                swal("The Account is not Activated !");
            }

        });

    });
});