<?php
    include 'connection.php';

    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $user_ip = $_SERVER['REMOTE_ADDR'];

        try{

            $existsProduct = 0;
            
            if($checkProduct = $conn->query("SELECT * FROM `cart_item` WHERE `user_ip` = '$user_ip'")){
                if($checkProduct->rowCount() > 0){
                    while($row = $checkProduct->fetch(PDO::FETCH_ASSOC)){
                        $check_id = $row['product_id'];
                        if($check_id == $product_id){
                            $existsProduct = 1;
                        }
                    }
                }else{
                    $existsProduct = 0;
                }
            }

            if($existsProduct == 0){
                $insertItemToCart = $conn->prepare("INSERT INTO `cart_item`(`product_id`, `user_ip`) VALUES (:product_id, :user_ip)");
            
                $insertItemToCart->bindParam(':product_id', $product_id);
                $insertItemToCart->bindParam(':user_ip', $user_ip);
                $insertItemToCart->execute();
    
                $totalCartItemQuery = $conn->query("SELECT * FROM `cart_item` WHERE `user_ip` = '$user_ip'");
                $totalCartItem = $totalCartItemQuery->rowCount();
                echo $totalCartItem;
    
    
                if($cartData = $conn->query("SELECT product.product_id, product.product_name, product.product_img, 
                    product.product_des, cart_item.user_ip FROM product INNER JOIN cart_item ON product.product_id = cart_item.product_id
                ")){
                    if($cartData->rowCount() > 0){
                        while($row = $cartData->fetch(PDO::FETCH_ASSOC)){
                            $product_id = $row['product_id'];
                            $product_name = $row['product_name'];
                            $product_img = $row['product_img'];
                            $product_des = $row['product_des'];
                            $user_ip = $row['user_ip'];
    
                                echo "<div class='single_item pb-2' style='position:relative'>
                                        <img src='assets/img/$product_img' width='30%' height='65px' alt='' class='single_item_img float-left mr-2'>
                                        <span class='item_name text-light'>$product_name <br> <span class='des text-light'>$product_des</span></span>
                                        <span onclick='itemDelete($product_id)' class='close'>&times;</span>
                                    </div>
                                    <hr>";
                        }
                    }else{
                        echo "<div class='mb-3 text-light'>0 Item Found</div>";
                    }
                }
            }else{
                echo "Product Already Exists In The Cart";
            }
            


            
        }catch(EXCEPTION $e){
            $e->getMessage();
        }
    }
?>