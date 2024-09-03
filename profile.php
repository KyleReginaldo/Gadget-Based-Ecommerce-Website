<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['user'])){
		header('location: index.php');
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper" style="margin-top: 4rem">
	    <div class="container">
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='callout callout-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}

	        			if(isset($_SESSION['success'])){
	        				echo "
	        					<div class='callout callout-success'>
	        						".$_SESSION['success']."
	        					</div>
	        				";
	        				unset($_SESSION['success']);
	        			}
	        		?>
	        		<div class="box box-solid">
	        			<div class="box-body">
	        				<div class="col-sm-1" style="">
	        					<img src="<?php echo (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>" width="100rem" height="100rem" style="object-fit: cover; border-radius: 8px; border: 2px solid lightgreen; margin-bottom: 1rem;">
								<a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
	        				</div>
	        				<div class="col-sm-12">
	        					<div class="row">

	        						<div class="col-sm-12">
	        							<p style="color: grey; margin-top: 1rem; font-size: 1.5rem;">Full name:
										<span style="color: black;"><?php echo $user['firstname'].' '.$user['lastname']; ?></span>
										</p>
	        							<p style="color: grey; font-size: 1.5rem;">Email:
										<span style="color: black;"><?php echo $user['email']; ?></span>
										</p>
	        							<p style="color: grey; font-size: 1.5rem;">Contact No.:
										<span style="color: black;"><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/A'; ?></span>
										</p>
										<a href="user_address.php" class="btn btn-info btn-flat btn-sm"><i class="fa fa-search"></i> View Address</a>

	        							<?php
										if($user['addressId']){
											?>
										<p style="color: grey; font-size: 1.5rem;">Address: 
										<span style="color: black;"><?php echo $user['region'].", ".$user['province'].", ".$user['city'].", ".$user['baranggay'].", ".$user['street']?></span>
										</p>
										<?php
										}
										?>
	        							<p style="color: grey; font-size: 1.5rem;">Account created:
										<span style="color: black;"><?php echo date('M d, Y', strtotime($user['created_on'])); ?></span>
										</p>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		<div class="box box-solid">
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Transaction History</b></h4>
	        			</div>
	        			<div class="box-body">
	        				<table class="table table-bordered" id="example1">
	        					<thead>
	        						<th class="hidden"></th>
	        						<th>Date</th>
	        						<th>Transaction#</th>
	        						<th>Amount</th>
	        						<th>Full Details</th>
	        					</thead>
	        					<tbody>
	        					<?php
	        						$conn = $pdo->open();

	        						try{
	        							$stmt2 = $conn->prepare("SELECT *, orders.created_at AS ordersDate, orders.total AS total, orders.id AS orderId FROM orders INNER JOIN products ON orders.product_id=products.id WHERE orders.user_id=:user_id AND orders.status=:status ORDER BY created_at DESC");
	        								$stmt2->execute(['user_id'=>$_SESSION['user'],'status'=>'Completed']);
	        								foreach($stmt2 as $row){
												echo "
	        									<tr>
	        										<td class='hidden'></td>
	        										<td>".date('M d, Y', strtotime($row['ordersDate']))."</td>
	        										<td>".$row['order_number']."</td>
	        										<td>&#8369; ".number_format($row['total'], 2)."</td>
	        										<td><button type='button' class='btn btn-info btn-sm btn-flat transact' data-id='".$row['orderId']."'><i class='fa fa-search'></i> View</button></td>
	        									</tr>
	        								";
	        								}

	        						}
        							catch(PDOException $e){
										echo "There is some problem in connection: " . $e->getMessage();
									}

	        						$pdo->close();
	        					?>
	        					</tbody>
	        				</table>
	        			</div>
	        		</div>
	        	</div>
	        </div>
	      </section>
	    </div>
	  </div>
  	<?php include 'includes/profile_modal.php'; ?>
	<?php include 'includes/address_modal.php'; ?>
  	<?php include 'includes/footer.php'; ?>
	

</div>
<?php include 'includes/scripts.php'; ?>

<script>
$(function(){
	$(document).on('click', '.transact', function(e){
		e.preventDefault();
		$('#transaction').modal('show');
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'transaction.php',
			data: {id:id},
			dataType: 'json',
			success:function(response){
				$('#date').html(response.date);
				$('#transid').html(response.transaction);
				$('#detail').prepend(response.list);
				$('#total').html(response.total);
			}
		});
	});

		// $("#transaction").on("hidden.bs.modal", function () {
		//     $('.prepend_items').remove();
		// });
});
</script>
</body>
</html>