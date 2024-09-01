<?php include 'includes/session.php'; ?>
<?php
	$categoryID = $_GET['category'];

	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM category WHERE id = :categoryID");
		$stmt->execute(['categoryID' => $categoryID]);
		$cat = $stmt->fetch();
		$catid = $cat['id'];
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<style>
	@keyframes fadeIn {
		from {
			opacity: 0;
			transform: translateY(20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}
	.box{
		background-color: white;
		border-radius: 8px;
		padding: 16px 8px;
		border:none;
		height: auto;
		opacity: 0; /* Initial state before animation */
		animation: fadeIn 0.3s ease-out forwards; /* Apply the animation */
		animation-delay: 0.2s; /* Optional: delay before the animation starts */
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
	.box img{
		border-radius: 4px;
		object-fit: contain;
		transition: scale 0.3s ease-in-out;
	}
	.box img:hover{
		scale: 0.8;
	}
	.truncate {
    	display: inline-block;
    	max-width: 100%;
    	white-space: nowrap;
    	overflow: hidden;
    	text-overflow: ellipsis;
		margin: 0;
	}
	.stars{
		margin: 0;
	}
	h5{
		margin: 0;
		margin-top: 0.5rem;
	}
	.fa-star {
            font-size: 16px;
            color: #d3d3d3;
	}
	.fa-star.checked {
		color: #ffcc00;
	}
	.tab-row{
		display: flex;
		flex-direction: row;
		justify-content: start;
		margin: 24px 0;
		padding: 8px 0;
		margin-right: 1rem;
		color:blue;
		align-items: center;
		border-radius: 4px;
	}
	.cat-choice{
		background-color: transparent;
		border: none;
		margin-right: 0.5rem;
		transition: font-weight 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out, padding 0.2s ease-in-out, border-radius 0.2s ease-in-out;
	}
	
</style>
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper" style="margin-top: 4rem;">
	    <div class="container">
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
					<form action="" method="get">
						<div class="tab-row">
							<button class="cat-choice" type="submit" name="category" value="1" data-id="1">Laptops</button>
							<button class="cat-choice" type="submit" name="category" value="2" data-id="2">Desktop PC</button>
							<button class="cat-choice" type="submit" name="category" value="3" data-id="3">Tablets</button>
							<button class="cat-choice" type="submit" name="category" value="4" data-id="4">Smart Phones</button>
							<button class="cat-choice" type="submit" name="category" value="8" data-id="8">Accessories</button>
						</div>
					</form>
		       		<?php
		       			$conn = $pdo->open();
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $catid]);
						    if($stmt){
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
							}else{
								echo "<div><p>There is no available products</p></div>";
							}
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}
						$pdo->close();
		       		?>
					<?php
					?>
	        	</div>
	        	<!-- <div class="col-sm-1">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div> -->
	        </div>
	      </section>
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const category = urlParams.get('category');
        
        if (category) {
            const buttons = document.querySelectorAll('.cat-choice');
			buttons.forEach(button => {
				if (button.dataset.id === category) {
					button.style.backgroundColor = 'blue';
					button.style.color = 'white';
					button.style.padding = '0.4rem 1rem';
					button.style.borderRadius = '16px';
				}
			});
        }
    });
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
<?php include 'includes/scripts.php'; ?>
</body>
</html>