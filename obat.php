<?php
// membuat instance
$dataObat=NEW Obat;
// aksi tampil data
if($_GET['aksi']=='tampil'){
	// aksi untuk tampil data
	$html = null;
	$html .='<h3>Daftar Obat</h3>';
	$html .='<p>Berikut Ini Data Obat Apotik</p>';
	$html .='<table border="1" width="100%">
	<p>
	<a href="index.php?file=obat&aksi=tambah">Tambah Data Obat</a>
	</p>
	<thead>
	<th>No.</th>
	<th>Id Obat</th>
	<th>Nama Obat</th>
	<th>Deskripsi Obat</th>
	<th>Aksi</th>
	</thead>
	<tbody>';
	// variabel $data menyimpan hasil return
	$data = $dataObat->tampil();
	$no=null;
	if(isset($data)){
		foreach($data as $barisObat){
			$no++;
			$html .='<tr>
			<td>'.$no.'</td>
			<td>'.$barisObat->id_obat.'</td>
			<td>'.$barisObat->nama_obat.'</td>
			<td>'.$barisObat->deskripsi.'</td>
			<td>
			<a href="index.php?file=obat&aksi=edit&id_obat='.$barisObat->id_obat.'"> Edit </a>
			<a href="index.php?file=obat&aksi=hapus&id_obat='.$barisObat->id_obat.'"> Hapus </a>
			</td>
			</tr>';
		}
	}
	$html .='</tbody>
	</table>';
	echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='tambah') {
	$html =null;
	$html .='<h3>Form Tambah</h3>';
	$html .='<p>Silahkan Isi Form Dibawah Ini</p>';
	$html .='<form method="POST" action="index.php?file=obat&aksi=simpan">';
	$html .='<p>Id Obat<br/>';
	$html .='<input type="text" name="txtIdObat" placeholder="Masukan Id Obat" autofocus/></p>';
	$html .='<p>Nama Obat<br/>';
	$html .='<input type="text" name="txtNamaObat" placeholder="Masukan Nama Obat" size="30" required/></p>';
	$html .='<p>Deskripsi Obat<br/>';
	$html .='<input type="text" name="txtDeskripsi" placeholder="Masukan Deskripsi Obat" size="30" required/>,';
	$html .='<p><input type="submit" name="tombolSimpan" value="Simpan"/></p>';
	$html .='</form>';
	echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='simpan') {
	$data=array(
	'id_obat'=>$_POST['txtIdObat'],
	'nama_obat'=>$_POST['txtNamaObat'],
	'deskripsi'=>$_POST['txtDeskripsi']
	);
	// simpan obat dengan menjalankan method simpan
	$dataObat->simpan($data);
	echo '<meta http-equiv="refresh" content="0;
	url=index.php?file=obat&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='edit') {
	// ambil data obat
	$obat=$dataObat->detail($_GET['id_obat']);
		$html =null;
		$html .='<h3>Form Tambah</h3>';
		$html .='<p>Silahkan masukan form </p>';
		$html .='<form method="POST" action="index.php?file=obat&aksi=update">';
		$html .='<p>Id Obat<br/>';
		$html .='<input type="text" name="txtIdObat" value="'.$obat->id_obat.'" placeholder="Masukan Id Obat" /></p>';
		$html .='<p>Nama Obat<br/>';
		$html .='<input type="text" name="txtNamaObat" value="'.$obat->nama_obat.'" placeholder="Masukan Nama Obat" size="30" required autofocus/></p>';
		$html .='<p>Deskripsi Obat<br/>';
		$html .='<input type="text" name="txtDeskripsi" value="'.$obat->deskripsi.'" placeholder="Masukan Deskripsi Obat" size="30" required/></p>';
		$html .='<p><input type="submit" name="tombolSimpan" value="Simpan"/></p>';
		$html .='</form>';
		echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='update') {
	$data=array(
	'id_obat'=>$_POST['txtIdObat'],
	'nama_obat'=>$_POST['txtNamaObat'],
	'deskripsi'=>$_POST['txtDeskripsi']
	);
	$dataObat->update($_POST['txtIdObat'],$data);
	echo '<meta http-equiv="refresh" content="0;
	url=index.php?file=obat&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='hapus') {
	$dataObat->hapus($_GET['id_obat']);
	echo '<meta http-equiv="refresh" content="0;
	url=index.php?file=obat&aksi=tampil">';
}
// aksi tidak terdaftar
else {
	echo '<p>Error 404 : Halaman tidak ditemukan !</p>';
}
?>