-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2017 at 08:31 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_pembelian` (IN `id_param` INT, IN `tgl_param` DATE, IN `kd_barang_param` INT, IN `harga_param` DOUBLE(8,2), IN `qty_param` SMALLINT, IN `total_param` DOUBLE(12,2), IN `ket_param` TEXT, IN `username_param` VARCHAR(10))  BEGIN
    DECLARE tgl_skrng date;
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

    SELECT current_date into tgl_skrng;
        SELECT kd_barang into kd_barang_pembelian FROM pembelian WHERE id=id_param; 
        IF tgl_param = tgl_skrng THEN 
                IF kd_barang_param = kd_barang_pembelian THEN

            SELECT qty into get_qty_pembelian FROM pembelian WHERE id=id_param;
            
                        IF qty_param != get_qty_pembelian THEN
                
                SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;                 SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;                 SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
                UPDATE stok SET
                    brg_masuk=((get_brg_masuk-get_qty_pembelian)+qty_param), stok_akhir=((get_stk_awal+(get_brg_masuk-get_qty_pembelian)+qty_param)-get_brg_keluar)
                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
            end if;

                         UPDATE pembelian SET 
                kd_barang=kd_barang_param, qty=qty_param, harga=harga_param,  total=total_param, ket=ket_param 
            WHERE id=id_param;

                ELSE
            SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;             SELECT qty into get_qty_pembelian FROM pembelian WHERE id=id_param;

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

                UPDATE pembelian SET 
	                kd_barang=kd_barang_param, qty=qty_param, harga=harga_param,  total=total_param, ket=ket_param 
	            WHERE id=id_param;

                        ELSE

                SELECT qty into get_qty_pembelian FROM pembelian WHERE id=id_param;
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

                UPDATE pembelian SET 
	                kd_barang=kd_barang_param, qty=qty_param, harga=harga_param,  total=total_param, ket=ket_param 
	            WHERE id=id_param;

            end if;

        end if;

    ELSE
        UPDATE pembelian SET 
            harga=harga_param,  total=total_param, ket=ket_param 
        WHERE id=id_param;
    end if;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_penjualan` (IN `id_param` INT, IN `tgl_param` DATE, IN `jenis_param` VARCHAR(8), IN `nama_param` VARCHAR(50), IN `telp_param` VARCHAR(15), IN `alamat_param` TEXT, IN `ongkir_param` DOUBLE(8,2), IN `kd_barang_param` INT, IN `hpp_param` DOUBLE(8,2), IN `harga_param` DOUBLE(8,2), IN `qty_param` SMALLINT, IN `diskon_param` SMALLINT, IN `total_param` DOUBLE(12,2), IN `laba_param` DOUBLE(8,2), IN `status_param` CHAR(1), IN `ket_param` TEXT, IN `username_param` VARCHAR(10))  BEGIN
    DECLARE tgl_skrng date;
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

    SELECT current_date into tgl_skrng;
        SELECT kd_barang into kd_barang_penjualan FROM penjualan WHERE id=id_param; 
        IF tgl_param = tgl_skrng THEN 
                IF kd_barang_param = kd_barang_penjualan THEN

            SELECT qty into get_qty_penjualan FROM penjualan WHERE id=id_param;
            
                        IF qty_param != get_qty_penjualan THEN
                
                SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;                 SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;                 SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param; 
                UPDATE stok SET
                    brg_keluar=(get_brg_keluar+(qty_param-get_qty_penjualan)), stok_akhir=((get_stk_awal+get_brg_masuk)-(get_brg_keluar+(qty_param-get_qty_penjualan)))
                WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
            end if;

                         UPDATE penjualan SET 
                kd_barang=kd_barang_param, qty=qty_param, jenis=jenis_param, nama=nama_param, telp=telp_param, alamat=alamat_param, ongkir=ongkir_param, hpp=hpp_param, 
                harga=harga_param, diskon=diskon_param, total=total_param, laba=laba_param, status=status_param, ket=ket_param 
            WHERE id=id_param;

                ELSE
            SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;             SELECT qty into get_qty_penjualan FROM penjualan WHERE id=id_param;

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
                                        INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));

                end if;

                UPDATE penjualan SET 
                    kd_barang=kd_barang_param, qty=qty_param, jenis=jenis_param, nama=nama_param, telp=telp_param, alamat=alamat_param, ongkir=ongkir_param, hpp=hpp_param, 
                    harga=harga_param, diskon=diskon_param, total=total_param, laba=laba_param, status=status_param, ket=ket_param 
                WHERE id=id_param;

                        ELSE

                SELECT qty into get_qty_penjualan FROM penjualan WHERE id=id_param;
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

                UPDATE penjualan SET 
                    kd_barang=kd_barang_param, qty=qty_param, jenis=jenis_param, nama=nama_param, telp=telp_param, alamat=alamat_param, ongkir=ongkir_param, hpp=hpp_param, 
                    harga=harga_param, diskon=diskon_param, total=total_param, laba=laba_param, status=status_param, ket=ket_param 
                WHERE id=id_param;

            end if;

        end if;

    ELSE
                UPDATE penjualan SET 
            jenis=jenis_param, nama=nama_param, telp=telp_param, alamat=alamat_param, ongkir=ongkir_param, hpp=hpp_param, 
            harga=harga_param, diskon=diskon_param, total=total_param, laba=laba_param, status=status_param, ket=ket_param 
        WHERE id=id_param;
    end if;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_reject` (IN `id_param` INT, IN `kd_penjualan_param` INT, IN `tgl_param` DATE, IN `kd_barang_param` INT, IN `qty_param` SMALLINT, IN `kd_barang_ganti_param` INT, IN `hpp_param` DOUBLE(8,2), IN `harga_param` DOUBLE(8,2), IN `ongkir_param` DOUBLE(8,2), IN `total_param` DOUBLE(12,2), IN `rugi_param` DOUBLE(8,2), IN `ket_param` TEXT, IN `username_param` VARCHAR(10))  BEGIN

    DECLARE tgl_skrng date;
    DECLARE kd_barang_reject int;
    DECLARE get_qty_reject SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_brg_masuk SMALLINT;
    DECLARE cek_tgl SMALLINT;
    DECLARE cek_tgl_2 SMALLINT;
    DECLARE stok_awal_A int;
    DECLARE stok_awal_B int;
    DECLARE brg_masuk_A SMALLINT;
    DECLARE brg_masuk_B SMALLINT;
    DECLARE brg_keluar_A SMALLINT;
    DECLARE brg_keluar_B SMALLINT;
    DECLARE stok_akhir_param int;
    DECLARE stok_akhir_param_2 int;

    SELECT current_date into tgl_skrng;
        SELECT kd_barang_ganti into kd_barang_reject FROM reject WHERE id=id_param; 
        IF tgl_param = tgl_skrng THEN 
                IF kd_barang_ganti_param = kd_barang_reject THEN

            SELECT qty into get_qty_reject FROM reject WHERE id=id_param;
            
                        IF qty_param != get_qty_reject THEN
                
                SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param;                 SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param;                 SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                UPDATE stok SET
                    brg_keluar=(get_brg_keluar+(qty_param-get_qty_reject)), stok_akhir=((get_stk_awal+get_brg_masuk)-(get_brg_keluar+(qty_param-get_qty_reject)))
                WHERE tgl=tgl_param AND kd_barang=kd_barang_ganti_param;
            end if;

                        UPDATE reject SET 
                kd_barang_ganti=kd_barang_ganti_param, qty=qty_param, hpp=hpp_param,
                harga=harga_param, ongkir=ongkir_param, total=total_param, rugi=rugi_param, ket=ket_param, username=username_param
            WHERE id=id_param;

                ELSE
            SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_ganti_param;             SELECT count(tgl) into cek_tgl_2 FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_reject;             SELECT qty into get_qty_reject FROM reject WHERE id=id_param;

                        IF qty_param = get_qty_reject THEN

                                SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;
                SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;
                SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;

                IF cek_tgl_2 > 0 THEN

                                        UPDATE stok SET
                        brg_keluar=(brg_keluar_A-qty_param), stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-qty_param))
                    WHERE tgl=tgl_param AND kd_barang=kd_barang_reject;
                ELSE
                                        SELECT stok_akhir into stok_akhir_param_2 from stok WHERE kd_barang=kd_barang_reject ORDER BY id DESC LIMIT 1;

                                        INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_reject,stok_akhir_param_2,'','',stok_akhir_param_2);            

                end if;    

                                SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 

                IF cek_tgl > 0 THEN

                                        UPDATE stok SET
                        brg_keluar=(brg_keluar_B+qty_param), stok_akhir=(stok_awal_B+brg_masuk_B-(brg_keluar_B+qty_param))
                    WHERE tgl=tgl_param AND kd_barang=kd_barang_ganti_param;
                
                ELSE
                    SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_ganti_param ORDER BY id DESC LIMIT 1;         
                                        INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_ganti_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));

                end if;

                UPDATE reject SET 
                    kd_barang_ganti=kd_barang_ganti_param, qty=qty_param, hpp=hpp_param,
                    harga=harga_param, ongkir=ongkir_param, total=total_param, rugi=rugi_param, ket=ket_param, username=username_param
                WHERE id=id_param;

                        ELSE

                SELECT qty into get_qty_reject FROM reject WHERE id=id_param;
                                SELECT brg_keluar into brg_keluar_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;
                SELECT brg_masuk into brg_masuk_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;
                SELECT stok_awal into stok_awal_A from stok WHERE kd_barang=kd_barang_reject AND tgl=tgl_param;

                                SELECT stok_awal into stok_awal_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                SELECT brg_keluar into brg_keluar_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 
                SELECT brg_masuk into brg_masuk_B FROM stok WHERE kd_barang=kd_barang_ganti_param and tgl=tgl_param; 

                                UPDATE stok SET
                    brg_keluar=(brg_keluar_A-get_qty_reject), stok_akhir=(stok_awal_A+brg_masuk_A-(brg_keluar_A-get_qty_reject))
                WHERE tgl=tgl_param AND kd_barang=kd_barang_reject;

                IF cek_tgl > 0 THEN

                                        UPDATE stok SET
                        brg_keluar=(brg_keluar_B+qty_param), stok_akhir=(stok_awal_B+brg_masuk_B-(brg_keluar_B+qty_param))
                    WHERE tgl=tgl_param AND kd_barang=kd_barang_ganti_param;
                
                ELSE
                    SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1; 
                                        INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
                    VALUES(tgl_param,kd_barang_ganti_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
                end if;

                UPDATE reject SET 
                    kd_barang_ganti=kd_barang_ganti_param, qty=qty_param, hpp=hpp_param,
                    harga=harga_param, ongkir=ongkir_param, total=total_param, rugi=rugi_param, ket=ket_param, username=username_param
                WHERE id=id_param;

            end if;

        end if;

    ELSE
                UPDATE reject SET 
            ongkir=ongkir_param, ket=ket_param, username=username_param
        WHERE id=id_param;
    end if;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_barang` (IN `kd_barang_param` VARCHAR(9), IN `id_barang_param` VARCHAR(4), IN `id_warna_param` VARCHAR(4), IN `nama_param` VARCHAR(50), IN `hpp_param` DOUBLE(8,2), IN `harga_pasar_param` DOUBLE(8,2), IN `market_place_param` DOUBLE(8,2), IN `harga_ig_param` DOUBLE(8,2), IN `foto_param` VARCHAR(15), IN `ket_param` TEXT, IN `tgl_param` DATE, IN `stok_awal_param` INT)  BEGIN

    DECLARE id_param int;
    
    SELECT `AUTO_INCREMENT` INTO id_param FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'zaco_hijab' AND   TABLE_NAME   = 'barang';

		INSERT INTO barang(kd_barang, id_barang, id_warna, nama, hpp, harga_pasar, market_place, harga_ig, foto,ket)
    VALUES(kd_barang_param, id_barang_param, id_warna_param, nama_param, hpp_param, harga_pasar_param, market_place_param, harga_ig_param, foto_param, ket_param);
    
        INSERT INTO stok(tgl, kd_barang, stok_awal, brg_masuk, brg_keluar, stok_akhir)
    VALUES(tgl_param, id_param, stok_awal_param, 0, 0, stok_awal_param);
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_pembelian` (IN `kd_pembelian_param` VARCHAR(16), IN `tgl_param` DATE, IN `kd_barang_param` INT, IN `harga_param` DOUBLE(8,2), IN `qty_param` SMALLINT, IN `total_param` DOUBLE(12,2), IN `jenis_param` VARCHAR(8), IN `ket_param` TEXT, IN `username_param` VARCHAR(10))  BEGIN

    DECLARE cek_tgl SMALLINT;
    DECLARE stok_akhir_param int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_masuk SMALLINT;

        INSERT INTO pembelian(
       kd_pembelian, tgl, kd_barang, harga, qty, total, jenis, ket, username)
    VALUES(
        kd_pembelian_param, tgl_param, kd_barang_param, harga_param, qty_param, total_param, jenis_param, ket_param, username_param);
    
        SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
    
    IF cek_tgl > 0 THEN 
                
        SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         
        UPDATE stok SET
            brg_masuk=(qty_param+get_brg_masuk), stok_akhir=(get_stk_awal+(qty_param+get_brg_masuk)-get_brg_keluar)
        WHERE
            kd_barang=kd_barang_param AND tgl=tgl_param;
        
    ELSE         
        SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1;         
                INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
        VALUES(tgl_param,kd_barang_param,stok_akhir_param,qty_param,'',(stok_akhir_param+qty_param));
    end if;
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_penjualan` (IN `kd_penjualan_param` VARCHAR(16), IN `tgl_param` DATE, IN `jenis_param` VARCHAR(8), IN `nama_param` VARCHAR(50), IN `telp_param` VARCHAR(15), IN `alamat_param` TEXT, IN `ongkir_param` DOUBLE(8,2), IN `kd_barang_param` INT, IN `hpp_param` DOUBLE(8,2), IN `harga_param` DOUBLE(8,2), IN `qty_param` SMALLINT, IN `diskon_param` SMALLINT, IN `total_param` DOUBLE(12,2), IN `laba_param` DOUBLE(8,2), IN `status_param` CHAR(1), IN `ket_param` TEXT, IN `username_param` VARCHAR(10))  BEGIN

	DECLARE cek_tgl SMALLINT;
	DECLARE stok_akhir_param int;
	DECLARE get_brg_keluar SMALLINT;
	DECLARE get_stk_awal int;
	DECLARE get_brg_masuk SMALLINT;

	    INSERT INTO penjualan(
    	kd_penjualan, tgl, jenis, nama, telp, alamat, ongkir, kd_barang, 
    	hpp, harga, qty, diskon, total, laba, status, ket, username) 
    VALUES(
    	kd_penjualan_param, tgl_param, jenis_param, nama_param, telp_param, alamat_param, ongkir_param, kd_barang_param, 
    	hpp_param, harga_param, qty_param, diskon_param, total_param, laba_param, status_param, ket_param, username_param);
	
        SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
    
    IF cek_tgl > 0 THEN 
    	        
        SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_param and tgl=tgl_param;         
    	UPDATE stok SET
    		brg_keluar=(qty_param+get_brg_keluar), stok_akhir=(get_stk_awal+get_brg_masuk-(qty_param+get_brg_keluar))
    	WHERE
    		kd_barang=kd_barang_param AND tgl=tgl_param;
        
    ELSE     	
        SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_param ORDER BY id DESC LIMIT 1;         
    	    	INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
    	VALUES(tgl_param,kd_barang_param,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
    end if;
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_reject` (IN `kd_penjualan_param` INT, IN `tgl_param` DATE, IN `kd_barang_param` INT, IN `qty_param` SMALLINT, IN `kd_barang_ganti` INT, IN `hpp_param` DOUBLE(8,2), IN `harga_param` DOUBLE(8,2), IN `ongkir_param` DOUBLE(8,2), IN `total_param` DOUBLE(12,2), IN `rugi_param` DOUBLE(8,2), IN `ket_param` TEXT, IN `username_param` VARCHAR(10))  BEGIN

    DECLARE cek_tgl SMALLINT;
    DECLARE stok_akhir_param int;
    DECLARE get_brg_keluar SMALLINT;
    DECLARE get_stk_awal int;
    DECLARE get_brg_masuk SMALLINT;

        INSERT INTO reject(
        kd_penjualan, tgl, kd_barang, qty, kd_barang_ganti, 
        hpp, harga, ongkir, total, rugi, ket, username) 
    VALUES(
        kd_penjualan_param, tgl_param, kd_barang_param, qty_param, kd_barang_ganti, hpp_param, 
        harga_param, ongkir_param, total_param, rugi_param, ket_param, username_param);
    
        SELECT count(tgl) into cek_tgl FROM stok WHERE tgl=tgl_param AND kd_barang=kd_barang_param;
    
    IF cek_tgl > 0 THEN 
                
        SELECT brg_keluar into get_brg_keluar FROM stok WHERE kd_barang=kd_barang_ganti and tgl=tgl_param;         SELECT stok_awal into get_stk_awal FROM stok WHERE kd_barang=kd_barang_ganti and tgl=tgl_param;         SELECT brg_masuk into get_brg_masuk FROM stok WHERE kd_barang=kd_barang_ganti and tgl=tgl_param;         
        UPDATE stok SET
            brg_keluar=(qty_param+get_brg_keluar), stok_akhir=(get_stk_awal+get_brg_masuk-(qty_param+get_brg_keluar))
        WHERE
            kd_barang=kd_barang_ganti AND tgl=tgl_param;
        
    ELSE         
        SELECT stok_akhir into stok_akhir_param from stok WHERE kd_barang=kd_barang_ganti ORDER BY id DESC LIMIT 1;         
                INSERT into stok(tgl,kd_barang,stok_awal,brg_masuk,brg_keluar,stok_akhir)
        VALUES(tgl_param,kd_barang_ganti,stok_akhir_param,'',qty_param,(stok_akhir_param-qty_param));
    end if;
    
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` enum('ADMIN','KASIR') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kd_barang` varchar(9) NOT NULL,
  `id_barang` varchar(4) DEFAULT NULL,
  `id_warna` varchar(4) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `hpp` double(8,2) DEFAULT NULL,
  `harga_pasar` double(8,2) DEFAULT NULL,
  `market_place` double(8,2) DEFAULT NULL,
  `harga_ig` double(8,2) DEFAULT NULL,
  `foto` varchar(15) DEFAULT NULL,
  `ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `id_barang`
--

CREATE TABLE `id_barang` (
  `id` varchar(4) NOT NULL,
  `nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `id_warna`
--

CREATE TABLE `id_warna` (
  `id` varchar(4) NOT NULL,
  `nama` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `kd_pembelian` varchar(16) NOT NULL,
  `tgl` date DEFAULT NULL,
  `kd_barang` int(11) DEFAULT NULL,
  `harga` double(8,2) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `total` double(12,2) DEFAULT NULL,
  `jenis` enum('PRODUKSI','MARKETING','OPERASIONAL','GAJI','AKTIVA TETAP','LAINNYA') DEFAULT 'PRODUKSI',
  `ket` text,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `kd_pengeluaran` varchar(16) NOT NULL,
  `tgl` date DEFAULT NULL,
  `ket` text,
  `nominal` double(12,2) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `total` double(12,2) DEFAULT NULL,
  `jenis` enum('PRODUKSI','MARKETING','OPERASIONAL','GAJI','AKTIVA TETAP','LAINNYA') DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `kd_penjualan` varchar(16) NOT NULL,
  `tgl` date DEFAULT NULL,
  `jenis` enum('OFFLINE','ECER','RESELLER','ONLINE') DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text,
  `ongkir` double(8,2) DEFAULT NULL,
  `kd_barang` int(11) DEFAULT NULL,
  `hpp` double(8,2) DEFAULT NULL,
  `harga` double(8,2) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `diskon` smallint(6) DEFAULT NULL,
  `total` double(12,2) DEFAULT NULL,
  `laba` double(8,2) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `ket` text,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reject`
--

CREATE TABLE `reject` (
  `id` int(11) NOT NULL,
  `kd_penjualan` int(11) NOT NULL,
  `tgl` date DEFAULT NULL,
  `kd_barang` int(11) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `kd_barang_ganti` int(11) DEFAULT NULL,
  `hpp` double(8,2) DEFAULT NULL,
  `harga` double(8,2) DEFAULT NULL,
  `ongkir` double(8,2) DEFAULT NULL,
  `total` double(12,2) DEFAULT NULL,
  `rugi` double(8,2) DEFAULT NULL,
  `ket` text,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stok`
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
  ADD UNIQUE KEY `kd_barang` (`kd_barang`),
  ADD KEY `fk_barang_id_barang` (`id_barang`),
  ADD KEY `fk_barang_id_warna` (`id_warna`);

--
-- Indexes for table `id_barang`
--
ALTER TABLE `id_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_warna`
--
ALTER TABLE `id_warna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembelian_kd_barang` (`kd_barang`),
  ADD KEY `fk_pembelian_username` (`username`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengeluaran_username` (`username`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penjualan_kd_barang` (`kd_barang`),
  ADD KEY `fk_penjualan_username` (`username`);

--
-- Indexes for table `reject`
--
ALTER TABLE `reject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reject_kd_penjualan` (`kd_penjualan`),
  ADD KEY `fk_reject_kd_barang` (`kd_barang`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reject`
--
ALTER TABLE `reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_id_barang` FOREIGN KEY (`id_barang`) REFERENCES `id_barang` (`id`),
  ADD CONSTRAINT `fk_barang_id_warna` FOREIGN KEY (`id_warna`) REFERENCES `id_warna` (`id`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `fk_pembelian_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `fk_pembelian_username` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `fk_pengeluaran_username` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `fk_penjualan_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `fk_penjualan_username` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Constraints for table `reject`
--
ALTER TABLE `reject`
  ADD CONSTRAINT `fk_reject_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `fk_reject_kd_penjualan` FOREIGN KEY (`kd_penjualan`) REFERENCES `penjualan` (`id`),
  ADD CONSTRAINT `fk_reject_username` FOREIGN KEY (`username`) REFERENCES `admin` (`username`);

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `fk_stok_kd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
