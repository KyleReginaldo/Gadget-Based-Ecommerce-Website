<?php
include 'includes/session.php';
$conn = $pdo->open();
$output = array('error'=>false);

$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id=:user_id AND selected=:selected");
$stmt->execute(['user_id'=>$_SESSION['user'],'selected'=>true]);
if($stmt->rowCount() > 0){
    $output['url'] = 'checkout_view.php';
}
else{
    $output['error'] = true;
    $output['url'] = '';
}
$pdo->close();
echo json_encode($output);
?>