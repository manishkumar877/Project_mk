<?php
include "header.php";
include "dbname.php";
include('authentication.php');

$menuId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$menuData = [];
$selectedParentId = null;


if ($menuId) {
    // Fetch the existing menu item data
    $sql = "SELECT id, name, url, parent_id FROM menu_items WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $menuId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $menuData = mysqli_fetch_assoc($result);
            $selectedParentId = $menuData['parent_id'];
        }
        mysqli_stmt_close($stmt);
    }
}

// Update the menu item if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $menuId = intval($_POST['id']);
    $name = $_POST['name'];
    $url = $_POST['url'];
    $parentId = $_POST['parent_id'];

    $sql = "UPDATE menu_items SET name = $name, url = $url, parent_id = $parent_id WHERE id = $id";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssii', $name, $url, $parentId, $menuId);
    mysqli_stmt_execute($stmt);
    echo "<script>
    alert('Data updated successfully');
    window.location.href='menu_items_display.php';
    </script>";
    exit();
}
?>

<h2 class="text-center">Edit Menu Item</h2>
<br><br>
<section class="Containers">
    <form action="edit.php?id=<?php echo $menuId; ?>" method="post" class="row g-3">
        <input type="hidden" name="id" value="<?php echo $menuId; ?>">

        <div class="col-md-12">
            <label class="form-label">Parent Name</label>
            <select id="parent_id" name="parent_id" class="form-select">
                <option value="">Select Parent</option>
                <?php
                // Fetch parent menu items
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
            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($menuData['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Please Enter Menu Name">
        </div>
        <div class="col-md-12">
            <label class="form-label">URL</label>
            <input type="text" class="form-control" name="url" value="<?php echo htmlspecialchars($menuData['url'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Please Enter URL">
        </div>
        <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</section>

<?php
include "footer.php";
?>
