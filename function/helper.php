<?php
	define("base_url", "http://localhost/zaco_hijab/");
	define("version", "Alpha v0.1");

	/* 
		fungsi cek duplikat
		=> akan mengembalikan nilai true jika ada yg duplikat
		=> false jika tidak ada yg duplikat
		=> $config_db berupa array yg isinya:
			--> index tabel = tabel mana yg akan di cek
			--> index field = field mana yg akan di cek
			--> index value = nilai dari field yg akan di cek
	*/
	function cekDuplikat($koneksi, $config_db){
		$tabel = $config_db['tabel'];
		$field = $config_db['field'];
		$value = $config_db['value'];

		$query = "SELECT COUNT(*) FROM $tabel WHERE $field=?";

		// prepare
		$statement = $koneksi->prepare($query);
		// bind
		$statement->bindParam(1, $value);
		// execute
		$statement->execute();
		$result = $statement->fetch();

		if($result[0] > 0) $cek = true; // jika duplikat
		else $cek = false; // jika tidak

		return $cek;
	}