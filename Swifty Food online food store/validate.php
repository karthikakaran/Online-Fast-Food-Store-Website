<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

$name=$_POST['names'];

if ($name!=""){
	$db = new PDO('mysql:host=localhost;dbname=swiftyfood;charset=utf8mb4', 'root', '28111988');
	//mysql_select_db("swiftyfood");
	$stmt=$db->prepare("SELECT * FROM userCredentials WHERE userName=?");
	$stmt->execute(array($name));
	$rows = $stmt->rowCount();
	//echo $rows;
	if ($rows!=0){
		echo 0;
	}else{
		echo 1;
	}
}else{
	echo 1;
}
?>