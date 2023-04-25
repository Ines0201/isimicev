<?php 
    //include("baza.php");
    include("zaglavlje.php");

    if (!$vezaNaBazu) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($vezaNaBazu, "utf8");

    if (isset($_SESSION["korime"])) {
        $korime = $_SESSION["korime"];
        echo "Pozdrav " . $korime . "!";
    } else {
        echo "Niste ulogirani";
    }

   // echo $_SESSION["korisnik_id"];
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodavanje pjesme korisnik</title>
</head>
<body>
    <form method="POST" action="dodavanje_pjesme_korisnik.php" >
        <label for="">Naziv pjesme: </label>
        <input type="varchar" name="naziv_pjesme" title="naziv pjesme" placeholder="Unesite naziv pjesme">
        <br>
        <label for="">Unesite poveznicu: </label>
        <input type="varchar" name="poveznica_pjesme" title="poveznica pjesme" placeholder="Unesite poveznicu">
        <br>
        <label for="">Opis pjesme: </label>
        <input type="text" name="opis_pjesme" title="opis pjesme" placeholder="Unesite opis pjesme">
        <br>
        <label for="">Datum i vrijeme spremanja</label>
        <input type="datetime-local" name="datum_vrijeme_pjesme" title="datum i vrijeme pjesme" placeholder="">
        <br>
        <button type="submit">Unesi</button>
        <br>
    </form>
    
    <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $korisnik_id = $_SESSION["korisnik_id"];

        if(isset($_POST['naziv_pjesme']) && isset($_POST['poveznica_pjesme']) && isset($_POST['opis_pjesme']) && isset($_POST['datum_vrijeme_pjesme'])){

            $naziv_pjesme_nova = $_POST['naziv_pjesme'];
            $poveznica_pjesme_nova = $_POST['poveznica_pjesme'];
            $opis_pjesme_nova = $_POST['opis_pjesme'];
            $datum_vrijeme_pjesme_nova = $_POST['datum_vrijeme_pjesme'];

            if(isset($_SESSION["korime"]))
            {
                $_SESSION['myGlobalVar'] = "registrirani korisnik";
                if($_SESSION['myGlobalVar'] == "registrirani korisnik")
                {
                    $dodaj = "INSERT INTO pjesma (korisnik_id,naziv, poveznica, opis, datum_vrijeme_kreiranja) 
                               VALUES ('$korisnik_id','$naziv_pjesme_nova','$poveznica_pjesme_nova','$opis_pjesme_nova','$datum_vrijeme_pjesme_nova')";
                    $rezultat = mysqli_query($vezaNaBazu, $dodaj);
                   
                    if(!$rezultat) {
                        die("Error: " . mysqli_error($vezaNaBazu));
                    }
                    else {
                        echo "Pjesma uspješno dodana u bazu.";
                    }
               
                
                }
            }
        }

    ?>
</body>
</html>