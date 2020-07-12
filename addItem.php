<?php
    class addItem{
        public static function item($conn){
            $conn = $conn;
            if($itemQuery = $conn->query("SELECT * FROM `product`")){
                if($itemQuery->rowCount() < 1){
                    $insertItem = $conn->prepare("INSERT INTO `product`(`product_name`, `product_img`, `product_des`) VALUES(:product_name, :product_img, :product_des)");
                    
                    $insertItem->bindParam(":product_name", $product_name);
                    $insertItem->bindParam(":product_img", $product_img);
                    $insertItem->bindParam(":product_des", $product_des);

                    $product_name = "HARD DISK DRIVE";
                    $product_img = "recent_item.jpg";
                    $product_des = "Mady By: WD         Size: 2.0TB";
                    $insertItem->execute();

                    $product_name = "Solid State DRIVE";
                    $product_img = "recent_item(2).jpg";
                    $product_des = "Size: 1.0TB";
                    $insertItem->execute();

                }
            }
        }
    }
?>