<?php
	date_default_timezone_set('Asia/Jakarta');

	// Load semua fungsi yang dibutuhkan
	include_once("../function/helper.php");
	include_once("../function/koneksi.php");
	include_once("../function/validasi_form.php");
	include_once("../function/datatable.php");

	$action = isset($_POST['action']) ? $_POST['action'] : false;
	if(!$action) die("Dilarang Akses Halaman Ini !!");
	else{
		switch ($action) {
			case 'value':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}
	