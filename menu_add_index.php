<?php
include "header.php";
include "dbname.php";
include('authentication.php');


$selectedParentId = null;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['parent_id'])) {
    $selectedParentId = $_POST['parent_id'];
}
?>
<h2 class="text-center">Form</h2>
<br><br>
<section class="Containers">
    <form action="menu_process.php" method="post" class="row g-3">
    <div class="col-md-12">
    <label class="form-label">Parent Name</label>
    <select id="parent_id" name="parent_id" class="form-select">
        <option value="">Select Parent</option>
        <?php
        // Assuming $conn is your database connection
        $sql = "SELECT id, name FROM menu_items WHERE parent_id = 0";
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $selected = ($id == $selectedParentId) ? 'selected' : '';
            echo "<option value=\"$id\" $selected>$name</option>";
        }
        ?>
    </select>
</div>

        <div class="col-md-12">
            <label class="form-label">Menu Name</label>
            <input type="text" class="form-control" name="name" placeholder="Please Enter Menu Name">
        </div>
        <div class="col-md-12">
            <label class="form-label">URL</label>
            <input type="text" class="form-control" name="url" placeholder="Please Enter URL">
        </div>
        <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</section>
<script>
    
</script>

<?php
include "footer.php";
?>
