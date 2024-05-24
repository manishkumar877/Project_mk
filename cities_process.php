<?php
include "header.php";
include "dbname.php";
include('authentication.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $states_id = $_POST['states_id'];


    
    $sql = "INSERT INTO cities (name,states_id) VALUES ('$name','$states_id')";
     if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data inserted successfully');
        window.location.href='cities_index.php';
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










