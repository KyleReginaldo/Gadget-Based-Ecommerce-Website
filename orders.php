<?php include 'includes/session.php'; ?>
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
</style>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<script>
    (function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
</script>
<div class="wrapper">
<?php include 'includes/navbar.php'; ?>
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
       <?php
        $conn = $pdo->open();
        if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['status']){
            try{	 		
                $stmt = $conn->prepare("SELECT  *, products.name AS prodName, category.name AS catName, orders.id AS id FROM orders INNER JOIN products ON orders.product_id=products.id INNER JOIN category ON products.category_id=category.id WHERE status = :status");
                $stmt->execute(['status'=>$_GET['status']]);
            }
            catch(PDOException $e){
                echo "There is some problem in connection: " . $e->getMessage();
            }
        }
        if($stmt){
            foreach($stmt as $order){
                $image = (!empty($order['photo'])) ? 'images/'.$order['photo'] : 'images/noimage.jpg';
            ?>
            <div class='order-card'>
                    <div class='child-order-card'>
                        <a href=<?php echo $image?>><img src=<?php echo $image?> alt='' width='64px' height='64px'></a>
                        <div class='order-content'>
                            <div class="titles">
                                <p class='title'><?php echo $order['prodName']?></p>
                            </div>
                            <medium class='category'>Category: <?php echo $order['catName']?></medium>
                            <p>x<b class='quantity'><?php echo $order['quantity']?></b></p>
                        </div>
                    </div>
                    <div class="trailing">
                        <p><b>&#x20B1;<?php echo $order['total']?></b></p>
                        <?php
                        if($order['status'] == 'Pending'){
                            echo "<button type='button' class='cancel' data-id='".$order['id']."'>Cancel</button>";
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
        }
       ?>
    </div>
</div>
<?php include 'includes/footer.php'?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
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
});
</script>
</body>