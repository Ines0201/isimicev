<?php
include ("baza.php");
if(session_id()=="")session_start();
$trenutna=basename($_SERVER["PHP_SELF"]);
$putanja=$_SERVER['REQUEST_URI'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Dobrodošli <?php echo $_SESSION['korime'];?></h2><br>
	<p>Vaša uloga je: <?php echo  $_SESSION['myGlobalVar']; ?></p>
    <button><a href=logout.php>Odjava</a></button>
    <?php header("Location: index.php"); ?>
</body>
</html>