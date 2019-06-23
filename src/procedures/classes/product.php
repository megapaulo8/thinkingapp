<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'./thinkingapp/src/procedures/classes/dbconnection.php';
    class Product {
        private $prod_type, $entry_type, $name, $description, $amount, $expiration_date, $value;
        
        public function getProductType(){
            return $this->prod_type;
        }

        public function setProductType($prod_type){
            $this->prod_type = $prod_type;
        }

        public function getEntryType(){
            return $this->entry_type;
        }

        public function setEntryType($entry_type){
            $this->entry_type = $entry_type;
        }

        public function getProductName(){
            return $this->name;
        }

        public function setProductName($name){
            $this->name = $name;
        }

        public function getProductDescription(){
            return $this->description;
        }

        public function setProductDescription($description){
            $this->description = $description;
        }

        public function getProductAmount(){
            return $this->amount;
        }

        public function setProductAmount($amount){
            $this->amount = $amount;
        }

        public function getExpirationDate(){
            return $this->expiration_date;
        }

        public function setExpirationDate($expiration_date){
            $this->expiration_date = $expiration_date;
        }

        public function getProductValue(){
            return $this->value;
        }

        public function setProductValue($value){
            $this->value = $value;
        }

        // Inserir novo produto na tabela "PRODUCTS"
        public function insertNewProduct($prod_type,$entry_type,$name,$description,$amount,$expiration_date,$value,$id){
            $expiration_date = str_replace("/","-",$expiration_date);
            $expiration_date = date("Y-m-d",strtotime($expiration_date));
            $this->setProductType($prod_type);
            $this->setEntryType($entry_type);
            $this->setProductName($name);
            $this->setProductDescription($description);
            $this->setProductAmount($amount);
            $this->setExpirationDate($expiration_date);
            $this->setProductValue($value);
            $connection = new Connection();
            $new_product = mysqli_query($connection->connection(),"INSERT INTO products (prod_type,entry_type,name,description,amount,expiration_date,value,id_user) VALUES ('{$this->getProductType()}','{$this->getEntryType()}','{$this->getProductName()}','{$this->getProductDescription()}','{$this->getProductAmount()}','{$this->getExpirationDate()}','{$this->getProductValue()}','{$id}')");
            $connection->disconnect($connection->connection());
            return $new_product;
        }

        public function getProductsByType($prod_type){
            $connection = new Connection();
            $get_products = mysqli_query($connection->connection(),"SELECT * FROM products WHERE prod_type = '{$prod_type}'");
            $connection->disconnect($connection->connection());
            return mysqli_fetch_assoc($get_products);
        }

        public function getProductByID($id){
            $connection = new Connection();
            $get_product = mysqli_query($connection->connection(),"SELECT * FROM products WHERE id = '{$id}'");
            $connection->disconnect($connection->connection());
            return mysqli_fetch_assoc($get_product);
        }

        public function deleteProductByID($id){
            $connection = new Connection();
            $delete_product = mysqli_query($connection->connection(),"DELETE FROM products WHERE id = '{$id}' && amount = '0'");
            $connection->disconnect($connection->connection());
            return $delete_product;
        }

        public function updateAmountProductByID($id,$amount){
            $connection = new Connection();
            $update_product = mysqli_query($connection->connection(),"UPDATE products SET amount = '{$amount}' WHERE id = '{$id}'");
            $final_check = $this->getProductByID($id);
            if ($final_check['amount'] == 0){
                $connection->disconnect($connection->connection());
                return $this->deleteProductByID($id);
            }
            else {
                $connection->disconnect($connection->connection());
                return $update_product;
            }
        }

        public function getProductsTotal($prod_type){
            $prod_tot = 0;
            $connection = new Connection();
            $get_products = mysqli_query($connection->connection(),"SELECT * FROM products WHERE prod_type = '{$prod_type}'");
            $connection->disconnect($connection->connection());
            while ($total = mysqli_fetch_assoc($get_products)){
                $prod_tot += $total['amount'];
            }
            return $prod_tot;
        }
    }
?>