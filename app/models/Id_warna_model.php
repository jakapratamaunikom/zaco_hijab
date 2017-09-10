<?php
	// get all data id barang
	function get_all_id_warna($koneksi, $config_db){
		$query = get_dataTable($config_db);

		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data edit
	function get_idWarna_by_id($koneksi, $id){
		$query = "SELECT id, id_warna, nama FROM id_warna WHERE id = :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	//insert id barang
	function insertIdWarna($koneksi, $data){
		$query = "INSERT INTO id_warna (id_warna, nama) VALUES (:id_warna, :nama)";
		
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id_warna', $data['id_warna']);
		$statement->bindParam(':nama', $data['nama']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// update data id barang
	function updateIdWarna($koneksi, $data){
		$query = "UPDATE id_warna SET nama = :nama WHERE id = :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':nama', $data['nama']);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}