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
		if(strtolower($action) === "list") list_idBarang($koneksi); // list datatable
		else if(strtolower($action) === "tambah") actionAdd($koneksi); // aksi tambah
		else if(strtolower($action) === "getedit"){ // get data untuk edit
			$id = isset($_POST['id']) ? $_POST['id'] : false;
			getEdit($koneksi, $id);
		}
		else if(strtolower($action) === "edit") actionEdit($koneksi); // aksi edit
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
			$aksi = '<button type="button" class="btn btn-success" onclick="edit_id_barang('."'".$row["id"]."'".')">Edit</button>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['id_barang'];
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
		$id_barang = isset($_POST['fId_barang']) ? $_POST['fId_barang'] : false;
		$nama = isset($_POST['fNama_idBarang']) ? $_POST['fNama_idBarang'] : false;

		// validasi
			// inisialisasi
			$cek = true;
			$pesanError = $id_barangError = $namaBarangError = $set_value = "";
			// inisialisasi pemanggilan fungsi validasi
			$validIdBarang = validString("ID Barang", $id_barang, 1, 4, true);
			$validNamaBarang = validString("Nama Barang", $nama, 1, 25, true);

			// cek valid
			if(!$validIdBarang['cek']){
				$cek = false;
				$id_barangError = $validIdBarang['error'];
			}

			if(!$validNamaBarang['cek']){
				$cek = false;
				$namaBarangError = $validNamaBarang['error'];
			}
		// ==================================== //
		if($cek){
			$id_barang = validInputan($id_barang, false, false);
			$nama = validInputan($nama, false, false);

			$tabel = "id_barang";
			$query = "INSERT INTO $tabel (id_barang, nama) VALUES (:id_barang, :nama)";

			// prepare
			$statement = $koneksi->prepare($query);
			// bind
			$statement->bindParam(':id_barang', $id_barang);
			$statement->bindParam(':nama', $nama);
			// execute
			$result = $statement->execute(
				array(
					':id_barang' => $id_barang,
					':nama' => $nama,
				)
			);
			
			// jika query berhasil
			if($result){
				$output = array(
					'status' => true,
					'errorDb' => false,
				);
			} 
			else{
				$output = array(
					'status' => false,
					'errorDb' => true,
				);
			}

			echo json_encode($output);
		}
		else{
			$pesanError = array(
				'id_barangError' => $id_barangError,
				'namaBarangError' => $namaBarangError, 
			);

			$set_value = array(
				'id_barang' => $id_barang,
				'namaBarang' => $nama,
			);

			$output = array(
				'status' => false,
				'errorDb' => false,
				'pesanError' => $pesanError,
				'set_value' => $set_value,
			);

			echo json_encode($output);
		}
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
		$id = isset($_POST['id']) ? $_POST['id'] : false;
		$id_barang = isset($_POST['fId_barang']) ? $_POST['fId_barang'] : false;
		$nama = isset($_POST['fNama_idBarang']) ? $_POST['fNama_idBarang'] : false;

		// validasi
			// inisialisasi
			$cek = true;
			$pesanError = $id_barangError = $namaBarangError = $set_value = "";
			// inisialisasi pemanggilan fungsi validasi
			$validIdBarang = validString("ID Barang", $id_barang, 1, 4, true);
			$validNamaBarang = validString("Nama Barang", $nama, 1, 25, true);

			// cek valid
			if(!$validIdBarang['cek']){
				$cek = false;
				$id_barangError = $validIdBarang['error'];
			}

			if(!$validNamaBarang['cek']){
				$cek = false;
				$namaBarangError = $validNamaBarang['error'];
			}
		// ==================================== //

		if($cek){
			$id_barang = validInputan($id_barang, false, false);
			$nama = validInputan($nama, false, false);

			$tabel = "id_barang";
			$query = "UPDATE $tabel SET id_barang = :id_barang, nama = :nama WHERE id = :id";

			// prepare
			$statement = $koneksi->prepare($query);
			// bind
			$statement->bindParam(':id_barang', $id_barang);
			$statement->bindParam(':nama', $nama);
			$statement->bindParam(':id', $id);
			// execute
			$result = $statement->execute(
				array(
					':id_barang' => $id_barang,
					':nama' => $nama,
					':id' => $id,
				)
			);
			
			// jika query berhasil
			if($result){
				$output = array(
					'status' => true,
					'errorDb' => false,
				);
			} 
			else{
				$output = array(
					'status' => false,
					'errorDb' => true,
				);
			}

			echo json_encode($output);
		}
		else{
			$pesanError = array(
				'id_barangError' => $id_barangError,
				'namaBarangError' => $namaBarangError, 
			);

			$set_value = array(
				'id_barang' => $id_barang,
				'namaBarang' => $nama,
			);

			$output = array(
				'status' => false,
				'errorDb' => false,
				'pesanError' => $pesanError,
				'set_value' => $set_value,
			);

			echo json_encode($output);
		}
	}