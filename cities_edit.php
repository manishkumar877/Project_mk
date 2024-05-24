<?php
include "header.php";
include "dbname.php";
include('authentication.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $states_id = $_POST['states_id'];
    $id = $_POST['id'];

    $sql = "UPDATE cities SET name='$name', states_id='$states_id' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data updated successfully');
        window.location.href='cities_display.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cities WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<h2 class="text-center">Edit Cities</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
        <label for="states_id" class="form-label">States Name</label>
        <select id="states_id" name="states_id" class="form-select">
            <option value="">Select States</option>
            <?php
            $sql_states = "SELECT * FROM states";
            $result_states = mysqli_query($conn, $sql_states);
            while ($row_states = mysqli_fetch_assoc($result_states)) {
                $states_id = $row_states['id'];
                $states_name = $row_states['name'];
                ?>
                <option value="<?php echo $states_id; ?>" <?php if ($states_id == $row['states_id']) { echo "selected"; } ?>><?php echo $states_name; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Cities Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
include "footer.php";
?>
