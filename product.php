<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();
	$slug = $_GET['product'];
	$category = '';
	try{
		 		
	    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE slug = :slug");
	    $stmt->execute(['slug' => $slug]);
	    $product = $stmt->fetch();
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	//page view
	$now = date('Y-m-d');
	if($product['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid'], 'now'=>$now]);
	}

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
	<style>
		.btn-primary{
			background: blue;
		}
		.btn-primary:hover{
			background: blue;
		}
		.box{
		 background-color: white;
		 border-radius: 8px;
		 padding: 16px 8px;
		}
		.box b{
		font-size: 18px;
		}
		.box h5:hover{
		font-weight: 600;
		}
		.title-row{
			margin: 0;
		}
		.input-group-btn button{
			color: blue;
		}
		.input-group input{
			width: 80px;
		}
		.checkout{
			background-color: #F9E400;
			color: white;
			transition: color 0.2s ease-in-out;
		}
		.image-container{
			background-color: #F6F5F5;
			padding: 24px;
			border-radius: 8px;
		}
		.zoom{
			
		}
	</style>
<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
	        		<div class="callout" id="callout" style="display:none">
	        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
	        			<span class="message"></span>
	        		</div>
		            <div class="row">
		            	<div class="image-container col-sm-5">
		            		<img src="<?php echo (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg'; ?>" width="100%" class="zoom" data-magnify-src="images/large-<?php echo $product['photo']; ?>">
		            	</div>
		            	<div class="col-sm-7">
		            		<h1 class="page-header"><?php echo $product['prodname']; ?></h1>
		            		<h3><b>&#8369; <?php echo number_format($product['price'], 2); ?></b></h3>
		            		<p><b>Category:</b> <a href="category.php?category=<?php echo $product['category_id']; ?>"><?php echo $product['catname']; ?></a></p>
		            		<p><?php echo $product['description']; ?></p>
							<form class="" id="productForm" method="post">
		            			<div class="form-group">
			            			<div class="input-group col-sm-5">
			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-md"><i class="fa fa-minus"></i></button>
			            				</span>
							          	<input type="text" name="quantity" id="quantity" class="form-control input-md text-center" value="1">
							            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-md"><i class="fa fa-plus"></i>
							                </button>
							            </span>
							            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
							        </div>
			            		</div>
								<div class="buttons">
									<button type="submit" class="add-cart btn btn-primary btn-md">Add to Cart</button>
									<button type="button" class="checkout btn btn-md" id="checkout">Checkout</button>
								</div>

		            		</form>
							<!-- <?php
									echo $_POST['quantity'];
									 if(isset($_POST['quantity']) && $product['stock'] > Number($_POST['quantity'])){
										echo '<div>Test error</div>';
									 }
									?> -->
		            	</div>
		            </div>
		            <br>
				    <div class="fb-comments" data-href="http://localhost/ecommerce/product.php?product=<?php echo $slug; ?>" data-numposts="10" width="100%"></div> 
	        	</div>
	        	<!-- <div class="col-sm-1">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div> -->
	        </div>
	      </section>
	    </div>
		<div class="container">
	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
		            <p class="" style=" margin-bottom: 8px; font-weight: 500; color: black; font-size: 18px;">Related Products</p>
		       		<?php
		       			$conn = $pdo->open();
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :category_id");
							$stmt->execute(['category_id' => $product['category_id']]);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
											<div class='box'>
												<div class='box-body prod-body'>
													<img src='".$image."' width='100%' height='220px' class='fluid'>
													<b>&#8369; ".number_format($row['price'], 2)."</b>													
													<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
												</div>
											</div>
										</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

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
$(function(){
	$('#checkout').click(function(e){
		e.preventDefault();
		alert('This function is in progress');
	})
})

$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});

});
</script>
</body>
</html>