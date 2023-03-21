$(document).ready(function () {

    $("#SenderAc").keyup(function () {
        let SenderAc = $(this).val();

        if (SenderAc.length == 12) {

            let ReceiverAc = $('#ReceiverAc').val();

            if (ReceiverAc == SenderAc) {
                $("#ReciverAcError").text("You Cannot transfer money in same account");
            }
            else {
                $("#ReciverAcError").text("");
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: { SenderAcNo: SenderAc },
                    dataType: "json",
                    success: function (response) {

                        if (response["Flag"] != "fail") {

                            $("#SenderAcError").text("");
                            let Fname = response["Fname"];
                            let Lname = response["Lname"];
                            let MobileNo = response["MobileNo"];
                            let Balance = response["Balance"];
                            let Status = response["Status"];

                            $("#infoS").attr("hidden", false);
                            $('#SenderAc').addClass("border-right-0");

                            $('#SenderAc').popover({

                                title: 'Sender Details',
                                html: true,
                                container: "body",
                                placement: 'left',
                                content: `<p><strong>First Name: </strong> ${Fname}</p> 
                                <p><strong>Last Name: </strong>${Lname}</p> 
                                <p><strong>Mobile Number: </strong>${MobileNo}</p>
                                <p><strong>Account Balance: </strong>${Balance}</p>
                                <p><strong>Account Status: </strong>${Status}</p>`



                            })
                        }
                        else {
                            $('#SenderAc').popover('hide');
                            $("#SenderAcError").text("Account Number Not Found. Note: Refresh The Page for next account no");

                        }
                    }
                });
            }

        }
    });

    $("#infoS").click(function () {
        $('#SenderAc').popover('toggle')
        $('#ReceiverAc').popover('hide')
    });

    $("#ReceiverAc").on({

        keyup: function () {
            let ReceiverAc = $(this).val();

            if (ReceiverAc.length == 12) {

                let SenderAc = $('#SenderAc').val();

                if (ReceiverAc == SenderAc) {
                    $("#ReciverAcError").text("You Cannot transfer money in same account");
                }
                else {
                    $.ajax({
                        type: "POST",
                        url: "code.php",
                        data: { ReceiverAcNo: ReceiverAc },
                        dataType: "json",
                        success: function (response) {

                            if (response["Flag"] != "fail") {

                                $("#ReciverAcError").text("");
                                let Fname = response["Fname"];
                                let Lname = response["Lname"];
                                let MobileNo = response["MobileNo"];
                                let Balance = response["Balance"];
                                let Status = response["Status"];

                                $("#infoR").attr("hidden", false);
                                $('#ReceiverAc').addClass("border-right-0");

                                $('#ReceiverAc').popover({

                                    title: 'Receiver Details',
                                    html: true,
                                    container: "body",
                                    placement: 'left',
                                    content: `<p><strong>First Name: </strong> ${Fname}</p> 
                                    <p><strong>Last Name: </strong>${Lname}</p> 
                                    <p><strong>Mobile Number: </strong>${MobileNo}</p>
                                    <p><strong>Account Balance: </strong>${Balance}</p>
                                    <p><strong>Account Status: </strong>${Status}</p>`

                                })
                            }
                            else {
                                $(this).popover('hide');
                                $("#ReciverAcError").text("Account Number Not Found. Note: Refresh The Page for next account no");

                            }
                        }
                    });
                }
            }
        }

    });

    $("#infoR").click(function () {
        $('#ReceiverAc').popover('toggle')
        $('#SenderAc').popover('hide')
    });

    $("#Amount").on({
        click: function () {
            $('#ReceiverAc').popover('hide')
            $('#SenderAc').popover('hide')
        },

        keyup: function () {
            let Amount = $(this).val();

            if (Amount >= 100) {


                $("#AmountError").text("");

                let SenderAc = $("#SenderAc").val();
                let ReceiverAc = $("#ReceiverAc").val();

                if (SenderAc != "") {

                    if (ReceiverAc != "") {

                        $.ajax({
                            type: "POST",
                            url: "code.php",
                            data: { BalanceCheck: SenderAc },
                            success: function (response) {

                                let Balance = response;
                                if (Balance > Amount) {
                                    $("#AmountError").text("");
                                }
                                else {
                                    $("#AmountError").text("insufficient account balance ");
                                }
                            }
                        });
                    }
                    else {
                        $("#ReciverAcError").text("Please Enter Account No");

                    }
                }
                else {
                    $("#SenderAcError").text("Please Enter Account No");
                }

            }
            else {
                $("#AmountError").text("Please Enter Minimum 100 rupees");
            }
        }

    });



    $("#TransactionBtn").click(function () {

        let Amount = $("#Amount").val();
        let SenderAc = $("#SenderAc").val();
        let ReceiverAc = $("#ReceiverAc").val();

        if (SenderAc != "") {

            if (ReceiverAc != "") {

                if (Amount >= 100) {
                    $("#AmountError").text("");
                    swal({
                        title: "Are you sure to transfer of Amount" + "   " + "₹" + Amount,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {

                        if (willDelete) {

                            let SenderAc = $("#SenderAc").val();
                            let ReceiverAc = $("#ReceiverAc").val();

                            $.ajax({
                                type: "POST",
                                url: "code.php",
                                data: {
                                    TSenderAc: SenderAc,
                                    TReceiverAc: ReceiverAc,
                                    MainAmount: Amount
                                },
                                cache: false,
                                beforeSend: function () {
                                    $('.modal').modal('show');
                                },
                                complete: function () {
                                    $('.modal').modal('hide');
                                },
                                success: function (response) {
                                    if (response == "Success") {
                                        swal("Transaction Sucessfully!", {
                                            icon: "success",
                                            buttons: [false]
                                        });
                                        setTimeout(function () {

                                            location.reload();

                                        }, 2000);
                                    }
                                    else {
                                        swal({
                                            title: "Transaction Fail !",
                                            text: response,
                                            icon: "error",
                                            buttons: true,
                                        }).then((value) => {
                                            location.reload();
                                        });

                                    }
                                }
                            });

                        }

                    });
                }
                else {
                    $("#AmountError").text("Please Enter Minimum 100 rupees");
                }
            }

            else {
                $("#ReciverAcError").text("Please Enter Account No");

            }

        }
        else {
            $("#SenderAcError").text("Please Enter Account No");
        }



    });


});
