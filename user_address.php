
<?php include 'includes/session.php';?>
<?php include 'includes/header.php'; ?>
<style>
.content{
    margin: 0;
    padding: 0;
}
.address-container{
        background-color: #F5F5F5;
        margin: 0.5rem 0;
        padding: 0.8rem;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
.address-content p{
    font-size: 1.4rem;
    font-weight: 400;
}
.address-content h5{
    font-size: 2rem;
    font-weight: 500;
}
.selected-address{
    border: 2px solid blue;
    opacity: 0;
    animation: fadeIn 0.3s ease-out forwards;
    animation-delay: 0.2s;
    font-size: 1.4rem;
    font-weight: 600;
    color: blue;
}

.actions button{
    padding: 0.4rem 1.2rem;
    color: white;
    border: none;
}
.edit-address{
    background-color: #7695FF;
}
.delete-address{
    background-color: red;
}



.address-checkbox{
    margin: 0 0.5rem;
}

.address-header{
    display: flex;
    justify-content: space-between;
}
.btn-success a{
    color: white;
}
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.btn-success{
    background-color: blue;
    border-radius: 4px;
}
.btn-success:hover{
    background-color: darkblue;
}
</style>

<?php include 'includes/address_modal.php'; ?>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <div class="content-wrapper" style="padding-top: 5rem; height: 100%;">   
            <br>
            <div class="container">
                <div class="address-header">
                    <h4>Address</h4>
                    
                    <button type="button" class="btn btn-success btn-rounded btn-sm">
                        <a href="#add-address" data-toggle="modal"><i class="fa fa-plus"></i> Add New</a>
                    </button>
                        
                    
                </div>
                <div class="address-error-callout" id="address-error-callout" style="display:none;">
                    <span class="message" style="color: red; margin: 0; padding: 0;"></span>
                </div>
                <div class="address-view" id="address-view"></div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>
</body>
<?php include 'includes/scripts.php'; ?>

<script>
$(function(){
	getAddress();
	$(document).on('change', '.address-checkbox', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var isChecked = $(this).is(':checked') ? 1 : 0;
		$.ajax({
			type: 'POST',
			url: 'update_address.php',
			data: {
				id:id,
				selected: isChecked,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getAddress();
				}
			}
		});
	});
    $(document).on('click', '.delete-address', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'delete_address.php',
            data: { id: id },
            dataType: 'json',
            success: function(response){    

                $('.message').html(response.message);
                if(response.error){
                    $('#address-error-callout').show();
				    $('#address-error-callout').removeClass('callout-success').addClass('callout-danger');
                }else{
                    getAddress();
                }
                // if(response.error){
                //     $('.message').html(response.message);
                // }else{
                //     getAddress();
                // }
            }
        });
    }); 
    $('#add-new-address').submit(function(e){
        e.preventDefault();
        var address = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'add_address.php',
            data: address,
            dataType: 'json',
            success: function(response){
                getAddress();
                $('.message').html(response.message);
                if(response){
                    $('#scallout').show();
                    $('#scallout').removeClass('callout-danger').addClass('callout-success');
                }
            }
        });
    });
   
});
function getAddress(){
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "fetch_address.php",
            data: {},
            dataType: 'json',
            success: function(response) {
                $('#address-view').html(response);
            }
        });
    });
}
</script>


