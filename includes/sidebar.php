<div class="row">
	<div class="box box-solid" style="background: linear-gradient(to right, #007bff,#0056b3 );">
	<div class="box-header with-border" style="background: linear-gradient(to right, #007bff,#0056b3 );">
    <h3 class="box-title" style="color: #fff;"><b>Most Viewed Today</b></h3>
</div>

	  	<div class="box-body">
	  		<ul id="trending">
	  		<?php
	  			$now = date('Y-m-d');
	  			$conn = $pdo->open();

	  			$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
	  			$stmt->execute(['now'=>$now]);
	  			foreach($stmt as $row){
	  				echo "<li><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  			$pdo->close();
	  		?>
	    	<ul>
	  	</div>
	</div>
</div>

<div class="row">
	<div class="box box-solid" style="background: linear-gradient(to right, #007bff, #0056b3);">
	  	<div class="box-header with-border" style="background: linear-gradient(to right, #007bff, #0056b3);">
	    	<h3 class="box-title"  style="color: #fff;"><b>Become a Subscriber</b></h3>
	  	</div>
	  	<div class="box-body"  style="color: #fff;">
	    	<p>Get free updates on discounts, straight to your inbox.</p>
	    	<form method="POST" action="">
		    	<div class="input-group">
	                <input type="text" class="form-control">
	                <span class="input-group-btn">
	                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-envelope"></i> </button>
	                </span>
	            </div>
		    </form>
	  	</div>
	</div>
</div>

<div class="row">
	<div class='box box-solid' style='background: linear-gradient(to right, #007bff, #0056b3); color: #fff;'>
    <div class='box-header with-border' style='background: linear-gradient(to right, #007bff, #0056b3); color: #fff;'>
        <h3 class='box-title'><b>Follow us Here</b></h3>
    </div>
    <div class='box-body'>
        <a class="btn btn-social-icon btn-facebook" style="background-color: #3b5998;"><i class="fa fa-facebook" style="color: #fff;"></i></a>
        <a class="btn btn-social-icon btn-twitter" style="background-color: #1da1f2;"><i class="fa fa-twitter" style="color: #fff;"></i></a>
        <a class="btn btn-social-icon btn-instagram" style="background-color: #c32aa3;"><i class="fa fa-instagram" style="color: #fff;"></i></a>
        <a class="btn btn-social-icon btn-linkedin" style="background-color: #0077b5;"><i class="fa fa-linkedin" style="color: #fff;"></i></a>
    </div>
</div>

</div>
