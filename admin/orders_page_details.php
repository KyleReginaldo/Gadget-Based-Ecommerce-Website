<?php
include 'includes/session.php';
$conn = $pdo->open();
$output = '';

try{
    $stmt = $conn->prepare("SELECT  *, users.firstname AS firstname, users.lastname AS lastname, products.name AS prodName, category.name AS catName, orders.id AS orderId, orders.status AS orderStatus FROM orders INNER JOIN users ON orders.user_id=users.id INNER JOIN products ON orders.product_id=products.id INNER JOIN category ON products.category_id=category.id ORDER BY created_at DESC");
    $stmt->execute();
    foreach($stmt as $row){
        $statusColor = 'red';
        $hideToShipping = $row['orderStatus'] != 'Pending'? 'disabled': '';
        $hideToComplete = $row['orderStatus'] == 'Shipping'? '': 'disabled';
        $total = $row['total'];
        switch ($row['orderStatus']) {
            case 'Pending':
                $statusColor = 'grey';
                break;
            case 'Shipping':
                $statusColor = 'skyblue';
                break;
            case 'Completed':
                $statusColor = 'green';
                break;
            case 'Cancelled':
                $statusColor = 'red';
                break;
        }
        $output .= "
            <tr>
            <td class='hidden'></td>
            <td>".date('M d, Y', strtotime($row['created_at']))."</td>
            <td>".$row['firstname'].' '.$row['lastname']."</td>
            <td style='color: ".$statusColor."; font-weight: bold;'>".$row['orderStatus']."</td>
            <td>#".$row['order_number']."</td>
            <td>&#8369; ".number_format($total, 2)."</td>
            <td><button type='button' class='btn btn-info btn-sm btn-flat transact' data-id='".$row['orderId']."'><i class='fa fa-search'></i> View</button></td>
            <td>
            <button type='button' class='btn btn-info btn-sm btn-flat to-ship' data-id='".$row['orderId']."'  $hideToShipping><i class='fa fa-car'></i> To Ship</button>
            <button type='button' class='btn btn-success btn-sm btn-flat to-complete' data-id='".$row['orderId']."' $hideToComplete><i class='fa fa-check'></i> Complete</button>
            </td>
            </tr>
        ";
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}

$pdo->close();
echo json_encode($output);
?>