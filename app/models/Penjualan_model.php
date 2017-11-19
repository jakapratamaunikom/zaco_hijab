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
	function get_detail_penjualan_by_id($koneksi, $id){
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

	function get_ket_penjualan($koneksi, $date, $ket){
		$bulan = $date['bulan'];
		$tahun = $date['tahun'];
		switch (strtolower($ket)) {
			// total penjualan
			case 'total_penjualan':
				$select = "SUM(total) total, MONTH(tgl) bulan, YEAR(tgl) tahun";
				break;

			// total transaksi penjualan
			case 'transaksi_penjualan':
				$select = "COUNT(*) total, MONTH(tgl) bulan, YEAR(tgl) tahun";
				break;
			
			// total laba
			default:
				$select = "SUM(total_laba) total_laba";
				break;
		}

		$query = "SELECT $select FROM v_penjualan WHERE MONTH(tgl) = :bulan AND YEAR(tgl) = :tahun ORDER BY MONTH(tgl)";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':bulan', $bulan);
		$statement->bindParam(':tahun', $tahun);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		tutup_koneksi($koneksi);

		return $result;
	}

	function get_penjualan_laba($koneksi, $tahun){
		$query = "SELECT MONTH(tgl) bulan, SUM(total) total_penjualan, SUM(total_laba) total_laba FROM v_penjualan WHERE YEAR(tgl) = :tahun GROUP BY MONTH(tgl)";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':tahun', $tahun);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	// function get_ket_penjualan_item($koneksi, $date){
	// 	$bulan = $date['bulan'];
	// 	$tahun = $date['tahun'];
	// 	$query = "SELECT dp.kd_barang, SUM(dp.qty) jumlah FROM penjualan p JOIN detail_penjualan dp ON dp.kd_penjualan = p.id WHERE MONTH(p.tgl) = :bulan AND YEAR(p.tgl) = :tahun GROUP BY dp.kd_barang ORDER BY jumlah DESC";

	// 	$statement = $koneksi->prepare($query);
	// 	$statement->bindParam(':bulan', $bulan);
	// 	$statement->bindParam(':tahun', $tahun);
	// 	$statement->execute();
	// }

	// get kd penjualan
	function get_kd_penjualan($koneksi){
		$kode = date("Y").date("m").date("d");
		$query = "SELECT kd_penjualan FROM penjualan WHERE kd_penjualan LIKE '%".$kode."%' ORDER BY id desc LIMIT 1";

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
		// $username = "admin";

		$query = "INSERT INTO penjualan ";
		$query .= "(kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, user) ";
		$query .= "VALUES (:kd_penjualan, :tgl, :jenis, :nama, :telp, :alamat, :ongkir, :status, :ket, :user);";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':kd_penjualan',$data['kd_penjualan']);
		$statement->bindParam(':tgl',$data['tgl']);
		$statement->bindParam(':jenis',$data['jenis']);
		$statement->bindParam(':nama',$data['nama']);
		$statement->bindParam(':telp',$data['no_telp']);
		$statement->bindParam(':alamat',$data['alamat']);
		$statement->bindParam(':ongkir',$data['ongkir']);
		$statement->bindParam(':status',$data['status']);
		$statement->bindParam(':ket',$data['ket']);
		$statement->bindParam(':user',$data['user']);
		$result = $statement->execute();
		tutup_koneksi($koneksi);

		return $result;
	}

	// insert data detail_penjualan
	function insertDetail_penjualan($koneksi, $data){
		$laba = $data['subTotal']-($data['hpp']*$data['qty']);

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
		// $ket = "";
		// $ongkir = 0;

		$query = "UPDATE penjualan SET tgl= :tgl, jenis= :jenis, nama= :nama, telp= :telp, ";
		$query .= "alamat= :alamat, ongkir= :ongkir, status= :status, ket= :ket ";
		$query .= "WHERE id= :id";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':tgl', $data['tgl']);
		$statement->bindParam(':jenis', $data['jenis']);
		$statement->bindParam(':nama', $data['nama']);
		$statement->bindParam(':telp', $data['no_telp']);
		$statement->bindParam(':alamat', $data['alamat']);
		$statement->bindParam(':ongkir', $data['ongkir']);
		$statement->bindParam(':status', $data['status']);
		$statement->bindParam(':ket', $data['ket']);
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

	// hapus detail penjualan
	function deleteDetail_penjualan($koneksi, $data){
		$query = "CALL hapus_penjualan ";
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