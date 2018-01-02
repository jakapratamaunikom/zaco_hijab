<?php
	// session_start();
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	// load model
	include_once("../models/Stok_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	// $action = "coba";

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'list':
				list_Stok($koneksi); // list datatable
				break;
			
			default:
				die();
				break;
		}
	}

	// function list datatable (server-side)
	function list_Stok($koneksi){
		/* 
			configurasi tabel barang
			=> kolom yg ditampilkan di datatable:
				-> no, kd_barang, nama, hpp, harga_pasar, market_place, harga_ig, ket, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'v_stok_terbaru',
			'kolomOrder' => array(null, 'kode_barang', 'tgl', 'stok_awal', 'brg_masuk', 'brg_keluar', 'stok_akhir', null),
			'kolomCari' => array('kode_barang', 'tgl', 'stok_awal', 'brg_masuk', 'brg_keluar', 'stok_akhir'),
			'orderBy' => false,
			'kondisi' => false,
		);

		$data_stok = get_all_stok($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_stok as $row){

			$no_urut++;
			$aksi = "";
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kode_barang'];
			$dataRow[] = $row['tgl'];
			$dataRow[] = $row['stok_awal'];
			$dataRow[] = $row['brg_masuk'];
			$dataRow[] = $row['brg_keluar'];
			$dataRow[] = $row['stok_akhir'];
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
