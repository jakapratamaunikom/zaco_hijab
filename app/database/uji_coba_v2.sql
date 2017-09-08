-- Data Master
-- ========================================================================= --

-- Data admin
INSERT INTO admin VALUES ("admin", "admin", "admin", "admin@zacohijab.com", "ADMIN");
INSERT INTO admin VALUES ("kasir", "kasir", "kasir", "kasir@zacohijab.com", "KASIR");

-- ===================================================== --

-- Data id_barang
INSERT INTO id_barang (id_barang, nama) VALUES ("HLM", "HALIMAH");
INSERT INTO id_barang (id_barang, nama) VALUES ("FAU", "FAUZIYAH");
INSERT INTO id_barang (id_barang, nama) VALUES ("AYU", "AYU");
INSERT INTO id_barang (id_barang, nama) VALUES ("HLM2", "HALIMAH 2");
INSERT INTO id_barang (id_barang, nama) VALUES ("FAU2", "FAUZIYAH 2");
INSERT INTO id_barang (id_barang, nama) VALUES ("AYU2", "AYU 2");
INSERT INTO id_barang (id_barang, nama) VALUES ("BOW", "BOW");
INSERT INTO id_barang (id_barang, nama) VALUES ("BOWK", "BOW KACU");
INSERT INTO id_barang (id_barang, nama) VALUES ("PAS", "PASHMINA 2TONE");
INSERT INTO id_barang (id_barang, nama) VALUES ("HTJP", "HTJ POLOS");
INSERT INTO id_barang (id_barang, nama) VALUES ("HTJ2", "HTJ 2");
INSERT INTO id_barang (id_barang, nama) VALUES ("KHIP", "KHIMAR PET");
INSERT INTO id_barang (id_barang, nama) VALUES ("KHIN", "KHIMAR NON PET");
INSERT INTO id_barang (id_barang, nama) VALUES ("KHII", "KHIMAR IKAT");
INSERT INTO id_barang (id_barang, nama) VALUES ("ZIG", "ZIGGY");
INSERT INTO id_barang (id_barang, nama) VALUES ("RUF", "RUFFLE");
INSERT INTO id_barang (id_barang, nama) VALUES ("IKAT", "INSTAN IKAT");

-- ===================================================== --

-- Data id_warna
INSERT INTO id_warna (id_warna, nama) VALUES ("MRH", "MERAH");
INSERT INTO id_warna (id_warna, nama) VALUES ("JIN", "JINGGA");
INSERT INTO id_warna (id_warna, nama) VALUES ("KUN", "KUNING");
INSERT INTO id_warna (id_warna, nama) VALUES ("HJU", "HIJAU");
INSERT INTO id_warna (id_warna, nama) VALUES ("BRU", "BIRU");
INSERT INTO id_warna (id_warna, nama) VALUES ("NIL", "NILA");
INSERT INTO id_warna (id_warna, nama) VALUES ("UNG", "UNGU");
INSERT INTO id_warna (id_warna, nama) VALUES ("PTH", "PUTIH");
INSERT INTO id_warna (id_warna, nama) VALUES ("HTM", "HITAM");

-- ===================================================== --

