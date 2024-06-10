<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$publisher = query("SELECT * FROM publisher ");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {


    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
            alert('data berhasil ditambahkan!');
            document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!');
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
    <title>Add New Movie</title>
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
    </style>
</head>

<body>
    <div id="card">
        <h1>Add New Movie</h1>

        <form action="" method="post" enctype="multipart/form-data">

            <label for="title">Title : </label>
            <input type="text" name="title" id="title" required>

            <label for="picture">Picture : </label>
            <input type="file" name="picture" id="picture" required>
            <br>

            <label for="synopsis">Synopsis : </label>
            <input type="text" name="synopsis" id="synopsis" required>

            <label for="cast">Cast : </label>
            <input type="text" name="cast" id="cast" required>

            <label for="rating">Rating : </label>
            <input type="text" name="rating" id="rating" required>

            <label for="color">Publisher:</label>
            <select name="idpublisher" id="color">
                <?php foreach ($publisher as $row) : ?>
                    <option value="<?= $row["id"]; ?>"><?= $row["nama"]; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Tambah Data!</button>

        </form>
    </div>
</body>

</html>