<?php
	// get all data pembelian
	function get_all_pembelian($koneksi, $config_db){
		$query = get_dataTable($config_db);
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data view pembelian
	function get_pembelian_view($koneksi, $id){

	}

	// get data view detail pembelian
	function get_detail_view($koneksi, $id){

	}

	// insert data pembelian
	function insertPembelian($koneksi, $data){
		$username = "admin";

		$query = "INSERT INTO pembelian(kd_pembelian, tgl, ket, username) VALUES(:kd_pembelian, :tgl, :ket, :username);";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_pembelian', $data['kd_pembelian']);
		$statement->bindParam(':tgl', $data['tgl']);
		$statement->bindParam(':ket', $data['ket']);
		$statement->bindParam(':username', $username);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// insert detail pembelian
	function insertDetail_pembelian($koneksi, $data){
		$query = "CALL tambah_pembelian(:kd_pembelian, :tgl, :kd_barang, :harga, :qty, :subtotal, :ket)";
	
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_pembelian', $data['kd_pembelian']);
		$statement->bindParam(':tgl', $data['tgl']);
		$statement->bindParam(':kd_barang', $data['kd_barang']);
		$statement->bindParam(':harga', $data['harga']);
		$statement->bindParam(':qty', $data['qty']);
		$statement->bindParam(':subtotal', $data['subTotal']);
		$statement->bindParam(':ket', $data['ket']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get kd pembelian
	function get_kd_pembelian($koneksi){
		$kode = date("Y").date("m").date("d");
		$query = "SELECT kd_pembelian FROM pembelian WHERE kd_pembelian LIKE '%".$kode."%' ORDER BY id desc LIMIT 1";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);
		
		return $result;
	}
	