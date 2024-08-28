<?php
	include 'includes/session.php';
	$conn = $pdo->open();
	$output = array('error'=>false);
	$user = $_SESSION['user'];
    $region =  $_POST['region_text'];
    $province = $_POST['province_text'];
    $city = $_POST['city_text'];
    $street = $_POST['street_text'];
    
    
    try{
        $stmt = $conn->prepare("INSERT INTO orders(user_id,product_id,quantity,total,region,province,city,street) VALUES(:user_id,:product_id,:quantity,:total,:region,:province,:city,:street)");
        $stmt->execute(['user_id'=>$user, 'product_id'=> $_SESSION['productId'], 'quantity'=>1, 'total'=>$_SESSION['total'],'region'=>$region,'province'=>$province,'city'=>$city,'street'=>$street]);
        $output['message'] = 'Order Added';
    }
    catch(PDOException $e){
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }
    $pdo->close();
	echo json_encode($output);
?>