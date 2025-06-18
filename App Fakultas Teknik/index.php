<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fakultas Teknik</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Optional: jQuery UI untuk datepicker -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<body class="bg-light">
  <div class="container-fluid bg-primary py-4 text-center text-white w-100">
    <h2 class="mb-0">Kepegawain Fakultas Teknik</h2>
  </div>
  <div class="container mb-5">

    <div class="mb-2 mt-4" id="formArea"></div>
    <div class="mb-4">
      <button class="btn btn-outline-success" onclick="loadFormInsert()">+ Data Fakultas Teknik</button>
    </div>
    <div id="dataPegawai"></div>
  </div>

  <script>
    function loadFormInsert() {
      $('#formArea').load('form_tambah.php');
    }

    function loadPegawai() {
      $('#dataPegawai').hide().load('tampil_pegawai.php').fadeIn();
    }

    function hapusApotik(id) {
      if (confirm("Yakin ingin menghapus?")) {
        $.post('aksi_hapus.php', { id: id }, function(res) {
          alert(res);
          loadPegawai();
        });
      }
    }

    function editApotik(id) {
      $('#formArea').load('aksi_edit.php?id=' + id);
    }

    $(document).ready(function() {
      loadPegawai();
    });
  </script>

</body>
</html>
