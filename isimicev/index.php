<?php
	include("zaglavlje.php");
	global $tip_log_korisnika;
	global $korime;

?>
<body>
<button><a href=login.php>Prijava</a></button>
	<h2>Dobrodošli <?php if(isset($_SESSION['korime'])){
								echo  $_SESSION['korime'];
						 }?>
	</h2><br>
    <button><a href=logout.php>Odjava</a></button>
<!--$_SESSION['korime']-->
		<div>
			<table>
			<caption>MEDIJSKE KUĆE</caption>
				<tr>
					<td>NAZIV</td>
					<td>OPIS</td>
				</tr>
				<tr>
					<td>Novi pokret</td>
					<td>Strane, domaće, ma sve. Kod nas možeš čuti alternativne zvukove.</td>
				</tr>
				<tr>
					<td>Klasika</td>
					<td>Klasična glazba je sve što nas zanima.</td>
				</tr>
				<tr>
					<td>Rokaši studio</td>
					<td>Kao što i ime govori, rock glazba nam teče u venama.</td>
				</tr>
				<tr >
					<td>Mild one</td>
					<td>Volimo zvukove prirode, laganice, violinu i dobar glas.</td>
				</tr>
				<tr>
					<td>Folklor</td>
					<td>Volimo tambure i folklorne pjesme.</td>
				</tr>
			</table>
		</div>
		<br><br>
		<div>
		<a> Dobrodošli na stranicu sa najboljom glazbom koju možete slušati.
		<br>
		Korisnik možete postati jednostavno time da unesete svoje osobne podatke u previđeni upit.
		</a>
		</div>
		<footer>
		<div >
		<img src="slike/music.jpg" 
				alt="Note" 
				title="Note"
				width="650"
				height="250"
				>
		</div>
		</footer>
	</body>
<?php
	include("podnoz.php");
?>
