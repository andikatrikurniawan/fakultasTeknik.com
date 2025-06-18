<?php
include ('koneksi.php');
$jabatan = $koneksi->query("SELECT * FROM jabatan");


    $nama = $_POST['nama'];
    $tggl = $_POST['tanggal_lahir'];
    $id_jabatan = $_POST['id_jabatan'];
    $jenjang = $_POST['jenjang'];
    $institusi = $_POST['institusi'];
    $tahun = $_POST['tahun'];

    $koneksi->query("INSERT INTO pegawai (nama, id_jabatan,Tggl_Lahir) VALUES ('$nama', '$id_jabatan','$tggl')");
    $id_pegawai = $koneksi->insert_id;
    $koneksi->query("INSERT INTO pendidikan (id_pegawai, jenjang, institusi, tahun_lulus) 
                    VALUES ('$id_pegawai', '$jenjang', '$institusi', '$tahun')");
    echo "Data berhasil disimpan!";

?>
