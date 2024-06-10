<?php
require 'functions.php';
$movies = query("SELECT * FROM idm0vies");

if (isset($_POST["cari"])) {
    $movies = cari($_POST["keyword"]);
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>101.CO</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="folder/style.css" type="text/css">

    <style>
        @media print {

            .navbar,
            .jumbotron {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a href="registrasi.php?>" class="badge text-bg-secondary text-decoration-none">Register</a>
            <a href="login.php?>" class="badge text-bg-secondary text-decoration-none">Login</a>
            <!-- Search Form -->
            <form class="navbar-form d-flex" method="POST">
                <input class="form-control me-2" type="search" name="keyword" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-danger" type="submit" name="cari">Search</button>
            </form>

        </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <section class="jumbotron text-center">
        <img src="img/bg7.jpg" class="img-fluid" alt="Background Image">
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container p-5 text-center">
            <h1 class="fw-bold">Movie recommendations here will be a masterpiece in your life.</h1>
        </div>
    </section>

    <!-- Movies Section -->
    <section id="movies" class="movies">
        <div class="container">
            <div class="row">
                <div class="row justify-content-center">
                    <?php foreach ($movies as $mvs) : ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="img/<?= $mvs['picture']; ?>" class="img-fluid rounded-start" alt="<?= $mvs['title']; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $mvs['title']; ?></h5>
                                            <p class="card-text"><?= $mvs['synopsis']; ?></p>
                                            <p class="card-text"><?= $mvs['cast']; ?></p>
                                            <p class="card-text"><?= $mvs['rating']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!--footer-->
    <footer>
        <div class="container">
            <div class="container p-5 text-center">
                <p>&copy; 2024 Made with Love, I think so.</p>
            </div>
        </div>
    </footer>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
</body>

</html>