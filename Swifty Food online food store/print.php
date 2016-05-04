<html>
<head>
<title>Food cart</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="shortcut icon" href="logo2.png" type="image/x-icon">
<link rel="stylesheet" href="design.css">

<style>
#head { 
	  background-color: red;
          width:100%;
          height:50px;
  }
.bill {
    background-color: white;
    padding: 45px;
    border: 2px solid black;
    margin: 40px;
}
</style>
</head>
<body class="black-bg">
<div class="container-fluid text-center">
    <form role="form" action ="" method = "post">
	
    <div class="header affix1" data-spy="affix"><br>
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-3">
                    <img src="logo3.png" class="img-rounded" alt="logo" width="150" height="150"/>
                </div>
                <div class="col-sm-3">
                    <h3>SWIFTY FOOD</h3><h4  class='italicSt'>immerse in the taste</h4>
                </div>
                <div class="col-sm-3"><h2>FOOD CART</h2></div>
                <div class="col-sm-3">
                    <input type="submit" value="PAY" name="pay" class="btn btn-info" />
                    <input type="button" value="NEW ORDER" name="shop"  class="btn btn-info" onclick="location.href='view.html';"/>
                    <input type="button" value="LOGOUT" class="btn btn-info" onclick="location.href='logout.php';"/> 
                </div>
            </div>
        </div><br>
    </div>
 <div class="bill">
    <div class="well well-sm" id="head"> 
          <div class='col-sm-2'>
		<label>ITEM NO</label>
          </div>
          <div class='col-sm-2'>
		<label>ITEMS</label>
          </div>
	  <div class='col-sm-3'>
		<label>QUANTITY</label>
          </div>
          <div class='col-sm-2'>
		<label>RATE</label>
          </div>
          <div class='col-sm-3'>
		<label>TOTAL</label>
          </div>
    </div>
<?php
if(isset($_POST["item"])){
     $inputItem = $_POST["item"];
    // if(!isset($_COOKIE["continueCookie"]))
        setcookie("continueCookie", $_POST["item"], time() + (86400 * 30), "/");
}
elseif(isset($_COOKIE["continueCookie"]))
    $inputItem = $_COOKIE("continueCookie");
  
$itemArr = json_decode($inputItem);
$total = 0; 
foreach($itemArr as $key => $value) {
	echo "<div class='row'>
         <div class='col-sm-2'>
			<label>".$value->itemNo ."</label>
          </div>
		  <div class='col-sm-2'>
			<label>".$value->name ."</label><br>
                        <img src='".$value->img."' width='100px' height='100px'/>
          </div>
		  <div class='col-sm-3'>
			<label>".$value->qty."</label>
          </div>
          <div class='col-sm-2'>
			<label> $ ".money_format('%(#10n', $value->rate)."</label>
          </div>
           <div class='col-sm-3'>
			<label> $ ".money_format('%(#10n',  $value->rate * $value->qty ) ."</label>
          </div>
	    </div>";
        $total = $total + ($value->rate * $value->qty);
}
$tax = $total * 0.04;
$totalPrice = $total + $tax;
echo "<hr>
<div class='row'>
		  <div class='col-sm-7'>
          </div>
          <div class='col-sm-2'>
          <p><label>Amount: </label></p>
          <p><label>Tax: 4%</label></p>
          <p><label>Bill Amount: </label></p>
          </div>
          <div class='col-sm-3'>
          <p><label>$ ".money_format('%(#10n', $total)."</label></p>
          <p><label>$ ".money_format('%(#10n', $tax)."</label></p>
          <p><label>$ ".money_format('%(#10n', $totalPrice)."</label></p>
          </div>
</div>
</div>";
echo "<input type='hidden' name='tax' value='".$tax."'/><input type='hidden' name='total' value='".$total."'/>
            <input type='hidden' name='totalPrice' value='".$totalPrice."'/><input type='hidden' name='item' value='".$inputItem."'/>";
?>
                </div>
         </form>
       </div>
    </body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['shop'])){
        header( 'Location: view.html' );
    }
    elseif(isset($_POST['pay'])){
       define('DB_SERVER', 'localhost:8080');
       define('DB_USERNAME', 'root');
       define('DB_PASSWORD', '28111988');
       define('DB_DATABASE', 'swiftyfood');
       $conn = mysql_connect (DB_SERVER, DB_USERNAME, DB_PASSWORD);
       
       if(! $conn )
          die('Could not connect: ' . mysql_error());
      //else
            //echo "Success1";   
      $tax = $_POST["tax"];
      $total = $_POST["total"];
      $totalPrice = $_POST["totalPrice"];
      $inputItem = $_POST["item"];
      $itemArr = json_decode($inputItem);

      #getuserID from cookies 
       $userId = $_COOKIE["userId"]; //echo "88888888888".$userId;
       $sql = "INSERT INTO orderDetails (userId, orderDateTime, total, tax, totalPrice) VALUES (".$userId.", now(), ".money_format('%(#10n', $total).",".money_format('%(#10n', $tax).",".money_format('%(#10n', $totalPrice).")";
       mysql_select_db(DB_DATABASE);
       $retval = mysql_query( $sql, $conn );
       //if($retval)
                //echo "Success2";

      /* $sql2 = "select orderNo from orderDetails order by orderNo desc limit 1";
       $retval1 = mysql_query( $sql2, $conn );
       while($row = mysql_fetch_array($retval1, MYSQL_ASSOC)) {
            $ret[] = $row;
       }
       if($retval1)
          echo "Success3"; */
          
       $retval2 = false;
       #get lastest orderno
       $orderNo =  mysql_insert_id();
       foreach($itemArr as $key => $value) {
            $sql1 = "INSERT INTO orderedItemDetails (orderNo, itemNo, quantity) VALUES (".$orderNo.",".$value->itemNo.",".$value->qty.")";
            $retval2 = mysql_query( $sql1, $conn );
            if(!$retval2)  break;
       }
       //if($retval2)
         // echo "Success4"; 
       
       if(!$retval  || !$retval2) {
            if(mysql_errno() == 1062)
                echo "<h2 class='bg-danger text-center'>Trouble updating OrderDetails!\n</h2>";
            die();
        } else if($retval && $retval2){ ?>
        <script type="text/javascript">alert("\t\tPAID!!.\nTHANK YOU FOR ORDERING");</script>
        <?php 
              #  echo "<h2 class='bg-danger text-center'>PAID!\n</h2>"; 
              }
            mysql_close($conn);
    }
}
?>
