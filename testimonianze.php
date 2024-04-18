<?php
session_start();

// Percorso della cartella di upload
$uploadDir = "uploads/";

// Controlla se il form è stato inviato e il file è stato caricato
if (isset($_POST["submit"])) {
    // Ottieni il nome del file caricato
    $fileName = basename($_FILES["fileToUpload"]["name"]);

    // Sposta il file nella cartella di upload
    $target_file = $uploadDir . $fileName;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    // Aggiungi il percorso del file alla sessione
    $_SESSION['uploadedImages'][] = $target_file;
}

// Recupera le immagini caricate dall'utente corrente dalla sessione
$uploadedImages = isset($_SESSION['uploadedImages']) ? $_SESSION['uploadedImages'] : [];
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonianze</title>
</head>

<body>

    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <!-- Navbar-->
                <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                    <!-- Codice della navbar -->
                </nav>

                <!-- Page Header-->
                <section class="bg-white py-10">
                    <div class="container px-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h2 class="mb-0">Ultime Testimonianze</h2>
                        </div>
                        <div class="row gx-5">
                            <?php foreach ($uploadedImages as $image) : ?>
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <div class="card lift h-100">
                                        <img class="card-img-top" src="<?php echo $image; ?>" alt="Immagine testimonianza">
                                        <!-- Aggiungi il pulsante Elimina -->
                                        <form method="post" action="delete_testimonianze.php">
                                            <input type="hidden" name="image_path" value="<?php echo $image; ?>">
                                            <button type="submit" name="delete" class="btn btn-danger mt-2">Elimina</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

</body>

</html>