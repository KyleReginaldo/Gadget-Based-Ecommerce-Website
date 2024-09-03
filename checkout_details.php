<?php	
    $total = 0;
    $conn = $pdo->open();
    $output = '';
    try{
        $inc = 3;	
        $stmt = $conn->prepare("SELECT * FROM cart INNER JOIN products ON product_id = products.id WHERE user_id = :userid AND selected=true");
        $stmt->execute(['userid' => $_SESSION['user']]);
        foreach ($stmt as $row) {
            $_SESSION['productId'] = $row['id'];
            $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
            $inc = ($inc == 3) ? 1 : $inc + 1;
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
            if($inc == 1) echo "<div class=''>";
            $output .= "<div class='item-display'>
                        <img src='".$image."' alt='' width='64px' height='64px'>
                        <div>
                            <p class='name'>".$row['name']."</p>
                            <p class='name'>".$row['quantity']."x</p>
                            <p class='price'>&#8369;".number_format($subtotal,2)."</p>
                        </div>
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
	echo json_encode($output);
?>