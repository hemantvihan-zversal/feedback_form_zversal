<?php 
include 'index_server.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Feedback</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<nav class="navbar fixed-top" style="background-color: #808080">
  <ul style="margin-left: 7rem">
    <li><a href="index.php" style="color: white">Home</a></li>
    <li><a href="#about-us"  style="color: white">About</a></li>
    <li><a style="color: white" href="#gallery">Gallery</a></li>
    <li><a  href="#contact"style="color: white">
    Contact
  </a></li>
    
  </ul>
</nav>
<!-- About us -->
<div class="container" id="about-us" style="margin-top: 5rem">
   <p class="display-3">About us</p>
   <?php
 	$sql = "select * from admin";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    echo "<p style='text-align:justify'>".$row['about']."</p>";
    ?>
<div>
<!-- Gallery card -->
<hr class=" container" style="margin-top:1rem">
<div id="gallery">
<p class="display-3">Photo Gallery</p>
 <?php
 $sql = "select * from gallery";
 $result = $conn->query($sql);


  // output data of each row
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    ?>
<img src="<?php echo "image/".$row['image']; ?>" width="200" height="200">      
  <?php
}  
 ?>
</div>
</div>
    
</div>


<!-- //feedback form -->
<hr class="container" id="contact">
<div class="row" style="margin-top: 4rem">
<div class="col-sm-6 left">
  <div class="content">
  <h2>Hello!!</h2>
  <p class="text-muted" style="font-size:24px; ">We value your suggestions.<br> Please fill this form and help us in making this place beautiful.</p>
  </div>
</div>
<div class="col-sm-6 right">
  <div id="feedback-form">
  <h4>Feedback Form</h4>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <!-- htmlspecialchars converts special characters into html tags hence makes it secure -->
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" placeholder="Enter your name" name="name" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" placeholder="Enter your Email" name="email" required>
    </div>
    <div class="form-group">
      <label>Feedback:</label>
      <textarea class="form-control" rows="5" placeholder="Please enter your feedback" name="feedback" required></textarea>
    </div>
          <span  ><?php echo $ErrMsg;?></span>
    <button type="submit" class="btn btn-secondary">Submit</button>
  </form>
</div>
</div>
</div>


<!-- Comments section
 -->
<hr class=" container">
<div class="comments">
<div class="container row">
<div class="jumbotron jumbotron-fluid offset-sm-3 col-sm-6 offset-sm-3">
<p class="display-3">Latest comments</p>
     <?php
     $stmt=$conn->query('select * from feedback_table order by reg_date desc limit 3'); 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                      echo "<div class='heading'>".$row['name']."<p class='text-muted' >".$row['reg_date']."</p></div>";
                      echo "<p style='text-align:justify'>".$row['feedback']."</p>";
                                                  }
     ?>
    
 
</div>
</div>




  <!-- //footer -->
<footer class="social-footer">
  <div class="social-footer-icons">
    <ul class="menu simple" style="margin-bottom: 0">
      <li><a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true" style="color:white"></i></a></li>
      <li><a href="https://www.instagram.com/?hl=en"><i class="fa fa-instagram" aria-hidden="true"style="color:white"></i></a></li>
      <li><a href="https://www.pinterest.com/"><i class="fa fa-pinterest-p" aria-hidden="true" style="color:white"></i></a></li>
      <li><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter" aria-hidden="true" style="color:white"></i></a></li>
      <p>&copy All rights reserved</p>
    </ul>
  </div>
</footer>
</body>
</html>

