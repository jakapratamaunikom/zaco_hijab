<?php
	date_default_timezone_set('Asia/Jakarta');

	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../models/Admin_model.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;

	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch (strtolower($action)) {
			case 'login':
				session_start();
				login($koneksi);
				break;
			
			default:
				die();
				break;
		}
	}

	function login($koneksi){
		$cek = true;
		$status = false;
		$usernameError = $passwordError = $pesanError = $set_value = "";

		$username = validInputan($_POST['username'], false, true);
		$password = validInputan($_POST['password'], false, true);

		if(empty($username) || empty($password)){
			$cek = false;
			$usernameError = $passwordError = "Username dan Password Harap Diisi";
		}
		else{
			$data_login = get_login($koneksi, $username);
			if(!$data_login){
				$cek = false;
				$usernameError = $passwordError = "Username atau Password Anda Salah !";
			}
			else{
				if(password_verify($password, $data_login['password'])) $cek = true;
				else $cek = false;
			}
		}

		if($cek){
			// cek status aktif
			if($data_login['status'] === "1"){
				// cek level dan hak akses
				$hak_akses = set_hak_akses($data_login['level']);
				$status = true;
				// set session
				$_SESSION['sess_username'] = $data_login['username'];
				$_SESSION['sess_nama'] = $data_login['nama'];
				$_SESSION['sess_email'] = $data_login['email'];
				$_SESSION['sess_foto'] = $data_login['foto'];
				$_SESSION['sess_status'] = $data_login['status'];
				$_SESSION['sess_level'] = $data_login['level'];
				$_SESSION['sess_akses'] = $hak_akses;
				$_SESSION['sess_lockscreen'] = false;
			}
			else{
				$status = false;
				$usernameError = $passwordError = "Username atau Password Anda Salah !";
			}
		}
		else $status = false;

		$_SESSION['sess_login'] = $status;

		$pesanError = array(
			'username' => $usernameError,
			'password' => $passwordError,
		);

		$set_value = array(
			'username' => $username,
			'password' => $password,
		);

		$output = array(
			'status' => $status,
			'pesanError' => $pesanError,
			'set_value' => $set_value,
		);

		echo json_encode($output);
	}

	function set_hak_akses($level){
		switch (strtolower($level)) {
			case 'admin':
				$hak_akses = array(
					'beranda', 'penjualan', 'reject', 'pembelian', 'stok', 'pengeluaran', 'id_barang', 'id_warna', 'barang', 'admin'
				);	
				break;
			
			default:
				$hak_akses = array(
					'beranda', 'penjualan', 'reject', 'stok', 'id_barang', 'id_warna', 'barang'
				);
				break;
		}

		return $hak_akses;
	}