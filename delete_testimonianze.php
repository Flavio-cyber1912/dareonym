<?php
session_start();

if (isset($_POST['delete'])) {
    // Verifica se il percorso dell'immagine è stato inviato
    if (isset($_POST['image_path'])) {
        $image_path = $_POST['image_path'];
        
        // Rimuovi l'immagine dalla sessione
        if (($key = array_search($image_path, $_SESSION['uploadedImages'])) !== false) {
            unset($_SESSION['uploadedImages'][$key]);
        }
        
        // Rimuovi l'immagine dalla cartella di upload
        if (file_exists($image_path)) {
            unlink($image_path);
            echo "L'immagine è stata eliminata con successo.";
        } else {
            echo "Errore: l'immagine non esiste.";
        }
    } else {
        echo "Errore: percorso dell'immagine non specificato.";
    }
}
?>
