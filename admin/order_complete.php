<?php
include 'includes/session.php';
$id = $_POST['id'];
$conn = $pdo->open();

try{
    $stmt = $conn->prepare("UPDATE orders SET status=:status WHERE id=:id");
    $stmt->execute(['id'=>$id]);
    $_SESSION['success'] = 'order complete';
}
catch(PDOException $e){
    $_SESSION['error'] = $e->getMessage();
}

$pdo->close();
?>