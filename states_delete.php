<?php
include "dbname.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM states WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data deleted successfully');
        window.location.href='states_display.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: states_index.php");
    exit();
}
?>
