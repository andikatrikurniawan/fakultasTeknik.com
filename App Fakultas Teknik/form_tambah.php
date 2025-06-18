<?php include ('koneksi.php'); 
    $jabatan = $koneksi->query("SELECT * FROM jabatan");
?>
<form id="formTambah">
  <div class="mb-2">
      <label>Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
    <label class="form-label">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" class="form-control" required>
    </div>

    <div class="mb-2">
      <label>Jabatan</label>
      <select name="id_jabatan" class="form-select">
        <option value="">-- Pilih Jabatan --</option>
        <?php while($j = $jabatan->fetch_assoc()): ?>
          <option value="<?= $j['id_jabatan'] ?>"><?= $j['nama_jabatan'] ?></option>
        <?php endwhile ?>
      </select>
    </div>

    <h5 class="mt-3">Pendidikan</h5>
    <div class="mb-2">
      <label>Jenjang</label>
      <input type="text" name="jenjang" class="form-control" required>
    </div>

    <div class="mb-2">
      <label>Institusi</label>
      <input type="text" name="institusi" class="form-control" required>
    </div>

    <div class="mb-2">
      <label>Tahun Lulus</label>
      <input type="number" name="tahun" class="form-control" required>
    </div>

    <button class="btn btn-outline-success" type="submit">Simpan</button>
    <a href="index.php" class="btn btn-outline-secondary">Kembali</a><br><br>
</form>

<script>
$('#formTambah').submit(function(e){
  e.preventDefault();
  $.post('aksi_simpan.php', $(this).serialize(), function(res) {
    alert(res);
    $('#formArea').html('');
    $('#dataPegawai').load('tampil_pegawai.php').fadeIn;
  });
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
