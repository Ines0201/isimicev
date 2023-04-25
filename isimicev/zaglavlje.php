<?php
	include ("baza.php");
	//include ("login.php");
	if(session_id()=="")session_start();
	$trenutna=basename($_SERVER["PHP_SELF"]);
	$putanja=$_SERVER['REQUEST_URI'];
?>


<!DOCTYPE html>
<html lang="hr">
	<head>
		<title>Ines Šimićev - Glazbeni katalog</title>
		<meta charset="UTF-8">
		<meta name="autor" content="Ines Šimićev">
		<meta name="date" content="15.02.2023.">
		<link href="simicev.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<header>
		<h1>
		<a>Glazbeni katalog</a>
		<p>Vaša uloga je: <?php if(isset($_SESSION['myGlobalVar'])){
									echo  $_SESSION['myGlobalVar'];
								 }?></p> 
		</h1>
	</body>
<?php

?>
	<nav>
			<?php
					if(isset($_SESSION["korime"])){
						//print_r($tip_log_korisnika);
						
						switch($_SESSION['myGlobalVar']){
							case "admin":
								echo '<nav>';
								echo '<a href="/isimicev/index.php">Početna</a></br>';
								echo '<a href="pjesme_admin.php">Pregled svih pjesama</a></br>';
								echo '<a href="pjesme_kreirane_admin.php">Pregled svih mojih pjesama</a></br>';
								echo '<a href="dodavanje_pjesme_admin.php">Dodaj novu pjesmu</a></br>';
								echo '<a href="pjesme_admin.php">Uređivanje pjesama</a></br>';
								echo '<a href="korisnici_admin.php">Uređivanje korisnika</a></br>';
								echo '<a href="kuce_admin.php">Uređivanje medijskih kuća</a></br>';
								echo '<a href="o_autoru.php">O autoru</a></br>';
								echo '</nav>';
								break;

							case "moderator":
								echo '<nav>';
								echo '<a href="index.php">Početna</a></br>';
								echo '<a href="pjesme_moderator.php">Pregled svih pjesama</a></br>';
								echo '<a href="pjesme_kreirane_moderator.php">Pregled svih mojih pjesama</a></br>';
								echo '<a href="dodavanje_pjesme_moderator.php">Dodaj novu pjesmu</a></br>';
								echo '<a href="o_autoru.php">O autoru</a></br>';
								echo '</nav>';
								break;

							case "registrirani korisnik":
								echo '<nav>';
								echo '<a href="index.php">Početna</a></br>';
								echo '<a href="pjesme_korisnik.php">Pregled svih pjesama</a></br>';
								echo '<a href="pjesme_kreirane_korisnik.php">Pregled svih mojih pjesama</a></br>';
								echo '<a href="dodavanje_pjesme_korisnik.php">Dodaj novu pjesmu</a></br>';
								echo '<a href="o_autoru.php">O autoru</a></br>';
								echo '</nav>';
								break;
							}

					} else {
						echo '<nav>';
						echo '<a href="index.php">Početna</a></br>';
						echo '<a href="pjesme.php">Pjesme</a></br>';
						echo '<a href="o_autoru.php">O autoru</a></br>';
						echo '</nav>';
								
						}
				?>
		</nav>


