<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include il file di connessione al database
include_once("connection_database.php");

session_start();
if (isset($_SESSION["user"])) {
    header('location: home_creator.php');
}

//die(break01');//
$loginSuccessMessage = ''; // Inizializza la variabile del messaggio di successo

// Verifica se è stato inviato il modulo di login
if (isset($_POST["username"])) {
    $result = array();
    try {
        $email = $_POST['username'];
        $password = ($_POST['password']);
        
        $sth = $db->prepare("SELECT * FROM dr_creator WHERE email_creator = ? AND password_creator = ?");
        $sth->execute(array(
            $email,
            $password
        ));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }
    if (sizeof($result) > 0) {
        $_SESSION['user'] = $result;
        header('location: home_creator.php');
    } else {
        $loginSuccessMessage = "Username o Password errati";
    }
    
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login System - Master</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        html,
        body {
            height: 100%;
        }

        .container-fluid {
            height: 100%;
            display: flex;
            padding-left: 0;
            padding-right: 0;
        }

        .flex-column {
            flex-direction: column !important;
            width: 280px;
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            z-index: 1;
        }


        .flex-column a:hover {
            background-color: #495057;
        }

        .flex-column .active:hover {
            background-color: #495057;
        }

        .col {
            flex: 1;
            padding: 15px;
            margin-left: 280px;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .navbar-brand:hover h1,
        .navbar-brand:hover p {
            color: blue;
            /* Sostituisci con il colore desiderato */
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <!-- Sidebar al posto del menu a tendina -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Menu</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'index.php') !== false ? 'active' : ''; ?>">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'news.php') !== false ? 'active' : ''; ?>">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#table"></use>
                        </svg>News
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'ranking.php') !== false ? 'active' : ''; ?>">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>Ranking
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'creators.php') !== false ? 'active' : ''; ?>">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle"></use>
                        </svg>Creators
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>Leo.Zanarella</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <!-- Fine della sidebar -->

        <!-- Contenuto principale -->
        <div class="col">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <!-- Logo e titolo -->
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <h1 class="display-4" style="font-family: auto;">Dareonym</h1>
                        <p class="lead">Unveiling the Cyber Horizon</p>
                        <?php
                        echo $loginSuccessMessage;
                        ?>
                    </a>
                </div>
            </nav>

            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- Your login form -->
                            <form action="login_creator.php" method="post">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <a href="forgot_password.php">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fine contenuto principale -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your custom scripts -->
    <script src="path/to/your/custom-scripts.js"></script>
</body>

</html>