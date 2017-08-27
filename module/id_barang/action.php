<?php
	// action
	
	session_start();

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

		// panggil fungsi get datatable
		$query = get_dataTable($config_db);

		// persiapkan eksekusi query
		$statement = $koneksi->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($result as $row){
			$no_urut++;
			$aksi = '<button type="button" class="btn btn-success btn-flat btn-sm" onclick="edit_id_barang('."'".$row["id"]."'".')">Edit</button>';
			
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
			$pesanError = $validasi['pesanError'];
			$set_value = $validasi['set_value'];

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

				$query = "INSERT INTO id_barang (id_barang, nama) VALUES (:id_barang, :nama)";
				// prepare
				$statement = $koneksi->prepare($query);
				// bind
				$statement->bindParam(':id_barang', $dataForm['id_barang']);
				$statement->bindParam(':nama', $dataForm['nama']);
				// execute
				$result = $statement->execute();
				
				// jika query berhasil
				if($result){
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
		// $id = "11";
		$tabel = "id_barang";
		// query
		$query = "SELECT id, id_barang, nama FROM $tabel WHERE id = :id";

		// prepare
		$statement = $koneksi->prepare($query);
		// bind
		$statement->bindParam(':id', $id);
		// execute
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		echo json_encode($result);
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
			$pesanError = $validasi['pesanError'];
			$set_value = $validasi['set_value'];
		// ==================================== //

		if($cek){
			// validasi inputan dari inject
			$dataForm['nama'] = validInputan($dataForm['nama'], false, false);

			$query = "UPDATE id_barang SET nama = :nama WHERE id = :id";
			// prepare
			$statement = $koneksi->prepare($query);
			// bind
			$statement->bindParam(':nama', $dataForm['nama']);
			$statement->bindParam(':id', $dataForm['id']);
			// execute
			$result = $statement->execute();
			
			// jika query berhasil
			if($result){
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