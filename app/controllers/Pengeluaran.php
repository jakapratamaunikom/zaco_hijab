<?php
	// action
	date_default_timezone_set('Asia/Jakarta');
	
	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	// load model
	include_once("../models/Pengeluaran_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	// $action = "list";

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{

		switch (strtolower($action)) {
			case 'list':
				list_pengeluaran($koneksi);
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

			case 'addlist':
				validList($koneksi);
				break;

			case 'getview':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				getView($koneksi, $id);
				break;

			case 'getkdpengeluaran':
				getKdPengeluaran($koneksi);
				break;
			
			default:
				# code...
				break;
		}
	}

	function list_pengeluaran($koneksi){
		/* 
			configurasi tabel barang
			=> kolom yg ditampilkan di datatable:
				-> no, kd_barang, nama, hpp, harga_pasar, market_place, harga_ig, ket, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'v_pengeluaran',
			'kolomOrder' => array(null, 'kd_pengeluaran', 'tgl', 'keterangan', 'total', 'jenis', null),
			'kolomCari' => array('kd_pengeluaran', 'tgl', 'jenis', 'keterangan', 'total'),
			'orderBy' => false,
			'kondisi' => false,
		);

		$data_pengeluaran = get_all_pengeluaran($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_pengeluaran as $row){
			$no_urut++;
			$aksi = '<a role="button" class="btn btn-info btn-flat btn-sm" href="'.base_url.'index.php?m=pengeluaran&p=view&id='.$row["id"].'">Detail</a>';
			$aksi .= '<a role="button" class="btn btn-success btn-flat btn-sm" href="'.base_url.'index.php?m=pengeluaran&p=form&id='.$row["id"].'">Edit</a>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kd_pengeluaran'];
			$dataRow[] = cetakTgl($row['tgl'],"full");
			$dataRow[] = cetakListItem($row['keterangan']);
			$dataRow[] = rupiah($row['total']);
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

	function actionAdd($koneksi){
		$dataPengeluaran = isset($_POST['dataPengeluaran']) ? $_POST['dataPengeluaran'] : false;
		$dataLisItem = isset($_POST['dataLisItem']) ? $_POST['dataLisItem'] : false;

		// validasi
			$status = $errorDb = $duplikat = $cekArray = false;
			$pesanError_pengeluaran = $set_value_pengeluaran = "";

			if($dataLisItem){ // cek isi list item ada / tidak
				if(cekArray($dataLisItem)) $cekArray = false; // array kosong
				else $cekArray = true;
			}

			$configData_pengeluaran = configData($dataPengeluaran);
			$validasi_pengeluaran = set_validasi($configData_pengeluaran);
			$cek = $validasi_pengeluaran['cek'];
			$pesanError_pengeluaran = $validasi_pengeluaran['setError'];
			$set_value_pengeluaran = $validasi_pengeluaran['setValue'];

			if(!$cekArray) $cek = false;
		// ==============================
		if($cek){
			session_start();
			$dataPengeluaran = array(
				'kd_pengeluaran' => validInputan($dataPengeluaran['kd_pengeluaran'], false, false),
				'tgl' => validInputan($dataPengeluaran['tgl'], false, false),
				'jenis' => validInputan($dataPengeluaran['jenis'], false, false),
				'user' => $_SESSION['sess_username'],
			);

			$config_duplikat = array(
				'tabel' => 'pengeluaran',
				'field' => 'kd_pengeluaran',
				'value' => $dataPengeluaran['kd_pengeluaran'],
			);

			if(cekDuplikat($koneksi, $config_duplikat)){ // jika ada yg sama
				$status = $errorDb = false;
				$duplikat = true;
			}
			else{
				$duplikat = false;

				// insert penjualan
				if(insertPengeluaran($koneksi, $dataPengeluaran)){
					// insert ke detail penjualan
					foreach($dataLisItem as $index => $array){
						// insert hanya yg statusnya bukan hapus
						if($dataLisItem[$index]['status'] != "hapus"){
							$dataInsert['kd_pengeluaran'] = $dataPengeluaran['kd_pengeluaran'];
							$dataInsert['tgl'] = $dataPengeluaran['tgl'];
							// get data list item
							foreach ($dataLisItem[$index] as $key => $value) {
								$dataInsert[$key] = $value;
							}
							insertDetail_pengeluaran($koneksi,$dataInsert);
						}
					}
					$status = true;
					// session_start();
					$_SESSION['notif'] = "Tambah Data Berhasil";
				}
				else{
					$status = false;
					$errorDb = true;
				}

			}

		}
		else $status = false;

		$output = array(
			'status' => $status,
			'cekList' => $cekArray,
			'errorDb' => $errorDb,
			'duplikat' => $duplikat,
			'pesanError' => $pesanError_pengeluaran,
			'set_value' => $set_value_pengeluaran,
		);

		echo json_encode($output);
	}

	function getEdit($koneksi, $id){
		$data_pengeluaran = get_pengeluaran_by_id($koneksi, $id);

		$output = array();

		if(!$data_pengeluaran){
			session_start();
			$_SESSION['notif'] = "gagal";
			$data = false;
		}
		else{
			$data['pengeluaran'] = $data_pengeluaran;
			// get data detail penjualan
			$data_detail = get_detail_pengeluaran_by_id($koneksi, $id);
			$data['listItem'] = $data_detail;
		}

		$output = array(
			'data' => $data,
		);
		echo json_encode($output);
	}

	function actionEdit($koneksi){
		$dataPengeluaran = isset($_POST['dataPengeluaran']) ? $_POST['dataPengeluaran'] : false;
		$dataLisItem = isset($_POST['dataLisItem']) ? $_POST['dataLisItem'] : false;

		// validasi
			$status = $errorDb = $duplikat = $cekArray = false;
			$pesanError_pengeluaran = $set_value_pengeluaran = "";

			if($dataLisItem){ // cek isi list item ada / tidak
				if(cekArray($dataLisItem)) $cekArray = false; // array kosong
				else $cekArray = true;
			}

			$configData_pengeluaran = configData($dataPengeluaran);
			$validasi_pengeluaran = set_validasi($configData_pengeluaran);
			$cek = $validasi_pengeluaran['cek'];
			$pesanError_pengeluaran = $validasi_pengeluaran['setError'];
			$set_value_pengeluaran = $validasi_pengeluaran['setValue'];

			if(!$cekArray) $cek = false;
		// ================================

		if($cek){
			session_start();
			$dataPengeluaran = array(
				'id' => $dataPengeluaran['id'],
				'kd_pengeluaran' => validInputan($dataPengeluaran['kd_pengeluaran'], false, false),
				'tgl' => validInputan($dataPengeluaran['tgl'], false, false),
				'jenis' => validInputan($dataPengeluaran['jenis'], false, false),
				'user' => $_SESSION['sess_username'],
			);

			if(updatePengeluaran($koneksi, $dataPengeluaran)){
				// update detail pengeluaran
				foreach($dataLisItem as $index => $array){
					// update hanya yg statusnya bukan hapus dan aksinya edit
					if(($dataLisItem[$index]['status'] != "hapus") && ($dataLisItem[$index]['aksi'] == "edit")) {
						// get data list item
						foreach ($dataLisItem[$index] as $key => $value) {
							$dataUpdate[$key] = $value;
						}
						updateDetail_pengeluaran($koneksi,$dataUpdate);
					}
					// insert data
					else if(($dataLisItem[$index]['status'] != "hapus") && ($dataLisItem[$index]['aksi'] == "tambah")){
						$dataUpdate['kd_pengeluaran'] = $dataPengeluaran['kd_pengeluaran'];
						// get data list item
						foreach ($dataLisItem[$index] as $key => $value) {
							$dataUpdate[$key] = $value;
						}
						insertDetail_pengeluaran($koneksi,$dataUpdate);
					}
					// hapus list
					else if(($dataLisItem[$index]['status'] == "hapus") && ($dataLisItem[$index]['aksi'] == "edit")){
						// get data list item
						foreach ($dataLisItem[$index] as $key => $value) {
							$dataUpdate[$key] = $value;
						}
						deleteDetail_pengeluaran($koneksi,$dataUpdate);
					}
				}
			}
			else{
				$status = false;
				$errorDb = true;
			}
			$status = true;
			// session_start();
			$_SESSION['notif'] = "Edit Data Berhasil";

		}
		else $status = false;

		$output = array(
			'status' => $status,
			'cekList' => $cekArray,
			'errorDb' => $errorDb,
			'duplikat' => $duplikat,
			'pesanError' => $pesanError_pengeluaran,
			'set_value' => $set_value_pengeluaran,
		);

		echo json_encode($output);
	}

	function validList($koneksi){
		$dataList = isset($_POST['data']) ? $_POST['data'] : false;

		$status = false;

		$configData = configDataList($dataList, $koneksi);
		$validasi = set_validasi($configData);
		$cek = $validasi['cek'];
		$pesanError = $validasi['setError'];

		if($cek) $status = true;

		$output = array(
			'status' => $status,
			'pesanError' => $pesanError,
		);

		echo json_encode($output);
	}

	function getKdPengeluaran($koneksi){
		$kd_pengeluaran = get_kd_pengeluaran($koneksi);
		echo json_encode($kd_pengeluaran);
	}

	function configData($data){
		$configData = array(
			// kd_pengeluaran
			array(
				'field' => $data['kd_pengeluaran'], 'label' => 'Kode Pengeluaran', 'error' => 'kd_pengeluaranError',
				'value' => 'kd_pengeluaran', 'rule' => 'string | 13 | 16 | required',
			),
			// tgl
			array(
				'field' => $data['tgl'], 'label' => 'Tanggal', 'error' => 'tglError',
				'value' => 'tgl', 'rule' => 'string | 10 | 10 | required',
			),
			// jenis
			array(
				'field' => $data['jenis'], 'label' => 'Jenis Pengeluaran', 'error' => 'jenisError',
				'value' => 'jenis', 'rule' => 'string | 1 | 25 | required',
			),
		);

		return $configData;
	}

	function configDataList($data){
		$configData = array(
			// ket
			array(
				'field' => $data['ket'], 'label' => 'Keterangan', 'error' => 'ketError',
				'value' => 'ket', 'rule' => 'string | 1 | 255 | required',
			),
			// qty
			array(
				'field' => $data['qty'], 'label' => 'Qty', 'error' => 'qtyError',
				'value' => 'qty', 'rule' => 'nilai | 1 | 9999 | required',
			),
			// nominal
			array(
				'field' => $data['nominal'], 'label' => 'Nominal', 'error' => 'nominalError',
				'value' => 'nominal', 'rule' => 'nilai | 1 | 99999999 | required',
			),
		);

		return $configData;
	}