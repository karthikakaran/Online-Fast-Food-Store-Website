$(document).ready(function(){
	
var form= $("#customForm");
var name=$("#name");
var nameInfo= $("#nameInfo");
var email=$("#email");
var emailInfo=$("#emailInfo");
var pass1=$("#pass1");
var pass1Info=$("#pass1Info");
var mobileno=$("#mobileno");
var mobilenoInfo=$("#mobilenoInfo");
var aptnoname=$("#aptnoname");
var aptnonameInfo=$("#aptnonameInfo");
var place=$("#place");
var placeInfo=$("#placeInfo");
var zipcode=$("#zipcode");
var zipcodeInfo=$("#zipcodeInfo");
var loginname=$("#theusername");
var loginpass=$("#thepass");
var loginInfo=$("#loginInfo");
var registerInfo=$("#registerInfo");

var state=false;
var state1=false;
var state2=false;
var state3=false;
var state4=false;
var state5=false;
var state6=false;
var state7=false;
var state8=false;
$("#theusername").val('');
name.keyup(validateName);
pass1.keyup(validatePassword);
email.keyup(validateEmail);
mobileno.keyup(validateMobileno);
aptnoname.keyup(validateApartmentnoname);
email.keyup(validateEmail);
place.keyup(validatePlace);
zipcode.keyup(validateZipcode);
function validateName(){
			var uname=name.val();
			if (uname===''){
				name.removeClass("valid");
					nameInfo.removeClass("valid");
					name.addClass("error");
					nameInfo.addClass("error");
					nameInfo.text("Username should not be blank");
					state1=false;
			}else{
		$.post('validate.php',{names:uname},function(data){
				
				if(data==0){
					name.removeClass("valid");
					nameInfo.removeClass("valid");
					name.addClass("error");
					nameInfo.addClass("error");
					nameInfo.text("This Username is already registered");
					state1=false;
				}else
				{
					name.removeClass("error");
					nameInfo.removeClass("error");
					name.addClass("valid");
					nameInfo.addClass("valid");
					nameInfo.text("This Username is available");
					state1=true;	
				}
			});
			}
			
		

	
	return state1;
}

function validateEmail(){
	var uemail=email.val();
		var re=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			
				
				if(uemail===''){
					
					email.removeClass("valid");
					emailInfo.removeClass("valid");
					email.addClass("error");
					emailInfo.addClass("error");
					emailInfo.text("Email should not be blank");
					state2=false;
				}else
				{
					if (re.test(uemail)===true){
				data=0;
			}
			else{
				data=1;
			}
				
				if(data!=0){
					
					email.removeClass("valid");
					emailInfo.removeClass("valid");
					email.addClass("error");
					emailInfo.addClass("error");
					emailInfo.text("Invalid email, type a valid syntax for email eg: abc@gmail.com");
					state2=false;
				}else
				{
					email.removeClass("error");
					emailInfo.removeClass("error");
					email.addClass("valid");
					emailInfo.addClass("valid");
					emailInfo.text("");
					state2=true;	
				}
				
				
				
				}
			
		

	
	return state;
}
function validatePassword(){
			var upass1=pass1.val();
			var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
			if (upass1===''){
					pass1.removeClass("valid");
					pass1Info.removeClass("valid");
					pass1.addClass("error");
					pass1Info.addClass("error");
					pass1Info.text("Password should not be blank");
					state3=false;
			}else{
			if (re.test(upass1)===true){
				data=0;
			}
			else{
				data=1;
			}
				
				if(data!=0){
					
					pass1.removeClass("valid");
					pass1Info.removeClass("valid");
					pass1.addClass("error");
					pass1Info.addClass("error");
					pass1Info.text("Invalid password, Check the Password rules 1. At least six characters that are letters,numbers or underscore 2. One number, one lowercase and one uppercase leter");
					state3=false;
				}else
				{
					pass1.removeClass("error");
					pass1Info.removeClass("error");
					pass1.addClass("valid");
					pass1Info.addClass("valid");
					pass1Info.text("valid password ");
					$( "#pass1Info" ).append( "<img src='images/checkmark.png'></img>" );
					state3=true;	
				}
			
			}	

	
	return state3;
}



 function validateMobileno(){
	var umobileno=mobileno.val();
	var re=/[0-9]{10}/;
	if (umobileno===''){
				mobileno.removeClass("valid");
					mobilenoInfo.removeClass("valid");
					mobileno.addClass("error");
					mobilenoInfo.addClass("error");
					mobilenoInfo.text("Mobile no should not be blank");
					state4=false;
			}else{
			if (re.test(umobileno)===true){
				data=0;
			}
			else{
				data=1;
			}
				
				if(data!=0){
					
					mobileno.removeClass("valid");
					mobilenoInfo.removeClass("valid");
					mobileno.addClass("error");
					mobilenoInfo.addClass("error");
					mobilenoInfo.text("Invalid mobile number, enter a 10 digit number");
					state4=false;
				}else
				{
					mobileno.removeClass("error");
					mobilenoInfo.removeClass("error");
					mobileno.addClass("valid");
					mobilenoInfo.addClass("valid");
					mobilenoInfo.text("");
					state4=true;	
				}
			}
}
 
function validateApartmentnoname(){
	var uaptnoname=aptnoname.val();
	if (uaptnoname===''){
				aptnoname.removeClass("valid");
					aptnonameInfo.removeClass("valid");
					aptnoname.addClass("error");
					aptnonameInfo.addClass("error");
					aptnonameInfo.text("Apt no and name should not be blank");
					state5=false;
			}else{
			aptnoname.removeClass("error");
					aptnonameInfo.removeClass("error");
					
					aptnonameInfo.text("	");
					state5=true;
			}
}
function validatePlace(){
	var uplace=place.val();
	if (uplace===''){
				place.removeClass("valid");
					placeInfo.removeClass("valid");
					place.addClass("error");
					placeInfo.addClass("error");
					placeInfo.text("Place should not be blank");
					state5=false;
			}else{
			place.removeClass("error");
					placeInfo.removeClass("error");
					
					placeInfo.text("	");
					state5=true;
			}
}

function validateZipcode(){
	var uzipcode=zipcode.val();
	var re=/[0-9]{5}/;
	if (uzipcode===''){
				zipcode.removeClass("valid");
					zipcodeInfo.removeClass("valid");
					zipcode.addClass("error");
					zipcodeInfo.addClass("error");
					zipcodeInfo.text("Zip code should not be blank");
					state6=false;
			}else{
				if (re.test(uzipcode)===true){
				data=0;
			}
			else{
				data=1;
			}
				
				if(data!=0){
					
					zipcode.removeClass("valid");
					zipcodeInfo.removeClass("valid");
					zipcode.addClass("error");
					zipcodeInfo.addClass("error");
					zipcodeInfo.text("Invalid zip code, enter a 5 digit number");
					state6=false;
				}else
				{
					zipcode.removeClass("error");
					zipcodeInfo.removeClass("error");
					zipcode.addClass("valid");
					zipcodeInfo.addClass("valid");
					zipcodeInfo.text("");
					state6=true;	
				}
			
			}	
		}


$( "#sendBtn" ).click(function() {
  var all = $("form").serialize();
   var uname=name.val();
   var uemail=email.val();
   var upass1=pass1.val();
   var umobileno=mobileno.val();
   var uaptnoname=aptnoname.val();
   var uplace=place.val();
   var uzipcode=zipcode.val();
validateName();
validatePassword();
validateEmail();
validateMobileno();
validateApartmentnoname();
validateEmail();
validatePlace();
validateZipcode();
   if (state1==true &&  state2==true && state3==true && state4==true && state5==true && state6==true){
      $.post('insert.php',{names:uname,emails:uemail,passwds:upass1,mobilenos:umobileno,aptnonames:uaptnoname,places:uplace,zipcodes:uzipcode},function(data){  
 	  if (data==1){
		registerInfo.removeClass("valid");
		registerInfo.addClass("error");
		alert("Register Failed");
		state=false;
	  }else{
		registerInfo.removeClass("error");
		registerInfo.addClass("valid");
		//registerInfo.text("Register Success :)");
		state=true;	
		//setTimeout(function(){ document.location.href="/home.html"; }, 3000);
		alert("Account Created Succesfully!!");
                document.location.href="/home.html";
	}
     });
  }//else{}
});

$( "#thelogin" ).click(function() {
   var all = $("form").serialize();
   var uloginname=loginname.val();
   var uloginpass=loginpass.val(); 
   $.post('login.php',
         {loginnames:uloginname, loginpasswds:uloginpass},
         function(data){
	  if(data==1){			
			loginInfo.removeClass("valid");
			loginInfo.addClass("error");
			loginInfo.html("<h4>Incorrect Username/Password!</h4>");
			state=false;
	 }else if(data==0)
	 {
		loginInfo.removeClass("error");
		loginInfo.addClass("valid");
		loginInfo.html("<h4>Login Success!</h4>");
		state=true;
		document.location.href="/view.html";
	 }
	 else if(data==2)
	 {
		loginInfo.removeClass("error");
		loginInfo.addClass("valid");
		loginInfo.html("<h4>Login Success!</h4>");
		state=true;
		document.location.href="/updateMenu.php";
	 }	

    });
});


});

