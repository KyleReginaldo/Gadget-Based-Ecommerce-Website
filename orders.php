<?php include 'includes/session.php';
?>
<style>
*{
    margin: 0;
    padding: 0;
}

.tab-row{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    background-color: blue;
    margin: 24px;
    padding: 8px 24px;
    color:white;
    align-items: center;
    border-radius: 4px;
}
.cat-choice{
    background-color: transparent;
    border: none;
}
.order-card{
    background-color: white;
    margin: 0 2.4rem;
    padding: 1.5rem 2.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 8px;
    margin-bottom: 1rem;
    opacity: 0; /* Initial state before animation */
    animation: fadeIn 0.3s ease-out forwards; /* Apply the animation */
    animation-delay: 0.2s; /* Optional: delay before the animation starts */
}
.child-order-card{
    display: flex;
}
.order-card a{
    margin-right: 1.5rem;
}
.order-content{
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.status{
    color: blue;
}
.title{
    margin: 0;
    font-size: 2rem;
}
.cancel{
    height:32px;
    padding: 0 16px;
    display: inline;
    border: none;
    background-color: red;
    color: white;
    border-radius: 4px;
    transition: border 0.2s ease-in-out;
}
.cancel:hover{
    border: 1px solid black;
}
.rate{
    height:32px;
    padding: 0 16px;
    display: inline;
    border: none;
    background-color: green;
    color: white;
    border-radius: 4px;
    transition: border 0.2s ease-in-out;
}
.rate:hover{
    border: 1px solid black;
}
.quantity{
    font-size: 1.5rem;
    color: black;
}
.trailing{
    display: flex;
    flex-direction: column;
    align-items: end;
}
.trailing p{
    margin-bottom: 1rem;
    font-size: 16px;
}
.cat-choice{
    transition: font-weight 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out, padding 0.2s ease-in-out, border-radius 0.2s ease-in-out;
}
.cancelled{
    border: 1px solid #E78895;
    color: grey;
    transition: color 0.3s ease-in-out;
}
.cancelled:hover{
    color: black;
}
.rated{
    border: 1px solid #279EFF;
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<script>
     document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        
        if (status) {
            const inputs = document.querySelectorAll('.cat-choice');
            inputs.forEach(input => {
                if (input.value === status) {
                    input.style.fontWeight = 'bold';
                    input.style.backgroundColor = 'white';
                    input.style.color = 'blue';
                    input.style.padding = '0 1rem';
                    input.style.borderRadius = '2px';
                }
            });
        }
    });
</script>
<div class="wrapper">
<?php include 'includes/navbar.php'; ?>
<?php include 'admin/includes/rate_modal.php';?>
<div class="content-wrapper"  style="margin-top: 4rem;">
    <div class="container">
        <form action="" method="get">
            <div class="tab-row">
                <input class="cat-choice" type="submit" name="status" value="Pending"/>
                <input class="cat-choice" type="submit" name="status" value="Shipping" />
                <input class="cat-choice" type="submit" name="status" value="Completed" />
                <input class="cat-choice" type="submit" name="status" value="Cancelled" />
            </div>
        </form>
       <div class="order_details" id="order_details" data-id="<?php echo $_GET['status']?>"></div>
    </div>
</div>
<?php include 'includes/footer.php'?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
    getDetails();
    $(document).on('click', '.cancel', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'cancel_order.php',
            data: { id: id },
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
    $(document).on("click",".rate",function(){
        var data = $(this).data('product');
        var orderID = $(this).data('order');
        $.ajax({
        url: 'set_session.php', // The PHP file to handle the request
        type: 'POST',
        data: { product_id: data, order_id: orderID },
        success: function(response) {
            // You can handle the response here if needed
            console.log('Product ID set in session: ' + response);
        }
    });
    });
});
function getDetails(){
    $(document).ready(function() {
        var status = "<?php echo $_GET['status'];?>";
        $.ajax({
            type: "GET",
            url: "order_details.php",
            data: {
                status: status,
            },
            dataType: 'json',
            success: function(response) {
                $('#order_details').html(response);
            }
        });
    });
}



</script>
</body>