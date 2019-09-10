-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10 Sep 2019 pada 06.45
-- Versi Server: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsrimi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_berita`
--

CREATE TABLE `tabel_berita` (
  `id` int(13) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `isi_berita` text NOT NULL,
  `kategori_berita` varchar(20) NOT NULL,
  `status_berita` enum('Diterbitkan','Draft') NOT NULL,
  `penulis_berita` varchar(30) NOT NULL,
  `gambar_berita` varchar(5000) NOT NULL,
  `tanggal_berita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_berita`
--

INSERT INTO `tabel_berita` (`id`, `judul_berita`, `isi_berita`, `kategori_berita`, `status_berita`, `penulis_berita`, `gambar_berita`, `tanggal_berita`) VALUES
(14, 'Accumsan aptent autem brevitas', '&lt;p&gt;Accumsan aptent autem brevitas defui erat iaceo nostrud os turpis. Abdo causa comis esse ideo magna nulla quibus usitas velit. Autem letalis neque nobis. Conventio premo tamen. Augue ex facilisi genitus ideo minim usitas voco vulputate. Ad eum nutus. Lucidus mauris nisl nobis quidne. Accumsan aliquam dolore ea mos vereor. Appellatio ex modo scisco velit zelus. Caecus luptatum os tation venio. Autem iaceo incassum iriure pertineo vel ymo. Abdo elit nibh nimis vel. Distineo dolus eros loquor nibh nutus qui quis refoveo veniam. Aliquam amet camur fere magna similis uxor. Decet euismod jumentum paulatim. Aliquip at esca jumentum macto magna nostrud quadrum tamen uxor. Antehabeo damnum dolore persto roto vulputate. Decet dolor eligo esca meus sino. Decet loquor metuo sudo. Huic immitto pala tamen tation ut valde. Eros exerci illum quibus rusticus saepius vel vero. Dignissim gilvus gravis nostrud nulla nutus quidem refoveo valetudo. Augue eum nibh oppeto ratis tincidunt ut vindico volutpat. Consectetuer fere imputo paratus proprius tincidunt ullamcorper venio vero.&lt;/p&gt;', 'Blog', 'Diterbitkan', 'root93', '177276.jpg', '2019-09-09'),
(16, 'Low Level Format', '&lt;p&gt;Accumsan aptent autem brevitas defui erat iaceo nostrud os turpis. Abdo causa comis esse ideo magna nulla quibus usitas velit. Autem letalis neque nobis. Conventio premo tamen. Augue ex facilisi genitus ideo minim usitas voco vulputate. Ad eum nutus. Lucidus mauris nisl nobis quidne. Accumsan aliquam dolore ea mos vereor. Appellatio ex modo scisco velit zelus. Caecus luptatum os tation venio. Autem iaceo incassum iriure pertineo vel ymo. Abdo elit nibh nimis vel. Distineo dolus eros loquor nibh nutus qui quis refoveo veniam. Aliquam amet camur fere magna similis uxor. Decet euismod jumentum paulatim. Aliquip at esca jumentum macto magna nostrud quadrum tamen uxor. Antehabeo damnum dolore persto roto vulputate. Decet dolor eligo esca meus sino. Decet loquor metuo sudo. Huic immitto pala tamen tation ut valde. Eros exerci illum quibus rusticus saepius vel vero. Dignissim gilvus gravis nostrud nulla nutus quidem refoveo valetudo. Augue eum nibh oppeto ratis tincidunt ut vindico volutpat. Consectetuer fere imputo paratus proprius tincidunt ullamcorper venio vero&lt;/p&gt;', 'Music', 'Diterbitkan', 'root93', '103832.jpg', '2019-09-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_kategori`
--

CREATE TABLE `tabel_kategori` (
  `id` int(13) NOT NULL,
  `kategori_berita` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_kategori`
--

INSERT INTO `tabel_kategori` (`id`, `kategori_berita`) VALUES
(6, 'Music'),
(7, 'Blog'),
(8, 'Bola');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_nav`
--

CREATE TABLE `tabel_nav` (
  `id` int(2) NOT NULL,
  `nama_menu` varchar(20) NOT NULL,
  `kategori_menu` enum('single_menu','dropdown_menu','sub_menu') NOT NULL,
  `link_menu` varchar(50) NOT NULL,
  `urut` int(4) NOT NULL,
  `parent` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_nav`
--

INSERT INTO `tabel_nav` (`id`, `nama_menu`, `kategori_menu`, `link_menu`, `urut`, `parent`) VALUES
(1, 'About', 'dropdown_menu', '', 1, 0),
(2, 'Profile', 'sub_menu', 'http://root93.co.id/read.php?id=2', 1, 1),
(3, 'Contact Us', 'sub_menu', '', 2, 1),
(4, 'Social Media', 'sub_menu', '', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(13) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`) VALUES
(1, 'root93', '$2y$10$TuK74QTWo.JSy9izZtGV/.bDo.HToXbzSYiT6/m0MELSuQPE.EGyC', 'Ahmad Zaelani', 'myroot593@gmail.com'),
(2, 'Ahmad Zaelani', '$2y$10$PGhlTTpErHLpgJQaHggo/u.WOgv3ZuDvGyW8Ke13iCnPXuEqgRGVe', 'Ahmad Zaelani', 'myroot593@gmail.com'),
(3, 'root93.co.id', '$2y$10$bb6quK2gRcyR/IRNNq3sj.GYL6BJH6zSi7Jfm9bb/Z/.SLcRX8VCe', 'Admin', 'admin@yahoo.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_berita`
--
ALTER TABLE `tabel_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_nav`
--
ALTER TABLE `tabel_nav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_berita`
--
ALTER TABLE `tabel_berita`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tabel_nav`
--
ALTER TABLE `tabel_nav`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
