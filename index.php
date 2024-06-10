<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

// pegination
// konfigurasi
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM idm0vies"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$movies = query("SELECT * FROM idm0vies LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $movies = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>101.CO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="folder/style.css" type="text/css">
    <style>
        @media print {

            .logout,
            .navbar,
            .dropdown-item,
            .page,
            .add,
            .action,
            .btn {
                display: none;
            }
        }
    </style>
</head>


<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <nav class="navbar bg-body-tertiary">

        <div class="container-fluid">
            <a href="logout.php" class="btn btn-danger" class="logout">Logout</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" aria-label="Search" type="text" name="keyword" size="40" autofocus placeholder="Search.." autocomplete="off" id="keyword">
                <button class="btn btn-danger" type="submit" name="cari" id="tombol-cari">Search</button>
            </form>
        </div>
    </nav>
    <div class="tambah">
        <div class="container p-5 text-center">
            <a href="tambah.php" type="submit" name="tambah" class="btn btn-secondary">Want to add more?</a>
            <a class="dropdown-item" href="index2.php" target="_blank">User page</a>
        </div>
    </div>

    <form action="" method="post"></form>
    <!--navigasi-->
    <?php if ($halamanAktif > 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if ($i == $halamanAktif) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($halamanAktif < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>


    <div id="container">

        <table class="table table-secondary table-striped">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Title</th>
                    <th scope="col">Synopsis</th>
                    <th scope="col">Cast</th>
                    <th scope="col">Rating</th>
                    <th scope="col" class="action">Action</th>
                </tr>
            </thead>

            <?php $i = 1; ?>
            <?php foreach ($movies as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><img src="img/<?php echo $row["picture"]; ?>" width="50"></td>
                    <td><?= $row["title"]; ?></td>
                    <td><?= $row["synopsis"]; ?></td>
                    <td><?= $row["cast"]; ?></td>
                    <td><?= $row["rating"]; ?></td>
                    <td>
                        <div class="add">
                            <a href="ubah.php?id=<?= $row["id"]; ?>" class="badge text-bg-secondary text-decoration-none" class="edit">Edit</a>|<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');" class="badge text-bg-danger text-decoration-none" class="delete">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>


    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>