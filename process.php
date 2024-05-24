<?php
include "header.php";
include "dbname.php";
include('authentication.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['sel_state'];
    $interest1 = $_POST['interest'];
    $interest="";  
    foreach($interest1 as $chk1)  
       {  
          $interest.= $chk1.",";  
       }  


    
    $sql = "INSERT INTO reg (first_name, last_name, address, city, state, interest) VALUES ('$first_name', '$last_name', '$address', '$city', '$state', '$interest')";
     if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data inserted successfully');
        window.location.href='first.php';
      </script>";
exit();
    } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
} else {
    // Redirect to the form page if the form is not submitted
    header("Location: your_form_page.php");
    exit();
}
?>










