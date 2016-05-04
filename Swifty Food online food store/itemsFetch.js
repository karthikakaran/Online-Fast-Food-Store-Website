$(document).ready(function(){
//var cookieValue = document.cookie; alert("cookieValue"+cookieValue);
//alert("good");
        function loadAll(){
		$.ajax({
		    type: "post",
		    url: "view.php",
		    data: {functionName: "fetchAllItems"},
		    dataType: "json",
		    success: function(resp) {
			 loadElements(resp);
		    },
		    error: function() {
			alert("Error while loading data");
		    }
		});
        } 
        loadAll(); 
        $("#showall").click(function(){  
           $("#filterItem").val(''); 
	   $("input[type='checkbox']").prop( "checked", false );	
	   loadAll(); 
        });
	$("#search").click(function(){
	    $("#filterItem").val('');
   	    var types=[]; var items=[]; var vegOrNv=[];

	    $("input[type='checkbox'][name='items']").each(function(){
		if($(this).is(":checked")){
		    items.push($(this).attr('value'));
		}
	    });
	    $("input[type='checkbox'][name='types']").each(function(){
		    if($(this).is(":checked")){
		        types.push($(this).attr('value'));
		    }
		});
	    $("input[type='checkbox'][name='vegOrNv']").each(function(){
		if($(this).is(":checked")){
		    vegOrNv.push($(this).attr('value'));
		}
	    });
	    $.ajax({    
		data: {functionName: "fetchAllItems", searchCrit: "search",  "types": types, "items": items, "vegOrNv": vegOrNv },
		type:"post",
		url:"view.php",
		dataType: "json",
		success:function(resp) {
		   loadElements(resp);
		},
		error:function(){
		    alert("Enter proper items to search");
		}
       	    });
    });
    $("#filter").click(function(){
      $("input[type='checkbox']").prop( "checked", false );
      $.ajax({
        data: {functionName: "fetchAllItems", filterItem : $("#filterItem").val()},
        type:"post",
        url:"view.php",
        dataType: "json",
        success:function(resp) {
           loadElements(resp);
        },
        error:function(){
            alert("Enter proper items to filter");
        }
      });  
    });
    function loadElements(details){
	 $("#loadId").empty();
	 if(details == null){
		alert("Sorry! No matcing food items");
		return;
	 }
	 for(var i=0; i<details.length; i++){
	 	$("#loadId").append("<div class='col-sm-3 text-center' style='padding-top:20px;'><p><label id='ItemName"+i+"'></label></p>\
	        <input type='hidden' id='rate"+i+"' class='rateClass'>\
                <input type='hidden' id='desc"+i+"' class='descClass'>\
                <input type='hidden' id='itemNo"+i+"' class='itemClass'>\
	        <a data-toggle='modal'>\
                <img id='imgPath"+i+"' class='imgPath' alt='Food Item Img' width='250' height='250' title='Click for ingredients'/></a><br><br>\
                <input type='button' class='btn btn-circle btn-info plus' value='+'/>\
	        <input type='text' size='2' maxlength='2' class='blackfont qtyVal' value='0' disabled/>\
	        <input type='button' class='btn btn-circle btn-info minus' value='-'/></div>");
		$("#ItemName"+i).html(details[i]['name'].toUpperCase());
		$("#imgPath"+i).attr('src', details[i]['imgPath']);
		$("#desc"+i).val(details[i]['description']);
		$("#rate"+i).val(details[i]['rate']);
                $("#itemNo"+i).val(details[i]['itemNo']);
	  }
    }
});
var itemArr = {};

$(document).on("click", ".imgPath", function() {
   $("#myModalLabel").html($(this).parent().siblings("p").children("label").text().toUpperCase());
   $("#descrip").html($(this).parent().siblings(".descClass").val());
   $("#price").html(" : $"+$(this).parent().siblings(".rateClass").val());
   $("#imgId").attr('src', $(this).attr("src"));	
   $('#description').modal("show");  
});
$(document).on("click", ".plus", function() {
   if($(this).siblings(".qtyVal").val() != 50)
        $("#totalItems").html(Math.min(50, parseInt($("#totalItems").text())+1));
   $(this).siblings(".qtyVal").val(Math.min(50, parseInt($(this).siblings(".qtyVal").val())+1));
    accumulateJson( $(this).siblings("p").children("label").text().toUpperCase(),
       $(this).siblings("a").children(".imgPath").attr("src"), $(this).siblings(".rateClass").val(), $(this).siblings(".qtyVal").val(),
       $(this).siblings(".itemClass").val() );
});
$(document).on("click", ".minus", function() {
    if($(this).siblings(".qtyVal").val() != 0 )
         $("#totalItems").html(Math.max(0, parseInt($("#totalItems").text())-1));
    $(this).siblings(".qtyVal").val(Math.max(0, parseInt($(this).siblings(".qtyVal").val())-1));
    accumulateJson( $(this).siblings("p").children("label").text().toUpperCase(),
       $(this).siblings("a").children(".imgPath").attr("src"), $(this).siblings(".rateClass").val(), $(this).siblings(".qtyVal").val(),
       $(this).siblings(".itemClass").val() );
});
$(document).on("click", "#checkout", function(){
         if(parseInt($("#totalItems").text()) > 0){
                $("#a").val(JSON.stringify(itemArr));
                $("form").submit();
        }
});

$(document).on("click", "#history", function(){
        $(location).attr('href', 'history.html');
});
$(document).on("change", ".qtyVal", function(){
     var itemNo = $(this).siblings(".itemClass").val();
     var currQty = $(this).val();
     var prevQty = 0;
     if(!(itemNo in itemArr) ) prevQty = 0;
     else if(itemArr[itemNo].qty > 0 ) 
            prevQty = itemArr[itemNo].qty;

     var a = parseInt($("#totalItems").text());
     var b = parseInt(prevQty);
     var c = parseInt(currQty);
     $("#totalItems").html(a-b+c);

     accumulateJson( $(this).siblings("p").children("label").text().toUpperCase(),
       $(this).siblings("a").children(".imgPath").attr("src"), $(this).siblings(".rateClass").val(), currQty,
       itemNo );
});
function accumulateJson( name, img, rate, qty, itemNo ){
  if(!(itemNo in itemArr) && qty > 0){
    var obj = new Object();
    obj.itemNo = itemNo;
    obj.name = name;
    obj.img = img;
    obj.rate = rate;
    obj.qty = qty;
    var itemAdd = obj;
    itemArr[itemNo] = itemAdd;
  }
  else if(itemNo in itemArr){
     if(qty > 0){
        itemArr[itemNo].qty = qty;
     }
     else
        delete itemArr[itemNo];
  }
}

