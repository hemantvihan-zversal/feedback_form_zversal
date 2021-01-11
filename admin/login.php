<?php include('server.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin-Log-IN</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <style type="text/css">
    html{
    height: 100%;
    width: 100%;
}


.heading{
    margin-bottom: 2rem;
}

form{
    margin: 7% 29%;
    box-shadow: 3px 3px 20px #ccc;
    padding: 1rem 1rem 2rem 3rem;
    border-radius: 15px;
}

.form-control{
    width: 28rem;
}


.btn{
    margin: 1rem auto auto;
    background-color: #504658;
}

.btn:hover{
    border: none;
    background-color: #504658;
}



  </style>
</head>
<body>
  <form method="post" action="login.php">

  <h1 class="heading">Log In</h1>
    <div class="form-group">
    <label>Username</label>
    <input class="form-control" type="text" name="username" required>
    </div>
    <div class="form-group ">
    <label>Password</label>
    <input class="form-control" type="password" name="pswrd" required>
    </div>
    <div class="adminLoginButton">
      <button type="submit" class="btn btn-success btn-lg" name="login_user">Login</button>
    </div>
  </form>
</body>
</html>

