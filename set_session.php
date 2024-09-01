<?php
session_start();

if (isset($_POST['product_id'])) {
    $_SESSION['product_id'] = $_POST['product_id'];
    echo 'Product ID saved in session: ' . $_SESSION['product_id'];
} else {
    echo 'No product ID provided.';
}
?>