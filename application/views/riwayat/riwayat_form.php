<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA RIWAYAT</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>

	    <tr><td width='200'>Kode Karyawan <?php echo form_error('kode_karyawan') ?></td><td>
				<?php echo cmb_dinamis('kode_karyawan','karyawan','nama_karyawan','kode_karyawan','') ?>
		</td></tr>
	    <tr><td width='200'>Tgl Masuk <?php echo form_error('tgl_masuk') ?></td><td><input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk" placeholder="Tgl Masuk" value="<?php echo $tgl_masuk; ?>" /></td></tr>
	    <tr><td width='200'>Tgl Keluar <?php echo form_error('tgl_keluar') ?></td><td><input type="date" class="form-control" name="tgl_keluar" id="tgl_keluar" placeholder="Tgl Keluar" value="<?php echo $tgl_keluar; ?>" /></td></tr>
	    <tr><td width='200'>Status <?php echo form_error('status') ?></td><td><?php echo form_dropdown('status', array('1' => 'Aktif', '2' => 'Tidak Aktif'), $status, array('class' => 'form-control')); ?></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_riwayat" value="<?php echo $kode_riwayat; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('riwayat') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>