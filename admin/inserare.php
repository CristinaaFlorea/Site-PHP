<?php
    include("Conectare.php");
    $error='';

    if (isset($_POST['submit'])) {
            // preluam datele de pe formular
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $cod = htmlentities($_POST['cod'], ENT_QUOTES);
            $img = htmlentities($_POST['img'], ENT_QUOTES);
            $pret = htmlentities($_POST['pret'], ENT_QUOTES);
            $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);

            // verificam daca sunt completate
            if ($nume == '' || $cod == ''||$img==''||$pret==''||$descriere=='') {
                                            // daca sunt goale se afiseaza un mesaj
                                            $error = 'ERROR: Campuri goale!';
                                                                                } 
            else {
                    // insert
                    if ($stmt = $mysqli->prepare("INSERT into tabelproduse (nume, cod, img, pret, descriere) VALUES (?, ?, ?, ?, ?)"))
                    {           
                        $stmt->bind_param("sssds", $nume, $cod,$img,$pret,$descriere);
                        $stmt->execute();
                        $stmt->close();
                    }

                    // eroare le inserare
                    else {
                            echo "ERROR: Nu se poate executa insert.";
                         }
                    }
                                }           
                    // se inchide conexiune mysqli
                        $mysqli->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    <html>
        <head> 
            <title>
                <?php echo "Inserare inregistrare"; ?> 
            </title>

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
                .btn{
                    border: 2px solid black;
                    border-radius: 5px;
                    background-color: white;
                    color: black;
                    padding: 14px 28px;
                    font-size: 16px;
                    cursor: pointer;
                }
            
                /* Blue */
                .sub {
                        border-color: #2196F3;
                        color: dodgerblue
                    }
                .sub:hover {
                                background: #2196F3;
                                color: white;
                            }

                /* Orange */
                .vizt {
                            border-color: #ff9800;
                            color: orange;
                        }
                .vizt:hover {
                                    background: #ff9800;
                                    color: white;
                                }
            </style>
        </head> 

        <body>
            <h1>
                <?php echo "Inserare inregistrare"; ?>
            </h1>

            <?php if ($error != '') {
                                echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";
                                    } 
            ?>

            <form action="" method="post">
                <div>
                    <strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
                    <strong>Cod: </strong> <input type="text" name="cod" value=""/><br/>
                    <strong>Imagine: </strong> <input type="text" name="img" value=""/><br/>
                    <strong>Pret: </strong> <input type="text" name="pret" value=""/><br/>
                    <strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/><br/>

                    <input type="submit" name="submit" value="Submit" />
                    <a href="Vizualizare.php">Vizualizare tabela</a>
                </div>
            </form>
        </body>
    </html>