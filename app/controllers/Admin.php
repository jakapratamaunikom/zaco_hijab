<?php
	// session_start();
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");
	include_once("../models/Admin_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;

	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'list':
				list_admin($koneksi); // list datatable
				break;

			case 'tambah':
				actionAdd($koneksi);
				break;

			default:
				die();
				break;
		}
	}

	function list_admin($koneksi){
		$config_db = array(
			'tabel' => 'admin',
			'kolomOrder' => array(null, 'username', 'nama', 'email', 'level', 'status', null),
			'kolomCari' => array('username', 'nama', 'email', 'level', 'status'),
			'orderBy' => array('level' => 'asc'),
			'kondisi' => false,
		);

		$data_admin = get_all_admin($koneksi, $config_db);

		// siapkan data untuk isi datatable
		$data = array();
		$no_urut = $_POST['start'];
		foreach($data_admin as $row){
			$status = $row['status'] == "1" ? "AKTIF" : "NONAKTIF";
			$no_urut++;
			$aksi = '<a role="button" class="btn btn-info btn-flat btn-sm" href="'.base_url.'index.php?m=admin&p=view&id='.$row["id"].'">Detail</a>';
			$aksi .= '<button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down"></i> Edit</button>';
			$aksi .= '<ul class="dropdown-menu"><li><a role="button" href="'.base_url.'index.php?m=admin&p=form&id='.$row["id"].'"><i class="fa fa-plus"></i> Edit Profil</a></li>';
			$aksi .= '<li><a role="button" onclick="edit_status('."'".$row["username"]."'".')"><i class="fa fa-plus"></i> Edit Status</a></li>';
			
			$dataRow = array();
			$dataRow[] = $no_urut;
			$dataRow[] = $row['username'];
			$dataRow[] = $row['nama'];
			$dataRow[] = $row['email'];
			$dataRow[] = $row['level'];
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

	function actionAdd($koneksi){
		$username = isset($_POST['username']) ? $_POST['username'] : "";
		$password = isset($_POST['password']) ? $_POST['password'] : "";
		$confpassword = isset($_POST['confirm']) ? $_POST['confirm'] : "";
		$email = isset($_POST['email']) ? $_POST['email'] : "";
		$level = isset($_POST['level']) ? $_POST['level'] : "";
		$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
		$notelp = isset($_POST['telp']) ? $_POST['telp'] : "";
		$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : "";
		$foto = isset($_FILES['foto']) ? $_FILES['foto'] : "";

		// inisialisasi
			$cek = true;
			$status = false;
			$errorDb = false;
			$duplikat = false;
			$usernameError = $passwordError = $confpasswordError = $emailError = $fotoError = "";
			$levelError = $namaError = $notelpError = $alamatError  = "";
			$pesanError = $set_value = "";

			$valid_username = validString("Username", $username, 5, 10, true);
			$valid_password = validString("Password", $password, 6, 10, true);

			// cek valid
			if(!$valid_username['cek']){
				$cek = false;
				$usernameError = $valid_username['error'];
			}

			if(!$valid_password['cek']){
				$cek = false;
				$passwordError = $valid_password['error'];
			}

			if($password !== $confpassword){
				$cek = false;
				$confpasswordError = $passwordError = "Password dan Confirm Password tidak sama !";
			}

			$pesanError = array(
				'usernameError' => $usernameError,
				'passwordError' => $passwordError,
				'confpasswordError' => $confpasswordError,

			);

			$set_value = array(
				'username' => $username,
				'password' => $password,
				'confirm' => $confpassword,

			);

		// ===========================================

		if ($cek) {
			$username = validInputan($username, false, true);
			$password = validInputan($password, false, true);

			// cek duplikat id barang
			$config_duplikat = array(
				'tabel' => 'admin',
				'field' => 'username',
				'value' => $username,
			);

			if(cekDuplikat($koneksi, $config_duplikat)){ // jika ada yg sama
				$status = false;
				$errorDb = false;
				$duplikat = true;
			}else{
				$duplikat = false;
			}

		}
		else $status = false;
			
		$output = array(
			'status' => $status,
			'errorDb' => $errorDb,
			'duplikat' => $duplikat,
			'pesanError' => $pesanError,
			'set_value' => $set_value,
		);
		echo json_encode($output);
	}

	function configData($data){
		$configData = array(
			// data username
			array(
				'field' => $data['username'], 'label' => 'Username', 'error' => 'usernameError',
				'value' => 'username', 'rule' => 'string | 1 | 10 | required',
			),
			// data password
			array(
				'field' => $data['password'], 'label' => 'Password', 'error' => 'passwordError',
				'value' => 'password', 'rule' => 'string | 6 | 20 | required',
			),
			// data confirm password
			array(
				'field' => $data['konf_pass'], 'label' => 'Konfirm Password', 'error' => 'konf_passError',
				'value' => 'konf_pass', 'rule' => 'string | 6 | 20 | required',
			),
			// data nama
			array(
				'field' => $data['id_barang'], 'label' => 'ID Barang', 'error' => 'id_barangError',
				'value' => 'id_barang', 'rule' => 'string | 1 | 4 | required',
			),
			// data email
			array(
				'field' => $data['id_barang'], 'label' => 'ID Barang', 'error' => 'id_barangError',
				'value' => 'id_barang', 'rule' => 'string | 1 | 4 | required',
			),
			// data level
			array(
				'field' => $data['id_barang'], 'label' => 'ID Barang', 'error' => 'id_barangError',
				'value' => 'id_barang', 'rule' => 'string | 1 | 4 | required',
			),
			// data telp
			array(
				'field' => $data['id_barang'], 'label' => 'ID Barang', 'error' => 'id_barangError',
				'value' => 'id_barang', 'rule' => 'string | 1 | 4 | required',
			),
			// data alamat
			array(
				'field' => $data['id_barang'], 'label' => 'ID Barang', 'error' => 'id_barangError',
				'value' => 'id_barang', 'rule' => 'string | 1 | 4 | required',
			),
		);

		return $configData;
	}