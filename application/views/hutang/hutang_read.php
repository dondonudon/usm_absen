<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">HUTANG</h3>
            </div>
            
            
<table class='table table-bordered>'>
	    <tr><td>Nama Karyawan</td><td><?php echo $nama_karyawan; ?></td></tr>
	    <tr><td>Jumlah Hutang</td><td><?php echo rupiah($jumlah_hutang); ?></td></tr>
	    <tr><td>Cicilan Hutang</td><td><?php echo rupiah($a_hutang); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('hutang') ?>" class="btn btn-default">Cancel</a></td></tr>
        </table>

</div>
</div>
</div>