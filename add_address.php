<?php
	include 'includes/session.php';
	$conn = $pdo->open();
	$output = array('error'=>false);
    $region = $_POST['region_text'];
    $province = $_POST['province_text'];
    $city = $_POST['city_text'];
    $baranggay = $_POST['barangay_text'];
    $street = $_POST['street_text'];
    $address_type = $_POST['address_type'];
    try{
        $stmt = $conn->prepare("INSERT INTO address(region,province, city, baranggay, street, user_id, type) VALUES(:region,:province,:city,:baranggay,:street,:user_id, :type)");
        $stmt->execute(['user_id'=>$user['id'],'region'=>$region,'province'=>$province,'city'=>$city,'baranggay'=>$baranggay,'street'=>$street,'type'=>$address_type]);
        $output = 'Address Added.';
    }
    catch(PDOException $e){
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }
    $pdo->close();
	echo json_encode($output);
?>