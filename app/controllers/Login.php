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
				else{
					$usernameError = $passwordError = "Username atau Password Anda Salah !";
					$cek = false;
				} 		
			}
		}

		if($cek){
			// cek status aktif
			if($data_login['status'] === "1"){
				// cek level dan hak akses
				$hak_akses = set_hak_akses($data_login['level']);
				$status = true;
				// set session
				$_SESSION['sess_login'] = $status;
				$_SESSION['sess_username'] = $data_login['username'];
				$_SESSION['sess_nama'] = $data_login['nama'];
				$_SESSION['sess_email'] = $data_login['email'];
				$_SESSION['sess_foto'] = $data_login['foto'];
				$_SESSION['sess_status'] = $data_login['status'];
				$_SESSION['sess_level'] = $data_login['level'];
				$_SESSION['sess_akses'] = $hak_akses;
				$_SESSION['sess_lockscreen'] = false;
				// $_SESSION['sess_time'] = false;
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
		$akses = array(
			'beranda' => '<li class="menu-beranda"><a href="'.base_url.'"><i class="fa fa-link"></i><span>Beranda</span></a></li>', 
			'penjualan' => '<li class="menu-penjualan"><a href="'.base_url.'index.php?m=penjualan&p=list"><i class="fa fa-link"></i><span>Data Penjualan</span></a></li>', 
			'reject' => '<li class="menu-reject"><a href="'.base_url.'index.php?m=reject&p=list"><i class="fa fa-link"></i><span>Data Reject</span></a></li>', 
			'pembelian' => '<li class="menu-pembelian"><a href="'.base_url.'index.php?m=pembelian&p=list"><i class="fa fa-link"></i><span>Data Pembelian</span></a></li>', 
			'stok' => '<li class="menu-stok"><a href="'.base_url.'index.php?m=stok&p=list"><i class="fa fa-link"></i><span>Data Stok</span></a></li>', 
			'pengeluaran' => '<li class="menu-pengeluaran"><a href="'.base_url.'index.php?m=pengeluaran&p=list"><i class="fa fa-link"></i><span>Data Pengeluaran</span></a></li>',
			'data_master' => array(
					'id_barang' => '<li><a href="'.base_url.'index.php?m=id_barang&p=list">Data Id Barang</a></li>', 
					'id_warna' => '<li><a href="'.base_url.'index.php?m=id_warna&p=list">Data Id Warna</a></li>', 
					'barang' => '<li><a href="'.base_url.'index.php?m=barang&p=list">Data Barang</a></li>',
				),  
			'admin' => '<li class="menu-admin"><a href="'.base_url.'index.php?m=admin&p=list"><i class="fa fa-link"></i><span>Data Admin</span></a></li>',
		);

		switch (strtolower($level)) {
			case 'admin':
				$hak_akses = $akses;	
				break;
			
			default:
				$hak_akses = array(
					'beranda' => $akses['beranda'], 
					'penjualan' => $akses['penjualan'], 
					'reject' => $akses['reject'], 
					'stok' => $akses['stok'], 
					'data_master' => $akses['data_master'],
				);
				break;
		}

		return $hak_akses;
	}

	

	