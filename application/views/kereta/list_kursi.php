<div class="row">
  <div class="col-md-3">
    <?= $this->session->flashdata('message'); ?>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          <!-- <?php if (!empty($data['data'])): ?>
            edit
          <?php else: ?>
            tambah
          <?php endif ?> Setasiun -->
          tambah Kursi kereta
        </h3>
      </div>
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="kodeKursi">kode kursi</label>
            <input type="text" name="kode_kursi" class="form-control" id="kodeKursi" placeholder="Kode kursi">
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-9">
    <div class="card card-primary">
      <div class="card-header">
        Info kereta
      </div>
      <div class="card-body">
        <h4>Nama kereta : <?php echo $o_kereta[$this->uri->rsegments[3]] ?></h4>
        <h4>Jml kursi : <?php echo @$data['data']['count_kursi']; ?></h4>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Kursi Kereta</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kode kursi</th>
              <th style="text-align: center">action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data['data']['kursi'] as $value): ?>  
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $value['kode_kursi'] ?></td>
                <td align="center">
                  <a href="<?php echo base_url('kereta/edit_kursi/' . $value['id']) ?>" class="btn btn-info">edit</a>
                  <a href="<?php echo base_url('kereta/delete_kursi/'.$value['kereta_id'].'?kursi='.$value['id'])?>" onclick="if(confirm('Anda yakin ingin menghapus kursi <?php echo $value['kode_kursi'] ?>.')){}else{return false;};" class="btn btn-danger">delete</a>
                </td>
              </tr>
            <?php $no++; ?>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>