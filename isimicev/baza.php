<?php
	define("POSLUZITELJ","localhost");
	define("BAZA_KORISNIK","iwa_2021");
	define("BAZA_LOZINKA","foi2021");
	define("BAZA","iwa_2021_vz_projekt");
	global $vezaNaBazu;

	$vezaNaBazu = mysqli_connect('localhost','iwa_2021','foi2021','iwa_2021_vz_projekt') or die('Nije se u mogućnosti povezati');
	if(!$vezaNaBazu) {
		die("Connection failed: " . mysqli_connect_error());
		$_SESSION['globalna_konekcija']=$vezaNaBazu;
		global $vezaNaBazu;
	}

  $trenutna_stranica = basename($_SERVER['PHP_SELF']);
  echo "Trenutna stranica: " . $trenutna_stranica;


	/*
	function spojiSeNaBazu(){
		$veza=mysqli_connect(POSLUZITELJ,BAZA_KORISNIK,BAZA_LOZINKA);
		if(!$veza)echo "GREŠKA: Problem sa spajanjem u datoteci baza.php funkcija spojiSeNaBazu: ".mysqli_connect_error();
		mysqli_select_db($veza,BAZA);
		if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa odabirom baze u baza.php funkcija spojiSeNaBazu: ".mysqli_error($veza);
		mysqli_set_charset($veza,"utf8");
		if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa odabirom baze u baza.php funkcija spojiSeNaBazu: ".mysqli_error($veza);
		return $veza;
	}

	function izvrsiUpit($veza,$upit){
		$rezultat=mysqli_query($veza,$upit);
		if(mysqli_error($veza)!=="")echo "GREŠKA: Problem sa upitom: ".$upit." : u datoteci baza.php funkcija izvrsiUpit: ".mysqli_error($veza);
		return $rezultat;
	}

	function zatvoriVezuNaBazu($veza){
		mysqli_close($veza);
	}
	*/
	mysqli_set_charset($vezaNaBazu, "utf8");

?>

