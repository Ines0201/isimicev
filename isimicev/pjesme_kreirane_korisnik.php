<?php 
    include("zaglavlje.php");

    if (!$vezaNaBazu) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($vezaNaBazu, "utf8");

   /* $korime = $_SESSION['korime']; 
    echo $korime;
    */
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Kreirane pjesme korisnika</title>
</head>
<body>

    <?php
        echo $_SESSION["korisnik_id"];
        $korisnik_id=$_SESSION["korisnik_id"];
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (isset($_SESSION["korime"])) {
        
                $select = mysqli_query($vezaNaBazu, "SELECT pjesma.pjesma_id,
                                                            pjesma.naziv AS pjesma_naziv,
                                                            pjesma.opis, 
                                                            datum_vrijeme_kreiranja, 
                                                            pjesma.medijska_kuca_id,
                                                            datum_vrijeme_kupnje,
                                                            poveznica 
                                                     FROM pjesma 
                                                     LEFT JOIN korisnik ON pjesma.korisnik_id = korisnik.korisnik_id
                                                     WHERE pjesma.korisnik_id = '$korisnik_id'
                                                     ");

                if (!$select) {
                    die("Error in query: " . mysqli_error($vezaNaBazu));
                }

                $pjesme = array();

                while($row = mysqli_fetch_assoc($select)) {
                    $pjesme[] = $row;
                }

                    if (count($pjesme) > 0){
                        echo "<table border=2>";
                        echo "<caption>Tablica sa prodanim pjesmama</caption>";
                        echo "<tr>
                                <th>Naziv pjesme</th>
                                <th>Opis</th>
                                <th>Datum i vrijeme kreiranja</th>
                                <th>Medijska kuća</th>
                                <th>Datum i vrijeme kupnje</th>
                                <th>Poveznica</th>
                            </tr>";
                    
                            foreach ($pjesme as $pjesma) {
                                $medijska_kuca_id = $pjesma["medijska_kuca_id"];
                                $datum_vrijeme_kupnje = $pjesma["datum_vrijeme_kupnje"];
                                
                                // provjeri dal je datum_vrijeme_kreiranja prazan i  medijska_kuca_id nije prazna
                                if (!isset($datum_vrijeme_kupnje) && isset($medijska_kuca_id)) {
                                    echo "<tr>
                                            <td>".$pjesma["pjesma_naziv"]."</td>
                                            <td>".$pjesma["opis"]."</td>
                                            <td>".$pjesma["datum_vrijeme_kreiranja"]."</td>
                                            <td>".$pjesma["medijska_kuca_id"]."</td>
                                            <td>";
                                    
                                    //Mogućnost odabira prodaje ili obijanje prodaje
                                    echo "<form method='post' action=''>";
                                        echo"<input type='hidden' name='pjesma_id' value='".$pjesma['pjesma_id']."'>";
                                        echo"<input type='radio' name='odluka' value='1'>Dopusti kupnju" . "<br>";
                                        echo"<input type='radio' name='odluka' value='0'>Odbij kupnju" . "<br>";
                                        echo"<input type='submit' name='dozvola_kupnje' value='Pošalji'>";
                                    echo "</form>";

                                    /*if (isset($_POST['dozvola_kupnje'])) {
                                        $dozvola_kupnje = $_POST['dozvola_kupnje'];
                                        if($dozvola_kupnje == 1){
                                            $datum_vrijeme_kupnje = date('Y-m-d H:i:s'); 
                                            $pjesma_id = $_POST['pjesma_id']; 
                                            $update = mysqli_query($vezaNaBazu, "UPDATE pjesma SET datum_vrijeme_kupnje = '$datum_vrijeme_kupnje' WHERE pjesma_id = '$pjesma_id'");
                                            if ($update) {
                                                echo "Song bought successfully!";
                                            } else {
                                                echo "Error: Unable to update database.";
                                            }
                                        }
                                    } else { 
                                        echo "Potrebno odobriti kupnju";
                                    }*/
                                    include("dozvola_kupnje.php");
                                    echo"</td>
                                    <td>";
                                    
                                    if (isset($pjesma['poveznica'])) {
                                        echo "<audio controls>";
                                            echo "<source src='".$pjesma['poveznica']."' type='audio/mpeg'>";
                                        echo "</audio>";
                                    } else { 
                                        echo "<p>Error: Audio file not found.</p>";
                                    }
                                    
                                echo "</td>
                                        </tr>";
                                } else {
                                    // kada nije odobrena kupnja
                                    echo "<tr>
                                            <td>".$pjesma["pjesma_naziv"]."</td>
                                            <td>".$pjesma["opis"]."</td>
                                            <td>".$pjesma["datum_vrijeme_kreiranja"]."</td>
                                            <td>".$pjesma["medijska_kuca_id"]."</td>
                                            <td>".$datum_vrijeme_kupnje."</td>
                                            <td>";
                                    
                                    if (isset($pjesma['poveznica'])) {
                                        echo "<audio controls>";
                                            echo "<source src='".$pjesma['poveznica']."' type='audio/mpeg'>";
                                        echo "</audio>";
                                    } else { 
                                        echo "<p>Error: Audio file not found.</p>";
                                    }
                                    
                                    echo "</td>
                                        </tr>";
                                }
                            }
                            
                        echo "</table>";
                    }
                
            }
            
            echo $datum_vrijeme_kupnje;

        //}
     
    ?>
</body>
</html>