-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: absen
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `absen`
--

DROP TABLE IF EXISTS `absen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `absen` (
  `kode_absen` int(255) NOT NULL AUTO_INCREMENT,
  `kode_karyawan` int(5) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `potongan_terlambat` int(50) DEFAULT NULL,
  PRIMARY KEY (`kode_absen`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absen`
--

LOCK TABLES `absen` WRITE;
/*!40000 ALTER TABLE `absen` DISABLE KEYS */;
INSERT INTO `absen` VALUES (1,2,'2019-12-07','09:00:00','17:00:00',5000),(2,2,'2019-12-30','07:00:00','17:00:00',0),(3,3,'2019-12-01',NULL,NULL,NULL),(4,3,'2019-12-05',NULL,NULL,NULL);
/*!40000 ALTER TABLE `absen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuti`
--

DROP TABLE IF EXISTS `cuti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuti` (
  `kode_cuti` int(5) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `kode_karyawan` varchar(255) DEFAULT NULL,
  `tgl_cuti_a` date DEFAULT NULL,
  `tgl_cuti_b` date DEFAULT NULL,
  `jumlah_hari` int(2) DEFAULT NULL,
  `keterangan` text,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_cuti`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuti`
--

LOCK TABLES `cuti` WRITE;
/*!40000 ALTER TABLE `cuti` DISABLE KEYS */;
INSERT INTO `cuti` VALUES (4,'1','2019-12-10','2019-12-11',2,'semarang 1','2019-12-04 23:42:01');
/*!40000 ALTER TABLE `cuti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gaji`
--

DROP TABLE IF EXISTS `gaji`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gaji` (
  `kode_gaji` int(5) NOT NULL AUTO_INCREMENT,
  `kode_karyawan` int(5) DEFAULT NULL,
  `periode` date DEFAULT NULL,
  `gaji_pokok` int(20) DEFAULT NULL,
  `tunjangan_makan` int(20) DEFAULT NULL,
  `tunjangan_transport` int(20) DEFAULT NULL,
  `total_lembur` int(20) DEFAULT NULL,
  `potongan_terlambat` int(20) DEFAULT NULL,
  `cicilan_hutang` int(20) DEFAULT NULL,
  `jumlah_bayar` int(20) DEFAULT NULL,
  `sisa_hutang` int(20) DEFAULT NULL,
  `hasil_gaji` int(20) DEFAULT NULL,
  PRIMARY KEY (`kode_gaji`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gaji`
--

LOCK TABLES `gaji` WRITE;
/*!40000 ALTER TABLE `gaji` DISABLE KEYS */;
INSERT INTO `gaji` VALUES (2,2,'2019-12-04',1000000,200000,200000,50000,5000,200000,200000,1800000,1245000),(4,2,'2020-01-31',1000000,200000,200000,0,0,200000,400000,1600000,1200000),(5,2,'2020-02-28',1000000,200000,200000,0,0,200000,600000,1400000,1200000),(6,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `gaji` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hutang`
--

DROP TABLE IF EXISTS `hutang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hutang` (
  `kode_hutang` int(5) NOT NULL AUTO_INCREMENT,
  `kode_karyawan` int(5) DEFAULT NULL,
  `jumlah_hutang` int(20) DEFAULT NULL,
  `a_hutang` int(20) DEFAULT NULL,
  PRIMARY KEY (`kode_hutang`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hutang`
--

LOCK TABLES `hutang` WRITE;
/*!40000 ALTER TABLE `hutang` DISABLE KEYS */;
INSERT INTO `hutang` VALUES (2,2,1000000,100000),(3,2,2000000,200000);
/*!40000 ALTER TABLE `hutang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jabatan` (
  `kode_jabatan` int(5) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(50) DEFAULT NULL,
  `gaji_pokok` int(20) DEFAULT NULL,
  `tunjangan_makan` int(20) DEFAULT NULL,
  `tunjangan_transport` int(20) DEFAULT NULL,
  `nominal_lembur` int(20) DEFAULT NULL,
  PRIMARY KEY (`kode_jabatan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jabatan`
--

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` VALUES (1,'STAFF KEUANGAN',1000000,200000,200000,25000),(2,'MANAJER',10000000,200000,200000,25000);
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `karyawan` (
  `kode_karyawan` int(5) NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(100) DEFAULT NULL,
  `alamat_karyawan` text,
  `nomor_telp` varchar(15) DEFAULT NULL,
  `jenkel` varchar(1) DEFAULT NULL,
  `agama` int(1) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `pendidikan` int(4) DEFAULT NULL,
  `kode_jabatan` int(5) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`kode_karyawan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawan`
--

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` VALUES (1,'Wahyu Eka Saputra','Rembang','12344455','L',1,'Rembang','2019-12-31',3,2,1),(2,'Intan Indah','Semarang Indah','123456789','P',1,'Semarang','2019-12-31',3,1,1),(3,'Lie, Johan Oktavianus','Tlogosari','897687687687','L',2,'Semarang','2019-12-31',3,2,1),(4,'Giovanno','Tegal','0123456','L',2,'Tegal','2019-11-17',3,2,1),(5,'Widi Baskoro','Bandung','00001123','L',1,'Bandung','2019-11-19',3,1,1);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lembur`
--

DROP TABLE IF EXISTS `lembur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lembur` (
  `kode_lembur` int(5) NOT NULL AUTO_INCREMENT,
  `kode_karyawan` int(5) DEFAULT NULL,
  `tgl_lembur` date DEFAULT NULL,
  `jam_masuk_kantor` time DEFAULT NULL,
  `jam_pulang_kantor` time DEFAULT NULL,
  `keterangan` text,
  `hari_lembur` varbinary(20) DEFAULT NULL,
  PRIMARY KEY (`kode_lembur`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lembur`
--

LOCK TABLES `lembur` WRITE;
/*!40000 ALTER TABLE `lembur` DISABLE KEYS */;
INSERT INTO `lembur` VALUES (2,2,'2019-12-07','08:00:00','10:00:00','atit',_binary 'senin');
/*!40000 ALTER TABLE `lembur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_agama`
--

DROP TABLE IF EXISTS `ref_agama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_agama` (
  `kode_agama` int(1) NOT NULL,
  `agama` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_agama`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_agama`
--

LOCK TABLES `ref_agama` WRITE;
/*!40000 ALTER TABLE `ref_agama` DISABLE KEYS */;
INSERT INTO `ref_agama` VALUES (1,'Islam'),(2,'Kristen'),(3,'Katholik'),(4,'Budha'),(5,'HIndu');
/*!40000 ALTER TABLE `ref_agama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ref_pendidikan`
--

DROP TABLE IF EXISTS `ref_pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ref_pendidikan` (
  `kode_pendidikan` int(1) NOT NULL,
  `pendidikan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kode_pendidikan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_pendidikan`
--

LOCK TABLES `ref_pendidikan` WRITE;
/*!40000 ALTER TABLE `ref_pendidikan` DISABLE KEYS */;
INSERT INTO `ref_pendidikan` VALUES (1,'SD'),(2,'SMP'),(3,'SMA'),(4,'S1');
/*!40000 ALTER TABLE `ref_pendidikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riwayat`
--

DROP TABLE IF EXISTS `riwayat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `riwayat` (
  `kode_riwayat` int(5) NOT NULL AUTO_INCREMENT,
  `kode_karyawan` int(5) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`kode_riwayat`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat`
--

LOCK TABLES `riwayat` WRITE;
/*!40000 ALTER TABLE `riwayat` DISABLE KEYS */;
INSERT INTO `riwayat` VALUES (2,1,'2019-11-16','2019-11-16',1),(3,2,'2019-11-01','2019-11-30',1);
/*!40000 ALTER TABLE `riwayat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_hak_akses`
--

DROP TABLE IF EXISTS `tbl_hak_akses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_hak_akses`
--

LOCK TABLES `tbl_hak_akses` WRITE;
/*!40000 ALTER TABLE `tbl_hak_akses` DISABLE KEYS */;
INSERT INTO `tbl_hak_akses` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,10),(5,2,11),(6,2,12),(7,2,13),(8,2,14),(9,2,15),(10,2,16),(11,2,17),(12,2,19),(13,2,20),(14,2,21);
/*!40000 ALTER TABLE `tbl_hak_akses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no',
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu`
--

LOCK TABLES `tbl_menu` WRITE;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` VALUES (1,'KELOLA MENU','kelolamenu','fa fa-server',0,'y'),(2,'KELOLA PENGGUNA','user','fa fa-user-o',0,'y'),(3,'level PENGGUNA','userlevel','fa fa-users',0,'y'),(9,'Contoh Form','welcome/form','fa fa-id-card',0,'y'),(10,'Absen','absen','fa fa-user-plus',0,'y'),(11,'Cuti','cuti','fa fa-user-o',0,'y'),(12,'Gaji','gaji','fa fa-users',0,'y'),(13,'Hutang','hutang','fa fa-user-o',0,'y'),(14,'Jabatan','jabatan','fa fa-users',0,'y'),(15,'Karyawan','karyawan','fa fa-user-o',0,'y'),(16,'Lembur','lembur','fa fa-users',0,'y'),(17,'Riwayat','riwayat','fa fa-user-o',0,'y'),(19,'LAPORAN','#','fa fa-users',0,'y'),(20,'Absen','laporan_absen','fa fa-user-o',19,'y'),(21,'Gaji','laporan_gaji','fa fa-users',19,'y');
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setting`
--

DROP TABLE IF EXISTS `tbl_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setting`
--

LOCK TABLES `tbl_setting` WRITE;
/*!40000 ALTER TABLE `tbl_setting` DISABLE KEYS */;
INSERT INTO `tbl_setting` VALUES (1,'Tampil Menu','ya');
/*!40000 ALTER TABLE `tbl_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL,
  PRIMARY KEY (`id_users`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'admin','admin@admin.com','$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq','atomix_user31.png',1,'y'),(2,'user','user@user.com','$2y$10$Vp/Bhwh4Q4i34FBndOkVOOzJeePRhHW/kS2shWAWNidLkQGQapJum','atomix_user31.png',2,'y');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_level`
--

DROP TABLE IF EXISTS `tbl_user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(30) NOT NULL,
  PRIMARY KEY (`id_user_level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_level`
--

LOCK TABLES `tbl_user_level` WRITE;
/*!40000 ALTER TABLE `tbl_user_level` DISABLE KEYS */;
INSERT INTO `tbl_user_level` VALUES (1,'Super Admin'),(2,'Admin');
/*!40000 ALTER TABLE `tbl_user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_laporan_absen`
--

DROP TABLE IF EXISTS `view_laporan_absen`;
/*!50001 DROP VIEW IF EXISTS `view_laporan_absen`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_laporan_absen` AS SELECT 
 1 AS `nama_karyawan`,
 1 AS `kode_absen`,
 1 AS `kode_karyawan`,
 1 AS `tgl`,
 1 AS `jam_masuk`,
 1 AS `jam_pulang`,
 1 AS `potongan_terlambat`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_laporan_gaji`
--

DROP TABLE IF EXISTS `view_laporan_gaji`;
/*!50001 DROP VIEW IF EXISTS `view_laporan_gaji`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_laporan_gaji` AS SELECT 
 1 AS `kode_gaji`,
 1 AS `periode`,
 1 AS `kode_karyawan`,
 1 AS `hasil_gaji`,
 1 AS `nama_karyawan`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'absen'
--

--
-- Final view structure for view `view_laporan_absen`
--

/*!50001 DROP VIEW IF EXISTS `view_laporan_absen`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_laporan_absen` AS select `karyawan`.`nama_karyawan` AS `nama_karyawan`,`absen`.`kode_absen` AS `kode_absen`,`karyawan`.`kode_karyawan` AS `kode_karyawan`,`absen`.`tgl` AS `tgl`,`absen`.`jam_masuk` AS `jam_masuk`,`absen`.`jam_pulang` AS `jam_pulang`,`absen`.`potongan_terlambat` AS `potongan_terlambat` from (`absen` join `karyawan` on((`absen`.`kode_karyawan` = `karyawan`.`kode_karyawan`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_laporan_gaji`
--

/*!50001 DROP VIEW IF EXISTS `view_laporan_gaji`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_laporan_gaji` AS select `gaji`.`kode_gaji` AS `kode_gaji`,`gaji`.`periode` AS `periode`,`gaji`.`kode_karyawan` AS `kode_karyawan`,`gaji`.`hasil_gaji` AS `hasil_gaji`,`karyawan`.`nama_karyawan` AS `nama_karyawan` from (`gaji` join `karyawan` on((`gaji`.`kode_karyawan` = `karyawan`.`kode_karyawan`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-15 12:49:23
