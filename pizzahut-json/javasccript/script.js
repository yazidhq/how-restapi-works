// dimasukkan ke function agar bisa ditampilkan di kategori
function tampilAllMenu() {
  // menampilkan all menu
  $.getJSON("../data/pizza.json", function (result) {
    // mendapatkan menunya
    let menu = result.menu;
    // looping result
    $.each(menu, function (index, data) {
      $("#daftar-menu").append(cardMenu(data));
    });
  });
}
tampilAllMenu();

$(".nav-link").on("click", function () {
  // menghapus dan mengubah class active sesuai yang diklik
  $(".nav-link").removeClass("active");
  $(this).addClass("active");
  // mengambil html yang di klik dari navbar dan simpan di h1
  let kategori = $(this).html();
  $("h1").html(kategori);
  // default menampilkan semua menu
  if (kategori == "All Menu") {
    tampilAllMenu();
    return;
  }
  // menampilkan sesuai kategori
  $.getJSON("../data/pizza.json", function (result) {
    let menu = result.menu;
    let konten = "";
    $.each(menu, function (index, data) {
      if (data.kategori == kategori.toLowerCase()) {
        konten += cardMenu(data);
      }
    });
    $("#daftar-menu").html(konten);
  });
});

// function card
function cardMenu(data) {
  return `<div class="col-md-4 mb-3"><div class="card"><img src="../img/pizza/${data.gambar}" class="card-img-top" /><div class="card-body"><h5 class="card-title">${data.nama}</h5><p class="card-text">${data.deskripsi}</p><h5 class="card-title mb-3">Rp. ${data.harga}</h5><a href="#" class="btn btn-primary">Order Now</a></div></div></div>`;
}
