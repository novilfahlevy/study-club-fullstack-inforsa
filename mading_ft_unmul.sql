-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create admin table with constraints
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert admin data
INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'inforsa', 'infors4');

-- Create pengumuman table with constraints
CREATE TABLE `pengumuman` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `slug` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `deskripsi` text NOT NULL,
  `belum_dibaca` tinyint(1) NOT NULL DEFAULT '1',
  `kategori` enum('akademik','organisasi','event','umum') CHARACTER SET utf8mb4 COLLATE=utf8mb4_0900_ai_ci NOT NULL DEFAULT 'umum',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert pengumuman data
INSERT INTO `pengumuman` (`id`, `judul`, `slug`, `tanggal`, `deskripsi`, `belum_dibaca`, `kategori`) VALUES
(1, 'Pendaftaran Study Club Fullstack', 'pendaftaran-study-club-fullstack', '2026-03-05 00:00:00', 'Ayo bergabung dan tingkatkan kemampuan web development kalian bersama INFORSA!', 1, 'akademik'),
(2, 'Malam Keakraban', 'malam-keakraban', '2026-03-21 00:00:00', 'Jangan lewatkan kesempatan untuk bersenang-senang dan mempererat persaudaraan di Malam Keakraban INFORSA!', 0, 'akademik');

COMMIT;