/**
 * 
 */
var flag = false;
var finalPrice=0;
$(function(){
	
	$('select').selectric();
	$('.select').selectric();
	
	
	$("#item").change(function(event){
		
		var itemId = document.getElementById('item').value;

		document.getElementById('itemPrice').innerHTML='';		
		
		if(itemId=='')
		{
		alert('Please select an item !!');		
		flag=false;
		document.getElementById('itemPrice').innerHTML='<b>$ 0.00</b>';
		return false;
		}
		
		try{
			openModal();
			$.ajax({
				
	            type:'GET',	   	            
	            url:'GetItems.php',
	            data:'itemId='+itemId,
	            success:function(data) {	 
	            	closeModal();	  	            	
	            	var itemsList = data.split('#');
	            document.getElementById('itemTable').style.display='';
				document.getElementById('1').innerText=itemsList[0];
				document.getElementById('2').innerText=itemsList[1];
				if(itemsList[2]=='1')
					document.getElementById('3').innerText='VEG';
				else
					document.getElementById('3').innerText='NONVEG';
				document.getElementById('4').innerText=itemsList[3];
				var path = itemsList[4];
				path = '/Aneri_WPL'+path.replace(" ","%20");
				//alert(path);
				document.getElementById('5').innerHTML="<img src='"+path+"' />";
				document.getElementById('6').innerText=itemsList[5];
				
				document.getElementById('price').style.display='';
				document.getElementById('itemPrice').innerHTML='<b>$ '+itemsList[5]+'</b>';
				flag=true;
				
				finalPrice = itemsList[5];
	            	$("html, body").animate({ scrollTop: $(window).height()}, 600);
	            	
	            },
	            error:function(XMLHttpRequest, textStatus, errorThrown){
	            	closeModal();
	                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown);	               
	                return false;
	            }
	        });
			}
			catch(e)
			{
				alert(e);
			}
		
	});
	

	
	
	
	
	
	


});













function openModal() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('fade').style.display = 'block';
}

function closeModal() {
document.getElementById('modal').style.display = 'none';
document.getElementById('fade').style.display = 'none';
}



function callMe()
{
	
	
	var newprice = parseFloat(price)+sum;
	
	document.getElementById('price').style.display='';
	document.getElementById('itemPrice').innerHTML='<b>$ '+newprice+'</b>';
	flag=true;
	finalPrice = newprice;
}



$("#display").submit(function(event){
	
	
		if(!flag)
			{
			alert("Please select an item");
			event.preventDefault();
			return false;
			}
		else
			{
				
				document.getElementById('itemSelected').value=document.getElementById('item').value;
				
			}
			
								
						
			return true;
			
			
	
	});

