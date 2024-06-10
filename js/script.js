$(document).ready(function () {
  //  event ketika keyword ditulis
  $('keyword').on('keyup', function () {
    $('#container').load('ajax/index.php?keyword=' + $('#keyword').val());
  });

  $('keyword').on('keyup', function () {
    $('#container').load('ajax/index2.php?keyword=' + $('#keyword').val());
  });
});
// // ambil elemen yang dibutuhkan
// var keyword = document.getElementById('keyword');
// var tombolCari = document.getElementById('tombol-cari');
// var container = document.getElementById('container');

// // tambahkan event ketika keyword ditulis
// keyword.addEventListener('keyup', function () {
//   // buat objek AJAX
//   var xhr = new XMLHttpRequest();

//   // cek kesiapa ajax
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       container.innerHTML = xhr.responseText;
//     }
//   };

//   // eksekusi ajax
//   xhr.open('GET', 'ajax/movies.php?keyword=' + keyword.value, true);
//   xhr.send();
// });
