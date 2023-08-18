// const mahasiswa = {
//   nama: "Yazid",
//   umur: 21,
//   npm: 31120173,
// };

// // merubah object jadi json
// console.log(JSON.stringify(mahasiswa));

// // merubah json menjadi object/ array dengan Vanilla JS
// let xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function () {
//   if (xhr.readyState == 4 && xhr.status == 200) {
//     let mahasiswa = JSON.parse(this.responseText);
//     console.log(mahasiswa);
//   }
// };

// xhr.open("GET", "data.json", true);
// xhr.send();

// merubah json menjadi object/ array dengan JQuery
$.getJSON("data.json", function (data) {
  console.log(data);
});
