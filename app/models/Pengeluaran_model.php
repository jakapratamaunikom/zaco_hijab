<?php
	function get_all_pengeluaran($koneksi, $config_db){
		$query = get_dataTable($config_db);
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data edit pengeluaran
	function get_pengeluaran_by_id($koneksi, $id){
		$query = "SELECT * FROM pengeluaran WHERE id=:id";
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data edit detail penjualan
	function get_detail_pengeluaran_by_id($koneksi, $id){
		$query = "SELECT dp.id, dp.kd_pengeluaran, dp.ket, dp.nominal, ";
		$query .= "dp.qty, dp.subtotal ";
		$query .= "FROM detail_pengeluaran dp JOIN pengeluaran p ON p.id=dp.kd_pengeluaran ";
		$query .= "WHERE dp.kd_pengeluaran= :id ORDER BY dp.id ASC";
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	function get_kd_pengeluaran($koneksi){
		$kode = date("Y").date("m").date("d");
		$query = "SELECT kd_pengeluaran FROM pengeluaran WHERE kd_pengeluaran LIKE '%".$kode."%' ORDER BY id desc LIMIT 1";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);
		
		return $result;
	}

	// insert data penjualan
	function insertPengeluaran($koneksi, $data){
		// $username = "admin";

		$query = "INSERT INTO pengeluaran ";
		$query .= "(kd_pengeluaran, tgl, jenis, user) ";
		$query .= "VALUES (:kd_pengeluaran, :tgl, :jenis, :user);";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_pengeluaran',$data['kd_pengeluaran']);
		$statement->bindParam(':tgl',$data['tgl']);
		$statement->bindParam(':jenis',$data['jenis']);
		$statement->bindParam(':user',$data['user']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	function insertDetail_pengeluaran($koneksi, $data){
		$query = "CALL tambah_pengeluaran ";
		$query .= "(:kd_pengeluaran, :ket, :nominal, :qty, :subtotal)";
		
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_pengeluaran',$data['kd_pengeluaran']);
		$statement->bindParam(':ket',$data['ket']);
		$statement->bindParam(':nominal',$data['nominal']);
		$statement->bindParam(':qty',$data['qty']);
		$statement->bindParam(':subtotal',$data['subTotal']);
		$result = $statement->execute();		
		tutup_koneksi($koneksi);

		return $result;
	}

	function updatePengeluaran($koneksi, $data){
		$query = "UPDATE pengeluaran SET tgl=:tgl, jenis=:jenis WHERE id=:id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':tgl', $data['tgl']);
		$statement->bindParam(':jenis', $data['jenis']);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	function updateDetail_pengeluaran($koneksi, $data){
		$query = "UPDATE detail_pengeluaran SET ket=:ket, nominal=:nominal, qty=:qty, subtotal=:subtotal WHERE id=:id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':ket', $data['ket']);
		$statement->bindParam(':nominal', $data['nominal']);
		$statement->bindParam(':qty', $data['qty']);
		$statement->bindParam(':subtotal', $data['subTotal']);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	function deleteDetail_pengeluaran($koneksi, $data){
		$query = "DELETE FROM detail_pengeluaran WHERE id=:id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}