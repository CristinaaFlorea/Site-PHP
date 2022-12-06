<?php
    require_once "ShoppingCart.php";?>

<HTML>
    <HEAD>
        <TITLE>Creare cos cumparaturi </TITLE>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .btn {
                        border: 2px solid black;
                        border-radius: 5px;
                        background-color: white;
                        color: black;
                        padding: 14px 28px;
                        font-size: 16px;
                        cursor: pointer;
                    }
                    /* Red */
                .logout {
                        border-color: #f44336;
                        color: red
                    }
                .logout:hover {
                            background: #f44336;
                            color: white;
                        }

             #logout {
                    position: fixed;
                    top: 10;
                    right: 20;
                }
            
            /* Header/Logo Title */
            .header {
                padding: 50px;
                text-align: center;
                background: #1abc9c;
                color: white;
                font-size: 30px;
                }


            .card {
                box-shadow: 0 10px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 500px;
                margin: auto;
                text-align: center;
                font-family: arial;
            }

            .price {
                    color: grey;
                    font-size: 22px;
                }

            .card button {
                    border: none;
                    outline: 0;
                    padding: 12px;
                    color: white;
                    background-color: #000;
                    text-align: center;
                    cursor: pointer;
                    width: 100%;
                    font-size: 18px;
                }

            .card button:hover {
                        opacity: 0.7;
                    }
        </style>
    </HEAD>
        
    <BODY>
        <div id="product-grid">
            <div class="header">
                <h1>PRODUSE</h1>
            </div>
            
        <?php
            $shoppingCart = new ShoppingCart();
            $query = "SELECT * FROM tabelproduse";
            $product_array = $shoppingCart->getAllProduct($query);
                
                if (! empty($product_array)) {
                                                foreach ($product_array as $key => $value) 
                                                {
        ?>
                                                <div class="card">
                                                    <div class="product-item">
                                                        <form method="post" action="Cos.php?action=add&id=<?php
                                                            echo $product_array[$key]["id"]; ?>">
                                                            
                                                            <div class="product-images">
                                                                <img src="<?php echo $product_array[$key]["img"]; ?>"width="100px">
                                                            </div>
                                                        
                                                            <div>
                                                                <strong><h1><?php echo $product_array[$key]["nume"];?></h1></strong>
                                                            </div>

                                                            <div>
                                                                <strong>cod produs:<?php echo $product_array[$key]["cod"];?></strong>
                                                            </div>

                                                            <div>
                                                                <strong><?php echo $product_array[$key]["descriere"];?></strong>
                                                            </div>

                                                                
                                                            <div class="product-price"><?php echo
                                                                "Lei ".$product_array[$key]["pret"]; ?></div>
                                                            
                                                                <div>
                                                                    <input type="text" name="cantitate" value="1" size="2" />
                                                                    <button type="submit" value="Add to cart" class="btnAddAction">ADD TO CART</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div> 
                                                    <?php
                                                }
                                            }
                                                    ?>
            </div>
            <div><a id="logout" href="logout.php"><button class="btn logout">Logout</button></a></div>
    </BODY>
</HTML>
