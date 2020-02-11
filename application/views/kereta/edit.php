<div class="row">
  <div class="col-md-6">
    <?= $this->session->flashdata('message'); ?>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          <?php if (!empty($data['data'])): ?>
            edit
          <?php else: ?>
            tambah
          <?php endif ?> Kereta
        </h3>
      </div>
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="namaKereta">Nama kereta</label>
            <input type="text" name="nama" value="<?php echo @$data['data']['nama'] ?>" class="form-control" id="namaKereta" placeholder="Nama kereta">
          </div>
          <div class="form-group">
            <label for="jmlKursi">Jumlah kursi</label>
            <input type="number" name="jml_kursi" value="<?php echo @$data['data']['jml_kursi'] ?>" class="form-control" id="jmlKursi" placeholder="Jumlah kursi">
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>