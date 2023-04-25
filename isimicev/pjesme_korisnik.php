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
    <title>Pjesme prijavljeni korisnik</title>
</head>
<body>
    <form method="GET" action="" id="filter_pjesama">
        <label for="medijska_kuca_filter">Filter po medijskoj kući:</label>
        <select name="medijska_kuca_filter">
            <option value="">Izaberi sve</option>
            <option value="novi pokret">Novi pokret</option>
            <option value="klasika">Klasika</option>
            <option value="rokaši studio">Rokaši Studio</option>
            <option value="mild one">Mild One</option>
            <option value="folklor">Folklor</option>
        </select>
        <br>
        <label for="datum_filter">Filter po datumu (DD.MM.YYYY):</label>
        <input type="text" name="datuma_filter"  pattern="\d{2}\.\d{2}\.\d{4}\s\d{2}:\d{2}:\d{2}" title="Unesite datum i vrijeme" placeholder="dd.mm.YYYY HH:ii:ss">
        <br>
        <button type="submit">Filter</button>
        <br>
        <!--<button type="reset" form="filter_pjesama" name="reset">Reset</button>-->
    </form>
    
    <?php

        if(isset($_GET['medijska_kuca_filter'])) {
            $medijska_kuca_filter = $_GET['medijska_kuca_filter'];
            if ($medijska_kuca_filter === '') {
            } else {
            }
        } else {
            $medijska_kuca_filter = '';
        }
        
        
        if(isset($_GET['datum_filter'])) {
            $datum_filter = $_GET['datum_filter'];
            echo $datum_filter;
        } else {
            $datum_filter = '';
        }
        



        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        //$_SESSION["korime"] = "$korime";
        if(isset($_SESSION["korime"]))
        echo $_SESSION["korime"];
        {
            $_SESSION['myGlobalVar'] = "registrirani korisnik";
            if($_SESSION['myGlobalVar'] == "registrirani korisnik")
            {
                $izbavi =   "SELECT pjesma.pjesma_id,
                                    pjesma.naziv AS pjesma_naziv, 
                                    pjesma.poveznica, 
                                    korisnik.ime, 
                                    pjesma.broj_svidanja, 
                                    medijska_kuca.naziv AS medijska_kuca_naziv, 
                                    DATE_FORMAT(pjesma.datum_vrijeme_kreiranja, '%d.%m.%Y %H:%i:%s') AS datum_vrijeme_kreiranja
                            FROM pjesma 
                            LEFT JOIN korisnik ON pjesma.korisnik_id = korisnik.korisnik_id
                            LEFT JOIN medijska_kuca ON pjesma.medijska_kuca_id = medijska_kuca.medijska_kuca_id
                            ";


                if($medijska_kuca_filter != '') {
                    $izbavi .= " AND medijska_kuca.naziv LIKE '%$medijska_kuca_filter%' WHERE medijska_kuca.naziv IS NOT NULL";
                }


                if($datum_filter != '') {
                    $izbavi .= " AND pjesma.datum_vrijeme_kreiranja LIKE '%$datum_filter%'";
                }

                $select = mysqli_query($vezaNaBazu, $izbavi);


                if (!$select) {
                    die("Error in query: " . mysqli_error($vezaNaBazu));
                }

                $pjesme = array();

                while($row = mysqli_fetch_assoc($select)) {
                    $pjesme[] = $row;
                    //$datum_vrijeme_kreiranja = $row['datum_vrijeme_kreiranja'];
                }
                $_SESSION['pjesma_naziv'] = $pjesme[0]["pjesma_naziv"];

                if (count($pjesme) > 0) 
                {
                    echo "<table border=2>";
                    echo "<tr>
                            <th>Naziv pjesme</th>
                            <th>Audio zapis pjesme</th>
                            <th>Autor pjesme</th>
                            <th>Broj sviđanja</th>
                            <th>Medijska kuća</th>
                            <th>Datum i vrijeme kreiranja</th>
                        </tr>";

                        global $pjesma_naziv;

                        foreach ($pjesme as $pjesma) {

                            $pjesma_naziv = $pjesma["pjesma_naziv"];
                            //$pjesma_id = urlencode($pjesma_naziv); // encode the song name for use in the query string


                            echo ("<tr>
                                <td>
                                 <a href='detalji_pjesme.php?pjesma_id=".$pjesma['pjesma_id']."'>".$pjesma_naziv."</a>
                                <td>");

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
                                <td>".$pjesma["medijska_kuca_naziv"]."</td>
                                <td>".$pjesma["datum_vrijeme_kreiranja"]."</td>
                            </tr>";
                        }
                                               
                        echo "</table>";

                //$_SESSION['pjesma_naziv'] = $pjesma["pjesma_naziv"];
                }
            }
        }
        //$pjesma = array(
           // "datum_vrijeme_kreiranja" => "11.02.2023 10:30:00"
       // );
    
        $datum_vrijeme_kreiranja = $pjesma["datum_vrijeme_kreiranja"];
        $datum_filter = isset($_GET['datum_filter']) ? $_GET['datum_filter'] : null;
    
        if ($datum_filter == $datum_vrijeme_kreiranja) {
            echo $datum_filter->format('d.m.Y H:i:s');
        } else {
            echo "ERRORrrrrrrr";
        }
    ?>
</body>
</html>