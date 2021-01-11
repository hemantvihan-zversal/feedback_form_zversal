<?php 
require 'server.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
   if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  } 
 $sql = "select * from admin";
  $result = $conn->query($sql);
  $row = $result->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin-dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css">
   

  </style>
</head>
<body style="background-color: #FBE9E7">
  <!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light navigation-bar" style="margin-bottom:3rem">
        <div class="container">
         <p style="font-size: 40px; color:#B12100">Hey <?php 
                echo $row['username'];
                ?>!!</p>
        <div class="collapse navbar-collapse" id="navbarText">
         
    
            <ul class="navbar-nav justify-content-end" style="margin-left: 48rem;">
                <li class="nav-item">
                    <a href="index.php?logout='1'" class="btn btn-danger">Log Out</a>
                </li>
            </ul>
            
        </div>
    </div>
    </nav>

    <!-- about us -->
    
      <div class="container" id="about-us" style="">
   <p style="color: #C62828; font-size: 30px; margin-top: 0.5rem;">About us</p>
   <?php
    echo "<p style='text-align:justify'>".$row['about']."</p>";
    ?>

   <button href="#" data-toggle="modal" data-target="#myModal" class="btn btn-outline-danger">
    Edit
  </button>
</div>
<!-- Gallery -->
<hr class=" container" style="margin-top:1rem">
<div class="container">
<div>  
<p style="color: #C62828; font-size: 30px; margin-top: 0.5rem;">Photo Gallery</p>
 <?php
 $sql = "select * from gallery";
 $result = $conn->query($sql);


  // output data of each row
  while($row_1 = $result->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div style="display:inline-grid;">
    <div class="card" style="width: 200px; height: 250px; margin:4px 4px 4px 4px">
  <img class="card-img-top" src="<?php echo "../image/".$row_1['image']; ?>" alt="Card image cap" style="width: 200px; height: 250px;">
</div>
</div>
  <?php
}  
 ?>

</div>
<div>
   <button href="#" data-toggle="modal" data-target="#myModal-2"  style="margin-top:2rem" class="btn btn-outline-danger">
    Edit
  </button>
</div>
</div>

<!-- //edit user comments
 -->
 <hr class=" container">
<div class="comments">
<div class="container row">
<div class="col-sm-8 offset-sm-4 container " style="margin-left: 6rem;">
<p style="color: #C62828; font-size: 30px; margin-top: 0.5rem;">Latest comments</p>
     <?php
     $stmt=$conn->query('select * from feedback_table order by reg_date desc'); 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                      echo "<form action='index.php' method='post'><div class='heading' style='margin-top:3rem;'>".$row['name']."<br>".$row['email']."<p class='text-muted' >".$row['reg_date']."</p></div>";
                      echo "<p style='text-align:justify; font-weight:lighter;'>".$row['feedback']."                      </p>";
                      ?>
                      <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                      <button class='btn btn-danger' type='submit' name='delete_comment' style='margin-right: 1rem;'>Delete</button></form>
                        <?php                          } ?>
</div>
</div>
</div>



<!-- Edit about us -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit About us</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
          <form action="index.php" method="post">
            <label>About us:</label>
              <textarea class="form-control" rows="5" name="about" required>
                <?php 
                echo $row['about'];
                ?>
              </textarea>
          </div>
          <span  ><?php echo $ErrMsg;?></span>
          <button type="submit" class="btn btn-secondary" name="edit">Submit</button>

          </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- //edit gallery -->
  <div class="modal" id="myModal-2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Gallery</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
          <form action="index.php" method="post">
            <h4>Available Images</h4>
    <?php
    echo "<table class='table'>
<thead>
<tr>
<th>Image ID Id</th>
<th>Image</th>
<th>Action</th>
</tr>
</thead>";
    $sql = "select * from gallery";
    $result = $conn->query($sql);
    while($row_1 = $result->fetch(PDO::FETCH_ASSOC)) {
      echo "</tbody>
<tr>
<form action='index.php' method ='POST'>
<td><input type='text' value='" . $row_1['id'] . "' style='border:none;' name='id' readonly></td>
<td>" . $row_1['image'] . "</td>
<td><button class='btn btn-danger' type='submit' name='delete_data' style='margin-right: 1rem;'>Delete</button>
</form>
</tr>
</tbody>";
    }
    echo "</table>";
    ?>


          </form>
        <!-- //upload form -->
         <hr>
         <h4>Upload Image</h4>
       <form action="index.php" method="post" enctype="multipart/form-data" class="form-group row">

      <div class="col">Select File:</div>
      <div class="col"><input type="file" name="fileToUpload" /></div>
      <div class="col-5"><button class='btn btn-secondary' type='submit' name='upload'>Upload File</button></div>
    </form>
        </div>
        </div>
    </div>
  </div>



</body>
</html>