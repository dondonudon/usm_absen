<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">RIWAYAT</h3>
            </div>
            
            
<table class='table table-bordered>'>
	    <tr><td>Nama Karyawan</td><td><?php echo $nama_karyawan; ?></td></tr>
	    <tr><td>Tgl Masuk</td><td><?php echo $tgl_masuk; ?></td></tr>
	    <tr><td>Tgl Keluar</td><td><?php echo $tgl_keluar; ?></td></tr>
	    <tr><td>Status</td><td><?php echo rename_string_aktif($status); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('riwayat') ?>" class="btn btn-default">Cancel</a></td></tr>
        </table>

</div>
</div>
</div>