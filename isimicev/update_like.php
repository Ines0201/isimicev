<?php
include("baza.php");

// Check if the form was submitted and the pjesma_naziv value was sent
if (isset($_POST['pjesma_id_like'])) {
    
    $pjesma_id_like = $_POST['pjesma_id_like'];
    echo "<br>" . $pjesma_id_like;

    // Check if the user has already liked this song
    if (!isset($_SESSION['liked_songs'])) {
        $_SESSION['liked_songs'] = array();
    }
    if (in_array($pjesma_id_like, $_SESSION['liked_songs'])) {
        // User has already liked this song, don't update the count
    } else {
        // Update the "broj_svidanja" field for the selected song
        $update = mysqli_query($vezaNaBazu, "UPDATE pjesma SET broj_svidanja = broj_svidanja + 1 
                                             WHERE pjesma_id = '$pjesma_id_like'");
        // Add the song to the user's liked songs list
        $_SESSION['liked_songs'][] = $pjesma_id_like;
    }

    // Unset the post data to prevent accidental resubmissions
    unset($_POST['pjesma_id_like']);

    // Redirect the user back to the previous page
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
