<?php
include "header.php";
include "dbname.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $id = $_POST['id'];

    $sql = "UPDATE interest SET name='$name'WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data updated successfully');
        window.location.href='interest_display.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM interest WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<h2 class="text-center">Edit Interest</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
        <label for="name" class="form-label">Interest Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
include "footer.php";
?>
