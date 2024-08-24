<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Check out</title>
    <style>
        body{
            background-color: lightblue;
            margin: 0;
            padding: 0;
        }
        .container{
            margin: 24px;
            background-color: white;
        }
        .item-display{
            display: flex;
            align-items: center;
            align-content:center;
            justify-content: start;
            margin: 24px 0;
        }
        .item-display p{
            margin-right: 16px;
            margin-left: 16px;
            margin-bottom: 0;
        }
        .name{
            font-size: 1.1rem;
        }
        .price{
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                
            <?php
		       			$conn = $pdo->open();
		       			try{
		       			 	$inc = 3;	
                            $stmt = $conn->prepare("SELECT * FROM cart INNERT JOIN products ON product_id = products.id WHERE user_id = :userid");
                            $stmt->execute(['userid' => $_SESSION['user']]);
                            // $subtotal = $product['price']*$row['quantity'];
				            // $total += $subtotal;
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class=''>";
	       						echo "<div>
                                        <div class='item-display'>
                                    <img src='".$image."' alt='' width='64px' height='64px'>
                                    <div>
                                    <p class='name'>".$row['name']."</p>
                                    <p class='price'>".$row['price']."</p>
                                    </div>
                                    </div>
                                    <td class='input-group'>
                                        <span class='input-group-btn'>
                                            <button type='button' id='minus' class='btn btn-default btn-flat minus' data-id='".$row['id']."'><i class='fa fa-minus'></i></button>
                                        </span>
                                        <input type='text' class='form-control' value='".$row['quantity']."' id='qty_".$row['id']."'>
                                        <span class='input-group-btn'>
                                            <button type='button' id='add' class='btn btn-default btn-flat add' data-id='".$row['id']."'><i class='fa fa-plus'></i></button>
                                        </span>
                                    </td>
                                        </div>";
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
            <div class="col-md-5">test</div>
        </div>
    </div>
</body>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
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
		var qty = $('#qty_'+id).val();
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
	});

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
</script>
</html>