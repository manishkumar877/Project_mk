<?php
include "header.php";
include "dbname.php";
include('authentication.php');
?>
<h2 class="text-center">Form</h2>
<br><br>
<section class="Containers">
    <form action="interest_process.php" method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Interest</label>
            <input type="text" class="form-control" name="name" placeholder="Please Enter Interest Name">
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
