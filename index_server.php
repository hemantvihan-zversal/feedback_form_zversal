<?php
require_once 'connect.php';

$name=$email=$feedback="";
$ErrMsg=""; 
 //validating form inputs
function test_input($data) {
  $data = trim($data); //removes unnecessary characters like space etc
  $data = stripslashes($data); //removes backslashes
  $data = htmlspecialchars($data);//treats special characters  like html tags
  return $data;
}
 
 // getting input from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (empty($_POST["name"])) {
    $ErrMsg = "Name is required<br>";
 							 } 
  else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) { //checks if name contain only text and white spaces
      $ErrMsg.="Only letters and white space are allowed in name<br>";
  												}
  		}

  if (empty($_POST["email"])) {
    $ErrMsg.="Email is required";
  							 } 
  else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //checks if email is well formed
         $ErrMsg.="Invalid email format<br>";
                                             }
    $sql="select * from feedback_table where email = '$email'";
    $result = $conn->query($sql);
	    if ($result->rowCount() > 0){ //checks for feedbacks in history
	    		$ErrMsg.="We have already received feedback from this email.Thank you:)<br>";
	    		}
       }

  if (empty($_POST["feedback"])) {
    $ErrMsg.="Feedback can't be empty<br>";
  								} 
  	else {
    $feedback = test_input($_POST["feedback"]);
  		}
//data insertion using pdo
  		if(empty($ErrMsg)){
			$stmt = $conn->prepare('insert into feedback_table(name,email,feedback) values(:name,:email,:feedback)');
			$stmt->execute(['name'=>$name,'email'=>$email,'feedback'=>$feedback,]);
        }				
													
}

 


?>