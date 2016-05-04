<?php 

require 'database.php';
include("functions.php");
session_start();

if($_REQUEST['command']=='add' && $_REQUEST['item']>0){
	
	
	$itemid=$_REQUEST['item'];
	addtocart($itemid,1);
	
}


if($_REQUEST['command']=='delete' && $_REQUEST['itemid']>0){
	remove_product($_REQUEST['itemid']);
}
else if($_REQUEST['command']=='clear'){
	unset($_SESSION['cart']);
}
else if($_REQUEST['command']=='update'){
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['itemid'];
		$q=intval($_REQUEST['item'.$pid]);
		if($q>0 && $q<=999){
			$_SESSION['cart'][$i]['qty']=$q;
		}
		else{
			$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
		}
	}
}

?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/Aneri_WPL/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/Aneri_WPL/css/slide.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/Aneri_WPL/css/display.css" type="text/css" media="screen" />

<!-- <script src="/OnlinePizzaSystem/js/jquery.min.js"></script> -->

<script src="/Aneri_WPL/js/jquery.min.js"></script>
<script src="/Aneri_WPL/js/shopping.js"></script>

<title>Shopping Cart</title>
<script language="javascript">
	function del(id){
		if(confirm('Do you really want to delete this item?')){
			document.shopping.itemid.value=id;
			document.shopping.command.value='delete';
			document.shopping.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.shopping.command.value='clear';
			document.shopping.submit();
		}
	}
	function update_cart(){
		document.shopping.command.value='update';
		document.shopping.submit();
	}


</script>





</head>

<body>


<div id="fade"></div>
        <div id="modal">
            <img id="loader" src="/Aneri_WPL/images/loading.gif" />
        </div>
        
	
		
<form name="shopping" method="post">



<input type="hidden" name="itemid" />
<input type="hidden" name="command" id="command"/>
<a style="text-decoration: underline;color: blue" href="pizza_stop.html"><h2>Home</h2></a>
    

	<div style="margin:0px auto; width:700px;position: absolute; top:170px;left: 50px" >
    <div style="padding-bottom:10px">
    	<h1 align="center">Your Shopping Cart</h1>
    <input type="button" class="btn" value="Continue Shopping" onclick="window.location='displayMenu.php'" />
    </div>
    	
    	<table border="0" cellpadding="5px" cellspacing="1px"  style="font-family:Verdana, Geneva, sans-serif;  background-color:#E1E1E1" >
    	<?php
			if(isset($_SESSION['cart'])){
            	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td width="5%" align="center">Serial</td><td align="center" width="15%">Name</td><td align="center" width="15%">Type</td><td align="center" width="30%">Veg/NonVeg</td><td align="center" width="30%">Description</td><td align="center" width="10%">Price</td><td align="center" width="10%">Quantity</td><td align="center" width="10%">Amount</td><td width="5%">Options</td></tr>';
				$max=count($_SESSION['cart']);
								
				for($i=0;$i<$max;$i++){
					$itemid=$_SESSION['cart'][$i]['itemid'];
					
					
					$q=$_SESSION['cart'][$i]['qty'];
					
					$itemname=get_item_name($itemid);									
					$price=get_price($itemid);
					$type = get_type($itemid);
					$vnv = get_vegnonveg($itemid);
					$description = get_description($itemid);
					$tot = get_order_total();
					$tax = $tot * 0.08;
					$totalOrder = $tot+$tax;
					
					if($q==0) continue;
			?>
            		<tr bgcolor="#FFFFFF"><td align="center"><?php echo $i+1;?></td><td align="center"><?php echo $itemname;?></td>
            		<td align="center"><?php echo $type;?></td>
            		<td ><?php echo $vnv;?></td>
					<td ><?php echo $description;?></td>
                    <td align="center">$ <?php echo $price;?></td>
                    <td align="center"><input type="text" name="item<?php echo $itemid?>" value="<?php echo $q;?>" maxlength="3" size="2" /></td>                    
                    <td align="center">$ <?php echo $price*$q;?></td>
                    <td align="center"><a style="text-decoration: underline;color: blue" href="javascript:del(<?php echo $itemid;?>)">Remove</a></td></tr>
            <?php					
				}
			?>
			<tr>
			<td>
			&nbsp;
			</td>
			</tr>
			
			<tr><td colspan="7"><b>Order Amount: $<?php echo $tot;?></b></td></tr>
			
			<tr><td colspan="7"><b>Tax (8%): $<?php echo $tax;?></b></td></tr>
			
			<tr><td colspan="3"><b>Order Total: $<?php echo $totalOrder;?></b></td><td colspan="4" align="right"><input type="button" class="btn" value="Clear Cart" onclick="clear_cart()"> &nbsp;<input type="button" class="btn" value="Update Cart" onclick="update_cart()"> &nbsp;<input type="button" class="btn" value="Place Order"  id="placeorder"></td></tr>
			
			<tr>
			<td>
			&nbsp;
			</td>
			</tr>
			<tr>
			<td colspan="7">
			Note : After changing the quantity, Please click on Update Cart button for cart to be updated. 
			</td>
			</tr>				
			<?php
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td><h3>There are no items in your shopping cart!</h3></td>";
				
			}
		?>
        </table>
    </div>

</form>



</body>





</html>