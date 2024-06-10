<?php

//koneksi ke DB & Pilih Database
$conn = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040055");



function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $title = htmlspecialchars($data["title"]);
    $synopsis = htmlspecialchars($data["synopsis"]);
    $cast = htmlspecialchars($data["cast"]);
    $rating = htmlspecialchars($data["rating"]);
    $publisher = htmlspecialchars($data["idpublisher"]);

    // $picture = htmlspecialchars($data["picture"]);
    // upload picture
    $picture = upload();
    if (!$picture) {
        return false;
    }

    $query = "INSERT INTO idm0vies 
    VALUES
    (NULL, '$title', '$picture', '$synopsis', '$cast', '$rating', '$publisher')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['picture']['name'];
    $ukuranFile = $_FILES['picture']['size'];
    $error = $_FILES['picture']['error'];
    $tmpName = $_FILES['picture']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
        alert('pilih gambar terlebih dahulu!');
        </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiPictureValid = ['jpg', 'jpeg', 'png'];
    $ekstensiPicture = explode('.', $namaFile);
    $ekstensiPicture = strtolower(end($ekstensiPicture));
    if (!in_array($ekstensiPicture, $ekstensiPictureValid)) {
        echo "<script>
        alert('yang anda upload bukan gambar!');
        </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFilebaru = uniqid();
    $namaFileBaru = $namaFilebaru . '.' . $ekstensiPicture;

    if (move_uploaded_file($tmpName, 'img/' . $namaFileBaru)) {
        return $namaFileBaru;
    } else {
        echo "<script>
            alert('File gagal diupload!');
        </script>";
        return false;
    }
}


function hapus($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM idm0vies WHERE id = $id");

    return mysqli_affected_rows($conn);
}


function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $title = htmlspecialchars($data["title"]);
    $synopsis = htmlspecialchars($data["synopsis"]);
    $cast = htmlspecialchars($data["cast"]);
    $rating = htmlspecialchars($data["rating"]);
    $pictureLama = htmlspecialchars($data["pictureLama"]);
    $publisher = htmlspecialchars($data["idpublisher"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['picture']['error'] === 4) {
        $picture = $pictureLama;
    } else {
        $picture = upload();
    }

    $query = "UPDATE idm0vies SET
    title = '$title',
    picture = '$picture',
    synopsis = '$synopsis',
    cast = '$cast',
    rating = '$rating'
    WHERE id = $id
    ";
    mysqli_query($conn, $query);

    return  mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM idm0vies
    WHERE
    title LIKE '%$keyword%' OR
    synopsis LIKE '%$keyword%' OR
    cast LIKE '%$keyword%' OR
    rating LIKE '%$keyword%'
    ";

    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah terdaftar!')
        </script>";

        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES(null, '$username', '$password')");

    return mysqli_affected_rows($conn);
}
