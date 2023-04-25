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
    <title>Pjesme anonimni korisnik</title>
</head>
<body>
    <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $_SESSION["korime"] = "mrkimedo";
        if(isset($_SESSION["korime"]))
        {
            $_SESSION['myGlobalVar'] = "anonimni";
            if($_SESSION['myGlobalVar'] == "anonimni")
            {
                $select = mysqli_query($vezaNaBazu, "SELECT pjesma.naziv, pjesma.poveznica, korisnik.ime, pjesma.broj_svidanja 
                                                     FROM pjesma 
                                                     JOIN korisnik ON pjesma.korisnik_id = korisnik.korisnik_id
                                                     WHERE datum_vrijeme_kupnje IS NOT NULL 
                                                     ORDER BY broj_svidanja DESC");

                if (!$select) {
                    die("Error in query: " . mysqli_error($vezaNaBazu));
                }

                $pjesme = array();

                while($row = mysqli_fetch_assoc($select)) {
                    $pjesme[] = $row;
                }

                if (count($pjesme) > 0) 
                {
                    // Output table
                    echo "<table border=2>";
                    echo "<tr>
                            <th>Naziv pjesme</th>
                            <th>Audio zapis pjesme</th>
                            <th>Autor pjesme</th>
                            <th>Broj sviđanja</th>
                        </tr>";

                        foreach ($pjesme as $pjesma) {
                            echo "<tr>
                                    <td>".$pjesma["naziv"]."</td>
                                    <td>";
                            if (isset($pjesma['poveznica'])) {
                                echo "<audio controls>";
                                echo "<source src='".$pjesma['poveznica']."' type='audio/mpeg'>";
                                echo "</audio>";
                            } else { 
                                echo "<p>Error: Audio file not found.</p>";
                            }
                            echo "</td>
                                    <td>".$pjesma["ime"]."</td>
                                    <td>".$pjesma["broj_svidanja"]."</td>
                                </tr>";
                        }                        
                        echo "</table>";
                }
            }
        }
    ?>
</body>
</html>