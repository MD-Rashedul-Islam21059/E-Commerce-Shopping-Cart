<?php

class myDb{
    public static function db($connection){
        $connection = $connection;
        $sql = $connection->query("CREATE DATABASE cart");
    }

    public static function table(){

        include 'connection.php';

        try{
            $table1 = 'product';
            $table2 = 'cart_item';
            // create table one
            if($tb1 = $conn->query("SHOW TABLES LIKE '".$table1."'")){
                if(!$tb1->rowCount() == 1){
                    $createTable1 = $conn->query("CREATE TABLE product(
                        product_id INT NOT NULL AUTO_INCREMENT,
                        product_name varchar(255),
                        product_img varchar(255),
                        product_des varchar(255),
                        PRIMARY KEY(product_id)
                    )");
                }
            }

            //create table two
            if($tb2 = $conn->query("SHOW TABLES LIKE '".$table2."'")){
                if(!$tb2->rowCount() == 1){
                    $createTable2 = $conn->query("CREATE TABLE cart_item(
                        cart_item_id INT NOT NULL AUTO_INCREMENT, 
                        product_id INT NOT NULL,
                        user_ip varchar(255) NOT NULL,
                        PRIMARY KEY (cart_item_id)
                    )");
                }
            }


    
        }catch(PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
}


?>