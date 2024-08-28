<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        .tab-row{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            background-color: blue;
            margin: 24px;
            padding: 8px 24px;
            color:white;
            align-items: center;
        }
        .cat-choice{
            background-color: transparent;
            border: none;
        }
    </style>
</head>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
<?php include 'includes/navbar.php'; ?>
<div class="content-wrapper">
    <div class="container text-center">
        <form action="" method="post">
            <div class="tab-row">
                <input class="cat-choice" type="submit" name="Choice" value="Pending" default/>
                <input class="cat-choice" type="submit" name="Choice" value="Shipping" />
                <input class="cat-choice" type="submit" name="Choice" value="Completed" />
                <input class="cat-choice" type="submit" name="Choice" value="Cancelled" />
            </div>
        </form>
       <?php
        if(!$_SERVER['REQUEST_METHOD'] == 'POST' && !$_POST['Choice']){
            $_POST['Choice'] = 'Pending';
            $_SERVER['REQUEST_METHOD'] = 'POST';
        }
        $conn = $pdo->open();
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['Choice']){
            try{	 		
                $stmt = $conn->prepare("SELECT *, products.name AS prodName FROM orders INNER JOIN products ON orders.product_id=products.id WHERE status = :status");
                $stmt->execute(['status'=>$_POST['Choice']]);
            }
            catch(PDOException $e){
                echo "There is some problem in connection: " . $e->getMessage();
            }
        }
        if($stmt){
            foreach($stmt as $order){
                echo "<p>".$order['prodName']."</p>";
            }  
        }else{
            echo "<p class='text-center'>There is no Order</p>";
        }
       ?>
    </div>
</div>
</div>
</body>
</html>