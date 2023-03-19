<?php
    
    session_start();

    // Include connection page into this page
    include 'connection.php';

    // checking Email is set or not
    if (isset($_POST['EmailAddress'])) {

        /* storing Email in varible using mysqli_real_escape_string function to remove special charaters like double quotes or etc */
        $Email = mysqli_real_escape_string($conn, $_POST['EmailAddress']);

       // sql query to check email no is available or not
        $query2 = "SELECT * FROM customer_detail WHERE C_Email = '".$Email."'";

        // stroing result rows in variable
        $result2 = mysqli_query($conn, $query2);
                
          // this single line perform most important role this line print output and this output is send to the ajax
        echo mysqli_num_rows($result2);
    }

    // checking Username is set or not
    if (isset($_POST['Username'])) {

      /* storing username in varible using mysqli_real_escape_string function to remove special charaters like double quotes or etc */
      $Username = mysqli_real_escape_string($conn, $_POST['Username']);

     // sql query to check username no is available or not
      $query3 = "SELECT * FROM login WHERE Username = '".$Username."'";

      // stroing result rows in variable
      $result3 = mysqli_query($conn, $query3);
              
        // this single line perform most important role this line print output and this output is send to the ajax
      echo mysqli_num_rows($result3);
  }
