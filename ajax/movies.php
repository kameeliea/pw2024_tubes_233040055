<?php
require '../functions.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM idm0vies
WHERE
title LIKE '%$keyword%' OR
synopsis LIKE '%$keyword%' OR
cast LIKE '%$keyword%' OR
rating LIKE '%$keyword%'
";
$movies = query($query);
?>

<table class="table table-success table-striped" border="2" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Picture</th>
        <th>Title</th>
        <th>Synopsis</th>
        <th>Cast</th>
        <th>Rating</th>
        <th>Action</th>
    </tr>
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
                <a href="ubah.php?id=<?= $row["id"]; ?>">Edit</a>|<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">Delete</a>
            </td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>