<?php


require 'database.php';

if($_REQUEST['cmd']=='add'){

$name=$_REQUEST['name'];
$type=$_REQUEST['type'];
$vnv=$_REQUEST['vnv'];
$description=$_REQUEST['description'];
$rate=$_REQUEST['rate'];
$imgPath='';
if (!empty(basename($_FILES["fileToUpload"]["name"])))
{
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imgPath='/'.$target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}	
}

$insertquery="insert into itemDetails(name,type,nvOrVeg,description,imgPath,rate,delFlag) values('".$name."','".$type."','".$vnv."','".$description."','".$imgPath."','".$rate."',0)";
mysql_query($insertquery);
}

if($_REQUEST['cmd']=='delete'){
	
$itemid=$_REQUEST['item'];
//$deletequery="delete from itemDetails where itemNo='".$itemid."'";
$deletequery="update itemDetails set delFlag = 1 where itemNo='".$itemid."'";
mysql_query($deletequery);	
}

if($_REQUEST['cmd']=='edit'){
$itemid=$_REQUEST['item'];	
$name=$_REQUEST['name'];
$type=$_REQUEST['type'];
$vnv=$_REQUEST['vnv'];
$description=$_REQUEST['description'];
$rate=$_REQUEST['rate'];

if (!empty(basename($_FILES["fileToUpload"]["name"])))
{
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imgPath='/'.$target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}	


$updatequery="update itemDetails i set i.name='".$name."',i.type='".$type."',i.nvOrVeg='".$vnv."',i.description='".$description."',i.imgPath='".$imgPath."',i.rate='".$rate."' where i.itemNo='".$itemid."'";
mysql_query($updatequery);
}
else{
	
	$updatequery="update itemDetails i set i.name='".$name."',i.type='".$type."',i.nvOrVeg='".$vnv."',i.description='".$description."',i.rate='".$rate."' where i.itemNo='".$itemid."'";
mysql_query($updatequery);
	
}
}

header("Location: updateMenu.php");
?>
