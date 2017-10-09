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

	function get_ket_penjualan_item($koneksi, $date, $ket){
		$bulan = $date['bulan'];
		$tahun = $date['tahun'];
		$query = "SELECT kd_barang, kode_barang, nama, SUM(brg_keluar) total FROM v_stok_all ";
		$query .= "WHERE month(tgl) = :bulan AND YEAR(tgl) = :tahun GROUP BY kd_barang ";

		switch (strtolower($ket)) {
			case 'terlaris':
				$query .= "HAVING total != 0 ORDER BY total DESC LIMIT 5";
				break;
			
			case 'kurang_laku':
				$query .= "HAVING total != 0 ORDER BY total ASC LIMIT 5";
				break;

			// belum terjual
			default:
				$query .= "HAVING total = 0 ORDER BY total ASC LIMIT 5";
				break;
		}

		$statement = $koneksi->prepare($query);
		$statement->bindParam(':bulan', $bulan);
		$statement->bindParam(':tahun', $tahun);
		$statement->execute();
		$result = $statement->fetchAll();
		tutup_koneksi($koneksi);

		return $result;
	}
