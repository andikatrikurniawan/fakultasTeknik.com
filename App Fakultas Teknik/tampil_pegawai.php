<?php
include ('koneksi.php');
$query = $koneksi->query("SELECT p.id_pegawai, p.nama, p.Tggl_Lahir, j.nama_jabatan, pd.jenjang, pd.institusi, pd.tahun_lulus 
                        FROM pegawai p
                        JOIN jabatan j ON p.id_jabatan = j.id_jabatan
                        LEFT JOIN pendidikan pd ON p.id_pegawai = pd.id_pegawai");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FAKULTAS TEKNIK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h3 class="mb-3">Data Kepegawaian Falkultas Teknik</h3>
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="table-warning">
      <tr>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Jabatan</th>
        <th>Jenjang</th>
        <th>Institusi</th>
        <th>Tahun</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $query->fetch_assoc()): ?>
        <tr>
          <td><?= $row['nama'] ?></td>
          <td><?= $row['Tggl_Lahir'] ?></td>
          <td><?= $row['nama_jabatan'] ?></td>
          <td><?= $row['jenjang'] ?></td>
          <td><?= $row['institusi'] ?></td>
          <td><?= $row['tahun_lulus'] ?></td>
          <td>
            <button class="btn btn-outline-warning btn-sm" onclick="editPegawai(<?= $row['id_pegawai'] ?>)">Edit</button>
            <button class="btn btn-outline-danger btn-sm" onclick="hapusPegawai(<?= $row['id_pegawai'] ?>)">Hapus</button>
          </td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
  </div>
</body>
</html>

