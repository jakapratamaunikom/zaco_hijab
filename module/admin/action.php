<?php
	// session_start();
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../../function/helper.php");
	include_once("../../function/koneksi.php");
	include_once("../../function/validasi_form.php");
	include_once("../../function/datatable.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;

	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'tambah':
				actionAdd($koneksi);
				break;
			default:
				die();
				break;
		}
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
