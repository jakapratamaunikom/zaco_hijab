<?php
	$dbHost = "localhost"; //host/server yg dipakai
	$dbUser = "root"; //username host/server 
	$dbPass = ""; //password host
	$dbName = "zaco_hijab"; //nama database

	try{
		// buat object koneksi
		$koneksi = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
		// atur error mode
		$koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		die("Koneksi Database Error: " . $e->getMessage()); // jika ada error
	}