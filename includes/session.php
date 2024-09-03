<?php
	include 'includes/conn.php';
	session_start();
	if(isset($_SESSION['admin'])){
		header('location: admin/home.php');
	}

	if(isset($_SESSION['user'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT *, users.id AS id, users.firstname AS firstname, users.lastname AS lastname, users.photo AS photo, users.created_on AS created_on, users.contact_info AS contact_info, users.address_id AS addressId, address.region AS region, address.province AS province,address.city AS city,address.baranggay AS baranggay,address.street AS street FROM users LEFT JOIN address ON users.id=address.user_id WHERE users.id=:id");
			$stmt->execute(['id'=>$_SESSION['user']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();
	}
?>