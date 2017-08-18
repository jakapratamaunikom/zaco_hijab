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
				list_idWarna($koneksi); // list datatable
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
	function list_idWarna($koneksi){
		/* 
			configurasi tabel id warna
			=> kolom yg ditampilkan di datatable:
				-> no, id_warna, nama, aksi (berisi id)
		*/
		$config_db = array(
			'tabel' => 'id_warna',
			'kolomOrder' => array(null, 'id_warna', 'nama', null),
			'kolomCari' => array('id_warna', 'nama'),
			'orderBy' => array('id' => 'asc'),
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
			$aksi = '<button type="button" class="btn btn-success" onclick="edit_id_warna('."'".$row["id"]."'".')">Edit</button>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['id_warna'];
			$dataRow[] = $row['nama'];
			$dataRow[] = $aksi;

			$data[] = $dataRow;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => recordTotal($koneksi, $config_db['tabel']),
			'recordsFiltered' => recordFilter($koneksi, $config_db),
			'data' => $data,
		);

		echo json_encode($output);
	}

	// fungsi action add
	function actionAdd($koneksi){
		$id_warna = isset($_POST['id_warna']) ? $_POST['id_warna'] : false;
		$nama = isset($_POST['nama']) ? $_POST['nama'] : false;

		// validasi inputan
			// inisialisasi
			$cek = true;
			$status = false;
			$errorDb = false;
			$duplikat = false;
			$pesanError = $id_warnaError = $namaWarnaError = $set_value = "";
			// inisialisasi pemanggilan fungsi validasi
			$validIdWarna = validString("ID Warna", $id_warna, 1, 4, true);
			$validNamaWarna = validString("Nama Warna", $nama, 1, 25, true);

			// cek valid
			if(!$validIdWarna['cek']){
				$cek = false;
				$id_warnaError = $validIdWarna['error'];
			}

			if(!$validNamaWarna['cek']){
				$cek = false;
				$namaWarnaError = $validNamaWarna['error'];
			}

			$pesanError = array(
				'id_warnaError' => $id_warnaError,
				'namaWarnaError' => $namaWarnaError, 
			);

			$set_value = array(
				'id_warna' => $id_warna,
				'namaWarna' => $nama,
			);

		// ==================================== //
		if($cek){
			$id_warna = validInputan($id_warna, false, false);
			$nama = validInputan($nama, false, false);

			// cek duplikat id barang
			$config_duplikat = array(
				'tabel' => 'id_warna',
				'field' => 'id_warna',
				'value' => $id_warna,
			);

			if(cekDuplikat($koneksi, $config_duplikat)){ // jika ada yg sama
				$status = false;
				$errorDb = false;
				$duplikat = true;
			}
			else{
				$duplikat = false;

				$tabel = "id_warna";
				$query = "INSERT INTO $tabel (id_warna, nama) VALUES (:id_warna, :nama)";

				// prepare
				$statement = $koneksi->prepare($query);
				// bind
				$statement->bindParam(':id_warna', $id_warna);
				$statement->bindParam(':nama', $nama);
				// execute
				$result = $statement->execute(
					array(
						':id_warna' => $id_warna,
						':nama' => $nama,
					)
				);
				
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
		$tabel = "id_warna";
		// query
		$query = "SELECT id, id_warna, nama FROM $tabel WHERE id = :id";

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
		$id = isset($_POST['id']) ? $_POST['id'] : false;
		$id_warna = isset($_POST['id_warna']) ? $_POST['id_warna'] : false;
		$nama = isset($_POST['nama']) ? $_POST['nama'] : false;

		// validasi
			// inisialisasi
			$cek = true;
			$cek = true;
			$status = false;
			$errorDb = false;
			$duplikat = false;
			$pesanError = $id_warnaError = $namaWarnaError = $set_value = "";
			// inisialisasi pemanggilan fungsi validasi
			$validIdWarna = validString("ID Warna", $id_warna, 1, 4, true);
			$validNamaWarna = validString("Nama Warna", $nama, 1, 25, true);

			// cek valid
			if(!$validIdWarna['cek']){
				$cek = false;
				$id_warnaError = $validIdWarna['error'];
			}

			if(!$validNamaWarna['cek']){
				$cek = false;
				$namaWarnaError = $validNamaWarna['error'];
			}

			$pesanError = array(
				'id_warnaError' => $id_warnaError,
				'namaWarnaError' => $namaWarnaError, 
			);

			$set_value = array(
				'id_warna' => $id_warna,
				'namaWarna' => $nama,
			);
		// ==================================== //

		if($cek){
			$id_warna = validInputan($id_warna, false, false);
			$nama = validInputan($nama, false, false);

			$tabel = "id_warna";
			$query = "UPDATE $tabel SET id_warna = :id_warna, nama = :nama WHERE id = :id";

			// prepare
			$statement = $koneksi->prepare($query);
			// bind
			$statement->bindParam(':id_warna', $id_warna);
			$statement->bindParam(':nama', $nama);
			$statement->bindParam(':id', $id);
			// execute
			$result = $statement->execute(
				array(
					':id_warna' => $id_warna,
					':nama' => $nama,
					':id' => $id,
				)
			);
			
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