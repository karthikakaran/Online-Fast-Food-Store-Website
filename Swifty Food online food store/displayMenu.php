<html>
<head>

<link rel="stylesheet" href="/Aneri_WPL/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/Aneri_WPL/css/selectric.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/Aneri_WPL/css/slide.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/Aneri_WPL/css/polaris.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/Aneri_WPL/css/display.css" type="text/css" media="screen" />

<script src="/Aneri_WPL/js/jquery.min.js"></script>
<script src="/Aneri_WPL/js/displayMenu.js" type="text/javascript"></script>
<script src="/Aneri_WPL/js/jquery.selectric.js" type="text/javascript"></script>
<script src="/Aneri_WPL/js/jquery.selectric.placeholder.js" type="text/javascript"></script>



    
    <title>
    MenuPage
    </title>
</head>

<body>
	
		<div id="fade"></div>
        <div id="modal">
            <img id="loader" src="/Aneri_WPL/images/loading.gif" />
        </div>
        
		<?php
			session_start();
			require 'database.php';
			
		?>
		
		
	
	
	
		
    <a style="text-decoration: underline;color: blue" href="pizza_stop.html"><h2>Home</h2></a>

    <br />
		
		<h2>Our Menu :</h2>
		<br />
		
		<form name="displayMenu" id="display" action="shoppingCart.php" method="post">
		<div id="dropdown">
		<h3>Select an item :</h3>
		<br />
		<select id="item" name="item">
			<option value="">--Select an item--</option>
			<?php 
			$query = "SELECT * FROM itemdetails ORDER by name asc";
			
			$result_data = mysql_query($query);
			
			if(mysql_num_rows($result_data))
			{
				while($row = mysql_fetch_assoc($result_data)) {
			
					?><option value="<?php echo $row['itemNo']?>"><?php echo $row['name']?></option><?php 	
				}
			}
			?>
			
		</select>
		
		
		
		
		
		<br />
		
		<table border="1" cellpadding="10px" cellspacing="1px"  id="itemTable" style="font-family:Verdana, Geneva, sans-serif;  background-color:#E1E1E1; display:none">
		<tr bgcolor="#FFFFFF">
		<td align="center">NAME </td>
		<td align="center"> TYPE</td>
		<td align="center"> VEG/NON-VEG</td>
		<td align="center">DESCRIPTION </td>
		<td align="center">IMAGE </td>
		<td align="center"> RATE ($)</td>
		</tr>
		<tr bgcolor="#FFFFFF">
		<td align="center" id="1">	</td>
		<td align="center" id="2">	</td>
		<td align="center" id="3">	</td>
		<td align="center" id="4">	</td>
		<td align="center" id="5">	</td>
		<td align="center" id="6">	</td>
		</tr>		
		</table>
				
		<br />
		 
		 <div id="price" style="display: none">
		 <h4>Item Price : </h4>
		 <label id="itemPrice"></label>
		 </div>
		
		
		<input type="submit" value="Add To Cart" id="addCart" class="btn">
		
		<input type="hidden" name="command" id="command" value="add" />
		
		</form>
		</div>
		</div>
		
		</body>

</html>