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

	//fungsi format rupiah
	function rupiah($harga){
		$string = "Rp. ".number_format($harga,2,",",".");
		return $string;
	}

	//fungsi format tgl indo
	function cetakTgl($tgl, $full = false){
		//array hari
		$arrHari = array(
					1 => "Senin",
					2 => "Selasa",
					3 => "Rabu",
					4 => "Kamis",
					5 => "Jumat",
					6 => "Sabtu",
					7 => "Minggu",
				);
		//array bulan
		$arrBulan = array(
					1 => "Januari",
					2 => "Februari",
					3 => "Maret",
					4 => "April",
					5 => "Mei",
					6 => "Juni",
					7 => "Juli",
					8 => "Agustus",
					9 => "September",
					10 => "Oktober",
					11 => "November",
					12 => "Desember",
				);

		if($full){
			//explode $tgl
			$split = explode("-", $tgl);
			$getTahun = $split[0]; //get tgl
			$getBulan = $split[1]; //get bulan
			$getTgl = explode(" ", $split[2]); //explode tahun, karna menyatu dgn jam
			$getJam = $getTgl[1]; //get jam
			$getTgl = $getTgl[0]; //get tahun

			$tgl_indo = $getTgl." ".$arrBulan[(int)$getBulan]." ".$getTahun; //format dd bulan tahun
			$num = date('N', strtotime($tgl)); //get tgl untuk disesuaikan dgn hari
			$cetak_tgl = $arrHari[$num].", ".$tgl_indo." Jam ".$getJam;
		}
		else{
			//explode $tgl
			$split = explode("-", $tgl);
			$getTgl = $split[2]; //get tgl
			$getBulan = $split[1]; //get bulan
			$getTahun = $split[0]; //get tahun

			$tgl_indo = $getTgl." ".$arrBulan[(int)$getBulan]." ".$getTahun; //format dd bulan tahun
			$num = date('N', strtotime($tgl)); //get tgl untuk disesuaikan dgn hari
			$cetak_tgl = $arrHari[$num].", ".$tgl_indo;
		}

		return $cetak_tgl; 
	}