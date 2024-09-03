<?php
include 'includes/session.php';
$conn = $pdo->open();
$output = '';

try{ 		
    $stmt = $conn->prepare("SELECT * FROM address WHERE user_id=:user_id ORDER BY selected DESC, created_at DESC LIMIT 3");
    $stmt->execute(['user_id' => $user['id']]);
    if($stmt->rowCount() > 0){
        foreach($stmt as $row){
            $selected = $row['selected'] ? 'selected-address': '';
            $checked= $row['selected'] ?'checked':'';
            $output .= '
            <div class="address-container '.$selected.'">
            <h6>'.$row['type'].'</h6>
            <div class="content-header">
            <p>'.$row['region'].', '.$row['province'].', '.$row['city'].', '.$row['baranggay'].', '.$row['street'].'</p>
            <input class="address-checkbox" type="checkbox" '.$checked.' data-id="'.$row['id'].'">
            </div>
            </div>
            ';
            }
    }else{
        $output = "There is no existing address.<br><a href='user_address.php'>Manage address</a>";
    }
}
catch(PDOException $e){
    $output = "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
echo json_encode($output);
?>