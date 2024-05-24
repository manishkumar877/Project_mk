<?php
include "header.php";
include "dbname.php";
include('authentication.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parent_id = $_POST['parent_id'];
    $name = $_POST['name'];
    $url = $_POST['url'];


    
    $sql = "INSERT INTO menu_items (parent_id,name,url) VALUES ('$parent_id','$name','$url')";
     if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data inserted successfully');
        window.location.href='menu_add_index.php';
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










