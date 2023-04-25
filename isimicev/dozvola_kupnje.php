<?php
if (isset($_POST['dozvola_kupnje'])) {
                                        $dozvola_kupnje = $_POST['dozvola_kupnje'];
                                        if($dozvola_kupnje == 1){
                                            $datum_vrijeme_kupnje = date('Y-m-d H:i:s'); 
                                            $pjesma_id = $_POST['pjesma_id']; 
                                            $update = mysqli_query($vezaNaBazu, "UPDATE pjesma SET datum_vrijeme_kupnje = '$datum_vrijeme_kupnje' WHERE pjesma_id = '$pjesma_id'");
                                            if ($update) {
                                                echo "Song bought successfully!";
                                            } else {
                                                echo "Error: Unable to update database.";
                                            }
                                        }
                                    } else { 
                                        echo "Potrebno odobriti kupnju";
                                    }
                                    //header("Location:pjesme_kreirane_korisnik.php");
                                    //exit();
?>