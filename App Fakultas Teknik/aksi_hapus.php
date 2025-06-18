<?php
include ('koneksi.php');
$id = $_GET['id'];
$koneksi->query("DELETE FROM pendidikan WHERE id_pegawai=$id");
$koneksi->query("DELETE FROM pegawai WHERE id_pegawai=$id");
header("Location: index.php");
?>
