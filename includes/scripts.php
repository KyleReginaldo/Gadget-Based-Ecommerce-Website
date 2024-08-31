<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- CK Editor -->
<script src="bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Datatable
    $('#example1').DataTable()
    //CK Editor
    CKEDITOR.replace('editor1')
  });
</script>
<!--Magnify -->
<script src="magnify/magnify.min.js"></script>
<script>
$(function(){
	$('.zoom').magnify();
});
</script>
<!-- Custom Scripts -->
<script>
$(function(){
  $('#navbar-search-input').focus(function(){
    $('#searchBtn').show();
  });

  $('#navbar-search-input').focusout(function(){
    $('#searchBtn').hide();
  });

  getCart();
  getOrders();

  $('#productForm').submit(function(e){
  	e.preventDefault();
  	var product = $(this).serialize();
  	$.ajax({
  		type: 'POST',
  		url: 'cart_add.php',
  		data: product,
  		dataType: 'json',
  		success: function(response){
  			$('#callout').show();
  			$('.message').html(response.message);
  			if(response.error){
  				$('#callout').removeClass('callout-success').addClass('callout-danger');
  			}
  			else{
				$('#callout').removeClass('callout-danger').addClass('callout-success');
				getCart();
  			}
  		}
  	});
  });
  $('#checkoutForm').submit(function(e){
  	e.preventDefault();
  	var product = $(this).serialize();
  	$.ajax({
  		type: 'POST',
  		url: 'add_order.php',
  		data: product,
  		dataType: 'json',
  		success: function(response){
			$('.message').html(response.message);
			$('.error').html(response.error_message);
  			if(response.error){
				$('#error-callout').show();
				$('#error-callout').removeClass('callout-success').addClass('callout-danger');

  			}
  			else{
				$('#callout').show();
				$('#callout').removeClass('callout-danger').addClass('callout-success');
				getOrders();
  			}
  		}
  	});
  });
  $('#cancelForm').submit(function(e){
  	e.preventDefault();
	var id = $(this).data('id');
  	$.ajax({
  		type: 'POST',
  		url: 'cancel_order.php',
  		data: {
			id: id
		},
  		dataType: 'json',
  		success: function(response){
  			$('#callout').show();
  			$('.message').html(response.message);
  			if(response.error){
  				$('#callout').removeClass('callout-success').addClass('callout-danger');
  			}
  			else{
				$('#callout').removeClass('callout-danger').addClass('callout-success');
				getOrders();
  			}
  		}
  	});
  });
  

  $(document).on('click', '.close', function(){
  	$('#callout').hide();
  });

});

function getCart(){
	$.ajax({
		type: 'POST',
		url: 'cart_fetch.php',
		dataType: 'json',
		success: function(response){
			$('#cart_menu').html(response.list);
			$('.cart_count').html(response.count);
		}
	});
}
function getOrders(){
	$.ajax({
		type: 'POST',
		url: 'order_fetch.php',
		dataType: 'json',
		success: function(response){
			$('#order_menu').html(response.list);
			$('.order_count').html(response.count);
		}
	});
}
</script>