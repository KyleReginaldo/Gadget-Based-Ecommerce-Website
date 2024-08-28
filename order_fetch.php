<?php
	include 'includes/session.php';
	$conn = $pdo->open();
	$output = array('list'=>'','count'=>0);
	try{
        $stmt = $conn->prepare("SELECT *,products.name AS prodname , category.name AS catname FROM orders LEFT JOIN products ON orders.product_id=products.id LEFT JOIN category ON products.category_id=category.id WHERE user_id=:user_id");
        $stmt->execute(['user_id'=>$_SESSION['user']]);
        foreach($stmt as $row){
            $output['count']++;
            $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
            $productname = (strlen($row['prodname']) > 30) ? substr_replace($row['prodname'], '...', 27) : $row['prodname'];
            $output['list'] .= "
                <li>
                    <a href='product.php?product=".$row['slug']."'>
                        <div class='pull-left'>
                            <img src='".$image."' class='fluid' alt='User Image'>
                        </div>
                        <h4>
                            <b>".$row['catname']."</b>
                            <small>&times; ".$row['quantity']."</small>
                        </h4>
                        <p>".$productname."</p>
                    </a>
                </li>
            ";
        }
    }
    catch(PDOException $e){
        $output['message'] = $e->getMessage();
    }
	$pdo->close();
	echo json_encode($output);

?>

