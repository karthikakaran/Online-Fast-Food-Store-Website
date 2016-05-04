<?php
require 'database.php';


			 	$itemId = $_GET['itemId'];
			 	
			 	
			 		$query = "SELECT * FROM itemdetails WHERE itemNo='".$itemId."'";
			 		$result_data = mysql_query($query);			 					 		
			 		
			 		while($row = mysql_fetch_assoc($result_data)) {
			 		
			 			echo $row['name'].'#'.$row['type'].'#'.$row['nvOrVeg'].'#'.$row['description'].'#'.$row['imgPath'].'#'.$row['rate'];
			 			 
			 		}
	
			 	

?>