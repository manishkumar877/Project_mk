<?php

include "header.php";
include "dbname.php";
include('authentication.php');

?>

<h2 class="text-center">Display Cities</h2>
<br><br>

<section class="Containers">
    <?php
    // Include database connection file
    include "dbname.php";

    // Query to retrieve data from the database
    $sql = "SELECT b.id,b.name AS states_name, a.states_id, a.name
    FROM cities a
    JOIN states b ON a.states_id = b.id";

    // Execute query
    $result = mysqli_query($conn, $sql);

    // Check if there are any records
    if (mysqli_num_rows($result) > 0) {
        // Start table
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>States Name</th>
                        <th>Cities Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

        $count = 1; // Counter for country number

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $count++ . "</td>
                    <td>" . $row["states_name"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>
                        <a href='cities_edit.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='cities_delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
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
