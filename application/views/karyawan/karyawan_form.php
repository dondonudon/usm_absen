<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KARYAWAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Nama Karyawan <?php echo form_error('nama_karyawan') ?></td><td><input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>" /></td></tr>
	    
        <tr><td width='200'>Alamat Karyawan <?php echo form_error('alamat_karyawan') ?></td><td> <textarea class="form-control" rows="3" name="alamat_karyawan" id="alamat_karyawan" placeholder="Alamat Karyawan"><?php echo $alamat_karyawan; ?></textarea></td></tr>
	    <tr><td width='200'>Nomor Telp <?php echo form_error('nomor_telp') ?></td><td><input type="text" class="form-control" name="nomor_telp" id="nomor_telp" placeholder="Nomor Telp" value="<?php echo $nomor_telp; ?>" /></td></tr>
	    <tr><td width='200'>Jenis Kelamin <?php echo form_error('jenkel') ?></td><td><?php echo form_dropdown('jenkel', array('L' => 'Laki-Laki', 'P' => 'Perempuan'), $jenkel, array('class' => 'form-control')); ?></tr>
	    <tr><td width='200'>Agama <?php echo form_error('agama') ?></td><td><?php echo form_dropdown('agama', array('1' => 'Islam', '2' => 'Kristen', '3' => 'Katholik', '4' => 'Budha', '5' => 'Hindu'), $agama, array('class' => 'form-control')); ?></tr>
	    <tr><td width='200'>Tempat Lahir <?php echo form_error('tempat_lahir') ?></td><td><input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" /></td></tr>
	    <tr><td width='200'>Tgl Lahir <?php echo form_error('tgl_lahir') ?></td><td><input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tgl Lahir" value="<?php echo $tgl_lahir; ?>" /></td></tr>
	    <tr><td width='200'>Pendidikan <?php echo form_error('pendidikan') ?></td><td><?php echo form_dropdown('pendidikan', array('1' => 'SD', '2' => 'SMP', '3' => 'SMA', '4' => 'S1'), $pendidikan, array('class' => 'form-control')); ?></tr>
	    <tr><td width='50'>Kode Jabatan <?php echo form_error('kode_jabatan') ?></td>
			<td>
				<?php echo cmb_dinamis('kode_jabatan','jabatan','nama_jabatan','kode_jabatan','') ?>
			</td>
		</tr>
	    <tr><td width='200'>Status <?php echo form_error('status') ?></td><td><?php echo form_dropdown('status', array('1' => 'Kawin', '2' => 'Tidak Kawin'), $status, array('class' => 'form-control')); ?></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_karyawan" value="<?php echo $kode_karyawan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('karyawan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>