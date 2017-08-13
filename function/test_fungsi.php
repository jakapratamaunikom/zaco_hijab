<?php
	include_once("koneksi.php");

	$id = "100";
	var_dump(getEdit($koneksi, $id));

	// fungsi get data edit
	function getEdit($koneksi, $id){
		// $id = "11";
		$tabel = "barang";
		// query
		$query = "SELECT $tabel.id, $tabel.id_barang, $tabel.id_warna, concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, $tabel.nama, hpp, harga_pasar, market_place, harga_ig, foto, ket ";
		$query .= "FROM $tabel JOIN id_barang ib ON ib.id = $tabel.id_barang ";
		$query .= "JOIN id_warna iw ON iw.id = $tabel.id_warna ";
		$query .= "WHERE $tabel.id = :id";

		// prepare
		$statement = $koneksi->prepare($query);
		// bind
		$statement->bindParam(':id', $id);
		// execute
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		echo json_encode($result);
	}