<?php
include "dbname.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
       
    $sql = "INSERT INTO interest (name) VALUES ('$name')";
     if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data inserted successfully');
        window.location.href='interest_index.php';
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










