<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();

    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
                                        header('Location: index.html');
                                        exit;
                                    }
?>

<?php
    // conectare la baza de date database
    include("Conectare.php");
    
    // se verifica daca id a fost primit
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                                // preluam variabila 'id' din URL
                                $id = $_GET['id'];
                                // stergem inregistrarea cu ib=$id
                                if ($stmt = $mysqli->prepare("DELETE FROM tabelproduse WHERE id = ? LIMIT 1")) {
                                                                                                $stmt->bind_param("i",$id);
                                                                                                $stmt->execute();
                                                                                                $stmt->close();
                                                                                                                }

                                else {
                                        echo "ERROR: Nu se poate executa delete.";
                                    }
                    $mysqli->close();
                    echo "<div>Inregistrarea a fost stearsa!!!!</div>";
                                                    }
                
                     echo "<p><a href=\"Vizualizare.php\">Vizualizare tabel</a></p>";
?>
