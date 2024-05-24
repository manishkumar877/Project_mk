<?php
include "header.php";
include "dbname.php";
include('authentication.php');
?>
<h2 class="text-center">Form</h2>
<br><br>
<section class="Containers">
    <form action="states_process.php" method="post" class="row g-3">
    <div class="col-md-6">
            <label class="form-label">Country Name</label>
            <select  id="" name="country_id" class="form-select">
            <option value="">Select Country</option>
            <?php
            $sql_city ="SELECT * From country";
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
            <label class="form-label">State Name</label>
            <input type="text" class="form-control" name="name" placeholder="Please Enter Country Name">
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
