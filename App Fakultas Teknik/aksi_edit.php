<?php
include ('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id         = intval($_POST['id']);
    $nama       = $koneksi->real_escape_string($_POST['nama']);
    $tggl       = $koneksi->real_escape_string($_POST['tanggal_lahir']);
    $id_jabatan = intval($_POST['id_jabatan']);
    $jenjang    = $koneksi->real_escape_string($_POST['jenjang']);
    $institusi  = $koneksi->real_escape_string($_POST['institusi']);
    $tahun      = intval($_POST['tahun']);

    // Update tabel pegawai
    $updatePegawai = $koneksi->query("
        UPDATE pegawai 
        SET nama = '$nama',Tggl_Lahir = '$tggl' , id_jabatan = '$id_jabatan' 
        WHERE id_pegawai = $id
    ");

    // Update tabel pendidikan (relasi dengan id_pegawai)
    $updatePendidikan = $koneksi->query("
        UPDATE pendidikan 
        SET jenjang = '$jenjang', institusi = '$institusi', tahun_lulus = $tahun 
        WHERE id_pegawai = $id
    ");
        
    if ($updatePegawai && $updatePendidikan) {
        echo "Data Berhasil Diperbarui";
    } else {
        echo "Gagal memperbarui data: " . $koneksi->error;
    }
} else {
    echo "Permintaan tidak valid.";
}
?>

