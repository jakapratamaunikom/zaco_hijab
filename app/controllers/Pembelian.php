<?php
	// action
	date_default_timezone_set('Asia/Jakarta');
	
	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	include_once("../models/Pembelian_model.php");
	include_once("../models/Barang_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'list':
				list_pembelian($koneksi);
				break;

			case 'tambah':
				actionAdd($koneksi);
				break;

			case 'getedit':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				getEdit($koneksi, $id);
				break;

			case 'edit':
				actionEdit($koneksi);
				break;

			case 'getselect':
				getSelect($koneksi);
				break;

			case 'getkdpembelian':
				getKdPembelian($koneksi);
				break;

			case 'addlist':
				validList();
				break;
			
			default:
				die();
				break;
		}
	}

	function list_pembelian($koneksi){
		$config_db = array(
			'tabel' => 'v_pembelian',
			'kolomOrder' => array(null, 'kd_pembelian', 'tgl', 'item', 'total', null, null),
			'kolomCari' => array('kd_pembelian', 'tgl', 'item', 'total'),
			'orderBy' => false,
			'kondisi' => false,
		);

		$data_pembelian = get_all_pembelian($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_pembelian as $row){
			$no_urut++;
			$ket = !empty($row['ket']) ? $row['ket'] : "-";
			$aksi = '<a role="button" class="btn btn-info btn-flat btn-sm" href="'.base_url.'index.php?m=pembelian&p=view&id='.$row["id"].'">Detail</a>';
			$aksi .= '<a role="button" class="btn btn-success btn-flat btn-sm" href="'.base_url.'index.php?m=pembelian&p=form&id='.$row["id"].'">Edit</a>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kd_pembelian'];
			$dataRow[] = cetakTgl($row['tgl'],"full");
			$dataRow[] = cetakListItem($row['item']);
			$dataRow[] = rupiah($row['total']);
			$dataRow[] = $ket;
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
		$dataPembelian = isset($_POST['dataPembelian']) ? $_POST['dataPembelian'] : false;
		$dataLisItem = isset($_POST['dataLisItem']) ? $_POST['dataLisItem'] : false;

		// validasi
			// inisialisasi
			$status = $errorDb = $duplikat = $cekArray = false;
			$pesanError_pembelian = $set_value_pembelian = "";

			if($dataLisItem){ // cek isi list item ada / tidak
				if(cekArray($dataLisItem)) $cekArray = false; // array kosong
				else $cekArray = true;
			}

			$configData_pembelian = configData($dataPembelian);
			$validasi_pembelian = set_validasi($configData_pembelian);
			$cek = $validasi_pembelian['cek'];
			$pesanError_pembelian = $validasi_pembelian['setError'];
			$set_value_pembelian = $validasi_pembelian['setValue'];

			if(!$cekArray) $cek = false;
		// ======================================== //

		if($cek){
			session_start();
			$dataPembelian = array(
				'kd_pembelian' => validInputan($dataPembelian['kd_pembelian'], false, false),
				'tgl' => validInputan($dataPembelian['tgl'], false, false),
				'ket' => validInputan($dataPembelian['ket'], false, false),
				'user' => $_SESSION['sess_username'],
			);

			// cek duplikat
			$config_duplikat = array(
				'tabel' => 'pembelian',
				'field' => 'kd_pembelian',
				'value' => $dataPembelian['kd_pembelian'],
			);

			if(cekDuplikat($koneksi, $config_duplikat)){ // jika ada yg sama
				$status = $errorDb = false;
				$duplikat = true;
			}
			else{
				$duplikat = false;

				// insert pembelian
				if(insertPembelian($koneksi, $dataPembelian)){
					// insert ke detail pembelian
					foreach($dataLisItem as $index => $array){
						// insert hanya yg statusnya bukan hapus
						if($dataLisItem[$index]['status'] != "hapus"){
							$dataInsert['kd_pembelian'] = $dataPembelian['kd_pembelian'];
							$dataInsert['tgl'] = $dataPembelian['tgl'];
							// get data list item
							foreach ($dataLisItem[$index] as $key => $value) {
								$dataInsert[$key] = $value;
							}
							insertDetail_pembelian($koneksi,$dataInsert);
						}
					}
					$status = true;
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
			'pesanError' => $pesanError_pembelian,
			'set_value' => $set_value_pembelian,
		);

		echo json_encode($output);
	}

	// fungsi get data edit
	function getEdit($koneksi, $id){
		// get data pembelian
		$data_pembelian = get_pembelian_by_id($koneksi, $id);

		$output = array();

		if(!$data_pembelian){
			session_start();
			$_SESSION['notif'] = "gagal";
			$data = false;
		}
		else{
			$data['pembelian'] = $data_pembelian;
			// get data detail pembelian
			$data_detail = get_detail_pembelian_by_id($koneksi, $id);
			$data['listItem'] = $data_detail;
		}

		// $respon = $data ? cekTanggal($data_penjualan['kd_penjualan']) : false;
		$respon = cekTanggal($data_pembelian['kd_pembelian']);

		$output = array(
			'data' => $data,
			'respon' => $respon,
		);
		echo json_encode($output);
	}

	// fungsi action edit
	function actionEdit($koneksi){
		$dataPembelian = isset($_POST['dataPembelian']) ? $_POST['dataPembelian'] : false;
		$dataLisItem = isset($_POST['dataLisItem']) ? $_POST['dataLisItem'] : false;

		// validasi
			// inisialisasi
			$status = $errorDb = $duplikat = $cekArray = false;
			$pesanError_pembelian = $set_value_pembelian = "";

			if($dataLisItem){ // cek isi list item ada / tidak
				if(cekArray($dataLisItem)) $cekArray = false; // array kosong
				else $cekArray = true;
			}

			if($cekArray){ // jika ada list lanjutkan
				$configData_pembelian = configData($dataPembelian);
				$validasi_pembelian = set_validasi($configData_pembelian);
				$cek = $validasi_pembelian['cek'];
				$pesanError_pembelian = $validasi_pembelian['setError'];
				$set_value_pembelian = $validasi_pembelian['setValue'];
			}
			else $cek = false;
		// ======================================== //
		if($cek){
			session_start();
			$dataPembelian = array(
				'id' => $dataPembelian['id'],
				'kd_pembelian' => validInputan($dataPembelian['kd_pembelian'], false, false),
				'tgl' => validInputan($dataPembelian['tgl'], false, false),
				'ket' => validInputan($dataPembelian['ket'], false, false),
				'user' => $_SESSION['sess_username'],
			);

			// update penjualan
			if(updatePembelian($koneksi, $dataPembelian)){
				$dataUpdate['tgl'] = $dataPembelian['tgl'];
				// update detail penjualan
				foreach($dataLisItem as $index => $array){
					// update hanya yg statusnya bukan hapus dan aksinya edit
					if(($dataLisItem[$index]['status'] != "hapus") && ($dataLisItem[$index]['aksi'] == "edit")) {
						$dataUpdate['kd_pembelian'] = $dataPembelian['id'];
						// get data list item
						foreach ($dataLisItem[$index] as $key => $value) {
							$dataUpdate[$key] = $value;
						}
						updateDetail_pembelian($koneksi,$dataUpdate);
					}
					// insert data
					else if(($dataLisItem[$index]['status'] != "hapus") && ($dataLisItem[$index]['aksi'] == "tambah")){
						$dataUpdate['kd_pembelian'] = $dataPembelian['kd_pembelian'];
						// get data list item
						foreach ($dataLisItem[$index] as $key => $value) {
							$dataUpdate[$key] = $value;
						}
						insertDetail_pembelian($koneksi,$dataUpdate);
					}
					// hapus list
					else if(($dataLisItem[$index]['status'] == "hapus") && ($dataLisItem[$index]['aksi'] == "edit")){
						$dataUpdate['kd_pembelian'] = $dataPembelian['kd_pembelian'];
						// get data list item
						foreach ($dataLisItem[$index] as $key => $value) {
							$dataUpdate[$key] = $value;
						}
						deleteDetail_pembelian($koneksi,$dataUpdate);
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
			'pesanError' => $pesanError_pembelian,
			'set_value' => $set_value_pembelian,
		);

		echo json_encode($output);
	}

	//cek validasi pada saat menambahkan list
	function validList(){
		$dataForm = isset($_POST['dataForm']) ? $_POST['dataForm'] : false;

		$status = false;
		
		$configData = configDataList($dataForm);
		$validasi = set_validasi($configData);
		$cek = $validasi['cek'];
		$pesanError = $validasi['setError'];

		if($cek) $status = true;

		$output = array(
			'status' => $status,
			'pesanError' => $pesanError 
		);

		echo json_encode($output);
	}

	// mendapatkan kode pembelian terakhir pada hari ini
	function getKdPembelian($koneksi){
		$kd_pembelian = get_kd_pembelian($koneksi);
		echo json_encode($kd_pembelian);
	}

	// fungsi get data select
	function getSelect($koneksi){
		$data_barang = get_ket_barang($koneksi);
		echo json_encode($data_barang);
	}

	// config data pembelian
	function configData($data){
		$configData = array(
			// data kd_pembelian
			array(
				'field' => $data['kd_pembelian'], 'label' => 'Kode Pembelian', 'error' => 'kd_pembelianError',
				'value' => 'kd_pembelian', 'rule' => 'string | 13 | 16 | required',
			),
			// data tgl
			array(
				'field' => $data['tgl'], 'label' => 'Tanggal', 'error' => 'tglError',
				'value' => 'tgl', 'rule' => 'string | 10 | 10 | required',
			),
			// data ket
			array(
				'field' => $data['ket'], 'label' => 'Keterangan', 'error' => 'ketError',
				'value' => 'ket', 'rule' => 'string | 1 | 255 | not_required',
			),
		);

		return $configData;
	}

	// config data detail pembelian
	function configDataList($data){
		$configData = array(
			// data kd_barang
			array(
				'field' => $data['kd_barang'], 'label' => 'Item', 'error' => 'kd_barangError',
				'value' => 'kd_barang', 'rule' => 'angka | 1 | 99999 | required',
			),
			// data harga
			array(
				'field' => $data['harga'], 'label' => 'Harga', 'error' => 'hargaError',
				'value' => 'harga', 'rule' => 'nilai | 1 | 999999 | required',
			),
			// data qty
			array(
				'field' => $data['qty'], 'label' => 'Qty', 'error' => 'qtyError',
				'value' => 'qty', 'rule' => 'nilai | 1 | 999 | required',
			),
			// data ket
			array(
				'field' => $data['ket'], 'label' => 'Keterangan', 'error' => 'ketError',
				'value' => 'ket', 'rule' => 'string | 1 | 255 | not_required',
			),
		);

		return $configData;
	}

	function cekTanggal($tgl){
		$tgl = explode('-', $tgl);

		$tgl_sekarang = cetakTgl(date("Y-m-d"), 'yyyymmdd');

		$respon = array();
		if($tgl[1]==$tgl_sekarang) {
			$respon = array(
				'listItem' => true, 
				'qty' => true,
				'aksi' => true,
			);
		}
		else {
			$respon = array(
				'listItem' => false, 
				'qty' => false,
				'aksi' => false,
			);
		}

		return $respon;
	}