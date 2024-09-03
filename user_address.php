
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

</style>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <div class="content-wrapper" style="margin-top: 5rem;">
            <br>
            <div class="container">
                <div class="address-header">
                    <h4>Address</h4>
                    <button type="button" class="btn btn-success btn-flat btn-sm">
                        <a href="#add-address" data-toggle="modal"><i class="fa fa-plus"></i> Add New</a>
                    </button>
                </div>
                <div class="address-error-callout" id="address-error-callout" style="display:none;">
						<span class="message" style="color: red; margin: 0; padding: 0;"></span>
					</div>
                <div div class="address-view" id="address-view">
            </div>
        </div>
        </div>
    </div>
<!-- update address -->
    <?php include 'includes/address_modal.php'; ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="ph-address-selector.js"></script>
<div class="modal fade" id="edit-address">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Update Address</b></h4>
              <div class="update-error-callout" id="update-error-callout" style="display:none;">
						<span class="message" style="color: red; margin: 0; padding: 0;"></span>
					</div>
                <div div class="address-view" id="address-view">
            </div>
            <div class="modal-body">
            <form class="edit-new-address" id="edit-new-address" method="POST" action="" enctype="multipart/form-data">
              <label class="form-label">Address Type <span class="required">*</span></label><br>
              <div class="address-type" style="display: flex; justify-content: start; align-items: center;">
                  <div style="margin-right: 1rem;">
                      <input type="radio" name="address_type" value="Home" id="home">
                      <label for="home" style="font-weight: 400;">Home</label>
                  </div>
                  <div style="margin-right: 1rem;">
                      <input type="radio" name="address_type" value="Office" id="office">
                      <label for="office" style="font-weight: 400;">Office</label>
                  </div>
                  <div style="margin-right: 1rem;">
                      <input type="radio" name="address_type" value="Other" id="other">
                      <label for="other" style="font-weight: 400;">Other</label>
                  </div>
              </div>
              <br>
              <label class="form-label">Region <span class="required">*</span></label>
              <select name="region" class="form-control form-control-md" id="region"></select>
              <input type="hidden" class="addredd-form form-control form-control-md" name="region_text" id="region-text" required>
              <br>
              <label class="form-label">Province <span class="required">*</span></label>
              <select name="province" class="form-control form-control-md" id="province"></select>
              <input type="hidden" class="addredd-form form-control form-control-md" name="province_text" id="province-text" required>
              <br>
              <label class="form-label">City / Municipality <span class="required">*</span></label>
              <select name="city" class="form-control form-control-md" id="city"></select>
              <input type="hidden" class="addredd-form form-control form-control-md" name="city_text" id="city-text" required>
              <br>
              <label class="form-label">Barangay <span class="required">*</span></label>
              <select name="barangay" class="form-control form-control-md" id="barangay"></select>
              <input type="hidden" class="addredd-form form-control form-control-md" name="barangay_text" id="barangay-text" required>
              <br>
              <label for="street-text" class="form-label">Street <span class="required">*</span></label>
              <input type="text" class="addredd-form form-control form-control-md" name="street_text" id="street-text" required>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                      <i class="fa fa-close"></i> Close
                  </button>
                  <button type="submit" class="btn btn-info btn-flat" name="edit">Update
                  </button>
              </div>
          </form>
              </div>
        </div>
    </div>
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
                    $('#edit-address').modal('hide');
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
                    $('#callout').show();
                    $('#callout').removeClass('callout-danger').addClass('callout-success');
                }
                if(!response.error){
                    // $('#add-address').modal('hide');
                }
            }
        });
    });
    $('#edit-new-address').submit(function(e){
        e.preventDefault();
        var address = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'update_address2.php',
            data: address,
            dataType: 'json',
            success: function(response){
                getAddress();
                $('.message').html(response.message);
                if(response.error){
                    $('#update-error-callout').show();
                    $('#update-error-callout').removeClass('callout-danger').addClass('callout-success');
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


