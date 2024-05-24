<?php
include('authentication.php');
include "dbname.php";

  if (isset($_POST['submit'])) {

    $first_name = $_POST['first_name'];

    $last_name = $_POST['last_name'];

    $email = $_POST['email'];

    $gender = $_POST['gender'];

    $sql = "INSERT INTO `form`(`first_name`, `last_name`, `email`,`gender`) VALUES ('$first_name','$last_name','$email','$gender')";

    $result = $conn->query($sql);

    if ($result == TRUE) {

      echo "New record created successfully.";

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

    $conn->close(); 

  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    
</head>
<body>

<?php
include "navbar.php";
                if(isset($_SESSION['message'])){
                    echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
                    unset($_SESSION['message']);
                }
            ?>
           
 
    <div class="container">
        <div >
<form action="" method="POST">


    <legend>Personal information:</legend>

    First name:<br>

    <input type="text" name="first_name">

    <br>

    Last name:<br>

    <input type="text" name="last_name">

    <br>

    Email:<br>

    <input type="email" name="email">

    <br>

    Gender:<br>

    <input type="radio" name="gender" value="Male">Male

    <input type="radio" name="gender" value="Female">Female

    <br>

    interest:<br>

 <?php
    echo $m_interest;  
	$sports = explode(",","$m_interest");  
	$interest= mysqli_query($conn,"SELECT distinct * from interest");
	while($i= mysqli_fetch_array($interest)){
	$name = $i['name'];		
	$id = $i['id'];  
	
	?>
   <input type="checkbox" name="interest[]" value="<?php echo $id;?>"
   <?if (in_array($id,$sports)== $id){?>checked<?}?>><?php echo $i['name']?>
   &nbsp;
	<?php                           
	}
	?>

<br><br>

    <input type="submit" name="submit" value="submit">



       </form>
           
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>