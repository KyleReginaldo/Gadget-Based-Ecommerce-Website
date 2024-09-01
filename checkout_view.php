<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Check out</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="ph-address-selector.js"></script>
    <style>
		*{
			margin: 0;
            padding: 0;
		}
		p{
			margin: 0;
		}
        body{
            background-color: #F0F0F0;
        }
        .item-display{
            display: flex;
            align-items: start;
            align-content:center;
            justify-content: start;
            margin: 12px 0;
        }
		.item-display img{
			border: 1px solid lightgrey;
			border-radius: 8px;
			padding: 8px;
			margin: 0;
		}
        .item-display p{
            margin-right: 16px;
            margin-left: 16px;
            margin-bottom: 0;
        }
        .name{
            font-size: 0.9rem;
        }
        .price{
			margin-top: 8px;
            font-size: 1rem;
			font-weight: 600;
        }

		.left-container{
			display: flex;
			flex-direction: column;
			padding: 16px;
		}
		.left-container-child{
			margin-right: 16px;
		}
		.right-container{
			display: flex;
			flex-direction: column;
			padding: 16px;
			background-color: #F5F7F8;
			border-radius: 8px;
		}
		form > input{
			width: 100%;
			margin-bottom: 8px;
			padding: 4px 12px;
			border-radius: 4px;
			border: 0.8px solid grey;
		}
		form > input:focus {
			outline: none;
			}

		span{
			color: red;
		}
		label{
			margin-bottom: 0px;
		}
		.col-md-6{
			width: 100%;
		}
		.container-md{
			margin: 4rem auto;
			padding: 2rem;
			background-color: white;
			border-radius: 10px;
		}
		.total{
			font-size: 1.2rem;
			color: black;
			font-weight: bold;
		}
		.between{
			/* margin: 0 8px; */
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.between p{
			font-weight: 600;
		}
		.review{
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			height: 100%;
		}
		.agree{
			margin: 0.5rem 0;
			font-weight: 400;
		}
		.place-order{
			width: 100%;
			padding: 8px 0;
			font-weight: 600;
			color: white;
			background-color: blue;
			border: none;
			border-radius: 8px;
		}
		.place-order:focus{
			border:none;
		}
		h5{
			 margin-bottom: 16px;
			 font-size: 24px;
		}
		label{
			margin-bottom: 0;
			margin-top: 8px;
		}
		.pm-label{
			margin-top: 1rem;
		}
		.payment-method{
			 display: flex;
		}
		.payment-method p{
			margin-right: 24px;
			font-weight: 600;
		}
		.payment-method p:nth-child(2), .payment-method p:nth-child(3) {
			margin-right: 24px;
			font-weight: 400;
			color: grey;
		}
		.payment-method input{
			border-radius: 100px;
			border: 1px solid blue;
			color:blue;
		}
		.callout{
			display: flex;
			justify-content: space-between;
			margin: 1rem 0;
		}
		.callout a{
			cursor: pointer;
			color: blue;
			text-decoration: none;
		}
		.error-callout{
			display: flex;
			justify-content: space-between;
			margin: 1rem 0;
		}
		.error-callout a{
			cursor: pointer;
			color: red;
			text-decoration: none;
		}
		.required{
			color: red;
		}
		.cart-title{
			color: black;
			font-weight: 600;
			font-size: 18px;
		}
		.checkout-title{
			font-weight: 600;
			font-size: 32px;
			letter-spacing: 4px;
			margin-bottom: 8px;
		}
		.checkout-subtitle{
			color: black;
		}
		.form-label, .pm-label{
			margin-bottom: 0.3rem;
		}
		.subtotal, .discount{
			color: grey;
			margin-bottom: 4px;
			font-size: 14px;
		}
		.back{
			width: 16px;
			height: 16px;
			margin-right: 1rem;
		}
    </style>
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <form id="checkoutForm" action="" method="post">
	<div class="container-md">
        <div class="row d-flex flex-row-reverse">
			<div class="right-container col-md-6">
			<p class="cart-title">Review your cart</p>
			<div class="review">
				<?php	
						$total = 0;
		       			$conn = $pdo->open();
		       			try{
		       			 	$inc = 3;	
                            $stmt = $conn->prepare("SELECT * FROM cart INNERT JOIN products ON product_id = products.id WHERE user_id = :userid AND selected=true");
                            $stmt->execute(['userid' => $_SESSION['user']]);
						    foreach ($stmt as $row) {
								$_SESSION['productId'] = $row['id'];
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
								$subtotal = $row['price'] * $row['quantity'];
								$total += $subtotal;
	       						if($inc == 1) echo "<div class=''>";
	       						echo "<div class='item-display'>
                                    		<img src='".$image."' alt='' width='64px' height='64px'>
                                    		<div>
												<p class='name'>".$row['name']."</p>
												<p class='name'>".$row['quantity']."x</p>
												<p class='price'>&#8369;".number_format($subtotal,2)."</p>
                                    		</div>
										</div>";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}
						
						$_SESSION['total'] = $total;
						$pdo->close();
		       		?>
					<div>
						<div class="between subtotal">
							<p>Subtotal</p>
							<?php echo "<p class='subtotal'>&#8369;".number_format($total, 2)."</p>";?>
						</div>
						<div class="between discount">
							<p>Discount</p>
							<?php echo "<p class='discount'>&#8369;".number_format(0, 2)."</p>";?>
						</div>
						<div class="between">
							<p>Total</p>
							<?php echo "<p class='total'>&#8369;".number_format($total, 2)."</p>";?>
						</div>
						<p class="agree"><input type="checkbox" name="agree" id="agree" required> I have read and agree to the Terms and Condition</p>
						<button type="submit" class="place-order">Place Order</button>
						<div class="callout" id="callout" style="display:none;">
							<span class="message" style="color: green;"></span>
							<a href="orders.php?status=Pending">go to Order</a>
	        			</div>
					</div>
			</div>
			</div>
			<div class="left-container col-md-6">
					<p class="checkout-title"><a href="cart_view.php"><i class="back fa fa-chevron-left"></i></a> Checkout</p>
					<h6 class="checkout-subtitle">Shipping Information</h6>
					<div class="error-callout" id="error-callout" style="display:none;">
						<span class="error" style="color: red; margin: 0; padding: 0;"></span>
					</div>
					<div class="left-container-child">
						<label class="form-label">Region <span class="required">*</span></label>
						<select name="region" class="form-control form-control-md" id="region"></select>
						<input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
						<label class="form-label">Province <span class="required">*</span></label>
						<select name="province" class="form-control form-control-md" id="province"></select>
						<input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
						<label class="form-label">City / Municipality <span class="required">*</span></label>
						<select name="city" class="form-control form-control-md" id="city"></select>
						<input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
						<label class="form-label">Barangay <span class="required">*</span></label>
						<select name="barangay" class="form-control form-control-md" id="barangay"></select>
						<input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
						<label for="street-text" class="form-label">Street <span class="required">*</span></label>
						<input type="text" class="form-control form-control-md" name="street_text" id="street-text" required>
						<p class="pm-label">Payment Method <span class="required">*</span></p>
						<div class="payment-method">
							<p><input type="checkbox" name="COD" id="agree"> Cash On Delivery</p>
							<p><input type="checkbox" name="GCash" id="agree" disabled> GCash</p>
							<p><input type="checkbox" name="Maya" id="agree" disabled> Maya</p>
						</div>
					</div>
			</div>
        </div>
    </div>	
	</form>
	<?php include 'includes/scripts.php'; ?>

</body>
</html>

