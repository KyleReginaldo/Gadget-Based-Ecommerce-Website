<?php include 'includes/scripts.php'; ?>
<style>
.address-form{
  border-radius: 8px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="ph-address-selector.js"></script>
<div class="modal fade" id="edit-address">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Update Address</b></h4>
              <div class="callout" id="callout" style="display:none;">
                <span class="message"></span>
	        		</div>
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
</div>