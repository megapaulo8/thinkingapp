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
    require_once $_SERVER['DOCUMENT_ROOT'].'./thinkingapp/src/procedures/classes/product.php';
    $product = new Product();
    var_dump ($product->insertNewProduct($prod_type,$entry_type,$prod_name,$prod_desc,$prod_amount,$expiration_date,$prod_value,$id));
?>