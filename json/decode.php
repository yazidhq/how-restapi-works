<?php
// DECODE

// merubah json menjadi object/ array(true)
$data = file_get_contents('data.json');
$mahasiswa = json_decode($data, true);
var_dump($mahasiswa);
echo $mahasiswa[0]["pembimbing"]["p1"];
