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

	// get data edit pembelian
	function get_pembelian_by_id($koneksi, $id){
		$query = "SELECT * FROM pembelian WHERE id=:id";
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	// get data edit detail penjualan
	function get_detail_pembelian_by_id($koneksi, $id){
		$query = "SELECT dp.id, dp.kd_pembelian, dp.kd_barang, b.nama, dp.harga, ";
		$query .= "dp.qty, dp.subtotal, dp.ket ";
		$query .= "FROM detail_pembelian dp JOIN pembelian p ON p.id=dp.kd_pembelian ";
		$query .= "JOIN barang b ON b.id=dp.kd_barang WHERE dp.kd_pembelian= :id ORDER BY dp.id ASC";
		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	function get_ket_pembelian($koneksi, $date, $ket){
		$bulan = $date['bulan'];
		$tahun = $date['tahun'];
		switch (strtolower($ket)) {
			// total penjualan
			case 'total_pembelian':
				$select = "SUM(total) total, MONTH(tgl) bulan, YEAR(tgl) tahun";
				break;

			// total transaksi penjualan
			default:
				$select = "COUNT(*) total, MONTH(tgl) bulan, YEAR(tgl) tahun";
				break;
		}

		$query = "SELECT $select FROM v_pembelian WHERE MONTH(tgl) = :bulan AND YEAR(tgl) = :tahun ORDER BY MONTH(tgl)";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':bulan', $bulan);
		$statement->bindParam(':tahun', $tahun);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	// insert data pembelian
	function insertPembelian($koneksi, $data){
		$query = "INSERT INTO pembelian(kd_pembelian, tgl, ket, user) VALUES(:kd_pembelian, :tgl, :ket, :user);";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_pembelian', $data['kd_pembelian']);
		$statement->bindParam(':tgl', $data['tgl']);
		$statement->bindParam(':ket', $data['ket']);
		$statement->bindParam(':user', $data['user']);
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

	// update pembelian
	function updatePembelian($koneksi, $data){
		$ket = "";
		$ongkir = 0;

		$query = "UPDATE pembelian SET tgl= :tgl, ket= :ket WHERE id= :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':tgl', $data['tgl']);
		$statement->bindParam(':ket', $ket);
		$statement->bindParam(':id', $data['id']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// update detail pembelian
	function updateDetail_pembelian($koneksi, $data){
		$query = "CALL edit_pembelian ";
		$query .= "(:kd_pembelian, :id_detail, :tgl, :kd_barang, :harga, ";
		$query .= ":qty, :subtotal, :ket)";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_pembelian',$data['kd_pembelian']);
		$statement->bindParam(':id_detail',$data['id']);
		$statement->bindParam(':tgl',$data['tgl']);
		$statement->bindParam(':kd_barang',$data['kd_barang']);
		$statement->bindParam(':harga',$data['harga']);
		$statement->bindParam(':qty',$data['qty']);
		$statement->bindParam(':subtotal',$data['subTotal']);
		$statement->bindParam(':ket',$data['ket']);
		$result = $statement->execute();		
		tutup_koneksi($koneksi);

		return $result;
	}

	// hapus detail pembelian
	function deleteDetail_pembelian($koneksi, $data){
		$query = "CALL hapus_pembelian ";
		$query .= "(:id_detail, :kd_barang, :tgl, :qty)";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':id_detail',$data['id']);
		$statement->bindParam(':kd_barang',$data['kd_barang']);
		$statement->bindParam(':tgl',$data['tgl']);
		$statement->bindParam(':qty',$data['qty']);
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
	