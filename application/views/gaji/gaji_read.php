<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">GAJI</h3>
            </div>
            
            
<table class='table table-bordered>'>
	    <tr><td>Nama Karyawan</td><td><?php echo $nama_karyawan; ?></td></tr>
	    <tr><td>Periode</td><td><?php echo $periode; ?></td></tr>
	    <tr><td>Tunjangan Makan</td><td><?php echo rupiah($tunjangan_makan); ?></td></tr>
	    <tr><td>Tunjangan Transport</td><td><?php echo rupiah($tunjangan_transport); ?></td></tr>
	    <tr><td>Total Lembur</td><td><?php echo rupiah($total_lembur); ?></td></tr>
	    <tr><td>Potongan Terlambat</td><td><?php echo rupiah($potongan_terlambat); ?></td></tr>
	    <tr><td>Cicilan Hutang</td><td><?php echo rupiah($cicilan_hutang); ?></td></tr>
	    <tr><td>Hasil Gaji</td><td><?php echo rupiah($hasil_gaji); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('gaji') ?>" class="btn btn-default">Cancel</a></td></tr>
        </table>

</div>
</div>
</div>