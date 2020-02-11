<div class="row">
  <div class="col-md-12">
    <?= $this->session->flashdata('message'); ?>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          <!-- <?php if (!empty($data['data'])): ?>
            edit
          <?php else: ?>
            tambah
          <?php endif ?> Setasiun -->
          Tambah Tiket
        </h3>
      </div>
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="namaKereta">kode Tiket</label>
            <input type="text" name="nama" class="form-control" id="namaKereta" placeholder="">
          </div>
          <div class="form-group">
            <label for="namaKereta">kode Kereta</label>
            <input type="text" name="nama" class="form-control" id="namaKereta" placeholder="">
          </div>
          <div class="form-group">
            <label for="jmlKursi">Pilih Stasiun</label>
            <input type="number" name="jml_kursi" class="form-control" id="jmlKursi" placeholder="--pilih stasiun--">
          </div>
          <div class="form-group">
            <label for="namaKereta">Pilih Kelas</label>
            <input type="text" name="nama" class="form-control" id="namaKereta" placeholder="--pilih kelas--">
          </div>
          <div class="form-group">
            <label for="namaKereta">nama penumpang</label>
            <input type="text" name="nama" class="form-control" id="namaKereta" placeholder="masukkan nama">
          </div>

          <div class="form-group">
            <label for="namaKereta">Pilih kursi</label>
            <input type="text" name="nama" class="form-control" id="namaKereta" placeholder="--pilih kursi--">
          </div>

          <div class="form-group">
            <label for="namaKereta">Tanggal Keberangkatan</label>
            <input type="date" name="nama" class="form-control" id="namaKereta" placeholder="--pilih kursi--">
          </div>
          <div class="form-group">
            <label for="namaKereta">Berangkat dari</label>
            <input type="text" name="nama" class="form-control" id="namaKereta" placeholder="pilih keberangkatan">
          </div>
           <div class="form-group">
            <label for="namaKereta">Tujuan ke</label>
            <input type="text" name="nama" class="form-control" id="namaKereta" placeholder="Pilih tujuan">
          </div>
           <div class="form-group">
            <label for="namaKereta">Waktu berangkat</label>
            <input type="time" name="nama" class="form-control" id="namaKereta" placeholder="">
          </div>
          
           <div class="form-group">
            <label for="namaKereta">Waktu sampai</label>
            <input type="time" name="nama" class="form-control" id="namaKereta" placeholder="">
          </div>

          <div class="form-group">
            <label for="namaKereta">Harga Tiket</label>
            <input type="text" name="nama" class="form-control" id="namaKereta" placeholder="">
          </div>
          
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>