<?php

    include 'connection.php';

    include_once 'addItem.php';

    addItem::item($conn);
     

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font.css">
    <link rel="stylesheet" href="assets/css/primary.css">
    <!-- <link rel="stylesheet" href="assets/css/secondary.css"> -->

    <style>
        
    </style>
</head>
<body>
    
    <section id="cart_wrapper">
        <header id="cart_header">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">MyCart</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <div class="cart-items-show">
                            <div class="cart-items">
                                <?php 
                                
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
                                
                                ?>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-outline-info">Check Out</a>
                        </div>
                        <li class="nav-item ">
                            <a class="nav-link cart-ico" href="">
                                <i class="fas fa-shopping-cart text-light" style="font-size:20px;"></i><span class="cartNumber">
                                    <?php include_once 'totalCartItem.php' ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="">LogIn/SignUp</a></li>
                    </ul>
                </div>
            </nav>

        </header>

        <div class="recent_item_wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 mt-3 mb-3">
                        <h2 class="recent_item_header">Recent Item</h2>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <?php
                        if($fData = $conn->query("SELECT * FROM `product`")){
                            if($fData->rowCount() > 0){
                                while($row = $fData->fetch(PDO::FETCH_ASSOC)){
                                    $product_id = $row['product_id'];
                                    $product_name = $row['product_name'];
                                    $product_img = $row['product_img'];
                                    $product_des = $row['product_des'];

                                    echo "<div class='col-md-3'>
                                    <div class='recent_item_single_section'>
                                        <img src='assets/img/$product_img' width='100%' alt='' class='recent_item_img'>
                                        <h2 class='item_name'>$product_name</h2>
                                        <div class='recent_item_info_top mt-2 mb-2'>
                                            <a href='' class='wishList'> <i class='fas fa-heart mr-2'></i>Add To Wish List</a>
                                            <a href='javascript:void(0)' onclick='addItemToCart($product_id)' class='cart float-right'><i class='fas fa-shopping-cart mr-2'></i>Add To Cart</a>
                                        </div>
                                        <p class='discription'>
                                            $product_des
                                        </p>
                                    </div>
                                </div>";

                                }
                            }
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </section>
    



     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="assets/script/jquery-3.5.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
     <script src="assets/script/bootstrap.min.js"></script>
     <script src="assets/script/primary.js"></script>
     <!-- <script src="assets/script/secondary.js"></script> -->

     <script>
        const cart_ico = document.querySelector(".cart-ico");
        const cart = document.querySelector(".cart-items-show");

        cart_ico.addEventListener('click', (e) => {

            e.preventDefault();

            if(cart.getAttribute('id')){
                cart.removeAttribute('id');
            }else{
                cart.setAttribute('id', 'show');
            }
            
            
        })

        window.onclick = function(event) {
            if (!event.target.matches('.cart-items-show') && !event.target.matches('.fa-shopping-cart') && 
                !event.target.matches('.single_item') && !event.target.matches('.cart-items') && 
                !event.target.matches('.close') && !event.target.matches('.cart')){
                cart.removeAttribute('id');
                console.log(event.target);
            }
        }

        function addItemToCart(product_id){
            var product_id = product_id;

            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var responseData = this.responseText;
                    if(responseData == 'Product Already Exists In The Cart'){
                        alert(responseData);
                    }else{
                        splitData(responseData);  
                    }
                }
            };
            xmlHttp.open("GET", "addItemToCart.php?product_id="+product_id, true);
            xmlHttp.send();
        }

        function itemDelete(product_id){
            var product_id = product_id;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var responseData = this.responseText;
                    splitData(responseData);
                }
            };
            xmlhttp.open("GET", "deleteCartItem.php?deleteId="+product_id, true);
            xmlhttp.send();
        }

        function splitData(responseData){
            var myData = responseData;
            var totalCartItemNumber = myData.substr(0,1);
            document.querySelector(".cartNumber").textContent = totalCartItemNumber;

            var cartItemDetails = myData.substr(1);
            document.querySelector(".cart-items").innerHTML = cartItemDetails;
        }

        
     </script>
</body>
</html>