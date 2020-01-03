
<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA GAJI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        

	    <tr><td width='200'>Kode Karyawan <?php echo form_error('kode_karyawan') ?></td><td>
			<input name="kode_karyawan" id="kode_karyawan" class="form-control" type="text" placeholder="Kode Karyawan" value="<?php echo $kode_karyawan; ?>">
		</td></tr>
		<tr><td width='200'>Nama Karyawan</td>
		<td><input name="nama_karyawan" class="form-control" type="text" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>" readonly></td>
		</tr>
	    <tr><td width='200'>Periode <?php echo form_error('periode') ?></td><td><input type="date" class="form-control" name="periode" id="periode" placeholder="Periode" value="<?php echo $periode; ?>" /></td></tr>
		<tr><td width='200'>Gaji Pokok <?php echo form_error('gaji_pokok') ?></td><td><input type="text" class="form-control" name="gaji_pokok" id="gaji_pokok" placeholder="Gaji Pokok" value="<?php echo $gaji_pokok; ?>" readonly  /></td></tr>
	    <tr><td width='200'>Tunjangan Makan <?php echo form_error('tunjangan_makan') ?></td><td><input type="text" class="form-control" name="tunjangan_makan" id="tunjangan_makan" placeholder="Tunjangan Makan" value="<?php echo $tunjangan_makan; ?>" readonly /></td></tr>
	    <tr><td width='200'>Tunjangan Transport <?php echo form_error('tunjangan_transport') ?></td><td><input type="text" class="form-control" name="tunjangan_transport" id="tunjangan_transport" placeholder="Tunjangan Transport" value="<?php echo $tunjangan_transport; ?>" readonly /></td></tr>
	    <tr><td width='200'>Total Lembur <?php echo form_error('total_lembur') ?></td><td><input type="text" class="form-control" name="total_lembur" id="total_lembur" placeholder="Total Lembur" value="<?php echo $total_lembur; ?>" readonly /></td></tr>
	    <tr><td width='200'>Potongan Terlambat <?php echo form_error('potongan_terlambat') ?></td><td><input type="text" class="form-control" name="potongan_terlambat" id="potongan_terlambat" placeholder="Potongan Terlambat" value="<?php echo $potongan_terlambat; ?>" readonly /></td></tr>
	    <tr><td width='200'>Cicilan Hutang <?php echo form_error('cicilan_hutang') ?></td><td><input type="text" class="form-control" name="cicilan_hutang" id="cicilan_hutang" placeholder="Cicilan Hutang" value="<?php echo $cicilan_hutang; ?>" readonly /></td></tr>
	    <tr><td width='200'>Hasil Gaji <?php echo form_error('hasil_gaji') ?></td><td><input type="text" class="form-control" name="hasil_gaji" id="hasil_gaji" placeholder="Hasil Gaji" value="<?php echo $hasil_gaji; ?>" readonly /></td></tr>
	    <tr><td></td><td><input type="hidden" name="kode_gaji" value="<?php echo $kode_gaji; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('gaji') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			 $('#kode_karyawan').on('input',function(){
                
                var kode_karyawan=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/gaji/get_nama')?>",
                    dataType : "JSON",
                    data : {kode_karyawan: kode_karyawan},
                    cache:false,
                    success: function(data){
                        $.each(data,function(kode_karyawan, nama_karyawan){
                            $('[name="nama_karyawan"]').val(data.nama_karyawan);
							$('[name="gaji_pokok"]').val(data.gaji_pokok);
							$('[name="tunjangan_makan"]').val(data.tunjangan_makan);
							$('[name="tunjangan_transport"]').val(data.tunjangan_transport);
							$('[name="cicilan_hutang"]').val(data.cicilan_hutang);
                        });
                        
                    }
                });
                return false;
           });
		});

		$(document).ready(function(){
			 $('#periode').on('input',function(){
                
                var kode_karyawan=$("#kode_karyawan").val();
                var periode=$(this).val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('index.php/gaji/get_gaji')?>",
                    dataType : "JSON",
                    data : {kode_karyawan,periode},
                    cache:false,
                    success: function(data){
                        $.each(data,function(periode,kode_karyawan){
							$('[name="potongan_terlambat"]').val(data.potongan_terlambat);
							$('[name="total_lembur"]').val(data.total_lembur);               
                        });
                        $('#hasil_gaji').val( parseInt($('#gaji_pokok').val()) + parseInt($("#tunjangan_makan").val()) +parseInt($("#tunjangan_transport").val()) +parseInt($("#total_lembur").val()) - parseInt($("#potongan_terlambat").val()) - parseInt($("#cicilan_hutang").val()) );
                        
                    }
                });
                return false;
           });
        });
        
        // $("#periode").change(function () {
        //     $('#hasil_gaji').val( parseInt($('#gaji_pokok').val()) + parseInt($("#tunjangan_makan").val()) +parseInt($("#tunjangan_transport").val()) +parseInt($("#total_lembur").val()) - parseInt($("#potongan_terlambat").val()) - parseInt($("#cicilan_hutang").val()) );
        // });

        
        
	</script>
