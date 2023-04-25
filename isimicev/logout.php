<?php 
    session_start();
    if(session_destroy()){
        header("Location:index.php");
        echo '<a href="/isimicev/index.php">Početna</a></br>';
    }else{
        echo '<a href="/isimicev/index.php">Početna</a></br>';
   }

   header("Location:index.php");
?> 