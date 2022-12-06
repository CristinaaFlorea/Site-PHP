<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();

    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
                                        header('Location: index.html');
                                        exit;
                                    }
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Vizualizare Inregistrari</title>
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
            /*Red */   
            .logout {
                    border-color: #f44336;
                    color: red
                }
            .logout:hover {
                            background: #f44336;
                            color: white;
                        }

            /* Green */
            .add {
                    border-color: #04AA6D;
                    color: green;
                }
            .add:hover {
                            background-color: #04AA6D;
                            color: white;
                        }
        </style>
    </head>

    <body>
        <h1>Inregistrarile Produselor</h1>
            <p><b>Acestea sunt toate inregistrarile din tabelproduse</b></p>

            <?php
            // connectare bazadedate
            include("Conectare.php");

            // se preiau inregistrarile din baza de date
            if ($result = $mysqli->query("SELECT * FROM tabelproduse ORDER BY id "))
            { // Afisare inregistrari pe ecran
                if ($result->num_rows > 0){
                                            // afisarea inregistrarilor intr-o table
                                            echo "<table border='1' cellpadding='10'>";
                                            // antetul tabelului
                                            echo "<tr><th>ID</th><th>Nume Produs</th><th>Cod Produs</th>
                                            <th>Imagine</th><th>Descriere</th><th></th><th></th></tr>";
   
                                            while ($row = $result->fetch_object()) {
                                                            // definirea unei linii pt fiecare inregistrare
                                                            echo "<tr>";
                                                            echo "<td>" . $row->id . "</td>";
                                                            echo "<td>" . $row->nume . "</td>";
                                                            echo "<td>" . $row->cod . "</td>";
                                                            echo "<td>" . $row->img . "</td>";
                                                            echo "<td>" . $row->descriere . "</td>";
                                                            echo "<td><a href='Modificare.php?id=" . $row->id . "'>Modificare</a></td>";
                                                            echo "<td><a href='Stergere.php?id=" .$row->id . "'>Stergere</a></td>";
                                                            echo "</tr>";
                                                                                        }
                                            echo "</table>";
                                           }
                                            // daca nu sunt inregistrari se afiseaza un rezultat de eroare
                    else {
                            echo "Nu sunt inregistrari in tabela!";
                        }
                }
                // eroare in caz de insucces in interogare
            else {
                    echo "Error: " . $mysqli->error(); 
                 }
// se inchide
$mysqli->close();
?>

<a href="Inserare.php"><button class="btn add">Adaugarea unei noi inregistrari</button></a>
<a href="logout.php"><i class="fas fa-sign-outalt"></i><button class="btn logout">Logout</button></a>
           
</body>
</html>
