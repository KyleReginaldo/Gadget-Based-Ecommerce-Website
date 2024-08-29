<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
	.checkout-button{
		background-color: blue; 
		color: white; 
		border: none; 
		padding: 8px 32px; 
		border-radius: 4px;
		transition: background-color 0.2s ease-in-out;
	}
	.checkout-button:hover{
		background-color: #FABC3F;
	}
	.checkout-button a{
		margin-left: 8px;
		color: white;
	}
</style>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>

	  <div class="content-wrapper">
	    <div class="container">
	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
	        		<h1 class="page-header">YOUR CART</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
								<th width="20%">Stock</th>
		        				<th>Subtotal</th>
								<th><center>Selected</center></th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
	        		?>
					<div style='display: flex; justify-content: end;'>
							
						<button class="checkout-button"><i class="fa fa-shopping-bag"></i>
							<!-- <a href=<?php
							// $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM cart WHERE user_id=:user_id AND selected=true");
							// $stmt->execute(['user_id'=>$_SESSION['user']]);
							// $result = $stmt->fetch();
							// if($result['numrows'] > 0){
							// 	echo 'checkout_view.php';
							// }
							?>>Checkout
							</a> -->
							<a href='checkout_view.php'>Checkout
							</a>
						</button>
					</div>
					<?php
					}
					?>
	        	</div>
	        	<!-- <div class="col-sm-1">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div> -->
	        </div>
	      </section>
		  
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
	
var total = 0;
$(function(){
	$(document).on('click', '.delete_cart', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});
	
	$(document).on('change', '.selected', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var isChecked = $(this).is(':checked') ? 1 : 0;
		$.ajax({
			type: 'POST',
			url: 'update_status.php',
			data: {
				id:id,
				selected: isChecked,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = parseInt($('#qty_'+id).val(), 10);
		var max = parseInt($('#qty_'+id).attr('max'), 10);
		if(qty < max){
			qty++;
			$('#qty_'+id).val(qty);
			$.ajax({
				type: 'POST',
				url: 'cart_update.php',
				data: {
					id: id,
					qty: qty,
				},
				dataType: 'json',
				success: function(response){
					if(!response.error){
						getDetails();
						getCart();
						getTotal();
					}
				}
			});
		}
	});

	getDetails();
	getTotal();

});


function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function buyNow(){
	alert('This function is on progress');
}
function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<!-- Paypal Express -->
<script>
paypal.Button.render({
    env: 'production', // change for production if app is live,
	client: {
        //sandbox:    'ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ',
        production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },
    commit: true, // Show a 'Pay Now' button
    style: {
    	color: 'gold',
    	size: 'small'
    },
    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                        amount: { 
                        	total: total, 
                        	currency: 'PHP' 
                        }
                    }
                ]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
			window.location = 'sales.php?pay='+payment.id;
        });
    },

}, '#paypal-button');
</script>
<script src="https://www.paypal.com/sdk/js?client-id=ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ&currency=USD"></script>
</body>
</html>