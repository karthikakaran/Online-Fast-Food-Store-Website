<?php
error_reporting(E_ALL);
function getHistory($userId){
        define('DB_SERVER', 'localhost:8080');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '28111988');
        define('DB_DATABASE', 'swiftyfood');
        $conn = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        if(! $conn ) {
            die('Could not connect: ' . mysql_error());
        }
        $sql = "SELECT * from orderDetails where userId = ".$userId;
        mysql_select_db(DB_DATABASE);
        $retval = mysql_query( $sql,$conn );
        if (!$retval) {
            echo 'Could not run query 1: ' . mysql_error();
            exit;
        }

    $val=0;
    while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
        $ret[] = $row;
    }
    $itemArr = $ret; 
    $itemDetailsArr = array();
    foreach($itemArr as $key => $value) {
            $sql1 = "SELECT orderNo, orderDetailsId, itemNo, quantity from orderedItemDetails where orderNo =".$value['orderNo'];
            $retval1 = mysql_query( $sql1, $conn );
            while($row1 = mysql_fetch_array($retval1, MYSQL_ASSOC)) {
                array_push($itemDetailsArr,$row1); 
            }
            if(!$retval1)  break; 
    }
    $items = array();
    foreach($itemDetailsArr as $key => $v){
        $itemNo = $v['itemNo'];
        $sql2 = "SELECT itemNo, name, rate from itemDetails where itemNo =".$itemNo;
        $retval2 = mysql_query( $sql2, $conn );
        while($row2 = mysql_fetch_array($retval2, MYSQL_ASSOC)) {
               array_push($items,$row2); 
        }
        if(!$retval2)  break; 
    }

    $result = array();
    foreach($itemArr as $key1 => $value1) {
            foreach($itemDetailsArr as $key2 => $value2) {
                    if($value1['orderNo'] == $value2['orderNo']){
                            $json["orderNo"] = $value1["orderNo"];
                            $json["orderDetailsId"]  = $value2["orderDetailsId"];
                            $json["orderDateTime"]  = $value1["orderDateTime"];
                            $json["itemNo"]  = $value2["itemNo"];
                            foreach($items as $key3 => $value3) {
                                if($value3['itemNo'] == $value2['itemNo']){
                                     $json["name"]  = $value3["name"];
                                     $json["rate"]  = $value3["rate"];
                                }
                            }
                            $json["quantity"]  = $value2["quantity"];
                            $json["tax"]  = $value1["tax"];
                            $json["total"]  = $value1["total"];
                            $json["totalPrice"]  = $value1["totalPrice"];
                            
                            array_push($result, $json);
                    }
            }
    }
    if(!$retval1) {
        echo 'Could not run query 2: ' . mysql_error();
        exit;
    }
    if(!$retval2) {
        echo 'Could not run query 3: ' . mysql_error();
        exit;
    }
    if($retval && $retval1 && $retval2){
      //  echo 'Success total';
    }
    mysql_close($conn);
    return  json_encode($result);
}
//if (isset($_POST['userId'])) {
    echo getHistory($_COOKIE['userId']);
//}
?>
