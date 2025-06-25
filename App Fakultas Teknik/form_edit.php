<?php
include ('koneksi.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<div class='alert alert-danger'>ID pegawai tidak valid.</div>";
  exit;
}

$id = intval($_GET['id']);

$jabatan = $koneksi->query("SELECT * FROM jabatan");
$data = $koneksi->query("SELECT * FROM pegawai p 
                        JOIN pendidikan pd ON p.id_pegawai = pd.id_pegawai 
                        WHERE p.id_pegawai = $id ")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container mt-4">
  <div class="container-fluid bg-success py-2 text-center text-white w-100">
    <h2 class="mb-1">Edit Data Kepegawaian Falkultas Teknik</h2>
  </div><br>
<form id="formEdit">
    <input type="hidden" name="id" value="<?= $data['id_pegawai'] ?>">
 <div class="mb-2">
      <label>Nama</label>
      <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
    </div>

    <div class="mb-2">
      <label>Tanggal Lahir</label>
      <input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['Tggl_Lahir'] ?>" required>
    </div>

    <div class="mb-2">
      <label>Jabatan</label>
      <select name="id_jabatan" class="form-select">
        <?php while($j = $jabatan->fetch_assoc()): ?>
          <option value="<?= $j['id_jabatan'] ?>" <?= $data['id_jabatan'] == $j['id_jabatan'] ? 'selected' : '' ?>>
            <?= $j['nama_jabatan'] ?>
          </option>
        <?php endwhile ?>
      </select>
    </div>

    <h5 class="mt-3">Pendidikan</h5>
    <div class="mb-2">
      <label>Jenjang</label>
      <input type="text" name="jenjang" class="form-control" value="<?= $data['jenjang'] ?>" required>
    </div>

    <div class="mb-2">
      <label>Institusi</label>
      <input type="text" name="institusi" class="form-control" value="<?= $data['institusi'] ?>" required>
    </div>

    <div class="mb-2">
      <label>Tahun Lulus</label>
      <input type="number" name="tahun" class="form-control" value="<?= $data['tahun_lulus'] ?>" required>
    </div>

    <button class="btn btn-outline-info" type="submit">Update</button>
    <button type="button" class="btn btn-outline-warning" id="btnKembali">Kembali</button>
</form>

          
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
$('#formEdit').submit(function(e){
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: 'aksi_edit.php',
    data: $(this).serialize(),
    success: function(res){
        alert(res);
        $('#formArea').html('');
        $('#dataPegawai').hide().load('tampil_pegawai.php').fadeIn();
    }
  });
});

 // ✅ Fungsi untuk tombol "Kembali"
  $('#btnKembali').click(function(){
    $('#formArea').html('');
    $('#dataPegawai').load('tampil_pegawai.php').fadeIn();
  });

 $(function(){
    $('input[type="date"]').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: "1960:2025"
    });
    });
</script>

</body>
</html>