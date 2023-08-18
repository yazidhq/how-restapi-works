<?php
// ENCODE

// // merubah array jadi json
// $mahasiswa = [
//     "nama" => "Yazid",
//     "umur" => 21,
//     "npm" => 31120173,
// ];
// $data = json_encode($mahasiswa);
// echo $data;

// mengambil data dari database dan mengubah jadi object
$dbh = new PDO('mysql:host=localhost;dbname=jewepe', 'root', '');
$db = $dbh->prepare('SELECT * FROM jwp_artikel');
$db->execute();
$artikel = $db->fetchAll(PDO::FETCH_ASSOC);
$data = json_encode($artikel);
echo $data;
