<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">KARYAWAN</h3>
            </div>
            
            
<table class='table table-bordered>'>
	    <tr><td>Nama Karyawan</td><td><?php echo $nama_karyawan; ?></td></tr>
	    <tr><td>Alamat Karyawan</td><td><?php echo $alamat_karyawan; ?></td></tr>
	    <tr><td>Nomor Telp</td><td><?php echo $nomor_telp; ?></td></tr>
	    <tr><td>Jenkel</td><td><?php echo $jenkel; ?></td></tr>
	    <tr><td>Agama</td><td><?php echo $agama; ?></td></tr>
	    <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
	    <tr><td>Tgl Lahir</td><td><?php echo $tgl_lahir; ?></td></tr>
	    <tr><td>Pendidikan</td><td><?php echo $pendidikan; ?></td></tr>
	    <tr><td>Kode Jabatan</td><td><?php echo $jabatan; ?></td></tr>
	    <tr><td>Status</td><td><?php echo rename_string_kawin($status); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('karyawan') ?>" class="btn btn-default">Back</a></td></tr>
        </table>

</div>
</div>
</div>