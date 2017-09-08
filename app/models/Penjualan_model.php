<?php
	// get all data penjualan
	function get_all_penjualan($koneksi, $config_db){
		$query = get_dataTable($config_db);
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data view penjualan
	function get_penjualan_view($koneksi, $id){

	}

	// get data view detail penjualan
	function get_detail_view($koneksi, $id){

	}

	// get data edit penjualan
	function get_penjualan_by_id($koneksi, $id){
		$query = "SELECT * FROM penjualan WHERE id=:id";
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data edit detail penjualan
	function get_detail_by_id($koneksi, $id){
		$query = "SELECT dp.id, dp.kd_penjualan, dp.kd_barang, b.nama, dp.hpp, dp.harga, ";
		$query .= "dp.qty, dp.jenis_diskon, dp.diskon, dp.subtotal, dp.ket ";
		$query .= "FROM detail_penjualan dp JOIN penjualan p ON p.id=dp.kd_penjualan ";
		$query .= "JOIN barang b ON b.id=dp.kd_barang WHERE dp.kd_penjualan= :id ORDER BY dp.id ASC";
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get kd penjualan
	function get_kd_penjualan($koneksi){
		$kode = date("Y").date("m").date("d");
		$query = "SELECT kd_penjualan FROM penjualan WHERE kd_penjualan LIKE '%".$kode."%' ORDER BY kd_penjualan desc LIMIT 1";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);
		
		return $result;
	}

	// insert data penjualan
	function insertPenjualan($koneksi, $data){
		$ket = "";
		$ongkir = 0;
		$username = "admin";

		$query = "INSERT INTO penjualan ";
		$query .= "(kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) ";
		$query .= "VALUES (:kd_penjualan, :tgl, :jenis, :nama, :telp, :alamat, :ongkir, :status, :ket, :username);";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_penjualan',$data['kd_penjualan']);
		$statement->bindParam(':tgl',$data['tgl']);
		$statement->bindParam(':jenis',$data['jenis']);
		$statement->bindParam(':nama',$data['nama']);
		$statement->bindParam(':telp',$data['no_telp']);
		$statement->bindParam(':alamat',$data['alamat']);
		$statement->bindParam(':ongkir',$ongkir);
		$statement->bindParam(':status',$data['status']);
		$statement->bindParam(':ket',$ket);
		$statement->bindParam(':username',$username);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// insert data detail_penjualan
	function insertDetail_penjualan($koneksi, $data){
		$laba = $data['harga']-$data['hpp'];

		$query = "CALL tambah_penjualan ";
		$query .= "(:kd_penjualan, :tgl, :kd_barang, :hpp, :harga, ";
		$query .= ":qty, :jenisDiskon, :diskon, :subtotal, :laba, :ket)";
		
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_penjualan',$data['kd_penjualan']);
		$statement->bindParam(':tgl',$data['tgl']);
		$statement->bindParam(':kd_barang',$data['kd_barang']);
		$statement->bindParam(':hpp',$data['hpp']);
		$statement->bindParam(':harga',$data['harga']);
		$statement->bindParam(':qty',$data['qty']);
		$statement->bindParam(':jenisDiskon',$data['jenisDiskon']);
		$statement->bindParam(':diskon',$data['diskon']);
		$statement->bindParam(':subtotal',$data['subTotal']);
		$statement->bindParam(':laba',$laba);
		$statement->bindParam(':ket',$data['ket']);
		$result = $statement->execute();		
		tutup_koneksi($koneksi);

		return $result;
	}

	// update penjualan
	function updatePenjualan($koneksi, $data){
		$ket = "";
		$ongkir = 0;

		$query = "UPDATE penjualan SET tgl= :tgl, jenis= :jenis, nama= :nama, telp= :telp, ";
		$query .= "alamat= :alamat, ongkir= :ongkir, status= :status, ket= :ket ";
		$query .= "WHERE id= :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':tgl', $data['tgl']);
		$statement->bindParam(':jenis', $data['jenis']);
		$statement->bindParam(':nama', $data['nama']);
		$statement->bindParam(':telp', $data['no_telp']);
		$statement->bindParam(':alamat', $data['alamat']);
		$statement->bindParam(':ongkir', $ongkir);
		$statement->bindParam(':status', $data['status']);
		$statement->bindParam(':ket', $ket);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// update detail penjualan
	function updateDetail_penjualan($koneksi, $data){
		$laba = $data['harga']-$data['hpp'];

		$query = "CALL edit_penjualan ";
		$query .= "(:kd_penjualan, :id_detail, :tgl, :kd_barang, :hpp, :harga, ";
		$query .= ":qty, :jenisDiskon, :diskon, :subtotal, :laba, :ket)";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_penjualan',$data['kd_penjualan']);
		$statement->bindParam(':id_detail',$data['id']);
		$statement->bindParam(':tgl',$data['tgl']);
		$statement->bindParam(':kd_barang',$data['kd_barang']);
		$statement->bindParam(':hpp',$data['hpp']);
		$statement->bindParam(':harga',$data['harga']);
		$statement->bindParam(':qty',$data['qty']);
		$statement->bindParam(':jenisDiskon',$data['jenisDiskon']);
		$statement->bindParam(':diskon',$data['diskon']);
		$statement->bindParam(':subtotal',$data['subTotal']);
		$statement->bindParam(':laba',$laba);
		$statement->bindParam(':ket',$data['ket']);
		$result = $statement->execute();		
		tutup_koneksi($koneksi);

		return $result;
	}