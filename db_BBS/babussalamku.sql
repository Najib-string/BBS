-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2026 pada 08.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `babussalamku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500'),
(2, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_pendaftaran`
--

CREATE TABLE `dokumen_pendaftaran` (
  `id` int(11) NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `kk` varchar(255) DEFAULT NULL,
  `akta_kelahiran` varchar(255) DEFAULT NULL,
  `ktp_ortu` varchar(255) DEFAULT NULL,
  `ijazah` varchar(255) DEFAULT NULL,
  `pas_foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokumen_pendaftaran`
--

INSERT INTO `dokumen_pendaftaran` (`id`, `pendaftaran_id`, `kk`, `akta_kelahiran`, `ktp_ortu`, `ijazah`, `pas_foto`, `created_at`) VALUES
(1, 13, '1768397152_contok-kk.jpeg', '1768397152_contoh-ktp.jpeg', '1768397152_contoh-ktp.jpeg', '1768397152_contok-kk.jpeg', '1768397152_contoh-pasfoto.jpg', '2026-01-14 13:25:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nik` varchar(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `email` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `tahun_lulus` varchar(4) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `no_hp_ortu` varchar(20) NOT NULL,
  `alasan_daftar` text NOT NULL,
  `file_kk` varchar(255) DEFAULT NULL,
  `file_akta` varchar(255) DEFAULT NULL,
  `file_ktp_ortu` varchar(255) DEFAULT NULL,
  `file_ijazah` varchar(255) DEFAULT NULL,
  `file_foto` varchar(255) DEFAULT NULL,
  `status` enum('proses','diterima','ditolak') DEFAULT 'proses',
  `kk` varchar(255) DEFAULT NULL,
  `akta_kelahiran` varchar(255) DEFAULT NULL,
  `ktp_ortu` varchar(255) DEFAULT NULL,
  `ijazah` varchar(255) DEFAULT NULL,
  `pas_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nama_lengkap`, `no_hp`, `alamat`, `created_at`, `nik`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `email`, `asal_sekolah`, `tahun_lulus`, `nama_ayah`, `pekerjaan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `no_hp_ortu`, `alasan_daftar`, `file_kk`, `file_akta`, `file_ktp_ortu`, `file_ijazah`, `file_foto`, `status`, `kk`, `akta_kelahiran`, `ktp_ortu`, `ijazah`, `pas_foto`) VALUES
(8, 'Asep Stoberi', '', '', '2025-12-26 14:00:27', '3206350304040022', 'Ciberkah', '2010-06-10', 'L', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, 'diterima', NULL, NULL, NULL, NULL, NULL),
(9, 'Winda Noor Dini', '081235548877', 'Kp. Cibalong', '2025-12-27 07:10:22', '3206120420441444', 'Tasikmalaya', '2006-06-16', 'P', 'windadoclo@gmail.com', 'SMA Nurul Huda', '2023', 'Iting', 'Sopir', 'Marni', 'IRT', '098766554577', 'Gabut', NULL, NULL, NULL, NULL, NULL, 'diterima', NULL, NULL, NULL, NULL, NULL),
(10, 'Alzam Alkatiri', '085735874475', 'Kp Salihan', '2026-01-12 10:46:22', '3206345677658873', 'Kota Cianjur', '2006-08-11', 'L', 'alzamalk9@gmail.com', 'SMP Sindangjaya 03', '2020', 'Komar', 'Guru Ngaji', 'Nyai', 'IRT', '085735874475', 'Karna ingin menjadi orang yang bermanfaat', NULL, NULL, NULL, NULL, NULL, 'diterima', NULL, NULL, NULL, NULL, NULL),
(11, 'Alif Maulana', '086597201344', 'Kp Puteran', '2026-01-13 14:16:20', '3206009988776554', 'Ciamis', '2005-04-05', 'L', 'alipmaul@gmail.com', 'MAN 3 Tasikmalaya', '2024', 'Qorun', 'BUMN', 'Engkar', 'IRT', '086597201344', 'Melanjutkan pendidikan', NULL, NULL, NULL, NULL, NULL, 'diterima', NULL, NULL, NULL, NULL, NULL),
(12, 'Ilham Riansyah', '081256748123', 'Kp Kaler', '2026-01-13 14:31:05', '3206714755664573', 'Kota Garut', '2011-10-19', 'L', 'ilhamx9@gmail.com', 'MA Nurul Ishlah', '2023', 'Koko', 'Karyawan', 'Nunik', 'Buruh', '081256748123', 'Pengen', NULL, NULL, NULL, NULL, NULL, 'ditolak', NULL, NULL, NULL, NULL, NULL),
(13, 'Fadlan Dzakirul Mannan', '087786754315', 'Kp Cibitung', '2026-01-14 13:25:52', '3206178576311154', 'Kabupaten Tasikmalaya', '2008-06-22', 'L', 'fadlandzaki@gmail.com', 'MI Condong', '2024', 'Yasir', 'Mubaligh', 'Asri', 'IRT', '087786754315', 'Ingin Mejadi Ulama', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL),
(14, 'Kokom', '089725099922', 'Kp Selaawi', '2026-01-14 14:09:43', '3206350304040022', 'Ciberkah', '2005-07-14', 'P', 'kokommok@gmail.com', 'SMP Cikole', '2023', 'Endang', 'Buruh', 'Sinta', 'Wiraswasta', '089725099922', 'Pengen', NULL, NULL, NULL, NULL, NULL, 'ditolak', NULL, NULL, NULL, NULL, NULL),
(15, 'Kisan Asfa Derby', '081235548870', 'Kp Tejamaya', '2026-01-14 15:06:27', '3206009988776577', 'Kabupaten Tasikmalaya', '2009-05-02', 'L', 'kisannn@gmail.com', 'SD Tejamaya', '2023', 'Falahudin', 'Mubaligh', 'Romlah', 'Mubaligoh', '081235548870', 'Melanjutkan Pendidikan', NULL, NULL, NULL, NULL, NULL, 'diterima', '1768403187_contok-kk.jpeg', '1768403187_contok-kk.jpeg', '1768403187_contoh-ktp.jpeg', '1768403187_contoh-ktp.jpeg', '1768403187_contoh-pasfoto.jpg'),
(16, 'Mikaila Adzkia', '081235548898', 'Kp Cicadas', '2026-01-15 06:12:06', '3206120427541449', 'Kab Subang', '2008-08-15', 'P', 'Adzkiaa1@gmail.com', 'MAN 1 Subang', '2022', 'Pungki', 'BUMN', 'Kania', 'PNS', '081235548898', 'Memperdalam ilmu pengetahuan', NULL, NULL, NULL, NULL, NULL, 'proses', '1768457526_contok-kk.jpeg', '1768457526_contoh-akta.jpg', '1768457526_contoh-ktp.jpeg', '1768457526_contoh-ijazah.jpg', '1768457526_contoh-pasfoto.jpg'),
(17, 'dani ', '76527652712568', 'kp calingcing kidul', '2026-01-16 03:31:57', '3265364564266772', 'tasikmalaya', '2026-05-16', 'L', 'danidarojat24@sma.belajar.id', 'dtasdtardtr', '2023', 'dsfdaf', 'iusioyuiw', 'iyiwutyr', 'uisyrstsr', '785263534', 'rdswswyrwtyrswywresrt', NULL, NULL, NULL, NULL, NULL, 'ditolak', '1768534317_contoh-ktp.jpeg', '1768534317_contoh-ktp.jpeg', '1768534317_contoh-ktp.jpeg', '1768534317_contoh-ktp.jpeg', '1768534317_contoh-ktp.jpeg'),
(18, 'dani ', '087786754315', 'kp.calingcing kidul ', '2026-01-16 06:19:54', '12614252634625', 'Kota Cianjur', '2016-06-14', 'L', 'Ushiuahsu@gmail.com', 'kjdoewjojd', '2020', 'ifiudhi', 'Sopir', 'ejoeije', 'jeoiwfjo', '081256748123', 'kjdkejdehdkewedhee', NULL, NULL, NULL, NULL, NULL, 'diterima', '1768544394_contoh-ijazah.jpg', '1768544394_contoh-ktp.jpeg', '1768544394_contok-kk.jpeg', '1768544394_contoh-ijazah.jpg', '1768544394_contoh-akta.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen_pendaftaran`
--
ALTER TABLE `dokumen_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dokumen_pendaftaran` (`pendaftaran_id`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dokumen_pendaftaran`
--
ALTER TABLE `dokumen_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dokumen_pendaftaran`
--
ALTER TABLE `dokumen_pendaftaran`
  ADD CONSTRAINT `fk_dokumen_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
