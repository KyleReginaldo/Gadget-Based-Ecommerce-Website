<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<style>
	html{
		scroll-behavior: smooth;
	}
	body::-webkit-scrollbar {
  	display: none;
	}

	.shop-now{
		background-color: blue; 
		padding: 8px 24px; 
		color: white; 
		border-radius: 4px;
		margin-bottom: 12px;
		transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
	}
	.shop-now:hover{
		color: blue;
		background-color: white;
		border: 1px solid blue;
	}
	.image-title img{
		object-fit: cover;
		border-radius: 8px;
		height: 250px;
		width: 100%;
		margin: 0;
		/* width: 50%; */
	}
	.image-title{
		margin:0;
	}
	.content-row{
		/* margin-top: 8px; */
	}
	.learn-more{
		font-weight:600;
		cursor: pointer;
	}
	.learn-more:hover{
		color: blue;
	}
	.left-content{
		background-color: transparent;
		/* padding: 4px 8px; */
		/* margin: auto; */
		text-align:start;
		border-radius: 8px;

	}
	.top-content{
		/* margin-bottom: 10px; */
		margin: 0;
		padding: 0;
	}
	.bottom-content{
		margin-top: 16px;
	}
	.lead{
		font-size: 32px;
	}
	.guide-container{
		background-color: white;
		box-shadow: 5px 5px 5px lightblue;
		margin: 48px 0;
		padding: 8px;
		border-radius: 8px;	
	}
	.guide{
		display: flex;
		justify-content: space-around;
	}
	.guide-content{
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
	.merge-content{
		margin-top: 12px;
	}
	.subtitle{
		margin-bottom: 20px;
	}
	.title{
		font-size: 32px;
		font-weight: bold;
	}
	.about img{
		width: 240px;
	}
	.about-content{
		display: flex;
		justify-content: space-around;
		align-items: center;
	}
	.about-content .left{
		max-width: 60%; 
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
	.contactus{
		background-color: white;
		padding: 32px;
		display:flex;
		flex-direction: row;
		justify-content: space-around;
		text-align: center;
		margin-bottom: 16px;
		border-radius: 8px;
		align-items: center;
	}
	.contactus h5{
		font-size: 32px;
		font-weight: 600;
		color: blue;
	}
	.contact-container{
		display:flex;
		justify-content: center;
		margin-bottom: 24px;
		margin-top: 24px;
	
	}
	.contact-container input{
		padding: 8px 16px;
		border: 1px solid blue;
		width: 50%;
	}
	.contact-container input:focus{
		outline-width: 0;
	}
	.contact-container button{
		padding: 8px 16px;
		background-color: blue;
		color: white;
		border: none;
	}
	.contact-content-left{
		flex: 3;
	}
	.contact-content-right{
		flex: 7;
	}
</style>
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	<div class="content-wrapper">
		<div class="container">
			<section class="content">
				<div class="row" id="#">
					<div class="col-sm-12">
					<?php
					if(isset($_SESSION['error'])){
						echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
						unset($_SESSION['error']);
					}?>
					<div class="top-content text-center" style="padding: 16px;">
						<div class="row bottom-content">
							<div class="left-content col-sm-6">
								<h2 class="title">Your Ultimate Destination for Cutting-Edge Gadgets</h2>
								<p class="subtitle">Explore, Compare, and Choose from an Extensive Collection of Innovative Devices. Whether You're a Tech Enthusiast, a Professional, or Simply Looking for the Perfect Gadget, Jambol Has Everything You Need to Stay Ahead in the Digital World.</p>
								<!-- <a class="learn-more">Learn more &#x2192;</a> -->
								<a class="shop-now" href="category.php?category=1">Shop Now</a>
								<div class="merge-content row">
									<div class="col-sm-6">
										<h4 style="colomr: green; font-weight: 600;">100%</h4>
										<p>Authentic</p>
									</div>
									<div class="col-sm-6">
										<h4 style="color: green; font-weight: 600;">Top</h4>
										<p>Choices for all users.</p>
									</div>
								</div>
							</div>
							<div class="image-title col-sm-6">
								<img class="" src="images/storyset1.png" alt="">
							</div>
						</div>
					</div>
					<div class="guide-container">
						<div class="guide">
							<div class="guide-content">
								<img src="images/storyset-sm-1.png" alt="" width="86">
								<p>We offer secure payment</p>
							</div>
							<div class="guide-content">
								<img src="images/storyset-sm-2.png" alt="" width="86">
								<p>authenticity guaranted</p>
							</div>
							<div class="guide-content">
								<img src="images/storyset-sm-3.png" alt="" width="86">
								<p>100% satisfacttion rate</p>
							</div>
						</div>
					</div>
	<!-- <h2 style="text-align: start; margin-bottom: 8px; color: #000000; font-family: Arial, sans-serif; font-size: 24px; font-weight: 500;">The Top Sellers</h2>
	<div class="box box-solid" style="border: 1px solid #F5EDEDs; border-radius: 5px; padding: 10px; background-color: #000000;">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
				<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
			</ol>
			<div class="carousel-inner">
				<div class="item active">
					<img src="images/banner1.png" alt="First slide" class="img-fluid">
				</div>
				<div class="item">
					<img src="images/banner2.png" alt="Second slide" class="img-fluid">
				</div>
				<div class="item">
					<img src="images/banner3.png" alt="Third slide" class="img-fluid">
				</div>
			</div>
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev" >
				<span class="fa fa-angle-left" style="color: #fff;"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next" >
				<span class="fa fa-angle-right" style="color: #fff;"></span>
			</a>
		</div>
	</div> -->
	<div class="row title-row" style="margin-bottom: 8px; margin-left: 0; padding: 0;">
		<div class="col-sm-6"><p style="text-align: start; margin: 0; padding: 0; color: #2E2D30; font-family: Arial, sans-serif; font-size: 18px; font-weight: 500;">Our Top Collection</p></div>
		<div class="col-sm-6" style="text-align: end;"><a href="category.php?category=1">view more</a></div>
	</div>
						<?php
							$month = date('m');
							$conn = $pdo->open();
							try{
								$inc = 3;	
								$stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
								$stmt->execute();
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
		  <p style="text-align: center; margin-bottom: 8px; color: #4400FF; font-family: Arial, sans-serif; font-size: 18px; font-weight: 600;">About Jambol</p>
		  <div class="about" id="about">
		 	<div class="about-content about-1">
			  			<div class="left">
							<p class="title">Empowering Your Tech Journey</p>
							<p class="subtitle">At Jambol, we are passionate about bringing you the latest and most innovative gadgets on the market. Our platform is designed to help you discover, compare, and choose from a diverse range of devices that cater to your every need. Whether you're a tech enthusiast, a professional seeking the best tools, or someone looking for the perfect gadget to enhance your daily life, Jambol is your ultimate destination.</p>
						</div>
						<img class="img-fluid" src="images/about1.png" alt="">
			</div>
			<div class="about-content about-2">
						<img class="img-fluid" src="images/about2.png" alt="">
			  			<div class="left">
							<p class="title">Why Choose Jambol?</p>
							<p class="subtitle">We believe in making technology accessible and exciting for everyone. Our carefully curated selection of gadgets ensures that you always have access to the newest trends and the most reliable products. With Jambol, you're not just buying a device—you're investing in quality, innovation, and a seamless shopping experience tailored to your unique needs.</p>
						</div>
			</div>
			<div class="about-content about-3">
			  			<div class="left">
							<p class="title">A Community of Tech Lovers</p>
							<p class="subtitle">Jambol is not just a store; it’s a community of like-minded individuals who share a passion for technology. We encourage you to explore our extensive product range, engage with our content, and join a network of tech enthusiasts who, like you, are eager to stay ahead of the curve. At Jambol, we’re more than just about gadgets—we’re about creating connections through technology.</p>
						</div>
						<img class="img-fluid" src="images/about3.png" alt="">
			</div>
		  </div>
		  <form action="">
			<div class="contactus" id="contactus">
				<div class="contact-content-left">
					<img src="images/contactus.png" alt="" width="160px">
					<p></p>
					<p>We’d love to hear from you! Whether you have a question, feedback, or need support, feel free to reach out.</p>
				</div>
				<div class="contact-content-right">
					<h5>Contact us</h5>
					<p>Reach out and we'll get in touch within 24 hours.</p>
					<div class="contact-container">
						<input type="email" placeholder="Enter your email">
						<button type="submit">Submit</button>
					</div>
				</div>
			</div>
		  </form>
	    </div>
	  </div>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>