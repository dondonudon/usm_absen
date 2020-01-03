<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA JABATAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>

	    <tr><td width='200'>Nama Jabatan <?php echo form_error('nama_jabatan') ?></td><td><input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Nama Jabatan" value="<?php echo $nama_jabatan; ?>" /></td></tr>
	    <tr><td width='200'>Gaji Pokok <?php echo form_error('gaji_pokok') ?></td><td><input type="text" class="form-control" name="gaji_pokok" id="gaji_pokok" placeholder="Gaji Pokok" value="<?php echo $gaji_pokok; ?>" /></td></tr>
	    <tr><td width='200'>Tunjangan Makan <?php echo form_error('tunjangan_makan') ?></td><td><input type="text" class="form-control" name="tunjangan_makan" id="tunjangan_makan" placeholder="Tunjangan Makan" value="<?php echo $tunjangan_makan; ?>" /></td></tr>
	    <tr><td width='200'>Tunjangan Transport <?php echo form_error('tunjangan_transport') ?></td><td><input type="text" class="form-control" name="tunjangan_transport" id="tunjangan_transport" placeholder="Tunjangan Transport" value="<?php echo $tunjangan_transport; ?>" /></td></tr>
	    <tr><td width='200'>Nominal Lembur <?php echo form_error('nominal_lembur') ?></td><td><input type="text" class="form-control" name="nominal_lembur" id="nominal_lembur" placeholder="Nominal Lembur" value="<?php echo $nominal_lembur; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_jabatan" value="<?php echo $kode_jabatan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('jabatan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>