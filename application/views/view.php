<html>
<head>
	<title>IMPORT EXCEL CI 3</title>
</head>
<body>
	<h1>Data absen</h1><hr>
	<a href="<?php echo base_url("index.php/absen/form"); ?>">Import Data</a><br><br>

	<table border="1" cellpadding="8">
	<tr>
		<th>Kode Karyawan</th>
		<th>Jam Asli</th>
		<th>Jam Masuk</th>
		<th>Jam Keluar</th>
		<th>Jam Pulang</th>
	</tr>

	<?php
	if( ! empty($absen)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
		foreach($absen as $data){ // Lakukan looping pada variabel absen dari controller
			echo "<tr>";
			echo "<td>".$data->kode_karyawan."</td>";
			echo "<td>".$data->jam_asli_masuk."</td>";
			echo "<td>".$data->jam_masuk_kantor."</td>";
			echo "<td>".$data->jam_keluar_kantor."</td>";
			echo "<td>".$data->jam_pulang_kantor."</td>";
			echo "</tr>";
		}
	}else{ // Jika data tidak ada
		echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
	}
	?>
	</table>
</body>
</html>
