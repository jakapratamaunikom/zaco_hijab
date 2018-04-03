<?php
	// action
	
	session_start();

	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	include_once("../models/Id_barang_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	// $action = "list";

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'list':
				list_idBarang($koneksi); // list datatable
				break;

			case 'tambah':
				actionAdd($koneksi); // aksi tambah
				break;

			case 'getedit':
				// get data untuk edit
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				getEdit($koneksi, $id);
				break;

			case 'edit':
				actionEdit($koneksi); // aksi edit
				break;
			
			default:
				die("Dilarang Akses Halaman Ini !!");
				break;
		}
	}

	// function list datatable (server-side)
	function list_idBarang($koneksi){
		/* 
			configurasi tabel id barang
			=> kolom yg ditampilkan di datatable:
				-> no, id_barang, nama, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'id_barang',
			'kolomOrder' => array(null, 'id_barang', 'nama', null),
			'kolomCari' => array('id_barang', 'nama'),
			'orderBy' => array('id' => 'asc'),
			'kondisi' => false,
		);

		$data_id_barang = get_datatable_id_barang($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_id_barang as $row){
			$no_urut++;
			// $aksi = '<button type="button" class="btn btn-success btn-flat btn-sm" onclick="edit_id_barang('."'".$row["id"]."'".')">Edit</button>';
			
			$aksiEdit = '<button type="button" class="btn btn-success btn-flat btn-sm" onclick="edit_id_barang('."'".$row["id"]."'".')">Edit</button>';
			$aksiHapus = '<button type="button" class="btn btn-danger btn-flat btn-sm" onclick="edit_id_barang('."'".$row["id"]."'".')">Hapus</button>';
			$aksi = $aksiEdit.$aksiHapus;

			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['id_barang'];
			$dataRow[] = $row['nama'];
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

	// fungsi action add
	function actionAdd($koneksi){
		$dataForm = isset($_POST) ? $_POST : false;

		// validasi inputan
			// inisialisasi
			$status = $errorDb = $duplikat = false;

			$configData = configData($dataForm);
			$validasi = set_validasi($configData);
			$cek = $validasi['cek'];
			$pesanError = $validasi['setError'];
			$set_value = $validasi['setValue'];

		// ==================================== //
		if($cek){
			// validasi inputan dari inject
			$dataForm = array(
				'id_barang' => validInputan($dataForm['id_barang'], false, false),
				'nama' => validInputan($dataForm['nama'], false, false),
			);

			// cek duplikat id barang
			$config_duplikat = array(
				'tabel' => 'id_barang',
				'field' => 'id_barang',
				'value' => $dataForm['id_barang'],
			);

			if(cekDuplikat($koneksi, $config_duplikat)){ // jika ada yg sama
				$status = $errorDb = false;
				$duplikat = true;
			}
			else{
				$duplikat = false;
				
				// jika query berhasil
				if(insertIdBarang($koneksi, $dataForm)){
					$status = true;
					$errorDb = false;
				} 
				else{
					$status = false;
					$errorDb = true;
				}
			}
		}
		else $status = false;

		// output lempar ke client
		$output = array(
			'status' => $status,
			'errorDb' => $errorDb,
			'duplikat' => $duplikat,
			'pesanError' => $pesanError,
			'set_value' => $set_value,
		);

		echo json_encode($output);
	}

	// fungsi get data edit
	function getEdit($koneksi, $id){
		$data_id_barang = get_idBarang_by_id($koneksi, $id);
		echo json_encode($data_id_barang);
	}

	// fungsi action edit
	function actionEdit($koneksi){
		$dataForm = isset($_POST) ? $_POST : false;

		// validasi
			// inisialisasi
			$status = $errorDb = $duplikat = false;
			$configData = configData($dataForm);
			$validasi = set_validasi($configData);
			$cek = $validasi['cek'];
			$pesanError = $validasi['setError'];
			$set_value = $validasi['setValue'];
		// ==================================== //

		if($cek){
			// validasi inputan dari inject
			$dataForm['nama'] = validInputan($dataForm['nama'], false, false);
						
			// jika query berhasil
			if(updateIdBarang($koneksi, $dataForm)){
				$status = true;
				$errorDb = false;
			} 
			else{
				$status = false;
				$errorDb = true;
			}
		}
		else $status = false;

		// output lempar ke client
		$output = array(
			'status' => $status,
			'errorDb' => $errorDb,
			'duplikat' => $duplikat,
			'pesanError' => $pesanError,
			'set_value' => $set_value,
		);

		echo json_encode($output);
	}

	// fungsi set data untuk di validasi
	function configData($data){
		$configData = array(
			// data id barang
			array(
				'field' => $data['id_barang'], 'label' => 'ID Barang', 'error' => 'id_barangError',
				'value' => 'id_barang', 'rule' => 'string | 1 | 4 | required',
			),
			// data nama barang
			array(
				'field' => $data['nama'], 'label' => 'Nama Barang', 'error' => 'namaBarangError',
				'value' => 'namaBarang', 'rule' => 'string | 1 | 25 | required',
			),
		);

		return $configData;
	}