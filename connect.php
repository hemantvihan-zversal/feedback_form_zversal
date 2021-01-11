<?php
$dsn="mysql:host=localhost;dbname=feedback_db";//dsn is data source name
$username="root";
$pswrd="";
try{
	$conn=new PDO($dsn,$username,$pswrd); //pdo object or instance
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //makes sure that we all the error should be handled in the exception mode in the catch block
}
catch(PDOException $e)
{
	echo "Sorry something went wrong".$e->getMessage(); //here $e tells us where problem occured
}
?>