<?php
	include_once("koneksi.php");

	$select = "id_barang";
	var_dump(getSelect($koneksi, $select));

	// fungsi get data select
	function getSelect($koneksi, $select){
		$query = "SELECT id, $select, nama FROM $select";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();

		echo json_encode($result);
	}