<?php
	// session_start();
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	// load model
	include_once("../models/Reject_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	// $action = "coba";

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'list':
				list_Reject($koneksi); // list datatable
				break;
			
			default:
				die();
				break;
		}
	}

	// function list datatable (server-side)
	function list_Reject($koneksi){
		/* 
			configurasi tabel barang
			=> kolom yg ditampilkan di datatable:
				-> no, kd_barang, nama, hpp, harga_pasar, market_place, harga_ig, ket, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'v_reject',
			'kolomOrder' => array(null, 'kd_penjualan', 'tgl', 'kd_barang', 'kd_barang_ganti', 'qty', 'jenis', null),
			'kolomCari' => array('kd_penjualan', 'tgl', 'kd_barang', 'kd_barang_ganti', 'qty', 'jenis'),
			'orderBy' => false,
			'kondisi' => false,
		);

		$data_reject = get_datatable_reject($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_reject as $row){

			$no_urut++;
			$aksi = "";
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kd_penjualan'];
			$dataRow[] = $row['tgl'];
			$dataRow[] = $row['kd_barang'];
			$dataRow[] = $row['kd_barang_ganti'];
			$dataRow[] = $row['qty'];
			$dataRow[] = $row['jenis'];
			$dataRow[] = $aksi;

			$data[] = $dataRow;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => recordTotal($koneksi, $config_db),
			'recordsFiltered' => recordFilter($koneksi, $config_db),
			'data' => $data,
		);

		echo json_encode($output);
	}
