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
<body class="bg-light">
  <div class="container-fluid bg-primary py-4 text-center text-white w-100">
    <h2 class="mb-0">Kepegawain Fakultas Teknik</h2>
  </div>
  <div class="container mb-5">

    <div class="mb-2 mt-4" id="formArea"></div>
    <div class="mb-4">
      <button class="btn btn-outline-success" onclick="loadFormInsert()"><i class="fas fa-plus"></i>  Data Fakultas Teknik</button>
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
    loadPegawai();
  });
  </script>
  <?php include ('includes/footer.php');?>
</body>
</html>
