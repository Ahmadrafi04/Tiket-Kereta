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
          <?php endif ?> Kursi kereta
        </h3>
      </div>
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="kodeKursi">kode kursi</label>
            <input type="text" name="kode_kursi" value="<?php echo @$data['data']['kode_kursi'] ?>" class="form-control" id="kodeKursi" placeholder="Kode kursi">
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?php echo base_url('kereta/list_kursi/' . @$data['data']['kereta_id']) ?>" class="btn btn-warning">Cencel</a>
        </div>
      </form>
    </div>
  </div>
</div>