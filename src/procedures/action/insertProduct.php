<?php
    session_start();
    $id = $_SESSION['id'];
    $prod_type = $_REQUEST['prod_type'];
    $entry_type = $_REQUEST['entry_type'];
    $prod_name = $_REQUEST['prod_name'];
    $prod_desc = $_REQUEST['prod_desc'];
    $prod_amount = $_REQUEST['prod_amount'];
    $expiration_date = $_REQUEST['expiration_date'];
    $prod_value = $_REQUEST['prod_value'];
    require_once './../classes/product.php';
    $product = new Product();
    if($product->insertNewProduct($prod_type,$entry_type,$prod_name,$prod_desc,$prod_amount,$expiration_date,$prod_value,$id)){
        return $product;
    }
    else {
        return FALSE;
    }
?>