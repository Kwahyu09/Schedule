// //ambil elemen yang dibutuhkan
// var keyword = document.getElementById("keyword");
// var tombolCari = document.getElementById("tombol-cari");
// var container = document.getElementById("container");
// //artinya variabel keyword isinya id keyword yang ada didokumen begitu juga dengan variabel lainnya

// // tombolCari.addEventListener("click", function () {
// //   alert("berhasil");
// // });
// // kode diatas mempunyai arti jika tombol cari di klik maka jalankan function yang didalamnya berupa alers berhasil

// //tambahkan event ketika keyword ditulis
// //keypress ketika ada yang diketik didalam inputnya
// //keyup ketika dilepasi dari keyboarnya
// keyword.addEventListener("keyup", function () {
//   //   console.log(keyword.value);
//   //ambil apapun yang diketik di keyword

//   //buat object ajax
//   var xhr = new XMLHttpRequest();

//   //cek kesiapan ajax
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       container.innerHTML = xhr.responseText;
//     }
//   };

//   //eksekusi ajax
//   //parameter pertama methodnya dari mana
//   //parameter kedua sumbernya dari mana
//   //parameter ketiga mau sincronus = false atau unsincronus = true
//   xhr.open("GET", "ajax/jadwal.php?keyword=" + keyword.value, true);
//   xhr.send();
// });

//diatas adalah live search menggunakan ajax
// sekarang menggunakan jquery

//jquery tolong carikan dokumen ketika siap jalankan function
$(document).ready(function () {
  //hilangkan tombol cari
  $("#tombol-cari").hide();

  //buat event ketika keyword ditulis
  $("#keyword").on("keyup", function () {
    $(".loader").show();

    //menggunakan ajax load
    // $("#container").load("ajax/jadwal.php?keyword=" + $("#keyword").val());
    //sama seperti contoh sebelumnya jquery membuat jadi singkat
    //load memiliki keterbatasan hanya bisa method get saja tidak bisa post

    // $.get()
    $.get("ajax/jadwal.php?keyword=" + $("#keyword").val(), function (data) {
      $("#container").html(data);
      $(".loader").hide();
    });
  });
});
