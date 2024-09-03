<?php
include 'includes/session.php';

$conn = $pdo->open();
$output = '';
try{ 		
    $stmt = $conn->prepare("SELECT * FROM address WHERE user_id=:user_id ORDER BY selected DESC, created_at DESC");
    $stmt->execute(['user_id' => $user['id']]);
    if($stmt->rowCount() > 0){
        foreach($stmt as $row){
            $selected = $row['selected'] ? 'selected-address': '';
            $checked= $row['selected'] ?'checked':'';
            $output .= '
            <div class="address-container '.$selected.'">
                <div class="address-content">
                    <input class="address-checkbox" type="checkbox" '.$checked.' data-id="'.$row['id'].'">
                    <h5>
                    '.$row['type'].'
                    <p>'.$row['region'].', '.$row['province'].', '.$row['city'].', '.$row['baranggay'].', '.$row['street'].'</p>
                    </h5>
                </div>
                <div class="actions">
                    <a href="#edit-address" data-toggle="modal"><button type="button" class="edit-address">Edit</button></a>
                    <button type="button" class="delete-address" data-id="'.$row['id'].'">Delete</button>
                </div>
            </div>
            ';
            }
    }else{
        $output = "There is no existing address.";
    }
}
catch(PDOException $e){
    $output .= "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
echo json_encode($output);
?>
