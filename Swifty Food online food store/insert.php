<?php

$name=$_POST['names'];
$email=$_POST['emails'];
$pass=$_POST['passwds'];
$mobileno=$_POST['mobilenos'];
$aptnoname=$_POST['mobilenos'];
$place=$_POST['places'];
$zipcode=$_POST['zipcodes'];
if ($name!=""){
	$db = new PDO('mysql:host=localhost;dbname=swiftyfood;charset=utf8mb4', 'root', '28111988');
	$stmt=$db->prepare("INSERT INTO userCredentials(userId,userName,password) VALUES(:userId,:userName,:password)");
	$stmt->execute(array(':userId' => '', ':userName' => $name, ':password' => $pass));
	$affected_rows = $stmt->rowCount();
	$stmt=$db->prepare("SELECT userId FROM userCredentials WHERE userName=?");
	$stmt->execute(array($name));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$theuserId = $row['userId'];
	echo $theuserId;
	$stmt=$db->prepare("INSERT INTO userDetails(userId,userName,emailId,mobileNo,aptNoName,place,zipCode) VALUES(:userId,:userName,:emailId,:mobileNo,:aptNoName,:place,:zipCode)");
	$stmt->execute(array(':userId' => $theuserId, ':userName' => $name, ':emailId' => $email, ':mobileNo' => $mobileno,':aptNoName' => $aptnoname,':place' => $place, ':zipCode' => $zipcode));
	$affected_rows1 = $stmt->rowCount();
	if ($affected_rows!=0 and $affected_rows1!=0 ){
		echo 0;
	}else{
		echo 1;
	}
}else{
	echo 1;
}

?>
