<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];
	$selected = $_POST['selected'];

	try{
        $previousStmt = $conn->prepare("UPDATE address SET selected=:updated_selected WHERE user_id=:user_id AND selected=:selected");
        $previousStmt->execute(['updated_selected'=>false, 'user_id'=>$user['id'],'selected'=>true]);
        $stmt = $conn->prepare("UPDATE address SET selected=:selected WHERE id=:id");
        $stmt->execute(['selected'=>$selected, 'id'=>$id]);
        $output['message'] = 'Updated';
    }
    catch(PDOException $e){
        $output['message'] = $e->getMessage();
    }

	$pdo->close();
	echo json_encode($output);

?>