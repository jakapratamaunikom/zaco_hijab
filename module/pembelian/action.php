<?php
	// action

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
	// Load semua fungsi yang dibutuhkan
	include_once("../../function/helper.php");
	include_once("../../function/koneksi.php");
	include_once("../../function/validasi_form.php");
	include_once("../../function/datatable.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	// $action = "list";

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{

		switch (strtolower($action)) {
			case 'list':
				list_Barang($koneksi);
				break;

			case 'tambah':
				actionAdd($koneksi);
				break;

			case 'getedit':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				break;

			case 'edit':
				getEdit($koneksi, $id);
				break;

			case 'getselect':
				$select = isset($_POST['select']) ? $_POST['select'] : false;
				getSelect($koneksi);
				break;

			case 'getkdpembelian':
				getKdPembelian($koneksi);
				break;
			
			default:
				# code...
				break;
		}
	}

	// function list datatable (server-side)
	function list_Barang($koneksi){
		
	}

	// fungsi action add
	function actionAdd($koneksi){
		
	}

	// fungsi get data edit
	function getEdit($koneksi, $id){
	}

	// fungsi action edit
	function actionEdit($koneksi){
	}

	// fungsi get data select
	function getSelect($koneksi){
		$query = "SELECT id, nama FROM v_barang";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();

		echo json_encode($result);
	}

	// mendapatkan kode pembelian terakhir pada hari ini
	function getKdPembelian($koneksi){
		$kode = date("Y").date("m").date("d");
		$query = "SELECT kd_pembelian FROM pembelian WHERE kd_pembelian LIKE '%".$kode."%' ORDER BY kd_pembelian desc LIMIT 1";

		// prepare
		$statement = $koneksi->prepare($query);
		// execute
		$statement->execute();
		$result = $statement->fetchAll();
		echo json_encode($result);
	}



?>