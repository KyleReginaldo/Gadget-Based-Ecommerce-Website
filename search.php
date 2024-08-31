<?php include 'includes/session.php'; ?>
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
		.input-group-btn button{
			color: blue;
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
	            <?php
	       			$conn = $pdo->open();
	       			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE name LIKE :keyword");
	       			$stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
	       			$row = $stmt->fetch();
	       			if($row['numrows'] < 1){
	       				echo '<h1 class="page-header">No results found for <i>'.$_POST['keyword'].'</i></h1>';
	       			}
	       			else{
	       				echo '<h1 class="page-header">Search results for <i>'.$_POST['keyword'].'</i></h1>';
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :keyword");
						    $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
						    foreach ($stmt as $row) {
						    	$highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['name']);
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