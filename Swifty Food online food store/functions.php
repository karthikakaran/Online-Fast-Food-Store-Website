<?php

function get_item_name($itemid){
	$result=mysql_query("SELECT name as ITEM_NAME from itemdetails where itemNo=$itemid");
	$row=mysql_fetch_array($result);
	return $row['ITEM_NAME'];
}


function get_type($itemid){
	$result=mysql_query("SELECT type as TYPE from itemdetails where itemNo=$itemid");
	$row=mysql_fetch_array($result);
	return $row['TYPE'];
}

function get_vegnonveg($itemid){
	$result=mysql_query("SELECT nvOrVeg as VNV from itemdetails where itemNo=$itemid");
	$row=mysql_fetch_array($result);
	if($row['VNV']=='1')
		return 'VEG';
	else
		return 'NONVEG';
}

function get_description($itemid){
	$result=mysql_query("SELECT description as DESCRIPTION from itemdetails where itemNo=$itemid");
	$row=mysql_fetch_array($result);
	return $row['DESCRIPTION'];
}


function addtocart($itemid,$q){
	if($itemid<1 or $q<1) return;

	if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		if(product_exists($itemid)) return;
		$max=count($_SESSION['cart']);
		$_SESSION['cart'][$max]['itemid']=$itemid;		
		$_SESSION['cart'][$max]['qty']=$q;
		
	}
	else{
		$_SESSION['cart']=array();
		$_SESSION['cart'][0]['itemid']=$itemid;		
		$_SESSION['cart'][0]['qty']=$q;
		
	}

	
}





function product_exists($itemid){
	$itemid=intval($itemid);
	$max=count($_SESSION['cart']);
	$flag=0;
	for($i=0;$i<$max;$i++){
		
		if($itemid==$_SESSION['cart'][$i]['itemid']){
			$flag=1;
			break;
		}
		
	}
	return $flag;
}





function remove_product($itemid){
	$itemid=intval($itemid);
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		if($itemid==$_SESSION['cart'][$i]['itemid']){
			unset($_SESSION['cart'][$i]);
			break;
		}
	}
	$_SESSION['cart']=array_values($_SESSION['cart']);
	$cartCount=count($_SESSION['cart']);
	if($cartCount==0)
	unset($_SESSION['cart']);
}




function get_order_total(){
	$max=count($_SESSION['cart']);
	$sum=0;
	for($i=0;$i<$max;$i++){
		
	
		$q=$_SESSION['cart'][$i]['qty'];
		$itemid=$_SESSION['cart'][$i]['itemid'];
		
		$price=get_price($itemid);
		
		$sum+=$price*$q;
	}
	$_SESSION['sum']=$sum;
	return $sum;
	
	
}



function get_price($itemid){


	$result = mysql_query("SELECT rate AS ITEM_PRICE FROM itemdetails i WHERE i.itemNo='".$itemid."'");
	$row=mysql_fetch_array($result);
	$price= $row['ITEM_PRICE'];

	return $price;
}




?>


