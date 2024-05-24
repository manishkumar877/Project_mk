<?php

session_start(); // Ensure session is started

include "header.php";
include "dbname.php"; // Assuming this file contains database connection code
include 'authentication.php'; // Ensure this file contains session checks

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

$loggedInUserId = $_SESSION['id'];
$loggedInUsername = $_SESSION['username']; // If needed

// For debugging purposes only, ensure this does not interfere with header calls
// echo $loggedInUserId;
// echo $loggedInUsername;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Check if menu items are selected
    if (isset($_POST['menu']) && is_array($_POST['menu'])) {
        // Prepare the SQL statement
        $stmt = mysqli_prepare($conn, "INSERT INTO navbar (username, menu) VALUES ($username,$menu)");
        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ii", $loggedInUserId, $menu);

            // Loop through selected menu items and insert into database
            foreach ($_POST['menu'] as $itemId) {
                $menu = intval($itemId);
                // Execute the prepared statement
                mysqli_stmt_execute($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);

            // Redirect after successful insertion
            echo "<script>
            alert('Data inserted successfully');
            window.location.href='menu_as.php';
            </script>";
            exit();
        } else {
            // Handle statement preparation error
            echo "Error: " . mysqli_error($conn);
        }
    }
}
ob_end_flush(); // Flush the output buffer
?>

<br>
<h2>All Menu</h2>
<div class="container">
    <form action="" method="POST">
        <div class="row">
            <button type="submit" name="submit" class="btn btn-primary">Insert Selected Items</button>
            <div class="col-md-4">
                <label class="form-label">Select All</label>
                <input type="checkbox" id="select-all-checkbox"><br> <!-- Select All Checkbox -->
                <table class="table table-bordered"> <!-- Add table-bordered class -->
                    <thead>
                        <tr>
                            <th>Menu Name</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch all menu items
                        $result = mysqli_query($conn, "SELECT id, name, parent_id FROM menu_items ORDER BY parent_id, name");

                        // Array to hold menu items
                        $menuItems = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $menuItems[] = $row;
                        }

                        // Function to display menu items recursively
                        function displayMenu($items, $parentId = 0, $level = 0)
                        {
                            foreach ($items as $item) {
                                if ($item['parent_id'] == $parentId) {
                                    $name = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
                                    $id = $item['id'];
                                    $indent = str_repeat('&nbsp;', $level * 4); // Indentation for child items
                                    $style = $parentId == 0 ? 'font-weight: bold;' : '';

                                    echo "<tr style=\"$style\"><td>$indent $name</td><td><input type=\"checkbox\" name=\"menu[]\" value=\"$id\"></td></tr>";

                                    // Recursive call to display children
                                    displayMenu($items, $id, $level + 1);
                                }
                            }
                        }

                        // Display the menu items
                        displayMenu($menuItems);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript -->
<script>
    // Function to handle the "Select All" checkbox
    document.getElementById('select-all-checkbox').addEventListener('change', function (event) {
        var checkboxes = document.querySelectorAll('input[name="menu[]"]');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = event.target.checked;
        });
    });
</script>
