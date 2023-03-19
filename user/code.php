<?php
include "connection.php";

if (isset($_POST['forgot'])) {
    $Username = $_POST['Username'];
    $AccountNo = $_POST['AccountNo'];

    $query1 = "SELECT * FROM `login` WHERE AccountNo = '$AccountNo'";
    $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));

    $query2 = "SELECT * FROM `login` WHERE Username = '$Username'";
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

    if (mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $Username_check = $row['Username'];
        if($Username == $Username_check){
            echo "success";
        }
        else{
            echo "Username is incorrect!";
        }
    }
    else if (mysqli_num_rows($result2) > 0) {
        $row = mysqli_fetch_assoc($result2);
        $AccountNo_check = $row['AccountNo'];
        if($AccountNo == $AccountNo_check){
            echo "success";
        }
        else{
            echo "Account Number is incorrect!";
        }
    }
    else{
        echo "Both Username and Account Number are incorrect!";
    }
}


if (isset($_POST['check'])) {
    $Username = $_POST['Username'];
    $email= $_POST["email"];
    $MobileNo= $_POST["MobileNo"];

    $query1 = "SELECT * FROM `customer_detail` WHERE C_Email = '$email'";
    $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));

    $query2 = "SELECT * FROM `login` WHERE Username = '$Username'";
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
    
    $query3 = "SELECT * FROM `customer_detail` WHERE `C_Mobile_No` = '$MobileNo'";
    $result3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));

    if (mysqli_num_rows($result1) == 0 && mysqli_num_rows($result2) == 0 && mysqli_num_rows($result3) == 0) {
        echo "success";
    }
    else if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0) {
        echo "You have already been registered! If you can't login to your account, please wait for the account verification.";
    }
    else if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0) {
        echo "Email address: ". $email. " and Username: ". $Username." have already been taken! Please choose another.";
    }
    else if (mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0) {
        echo "Username: ". $Username. " and Mobile Number: ". $MobileNo." have already been taken! Please choose another.";
    }
    else if (mysqli_num_rows($result3) > 0 && mysqli_num_rows($result1) > 0) {
        echo "Mobile Number: ". $MobileNo. " and Email address: ". $email." have already been taken! Please choose another.";
    }
    else if (mysqli_num_rows($result1) > 0) {
        echo "Email address: ". $email. " has already been taken! Please choose another.";
    }
    else if (mysqli_num_rows($result2) > 0) {
        echo "Username: ". $Username. " has already been taken! Please choose another.";
    }
    else if (mysqli_num_rows($result3) > 0) {
        echo "Mobile Number: ". $MobileNo. " has already been taken! Please choose another.";
    }
}

if (isset($_POST['NewPassword'])) {
    $NewPassword = $_POST['NewPassword'];
    $ConfirmPassword = $_POST['ConfirmPassword'];
    $AccountNo = $_POST['AccountNo'];

    if($NewPassword == $ConfirmPassword){
        $Password = md5($NewPassword);
        $query = "UPDATE `login` SET `Password` = '$Password' where AccountNo = '$AccountNo'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if ($result) {
            echo "success";
        } else {
            echo "Internal Issue";
        }
    }
    else{
        echo "Confirm Password doesn't match!";
    }
}


