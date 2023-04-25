<?php
    include ("baza.php");
    if(session_id()=="")session_start();
    global $korime;
?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST">
        <input type="text" name="korime" placeholder="
        Unesite korisničko ime"><br>
        <input type="password" name="lozinka" placeholder="
        Unesite lozinku"><br>
        <input type="submit" name="login" value="Login"><br>
    </form>
    <a href="index.php">Početna</a>
   
<?php
    if(isset($_POST['login']))
    {
        $korime = $_POST['korime'];
        $lozinka = $_POST['lozinka'];


        $select = mysqli_query($vezaNaBazu, "SELECT tip_korisnika_id, korime, lozinka, korisnik_id  
                                             FROM korisnik 
                                             WHERE korime = '$korime' AND lozinka = '$lozinka'");
        $niztab = mysqli_fetch_array($select);
       
            if(!empty($niztab)){
                $_SESSION["korime"] = $niztab["korime"];
                $_SESSION["lozinka"] = $niztab["lozinka"];
                $_SESSION["korisnik_id"] = $niztab["korisnik_id"];
                
                $log_kor = "";           
                switch($niztab[0]){
                    case 0:
                        $log_kor = "admin";
                    break;
            
                    case 1:
                        $log_kor = "moderator";
                    break;
            
                    case 2:
                        $log_kor = "registrirani korisnik";
                    break;
            
                    default:
                        $log_kor = "anonimni";
                    break;
                }
                $tip_log_korisnika = $log_kor;
                $_SESSION['myGlobalVar']=$log_kor;
                print_r($tip_log_korisnika);
                
            } 
            else {
                if(isset($_SESSION["korime"])){
                    header("Location: potvrdaLogin.php");
                }
            }
    }
?>
</body>
</html>