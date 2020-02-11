<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-12">
	<a href="<?php echo base_url('kelas') ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> kembali</a>
	<hr>
	<?= $this->session->flashdata('message'); ?>
</div>