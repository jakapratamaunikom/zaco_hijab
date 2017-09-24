<?php
	// get all data stok
	function get_all_stok($koneksi, $config_db){
		$query = get_dataTable($config_db);
		
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}

	function get_ket_penjualan_item($koneksi, $date, $sort, $limit){
		$bulan = $date['bulan'];
		$tahun = $date['tahun'];
		$query = "SELECT kd_barang, kode_barang, nama, SUM(brg_keluar) total FROM v_stok_all WHERE month(tgl) = :bulan AND YEAR(tgl) = :tahun GROUP BY kd_barang ORDER BY total $sort LIMIT $limit";

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':bulan', $bulan);
		$statement->bindParam(':tahun', $tahun);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}
