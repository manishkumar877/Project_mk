<?php
include "header.php";
include "dbname.php";
include('authentication.php');
?>

<h2 class="text-center">Display</h2>
<br>

<section class="Containers">
<form method="GET" class="row g-3" id="filterForm">
    <div class="col-md-6">
        <label class="form-label">First Name</label>
        <select name="first_name" class="form-select" id="first_name">
            <option value="">Select Name</option>
            <?php
            $sql_state = "SELECT DISTINCT first_name FROM reg";
            $result1 = mysqli_query($conn, $sql_state);
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $first_name = $row1['first_name'];
                echo "<option value='$first_name' " . (isset($_GET['first_name']) && $_GET['first_name'] == $first_name ? 'selected' : '') . ">$first_name</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Last Name</label>
        <select name="last_name" class="form-select" id="last_name">
            <option value="">Select Name</option>
            <?php
            $sql_state = "SELECT DISTINCT last_name FROM reg";
            $result1 = mysqli_query($conn, $sql_state);
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $last_name = $row1['last_name'];
                echo "<option value='$last_name' " . (isset($_GET['last_name']) && $_GET['last_name'] == $last_name ? 'selected' : '') . ">$last_name</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" name="filter" class="btn btn-primary" id="filterBtn">Filter</button>
    </div>
</form>

<BR><BR>

<?php
$whereClauses = [];
if (isset($_GET['first_name']) && $_GET['first_name'] != '') {
    $first_name = mysqli_real_escape_string($conn, $_GET['first_name']);
    $whereClauses[] = "a.first_name = '$first_name'";
}
if (isset($_GET['last_name']) && $_GET['last_name'] != '') {
    $last_name = mysqli_real_escape_string($conn, $_GET['last_name']);
    $whereClauses[] = "a.last_name = '$last_name'";
}
$whereSql = count($whereClauses) > 0 ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

$sql = "SELECT a.*, b.name AS state_name, c.name AS city_name, GROUP_CONCAT(d.name SEPARATOR ', ') AS interest_names 
FROM reg a 
JOIN states b ON a.state = b.id 
JOIN cities c ON a.city = c.id 
JOIN interest d ON FIND_IN_SET(d.id, a.interest)
$whereSql
GROUP BY a.id";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<table class='table table-bordered'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Interest</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";

    $count = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$count}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['address']}</td>
                <td>{$row['state_name']}</td>
                <td>{$row['city_name']}</td>
                <td>{$row['interest_names']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                </td>
              </tr>";
        $count++;
    }

    echo "</tbody></table>";
} else {
    echo "<div class='alert alert-warning'>Error executing query: " . mysqli_error($conn) . "</div>";
}

mysqli_close($conn);
?>
</section>

<?php
include "footer.php";
?>

<script>
document.getElementById('filterForm').addEventListener('submit', function(event) {
    var firstName = document.getElementById('first_name').value;
    var lastName = document.getElementById('last_name').value;
    
    if (!firstName && !lastName) {
        event.preventDefault();
        alert('Please select at least one filter criteria.');
    }
});
</script>
