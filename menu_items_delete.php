<?php
include "dbname.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM menu_items WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data deleted successfully');
        window.location.href='menu_items_display.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: menu_add_index.php");
    exit();
}
?>
