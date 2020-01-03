<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA CUTI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>

	    <tr><td width='200'>Kode Karyawan <?php echo form_error('kode_karyawan') ?></td>
        <td>
				<?php echo cmb_dinamis('kode_karyawan','karyawan','nama_karyawan','kode_karyawan','') ?>
		</td></tr>
	    <tr><td width='200'>Tgl Cuti Awal<?php echo form_error('tgl_cuti') ?></td><td><input type="date" class="form-control" name="tgl_cuti_a" id="tgl_cuti_a" placeholder="Tgl Cuti Awal" value="<?php echo $tgl_cuti_a; ?>" /></td></tr>
        <tr><td width='200'>Tgl Cuti Akhir <?php echo form_error('tgl_cuti') ?></td><td><input type="date" class="form-control" name="tgl_cuti_b" id="tgl_cuti_b" placeholder="Tgl Cuti Akhir" value="<?php echo $tgl_cuti_b; ?>" /></td></tr>
	    
        <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_cuti" value="<?php echo $kode_cuti; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('cuti') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>