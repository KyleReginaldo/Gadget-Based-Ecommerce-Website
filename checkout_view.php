<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Check out</title>
	<script src="https:
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
			border-radius: 4px;
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
		.success-callout{
			display: flex;
			justify-content: space-between;
			margin: 1rem 0;
			background-color: white;
			align-items: center;
			padding: 0.4rem 1rem;
			border-radius: 4px;
			color: black;
		}
		.success-callout span{
			color: black;
		}
		.success-callout a{
			cursor: pointer;
			color: blue;
			text-decoration: none;
			padding: 0.4rem 0.6rem;
			border-radius: 4px;
			transition: background-color 0.4s ease-in-out;
		}
		.success-callout a:hover{
			color: black;
			text-decoration: none;
			padding: 0.4rem 0.6rem;
			background-color: blue;
			border-radius: 4px;
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
		.address-container{
			background-color: #F5F5F5;
			margin: 0.5rem 0;
			padding: 0.8rem;
			border-radius: 8px;
		}
		.selected-address{
			border: 2px solid blue;
			opacity: 0;
			animation: fadeIn 0.3s ease-out forwards;
			animation-delay: 0.2s;
			font-size: 1.1rem;
			font-weight: 600;
			color: blue;
		}
		.address-checkbox{
			margin: 0 0.5rem;
		}
		.content-header{
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.label{
			font-size: 0.9rem;
			color: grey;
		}
		.content{
			font-size: 1rem;
			color: black;
		}
		@keyframes fadeIn {
			from {
				opacity: 0;
			}
			to {
				opacity: 1;
			}
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
						$totalSub = 0;
						$totalDiscount = 0;
		       			$conn = $pdo->open();
		       			try{
		       			 	$inc = 3;	
                            $stmt = $conn->prepare("SELECT * FROM cart INNERT JOIN products ON product_id = products.id WHERE user_id = :userid AND selected=true");
                            $stmt->execute(['userid' => $user['id']]);
						    foreach ($stmt as $row) {
								$_SESSION['productId'] = $row['id'];
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
								$originalPrice = $row['price'];
								$discount = ($row['discount'] / 100) * $row['price'];
								$price = $originalPrice - $discount;
								$subtotal = $price * $row['quantity'];
								$totalDiscount += $discount;
								$totalSub += $originalPrice * $row['quantity'];
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
							<?php echo "<p class='subtotal'>&#8369;".number_format($totalSub, 2)."</p>";?>
						</div>
						<div class="between discount">
							<p>Discount</p>
							<?php echo "<p class='discount'>&#8369;".number_format($totalDiscount, 2)."</p>";?>
						</div>
						<div class="between">
							<p>Total</p>
							<?php echo "<p class='total'>&#8369;".number_format($total, 2)."</p>";?>
						</div>
						<p class="agree"><input type="checkbox" name="agree" id="agree" required> I have read and agree to the Terms and Condition</p>
						<?php
						$show = $user['addressId'] ? "" : "hidden"; 
						echo '<button type="submit" class="place-order" id="place-order" '.$show.'>Place Order</button>';
						?>
						<div class="success-callout" id="success-callout" style="display:none;">
							<span class="message">Order placed</span>
							<a href="orders.php?status=Pending"><i class="fa fa-shopping-bag"></i> go to Order</a>
	        			</div>
					</div>
			</div>
			</div>
			<div class="left-container col-md-6">
					<p class="checkout-title"><a href="cart_view.php"><i class="back fa fa-chevron-left"></i></a> Checkout</p>
					<div class="error-callout" id="error-callout" style="display:none;">
						<span class="error" style="color: red; margin: 0; padding: 0;"></span>
					</div>
					<h6 class="checkout-subtitle">Personal Details</h6>
					<p class="label">Name: <span class="content"><?php echo $user['firstname'].' '.$user['lastname']?></span></p>
					<p class="label">Contact: <span class="content"><?php echo $user['contact_info']? $user['contact_info']:'no contact' ?></span></p>
					<br>
					<h6 class="checkout-subtitle">Shipping Information</h6>
					<div id="address-view"></div>
					<div id="no-address"></div>
					<!-- <div class="left-container-child">
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
					</div> -->
			</div>
        </div>
    </div>	
	</form>
	<?php include 'includes/scripts.php'; ?>
</body>
<script>
$(function(){
	getAddress();
	$(document).on('change', '.address-checkbox', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var isChecked = $(this).is(':checked') ? 1 : 0;
		$.ajax({
			type: 'POST',
			url: 'update_address.php',
			data: {
				id:id,
				selected: isChecked,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getAddress();
				}
			}
		});
	});
});
// function getRedirect(){
// 	$.ajax({
// 		type: 'POST',
// 		url: 'check_redirect.php',
// 		dataType: 'json',
// 		success: function(response){	
// 			$('#checkout-button').attr('href', response.url);
// 			if(response.error){
// 				$('#checkout-button').prop('disabled', true);
// 			}
// 		}
// 	});
// }
function getAddress(){
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "fetch_address_checkout.php",
            // data: {},
            dataType: 'json',
            success: function(response) {
                $('#address-view').html(response);
            }
        });
    });
}
</script>
</html>

