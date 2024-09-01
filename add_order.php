<?php

    $today = date('YmdHi');
    $startDate = date('YmdHi', strtotime('-10 days'));
    $range = $today - $startDate;
    $orderNumber = rand(0, $range);

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
        if($region and $province and $city and $baranggay){
            $stmt = $conn->prepare("SELECT *, cart.id AS cartId, products.stock AS stocks, products.price AS productPrice FROM cart INNER JOIN products ON products.id=cart.product_id WHERE user_id=:user_id AND selected=true");
            $stmt->execute(['user_id'=>$_SESSION['user']]);
            foreach($stmt as $row){
                $orderNumber += $row['id'];
                $discount = ($row['discount'] / 100) * $row['price'];
                $originalPrice = $row['productPrice'];
                $price = $originalPrice - $discount;
                $total =$price * $row['quantity'];
                $stmt = $conn->prepare("INSERT INTO orders(order_number,user_id,product_id,quantity,total,region,province,city,baranggay,street) VALUES(:order_number,:user_id,:product_id,:quantity,:total,:region,:province,:city,:baranggay,:street)");
                $stmt->execute(['order_number'=>$orderNumber,'user_id'=>$user, 'product_id'=> $row['product_id'], 'quantity'=>$row['quantity'], 'total'=>$total,'region'=>$region,'province'=>$province,'city'=>$city,'baranggay'=>$baranggay,'street'=>$street]);
                $stmt = $conn->prepare("DELETE FROM cart WHERE id=:id");
                $stmt->execute(['id'=>$row['cartId']]);
                $stmt = $conn->prepare("UPDATE products SET stock=:remainingStock WHERE id=:product_id");
                $stmt->execute(['product_id'=>$row['product_id'],'remainingStock'=>($row['stocks'] - $row['quantity'])]);
                $output['message'] = 'Order Added';
            }
        }else{
            $output['error'] = true;
            $output['error_message'] = 'Please enter all the details';
        }
    }
    catch(PDOException $e){
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }
    $pdo->close();
	echo json_encode($output);
?>