-- Data barang
-- kd_barang, id_barang, id_warna, hpp, harga_pasar, market_place, harga_ig, foto, ket, tgl_stok, stok_awal
CALL tambah_barang (1, 1,"HALIMAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (1, 2,"HALIMAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (1, 3,"HALIMAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (1, 4,"HALIMAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (1, 5,"HALIMAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (2, 1,"FAUZIYAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (2, 2,"FAUZIYAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (2, 3,"FAUZIYAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (2, 4,"FAUZIYAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (2, 5,"FAUZIYAH", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (3, 1,"AYU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (3, 2,"AYU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (3, 3,"AYU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (3, 4,"AYU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (3, 5,"AYU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (4, 1,"HALIMAH 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (4, 2,"HALIMAH 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (4, 3,"HALIMAH 2",  10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (4, 4,"HALIMAH 2",  10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (4, 5,"HALIMAH 2",  10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (5, 1,"FAUZIYAH 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (5, 2,"FAUZIYAH 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (5, 3,"FAUZIYAH 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (5, 4,"FAUZIYAH 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (5, 5,"FAUZIYAH 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (6, 1,"AYU 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (6, 2,"AYU 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (6, 3,"AYU 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (6, 4,"AYU 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (6, 5,"AYU 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (7, 1,"BOW", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (7, 2,"BOW", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (7, 3,"BOW", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (7, 4,"BOW", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (7, 5,"BOW", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (8, 1,"BOW KACU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (8, 2,"BOW KACU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (8, 3,"BOW KACU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (8, 4,"BOW KACU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (8, 5,"BOW KACU", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (9, 1,"PASHMINA 2TONE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (9, 2,"PASHMINA 2TONE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (9, 3,"PASHMINA 2TONE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (9, 4,"PASHMINA 2TONE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (9, 5,"PASHMINA 2TONE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (10, 1,"HTJ POLOS", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (10, 2,"HTJ POLOS", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (10, 3,"HTJ POLOS", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (10, 4,"HTJ POLOS", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (10, 5,"HTJ POLOS", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (11, 1,"HTJ 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (11, 2,"HTJ 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (11, 3,"HTJ 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (11, 4,"HTJ 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (11, 5,"HTJ 2", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (12, 1,"KHIMAR PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (12, 2,"KHIMAR PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (12, 3,"KHIMAR PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (12, 4,"KHIMAR PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (12, 5,"KHIMAR PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (13, 1,"KHIMAR NON PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (13, 2,"KHIMAR NON PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (13, 3,"KHIMAR NON PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (13, 4,"KHIMAR NON PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (13, 5,"KHIMAR NON PET", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (14, 1,"KHIMAR IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (14, 2,"KHIMAR IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (14, 3,"KHIMAR IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (14, 4,"KHIMAR IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (14, 5,"KHIMAR IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (15, 1,"ZIGGY", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (15, 2,"ZIGGY", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (15, 3,"ZIGGY", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (15, 4,"ZIGGY", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (15, 5,"ZIGGY", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (16, 1,"RUFFLE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (16, 2,"RUFFLE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (16, 3,"RUFFLE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (16, 4,"RUFFLE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (16, 5,"RUFFLE", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

CALL tambah_barang (17, 1,"INSTAN IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (17, 2,"INSTAN IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (17, 3,"INSTAN IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (17, 4,"INSTAN IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);
CALL tambah_barang (17, 5,"INSTAN IKAT", 10000, 15000, 20000, 25000, "foto.jpg", "-", "2017-07-25", 50);

-- ===================================================== --

-- Data Transaksi
-- ========================================================================= --

-- Data Penjualan
-- procedure tambah_penjualan

-- OFFLINE HARI SAMA
INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170725-1', '2017-07-25', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170725-1', '2017-07-25', 1, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-1', '2017-07-25', 2, 15000, 20000, 4, 10, (20000*4-(20000*4*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-1', '2017-07-25', 3, 15000, 20000, 6, 10, (20000*6-(20000*6*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-1', '2017-07-25', 4, 15000, 20000, 8, 20, (20000*8-(20000*8*20/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170725-2', '2017-07-25', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170725-2', '2017-07-25', 1, 15000, 20000, 6, 10, (20000*6-(20000*6*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-2', '2017-07-25', 5, 15000, 20000, 3, 0, (20000*3-(20000*3*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-2', '2017-07-25', 6, 15000, 20000, 7, 10, (20000*7-(20000*7*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-2', '2017-07-25', 2, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170725-3', '2017-07-25', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170725-3', '2017-07-25', 10, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-3', '2017-07-25', 11, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-3', '2017-07-25', 5, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-3', '2017-07-25', 8, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170725-4', '2017-07-25', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170725-4', '2017-07-25', 15, 15000, 20000, 20, 20, (20000*20-(20000*20*20/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170725-5', '2017-07-25', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 5, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 6, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 7, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 8, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 9, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 10, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 11, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 12, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-5', '2017-07-25', 13, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170725-6', '2017-07-25', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 1, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 2, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 3, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 4, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 5, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 10, 15000, 20000, 4, 10, (20000*4-(20000*4*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 11, 15000, 20000, 3, 0, (20000*3-(20000*3*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 12, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-6', '2017-07-25', 13, 15000, 20000, 1, 0, (20000*1-(20000*1*0/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170725-7', '2017-07-25', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170725-7', '2017-07-25', 17, 15000, 20000, 10, 20, (20000*10-(20000*10*20/100)), (20000-15000), '-');

-- OFFLINE HARI BESOK
INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170726-1', '2017-07-26', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170726-1', '2017-07-26', 16, 15000, 20000, 4, 10, (20000*4-(20000*4*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-1', '2017-07-26', 15, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-1', '2017-07-26', 14, 15000, 20000, 7, 20, (20000*7-(20000*7*20/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-1', '2017-07-26', 13, 15000, 20000, 9, 20, (20000*9-(20000*9*20/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170726-2', '2017-07-26', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170726-2', '2017-07-26', 18, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-2', '2017-07-26', 3, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-2', '2017-07-26', 6, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-2', '2017-07-26', 5, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170726-3', '2017-07-26', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170726-3', '2017-07-26', 20, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-3', '2017-07-26', 19, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-3', '2017-07-26', 22, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-3', '2017-07-26', 25, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

-- OFFLINE LUSA 
INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170727-1', '2017-07-27', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170727-1', '2017-07-27', 21, 15000, 20000, 4, 10, (20000*4-(20000*4*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170727-1', '2017-07-27', 22, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170727-1', '2017-07-27', 23, 15000, 20000, 7, 20, (20000*7-(20000*7*20/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170727-1', '2017-07-27', 24, 15000, 20000, 9, 20, (20000*9-(20000*9*20/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170727-2', '2017-07-27', 'OFFLINE', '-', '-', '-', 0, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170727-2', '2017-07-27', 21, 15000, 20000, 2, 0, (20000*4-(20000*2*0/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170727-2', '2017-07-27', 22, 15000, 20000, 2, 0, (20000*2-(20000*2*0/100)), (20000-15000), '-');

-- ONLINE HARI SAMA
INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170725-8', '2017-07-25', 'ONLINE', 'Dummy', '081111111111', 'Dummy', 10000, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170725-8', '2017-07-25', 30, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-8', '2017-07-25', 31, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-8', '2017-07-25', 32, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170725-8', '2017-07-25', 33, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

-- ONLINE HARI BESOK
INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170726-4', '2017-07-26', 'ONLINE', 'Dummy', '081111111111', 'Dummy', 10000, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170726-4', '2017-07-26', 30, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-4', '2017-07-26', 31, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-4', '2017-07-26', 32, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170726-4', '2017-07-26', 33, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

-- ONLINE HARI LUSA
INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170727-3', '2017-07-27', 'ONLINE', 'Dummy', '081111111111', 'Dummy', 10000, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170727-3', '2017-07-27', 33, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170727-3', '2017-07-27', 34, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170727-3', '2017-07-27', 35, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170727-3', '2017-07-27', 36, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

-- Data Penjualan
-- procedure edit_penjualan
INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170813-1', '2017-08-13', 'ONLINE', 'Dummy', '081111111111', 'Dummy', 10000, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170813-1', '2017-08-13', 37, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-1', '2017-08-13', 38, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-1', '2017-08-13', 39, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-1', '2017-08-13', 40, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170813-2', '2017-08-13', 'ONLINE', 'Dummy', '081111111111', 'Dummy', 10000, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170813-2', '2017-08-13', 41, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-2', '2017-08-13', 42, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-2', '2017-08-13', 43, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-2', '2017-08-13', 44, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');

INSERT INTO penjualan(
	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, status, ket, username) 
VALUES(
	'PJ-20170813-3', '2017-08-13', 'ONLINE', 'Dummy', '081111111111', 'Dummy', 10000, '1', '-', 'admin');
-- kd_penjualan, tgl, kd_barang, hpp, harga, qty, diskon, subtotal, laba, ket 
CALL tambah_penjualan('PJ-20170813-3', '2017-08-13', 45, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-3', '2017-08-13', 46, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-3', '2017-08-13', 47, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');
CALL tambah_penjualan('PJ-20170813-3', '2017-08-13', 48, 15000, 20000, 5, 10, (20000*5-(20000*5*10/100)), (20000-15000), '-');



-- procedure edit_penjualan
-- id_penjualan, id_detail_penjualan, tgl, kode barang detail, hpp, harga, qty, diskon, subtotal, laba, ket

-- edit qty nya
CALL edit_penjualan(16, 63, '2017-08-13', 37, 15000, 20000, 10, 10, 90000, 5000, '-');
-- edit barangnya
CALL edit_penjualan(16, 64, '2017-08-13', 85, 15000, 20000, 5, 10, 90000, 5000, '-');
-- edit qty & barangnya
CALL edit_penjualan(16, 65, '2017-08-13', 84, 15000, 20000, 10, 10, 90000, 5000, '-');




-- ===================================================== --

-- Data pembelian
-- procedure tambah_pembelian
INSERT INTO pembelian(
	kd_pembelian, tgl, ket, username) 
VALUES(
	'PB-20170813-1', '2017-08-13', '-', 'admin');
-- kd_pembelian, tgl, kd_barang, harga, qty, subtotal, ket
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 1, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 2, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 3, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 4, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 5, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 6, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 7, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 8, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 9, 15000, 5, (15000*5), '-');
CALL tambah_pembelian('PB-20170813-1', '2017-08-13', 10, 15000, 5, (15000*5), '-');

CALL tambah_pengeluaran_pembelian('PG-20170813-1','PB-20170813-1', '2017-08-13', 'admin');

-- procedure edit_pembelian
-- 
-- edit qty nya
CALL edit_pembelian(1, 1, '2017-08-13', 1, 15000, 10, (15000*10), '-');
CALL edit_pengeluaran_pembelian('PB-20170813-1');
-- edit barangnya
CALL edit_pembelian(1, 10, '2017-08-13', 11, 15000, 5, (15000*10), '-');
CALL edit_pengeluaran_pembelian('PB-20170813-1');
-- edit qty & barangnya
CALL edit_pembelian(1, 5, '2017-08-13', 12, 15000, 20, (15000*10), '-');
CALL edit_pengeluaran_pembelian('PB-20170813-1');

-- ===================================================== --

-- Data reject
-- procedure tambah_reject
-- 


-- procedure edit_reject
-- 



-- ===================================================== --


select b.id, 
	concat_ws('-',ib.id_barang, iw.id_warna) kd_barang, 
	b.nama, s.stok_awal, s.brg_masuk, s.brg_keluar, s.stok_akhir
	from stok s
	join barang b on b.id = s.kd_barang
    join id_barang ib on ib.id = b.id_barang
    join id_warna iw on iw.id = b.id_warna
	where id in(SELECT max(id) from stok GROUP by(kd_barang)) 
	ORDER by kd_barang asc