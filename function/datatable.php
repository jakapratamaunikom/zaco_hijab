<?php
	/*
		Function setQuery
		=> men-setting query yang akan digunakan untuk proses server-side
		=> prosesnya select * --> tambahkan where jika ada req. cari
			--> tambahkan order by jika ada req. order
		=> mengembalikan nilai query yg telah di racik sesuai dgn req dari datatable
		=> paramater yg dibutuhkan:
			-> $tabel = tabel mana yg akan di eksekusi
			-> $kolomOrder = array yg isinya kolom2 yg ada di datatable
			-> $kolomCari = array yg isinya kolom2 yg bisa dicari
			-> $orderBy = array yg isinya kolom2 yg bisa di order
	*/
	function setQuery($tabel, $kolomOrder, $kolomCari, $orderBy){
		// inisialisasi request datatable
		$search = isset($_POST['search']['value']) ? $_POST['search']['value'] : false;
		$order = isset($_POST['order']) ? $_POST['order'] : false;

		$query = "SELECT * FROM $tabel ";

		// jika ada request pencarian
		$qWhere = "";
		$i = 0;
		foreach($kolomCari as $cari){
			if($search){
				if($i === 0) $qWhere .= 'WHERE '.$cari.' LIKE "%'.$search.'%" ';
				else $qWhere .= 'OR '.$cari.' LIKE "%'.$search.'%"';
			}
			$i++;
		}

		// jika ada request order
		$qOrder = "";
		if($order) $qOrder = 'ORDER BY '.$kolomOrder[$order[0]['column']].' '.$order[0]['dir'].' ';
		else $qOrder = 'ORDER BY '.key($orderBy).' '.$orderBy[key($orderBy)]; // order default

		$query .= "$qWhere $qOrder ";

		return $query;	
	}

	/*
		Function get_dataTable
		=> fungsi lanjutan dari function setQuery
		=> fungsi untuk men-setting query final
		=> intinya yg menentukan pagination sesuai dari req.
	*/
	function get_dataTable($config_db){
		$query = setQuery($config_db['tabel'], $config_db['kolomOrder'], $config_db['kolomCari'], $config_db['orderBy']);
		
		$qLimit = "";
		if($_POST['length'] != -1) $qLimit .= 'LIMIT '.$_POST['start'].', '.$_POST['length'];
		
		$query .= "$qLimit";

		return $query;
	}

	/*
		Function recordFilter
		=> fungsi untuk mendapatkan jumlah baris yg terfilter dari query
	*/
	function recordFilter($koneksi, $config_db){
		$query = setQuery($config_db['tabel'], $config_db['kolomOrder'], $config_db['kolomCari'], $config_db['orderBy']);
		$statement = $koneksi->prepare($query);
		$statement->execute();

		return $statement->rowCount();
	}

	/*
		Function recordTotal
		=> fungsi untuk mendapatkan jumlah seluruh baris/data di suatu tabel
	*/
	function recordTotal($koneksi, $tabel){
		$statement = $koneksi->query("SELECT COUNT(*) FROM $tabel")->fetchColumn();

		return $statement;
	}