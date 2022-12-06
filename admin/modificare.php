<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();

    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
                                        header('Location: index.html');
                                        exit;
                                    }
?>


<?php // connectare baza de date
include("Conectare.php");

//Modificare datelor
// se preia id din pagina vizualizare
    $error='';
    if (!empty($_POST['id']))
        { if (isset($_POST['submit']))
            { // verificam daca id-ul din URL este unul valid
                if (is_numeric($_POST['id']))
                    { // preluam variabilele din URL/form
                        $id = $_POST['id'];
                        $nume = htmlentities($_POST['nume'], ENT_QUOTES);
                        $cod = htmlentities($_POST['cod'], ENT_QUOTES);
                        $img = htmlentities($_POST['img'], ENT_QUOTES);
                        $pret = htmlentities($_POST['pret'], ENT_QUOTES);
                        $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);

                        // verificam daca numele, prenumele, an si grupa nu sunt goale
                        if ($nume == '' || $cod == ''|| $img==''|| $pret==''|| $descriere=='')
                            { // daca sunt goale afisam mesaj de eroare
                              echo "<div> ERROR: Completati campurile obligatorii!</div>";
                            }else
                                { // daca nu sunt erori se face update name, code, image, price, descriere
                                    if ($stmt = $mysqli->prepare("UPDATE tabelproduse SET  
                                    nume=?,cod=?,img=?,pret=?,descriere=? WHERE id='".$id."'"))
                                        {
                                            $stmt->bind_param("sssds", $nume, $cod, $img, $pret, $descriere);
                                            $stmt->execute();
                                            $stmt->close();
                                        }// mesaj de eroare in caz ca nu se poate face update
                                    else
                                        {echo "ERROR: nu se poate executa update.";}
                                }
                        }

                         // daca variabila 'id' nu este valida, afisam mesaj de eroare
                    else
                        {echo "id incorect!";} 
            }
        }
?>

<html> 
    <head>
        <title> 
            <?php 
                if ($_GET['id'] != '')
                         { echo "Modificare inregistrare"; }
            ?> 
        </title>
    
        <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
    </head>
    
    <body>
        <h1>
            <?php 
                if ($_GET['id'] != '') 
                        { echo "Modificare Inregistrare"; } 
            ?>
        </h1>
    
        <?php
             if ($error != '') {
                        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";    
                                } 
        ?>
        <form action="" method="post">
    
            <div>
                <?php if ($_GET['id'] != '')   
                { ?>
                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
                    <p>ID: <?php echo $_GET['id'];
                    if ($result = $mysqli->query("SELECT * FROM tabelproduse where id='".$_GET['id']."'"))
                        {
                            if ($result->num_rows > 0)
                            { $row = $result->fetch_object();?></p>
                                <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume;?>"/><br/>
                                <strong>Cod: </strong> <input type="text" name="cod" value="<?php echo$row->cod;?>"/><br/>
                                <strong>Imagine: </strong> <input type="text" name="img" value="<?php echo$row->img;?>"/><br/>
                                <strong>Pret: </strong> <input type="text" name="pret" value="<?php echo$row->pret; ?>"/><br/>
                                <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo$row->descriere;
                            }
                        }
                } ?>"/><br/>
                     <br/>

                    <input type="submit" name="submit" value="Submit" />
                    <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
           
                    <a href="Vizualizare.php">Vizualizare tabel</a>
            </div>  
        </form>
    </body>
</html>
