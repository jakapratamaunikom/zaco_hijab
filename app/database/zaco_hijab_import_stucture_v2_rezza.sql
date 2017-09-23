-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 Sep 2017 pada 15.33
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zaco_hijab`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_pembelian` (IN `id_param` INT, IN `id_detail_param` INT, IN `tgl_param` DATE, IN `kd_barang_param` INT, IN `harga_param` DOUBLE(8,2), IN `qty_param` SMALLINT, IN `subtotal_param` DOUBLE(12,2), IN `ket_param` TEXT)  BEGIN
    DECLARE kd_barang_pembelian int;
    DECLARE get_qty_pembelian SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_brg_masuk SMALLINT;
    DECLARE cek_tgl SMALLINT;
    DECLARE stok_awal_A int;
    DECLARE stok_awal_B int;
    DECLARE brg_masuk_A SMALLINT;
    DECLARE brg_masuk_B SMALLINT;
    DECLARE brg_keluar_A SMALLINT;
    DECLARE brg_keluar_B SMALLINT;
    DECLARE stok_akhir_param int;

        SELECT kd_barang into kd_barang_pembelian FROM detail_pembelian WHERE id=id_detail_param; 
            IF kd_barang_param = kd_barang_pembelian THEN

        SELECT qty into get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;
        
                IF qty_param != get_qty_pembelian THEN
            
            SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;             SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;             SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            UPDATE stok SET
                brg_masuk=((get_brg_masuk-get_qty_pembelian)+qty_param), stok_akhir=((get_stk_awal+(get_brg_masuk-get_qty_pembelian)+qty_param)-get_brg_keluar)
            WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
        end if;

                                 
        UPDATE detail_pembelian SET
            harga=harga_param, qty=qty_param, subtotal=subtotal_param, ket=ket_param
        WHERE id=id_detail_param;

        ELSE
        SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;         SELECT qty into get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;

                IF qty_param = get_qty_pembelian THEN
                        SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
            SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
            SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;

                        SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

                        UPDATE stok SET
                brg_masuk=(brg_masuk_A-qty_param), stok_akhir=(stok_awal_A+(brg_masuk_A-qty_param)-brg_keluar_A)
            WHERE tgl=tgl_param AND kd_barang=kd_barang_pembelian;

            IF cek_tgl > 0 THEN

                                UPDATE stok SET
                    brg_masuk=(brg_masuk_B+qty_param), stok_akhir=(stok_awal_B+(brg_masuk_B+qty_param)-brg_keluar_B)
                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
            
            ELSE
                SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1;     
                                INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                VALUES(tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));

            end if;

                                    
            UPDATE detail_pembelian SET
                kd_barang=kd_barang_param, harga=harga_param, subtotal=subtotal_param, ket=ket_param
            WHERE id=id_detail_param;

                ELSE

            SELECT qty into get_qty_pembelian FROM detail_pembelian WHERE id=id_detail_param;
                        SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
            SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;
            SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_pembelian AND tgl=tgl_param;

                        SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

                        UPDATE stok SET
                brg_masuk=(brg_masuk_A-get_qty_pembelian), stok_akhir=(stok_awal_A+(brg_masuk_A-get_qty_pembelian)-brg_keluar_A)
            WHERE tgl=tgl_param AND kd_barang=kd_barang_pembelian;

            IF cek_tgl > 0 THEN

                                UPDATE stok SET
                    brg_masuk=(brg_masuk_B+qty_param), stok_akhir=(stok_awal_B+(brg_masuk_B+qty_param)-brg_keluar_B)
                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
            
            ELSE
                SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; 
                                INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                VALUES(tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));
            end if;

                                    
            UPDATE detail_pembelian SET
                kd_barang=kd_barang_param, harga=harga_param, qty=qty_param, subtotal=subtotal_param, ket=ket_param
            WHERE id=id_detail_param;

        end if;

    end if;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_penjualan` (IN `id_param` INT, IN `id_detail_param` INT, IN `tgl_param` DATE, IN `kd_barang_param` INT, IN `hpp_param` DOUBLE(8,2), IN `harga_param` DOUBLE(8,2), IN `qty_param` SMALLINT, IN `jenis_diskon_param` CHAR(1), IN `diskon_param` INT, IN `subtotal_param` DOUBLE(12,2), IN `laba_param` DOUBLE(8,2), IN `ket_param` TEXT)  BEGIN
    DECLARE kd_barang_penjualan int;
    DECLARE get_qty_penjualan SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_brg_masuk SMALLINT;
    DECLARE cek_tgl SMALLINT;
    DECLARE stok_awal_A int;
    DECLARE stok_awal_B int;
    DECLARE brg_masuk_A SMALLINT;
    DECLARE brg_masuk_B SMALLINT;
    DECLARE brg_keluar_A SMALLINT;
    DECLARE brg_keluar_B SMALLINT;
    DECLARE stok_akhir_param int;

        SELECT kd_barang into kd_barang_penjualan FROM detail_penjualan WHERE id=id_detail_param; 
        IF kd_barang_param = kd_barang_penjualan THEN

                SELECT qty into get_qty_penjualan FROM detail_penjualan WHERE id=id_detail_param;
        
                IF qty_param != get_qty_penjualan THEN
            
            SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;             SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;             SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            UPDATE stok SET
                brg_keluar=(get_brg_keluar+(qty_param-get_qty_penjualan)), stok_akhir=((get_stk_awal+get_brg_masuk)-(get_brg_keluar+(qty_param-get_qty_penjualan)))
            WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
        end if;

                UPDATE detail_penjualan SET
            hpp=hpp_param, harga=harga_param, qty=qty_param, jenis_diskon=jenis_diskon_param, diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param
        WHERE id=id_detail_param;


        ELSE
        SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;         SELECT qty into get_qty_penjualan FROM detail_penjualan WHERE id=id_detail_param;

                IF qty_param = get_qty_penjualan THEN
                        SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;
            SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;
            SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;

                        SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

                        UPDATE stok SET
                brg_keluar=(brg_keluar_A-qty_param), stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-qty_param))
            WHERE tgl=tgl_param AND kd_barang=kd_barang_penjualan;

            IF cek_tgl > 0 THEN

                                UPDATE stok SET
                    brg_keluar=(brg_keluar_B+qty_param), stok_akhir=(stok_awal_B+brg_masuk_B-(brg_keluar_B+qty_param))
                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
            
            ELSE
                SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1;     
                                INSERT into stok(
                    tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                VALUES(
                    tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));

            end if;

                        UPDATE detail_penjualan SET
                kd_barang=kd_barang_param, hpp=hpp_param, harga=harga_param, jenis_diskon=jenis_diskon_param, diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param
            WHERE id=id_detail_param;
            
                ELSE

            SELECT qty into get_qty_penjualan FROM detail_penjualan WHERE id=id_detail_param;
                        SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;
            SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;
            SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_penjualan AND tgl=tgl_param;

                        SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
            SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 

                        UPDATE stok SET
                brg_keluar=(brg_keluar_A-get_qty_penjualan), stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-get_qty_penjualan))
            WHERE tgl=tgl_param AND kd_barang=kd_barang_penjualan;

            IF cek_tgl > 0 THEN

                                UPDATE stok SET
                    brg_keluar=(brg_keluar_B+qty_param), stok_akhir=(stok_awal_B+brg_masuk_B-(brg_keluar_B+qty_param))
                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
            
            ELSE
                SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; 
                                INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                VALUES(tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
            end if;

                        UPDATE detail_penjualan SET
                kd_barang=kd_barang_param, hpp=hpp_param, harga=harga_param, qty=qty_param, jenis_diskon=jenis_diskon_param, diskon=diskon_param, subtotal=subtotal_param, laba=laba_param, ket=ket_param
            WHERE id=id_detail_param;


        end if;

    end if;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_barang` (IN `id_barang_param` INT, IN `id_warna_param` INT, IN `nama_param` VARCHAR(50), IN `hpp_param` DOUBLE(8,2), IN `harga_pasar_param` DOUBLE(8,2), IN `market_place_param` DOUBLE(8,2), IN `harga_ig_param` DOUBLE(8,2), IN `foto_param` TEXT, IN `ket_param` TEXT, IN `tgl_param` DATE, IN `stok_awal_param` INT)  BEGIN

    DECLARE id_param int;
    
    SELECT `AUTO_INCREMENT` INTO id_param FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'zaco_hijab' AND   TABLE_NAME   = 'barang';

		INSERT INTO barang(id_barang, id_warna, nama, hpp, harga_pasar, market_place, harga_ig, foto,ket)
    VALUES(id_barang_param, id_warna_param, nama_param, hpp_param, harga_pasar_param, market_place_param, harga_ig_param, foto_param, ket_param);
    
        INSERT INTO stok(tgl, kd_barang, stok_awal, brg_masuk, brg_keluar, stok_akhir)
    VALUES(tgl_param, id_param, stok_awal_param, 0, 0, stok_awal_param);
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_pembelian` (IN `kd_pembelian_param` VARCHAR(16), IN `tgl_param` DATE, IN `kd_barang_param` INT, IN `harga_param` DOUBLE(8,2), IN `qty_param` SMALLINT, IN `subtotal_param` DOUBLE(12,2), IN `ket_param` TEXT)  BEGIN

    DECLARE cek_tgl SMALLINT;
    DECLARE stok_akhir_param int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_masuk SMALLINT;
    DECLARE kd_pembelian_id_param int;

        SELECT id into kd_pembelian_id_param FROM pembelian WHERE kd_pembelian = kd_pembelian_param;

        INSERT INTO detail_pembelian(
        kd_pembelian, kd_barang, harga, qty, subtotal, ket) 
    VALUES (
        kd_pembelian_id_param, kd_barang_param, harga_param, qty_param, subtotal_param, ket_param);
    
        SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
    
    IF cek_tgl > 0 THEN 
                
        SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         
        UPDATE stok SET
            brg_masuk=(qty_param+get_brg_masuk), stok_akhir=(get_stk_awal+(qty_param+get_brg_masuk)-get_brg_keluar)
        WHERE
            kd_barang=kd_barang_param AND tgl=tgl_param;
        
    ELSE         
        SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1;         
                INSERT into stok(
            tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
        VALUES(
            tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));
    end if;
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_penjualan` (IN `kd_penjualan_param` VARCHAR(16), IN `tgl_param` DATE, IN `kd_barang_param` INT, IN `hpp_param` DOUBLE(8,2), IN `harga_param` DOUBLE(8,2), IN `qty_param` SMALLINT, IN `jenis_diskon_param` CHAR(1), IN `diskon_param` INT, IN `subtotal_param` DOUBLE(12,2), IN `laba_param` DOUBLE(8,2), IN `ket_param` TEXT)  BEGIN

	DECLARE cek_tgl SMALLINT;
	DECLARE stok_akhir_param int;
	DECLARE get_brg_keluar SMALLINT;
	DECLARE get_stk_awal int;
	DECLARE get_brg_masuk SMALLINT;
	DECLARE kd_penjualan_id_param int;
	
        SELECT id into kd_penjualan_id_param FROM penjualan WHERE kd_penjualan = kd_penjualan_param;

    INSERT INTO detail_penjualan(
        kd_penjualan, kd_barang, hpp, harga, qty, jenis_diskon, diskon, subtotal, laba, ket) 
    VALUES(
        kd_penjualan_id_param, kd_barang_param, hpp_param, harga_param, qty_param, jenis_diskon_param, diskon_param, subtotal_param, laba_param, ket_param);
	
        SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
    
    IF cek_tgl > 0 THEN 
    	
        SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         
    	UPDATE stok SET
    		brg_keluar=(qty_param+get_brg_keluar), stok_akhir=(get_stk_awal+get_brg_masuk-(qty_param+get_brg_keluar))
    	WHERE
    		kd_barang=kd_barang_param AND tgl=tgl_param;
        
    ELSE     	
        SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1;         
    	    	INSERT into stok(
    		tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
    	VALUES(
    		tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
    
    end if;
    
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text,
  `foto` text,
  `level` enum('ADMIN','KASIR') DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`, `email`, `telp`, `alamat`, `foto`, `level`, `status`) VALUES
('admin', '$2y$10$jGWjS28NPfV0502LmVJe2ex9RjkdDog..IueohHplIYYNdskd7iAO', 'ADMIN', 'admin@admin.com', '087785610966', 'ADMIN', '', 'ADMIN', '1'),
('kasir', '$2y$10$F6R3qvQUI7ExtvfJFWUsi./.70Oc/eia92dd746vUYVP7B1Rw7o7S', 'KASIR', 'kasir@kasir.com', '08996108665', 'KASIR', '', 'KASIR', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_warna` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `hpp` double(8,2) DEFAULT NULL,
  `harga_pasar` double(8,2) DEFAULT NULL,
  `market_place` double(8,2) DEFAULT NULL,
  `harga_ig` double(8,2) DEFAULT NULL,
  `foto` text,
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `id_barang`, `id_warna`, `nama`, `hpp`, `harga_pasar`, `market_place`, `harga_ig`, `foto`, `ket`) VALUES
(1, 1, 1, 'AISYAH DUSTY', 25000.00, 28000.00, 30000.00, 35000.00, '', ''),
(2, 1, 2, 'AISYAH MILO', 20000.00, 25000.00, 30000.00, 35000.00, '', ''),
(3, 1, 3, 'AISYAH BLACK', 26000.00, 28000.00, 30000.00, 34000.00, '', ''),
(4, 1, 4, 'AISYAH LILAC', 30000.00, 32000.00, 33000.00, 35000.00, '', ''),
(5, 1, 5, 'AISYAH MAROON', 30000.00, 32000.00, 33000.00, 35000.00, '', ''),
(6, 1, 6, 'AISYAH NAVY', 40000.00, 42000.00, 43000.00, 45000.00, '', ''),
(7, 1, 7, 'AISYAH PINK', 22000.00, 24000.00, 26000.00, 28000.00, '', ''),
(8, 1, 8, 'AISYAH GREY', 24000.00, 25000.00, 26000.00, 27000.00, '', ''),
(9, 1, 9, 'AISYAH PEACH', 23000.00, 24000.00, 25000.00, 26000.00, '', ''),
(10, 1, 10, 'AISYAH ABU MUDA', 20000.00, 22000.00, 24000.00, 27000.00, '', ''),
(11, 1, 11, 'AISYAH RED', 30000.00, 34000.00, 36000.00, 40000.00, '', ''),
(12, 1, 12, 'AISYAH UNGU', 20000.00, 23000.00, 24000.00, 25000.00, '', ''),
(13, 1, 13, 'AISYAH TOSCA', 30000.00, 32000.00, 33000.00, 35000.00, '', ''),
(14, 2, 1, 'RAISA DUSTY', 30000.00, 32000.00, 34000.00, 36000.00, '', ''),
(15, 2, 2, 'RAISA MILO', 34000.00, 35000.00, 36000.00, 37000.00, '', ''),
(16, 2, 3, 'RAISA BLACK', 20000.00, 23000.00, 24000.00, 25000.00, '', ''),
(17, 2, 4, 'RAISA LILAC', 15000.00, 18000.00, 19000.00, 20000.00, '', ''),
(18, 2, 5, 'RAISA MAROON', 20000.00, 21000.00, 22000.00, 23000.00, '', ''),
(19, 2, 6, 'RAISA NAVY', 30000.00, 32000.00, 33000.00, 34000.00, '', ''),
(20, 2, 7, 'RAISA PINK', 31000.00, 32000.00, 33000.00, 34000.00, '', ''),
(21, 2, 8, 'RAISA GREY', 20000.00, 21000.00, 22000.00, 23000.00, '', ''),
(22, 2, 9, 'RAISA PEACH', 30000.00, 33000.00, 36000.00, 39000.00, '', ''),
(23, 2, 10, 'RAISA ABU MUDA', 30000.00, 33000.00, 34000.00, 35000.00, '', ''),
(24, 2, 11, 'RAISA RED', 20000.00, 23000.00, 24000.00, 25000.00, '', ''),
(25, 2, 12, 'RAISA UNGU', 25000.00, 26000.00, 27000.00, 28000.00, '', ''),
(26, 2, 13, 'RAISA TOSCA', 32000.00, 33000.00, 34000.00, 35000.00, '', ''),
(27, 3, 1, 'ASYANTY DUSTY', 30000.00, 32000.00, 33000.00, 35000.00, '', ''),
(28, 3, 2, 'ASYANTY MILO', 30000.00, 35000.00, 40000.00, 45000.00, '', ''),
(29, 3, 6, 'ASYANTY NAVY', 20000.00, 25000.00, 26000.00, 30000.00, '', ''),
(30, 3, 11, 'ASYANTY RED', 29000.00, 30000.00, 32000.00, 35000.00, '', ''),
(31, 4, 3, 'FLOWING PAD BLACK', 23000.00, 24000.00, 25000.00, 26000.00, '', ''),
(32, 4, 6, 'FLOWING PAD NAVY', 20000.00, 23000.00, 25000.00, 30000.00, '', ''),
(33, 4, 12, 'FLOWING PAD UNGU', 30000.00, 32000.00, 34000.00, 36000.00, '', ''),
(34, 4, 2, 'FLOWING PAD MILO', 15000.00, 19000.00, 24000.00, 28000.00, '', ''),
(35, 5, 3, 'CHELYA BLACK', 20000.00, 25000.00, 30000.00, 35000.00, '', ''),
(36, 5, 2, 'CHELYA MILO', 34000.00, 35000.00, 36000.00, 38000.00, '', ''),
(37, 5, 6, 'CHELYA NAVY', 30000.00, 35000.00, 40000.00, 45000.00, '', ''),
(38, 5, 7, 'CHELYA PINK', 24000.00, 26000.00, 27000.00, 29000.00, '', ''),
(39, 6, 8, 'NISYA GREY', 20000.00, 25000.00, 30000.00, 35000.00, '', ''),
(40, 6, 11, 'NISYA RED', 30000.00, 35000.00, 36000.00, 38000.00, '', ''),
(41, 7, 1, 'AMIRA DUSTY', 25000.00, 26000.00, 27000.00, 28000.00, '', ''),
(42, 7, 2, 'AMIRA MILO', 20000.00, 23000.00, 24000.00, 25000.00, '', ''),
(43, 7, 6, 'AMIRA NAVY', 30000.00, 34000.00, 35000.00, 36000.00, '', ''),
(44, 7, 8, 'AMIRA GREY', 30000.00, 35000.00, 40000.00, 45000.00, '', ''),
(45, 8, 11, 'RALIN RED', 20000.00, 23000.00, 24000.00, 25000.00, '', ''),
(46, 8, 4, 'RALIN LILAC', 30000.00, 34000.00, 35000.00, 36000.00, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(11) NOT NULL,
  `kd_pembelian` int(11) DEFAULT NULL,
  `kd_barang` int(11) DEFAULT NULL,
  `harga` double(8,2) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `subtotal` double(12,2) DEFAULT NULL,
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengeluaran`
--

CREATE TABLE `detail_pengeluaran` (
  `id` int(11) NOT NULL,
  `kd_pengeluaran` int(11) DEFAULT NULL,
  `nominal` double(12,2) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `subtotal` double(12,2) DEFAULT NULL,
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `kd_penjualan` int(11) DEFAULT NULL,
  `kd_barang` int(11) DEFAULT NULL,
  `hpp` double(8,2) DEFAULT NULL,
  `harga` double(8,2) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `jenis_diskon` char(1) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `subtotal` double(12,2) DEFAULT NULL,
  `laba` double(8,2) DEFAULT NULL,
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `kd_penjualan`, `kd_barang`, `hpp`, `harga`, `qty`, `jenis_diskon`, `diskon`, `subtotal`, `laba`, `ket`) VALUES
(1, 1, 1, 25000.00, 28000.00, 1, 'p', 0, 28000.00, 3000.00, ''),
(2, 1, 2, 20000.00, 25000.00, 1, 'p', 0, 25000.00, 5000.00, ''),
(3, 1, 3, 26000.00, 28000.00, 1, 'p', 0, 28000.00, 2000.00, ''),
(4, 1, 12, 20000.00, 23000.00, 1, 'p', 0, 23000.00, 3000.00, ''),
(5, 2, 4, 30000.00, 32000.00, 3, 'p', 5, 91200.00, 2000.00, ''),
(6, 2, 13, 30000.00, 32000.00, 3, 'p', 5, 91200.00, 2000.00, ''),
(7, 3, 5, 30000.00, 32000.00, 5, 'p', 5, 152000.00, 2000.00, ''),
(8, 3, 14, 30000.00, 32000.00, 5, 'p', 5, 152000.00, 2000.00, ''),
(9, 3, 2, 20000.00, 25000.00, 1, 'p', 0, 25000.00, 5000.00, ''),
(10, 3, 17, 15000.00, 18000.00, 1, 'p', 0, 18000.00, 3000.00, ''),
(11, 3, 15, 34000.00, 35000.00, 1, 'p', 0, 35000.00, 1000.00, ''),
(12, 4, 3, 26000.00, 28000.00, 1, 'p', 0, 28000.00, 2000.00, ''),
(13, 4, 17, 15000.00, 18000.00, 1, 'p', 0, 18000.00, 3000.00, ''),
(14, 5, 45, 20000.00, 24000.00, 5, 'p', 5, 114000.00, 4000.00, ''),
(15, 5, 1, 25000.00, 30000.00, 1, 'p', 0, 30000.00, 5000.00, ''),
(16, 6, 36, 34000.00, 38000.00, 10, 'p', 10, 342000.00, 4000.00, ''),
(17, 6, 26, 32000.00, 35000.00, 3, 'p', 5, 99750.00, 3000.00, ''),
(18, 6, 21, 20000.00, 23000.00, 1, 'p', 0, 23000.00, 3000.00, ''),
(19, 7, 25, 25000.00, 26000.00, 3, 'p', 5, 74100.00, 1000.00, ''),
(20, 7, 39, 20000.00, 25000.00, 1, 'p', 0, 25000.00, 5000.00, ''),
(21, 7, 46, 30000.00, 34000.00, 1, 'p', 0, 34000.00, 4000.00, ''),
(22, 7, 28, 30000.00, 35000.00, 1, 'p', 0, 35000.00, 5000.00, ''),
(23, 7, 43, 30000.00, 34000.00, 1, 'p', 0, 34000.00, 4000.00, ''),
(24, 8, 18, 20000.00, 21000.00, 5, 'p', 5, 99750.00, 1000.00, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_reject`
--

CREATE TABLE `detail_reject` (
  `id` int(11) NOT NULL,
  `kd_reject` int(11) DEFAULT NULL,
  `kd_barang` int(11) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `kd_barang_ganti` int(11) DEFAULT NULL,
  `jenis` enum('REJECT','RETURN') DEFAULT NULL,
  `hpp` double(8,2) DEFAULT NULL,
  `harga` double(8,2) DEFAULT NULL,
  `ongkir` double(8,2) DEFAULT NULL,
  `total` double(12,2) DEFAULT NULL,
  `rugi` double(8,2) DEFAULT NULL,
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_barang`
--

CREATE TABLE `id_barang` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(4) NOT NULL,
  `nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `id_barang`
--

INSERT INTO `id_barang` (`id`, `id_barang`, `nama`) VALUES
(1, 'AIS', 'AISYAH'),
(2, 'RAI', 'RAISA'),
(3, 'ASY', 'ASYANTY'),
(4, 'FLOW', 'FLOWING PAD'),
(5, 'CHE', 'CHELYA'),
(6, 'NIS', 'NISYA'),
(7, 'AMI', 'AMIRA'),
(8, 'RAL', 'RALIN'),
(9, 'ORG', 'ORGANZA RUBIAH'),
(10, 'LCB', 'INSTAN LCB'),
(11, 'KHI', 'PLAIN KHIMAR'),
(12, 'BER', 'BERGO AL-AZHAR'),
(13, 'HAN', 'HANA INSTAN'),
(14, 'MEI', 'MEIKA INSTANT'),
(15, 'DAI', 'DAILY KHIMAR'),
(16, 'FAD', 'FADIAH INSTANT'),
(17, 'SER', 'SERUT'),
(18, 'RING', 'RING'),
(19, 'ALD', 'ALDA'),
(20, 'SAR', 'SARAH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_warna`
--

CREATE TABLE `id_warna` (
  `id` int(11) NOT NULL,
  `id_warna` varchar(4) NOT NULL,
  `nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `id_warna`
--

INSERT INTO `id_warna` (`id`, `id_warna`, `nama`) VALUES
(1, 'DUS', 'DUSTY'),
(2, 'MIL', 'MILO'),
(3, 'BLK', 'BLACK'),
(4, 'LIL', 'LILAC'),
(5, 'MAR', 'MAROON'),
(6, 'NAV', 'NAVY'),
(7, 'PINK', 'PINK'),
(8, 'GRE', 'GREY'),
(9, 'PEA', 'PEACH'),
(10, 'ABU', 'ABU MUDA'),
(11, 'RED', 'RED'),
(12, 'UNG', 'UNGU'),
(13, 'TOS', 'TOSCA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `kd_pembelian` varchar(16) NOT NULL,
  `tgl` date DEFAULT NULL,
  `ket` text,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `kd_pengeluaran` varchar(16) NOT NULL,
  `tgl` date DEFAULT NULL,
  `ket` text,
  `jenis` enum('MARKETING','OPERASIONAL','GAJI','AKTIVA TETAP','LAINNYA') DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `kd_penjualan` varchar(16) NOT NULL,
  `tgl` date DEFAULT NULL,
  `jenis` enum('HARGA PASAR','MARKET PLACE','HARGA IG','RESELLER') DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text,
  `ongkir` double(8,2) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `ket` text,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `kd_penjualan`, `tgl`, `jenis`, `nama`, `telp`, `alamat`, `ongkir`, `status`, `ket`, `username`) VALUES
(1, 'PJ-20170923-1', '2017-09-23', 'HARGA PASAR', '', '', '', 0.00, '1', '', 'admin'),
(2, 'PJ-20170923-2', '2017-09-23', 'HARGA PASAR', '', '', '', 0.00, '1', '', 'admin'),
(3, 'PJ-20170923-3', '2017-09-23', 'HARGA PASAR', '', '', '', 0.00, '1', '', 'admin'),
(4, 'PJ-20170923-4', '2017-09-23', 'HARGA PASAR', '', '', '', 0.00, '1', '', 'admin'),
(5, 'PJ-20170923-5', '2017-09-23', 'MARKET PLACE', 'ABC', '123', 'ABC', 10000.00, '1', '', 'admin'),
(6, 'PJ-20170923-6', '2017-09-23', 'HARGA IG', 'ABC', '123', 'ABC', 20000.00, '1', '', 'admin'),
(7, 'PJ-20170923-7', '2017-09-23', 'RESELLER', '', '', '', 0.00, '1', '', 'admin'),
(8, 'PJ-20170923-8', '2017-09-23', 'HARGA PASAR', '', '', '', 0.00, '1', '', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reject`
--

CREATE TABLE `reject` (
  `id` int(11) NOT NULL,
  `kd_reject` varchar(16) NOT NULL,
  `kd_penjualan` int(11) NOT NULL,
  `tgl` date DEFAULT NULL,
  `ket` text,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id` int(11) NOT NULL,
  `tgl` date DEFAULT NULL,
  `kd_barang` int(11) DEFAULT NULL,
  `stok_awal` int(11) DEFAULT NULL,
  `brg_masuk` smallint(6) DEFAULT NULL,
  `brg_keluar` smallint(6) DEFAULT NULL,
  `stok_akhir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id`, `tgl`, `kd_barang`, `stok_awal`, `brg_masuk`, `brg_keluar`, `stok_akhir`) VALUES
(1, '2017-09-23', 1, 200, 0, 2, 198),
(2, '2017-09-23', 2, 200, 0, 2, 198),
(3, '2017-09-23', 3, 200, 0, 2, 198),
(4, '2017-09-23', 4, 200, 0, 3, 197),
(5, '2017-09-23', 5, 200, 0, 5, 195),
(6, '2017-09-23', 6, 200, 0, 0, 200),
(7, '2017-09-23', 7, 200, 0, 0, 200),
(8, '2017-09-23', 8, 200, 0, 0, 200),
(9, '2017-09-23', 9, 200, 0, 0, 200),
(10, '2017-09-23', 10, 200, 0, 0, 200),
(11, '2017-09-23', 11, 200, 0, 0, 200),
(12, '2017-09-23', 12, 200, 0, 1, 199),
(13, '2017-09-23', 13, 200, 0, 3, 197),
(14, '2017-09-23', 14, 200, 0, 5, 195),
(15, '2017-09-23', 15, 200, 0, 1, 199),
(16, '2017-09-23', 16, 200, 0, 0, 200),
(17, '2017-09-23', 17, 200, 0, 2, 198),
(18, '2017-09-23', 18, 200, 0, 5, 195),
(19, '2017-09-23', 19, 200, 0, 0, 200),
(20, '2017-09-23', 20, 200, 0, 0, 200),
(21, '2017-09-23', 21, 200, 0, 1, 199),
(22, '2017-09-23', 22, 200, 0, 0, 200),
(23, '2017-09-23', 23, 200, 0, 0, 200),
(24, '2017-09-23', 24, 200, 0, 0, 200),
(25, '2017-09-23', 25, 200, 0, 3, 197),
(26, '2017-09-23', 26, 200, 0, 3, 197),
(27, '2017-09-23', 27, 200, 0, 0, 200),
(28, '2017-09-23', 28, 200, 0, 1, 199),
(29, '2017-09-23', 29, 200, 0, 0, 200),
(30, '2017-09-23', 30, 200, 0, 0, 200),
(31, '2017-09-23', 31, 200, 0, 0, 200),
(32, '2017-09-23', 32, 200, 0, 0, 200),
(33, '2017-09-23', 33, 200, 0, 0, 200),
(34, '2017-09-23', 34, 200, 0, 0, 200),
(35, '2017-09-23', 35, 200, 0, 0, 200),
(36, '2017-09-23', 36, 200, 0, 10, 190),
(37, '2017-09-23', 37, 200, 0, 0, 200),
(38, '2017-09-23', 38, 200, 0, 0, 200),
(39, '2017-09-23', 39, 200, 0, 1, 199),
(40, '2017-09-23', 40, 200, 0, 0, 200),
(41, '2017-09-23', 41, 200, 0, 0, 200),
(42, '2017-09-23', 42, 200, 0, 0, 200),
(43, '2017-09-23', 43, 200, 0, 1, 199),
(44, '2017-09-23', 44, 200, 0, 0, 200),
(45, '2017-09-23', 45, 200, 0, 5, 195),
(46, '2017-09-23', 46, 200, 0, 1, 199);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_barang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_barang` (
`id` int(11)
,`kd_barang` varchar(9)
,`nama` varchar(50)
,`hpp` double(8,2)
,`harga_pasar` double(8,2)
,`market_place` double(8,2)
,`harga_ig` double(8,2)
,`foto` text
,`ket` text
,`stok` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_pembelian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_detail_pembelian` (
`id` int(11)
,`kd_pembelian` int(11)
,`kd_barang` int(11)
,`kode_barang` varchar(9)
,`nama` varchar(50)
,`harga` double(8,2)
,`qty` smallint(6)
,`subtotal` double(12,2)
,`ket` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_penjualan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_detail_penjualan` (
`id` int(11)
,`kd_penjualan` int(11)
,`kd_barang` int(11)
,`kode_barang` varchar(9)
,`nama` varchar(50)
,`hpp` double(8,2)
,`harga` double(8,2)
,`qty` smallint(6)
,`jenis_diskon` char(1)
,`diskon` int(11)
,`subtotal` double(12,2)
,`ket` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pembelian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pembelian` (
`id` int(11)
,`kd_pembelian` varchar(16)
,`tgl` date
,`item` text
,`total` decimal(12,2)
,`ket` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penjualan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_penjualan` (
`id` int(11)
,`kd_penjualan` varchar(16)
,`tgl` date
,`jenis` enum('HARGA PASAR','MARKET PLACE','HARGA IG','RESELLER')
,`item` text
,`total` decimal(12,2)
,`status` varchar(6)
,`ket` text
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_barang`
--
DROP TABLE IF EXISTS `v_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barang`  AS  select `b`.`id` AS `id`,concat_ws('-',`ib`.`id_barang`,`iw`.`id_warna`) AS `kd_barang`,`b`.`nama` AS `nama`,`b`.`hpp` AS `hpp`,`b`.`harga_pasar` AS `harga_pasar`,`b`.`market_place` AS `market_place`,`b`.`harga_ig` AS `harga_ig`,`b`.`foto` AS `foto`,`b`.`ket` AS `ket`,`s`.`stok_akhir` AS `stok` from (((`stok` `s` join `barang` `b` on((`b`.`id` = `s`.`kd_barang`))) join `id_barang` `ib` on((`ib`.`id` = `b`.`id_barang`))) join `id_warna` `iw` on((`iw`.`id` = `b`.`id_warna`))) where `s`.`id` in (select max(`stok`.`id`) from `stok` group by `stok`.`kd_barang`) order by `b`.`id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_detail_pembelian`
--
DROP TABLE IF EXISTS `v_detail_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_pembelian`  AS  select `dp`.`id` AS `id`,`dp`.`kd_pembelian` AS `kd_pembelian`,`dp`.`kd_barang` AS `kd_barang`,`b`.`kd_barang` AS `kode_barang`,`b`.`nama` AS `nama`,`dp`.`harga` AS `harga`,`dp`.`qty` AS `qty`,`dp`.`subtotal` AS `subtotal`,`dp`.`ket` AS `ket` from ((`detail_pembelian` `dp` join `pembelian` `p` on((`p`.`id` = `dp`.`kd_pembelian`))) join `v_barang` `b` on((`b`.`id` = `dp`.`kd_barang`))) order by `dp`.`id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_detail_penjualan`
--
DROP TABLE IF EXISTS `v_detail_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_penjualan`  AS  select `dp`.`id` AS `id`,`dp`.`kd_penjualan` AS `kd_penjualan`,`dp`.`kd_barang` AS `kd_barang`,`b`.`kd_barang` AS `kode_barang`,`b`.`nama` AS `nama`,`dp`.`hpp` AS `hpp`,`dp`.`harga` AS `harga`,`dp`.`qty` AS `qty`,`dp`.`jenis_diskon` AS `jenis_diskon`,`dp`.`diskon` AS `diskon`,`dp`.`subtotal` AS `subtotal`,`dp`.`ket` AS `ket` from ((`detail_penjualan` `dp` join `penjualan` `p` on((`p`.`id` = `dp`.`kd_penjualan`))) join `v_barang` `b` on((`b`.`id` = `dp`.`kd_barang`))) order by `dp`.`id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pembelian`
--
DROP TABLE IF EXISTS `v_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian`  AS  select `p`.`id` AS `id`,`p`.`kd_pembelian` AS `kd_pembelian`,`p`.`tgl` AS `tgl`,group_concat(concat(concat_ws('-',`ib`.`id_barang`,`iw`.`id_warna`),' JUMLAH : ',`dp`.`qty`) separator ', ') AS `item`,cast(sum(`dp`.`subtotal`) as decimal(12,2)) AS `total`,`p`.`ket` AS `ket` from ((((`pembelian` `p` join `detail_pembelian` `dp` on((`dp`.`kd_pembelian` = `p`.`id`))) join `barang` `b` on((`b`.`id` = `dp`.`kd_barang`))) join `id_barang` `ib` on((`ib`.`id` = `b`.`id_barang`))) join `id_warna` `iw` on((`iw`.`id` = `b`.`id_warna`))) group by `p`.`id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_penjualan`
--
DROP TABLE IF EXISTS `v_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan`  AS  select `p`.`id` AS `id`,`p`.`kd_penjualan` AS `kd_penjualan`,`p`.`tgl` AS `tgl`,`p`.`jenis` AS `jenis`,group_concat(concat(concat_ws('-',`ib`.`id_barang`,`iw`.`id_warna`),' JUMLAH : ',`dp`.`qty`) separator ', ') AS `item`,cast((sum(`dp`.`subtotal`) + `p`.`ongkir`) as decimal(12,2)) AS `total`,(case when (`p`.`status` = '1') then 'NORMAL' else 'FREE' end) AS `status`,`p`.`ket` AS `ket` from ((((`penjualan` `p` join `detail_penjualan` `dp` on((`dp`.`kd_penjualan` = `p`.`id`))) join `barang` `b` on((`b`.`id` = `dp`.`kd_barang`))) join `id_barang` `ib` on((`ib`.`id` = `b`.`id_barang`))) join `id_warna` `iw` on((`iw`.`id` = `b`.`id_warna`))) group by `p`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_barang_id_barang` (`id_barang`),
  ADD KEY `fk_barang_id_warna` (`id_warna`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_pembelian_kd_pembelian` (`kd_pembelian`),
  ADD KEY `fk_detail_pembelian_kd_barang` (`kd_barang`);

--
-- Indexes for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_pengeluaran_kd_pengeluaran` (`kd_pengeluaran`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_penjualan_kd_penjualan` (`kd_penjualan`),
  ADD KEY `fk_detail_penjualan_kd_barang` (`kd_barang`);

--
-- Indexes for table `detail_reject`
--
ALTER TABLE `detail_reject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_reject_kd_barang` (`kd_barang`);

--
-- Indexes for table `id_barang`
--
ALTER TABLE `id_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_barang` (`id_barang`);

--
-- Indexes for table `id_warna`
--
ALTER TABLE `id_warna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_warna` (`id_warna`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_pembelian` (`kd_pembelian`),
  ADD KEY `fk_pembelian_username` (`username`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_pengeluaran` (`kd_pengeluaran`),
  ADD KEY `fk_pengeluaran_username` (`username`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_penjualan` (`kd_penjualan`),
  ADD KEY `fk_penjualan_username` (`username`);

--
-- Indexes for table `reject`
--
ALTER TABLE `reject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_reject` (`kd_reject`),
  ADD KEY `fk_reject_kd_penjualan` (`kd_penjualan`),
  ADD KEY `fk_reject_username` (`username`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stok_kd_barang` (`kd_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `detail_reject`
--
ALTER TABLE `detail_reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `id_barang`
--
ALTER TABLE `id_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `id_warna`
--
ALTER TABLE `id_warna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `reject`
--
ALTER TABLE `reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_id_barang` FOREIGN KEY (`id_barang`) REFERENCES `id_barang` (`id`),
  ADD CONSTRAINT `fk_barang_id_warna` FOREIGN KEY (`id_warna`) REFERENCES `id_warna` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `fk_detail_pembelian_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `fk_detail_pembelian_kd_pembelian` FOREIGN KEY (`kd_pembelian`) REFERENCES `pembelian` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD CONSTRAINT `fk_detail_pengeluaran_kd_pengeluaran` FOREIGN KEY (`kd_pengeluaran`) REFERENCES `pengeluaran` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `fk_detail_penjualan_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `fk_detail_penjualan_kd_penjualan` FOREIGN KEY (`kd_penjualan`) REFERENCES `penjualan` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_reject`
--
ALTER TABLE `detail_reject`
  ADD CONSTRAINT `fk_detail_reject_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `fk_detail_reject_kd_reject` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `fk_pembelian_username` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `fk_pengeluaran_username` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `fk_penjualan_username` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Ketidakleluasaan untuk tabel `reject`
--
ALTER TABLE `reject`
  ADD CONSTRAINT `fk_reject_kd_penjualan` FOREIGN KEY (`kd_penjualan`) REFERENCES `penjualan` (`id`),
  ADD CONSTRAINT `fk_reject_username` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Ketidakleluasaan untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `fk_stok_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
