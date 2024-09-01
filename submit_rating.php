<?php
include 'includes/session.php';
$conn = $pdo->open();
$itemId = $_POST['item_id'];
$userId = $_POST['user'];
$rating = $_POST['rating'];
$output = array('error'=>false);
try{ 		
    $stmt = $conn->prepare("INSERT INTO ratings(user_id, product_id, rating, message) VALUES(:user_id,:product_id,:rating,:message)");
    $stmt->execute(['user_id'=>$userId,'product_id'=>$itemId,'rating'=>$rating,"message"=>'test message']);
    $output['message'] = "rated successfully";
}
catch(PDOException $e){
    $output['error'] = true;
    $output['message'] = $e->getMessage();
}
$pdo->close();
echo json_encode($output);
?>