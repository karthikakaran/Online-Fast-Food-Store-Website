<?php
session_start();
require('fpdf.php');
require 'class.phpmailer.php';
include 'functions.php';
require 'database.php';


class PDF extends FPDF
{

	
	
	var $widths;
	var $aligns;
	
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
	
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
	
	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=5*$nb;
			//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
		$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
		}
	
		function CheckPageBreak($h)
		{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
		}
	
		function NbLines($w,$txt)
		{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
			if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r",'',$txt);
			$nb=strlen($s);
			if($nb>0 and $s[$nb-1]=="\n")
				$nb--;
				$sep=-1;
				$i=0;
				$j=0;
				$l=0;
						$nl=1;
						while($i<$nb)
						{
						$c=$s[$i];
						if($c=="\n")
						{
						$i++;
						$sep=-1;
						$j=$i;
						$l=0;
						$nl++;
						continue;
						}
							if($c==' ')
								$sep=$i;
								$l+=$cw[$c];
									if($l>$wmax)
									{
									if($sep==-1)
									{
									if($i==$j)
										$i++;
									}
									else
										$i=$sep+1;
										$sep=-1;
									$j=$i;
									$l=0;
									$nl++;
									}
										else
											$i++;
										}
											return $nl;
										}
	
	

}




	try {

		
		$sum = $_SESSION['sum'];
		//$userName=$_SESSION['username'];
		$userName='anerips31';
		$orderid="";
		
		$address="";
		$query_check_credentials = "SELECT * FROM userdetails WHERE userName='".$userName."'";
		$result_check_credentials = mysql_query($query_check_credentials);		
		$userId="";
		$tax = 0.08*$sum;
		$total = $sum+$tax;
		$mob='';
		$emailid='';
		if (@mysql_num_rows($result_check_credentials) > 0) {
			// output data of each row
			while($row = mysql_fetch_assoc($result_check_credentials)) {					
				$userId = $row["userId"];
				$mob = $row["mobileNo"];
				$emailid = $row["EMAIL"];
				$address = $row["aptNoName"].", ".$row["place"].", ".$row["zipCode"];
		
			}
		}
		
		$query = "INSERT INTO orderdetails VALUES ('".mysql_real_escape_string($userId)."',NULL,NOW(),'".mysql_real_escape_string($sum)."','".mysql_real_escape_string($tax)."','".mysql_real_escape_string($total)."')";
		
				
		if($result=mysql_query($query))
		{
						
			
			$get_order_id = "SELECT * FROM orderdetails where userId='".$userId."' ORDER BY orderDateTime DESC LIMIT 1";
			$order_query = mysql_query($get_order_id);

			if (@mysql_num_rows($order_query) > 0) {
				// output data of each row
				while($row = mysql_fetch_assoc($order_query)) {
			
					$orderid = $row["orderNo"];
			
				}
			}
			
			
			$counter=count($_SESSION['cart']);
			for($i=0;$i<$counter;$i++){
				$itemid=$_SESSION['cart'][$i]['itemid'];
							
				$q=$_SESSION['cart'][$i]['qty'];					
					$cost=get_price($itemid);
					$amount = $cost*$q;				
					
					$item_query = "INSERT INTO ordereditemdetails VALUES (NULL,'".$orderid."','".$itemid."','".$q."')";					
					mysql_query($item_query);
				
				
				
				
			}
			
			
		}
		
		
		
		//PDF Creation and mailing
		
		$pdf = new PDF();		
		$pdf->AddPage();
		//$pdf->AddFont("times");
		$pdf->SetFont('Arial','B',11);		
		$name="C:\\xampp\\htdocs\\Aneri_WPL\\pdfs\\";
		$t=time();
		$filename=$name.$t.".pdf";		
		$destinationurl="F";
		
		

		$pdf->SetWidths(array(100));
		$data = array("Swifty Food");
		$pdf->Row($data);
		$pdf->Ln();
		
		
		$pdf->SetWidths(array(100));
		$name=$userName;
		$data = array($name);
		$pdf->Row($data);		
		$pdf->Ln();
		
		
		
		
		$data = array($address);
		$pdf->Row($data);
		$pdf->Ln();
		
		$header = array('Serial No', 'Item Name', 'Description','Price','Quantity','Amount');	
		
		$pdf->SetWidths(array(15,30,60,15,18,18));
		$pdf->Row($header);
		
		$pdf->SetWidths(array(15,30,60,15,18,18));
		
		$pdf->SetFont('Arial','',10);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$itemid=$_SESSION['cart'][$i]['itemid'];
						
			$q=$_SESSION['cart'][$i]['qty'];
	
				$itemname=get_item_name($itemid);									
				$cost=get_price($itemid);	
				$price="$ ".$cost;
				$amount = "$ ".$cost*$q;
				$description = get_description($itemid);
				$data = array($i+1,$itemname,$description,$price,$q,$amount);					
				$pdf->Row($data);
			
		}
		
		$pdf->Ln();
		$pdf->SetWidths(array(100));
		
		$pdf->SetFont('Arial','B',11);
		
		$order_amt="Order Amount is : $ ".$sum;
		$data = array($order_amt);
		$pdf->Row($data);
		$pdf->Ln();
		
		$tax_amt="Order Amount is : $ ".$tax;
		$data = array($tax_amt);
		$pdf->Row($data);
		$pdf->Ln();
		
		$order_price="Total Order Price is : $ ".$total;		
		$data = array($order_price);
		$pdf->Row($data);
		
		$pdf->Ln();
		
		
		
		$pdf->Output($filename,$destinationurl);
		echo $t;
		
		  
		
	
		$email = new PHPMailer();
		$email->From      = 'kartik1499@yahoo.com';
		$email->FromName  = 'Swifty Food';
		$email->Subject   = "Your order summary";
		$email->Body      = 'Your Order with Order ID: '.$orderid.' has been placed. Please find attached receipt for the same. Thank you for shopping with us.';
		$email->AddAddress($emailid);				
		
		$email->AddAttachment( $filename , 'Receipt.pdf' );
		$email->Send();
		
		
		
		unset($_SESSION['cart']);
		unset($_SESSION['sum']);
	}
	
	catch (Exception $e) {
		echo $e;
		die($e);
	}
	



?>