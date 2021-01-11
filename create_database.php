<?php
//creating database and tables using php
$servername="localhost";
$username="root";
$pswrd="";
try{
	$conn=new PDO("mysql:host=$servername",$username,$pswrd);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$conn->exec("Create database feedback_db");

}
catch(PDOException $e){
	echo "Something went wrong".$e->getMessage();

}
$conn=null;

//creating tables using pdo
$database="feedback_db";
try{
	$dsn=new PDO("mysql:host=$servername;dbname=$database",$username,$pswrd);
	$dsn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql= "create table feedback_table(
								id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                name varchar(255),
                                email varchar(255),
                                feedback text,
                                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                                )";
	$dsn->exec("$sql");
}
catch(PDOException $e)
{
	echo $sql.$e->getMessage();
}
?>