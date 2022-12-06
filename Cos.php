<?php
    require_once "ShoppingCart.php";
    session_start();

    // Dacă utilizatorul nu este conectat redirecționează la pagina de autentificare ...
    if (!isset($_SESSION['loggedin'])) {
                                        header('Location: index.html');
                                        exit;
                                    }

    // pt membrii inregistrati
    $member_id=$_SESSION['id'];
    $shoppingCart = new ShoppingCart();

    if (! empty($_GET["action"])) 
    {
        switch ($_GET["action"]) {
                                    case "add":
                                    if (! empty($_POST["cantitate"])) 
                                    {
                                        $productResult = $shoppingCart->getProductByCode($_GET["id"]);
                                        $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);
        
                                        if (! empty($cartResult)) 
                                        {
                                            // Modificare cantitate in cos
                                            $newQuantity = $cartResult[0]["cantitate"] + $_POST["cantitate"];
                                            $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                                        } 
                                        
                                        else 
                                        {
                                            // Adaugare in tabelul cos
                                            $shoppingCart->addToCart($productResult[0]["id"], $_POST["cantitate"], $member_id);
                                        }
                                    }
                                         break;
                                    case "remove":
                                        // Sterg o sg inregistrare
                                        $shoppingCart->deleteCartItem($_GET["id"]);
                                        break;
                                    case "empty":
                                        // Sterg cosul
                                        $shoppingCart->emptyCart($member_id);
                                        break;
                                }
    }
?>
           
<HTML>
    
    <HEAD>
        <TITLE>creare cos permament in PHP</TITLE>
        <link href="style.css" type="text/css" rel="stylesheet" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
             /* Header/Logo Title */
             .header {
                padding: 50px;
                text-align: center;
                background: #1abc9c;
                color: white;
                font-size: 30px;
                }
                #btnEmpty {
                    position: fixed;
                    bottom: 110;
                    right: 580;
                }
                .btn {
                        border: 2px solid black;
                        border-radius: 5px;
                        background-color: white;
                        color: black;
                        padding: 14px 28px;
                        font-size: 16px;
                        cursor: pointer;
                    }
                /* Green */
                .listap {
                        border-color: #04AA6D;
                        color: green;
                    }
                .listap:hover {
                                background-color: #04AA6D;
                                color: white;
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

        </style>
    </HEAD>

    <BODY>
        <div id="shopping-cart">
            <div class="header">
                <h1>COS CUMPARATURI</h1>
            </div>
            
                <a id="btnEmpty" href="cos.php?action=empty"><img src="empty-cart.png" width="70px" alt="empty-cart" title="Empty Cart" /></a>
        </div>

            <?php
            $cartItem = $shoppingCart->getMemberCartItem($member_id);

            if (! empty($cartItem)) 
            {
                $item_total = 0;
            ?>
                <table cellpadding="10" cellspacing="1">
                    <tbody>
                        <tr>
                            <th style="text-align: center;"><strong>Nume</strong></th>
                            <th style="text-align: left;"><strong>Cod</strong></th>
                            <th style="text-align:center;"><strong>Cantitate</strong></th>
                            <th style="text-align:center;"><strong>Pret</strong></th>
                            <th style="text-align: center;"><strong>Descriere</strong></th>
                            <th style="text-align: center;"><strong>Stergere produs</strong></th>
                            
                        </tr>

                        <?php
                        foreach ($cartItem as $item) 
                        {
                        ?>
                            <tr>
                                <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["nume"]; ?></strong></td>
                                <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cod"]; ?></td>
                                <td style="text-align: center; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cantitate"]; ?></td>
                                <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo "Lei ".$item["pret"]; ?></td>
                                <td style="text-align: center; border-bottom: #F0F0F0 1px solid;"><?php echo $item["descriere"]; ?></td>
                                <td style="text-align: center; border-bottom: #F0F0F0 1px solid;"><a href="cos.php?action=remove&id=<?php echo $item["id"]; ?>" class="btnRemoveAction"><img src="icondelete.png" width="40px" alt="icon-delete" title="Remove Item" /></a></td>
                            </tr>

                            <?php
                            $item_total += ($item["pret"] * $item["cantitate"]);
                        }
                        ?>
                
                        <tr>
                            <td colspan="3" text-align=right><strong>Total:</strong></td>
                            <td text-align=right><?php echo "Lei ".$item_total; ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </div>

        <div><a href="magazin.php"><button class="btn listap">Inapoi la lista de produse</button></a></div>
        <div><a href="logout.php"><button class="btn logout">Abandonati sesiunea de cumparare</button></a></div>
    
        <?php //require_once "product-list.php"; ?>
    </BODY>
</HTML>
