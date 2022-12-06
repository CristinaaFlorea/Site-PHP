<?php
    include("Conectare.php");
    if ($result = $mysqli->query("SELECT * FROM tabelproduse where nume LIKE 'B%' AND price>max")) { 
        if($result-> num_rows > 0){
            while($row = $result->fetch_object()){
                echo "$row->nume";
            }

        }
    
    }
?>
       