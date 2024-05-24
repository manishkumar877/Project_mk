<?php
include "header.php";
include "dbname.php";

// Initialize variables
$first_name = "";
$last_name = "";
$address = "";
$state_id = "";
$city_id = "";
$interests = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $interest = $_POST['interest'];

    // Update the database
    $sql = "UPDATE reg SET first_name='$first_name', last_name='$last_name', address='$address', state='$state', city='$city', interest='" . implode(',', $interest) . "' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Data updated successfully');
        window.location.href='display.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} elseif (isset($_GET['id'])) {
    // Fetch existing data if ID is provided
    $id = $_GET['id'];
    $sql = "SELECT * FROM reg WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Assign fetched data to variables
    if ($row) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $address = $row['address'];
        $state = $row['state'];
        $city = $row['city'];
        $interest = explode(",", $row['interest']);
    } else {
        // Handle case when no data is found for the given ID
        echo "No data found for ID: $id";
    }
}
?>

<h2 class="text-center">Edit Form</h2>
<br><br>
<section class="Containers">
    <form action="edit.php" method="post" class="row g-3">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">State</label>
            <select id="" name="state" class="form-select">
                <option value="">Select States</option>
                <?php
                $sql_states = "SELECT * FROM states";
                $result_states = mysqli_query($conn, $sql_states);
                while ($row_states = mysqli_fetch_assoc($result_states)) {
                    $id = $row_states['id'];
                    $name = $row_states['name'];
                    ?>
                    <option value="<?php echo $id; ?>" <?php if ($id == $state) { echo "selected"; } ?>><?php echo $name; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">City</label>
            <select id="" name="city" class="form-select">
                <option value="">Select city</option>
                <?php
                $sql_cities = "SELECT * FROM cities";
                $result_cities = mysqli_query($conn, $sql_cities);
                while ($row_cities = mysqli_fetch_assoc($result_cities)) {
                    $id = $row_cities['id'];
                    $name = $row_cities['name'];
                    ?>
                    <option value="<?php echo $id; ?>" <?php if ($id == $city) { echo "selected"; } ?>><?php echo $name; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Interests</label><br>
            <?php
            $interest_query = mysqli_query($conn, "SELECT * FROM interest");
            while ($i = mysqli_fetch_assoc($interest_query)) {
                $name = $i['name'];
                $id = $i['id'];
                ?>
                <input type="checkbox" name="interest[]" value="<?php echo $id; ?>" <?php if (in_array($id, $interest)) { echo "checked"; } ?>>
                <?php echo $name; ?>
            <?php } ?>
        </div>
        <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</section>

<?php
include "footer.php";
?>
