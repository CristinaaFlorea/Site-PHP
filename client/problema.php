<?php
    include("Conectare.php");
    if ($result = $mysqli->query("SELECT nume, MAX(pret) FROM tabelproduse where nume LIKE 'B%'")) { 
        if($result-> num_rows > 0){
            while($row = $result->fetch_object()){
                echo  $row->nume ;
            }
        }
    }
    $mysqli->close();
?>  
