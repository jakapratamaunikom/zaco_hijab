<?php
	// session_start();
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	// load model
	include_once("../models/Barang_model.php");
	include_once("../models/Stok_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	// $action = "coba";

	// proteksi halaman
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'list':
				list_Barang($koneksi); // list datatable
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

			case 'setstatus':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				$status = isset($_POST['status']) ? $_POST['status'] : false;
				setStatus($koneksi, $id, $status);
				break;

			case 'edit_foto':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				edit_foto($koneksi, $id);
				break;

			case 'hapus_foto':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				hapus_foto($koneksi, $id);
				break;

			case 'getview':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				getView($koneksi, $id);
				break;

			case 'liststok':
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				list_BarangStok($koneksi, $id);
				break;

			case 'getselect':
				// aksi set select dinamis
				$select = isset($_POST['select']) ? $_POST['select'] : false;
				getSelect($koneksi, $select);
				break;
			
			default:
				die();
				break;
		}
	}

	// function list datatable (server-side)
	function list_Barang($koneksi){
		/* 
			configurasi tabel barang
			=> kolom yg ditampilkan di datatable:
				-> no, kd_barang, nama, hpp, harga_pasar, market_place, harga_ig, ket, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'v_barang',
			'kolomOrder' => array(null, 'kd_barang', 'nama', 'hpp', 'harga_pasar', 'market_place', 'harga_ig', null, 'stok', 'status', null),
			'kolomCari' => array('kd_barang', 'nama', 'hpp', 'harga_pasar', 'market_place', 'harga_ig', 'stok', 'status'),
			'orderBy' => false,
			'kondisi' => false,
		);

		$data_barang = get_all_barang($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_barang as $row){
			$ket = !empty($row['ket']) ? $row['ket'] : "-";
			$status = strtolower($row['status'])=='aktif' ? '<span class="label label-success">'.$row['status'].'</span>' : '<span class="label label-danger">'.$row['status'].'</span>';

			$no_urut++;
			$aksi = '<a role="button" class="btn btn-info btn-flat btn-sm" href="'.base_url.'index.php?m=barang&p=view&id='.$row["id"].'">Detail</a>';
			$aksi .= '<a role="button" class="btn btn-success btn-flat btn-sm" href="'.base_url.'index.php?m=barang&p=form&id='.$row["id"].'">Edit</a>';
			$aksi .= '<button type="button" class="btn btn-danger btn-flat btn-sm" onclick="edit_status('."'".$row["id"]."'".', '."'".strtolower($row["status"])."'".')">Edit Status</button>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['kd_barang'];
			$dataRow[] = $row['nama'];
			$dataRow[] = rupiah($row['hpp']);
			$dataRow[] = rupiah($row['harga_pasar']);
			$dataRow[] = rupiah($row['market_place']);
			$dataRow[] = rupiah($row['harga_ig']);
			$dataRow[] = $ket;
			$dataRow[] = $row['stok'];
			$dataRow[] = $status;
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
		$foto = isset($_FILES['foto']) ? $_FILES['foto'] : false;

		// validasi inputan
			// inisialisasi
			$cekFoto = true;
			$status = $errorDb = $duplikat = false;

			$configData = configData($dataForm);
			$validasi = set_validasi($configData);
			$cek = $validasi['cek'];
			$pesanError = $validasi['setError'];
			$set_value = $validasi['setValue'];

			// jika terdeteksi ada input foto
			if($foto){
				$configFoto = array(
					'error' => $foto['error'],
					'size' => $foto['size'],
					'name' => $foto['name'],
					'tmp_name' => $foto['tmp_name'],
					'max' => 2*1048576,
				);
				$valid_foto = validFoto($configFoto);
				if(!$valid_foto['cek']){
					$cek = false;
					$pesanError['fotoError'] = $valid_foto['error'];
				}
				else $valueFoto = "barang/".$valid_foto['namaFile'];
			}
			else $valueFoto = "";

		// ==================================== //
		if($cek){
			// validasi inputan dari inject
			$dataForm = array(
				'id_barang' => validInputan($dataForm['id_barang'], false, false),
				'id_warna' => validInputan($dataForm['id_warna'], false, false),
				'kd_barang' => validInputan($dataForm['kd_barang'], false, false),
				'nama' => validInputan($dataForm['nama'], false, false),
				'ket' => validInputan($dataForm['ket'], false, false),
				'hpp' => validInputan($dataForm['hpp'], false, false),
				'harga_pasar' => validInputan($dataForm['harga_pasar'], false, false),
				'market_place' => validInputan($dataForm['market_place'], false, false),
				'harga_ig' => validInputan($dataForm['harga_ig'], false, false),
				'stokAwal' => validInputan($dataForm['stokAwal'], false, false),
				'foto' => validInputan($valueFoto, false, true),
				'status' => '1',
			);

			// cek duplikat id barang
			$config_duplikat = array(
				'tabel' => 'v_barang',
				'field' => 'kd_barang',
				'value' => $dataForm['kd_barang'],
			);

			if(cekDuplikat($koneksi, $config_duplikat)){ // jika ada yg sama
				$status = $errorDb = false;
				$duplikat = true;
			}
			else{
				$duplikat = false;

				// upload foto
				if($foto){
					$path = "../../assets/gambar/$valueFoto";
					if(!move_uploaded_file($foto['tmp_name'], $path)){
						$pesanError['fotoError'] = "Upload Foto Gagal";
						$status = $cekFoto = false;
					}
				}

				if($cekFoto){					
					// jika query berhasil
					if(insertBarang($koneksi, $dataForm)){
						$status = true;
						$errorDb = false;
						session_start();
						$_SESSION['notif'] = "Tambah Data Berhasil";
					} 
					else{
						$status = false;
						$errorDb = true;
					}
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
		$data_barang = get_barang_by_id($koneksi, $id);

		if(!$data_barang){
			session_start();
			$_SESSION['notif'] = "gagal";
		} 

		echo json_encode($data_barang);
	}

	// fungsi action edit
	function actionEdit($koneksi){
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
			$dataForm = array(
				'id' => validInputan($dataForm['id'], false, false),
				'id_barang' => validInputan($dataForm['id_barang'], false, false),
				'id_warna' => validInputan($dataForm['id_warna'], false, false),
				'kd_barang' => validInputan($dataForm['kd_barang'], false, false),
				'nama' => validInputan($dataForm['nama'], false, false),
				'ket' => validInputan($dataForm['ket'], false, false),
				'hpp' => validInputan($dataForm['hpp'], false, false),
				'harga_pasar' => validInputan($dataForm['harga_pasar'], false, false),
				'market_place' => validInputan($dataForm['market_place'], false, false),
				'harga_ig' => validInputan($dataForm['harga_ig'], false, false),
				'stokAwal' => validInputan($dataForm['stokAwal'], false, false),
			);
			
			// jika query berhasil
			if(updateBarang($koneksi, $dataForm)){
				$status = true;
				$errorDb = false;
				session_start();
				$_SESSION['notif'] = "Edit Data Berhasil";
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

	// fungsi edit status
	function setStatus($koneksi, $id, $status){
		if(updateStatusBarang($koneksi, $id, $status)){
			$status = true;
			$errorDb = false;
		}
		else{
			$status = false;
			$errorDb = true;
		}

		$output = array(
			'status' => $status,
			'errorDb' => $errorDb,
		);

		echo json_encode($output);
	}

	// fungsi edit foto
	function edit_foto($koneksi, $id){
		$foto = isset($_FILES['foto']) ? $_FILES['foto'] : false;
		$cek = $statusUpload = true;
		$fotoError = "";

		// validasi
		if($foto){
			$configFoto = array(
				'error' => $foto['error'],
				'size' => $foto['size'],
				'name' => $foto['name'],
				'tmp_name' => $foto['tmp_name'],
				'max' => 2*1048576,
			);
			$valid_foto = validFoto($configFoto);
			if(!$valid_foto['cek']){
				$cek = $statusUpload = false;
				$fotoError = $valid_foto['error'];
			}
			else $fotoBaru = "barang/".$valid_foto['namaFile'];
		}
		else $cek = $statusUpload = $foto;

		if($cek){
			// get foto yg ingin diganti
			$get_foto = get_foto_by_id($koneksi, $id);

			// cek apakah foto ada/tidak
			$fotoLama = !empty($get_foto['foto']) ? "../../assets/gambar/".$get_foto['foto'] : false;
			if($fotoLama){
				// cek foto di dir
				if(file_exists($fotoLama)) $statusHapus = true;
				else $statusHapus = false;			
			}
			else $statusHapus = false;

			$path = "../../assets/gambar/$fotoBaru";
			if(!move_uploaded_file($foto['tmp_name'], $path)){
				$fotoError = "Upload Foto Gagal";
				$statusUpload = false;
			}
			else{
				// update ke db
				$dataFoto = array('foto' => $fotoBaru, 'id' => $id);
				updateFoto($koneksi, $dataFoto);
			}
		}
		else $statusHapus = false;

		if($statusHapus) unlink($fotoLama); // hapus foto lama

		$output = array(
			'pesanError' => $fotoError,
			'statusHapus' => $statusHapus,
			'statusUpload' => $statusUpload,
		);

		echo json_encode($output);
	}

	// fungsi hapus foto
	function hapus_foto($koneksi, $id){
		$cek = true;
		$fotoError = "";

		// get data foto yang ingin di hapus
		$get_foto = get_foto_by_id($koneksi, $id);

		// cek hasil result
		$fotoLama = !empty($get_foto['foto']) ? "../../assets/gambar/".$get_foto['foto'] : false;

		if($fotoLama){ // jika di db terdata
			// cek foto apakah valid
			if(file_exists($fotoLama)) $statusHapus = true;
			else $statusHapus = false;
		}
		else $statusHapus = false; // jika foto kosong

		// update foto set ""
		$dataFoto = array('foto' => "", 'id' => $id);

		if(!updateFoto($koneksi, $dataFoto)) $cek = false;
		else{
			if($statusHapus) unlink($fotoLama);
		}

		$output = array(
			'status' => $cek,
			'statusHapus' => $statusHapus,
		);

		echo json_encode($output);
	}

	// fungsi get view
	function getView($koneksi, $id){
		// get data barang
		$get_barang = get_barang_by_id($koneksi, $id);

		if(!$get_barang){
			session_start();
			$_SESSION['notif'] = "gagal";
			$data = $get_barang;
		}
		else{
			$cekFoto = !empty($get_barang['foto']) ? $get_barang['foto'] : "default.jpg";

			if(!file_exists("../../assets/gambar/".$cekFoto)){
				$cekFoto = "default.jpg";
			}

			// format data
			$data = array(
				'id' => $get_barang['id'],
				'id_barang' => $get_barang['id_idBarang'],
				'id_warna' => $get_barang['id_idWarna'],
				'kd_barang' => $get_barang['kd_barang'],
				'nama' => $get_barang['nama'],
				'hpp' => rupiah($get_barang['hpp']),
				'harga_pasar' => rupiah($get_barang['harga_pasar']),
				'market_place' => rupiah($get_barang['market_place']),
				'harga_ig' => rupiah($get_barang['harga_ig']),
				'foto' => $cekFoto,
				'ket' => $get_barang['ket'],
			);
		}

		echo json_encode($data);
	}

	// function list stok barang
	function list_BarangStok($koneksi, $id){
		// get data stok
		$config_db = array(
			'tabel' => 'stok',
			'kolomOrder' => array(null, 'tgl', 'stok_awal', 'brg_masuk', 'brg_keluar', 'stok_akhir'),
			'kolomCari' => array('tgl', 'stok_awal', 'brg_masuk', 'brg_keluar', 'stok_akhir'),
			'orderBy' => array('id' => 'desc'),
			'kondisi' => "WHERE kd_barang = $id",
		);

		// get data stok barang
		$data_stokBarang = get_all_stok($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_stokBarang as $row){
			$no_urut++;

			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = cetakTgl($row['tgl'],"full");
			$dataRow[] = $row['stok_awal'];
			$dataRow[] = $row['brg_masuk'];
			$dataRow[] = $row['brg_keluar'];
			$dataRow[] = $row['stok_akhir'];

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

	// fungsi set data untuk di validasi
	function configData($data){
		$required = $_POST['action'] == "edit" ? "not_required" : "required";

		$configData = array(
			// data id_barang
			array(
				'field' => $data['id_barang'], 'label' => 'ID Barang', 'error' => 'id_barangError',
				'value' => 'id_barang', 'rule' => 'string | 1 | 4 | required',
			),
			// data id_warna
			array(
				'field' => $data['id_warna'], 'label' => 'ID Warna', 'error' => 'id_warnaError',
				'value' => 'id_warna', 'rule' => 'string | 1 | 4 | required',
			),
			// data kd_barang
			array(
				'field' => $data['kd_barang'], 'label' => 'Kode Barang', 'error' => 'kd_barangError',
				'value' => 'kd_barang', 'rule' => 'string | 1 | 15 | required',
			),
			// data nama barang
			array(
				'field' => $data['nama'], 'label' => 'Nama Barang', 'error' => 'id_barangError',
				'value' => 'nama', 'rule' => 'string | 1 | 50 | required',
			),
			// data ket
			array(
				'field' => $data['ket'], 'label' => 'Keterangan', 'error' => 'ketError',
				'value' => 'ket', 'rule' => 'string | 1 | 255 | not_required',
			),
			// data hpp
			array(
				'field' => $data['hpp'], 'label' => 'HPP', 'error' => 'hppError',
				'value' => 'hpp', 'rule' => 'nilai | 1 | 999999 | required',
			),
			// data harga_pasar
			array(
				'field' => $data['harga_pasar'], 'label' => 'Harga Pasar', 'error' => 'harga_pasarError',
				'value' => 'harga_pasar', 'rule' => 'nilai | 1 | 999999 | required',
			),
			// data market place
			array(
				'field' => $data['market_place'], 'label' => 'Harga Market Place', 'error' => 'market_placeError',
				'value' => 'market_place', 'rule' => 'nilai | 1 | 999999 | required',
			),
			// data harga ig
			array(
				'field' => $data['harga_ig'], 'label' => 'Harga IG', 'error' => 'harga_igError',
				'value' => 'harga_ig', 'rule' => 'nilai | 1 | 999999 | required',
			),
			// data stok awal
			array(
				'field' => $data['stokAwal'], 'label' => 'Stok Awal', 'error' => 'stokAwalError',
				'value' => 'stokAwal', 'rule' => 'nilai | 1 | 999999 | '.$required,
			),
		);

		return $configData;
	}