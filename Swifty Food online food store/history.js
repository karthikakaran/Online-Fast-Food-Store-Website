$(document).ready(function(){
    //var cookieValue = document.cookie; alert("cookieValue"+cookieValue);
    function loadHistoryPanel(resp){
        var order_no = 0;
        for(var i=0; i<resp.length; i++){
                if(order_no != resp[i]['orderNo']){
                    order_no = resp[i]['orderNo'];
                    var date_time = resp[i]['orderDateTime'];
                    $(".panel-group").append("<div class='panel'>\
                    <div class='panel-heading red-color'><h4><span>ORDER ID : </span>&nbsp;<span id='orderNo'>"+resp[i]['orderNo']+"</span>\
                    <span style='padding-left:700px;' id='dateTime'>"+date_time+"</span></h4></div>\
                    <div class='panel-body blackfont'>\
                    <table class='table table-striped'><th>Item Id</th><th>Item Name</th><th>Quantity</th><th>Rate</th><th>Total</th>\
                    <tr><td>"+resp[i]['itemNo']+"</td><td>"+resp[i]['name']+"</td><td>"+resp[i]['quantity']+"</td><td>$ "+resp[i]['rate']+"</td><td>$ "+parseFloat((resp[i]['quantity'] * resp[i]['rate']), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()+"</td></tr>\
                    <tr id='toBeAdded"+order_no+"' class='totalTxt'><td></td><td></td><td></td><td>Total : </td><td>$ "+resp[i]['total']+"</td></tr>\
                    <tr class='totalTxt'><td></td><td></td><td></td><td>Tax : </td><td>$ "+resp[i]['tax']+"</td></tr>\
                    <tr class='totalTxt'><td></td><td></td><td></td><td>Total Bill : </td><td>$ "+resp[i]['totalPrice']+"</td></tr>\
                    </table>\
                    </div>\
                    </div>");
                } else 
                        $("#toBeAdded"+order_no).before(" <tr><td>"+resp[i]['itemNo']+"</td><td>"+resp[i]['name']+"</td><td>"+resp[i]['quantity']+"</td><td>$ "+resp[i]['rate']+"</td><td>$ "+parseFloat((resp[i]['quantity'] * resp[i]['rate']), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()+"</td></tr>");
        }
    }
     $.ajax({    
            //data: {'userId': '2000' },
            type:"post",
            url:"history.php",
            dataType: "json",
            success:function(resp) {
               loadHistoryPanel(resp);
            },
            error:function(){
                alert("No user history!");
            }
  	    });
});
