$(document).ready(function () {
    $("#Dashboard").addClass("active");

    let balanceChecker = 1;
    $.ajax({
        type: "POST",
        url: "code.php",
        data: { BalanceCheck: balanceChecker },
        dataType: "json",
        success: function (response) {
            $("#BalanceDisplay").text(response['Balance'] + " ₹");
            $("#SavingDisplay").text(response['Saving'] + " ₹");

            $("#CreditDisplay").text(response['CreditThisMonth'] + " ₹");
            $("#DebitDisplay").text(response['DebitThisMonth'] + " ₹");

            $("#DebitLastM").text(response['DebitTotal'] + " ₹");
            $("#CreditLastM").text(response['CreditTotal'] + " ₹");

        }
    });

});