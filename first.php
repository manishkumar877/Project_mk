<?php
include "header.php";
include "dbname.php";
include('authentication.php');


?>
<h2 class="text-center">Form</h2>
<br><br>
<section class="Containers">
    <form action="process.php" method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="Please Enter First Name">
        </div>
        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="Please Enter Last Name">
        </div>
        <div class="col-12">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="address" placeholder="1234 Main St">
        </div>
        <div class="col-md-6">
            <label class="form-label">State</label>
            <select name="sel_state" id="sel_state_id" name="state" class="form-select">
                <option value="">Select State</option>
                <?php
                $sql_state = "SELECT * FROM states";
                $result1 = mysqli_query($conn, $sql_state);
                while ($row1 = mysqli_fetch_array($result1)) {
                    $id = $row1['id'];
                    $name = $row1['name'];
                ?>
                   <option value="<?php echo $id; ?>" <?php if ($id == $id) { echo "selected"; } ?>><?php echo $name; ?></option>

                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">City</label>
            <select  id="" name="city" class="form-select">
                <option value="">Select City</option>
            <?php
            $sql_city ="SELECT * From cities";
            $result= mysqli_query($conn,$sql_city);
            while($row1 =mysqli_fetch_array($result)){
                $id =$row1['id'];
                $name=$row1['name'];
                ?>
              <option value="<?php echo $id; ?>" <?php if ($id == $id) { echo "selected"; } ?>><?php echo $name; ?></option>
                <?php
            }
            ?>
            </select> 
        </div>
     
        <div class="col-md-6">
            <label class="form-label">Interest</label><br>
            <?php
            $m_interest = ""; 
            $sports = explode(",", $m_interest);
            $interest = mysqli_query($conn, "SELECT distinct * from interest");
            while ($i = mysqli_fetch_array($interest)) {
                $name = $i['name'];
                $id = $i['id'];
            ?>
                <input type="checkbox" name="interest[]" value="<?php echo $id; ?>" <?php if (in_array($id, $sports)) { echo "checked"; } ?>>
                <?php echo $i['name']; ?>
            <?php
            }
            ?>
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
