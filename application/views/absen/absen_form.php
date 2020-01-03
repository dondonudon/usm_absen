<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA ABSEN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Kode Karyawan <?php echo form_error('kode_karyawan') ?></td><td><input type="text" class="form-control" name="kode_karyawan" id="kode_karyawan" placeholder="Kode Karyawan" value="<?php echo $kode_karyawan; ?>" /></td></tr>
	    <tr><td width='200'>Jam Asli Masuk <?php echo form_error('jam_asli_masuk') ?></td><td><input type="text" class="form-control" name="jam_asli_masuk" id="jam_asli_masuk" placeholder="Jam Asli Masuk" value="<?php echo $jam_asli_masuk; ?>" /></td></tr>
	    <tr><td width='200'>Jam Masuk Kantor <?php echo form_error('jam_masuk_kantor') ?></td><td><input type="text" class="form-control" name="jam_masuk_kantor" id="jam_masuk_kantor" placeholder="Jam Masuk Kantor" value="<?php echo $jam_masuk_kantor; ?>" /></td></tr>
	    <tr><td width='200'>Jam Keluar Kantor <?php echo form_error('jam_keluar_kantor') ?></td><td><input type="text" class="form-control" name="jam_keluar_kantor" id="jam_keluar_kantor" placeholder="Jam Keluar Kantor" value="<?php echo $jam_keluar_kantor; ?>" /></td></tr>
	    <tr><td width='200'>Jam Pulang Kantor <?php echo form_error('jam_pulang_kantor') ?></td><td><input type="text" class="form-control" name="jam_pulang_kantor" id="jam_pulang_kantor" placeholder="Jam Pulang Kantor" value="<?php echo $jam_pulang_kantor; ?>" /></td></tr>
	    <tr><td width='200'>Potongan Terlambat <?php echo form_error('potongan_terlambat') ?></td><td><input type="text" class="form-control" name="potongan_terlambat" id="potongan_terlambat" placeholder="Potongan Terlambat" value="<?php echo $potongan_terlambat; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_absen" value="<?php echo $kode_absen; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('absen') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>