<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">IMPORT DATA ABSEN</h3>
            </div>
            

	<!-- Load File jquery.min.js yang ada difolder js -->
	

	<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>

	<a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
	
	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<form method="post" action="<?php echo base_url("index.php/absen/form"); ?>" enctype="multipart/form-data">
		<input type="file" name="file"><br>
	<input type="submit" name="preview" value="Preview">
	</form>

	<?php
	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
		if(isset($upload_error)){ // Jika proses upload gagal
			echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
			die; // stop skrip
		}

		// Buat sebuah tag form untuk proses import data ke database
		echo "<form method='post' action='".base_url("index.php/absen/import")."'>";

		// Buat sebuah div untuk alert validasi kosong
		echo "<div style='color: red;' id='kosong'>
		</div>";

		echo "<table class='table table-bordered'>
		<tr>
			<th colspan='5'>Preview Data</th>
		</tr>
		<tr>
			<th>Kode Karyawan</th>
			<th>Tgl</th>
			<th>Jam Masuk</th>
			<th>Jam Pulang</th>
		</tr>";

		$numrow = 1;
		$kosong = 0;

		// Lakukan perulangan dari data yang ada di excel
		// $sheet adalah variabel yang dikirim dari controller
		foreach($sheet as $row){
			// Ambil data pada excel sesuai Kolom
			$kode_karyawan = $row['A'];
			$tgl = $row['B'];
			$jam_masuk = $row['C'];
			$jam_pulang = $row['D'];

			// Cek jika semua data tidak diisi
			if($kode_karyawan == "")
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Validasi apakah semua data telah diisi
				$kode_karyawan_td = ( ! empty($kode_karyawan))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
				$tgl_td = ( ! empty($tgl))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
				$jam_masuk_td = ( ! empty($jam_masuk))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
				$jam_pulang_td = ( ! empty($jam_pulang))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

				// Jika salah satu data ada yang kosong
				if($kode_karyawan == "" or $jam_masuk == "" or $jam_pulang == ""){
					$kosong++; // Tambah 1 variabel $kosong
				}
				//$jadwal = date('H:i:s', mktime(0,0,0, date('H')-1, date('i'), date('s')));
				$jadwal = strtotime('08:00:00');
				$jam_masuk_a = strtotime($row['C']);
				$diff = $jam_masuk_a-$jadwal;
				if($jam_masuk_a<$jadwal){
					$potongan = 0;
				} else {
					$potongan   = floor($diff / (60 * 60))*5000;
				}

				echo "<tr>";
				echo "<td".$kode_karyawan_td.">".$kode_karyawan."</td>";
				echo "<td".$tgl_td.">".$tgl."</td>";
				echo "<td".$jam_masuk_td.">".$jam_masuk."</td>";
				echo "<td".$jam_pulang_td.">".$jam_pulang."</td>";
				echo "<td>".$potongan."</td>";
				echo "</tr>";
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		echo "</table>";

		// Cek apakah variabel kosong lebih dari 0
		// Jika lebih dari 0, berarti ada data yang masih kosong
		if($kosong > 0){
		?>
			<script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');

				$("#kosong").show(); // Munculkan alert validasi kosong
			});
			</script>
		<?php
		}else{ // Jika semua data sudah diisi
			echo "<hr>";

			// Buat sebuah tombol untuk mengimport data ke database
			
			echo "<button type='submit' class='btn btn-danger'><i class='fa fa-floppy-o'></i>Import</button> ";
			echo "<a href='".base_url("absen")."'>Cancel</a>";
		}

		echo "</form>";
	}
	?>
 		</table>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>