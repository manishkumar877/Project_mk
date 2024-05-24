<?php
include "header.php";
include "dbname.php";
include('authentication.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM interest WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data deleted successfully');
        window.location.href='interest_display.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: interest_index.php");
    exit();
}
?>
