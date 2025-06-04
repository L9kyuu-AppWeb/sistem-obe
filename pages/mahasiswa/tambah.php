<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Tambah Mahasiswa</h1>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <form method="post" action="#">
          <div class="form-group">
            <label>NIM</label>
            <input type="text" class="form-control" name="nim" required>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" required>
          </div>
          <div class="form-group">
            <label>Jurusan</label>
            <input type="text" class="form-control" name="jurusan" required>
          </div>
          <button type="submit" class="btn btn-success">Simpan</button>
          <a href="index.php?page=mahasiswa" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </section>
</div>
