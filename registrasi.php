<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('user baru berhasil ditambahkan!');
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <style>
        label {
            display: block;
        }


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

    <h1>Register</h1>
    <div id="card">
        <form action="" method="post">

            <label for="username">Username :</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password :</label>
            <input type="password" name="password" id="password" required>

            <label for="password2">Konfirmasi password :</label>
            <input type="password" name="password2" id="password2" required>

            <button type="submit" name="register">Register!</button>

    </div>
    </form>

</body>

</html>