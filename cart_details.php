<?php
	include 'includes/session.php';
	$conn = $pdo->open();
	$output = '';

	try{
		$total = 0;
		$stmt = $conn->prepare("SELECT *,cart.selected AS selected, cart.id AS cartid, products.stock AS stocks FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user");
		$stmt->execute(['user'=>$user['id']]);
		foreach($stmt as $row){
			$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
			$discount = ($row['discount'] / 100) * $row['price'];
			$originalPrice = $row['price'];
			$price = $originalPrice - $discount;
			$subtotal =$price * $row['quantity'];
			if($row['selected']){
				$total += $subtotal;
			}
			$selected = $row['selected'] ? 'checked' : '';
			$output .= "
				<tr>
					<td><center><button type='button' data-id='".$row['cartid']."' class='btn btn-danger btn-round delete_cart'><i class='fa fa-remove'></i></button></center></td>
					<td><img src='".$image."' width='30px' height='30px'></td>
					<td>".$row['name']."</td>
					<td>
					&#8369; ".number_format($price, 2)." 
					</td>
					<td>
					&#8369; ".number_format($discount, 2)." 
					</td>
					<td class='input-group'>
						<span class='input-group-btn'>
							<button type='button' id='minus' class='btn btn-default btn-flat minus' data-id='".$row['cartid']."'><i class='fa fa-minus'></i></button>
						</span>
						<input type='text' class='form-control' value='".$row['quantity']."' id='qty_".$row['cartid']."' max='".$row['stocks']."'>
						<span class='input-group-btn'>
							<button type='button' id='add' class='btn btn-default btn-flat add' data-id='".$row['cartid']."'><i class='fa fa-plus'></i>
							</button>
						</span>
					</td>
					<td data-id='".$row['stocks']."' id='stock'>".$row['stocks']."</td>
					<td>&#8369; ".number_format($subtotal, 2)."</td>
					<td><center><form id='formStatus'><input type='checkbox' class='selected' name='selected' data-id='".$row['cartid']."' id='".$row['cartid']."' $selected></form></center></td>
				</tr>
			";
		}
		$output .= "
			<tr>
				<td colspan='6' align='right'><b>Total</b></td>
				<td><b>&#8369; ".number_format($total, 2)."</b></td>
			<tr>
		";
	}
	catch(PDOException $e){
		$output .= $e->getMessage();
	}
	$pdo->close();
	echo json_encode($output);
?>

