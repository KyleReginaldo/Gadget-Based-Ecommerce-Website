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
</style>
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper">
	    <div class="container">
	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
		            <h1 class="page-header" style=" margin-bottom: 0; font-weight: 600; color: black;"><?php echo $cat['name']; ?></h1>
		       		<?php
		       			$conn = $pdo->open();
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $catid]);
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
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>