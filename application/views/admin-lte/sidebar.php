<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<li class="nav-item">
  <a href="<?php echo base_url(); ?>" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      Dashboard
    </p>
  </a>
</li>
<li class="nav-item">
	<a href="<?php echo base_url('setasiun') ?>" class="nav-link">
		<i class="nav-icon fab fa-artstation"></i>
		<p>
			Stasiun
		</p>
	</a>
</li>
<li class="nav-item">
	<a href="<?php echo base_url('kereta') ?>" class="nav-link">
		<i class="nav-icon fas fa-train"></i>
		<p>
			Kereta
		</p>
	</a>
</li>
<li class="nav-item">
	<a href="<?php echo base_url('kelas') ?>" class="nav-link">
		<i class="nav-icon fab fa-atlassian"></i>
		<p>
			Kelas
		</p>
	</a>
</li>
<li class="nav-item">
	<a href="<?php echo base_url('tiket') ?>" class="nav-link">
		<i class="nav-icon fas fa-ticket-alt"></i>
		<p>
			Tiket
		</p>
	</a>
</li>
<li class="nav-item">
	<a href="<?php echo base_url('logout') ?>" class="nav-link active">
		<i style="color: red" class="nav-icon fas fa-power-off"></i>
		<p>
			Logout
		</p>
	</a>
</li>