<?php
	// session_start();
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	// load model
	include_once("../models/Penjualan_model.php");
	include_once("../models/Barang_model.php");
	// include_once("../models/Stok_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'list':
				list_penjualan($koneksi); // list datatable
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

			case 'getkdpenjualan':
				getKdPenjualan($koneksi);
				break;
			
			case 'getselect':
				getSelect($koneksi);
				break;

			default:
				die();
				break;
		}
	}

	// function list datatable (server-side)
	function list_penjualan($koneksi){
		/* 
			configurasi tabel barang
			=> kolom yg ditampilkan di datatable:
				-> no, kd_barang, nama, hpp, harga_pasar, market_place, harga_ig, ket, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'v_penjualan',
			'kolomOrder' => array(null, 'kd_penjualan', 'tgl', 'jenis', 'item', 'total', 'status', null, null),
			'kolomCari' => array('kd_penjualan', 'tgl', 'jenis', 'item', 'total', 'status'),
			'orderBy' => array('id' => 'desc'),
			'kondisi' => false,
		);

		$data_penjualan = get_all_penjualan($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_penjualan as $row){
			$no_urut++;
			$ket = !empty($row['ket']) ? $row['ket'] : "-";
			$aksi = '<a role="button" class="btn btn-info btn-flat btn-sm" href="'.base_url.'index.php?m=penjualan&p=view&id='.$row["id"].'">Detail</a>';
			$aksi .= '<a role="button" class="btn btn-success btn-flat btn-sm" href="'.base_url.'index.php?m=penjualan&p=form&id='.$row["id"].'">Edit</a>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kd_penjualan'];
			$dataRow[] = cetakTgl($row['tgl'],"full");
			$dataRow[] = $row['jenis'];
			$dataRow[] = cetakListItem($row['item']);
			$dataRow[] = rupiah($row['total']);
			$dataRow[] = $row['status'];
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

	// fungsi tambah data
	function actionAdd($koneksi){
		$dataPenjualan = isset($_POST['dataPenjualan']) ? $_POST['dataPenjualan'] : false;
		$dataLisItem = isset($_POST['dataLisItem']) ? $_POST['dataLisItem'] : false;

		// validasi
			// inisialisasi
			$status = $errorDb = $duplikat = $cekArray = false;
			$pesanError_penjualan = $set_value_penjualan = "";

			if($dataLisItem){ // cek isi list item ada / tidak
				if(cekArray($dataLisItem)) $cekArray = false; // array kosong
				else $cekArray = true;
			}

			if($cekArray){ // jika ada list lanjutkan
				$configData_penjualan = configData($dataPenjualan);
				$validasi_penjualan = set_validasi($configData_penjualan);
				$cek = $validasi_penjualan['cek'];
				$pesanError_penjualan = $validasi_penjualan['pesanError'];
				$set_value_penjualan = $validasi_penjualan['set_value'];
			}
			else $cek = false;
		// ======================================== //
		if($cek){
			$dataPenjualan = array(
				'kd_penjualan' => validInputan($dataPenjualan['kd_penjualan'], false, false),
				'tgl' => validInputan($dataPenjualan['tgl'], false, false),
				'jenis' => validInputan($dataPenjualan['jenis'], false, false),
				'status' => validInputan($dataPenjualan['status'], false, false),
				'ket' => validInputan($dataPenjualan['ket'], false, false),
				'nama' => validInputan($dataPenjualan['nama'], false, false),
				'no_telp' => validInputan($dataPenjualan['no_telp'], false, false),
				'alamat' => validInputan($dataPenjualan['alamat'], false, false),
				'ongkir' => validInputan($dataPenjualan['ongkir'], false, false),
			);

			// cek duplikat kd_penjualan
			$config_duplikat = array(
				'tabel' => 'penjualan',
				'field' => 'kd_penjualan',
				'value' => $dataPenjualan['kd_penjualan'],
			);

			if(cekDuplikat($koneksi, $config_duplikat)){ // jika ada yg sama
				$status = $errorDb = false;
				$duplikat = true;
			}
			else{
				$duplikat = false;

				// insert penjualan
				if(insertPenjualan($koneksi, $dataPenjualan)){
					// insert ke detail penjualan
					foreach($dataLisItem as $index => $array){
						// insert hanya yg statusnya bukan hapus
						if($dataLisItem[$index]['status'] != "hapus"){
							$dataInsert['kd_penjualan'] = $dataPenjualan['kd_penjualan'];
							$dataInsert['tgl'] = $dataPenjualan['tgl'];
							// get data list item
							foreach ($dataLisItem[$index] as $key => $value) {
								$dataInsert[$key] = $value;
							}
							insertDetail_penjualan($koneksi,$dataInsert);
						}
					}
					$status = true;
					session_start();
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
			'pesanError' => $pesanError_penjualan,
			'set_value' => $set_value_penjualan,
		);

		echo json_encode($output);
	}

	// fungsi get edit
	function getEdit($koneksi, $id){
		// get data penjualan
		$data_penjualan = get_penjualan_by_id($koneksi, $id);

		$output = array();

		if(!$data_penjualan){
			session_start();
			$_SESSION['notif'] = "gagal";
			$data = false;
		}
		else{
			$data['penjualan'] = $data_penjualan;
			// get data detail penjualan
			$data_detail = get_detail_by_id($koneksi, $id);
			$data['listItem'] = $data_detail;
		}


		// $respon = $data ? cekTanggal($data_penjualan['kd_penjualan']) : false;
		$respon = cekTanggal($data_penjualan['kd_penjualan']);

		$output = array(
			'data' => $data,
			'respon' => $respon,
		);
		echo json_encode($output);
	}

	// fungsi action edit
	function actionEdit($koneksi){
		$dataPenjualan = isset($_POST['dataPenjualan']) ? $_POST['dataPenjualan'] : false;
		$dataLisItem = isset($_POST['dataLisItem']) ? $_POST['dataLisItem'] : false;

		// validasi
			// inisialisasi
			$status = $errorDb = $duplikat = $cekArray = false;
			$pesanError_penjualan = $set_value_penjualan = "";

			if($dataLisItem){ // cek isi list item ada / tidak
				if(cekArray($dataLisItem)) $cekArray = false; // array kosong
				else $cekArray = true;
			}

			if($cekArray){ // jika ada list lanjutkan
				$configData_penjualan = configData($dataPenjualan);
				$validasi_penjualan = set_validasi($configData_penjualan);
				$cek = $validasi_penjualan['cek'];
				$pesanError_penjualan = $validasi_penjualan['pesanError'];
				$set_value_penjualan = $validasi_penjualan['set_value'];
			}
			else $cek = false;
		// ======================================== //
		if($cek){
			$dataPenjualan = array(
				'id' => $dataPenjualan['id'],
				'kd_penjualan' => validInputan($dataPenjualan['kd_penjualan'], false, false),
				'tgl' => validInputan($dataPenjualan['tgl'], false, false),
				'jenis' => validInputan($dataPenjualan['jenis'], false, false),
				'status' => validInputan($dataPenjualan['status'], false, false),
				'ket' => validInputan($dataPenjualan['ket'], false, false),
				'nama' => validInputan($dataPenjualan['nama'], false, false),
				'no_telp' => validInputan($dataPenjualan['no_telp'], false, false),
				'alamat' => validInputan($dataPenjualan['alamat'], false, false),
				'ongkir' => validInputan($dataPenjualan['ongkir'], false, false),
			);

			// update penjualan
			if(updatePenjualan($koneksi, $dataPenjualan)){
				$dataUpdate['tgl'] = $dataPenjualan['tgl'];
				// update detail penjualan
				foreach($dataLisItem as $index => $array){
					// update hanya yg statusnya bukan hapus dan aksinya edit
					if(($dataLisItem[$index]['status'] != "hapus") && ($dataLisItem[$index]['aksi'] == "edit")) {
						$dataUpdate['kd_penjualan'] = $dataPenjualan['id'];
						// get data list item
						foreach ($dataLisItem[$index] as $key => $value) {
							$dataUpdate[$key] = $value;
						}
						updateDetail_penjualan($koneksi,$dataUpdate);
					}
					// insert data
					else if(($dataLisItem[$index]['status'] != "hapus") && ($dataLisItem[$index]['aksi'] == "tambah")){
						$dataUpdate['kd_penjualan'] = $dataPenjualan['kd_penjualan'];
						// get data list item
						foreach ($dataLisItem[$index] as $key => $value) {
							$dataUpdate[$key] = $value;
						}
						insertDetail_penjualan($koneksi,$dataUpdate);
					}
					// hapus list
					else if(($dataLisItem[$index]['status'] == "hapus") && ($dataLisItem[$index]['aksi'] == "edit")){
						// // get data list item
						// foreach ($dataLisItem[$index] as $key => $value) {
						// 	$dataUpdate[$key] = $value;
						// }
						// updateDetail_penjualan($koneksi,$dataUpdate);
					}
				}
			}
			else{
				$status = false;
				$errorDb = true;
			}
			$status = true;
			session_start();
			$_SESSION['notif'] = "Edit Data Berhasil";
		}
		else $status = false;

		$output = array(
			'status' => $status,
			'cekList' => $cekArray,
			'errorDb' => $errorDb,
			'duplikat' => $duplikat,
			'pesanError' => $pesanError_penjualan,
			'set_value' => $set_value_penjualan,
		);

		echo json_encode($output);
	}

	// fungsi hapus detail penjualan
	function deleteDetail_penjualan($koneksi, $data){

	}

	// fungsi validasi list item
	function validList($koneksi){
		$dataList = isset($_POST['data']) ? $_POST['data'] : false;

		$status = false;

		// get harga
		$hargaBarang = get_harga_barang($koneksi, $dataList['kd_barang']);
		$configData = configDataList($dataList, $koneksi);
		$validasi = set_validasi($configData);
		$cek = $validasi['cek'];
		$pesanError = $validasi['pesanError'];

		if($cek) $status = true;

		$output = array(
			'status' => $status,
			'pesanError' => $pesanError,
			'harga' => $hargaBarang,
		);

		echo json_encode($output);
	}

	function getKdPenjualan($koneksi){
		$kd_penjualan = get_kd_penjualan($koneksi);
		echo json_encode($kd_penjualan);
	}

	// fungsi get data select barang
	function getSelect($koneksi){
		$data_barang = get_ket_barang($koneksi);
		echo json_encode($data_barang);
	}

	// fungsi set data untuk di validasi
	function configData($data){
		if((strtolower($data['jenis'])=="harga pasar") || (strtolower($data['jenis'])=="reseller")){
			$required = "not_required";
		}
		else $required = "required";

		$configData = array(
			// data kd_penjualan
			array(
				'field' => $data['kd_penjualan'], 'label' => 'Kode Penjualan', 'error' => 'kd_penjualanError',
				'value' => 'kd_penjualan', 'rule' => 'string | 13 | 16 | required',
			),
			// data tgl
			// array(
			// 	'field' => $data['tgl'], 'label' => 'Tanggal', 'error' => 'tglError',
			// 	'value' => 'tgl', 'rule' => 'string | 10 | 10 | required',
			// ),
			// data jenis
			array(
				'field' => $data['jenis'], 'label' => 'Jenis Transaksi', 'error' => 'jenisError',
				'value' => 'jenis', 'rule' => 'string | 1 | 16 | required',
			),
			// data status
			array(
				'field' => $data['status'], 'label' => 'Status Transaksi', 'error' => 'statusError',
				'value' => 'status', 'rule' => 'angka | 0 | 1 | required',
			),
			// data ket
			array(
				'field' => $data['ket'], 'label' => 'Keterangan', 'error' => 'ketError',
				'value' => 'ket', 'rule' => 'string | 1 | 255 | not_required',
			),
			// data nama
			array(
				'field' => $data['nama'], 'label' => 'Nama Pembeli', 'error' => 'namaError',
				'value' => 'nama', 'rule' => 'string | 1 | 50 | '.$required,
			),
			// data no. telp
			array(
				'field' => $data['no_telp'], 'label' => 'No. Telepon', 'error' => 'no_telpError',
				'value' => 'no_telp', 'rule' => 'string | 1 | 15 | '.$required,
			),
			// data alamat
			array(
				'field' => $data['alamat'], 'label' => 'Alamat', 'error' => 'alamatError',
				'value' => 'alamat', 'rule' => 'string | 1 | 255 | '.$required,
			),
			array(
				'field' => $data['ongkir'], 'label' => 'Ongkos Kirim', 'error' => 'ongkirError',
				'value' => 'ongkir', 'rule' => 'angka | 0 | 999999 | '.$required,
			),
		);

		return $configData;
	}

	// fungsi set data validasi list item
	function configDataList($data, $koneksi){
		// get max qty item dan diskon
		$get_stok = get_stok_by_id($koneksi, $data['kd_barang']);
		$maxQty = $get_stok['stok'];
		$maxDiskon = $data['jenisDiskon'] === "p" ? 100 : 999999;
		
		$configData = array(
			// data jenis transaksi
			array(
				'field' => $_POST['jenis'], 'label' => 'Jenis Transaksi', 'error' => 'jenisError',
				'value' => 'jenis', 'rule' => 'string | 1 | 25 | required',
			),
			// data kd_barang
			array(
				'field' => $data['kd_barang'], 'label' => 'Item', 'error' => 'kd_barangError',
				'value' => 'kd_barang', 'rule' => 'angka | 1 | 99999 | required',
			),
			// data qty
			array(
				'field' => $data['qty'], 'label' => 'Qty', 'error' => 'qtyError',
				'value' => 'qty', 'rule' => 'angka | 1 | '.$maxQty.' | required',
			),
			// data jenis diskon
			array(
				'field' => $data['jenisDiskon'], 'label' => 'Jenis Diskon', 'error' => 'jenisDiskonError',
				'value' => 'jenisDiskon', 'rule' => 'string | 1 | 1 | required',
			),
			// data diskon
			array(
				'field' => $data['diskon'], 'label' => 'Diskon', 'error' => 'diskonError',
				'value' => 'Diskon', 'rule' => 'angka | 0 | '.$maxDiskon.' | not_required',
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

		// $tgl_sekarang = cetakTgl(date("Y-m-d"), 'yyyymmdd');

		$tgl_sekarang = '20170923';

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