if (isset($_POST['submit'])) {

    // ----------------------------------------- Basic Detail Section -----------------------------------------

    $Account_Type = "Saving";
    $Account_Status = "Inactive";
    $Balance = "0.0";

    // Storing Form values in variable
    $First_Name = $_POST['FName'];
    $Last_Name = $_POST['Lname'];
    $Father_Name = $_POST['FAname'];
    $Mother_Name = $_POST['MAname'];
    $Birth_Date = $_POST['BirthDate'];
    $Mobile_Number = $_POST['MobileNo'];
    $Account_Number = date('ndyHisL');

    if (strlen($Account_Number) > 12) {
        $Account_Number = substr($Account_Number, 0, -1);
    }

    $Email = $_POST['email'];



    //  Error Variables

    $First_Name_error =  $Last_Name_error = $Father_Name_error = $Mother_Name_error = null;
    $Birth_Date_error = $Mobile_Number_error = null;
    $Email_error = null;

    // Validate Name of customer
    /* 
            1] Preg_match_all(): This function check any number is avaible in string or not
            2] !\d+! : passing this regular expression in above function which conatin numeric data pattern
            3] Varible : this parameter contains string to be check
            4] logic explain: if() ant numeric value found in string and it is == 1 
        
     */

    if (preg_match_all('!\d+!', $First_Name) == 1) {
        $First_Name_error = "* Numeric value not allowed in First Name";
    }
    if (preg_match_all('!\d+!', $Last_Name) == 1) {
        $Last_Name_error = "* Numeric value not allowed in Last Name";
    }
    if (preg_match_all('!\d+!', $Father_Name) == 1) {
        $Father_Name_error = "* Numeric value not allowed in Father's Name";
    }
    if (preg_match_all('!\d+!', $Mother_Name) == 1) {
        $Mother_Name_error = "* Numeric value not allowed in Mother's Name";
    }


    // ********************************** Birth Date Validation *********************************************

    $today = new DateTime();
    $diff = $today->diff(new datetime($Birth_Date));
    $age = $diff->y;

    if ($age < 18) {

        $Birth_Date_error = "* You Are Not Eligible to Open Online Account.";
    }

    if (!is_numeric($Mobile_Number) || is_null($Mobile_Number) || !preg_match('/^[0-9]{10}+$/', $Mobile_Number)) {
        $Mobile_Number_error = "Invalid Mobile Number";
    }


    // ************************************************** Email Validation *********************************************


    if (!empty($Email)) {
        if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $Email)) {
            $Email_error = "* Invalid Email ID";
        } else {
            $Email = mysqli_real_escape_string($conn, $_POST['email']);
            $query2 = "SELECT * FROM customer_detail WHERE C_Email = '" . $Email . "'";

            $result2 =  mysqli_query($conn, $query2);

            if (mysqli_num_rows($result2) > 0) {
                $Email_error = "* Email Already Exist";
            }
        }
    } else {
        $Email_error = "* Enter Your Email";
    }


    // ************************************************** Picode Validation *********************************************





    // ++++++++++++++++++++++++++++++++++++++++++++++ Basic Detail Ends Here +++++++++++++++++++++++++++++++++++++++++


    // -------------------------------------------- USERNAME AND PASSWORD VERIFICATION -------------------------------


    $Username = $_POST['Username'];
    $Password  = $_POST['Password'];
    $ConfirmPass = $_POST['ConfirmPass'];

    $UsernameError =  $PasswordError  = $ConfirmPassError = false;

    if (!empty($Username)) {
        if (!preg_match_all('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $Username)) {

            $UsernameError = "* Please Enter Valid Username";
        } else {
            $UsernameError = false;

            $Username = mysqli_real_escape_string($conn, $_POST['Username']);
            $query3 = "SELECT * FROM login WHERE Username = '" . $Username . "'";

            $result3 =  mysqli_query($conn, $query3);

            if (mysqli_num_rows($result3) > 0) {
                $UsernameError = "* Username Already Exist";
            }
        }
    } else {
        $UsernameError = "* Username Cannot Empty";
    }

    // ----------------------------------------- Password Verification ---------------------------------------------
    if (!empty($Password)) {
        if (!preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m', $Password)) {
            $PasswordError  = "* Password must contain Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character";
        } else {
            $hashPass = md5($Password);
            $PasswordError = false;
        }
    } else {
        $PasswordError = "Password Cannot be empty";
    }

    if (!empty($ConfirmPass)) {

        if ($ConfirmPass != $Password) {
            $ConfirmPassError = "Please Enter same Password";
        }
    } else {
        $ConfirmPassError = "Please Confirm Password";
    }


    // --------------------------------------------------- Random Color Hex Generator for Profile ----------------------- 

    $hex = '#';

    //Create a loop.
    foreach (array('r', 'g', 'b') as $color) {
        //Random number between 0 and 255.
        $val = mt_rand(0, 255);
        //Convert the random number into a Hex value.
        $dechex = dechex($val);
        //Pad with a 0 if length is less than 2.
        if (strlen($dechex) < 2) {
            $dechex = "0" . $dechex;
        }
        //Concatenate
        $hex .= $dechex;
    }

    //Print out our random hex color.
    // echo $hex;

    if ($First_Name_error == null && $Last_Name_error == null && $Father_Name_error == null && $Mother_Name_error == null && $Birth_Date_error == null && $Mobile_Number_error == null && $Email_error == null && $UsernameError == false && $PasswordError == false && $ConfirmPassError == false) {
        try {
            // mysql query for customer table
            $Upload_query = "INSERT INTO customer_detail(Account_No, C_First_Name, C_Last_Name, C_Father_Name, C_Mother_Name, C_Birth_Date, C_Mobile_No, C_Email, C_Gender, ProfileColor, ProfileImage, Bio) VALUES('$Account_Number', '$First_Name', '$Last_Name', '$Father_Name', '$Mother_Name', '$Birth_Date', '$Mobile_Number', '$Email', 'Not Available', '$hex', '', '')";


            // sql query for login table
            $login_query = "INSERT INTO login(AccountNo, Username, Password, Status, State, AuthKey) VALUES('$Account_Number', '$Username', '$hashPass', '$Account_Status', '0', '0')";

            // sql query for Accounts table
            $account_query = "INSERT INTO accounts(AccountNo, Balance, AccountType, SavingBalance, SavingTarget, State) VALUES('$Account_Number', '$Balance', '$Account_Type', '0.0', '', '0')";

            // query execution

            mysqli_query($conn, $Upload_query) or die(mysqli_error($conn));
            mysqli_query($conn, $login_query) or die(mysqli_error($conn));
            mysqli_query($conn, $account_query) or die(mysqli_error($conn));
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    echo "success";
}

?>