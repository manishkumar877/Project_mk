<?php
include "dbname.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $country_id = $_POST['country_id'];


    
    $sql = "INSERT INTO states (name,country_id) VALUES ('$name','$country_id')";
     if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data inserted successfully');
        window.location.href='states_index.php';
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










