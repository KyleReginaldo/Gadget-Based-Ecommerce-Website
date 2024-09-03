<?php
	include 'includes/session.php';
	$conn = $pdo->open();
	$output = array('error'=>false);
    $id = $_POST['id'];
    try{
        $stmt = $conn->prepare("DELETE FROM address WHERE id=:id");
        $stmt->execute(['id'=>$id]);
        $output['message'] = 'Address Deleted.';
    }
    catch(PDOException $e){
        $output['error'] = true;
        $output['message'] = 'Cannot update or delete because this is connected to an existing order';
    }
    $pdo->close();
	echo json_encode($output);
?>