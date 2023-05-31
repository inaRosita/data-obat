<?php
class Obat extends Database {
	public function tampil(){
		// 1. mysqli_query
		$sql=$this->mysqli->query("SELECT * FROM obat") or die ($this->CekError());
		while($data=$sql->fetch_object()){
			$dataObat[]=$data;
		}
		// 2. jika datanya ada
		if(isset($dataObat)){
		// 3. memberikan nilai balik atas data yang diambil dari db
		return $dataObat;
		}
		// 4. menutup koneksi db,procedural== mysqli_close()
		$this->TutupKoneksi();
		}
	public function detail($id_obat){
		// 1. mysqli_query
		$sql=$this->mysqli->query("SELECT * FROM obat WHERE id_obat='".$id_obat."'") or die ($this->CekError());
		$dataObat=$sql->fetch_object();
		// 2. jika datanya ada
		if(isset($dataObat)){
		// memberikan nilai balik atas data yang diambil dari db
		return $dataObat;
		}
		// 3. menutup koneksi db,procedural== mysqli_close()
		$this->TutupKoneksi();
		}
	function update($id_obat,$data){
		// 1. memecah array menjadi string
		$script_update_temp=null;
		foreach($data as $field=>$value){
		$script_update_temp .= $field."='".$value."',";
		}
		// 2. menghilangkan tanda koma pada akhir string
		$script_update=rtrim($script_update_temp,',');
		// 3. menghilangkan tanda koma pada akhir string
		$this->mysqli->query("UPDATE obat SET ".$script_update."WHERE id_obat='".$id_obat."'") or die ($this->CekError());
		// 4. tutup koneksi
		$this->TutupKoneksi();
		}
	function hapus($id_obat){
		// 1. Jalankan perintah delete query
		$this->mysqli->query("DELETE FROM obat WHERE id_obat='$id_obat'");
		// 2. tutup koneksi
		$this->TutupKoneksi();
		}
	function simpan($data){
		// 1. membuat 2 kolom bantu
		$kolom_nya=null;
		$nilai_nya=null;
		// 2. memecah antara kolom dan nilai
		foreach($data as $kolom=>$nilai){
		$kolom_nya .= $kolom.",";
		$nilai_nya .= "'".$nilai."',";
		}
		// 3. menghilangkan tanda koma pada masing2 variabel, untuk mengindari error mysql
		$kolom_nya_baru=rtrim($kolom_nya,',');
		$nilai_nya_baru=rtrim($nilai_nya,',');
		// 4. membuat syntax sql untuk simpan
		$sql_simpan="INSERT INTO obat (".$kolom_nya_baru.") VALUES (".$nilai_nya_baru.")";
		// 5. menjalankan perintah sql diatas dan mencek error
		$this->mysqli->query($sql_simpan) or die ($this->CekError());
		// 6. close koneksi
		$this->TutupKoneksi();
	}
}
?>