<?php

    $today = date('YmdHi');
    $startDate = date('YmdHi', strtotime('-10 days'));
    $range = $today - $startDate;
    $orderNumber = rand(0, $range);
	include 'includes/session.php';
	$conn = $pdo->open();
	$output = array('error'=>false);
    try{
        $addressStmt = $conn->prepare("SELECT * FROM address WHERE user_id=:user_id AND selected=:selected");
        $addressStmt->execute(['user_id'=>$user['id'],'selected'=>true]);
        $addressData = $addressStmt->fetch();
        if($addressData['id']){
            $stmt = $conn->prepare("SELECT *, cart.id AS cartId, products.stock AS stocks, products.price AS productPrice FROM cart INNER JOIN products ON products.id=cart.product_id WHERE user_id=:user_id AND selected=:selected");
            $stmt->execute(['user_id'=>$user['id'],'selected'=>true]);
            foreach($stmt as $row){
                $orderNumber += $row['id'];
                $discount = ($row['discount'] / 100) * $row['price'];
                $originalPrice = $row['productPrice'];
                $price = $originalPrice - $discount;
                $total =$price * $row['quantity'];
                $stmt = $conn->prepare("INSERT INTO orders(order_number,user_id,product_id,quantity,total,address_id) VALUES(:order_number,:user_id,:product_id,:quantity,:total,:address_id)");
                $stmt->execute(['order_number'=>$orderNumber,'user_id'=>$user['id'], 'product_id'=> $row['product_id'], 'quantity'=>$row['quantity'], 'total'=>$total,'address_id'=>$addressData['id']]);
                $stmt = $conn->prepare("DELETE FROM cart WHERE id=:id");
                $stmt->execute(['id'=>$row['cartId']]);
                $stmt = $conn->prepare("UPDATE products SET stock=:remainingStock WHERE id=:product_id");
                $stmt->execute(['product_id'=>$row['product_id'],'remainingStock'=>($row['stocks'] - $row['quantity'])]);
                $output['message'] = 'Order Added';
            }
        }else{
            $output['error'] = true;
            $output['message'] = 'Please provide your address.';
        }
    }
    catch(PDOException $e){
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }
    $pdo->close();
	echo json_encode($output);
?>