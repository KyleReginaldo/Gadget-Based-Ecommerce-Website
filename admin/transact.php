<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT  *, users.firstname AS firstname, users.lastname AS lastname, products.name AS prodName, category.name AS catName, orders.id AS id, products.price as price FROM orders INNER JOIN users ON orders.user_id=users.id INNER JOIN products ON orders.product_id=products.id INNER JOIN category ON products.category_id=category.id WHERE orders.id=:id");
	$stmt->execute(['id'=>$id]);
	$total = 0;
	foreach($stmt as $row){
		$total = $row['total'];
		$output['transaction'] = $row['order_number'];
		$output['address'] = "{$row['region']}, {$row['province']}, {$row['city']}, {$row['baranggay']}, {$row['street']}";
		$output['date'] = date('M d, Y', strtotime($row['created_at']));
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['name']."</td>
				<td>&#8369; ".number_format($row['price'], 2)."</td>
				<td>".$row['quantity']."</td>
				<td>&#8369; ".number_format($row['total'], 2)."</td>
			</tr>
			<div>
			<p>".$row['region']."</p>
			</div>
		";
	}
	
	$output['total'] = '<b>&#8369; '.number_format($total, 2).'<b>';
	$pdo->close();
	echo json_encode($output);

?>