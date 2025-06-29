<!-- Ini Hak Cipta Andika Tri Kurniawan -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fakultas Teknik</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


  <!-- Optional: jQuery UI untuk datepicker -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<?php
include ('koneksi.php');
// Jika permintaan AJAX untuk data tabel
if (isset($_GET['load']) && $_GET['load'] == 'data') {
  $query = $koneksi->query("SELECT p.id_pegawai, p.nama, p.Tggl_Lahir, j.nama_jabatan, pd.jenjang, pd.institusi, pd.tahun_lulus 
                          FROM pegawai p
                          JOIN jabatan j ON p.id_jabatan = j.id_jabatan
                          LEFT JOIN pendidikan pd ON p.id_pegawai = pd.id_pegawai");
?>
<h3 class="mb-3">Data Kepegawaian Fakultas Teknik</h3>
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
            <button class="btn btn-outline-warning btn-sm" onclick="editPegawai(<?= $row['id_pegawai'] ?>)">
              <i class="fas fa-edit"></i> Edit
            </button>
            <button class="btn btn-outline-danger btn-sm" onclick="hapusPegawai(<?= $row['id_pegawai'] ?>)">
              <i class="fas fa-trash"></i> Hapus
            </button>
          </td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</div>
<?php
exit; // hentikan agar tidak lanjut ke bawah
}
?>

<body class="bg-light">
  <div class="container-fluid bg-primary py-3 text-center text-white w-100">
    <h2 class="mb-0">Kepegawain Fakultas Teknik</h2>
    <p>
    <span class="animated-text">
        <i class="bi bi-stars me-2"></i>
        Welcome to the Faculty Of Engineering,please fill in your data.
        <i class="bi bi-gear ms-2"></i>
    </span>
    </p>
  </div>

  <div class="container mt-3">
    <div class="mb-2 mt-4" id="formArea"></div>
    <div class="mb-4">
      <button class="btn btn-outline-success" onclick="loadFormInsert()">
        <i class="fas fa-plus"></i> Data Kepegawaian Fakultas Teknik
      </button>
    </div>

    <!-- Bagian tabel AJAX -->
    <div id="dataPegawai"></div>
  </div>

  <script>
    function loadFormInsert() {
      $('#formArea').load('form_tambah.php').fadeIn();
    }

    function loadPegawai() {
      $('#dataPegawai').hide().load('index.php?load=data').fadeIn();
    }


     // ✅ AJAX untuk tombol Edit
  function editPegawai(id) {
    $.ajax({
      url: 'form_edit.php',
      type: 'GET',
      data: { id: id },
      success: function(res) {
        $('#formArea').html(res); // tampilkan form edit di #formArea
        $('html, body').animate({
          scrollTop: $('#formArea').offset().top
        }, 400); // scroll ke form
      },
      error: function() {
        alert('Gagal memuat form edit.');
      }
    });
  }

  // ✅ AJAX untuk tombol Hapus
  function hapusPegawai(id) {
    if (confirm('Yakin ingin menghapus data ini?')) {
      $.ajax({
        url: 'aksi_hapus.php',
        type: 'POST',
        data: { id: id },
        success: function(res) {
          alert(res);         // tampilkan alert respons
          loadPegawai();      // reload data pegawai
        },
        error: function() {
          alert('Gagal menghapus data.');
        }
      });
    }
  }

  // ✅ Load data pertama kali
  $(document).ready(function() {
    loadPegawai().fadeIn();
  });
  </script>
  <?php include ('includes/footer.php');?>
</body>
</html>
