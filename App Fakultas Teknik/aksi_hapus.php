<?php
include ('koneksi.php');
$id = $_POST['id'];
$koneksi->query("DELETE FROM pendidikan WHERE id_pegawai=$id");
$koneksi->query("DELETE FROM pegawai WHERE id_pegawai=$id");
    echo "Data Berhasil Dihapus"; 
?>
