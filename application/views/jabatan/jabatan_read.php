<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">JABATAN</h3>
            </div>
            
            
<table class='table table-bordered>'>
	    <tr><td>Nama Jabatan</td><td><?php echo $nama_jabatan; ?></td></tr>
	    <tr><td>Gaji Pokok</td><td><?php echo rupiah($gaji_pokok); ?></td></tr>
	    <tr><td>Tunjangan Makan</td><td><?php echo rupiah($tunjangan_makan); ?></td></tr>
	    <tr><td>Tunjangan Transport</td><td><?php echo rupiah($tunjangan_transport); ?></td></tr>
	    <tr><td>Nominal Lembur</td><td><?php echo rupiah($nominal_lembur); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('jabatan') ?>" class="btn btn-default">Cancel</a></td></tr>
        </table>

</div>
</div>
</div>