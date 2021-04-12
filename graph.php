<?php 

 include('./config/DbFunction.php');
 $obj=new DbFunction();
     $keywords = $obj->getKeyeordProduct();
if(isset($_POST) && $_POST['product_id'] != 0 ){
    $productGraph = $obj->productGraph($_POST['product_id']);
    $xdata =[];
    $ydata =[];
    $max = max(array_column($productGraph, 0));
    foreach ($productGraph as $key => $value) {
        $ydata[] = $value[0];
        $xdata[] = $value[1];
    }
   //print_r($ydata);die;
    $response['xdata'] = $xdata;
    $response['ydata'] = $ydata;
    $response['max'] = (int)$max;
    echo json_encode($response);
}
	

?>
