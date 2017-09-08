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
