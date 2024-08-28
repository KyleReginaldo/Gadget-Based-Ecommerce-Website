<?php


$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$status = isset($_POST['status']) ? (int)$_POST['status'] : 0;

// Validate input
if ($id > 0) {
    // Update the database
    $stmt = $conn->prepare("UPDATE cart SET selected=:selected WHERE id=:id");
    $stmt->execute(['selected'=>$status, 'id'=>$id]);
} else {
    echo 'invalid';
}
?>