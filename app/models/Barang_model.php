<?php
	// get all data barang
	function get_all_barang($koneksi, $config_db){
		$query = get_dataTable($config_db);
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data edit barang
	function get_barang_by_id($koneksi, $id){
		$query = "SELECT b.id, b.id_barang, ib.id_barang id_idBarang, ib.nama nama_idBarang, b.id_warna, iw.id_warna id_idWarna, iw.nama nama_idWarna, ";
		$query .= "concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, b.nama, hpp, harga_pasar, market_place, harga_ig, foto, ket ";
		$query .= "FROM barang b JOIN id_barang ib ON ib.id = b.id_barang ";
		$query .= "JOIN id_warna iw ON iw.id = b.id_warna ";
		$query .= "WHERE b.id = :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	// get ket barang
	function get_ket_barang($koneksi){
		$query = "SELECT id, nama, stok FROM v_barang";
		
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	function get_barang_reject($koneksi, $id_barang){
		$query = "SELECT id, nama, stok FROM v_barang WHERE id_barang = :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id_barang);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get harga barang
	function get_harga_barang($koneksi, $id){
		$query = "SELECT hpp, harga_pasar, market_place, harga_ig FROM v_barang WHERE id=:id";
		
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	// get max stok barang
	function get_stok_by_id($koneksi, $id){
		$query = "SELECT stok FROM v_barang WHERE id=:id";
		
		$statement = $koneksi->prepare($query);
		$statement->bindParam(":id", $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	// insert barang
	function insertBarang($koneksi, $data){
		$tgl = date("Y-m-d");
		$query = "CALL tambah_barang(
			:id_barang, :id_warna, :nama, :hpp, :harga_pasar, 
			:market_place, :harga_ig, :foto, :ket, :status, :tgl, :stokAwal)";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id_barang', $data['id_barang']);
		$statement->bindParam(':id_warna', $data['id_warna']);
		$statement->bindParam(':nama', $data['nama']);
		$statement->bindParam(':hpp', $data['hpp']);
		$statement->bindParam(':harga_pasar', $data['harga_pasar']);
		$statement->bindParam(':market_place', $data['market_place']);
		$statement->bindParam(':harga_ig', $data['harga_ig']);
		$statement->bindParam(':foto', $data['foto']);
		$statement->bindParam(':ket', $data['ket']);
		$statement->bindParam(':status', $data['status']);
		$statement->bindParam(':tgl', $tgl);
		$statement->bindParam(':stokAwal', $data['stokAwal']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// update barang
	function updateBarang($koneksi, $data){
		$query = "UPDATE barang SET nama=:nama, ket=:ket, hpp=:hpp, harga_pasar=:harga_pasar, market_place=:market_place, harga_ig=:harga_ig WHERE id = :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':nama', $data['nama']);
		$statement->bindParam(':hpp', $data['hpp']);
		$statement->bindParam(':harga_pasar', $data['harga_pasar']);
		$statement->bindParam(':market_place', $data['market_place']);
		$statement->bindParam(':harga_ig', $data['harga_ig']);
		$statement->bindParam(':ket', $data['ket']);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// update status barang
	function updateStatusBarang($koneksi, $id, $status){
		$query = "UPDATE barang SET status=:status WHERE id = :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':status', $status);
		$statement->bindParam(':id', $id);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get foto barang by id
	function get_foto_by_id($koneksi, $id){
		$query = "SELECT foto FROM barang WHERE id = :id";
		
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	// update foto barang by id
	function updateFoto($koneksi, $data){
		$query = "UPDATE barang SET foto=:foto WHERE id=:id";
		
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':foto', $data['foto']);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}