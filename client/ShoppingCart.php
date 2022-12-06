<?php
    require_once "DBController.php";

    class ShoppingCart extends DBController
    {   //returneaza toate produssele
        function getAllProduct()
            {
                $query = "SELECT * FROM tabelproduse";
                
                $productResult = $this->getDBResult($query);
                return $productResult;
            }
        //se trimit produsele din cosului clientului
        function getMemberCartItem($member_id)
            {
                $query = "SELECT tabelproduse.*, cos.id as cart_id, cos.cantitate FROM tabelproduse, cos WHERE tabelproduse.id = cos.produs_id AND cos.customer_id = ?";
            
                $params = array(
                array(
                        "param_type" => "i",
                        "param_value" => $member_id
                    )      
                );
   
                $cartResult = $this->getDBResult($query, $params);
                return $cartResult;
            }
        //returneaza prousele
        function getProductByCode($product_code)
            {
                $query = "SELECT * FROM tabelproduse WHERE id=?";
   
                $params = array(
                array(
                        "param_type" => "s",
                        "param_value" => $product_code
                    )
                );
    
                $productResult = $this->getDBResult($query, $params);
                return $productResult;
            }
        //returneaza produsele din cos dupa clint si produs
        function getCartItemByProduct($product_id, $member_id)
            {
                $query = "SELECT * FROM cos WHERE produs_id = ? AND customer_id = ?";

                 $params = array(
                array(
                        "param_type" => "i",
                        "param_value" => $product_id
                    ),
                array(
                        "param_type" => "i",
                        "param_value" => $member_id
                    )
                );

                $cartResult = $this->getDBResult($query, $params);
                return $cartResult;
            }
        //adaugare in cos
        function addToCart($product_id, $quantity, $member_id)
            {
                $query = "INSERT INTO cos (produs_id,cantitate,customer_id) VALUES (?, ?, ?)";

                $params = array(
                array(
                        "param_type" => "i",
                        "param_value" => $product_id
                    ),
                array(
                        "param_type" => "i",
                        "param_value" => $quantity
                    ),
                array(
                        "param_type" => "i",
                        "param_value" => $member_id
                    )
                );

                $this->updateDB($query, $params);
            }
        //se modifica cantitatea dupa id-ul cosului
        function updateCartQuantity($quantity, $cart_id)
            {
                $query = "UPDATE cos SET cantitate = ? WHERE id= ?";

                $params = array(
                array(
                        "param_type" => "i",
                        "param_value" => $quantity
                    ),
                array(
                        "param_type" => "i",
                        "param_value" => $cart_id
                    )
                );
 
                $this->updateDB($query, $params);
            }
        //se sterge cate un singur produs dupa id
        function deleteCartItem($cart_id)
            {
                $query = "DELETE FROM cos WHERE produs_id = ?";

                $params = array(
                array(
                        "param_type" => "i",
                        "param_value" => $cart_id
                    )
                );

                $this->updateDB($query, $params);
            }
        //se sterge tot cosul
        function emptyCart($member_id)
            {
                $query = "DELETE FROM cos WHERE customer_id = ?";

                $params = array(
                array(
                        "param_type" => "i",
                        "param_value" => $member_id
                    )
                );
   
                $this->updateDB($query, $params);
            }
   }