<?php 
    //include("baza.php");
    include("zaglavlje.php");

    if (!$vezaNaBazu) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($vezaNaBazu, "utf8");
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Detalji pjesme</title>
    <script src="java.js"></script>
</head>
<body>

    <?php

       // $pjesma_naziv = $_SESSION['pjesma_naziv'];
        //$pjesma_id = $_GET['pjesma_id'];

        //echo "Kliknuta pjesma je: " . $pjesma_naziv;
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (isset($_GET['pjesma_id'])) {
            $pjesma_id = $_GET['pjesma_id'];
                $select = mysqli_query($vezaNaBazu, "SELECT pjesma.pjesma_id,
                                                            pjesma.naziv AS pjesma_naziv, 
                                                            DATE_FORMAT(pjesma.datum_vrijeme_kreiranja, '%d.%m.%Y %H:%i:%s') AS datum_vrijeme_kreiranja, 
                                                            pjesma.opis,
                                                            korisnik.ime,
                                                            korisnik.prezime,
                                                            medijska_kuca.naziv AS medijska_kuca_naziv,
                                                            pjesma.broj_svidanja 
                                                     FROM pjesma 
                                                     LEFT JOIN korisnik ON pjesma.korisnik_id = korisnik.korisnik_id
                                                     LEFT JOIN medijska_kuca ON pjesma.medijska_kuca_id = medijska_kuca.medijska_kuca_id
                                                     WHERE pjesma.pjesma_id = '$pjesma_id'");

                if (!$select) {
                    die("Error in query: " . mysqli_error($vezaNaBazu));
                }

                $pjesme = array();

                while($row = mysqli_fetch_assoc($select)) {
                    $pjesme[] = $row;
                }

                    if (count($pjesme) > 0){
                        echo "<table border=2>";
                            echo "<tr>
                                    <th>Naziv pjesme</th>
                                    <th>Datum i vrijeme kreiranja</th>
                                    <th>Opis</th>
                                    <th>Ime autora</th>
                                    <th>Prezime autora</th>
                                    <th>Medijska kuća</th>
                                    <th>Broj sviđanja</th>
                                    <th>Baci lajk</th>
                                </tr>";

                                    foreach ($pjesme as $pjesma) {
                                        echo "<tr>
                                            <td>".$pjesma["pjesma_naziv"]."</td>
                                            <td>".$pjesma["datum_vrijeme_kreiranja"]."</td>
                                            <td>".$pjesma["opis"]."</td>
                                            <td>".$pjesma["ime"]."</td>
                                            <td>".$pjesma["prezime"]."</td>
                                            <td>".$pjesma["medijska_kuca_naziv"]."</td>
                                            <td>".$pjesma["broj_svidanja"]."</td>
                                            <td>
                                            <form action='update_like.php' method='post'>
                                                <input type='hidden' name='pjesma_id_like' value='" . $pjesma_id . "'>
                                                <button type='submit'>Like</button>
                                            </form>
                                        </td>
                                        </tr>";
                            
                    }   
                    echo "</table>";
             }
            }
    ?>
    
</body>
</html>