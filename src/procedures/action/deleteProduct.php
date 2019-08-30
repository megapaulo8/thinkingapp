<?php
    $amount = $_REQUEST['amount'];
    $id = $_REQUEST['id'];
    require_once './../classes/product.php';
    $product = new Product();
    $consult_product = $product->getProductByID($id);
    $new_amount = $consult_product['amount'] - $amount;
    $product->updateAmountProductByID($id,$new_amount,$amount);
    header("Location: ./../../pages/less_prod/");
?>