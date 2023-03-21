$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "code.php",
        data: { profileDetail: "Profile" },
        success: function (response) {
            response = JSON.parse(response);
                if(response.Gender == "Male"){
                    $("#Male").attr("checked", true);
                    $("#GenderPlate").addClass("male-color");
                }
                else if(response.Gender == "Female"){
                    $("#Female").attr("checked", true);
                    $("#GenderPlate").addClass("female-color");
                }

                $("#NamePlate").text(response.FName + " " + response.LName);
                $("#NameTag").text(response.TagName);
                $("#ProfileTag").css("background-color", response.ProfileColor);
                $("#BalanceDisplay").text("₹" + response.Balance);
                $("#SavingDisplay").text("₹" + response.SavingBalance);
                $("#AcNo").text(response.AccountNo);
                $("#AcType").text(response.AccountType);
                $("#Status").text(response.Status);
                $("#MobileNo").text(response.MobileNo);
                $("#Email").text(response.Email);
                $("#GenderPlate").text(response.Gender);

                // Modal Profile

                if(response.ProfileImage != ""){
                    $("#ModalProfileImg").attr("hidden", false);
                    $("#ModalProfileImg").attr("src", response.ProfileImage);
                    $("#ProfileIcon").attr("hidden", true);
                }
            

                // Page Profile
                if(response.ProfileImage != ""){
                    $("#ProfilePic").attr("hidden", false);
                    $("#ProfilePic").attr("src", response.ProfileImage);
                    $("#ProfileTag").attr("hidden", true);
                }
               
                
                if(response.Bio == ""){
                    $("#AboutBio").text("Hey there! I am using Safe Bank.");
                    $("#bio").val("Hey there! I am using Safe Bank.");

                }
                else{
                    $("#AboutBio").text(response.Bio);
                    $("#bio").val(response.Bio);
                }
        }
    });



    $("#delete").click(function (e) {

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Profile Image!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        })
        .then((willDelete) => {
            if (willDelete) {
                $("#ModalProfileImg").attr("hidden", true);
                $("#ProfileIcon").attr("hidden", false);
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: { deleteImgAcc: "deleteImgAcc" },
                    success: function (response) {
                        if (response == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Your Profile Image has been deleted successfully.',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                        else {
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopps... Fail',
                                text: response,
                                showConfirmButton: true,
                                confirmButtonText: `Ok`
                            })
                            
                        }
                    }
                });
            } else {
                swal("Your Profile Image is safe!");
            }
        });
        

        e.preventDefault();
        
    });

    $("#upload").change(function (e) {
        
        // validation error, size limit error
        if($('#upload').val() != '')
        {
            $.ajax({
                type: "POST",
                url: "code.php",
                data: {filesize: this.files[0]['size'],
                        filename:  this.files[0]['name']
                    },
                success: function (response) {
                    if (response == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your Profile Image has been uploaded successfully.',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        let profilePath = URL.createObjectURL(e.target.files[0]);
                        $("#ProfileIcon").attr("hidden", true);
                        $("#ModalProfileImg").attr("hidden", false);
                        $("#ModalProfileImg").attr("src", profilePath);
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopps... Fail',
                            text: response,
                            showConfirmButton: true,
                            confirmButtonText: `Ok`
                        })
                        this.files='';
                    }
                }
            });
        }
        e.preventDefault();
        
    });

});
