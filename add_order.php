<?php
	include 'includes/session.php';
	$conn = $pdo->open();
	$output = array('error'=>false);
	$user = $_SESSION['user'];
    $region =  $_POST['region_text'];
    $province = $_POST['province_text'];
    $city = $_POST['city_text'];
    $baranggay = $_POST['barangay_text'];
    $street = $_POST['street_text'];
    
    
    try{
        $stmt = $conn->prepare("SELECT *, cart.id AS cartId, products.stock AS stocks FROM cart INNER JOIN products ON products.id=cart.product_id WHERE user_id=:user_id AND selected=true");
		$stmt->execute(['user_id'=>$_SESSION['user']]);
		foreach($stmt as $row){
            $stmt = $conn->prepare("INSERT INTO orders(user_id,product_id,quantity,total,region,province,city,baranggay,street) VALUES(:user_id,:product_id,:quantity,:total,:region,:province,:city,:baranggay,:street)");
            $stmt->execute(['user_id'=>$user, 'product_id'=> $row['product_id'], 'quantity'=>$row['quantity'], 'total'=>$_SESSION['total'],'region'=>$region,'province'=>$province,'city'=>$city,'baranggay'=>$baranggay,'street'=>$street]);
            $stmt = $conn->prepare("DELETE FROM cart WHERE id=:id");
			$stmt->execute(['id'=>$row['cartId']]);
            $stmt = $conn->prepare("UPDATE products SET stock=:remainingStock WHERE id=:product_id");
			$stmt->execute(['product_id'=>$row['product_id'],'remainingStock'=>($row['stocks'] - $row['quantity'])]);
            $output['message'] = 'Order Added';
        }
        
    }
    catch(PDOException $e){
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }
    $pdo->close();
	echo json_encode($output);
?>