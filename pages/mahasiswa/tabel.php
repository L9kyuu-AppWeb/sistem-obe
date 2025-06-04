<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Data Mahasiswa</h1>
      <a href="index.php?page=mahasiswa&action=tambah" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama</th>
              <th>Jurusan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>123456</td>
              <td>Asep</td>
              <td>Informatika</td>
              <td>
                <a href="index.php?page=mahasiswa&action=edit&id=123456" class="btn btn-warning btn-sm">Edit</a>
              </td>
            </tr>
            <!-- Tambahkan data dinamis -->
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
