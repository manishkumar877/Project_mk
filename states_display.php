<?php
include "header.php";
include "dbname.php";
include('authentication.php');
?>

<h2 class="text-center">Display States</h2>
<br><br>

<section class="Containers">
    <?php
    // Include database connection file
    include "dbname.php";

    // Query to retrieve data from the database
    $sql = "SELECT b.id,b.name AS country_name, a.country_id, a.name FROM states a
    JOIN country b ON a.country_id = b.id";

    // Execute query
    $result = mysqli_query($conn, $sql);

    // Check if there are any records
    if (mysqli_num_rows($result) > 0) {
        // Start table
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Country Name</th>
                        <th>State Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

        $count = 1; // Counter for country number

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $count++ . "</td>
                    <td>" . $row["country_name"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>
                        <a href='states_edit.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='states_delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                  </tr>";
        }
        // End table
        echo "</tbody></table>";
    } else {
        // If no records found
        echo "<div class='alert alert-warning'>0 results</div>";
    }

    // Close connection
    mysqli_close($conn);
    ?>
</section>

<?php
include "footer.php";
?>
