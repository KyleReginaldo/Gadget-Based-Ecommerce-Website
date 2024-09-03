<?php include 'includes/header.php'; ?>
<?php
include 'includes/session.php';
$conn = $pdo->open();
$address = '';
try{
    $stmt = $conn->prepare("SELECT * FROM address WHERE id=:id");
    $stmt->execute(['id'=>$_GET['id']]);
    $address = $stmt->fetch();
}
catch(PDOException $e){
}

?>
<style>
.address-container{
    padding: 4rem 5%;
    background-color: white;
    border-radius: 8px;
    max-width: 660px;
    margin: auto;
}
.address-footer{
    margin-top: 2rem;
    display: flex;
    justify-content: start;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="ph-address-selector.js"></script>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
    <?php include 'includes/navbar.php'; ?> 
        <div class="content-wrapper" style="padding-top: 8rem; height: 100%;">
            <div class="address-container">
            <div class="callout" id="callout" style="display:none;">
                <span class="message">Address Updated</span>
                <a href="user_address.php">Go back</a>
            </div>
            <form class="edit-new-address" id="edit-new-address" method="POST">
            <label class="form-label">Address Type</label><br>
                    <div class="address-type" style="display: flex; justify-content: start; align-items: center;">
                        <div style="margin-right: 1rem;">
                            <input type="radio" name="address_type" value="Home" id="home" <?php echo ($address['type'] == 'Home') ? 'checked' : ''; ?>>
                            <label for="home" style="font-weight: 400;">Home</label>
                        </div>
                        <div style="margin-right: 1rem;">
                            <input type="radio" name="address_type" value="Office" id="office" <?php echo ($address['type'] == 'Office') ? 'checked' : ''; ?>>
                            <label for="office" style="font-weight: 400;">Office</label>
                        </div>
                        <div style="margin-right: 1rem;">
                            <input type="radio" name="address_type" value="Other" id="other" <?php echo ($address['type'] == 'Other') ? 'checked' : ''; ?>>
                            <label for="other" style="font-weight: 400;">Other</label>
                        </div>
                    </div>
                <br>
                <label class="form-label">Region</label>
                    <select name="region" class="form-control form-control-md" id="region">
                        <option value="<?php echo $address['region']; ?>" selected><?php echo $address['region']; ?></option>
                    </select>
                    <input type="hidden" class="addredd-form form-control form-control-md" name="region_text" id="region-text" value="<?php echo $address['region']; ?>">
                    <br>
                    <label class="form-label">Province</label>
                    <select name="province" class="form-control form-control-md" id="province">
                        <option value="<?php echo $address['province']; ?>" selected><?php echo $address['province']; ?></option>
                    </select>
                    <input type="hidden" class="addredd-form form-control form-control-md" name="province_text" id="province-text" value="<?php echo $address['province']; ?>">
                    <br>
                    <label class="form-label">City / Municipality</label>
                    <select name="city" class="form-control form-control-md" id="city">
                        <option value="<?php echo $address['city']; ?>" selected><?php echo $address['city']; ?></option>
                    </select>
                    <input type="hidden" class="addredd-form form-control form-control-md" name="city_text" id="city-text" value="<?php echo $address['city']; ?>">
                    <br>
                    <label class="form-label">Barangay</label>
                    <select name="barangay" class="form-control form-control-md" id="barangay">
                        <option value="<?php echo $address['baranggay']; ?>" selected><?php echo $address['baranggay']; ?></option>
                    </select>
                    <input type="hidden" class="addredd-form form-control form-control-md" name="barangay_text" id="barangay-text" value="<?php echo $address['baranggay']; ?>">
                    <br>
                    <label for="street-text" class="form-label">Street</label>
                    <input type="text" class="addredd-form form-control form-control-md" name="street_text" id="street-text" value="<?php echo $address['street']; ?>">
                    <div class="address-footer">
                    <input type="text" name="address_id" hidden value="<?php echo $_GET['id']?>">
                    <button type="submit" class="btn btn-info btn-flat" name="edit">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php include 'includes/scripts.php';?>
<script>
$(function(){
    $('#edit-new-address').submit(function(e){
    e.preventDefault();
    var address = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: 'update_address2.php',
        data: address,
        dataType: 'json',
        success: function(response){
            $('.message').html(response.message);
            if(!response.error){
                $('#callout').show();
                $('#callout').removeClass('callout-danger').addClass('callout-success');
            }
        }
    });
});
    });
</script>