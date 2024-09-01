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
	$hideNoDiscount = $product['discount'] > 0 ? '': 'hidden';
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
		 border:none;
		 height: auto;
		}
		.box img{
		border-radius: 4px;
		object-fit: contain;
		transition: scale 0.3s ease-in-out;
		}
		.box img:hover{
			scale: 0.8;
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
			color: black;
			border:1px solid white;
			background-color: lightgrey;
		}
		.input-group{
			margin-right: 4rem;
			width: 20%;
		}
		.input-group input{
			/* width: 60px; */
			border: none;
		}
		.add-cart{
			padding: 0.5rem 2rem;
			margin: 0 1rem;
			border-radius: 16px;
			transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, border 0.2s ease-in-out, border-radius 0.2s ease-in-out;
		}
		.add-cart:hover{
			background-color: white;
			border: 1px solid blue;
			color: blue;
			border-radius: 4px;
		}
		.checkout{
			padding: 0.5rem 2rem;
			margin: 0 1rem;
			border-radius: 16px;
			border: 1px solid blue;
			color: blue;
			transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, border 0.2s ease-in-out, border-radius 0.2s ease-in-out;
		}
		.checkout:hover{
			background-color: blue;
			border: 1px solid white;
			color: white;
			border-radius: 4px;
		}
		.image-container{
			background-color: #FFFFFF;
			padding: 24px;
			border-radius: 8px;
			border: none;
			height: 400px;
			display: flex;
			justify-content: center;
			align-items: center;
			
		}
		.image-container img{
			object-fit: contain;
			max-height: 360px;
			margin: auto;
		}
		.form-group{
			/* width: 60%; */
			display: flex;
		}	
		.truncate {
    	display: inline-block;
    	max-width: 100%;
    	white-space: nowrap;
    	overflow: hidden;
    	text-overflow: ellipsis;
		}
		.category{
			margin: 1rem 0;
			border: 1px solid black;
			padding: 0.2rem 3rem;
			border-radius: 25px;
			cursor: pointer;
			transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
		}
		.category:hover{
			background-color: black;
			color: white;
		}
		.orig-price{
			color: grey;
			text-decoration: line-through;
			font-size: 2rem;
		}
		.discount{
			color: red;
			font-size: 2rem;
		}
		.title{
			font-size: 2rem;
			font-weight: 600;
		}
		.rating-container{
			background-color: white;
			padding: 0.6rem 1rem;
			margin: 1rem 0;
			border-radius: 8px;
		}
		.rating-name{
			font-size: 1.4rem;
			margin: 0;
		}
		.rating-message{
			color: black;
			font-style: italic;
		}
		.stars{
			margin: 0;
			padding: 0;
		}
		.fa-star {
            font-size: 16px;
            color: #d3d3d3;
        }
        .fa-star.checked {
            color: #ffcc00;
        }
		.rating-title{
			display: flex;
			justify-content: space-between;
		}
		.rating-title a{
			cursor: pointer;
		}
		.rating-title a:hover{
			font-weight: 600;
		}
		.rating-value{
			font-weight: 600;
			color: blue;
		}
		.page-header{
			margin-bottom: 0;
			pading-bottom: 0;
		}
		.product-rating{
			margin-top: 0.4rem;
			margin-bottom: 1rem;
		}
		h5{
			margin: 0;
			margin-top: 0.5rem;
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
	 
	  <div class="content-wrapper" style="margin-top: 4rem;">
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
		            		<h1 class="page-header"><?php echo $product['prodname']; ?>
							<div class='stars product-rating' data-rating=<?php echo htmlspecialchars($product['rating']);?>>
								<span class='fa fa-star'></span>
								<span class='fa fa-star'></span>
								<span class='fa fa-star'></span>
								<span class='fa fa-star'></span>
								<span class='fa fa-star'></span>
							</div>
							</h1>
							<a class="category" href="category.php?category=<?php echo $product['category_id']; ?>"><?php echo $product['catname']; ?></a>
							<h3 $hideNoDiscount><p class="orig-price">&#8369; <?php 
							$discount = ($product['discount'] / 100) * $product['price'];
							$originalPrice = $product['price'];
							$price = $originalPrice - $discount;
							echo number_format($originalPrice, 2);
							 ?></p><p class="discount"> - &#8369; <?php echo number_format($discount, 2);?></p></h3>
		            		<h3 ><b>&#8369; <?php echo number_format($price, 2); ?></b></h3>
							
							<form class="" id="productForm" method="post">
								
		            			<div class="form-group">
			            			<div class="input-group col-sm-5">
			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-md"><i class="fa fa-chevron-left"></i></button>
			            				</span>
							          	<input type="text" name="quantity" id="quantity" class="quantity form-control input-md text-center" value="1">
							            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-md"><i class="fa fa-chevron-right"></i>
							                </button>
							            </span>
							            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
							        </div>
									<div class="buttons">
									<button type="submit" class="add-cart btn btn-primary btn-md">Add to Cart</button>
									<a href="cart_view.php" class="checkout btn btn-md" id="checkout">Checkout</a>
								</div>
			            		</div>
								<p><?php echo $product['description']; ?></p>

		            		</form>
		            	</div>
		            </div>
		            <br>
	        </div>
	      </section>
	    </div>
		<div class="container review-container">
			<?php
			
			function timeAgo($timestamp) {
				$now = new DateTime();
				$date = new DateTime($timestamp);
				$interval = $now->diff($date);
				if ($interval->y > 0) {
					return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
				} elseif ($interval->m > 0) {
					return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
				} elseif ($interval->d > 0) {
					return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
				} elseif ($interval->h > 0) {
					return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
				} elseif ($interval->i > 0) {
					return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
				} else {
					return $interval->s . ' second' . ($interval->s > 1 ? 's' : '') . ' ago';
				}
			}
			$stmt = $conn->prepare("SELECT *, ratings.rating as rating FROM ratings INNER JOIN products ON ratings.product_id=products.id INNER JOIN users ON ratings.user_id=users.id WHERE products.slug=:slug ORDER BY created_at ASC LIMIT 5");
			$stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount() !== 0){
				echo "
				<div class='rating-title'>
					<p class='title'>Reviews</p>
					<a id='see-more'>see more</a>
				</div>";
			}
			echo '<div id="ratings-container" id="ratings-container">';
			foreach ($stmt as $row) {
				echo "<div class='rating-container'>". timeAgo($row['created_at']) ."
					<p class='rating-name'> " . htmlspecialchars($row['firstname']) . " ". htmlspecialchars($row['lastname']) . "</p>
					<div class='stars' data-rating=" . htmlspecialchars($row['rating']) . ">
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span>
						<span class='fa fa-star'></span>
						(<span class='rating-value'>".$row['rating']."</span> out of 5)
					</div>
					<p class='rating-message'> " . htmlspecialchars($row['message']) . "</p>
				</div>";
			}
			echo '</div>';
			?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var starContainers = document.querySelectorAll('.stars');
    starContainers.forEach(container => {
        var rating = parseInt(container.getAttribute('data-rating'), 10); // Get rating from data attribute
        var stars = container.querySelectorAll('.fa-star');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('checked');
            } else {
                star.classList.remove('checked');
            }
        });
    });
});
</script>
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
	       							 <a  href='product.php?product=".$row['slug']."'>
										   <div class='col-sm-4'>
												<div class='box'>
													<div class='box-body prod-body'>
														<img src='".$image."' width='100%' height='220px'>
														<b>&#8369; ".number_format($row['price'], 2)."</b>
														<h5><a href='product.php?product=".$row['slug']."' class='truncate'>".$row['name']."</a></h5>
														<div class='stars' data-rating='".$row['rating']."'>
															<span class='fa fa-star'></span>
															<span class='fa fa-star'></span>
															<span class='fa fa-star'></span>
															<span class='fa fa-star'></span>
															<span class='fa fa-star'></span>
														</div>
													</div>
												</div>
											</div>
										  </a>
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
	getReviews();
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

function getReviews(){
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "review_details.php",
            data: {},
            dataType: 'json',
            success: function(response) {
                $('#ratings-container').html(response);
            }
        });
    });
}

</script>
</body>
</html>