<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA HUTANG</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>

	    <tr><td width='200'>Kode Karyawan <?php echo form_error('kode_karyawan') ?></td><td>
				<?php echo cmb_dinamis('kode_karyawan','karyawan','nama_karyawan','kode_karyawan','') ?>
		</td></tr>
	    <tr><td width='200'>Jumlah Hutang <?php echo form_error('jumlah_hutang') ?></td><td><input type="text" class="form-control" name="jumlah_hutang" id="jumlah_hutang" placeholder="Jumlah Hutang" value="<?php echo $jumlah_hutang; ?>" /></td></tr>
	    <tr><td width='200'>Cicilan Hutang <?php echo form_error('a_hutang') ?></td><td><input type="text" class="form-control" name="a_hutang" id="a_hutang" placeholder="Cicilan Hutang" value="<?php echo $a_hutang; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_hutang" value="<?php echo $kode_hutang; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('hutang') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>