<?php
require'../connect.php';

$pswrd=$username=$about="";
$ErrMsg=""; 
session_start();
 //validating form inputs
function test_input($data) {
  $data = trim($data); //removes unnecessary characters like space etc
  $data = stripslashes($data); //removes backslashes
  $data = htmlspecialchars($data);//treats special characters  like html tags
  return $data;
}
if (isset($_POST["login_user"])) 
{
  if (empty($_POST["username"])) {
    $ErrMsg = "Username is required<br>";
 							 } 
 	else{
 		$username=test_input($_POST['username']);
 	}
  if (empty($_POST["pswrd"])) {
    $ErrMsg.="Password can't be empty<br>";
  								} 
  	else {
    $pswrd = $_POST["pswrd"];
  		}
//data insertion using pdo
  		 if (empty($ErrMsg)) {
  	            $query = "SELECT * FROM admin WHERE username = :username AND pswrd = :pswrd";  
                $statement = $conn->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $username,  
                          'pswrd'     =>     $pswrd
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["username"] = $_POST["username"];  
                     header("location:index.php");  
                }  
                else {
  		            echo '<script language="javascript">';
                  echo 'alert("Wrong username password combination")';
                  echo '</script>';
  	                  }
                              }

 }
// edit about us
 if (isset($_POST["edit"])){
   if (empty($_POST["about"])) {
    $ErrMsg = "Can't be empty<br>";
                               } 
  else{
    $about=test_input($_POST['about']);
      }
      if(empty($ErrMsg)){
       
                     $stmt = $conn->prepare('update admin set about=:about where username=:username');
                     $stmt->execute(['about'=>$about,'username'=>$_SESSION["username"]]);
                          }  
                else{
                 echo '<script language="javascript">';
                  echo 'alert("Something went wrong.About not updated")';
                  echo '</script>';
                }
                        
}
// edit photo gallery
 if (isset($_POST["delete_data"])){
              
              $id=test_input($_POST['id']);
              $query = "SELECT * FROM gallery WHERE id = :id";  
                $statement = $conn->prepare($query);  
                $statement->execute(
                     array(  
                          'id'     =>     $id  
                     )  
                );  
                $count = $statement->rowCount();  
                if ($count>0) {
                                  $stmt = $conn->prepare('Delete from gallery where id=:id');
                                  $stmt->execute(['id'=>$id]);
                                  header("location:index.php");
                                }                
                else{
                 echo '<script language="javascript">';
                  echo 'alert("Something went wrong.Image not deleted")';
                  echo '</script>';
                }
              } 
//upload photo
if (isset($_POST['upload'])){ 
              // name of the uploaded file
                             $filename = $_FILES['fileToUpload']['name'];

                           // destination of the file on the server
                           $destination = '../image/' . $filename;

                           // get the file extension
                            $extension = pathinfo($filename, PATHINFO_EXTENSION);

                             // the physical file on a temporary uploads directory on the server
                            $file = $_FILES['fileToUpload']['tmp_name'];
                            $size = $_FILES['fileToUpload']['size'];

    if (!in_array($extension, ['gif', 'jfif','jpg','png'])) {
        echo '<script language="javascript">';
                  echo 'alert("Something went wrong.Only jpg gif jfif png files can be uploaded")';
                  echo '</script>';
          } 
          else {
           // move the uploaded (temporary) file to the specified destination
             if (move_uploaded_file($file, $destination)) {
            $stmt = $conn->prepare('insert into gallery(image) values(:image)');
            $stmt->execute(['image'=>$filename]);
               echo "<script>
                 alert('File uploaded');
              </script";
                                                  header("location:index.php");

                                                           } 
               }
                        }   



  //delete user comments
   if (isset($_POST['delete_comment'])){ 
    $name=$_POST['name'];
    $stmt = $conn->prepare('Delete from feedback_table where name=:name');
    $stmt->execute(['name'=>$name]);
   }         
   //update comment status
   if (isset($_POST['Public'])){ 
    $name=$_POST['name'];
    $c_status='0';
    $stmt = $conn->prepare('update feedback_table set comment_status=:c_status where name=:name');
    $stmt->execute(['c_status'=>$c_status,'name'=>$name]);
   }     
   if (isset($_POST['Private'])){ 
    $name=$_POST['name'];
    $c_status='1';
    $stmt = $conn->prepare('update feedback_table set comment_status=:c_status where name=:name');
    $stmt->execute(['c_status'=>$c_status,'name'=>$name]);
   }            
?>