<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Prodaja pjesama</title>
</head>
<body>

    <?php
        echo $_SESSION["korisnik_id"];
        $korisnik_id=$_SESSION["korisnik_id"];
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (isset($_SESSION["korime"])) {
        
                $select = mysqli_query($vezaNaBazu, "SELECT pjesma.naziv AS pjesma_naziv,
                                                            pjesma.opis, 
                                                            datum_vrijeme_kreiranja, 
                                                            datum_vrijeme_kupnje,
                                                            poveznica,
                                                            pjesma.medijska_kuca_id
                                                     FROM pjesma 
                                                     LEFT JOIN korisnik ON pjesma.korisnik_id = korisnik.korisnik_id
                                                     LEFT JOIN medijska_kuca ON pjesma.medijska_kuca_id = medijska_kuca.medijska_kuca_id
                                                     WHERE pjesma.korisnik_id = '$korisnik_id'
                                                     AND datum_vrijeme_kreiranja='' OR datum_vrijeme_kreiranja IS NOT NULL");

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
                                <th>Datum i vrijeme kupnje</th>
                                <th>Poveznica</th>
                                <th>Id medijske kuće</th>
                            </tr>";
                    
                        foreach ($pjesme as $pjesma) {
                            echo "<tr>
                                    <td>".$pjesma["pjesma_naziv"]."</td>
                                    <td>".$pjesma["opis"]."</td>
                                    <td>".$pjesma["datum_vrijeme_kreiranja"]."</td>
                                    <td>".$pjesma["datum_vrijeme_kupnje"]."</td>
                                    <td>";
                    
                            if (isset($pjesma['poveznica'])) {
                                echo "<audio controls>";
                                    echo "<source src='".$pjesma['poveznica']."' type='audio/mpeg'>";
                                echo "</audio>";
                            } else { 
                                echo "<p>Error: Audio file not found.</p>";
                            }
                            
                            echo "</td>
                                  <td>".$pjesma["medijska_kuca_id"]."</td>
                                </tr>";
                        }
                    
                        echo "</table>";
                }
                
            }
        
    ?>

    
</body>
</html>