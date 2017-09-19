<?php
	// get all data barang
	function get_all_admin($koneksi, $config_db){
		$query = get_dataTable($config_db);
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// insert barang
	function insertAdmin($koneksi, $data){
		$status = "1";
		$query = "INSERT INTO admin (username, password, nama, email, telp, alamat, foto, level, status) VALUES (:username, :password, :nama, :email, :telp, :alamat, :foto, :level, :status)";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':username', $data['username']);
		$statement->bindParam(':password', $data['password']);
		$statement->bindParam(':nama', $data['nama']);
		$statement->bindParam(':email', $data['email']);
		$statement->bindParam(':telp', $data['telp']);
		$statement->bindParam(':alamat', $data['alamat']);
		$statement->bindParam(':foto', $data['foto']);
		$statement->bindParam(':level', $data['level']);
		$statement->bindParam(':status', $status);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}