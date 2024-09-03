<?php
    include 'includes/session.php';
    $conn = $pdo->open();
    $output = array('error'=>false);

    // Retrieving data from the POST request
    $region = $_POST['region_text'];
    $province = $_POST['province_text'];
    $city = $_POST['city_text'];
    $baranggay = $_POST['barangay_text'];
    $street = $_POST['street_text'];
    $address_type = $_POST['address_type'];
    $address_id = $_POST['address_id']; // Assuming you have an address_id to identify the specific address

    try {
        // Updating the address in the database
        $stmt = $conn->prepare("UPDATE address SET region=:region, province=:province, city=:city, baranggay=:baranggay, street=:street, type=:type WHERE id=:address_id AND user_id=:user_id");
        $stmt->execute(['region'=>$region, 'province'=>$province, 'city'=>$city, 'baranggay'=>$baranggay, 'street'=>$street, 'type'=>$address_type, 'address_id'=>$address_id, 'user_id'=>$user['id']]);
        $output = 'Address Updated.';
    } catch(PDOException $e) {
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }

    $pdo->close();
    echo json_encode($output);
?>
