<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$publisher = query("SELECT * FROM publisher ");

// ambil data dari URL
$id = $_GET["id"];

// query data movie berdasarkan id
$mvs = query("SELECT * FROM idm0vies WHERE id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // ambil data dari tiap elemen dalam form


    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
            alert('data berhasil diubah!');
            document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'index.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, rgba(255, 0, 0, 0.8), rgba(255, 192, 203, 0.8), #ffffff);
            width: 320px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 50px;
            height: 100vh;
            align-items: center;
        }

        #card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 320px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #333333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 6px;
            color: #333333;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }

        button[type="submit"] {
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            background-color: #ff3366;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #e6005c;
        }

        p.error {
            color: #ff3366;
            font-style: italic;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
</head>

<body>
    <h1>Edit data movie</h1>
    <div id="card">

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mvs["id"]; ?>">
            <input type="hidden" name="pictureLama" value="<?= $mvs["picture"]; ?>">


            <label for="title">Title : </label>
            <input type="text" name="title" id="title" required value="<?= $mvs["title"]; ?>">

            <label for="picture">Picture : </label>
            <img src="img/<?= $mvs['picture']; ?>" width="40"> <br>
            <input type="file" name="picture" id="picture" ?>
            <br>

            <label for="synopsis">Synopsis : </label>
            <input type="text" name="synopsis" id="synopsis" required value="<?= $mvs["synopsis"]; ?>">

            <label for="cast">Cast : </label>
            <input type="text" name="cast" id="cast" required value="<?= $mvs["cast"]; ?>">

            <label for="rating">Rating : </label>
            <input type="text" name="rating" id="rating" required value="<?= $mvs["rating"]; ?>">

            <label for="color">Publisher:</label>
            <select name="idpublisher" id="color">
                <?php foreach ($publisher as $row) : ?>
                    <option value="<?= $row["id"]; ?>"><?= $row["nama"]; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="submit" class="btn btn-primary">Ubah Data!</button>

    </div>
    </form>
</body>

</html>