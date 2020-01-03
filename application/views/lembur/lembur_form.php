<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA LEMBUR</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>

	    <tr><td width='200'>Kode Karyawan <?php echo form_error('kode_karyawan') ?></td><td>
				<?php echo cmb_dinamis('kode_karyawan','karyawan','nama_karyawan','kode_karyawan','') ?>
		</td></tr>
	    <tr><td width='200'>Tgl Lembur <?php echo form_error('tgl_lembur') ?></td><td><input type="date" class="form-control" name="tgl_lembur" id="tgl_lembur" placeholder="Tgl Lembur" value="<?php echo $tgl_lembur; ?>" /></td></tr>
	    <tr><td width='200'>Jam Masuk Kantor <?php echo form_error('jam_masuk_kantor') ?></td><td><input type="time" class="form-control" name="jam_masuk_kantor" id="jam_masuk_kantor" placeholder="Jam Masuk Kantor" value="<?php echo $jam_masuk_kantor; ?>" /></td></tr>
	    <tr><td width='200'>Jam Pulang Kantor <?php echo form_error('jam_pulang_kantor') ?></td><td><input type="time" class="form-control" name="jam_pulang_kantor" id="jam_pulang_kantor" placeholder="Jam Pulang Kantor" value="<?php echo $jam_pulang_kantor; ?>" /></td></tr>
	    
        <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td></tr>
	    <tr><td width='200'>Hari Lembur <?php echo form_error('hari_lembur') ?></td><td><input type="text" class="form-control" name="hari_lembur" id="hari_lembur" placeholder="Hari Lembur" value="<?php echo $hari_lembur; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_lembur" value="<?php echo $kode_lembur; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('lembur') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>