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
          tambah Stasiun
        </h3>
      </div>
      <form role="form" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="namaStasiun">Nama stasiun</label>
            <input type="text" name="nama_stasiun" class="form-control" id="namaStasiun" placeholder="Nama stasiun">
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-9">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Stasiun</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama stasiun</th>
              <th style="text-align: center">action</th>
            </tr>
          </thead>
         
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data['data'] as $value): ?>  
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $value['nama_stasiun'] ?></td>
                <td align="center">
                  <a href="<?php echo base_url('setasiun/edit/' . $value['id']) ?>" class="btn btn-info">edit</a>
                  <a href="<?php echo base_url('setasiun/delete/'.$value['id'])?>" onclick="if(confirm('Anda yakin ingin menghapus stasiun <?php echo $value['nama_stasiun'] ?>.')){}else{return false;};" class="btn btn-danger">delete</a>
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