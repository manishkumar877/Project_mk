<?php
include "header.php";
include "dbname.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $country_id = $_POST['country_id'];
    $id = $_POST['id'];

    $sql = "UPDATE states SET name='$name', country_id='$country_id' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data updated successfully');
        window.location.href='states_display.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM states WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<h2 class="text-center">Edit State</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3">
        <label for="country_id" class="form-label">Country Name</label>
        <select id="country_id" name="country_id" class="form-select">
            <option value="">Select Country</option>
            <?php
            $sql_country = "SELECT * FROM country";
            $result_country = mysqli_query($conn, $sql_country);
            while ($row_country = mysqli_fetch_assoc($result_country)) {
                $country_id = $row_country['id'];
                $country_name = $row_country['name'];
                ?>
                <option value="<?php echo $country_id; ?>" <?php if ($country_id == $row['country_id']) { echo "selected"; } ?>><?php echo $country_name; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">State Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php
include "footer.php";
?>
