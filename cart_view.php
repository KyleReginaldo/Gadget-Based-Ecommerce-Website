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
	.checkout-button:disabled {
		background-color: grey;
		cursor: not-allowed;
		opacity: 0.6;
	}
</style>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>

	  <div class="content-wrapper" style="margin-top: 4rem">
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
		        				<th width="10%">Price</th>
								<th width="10%">Discount</th>
		        				<th width="20%">Quantity</th>
								<th width="10%">Stock</th>
		        				<th width="20%">Subtotal</th>
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
						<a href='checkout_view.php' id="checkout-button">
								<button class='checkout-button'><i class='fa fa-shopping-bag'></i>Checkout</button>
							</a>
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
					// getRedirect();
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
	getCart();
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
    env: 'production', 
	client: {
        
        production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },
    commit: true, 
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
<script src="https:
</body>
</html>