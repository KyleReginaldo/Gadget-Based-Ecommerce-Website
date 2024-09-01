<?php
session_start();

if (isset($_POST['product_id'])) {
    $_SESSION['product_id'] = $_POST['product_id'];
    $_SESSION['order_id'] = $_POST['order_id'];
} else {
    echo 'No product ID provided.';
}
?>