<?php
	// get all data id barang
	function get_all_id_barang($koneksi, $config_db){
		$query = get_dataTable($config_db);

		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data edit
	function get_idBarang_by_id($koneksi, $id){
		$query = "SELECT id, id_barang, nama FROM id_barang WHERE id = :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	//insert id barang
	function insertIdBarang($koneksi, $data){
		$query = "INSERT INTO id_barang (id_barang, nama) VALUES (:id_barang, :nama)";
		
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id_barang', $data['id_barang']);
		$statement->bindParam(':nama', $data['nama']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// update data id barang
	function updateIdBarang($koneksi, $data){
		$query = "UPDATE id_barang SET nama = :nama WHERE id = :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':nama', $data['nama']);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}