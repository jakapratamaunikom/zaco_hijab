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
				$select = isset($_POST['select']) ? $_POST['select'] : false;
				getSelect($koneksi);
				break;

			case 'getkdpembelian':
				getKdPembelian($koneksi);
				break;

			case 'addlist':
				validList();
				break;
			
			default:
				# code...
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

			if($cekArray){ // jika ada list lanjutkan
				$configData_pembelian = configData($dataPembelian);
				$validasi_pembelian = set_validasi($configData_pembelian);
				$cek = $validasi_pembelian['cek'];
				$pesanError_pembelian = $validasi_pembelian['setError'];
				$set_value_pembelian = $validasi_pembelian['set_value'];
			}
			else $cek = false;
		// ======================================== //

		// $kd_pembelian = $dataForm['kd_pembelian'];
		// $tgl = $dataForm['tgl'];
		// $listBarang = $dataForm['listBarang'];

		// $status = true;
		// $errorDb = false;

		if($cek){
			$dataPembelian = array(
				'kd_pembelian' => validInputan($dataPembelian['kd_pembelian'], false, false),
				'tgl' => validInputan($dataPembelian['tgl'], false, false),
				'ket' => validInputan($dataPembelian['ket'], false, false),
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
		
		// jika sukses eksekusi tambah pembelian
		// tambah detail pembelian
		// if($result){
		// 	// insert data ke detail pembelian
		// 	for($i=0;$i<sizeOf($listBarang);$i++){

		// 		$harga = $listBarang[$i]['harga'] / $listBarang[$i]['qty'];

		// 		$query = "CALL tambah_pembelian(:kd_pembelian, :tgl, :kd_barang, :harga, :qty, :subtotal, :ket)";
		// 		// prepare
		// 		$statement = $koneksi->prepare($query);

		// 		$statement->bindParam(':kd_pembelian', $kd_pembelian);
		// 		$statement->bindParam(':tgl', $tgl);
		// 		$statement->bindParam(':kd_barang', $listBarang[$i]['kd_barang']);
		// 		$statement->bindParam(':harga', $harga);
		// 		$statement->bindParam(':qty', $listBarang[$i]['qty']);
		// 		$statement->bindParam(':subtotal', $listBarang[$i]['harga']);
		// 		$statement->bindParam(':ket', $listBarang[$i]['ket']);

		// 		$result = $statement->execute(
		// 			array(
		// 				':kd_pembelian' => $kd_pembelian,
		// 				':tgl' => $tgl,
		// 				':kd_barang' => $listBarang[$i]['kd_barang'],
		// 				':harga' => $harga,
		// 				':qty' => $listBarang[$i]['qty'],
		// 				':subtotal' => $listBarang[$i]['harga'],
		// 				':ket' => $listBarang[$i]['ket'],
		// 			)
		// 		);

		// 		// jika terdapat error saat eksekusi
		// 		// keluar dari iterasi
		// 		if(!$result){
		// 			$errorDb = true;
		// 			$status = false;
		// 			break;
		// 		}
		// 	}

		// 	// jika tidak ada error saat penambahan detail
		// 	// tambah data ke tabel pengeluaran
		// 	if(!$errorDb){
		// 		$kd_pengeluaran = getKdPengeluaran($koneksi);
		// 		$query = "CALL tambah_pengeluaran_pembelian(:kd_pengeluaran,:kd_pembelian, :tgl, 'admin');";
		// 		// prepare
		// 		$statement = $koneksi->prepare($query);

		// 		$statement->bindParam(':kd_pengeluaran', $kd_pengeluaran);
		// 		$statement->bindParam(':kd_pembelian', $kd_pembelian);
		// 		$statement->bindParam(':tgl', $tgl);

		// 		$result = $statement->execute(
		// 			array(
		// 				':kd_pengeluaran' => $kd_pengeluaran,
		// 				':kd_pembelian' => $kd_pembelian,
		// 				':tgl' => $tgl,
		// 			)
		// 		);

		// 		if(!$result){
		// 			$status = false;
		// 			$errorDb = true;
		// 		}else{
		// 			$status = true;
		// 			$errorDb = false;
		// 			$_SESSION['notif'] = "Tambah Data Berhasil";
		// 		}
		// 	}


		// }else{
		// 	$status = false;
		// 	$errorDb = true;
		// }

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

		// inisialisasi
		//    status -> untuk lihat sukses/tidak
		//    errorDb -> untuk lihat db error/tidak
		//    pesanError -> untuk menampung pesan error jika terjadi kesalahan
		//    dataPembelian -> untuk menampung data hasil query
		//    
		$status = true;
		$errorDb = false;
		$pesanError = "";
		$dataPembelian = [];
		$id = (int)$id;

		// dapatkan informasi pembelian (dari tabel pembelian)
		$query = 'select * from pembelian WHERE id='.$id;
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();

		if($result) {

			// tambahkan data ke array jika query diatas sukses
			array_push($dataPembelian,$result);

			// query mendapatkan list barang
			//  ->tabel detail_pengeluaran
			//  ->tabel barang
			$query = 'SELECT dp.id, dp.kd_pembelian ,dp.kd_barang, b.nama, dp.qty, dp.subtotal';
			$query .= ' FROM detail_pembelian dp';
			$query .= ' JOIN barang b ON dp.kd_barang=b.id';
			$query .= ' WHERE dp.kd_pembelian='.$id;
			
			$statement = $koneksi->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();

			if($result){
				// tambahkan data ke array jika query diatas sukses
				array_push($dataPembelian,$result);
			}else{
				$status = false;
			}

		}else{
			$status = false;
		}

		if(!$status){
			$errorDb = true;
			$pesanError = "Gagal mendapatkan info pembelian";
		}

		// data yg dikeluarkan ke user
		$output = array(
			'status' => $status,
			'errorDb' => $errorDb,
			'pesanError' => $pesanError,
			'info' => $dataPembelian,
			'id'=> $id, 
		);

		echo json_encode($output);

	}

	// fungsi action edit
	function actionEdit($koneksi){
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

	// mendapatkan kode pengeluaran terakhir pada hari ini (internal)
	// function getKdPengeluaran($koneksi){
	// 	$kode = date("Y").date("m").date("d");
	// 	$query = "SELECT kd_pengeluaran FROM pengeluaran WHERE kd_pengeluaran LIKE '%".$kode."%' ORDER BY id desc LIMIT 1";

	// 	// prepare
	// 	$statement = $koneksi->prepare($query);
	// 	// execute
	// 	$statement->execute();
	// 	$result = $statement->fetch();
		
	// 	$kd_pengeluaran = "";
	// 	if(empty($result)){
	// 		$kd_pengeluaran = 'PG-'.$kode.'-1';
	// 	}else{
	// 		$iterasi = explode("-", $result['kd_pengeluaran']);
	// 		// var_dump($iterasi);
	// 		$count = $iterasi[2] + 1;
	// 		$kd_pengeluaran = $kd_pengeluaran = 'PG-'.$kode.'-'.$count;
	// 	}
		
	// 	return $kd_pengeluaran;
	// }

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
			// array(
			// 	'field' => $data['tgl'], 'label' => 'Tanggal', 'error' => 'tglError',
			// 	'value' => 'tgl', 'rule' => 'string | 10 | 10 | required',
			// ),
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
				'value' => 'harga', 'rule' => 'angka | 1 | 999999 | required',
			),
			// data qty
			array(
				'field' => $data['qty'], 'label' => 'Qty', 'error' => 'qtyError',
				'value' => 'qty', 'rule' => 'angka | 1 | 999 | required',
			),
			// data ket
			array(
				'field' => $data['ket'], 'label' => 'Keterangan', 'error' => 'ketError',
				'value' => 'ket', 'rule' => 'string | 1 | 255 | not_required',
			),
		);

		return $configData;
	}