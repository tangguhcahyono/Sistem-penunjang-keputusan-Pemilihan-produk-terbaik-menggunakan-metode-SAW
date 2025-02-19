-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 02:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password_asli` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `password_asli`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin'),
(2, 'ilham', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(10) NOT NULL,
  `kriteria` varchar(100) NOT NULL,
  `bobot` float(10,2) NOT NULL,
  `Jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`, `Jenis`) VALUES
(1, 'Harga Produk', 0.30, 'cost'),
(2, 'Kebutuhan Santri', 0.40, 'benefit'),
(3, 'Tingkat Penjualan', 0.30, 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `n_produk`
--

CREATE TABLE `n_produk` (
  `id` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `h_jual` int(10) NOT NULL,
  `k_santri` int(10) NOT NULL,
  `t_penjualan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `n_produk`
--

INSERT INTO `n_produk` (`id`, `id_produk`, `bulan`, `h_jual`, `k_santri`, `t_penjualan`) VALUES
(314, 1, 'juli 24', 2000, 87, 24),
(315, 2, 'juli 24', 22000, 17, 1),
(316, 3, 'juli 24', 22000, 15, 1),
(317, 4, 'juli 24', 22000, 21, 4),
(318, 5, 'juli 24', 22000, 15, 1),
(319, 6, 'juli 24', 45000, 55, 1),
(320, 7, 'juli 24', 45000, 56, 1),
(321, 8, 'juli 24', 250, 731, 262),
(322, 9, 'juli 24', 100, 209, 41),
(323, 10, 'juli 24', 200, 705, 305),
(324, 11, 'juli 24', 6000, 225, 1),
(325, 12, 'juli 24', 8000, 29, 40),
(326, 13, 'juli 24', 30000, 74, 38),
(327, 14, 'juli 24', 18000, 17, 2),
(328, 15, 'juli 24', 2000, 82, 18),
(329, 16, 'juli 24', 3000, 42, 6),
(330, 17, 'juli 24', 2000, 34, 25),
(331, 18, 'juli 24', 2000, 594, 161),
(332, 19, 'juli 24', 2000, 298, 166),
(333, 20, 'juli 24', 8000, 144, 88),
(334, 21, 'juli 24', 3000, 49, 1),
(335, 22, 'juli 24', 2000, 10, 2),
(336, 23, 'juli 24', 3000, 128, 1),
(337, 24, 'juli 24', 1000, 2542, 154),
(338, 25, 'juli 24', 3000, 214, 25),
(339, 26, 'juli 24', 3500, 10, 39),
(340, 27, 'juli 24', 45000, 92, 54),
(341, 28, 'juli 24', 2000, 27, 6),
(342, 29, 'juli 24', 2000, 291, 87),
(343, 30, 'juli 24', 2000, 224, 67),
(344, 31, 'juli 24', 2000, 17, 2),
(345, 32, 'juli 24', 2000, 7, 1),
(346, 33, 'juli 24', 2000, 9, 1),
(347, 34, 'juli 24', 2000, 137, 200),
(348, 35, 'juli 24', 3000, 26, 4),
(349, 36, 'juli 24', 3000, 26, 10),
(350, 37, 'juli 24', 3000, 60, 5),
(351, 38, 'juli 24', 3000, 234, 80),
(352, 39, 'juli 24', 3000, 163, 73),
(353, 40, 'juli 24', 2000, 16, 1),
(354, 41, 'juli 24', 2000, 76, 1),
(355, 42, 'juli 24', 2000, 889, 598),
(356, 43, 'juli 24', 2000, 838, 322),
(357, 44, 'juli 24', 3000, 832, 266),
(358, 45, 'juli 24', 3000, 345, 48),
(359, 46, 'juli 24', 3000, 131, 33),
(360, 47, 'juli 24', 3000, 16, 7),
(361, 48, 'juli 24', 3000, 68, 34),
(362, 49, 'juli 24', 3000, 42, 47),
(363, 50, 'juli 24', 4000, 22, 5),
(364, 51, 'juli 24', 4000, 425, 387),
(365, 52, 'juli 24', 2000, 30, 11),
(366, 53, 'juli 24', 2000, 134, 74),
(367, 54, 'juli 24', 2000, 143, 48),
(368, 55, 'juli 24', 4000, 82, 78),
(369, 56, 'juli 24', 5000, 66, 1),
(370, 57, 'juli 24', 1000, 2509, 12),
(371, 58, 'juli 24', 1000, 2883, 1),
(372, 59, 'juli 24', 2000, 57, 1),
(373, 60, 'juli 24', 10000, 112, 85),
(374, 61, 'juli 24', 5000, 49, 1),
(375, 62, 'juli 24', 2000, 67, 5),
(376, 63, 'juli 24', 2000, 283, 114),
(377, 64, 'juli 24', 2000, 159, 78),
(378, 65, 'juli 24', 6000, 79, 14),
(379, 66, 'juli 24', 17000, 84, 24),
(380, 67, 'juli 24', 33000, 9, 11),
(381, 68, 'juli 24', 4500, 24, 1),
(382, 69, 'juli 24', 3000, 16, 1),
(383, 70, 'juli 24', 21000, 1200, 2),
(384, 71, 'juli 24', 6000, 134, 1),
(385, 72, 'juli 24', 13000, 71, 36),
(386, 73, 'juli 24', 4000, 127, 13),
(387, 74, 'juli 24', 3000, 9156, 1),
(388, 75, 'juli 24', 3000, 294, 1),
(389, 76, 'juli 24', 3000, 8056, 139),
(390, 77, 'juli 24', 3000, 186, 96),
(391, 78, 'juli 24', 17000, 20, 4),
(392, 79, 'juli 24', 14000, 29, 1),
(393, 80, 'juli 24', 14000, 22, 2),
(394, 81, 'juli 24', 4000, 71, 16),
(395, 82, 'juli 24', 6000, 26, 1),
(396, 83, 'juli 24', 12500, 22, 22),
(397, 84, 'juli 24', 6000, 77, 31),
(398, 85, 'juli 24', 5000, 113, 14),
(399, 86, 'juli 24', 15000, 73, 71),
(400, 87, 'juli 24', 20000, 8, 1),
(401, 88, 'juli 24', 2500, 65, 22),
(402, 89, 'juli 24', 5000, 36, 12),
(403, 90, 'juli 24', 11000, 27, 7),
(404, 91, 'juli 24', 9000, 35, 2),
(405, 92, 'juli 24', 9000, 20, 20),
(406, 93, 'juli 24', 9000, 18, 4),
(407, 94, 'juli 24', 9000, 13, 20),
(408, 95, 'juli 24', 8500, 25, 1),
(409, 96, 'juli 24', 8500, 6, 3),
(410, 97, 'juli 24', 8500, 16, 13),
(411, 98, 'juli 24', 8500, 16, 1),
(412, 99, 'juli 24', 4000, 1528, 346),
(413, 100, 'juli 24', 14000, 30, 41),
(414, 101, 'juli 24', 6000, 130, 33),
(415, 102, 'juli 24', 5000, 562, 9),
(416, 103, 'juli 24', 2500, 99, 73),
(417, 104, 'juli 24', 5000, 36, 12),
(418, 105, 'juli 24', 9000, 37, 1),
(419, 106, 'juli 24', 8000, 28, 1),
(420, 107, 'juli 24', 35000, 3, 1),
(421, 108, 'juli 24', 6000, 87, 34),
(422, 109, 'juli 24', 8000, 54, 5),
(423, 110, 'juli 24', 11000, 33, 7),
(424, 111, 'juli 24', 10000, 12, 2),
(425, 112, 'juli 24', 2000, 183, 1),
(426, 113, 'juli 24', 2000, 96, 1),
(427, 114, 'juli 24', 5000, 50, 4),
(428, 115, 'juli 24', 6000, 33, 29),
(429, 116, 'juli 24', 5000, 20, 1),
(430, 117, 'juli 24', 5000, 59, 1),
(431, 118, 'juli 24', 2000, 47, 26),
(432, 119, 'juli 24', 2000, 16, 1),
(433, 120, 'juli 24', 6000, 12, 1),
(434, 121, 'juli 24', 6000, 2242, 1),
(435, 122, 'juli 24', 8500, 130, 48),
(436, 123, 'juli 24', 3500, 42, 5),
(437, 124, 'juli 24', 3000, 16, 1),
(438, 125, 'juli 24', 6000, 33, 2),
(439, 126, 'juli 24', 9000, 14, 1),
(440, 127, 'juli 24', 6000, 54, 43),
(441, 128, 'juli 24', 8000, 37, 25),
(442, 129, 'juli 24', 10000, 73, 46),
(443, 130, 'juli 24', 5000, 43, 34),
(444, 131, 'juli 24', 400, 1685, 227),
(445, 132, 'juli 24', 45000, 25, 19),
(446, 133, 'juli 24', 50000, 51, 51),
(447, 134, 'juli 24', 1500, 172, 16),
(448, 135, 'juli 24', 1500, 443, 13),
(449, 136, 'juli 24', 700, 472, 50),
(450, 137, 'juli 24', 7000, 175, 13),
(451, 138, 'juli 24', 11000, 56, 29),
(452, 139, 'juli 24', 18000, 76, 37),
(453, 140, 'juli 24', 5000, 33, 55),
(454, 141, 'juli 24', 8000, 36, 24),
(455, 142, 'juli 24', 11000, 192, 26),
(456, 143, 'juli 24', 15000, 160, 58),
(457, 144, 'juli 24', 6000, 89, 9),
(458, 145, 'juli 24', 10500, 34, 3),
(459, 146, 'juli 24', 5500, 63, 8),
(460, 147, 'juli 24', 7000, 62, 9),
(461, 148, 'juli 24', 1500, 33, 6),
(462, 149, 'juli 24', 3000, 11, 4),
(463, 150, 'juli 24', 11000, 58, 4),
(464, 151, 'juli 24', 11000, 39, 10),
(465, 152, 'juli 24', 8000, 55, 9),
(466, 153, 'juli 24', 7000, 31, 16),
(467, 154, 'juli 24', 7000, 47, 1),
(468, 155, 'juli 24', 4000, 32, 7),
(469, 156, 'juli 24', 4000, 23, 1),
(470, 157, 'juli 24', 3000, 209, 183),
(471, 158, 'juli 24', 3000, 24, 1),
(472, 159, 'juli 24', 3000, 11, 1),
(473, 160, 'juli 24', 6500, 328, 13),
(474, 161, 'juli 24', 6500, 24, 27),
(475, 162, 'juli 24', 5500, 68, 19),
(476, 163, 'juli 24', 11000, 86, 41),
(477, 164, 'juli 24', 2000, 1842, 639),
(478, 165, 'juli 24', 4000, 9, 2),
(479, 166, 'juli 24', 11000, 14, 1),
(480, 167, 'juli 24', 5000, 34, 1),
(481, 168, 'juli 24', 11000, 150, 9),
(482, 169, 'juli 24', 10000, 24, 1),
(483, 170, 'juli 24', 20000, 23, 1),
(484, 171, 'juli 24', 14000, 30, 2),
(485, 172, 'juli 24', 2000, 105, 26),
(486, 173, 'juli 24', 3000, 138, 35),
(487, 174, 'juli 24', 12000, 14, 1),
(488, 175, 'juli 24', 3000, 111, 5),
(489, 176, 'juli 24', 3000, 7, 1),
(490, 177, 'juli 24', 2000, 74, 1),
(491, 178, 'juli 24', 1000, 132, 130),
(492, 179, 'juli 24', 12500, 96, 62),
(493, 180, 'juli 24', 2000, 76, 1),
(494, 181, 'juli 24', 1000, 62, 65),
(495, 182, 'juli 24', 1000, 161, 1),
(496, 183, 'juli 24', 8000, 275, 51),
(497, 184, 'juli 24', 4000, 26, 1),
(498, 185, 'juli 24', 17000, 14, 7),
(499, 186, 'juli 24', 10000, 68, 20),
(500, 187, 'juli 24', 43000, 40, 1),
(501, 188, 'juli 24', 24000, 58, 1),
(502, 189, 'juli 24', 32000, 45, 1),
(503, 190, 'juli 24', 10000, 96, 109),
(504, 191, 'juli 24', 10000, 67, 1),
(505, 192, 'juli 24', 15000, 69, 119),
(506, 193, 'juli 24', 9000, 11, 11),
(507, 194, 'juli 24', 3500, 8, 7),
(508, 195, 'juli 24', 5000, 131, 35),
(509, 196, 'juli 24', 3500, 13, 1),
(510, 197, 'juli 24', 8000, 38, 8),
(511, 198, 'juli 24', 8000, 250, 157),
(512, 199, 'juli 24', 8000, 10, 1),
(513, 200, 'juli 24', 14000, 13, 5),
(514, 201, 'juli 24', 14000, 12, 1),
(515, 202, 'juli 24', 7000, 172, 22),
(516, 203, 'juli 24', 14000, 13, 3),
(517, 204, 'juli 24', 14000, 11, 2),
(518, 205, 'juli 24', 14000, 75, 1),
(519, 206, 'juli 24', 14000, 67, 41),
(520, 207, 'juli 24', 20000, 21, 1),
(521, 208, 'juli 24', 12000, 11, 1),
(522, 209, 'juli 24', 7000, 2, 1),
(523, 210, 'juli 24', 6000, 49, 2),
(524, 211, 'juli 24', 40000, 11, 1),
(525, 212, 'juli 24', 20000, 8, 1),
(526, 213, 'juli 24', 9000, 30, 10),
(527, 214, 'juli 24', 5500, 16, 1),
(528, 215, 'juli 24', 9000, 34, 1),
(529, 216, 'juli 24', 4000, 37, 1),
(530, 217, 'juli 24', 10000, 17, 1),
(531, 218, 'juli 24', 6000, 18, 1),
(532, 219, 'juli 24', 9500, 43, 1),
(533, 220, 'juli 24', 6000, 29, 1),
(534, 221, 'juli 24', 16000, 67, 12),
(535, 222, 'juli 24', 2500, 24, 1),
(536, 223, 'juli 24', 10000, 151, 3),
(547, 224, 'September 2024', 8000, 50, 15);

-- --------------------------------------------------------

--
-- Table structure for table `perangkingan`
--

CREATE TABLE `perangkingan` (
  `id_perangkingan` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `n_harga_jual` float(5,5) NOT NULL,
  `n_k_santri` float(5,5) NOT NULL,
  `n_t_penjualan` float(5,5) NOT NULL,
  `preferensi` float(5,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perangkingan`
--

INSERT INTO `perangkingan` (`id_perangkingan`, `id`, `n_harga_jual`, `n_k_santri`, `n_t_penjualan`, `preferensi`) VALUES
(1, 314, 0.05000, 0.00950, 0.03756, 0.03007),
(2, 315, 0.00455, 0.00186, 0.00156, 0.00258),
(3, 316, 0.00455, 0.00164, 0.00156, 0.00249),
(4, 317, 0.00455, 0.00229, 0.00626, 0.00416),
(5, 318, 0.00455, 0.00164, 0.00156, 0.00249),
(6, 319, 0.00222, 0.00601, 0.00156, 0.00354),
(7, 320, 0.00222, 0.00612, 0.00156, 0.00358),
(8, 321, 0.40000, 0.07984, 0.41002, 0.27494),
(9, 322, 0.99999, 0.02283, 0.06416, 0.32838),
(10, 323, 0.50000, 0.07700, 0.47731, 0.32399),
(11, 324, 0.01667, 0.02457, 0.00156, 0.01530),
(12, 325, 0.01250, 0.00317, 0.06260, 0.02380),
(13, 326, 0.00333, 0.00808, 0.05947, 0.02207),
(14, 327, 0.00556, 0.00186, 0.00313, 0.00335),
(15, 328, 0.05000, 0.00896, 0.02817, 0.02703),
(16, 329, 0.03333, 0.00459, 0.00939, 0.01465),
(17, 330, 0.05000, 0.00371, 0.03912, 0.02822),
(18, 331, 0.05000, 0.06488, 0.25196, 0.11654),
(19, 332, 0.05000, 0.03255, 0.25978, 0.10595),
(20, 333, 0.01250, 0.01573, 0.13772, 0.05136),
(21, 334, 0.03333, 0.00535, 0.00156, 0.01261),
(22, 335, 0.05000, 0.00109, 0.00313, 0.01638),
(23, 336, 0.03333, 0.01398, 0.00156, 0.01606),
(24, 337, 0.10000, 0.27763, 0.24100, 0.21335),
(25, 338, 0.03333, 0.02337, 0.03912, 0.03109),
(26, 339, 0.02857, 0.00109, 0.06103, 0.02732),
(27, 340, 0.00222, 0.01005, 0.08451, 0.03004),
(28, 341, 0.05000, 0.00295, 0.00939, 0.01900),
(29, 342, 0.05000, 0.03178, 0.13615, 0.06856),
(30, 343, 0.05000, 0.02446, 0.10485, 0.05624),
(31, 344, 0.05000, 0.00186, 0.00313, 0.01668),
(32, 345, 0.05000, 0.00076, 0.00156, 0.01578),
(33, 346, 0.05000, 0.00098, 0.00156, 0.01586),
(34, 347, 0.05000, 0.01496, 0.31299, 0.11488),
(35, 348, 0.03333, 0.00284, 0.00626, 0.01301),
(36, 349, 0.03333, 0.00284, 0.01565, 0.01583),
(37, 350, 0.03333, 0.00655, 0.00782, 0.01497),
(38, 351, 0.03333, 0.02556, 0.12520, 0.05778),
(39, 352, 0.03333, 0.01780, 0.11424, 0.05139),
(40, 353, 0.05000, 0.00175, 0.00156, 0.01617),
(41, 354, 0.05000, 0.00830, 0.00156, 0.01879),
(42, 355, 0.05000, 0.09709, 0.93584, 0.33459),
(43, 356, 0.05000, 0.09152, 0.50391, 0.20278),
(44, 357, 0.03333, 0.09087, 0.41628, 0.17123),
(45, 358, 0.03333, 0.03768, 0.07512, 0.04761),
(46, 359, 0.03333, 0.01431, 0.05164, 0.03122),
(47, 360, 0.03333, 0.00175, 0.01095, 0.01399),
(48, 361, 0.03333, 0.00743, 0.05321, 0.02893),
(49, 362, 0.03333, 0.00459, 0.07355, 0.03390),
(50, 363, 0.02500, 0.00240, 0.00782, 0.01081),
(51, 364, 0.02500, 0.04642, 0.60563, 0.20776),
(52, 365, 0.05000, 0.00328, 0.01721, 0.02147),
(53, 366, 0.05000, 0.01464, 0.11581, 0.05560),
(54, 367, 0.05000, 0.01562, 0.07512, 0.04378),
(55, 368, 0.02500, 0.00896, 0.12207, 0.04770),
(56, 369, 0.02000, 0.00721, 0.00156, 0.00935),
(57, 370, 0.10000, 0.27403, 0.01878, 0.14524),
(58, 371, 0.10000, 0.31488, 0.00156, 0.15642),
(59, 372, 0.05000, 0.00623, 0.00156, 0.01796),
(60, 373, 0.01000, 0.01223, 0.13302, 0.04780),
(61, 374, 0.02000, 0.00535, 0.00156, 0.00861),
(62, 375, 0.05000, 0.00732, 0.00782, 0.02027),
(63, 376, 0.05000, 0.03091, 0.17840, 0.08088),
(64, 377, 0.05000, 0.01737, 0.12207, 0.05857),
(65, 378, 0.01667, 0.00863, 0.02191, 0.01502),
(66, 379, 0.00588, 0.00917, 0.03756, 0.01670),
(67, 380, 0.00303, 0.00098, 0.01721, 0.00647),
(68, 381, 0.02222, 0.00262, 0.00156, 0.00818),
(69, 382, 0.03333, 0.00175, 0.00156, 0.01117),
(70, 383, 0.00476, 0.13106, 0.00313, 0.05479),
(71, 384, 0.01667, 0.01464, 0.00156, 0.01132),
(72, 385, 0.00769, 0.00775, 0.05634, 0.02231),
(73, 386, 0.02500, 0.01387, 0.02034, 0.01915),
(74, 387, 0.03333, 0.99999, 0.00156, 0.41047),
(75, 388, 0.03333, 0.03211, 0.00156, 0.02331),
(76, 389, 0.03333, 0.87986, 0.21753, 0.42720),
(77, 390, 0.03333, 0.02031, 0.15023, 0.06320),
(78, 391, 0.00588, 0.00218, 0.00626, 0.00452),
(79, 392, 0.00714, 0.00317, 0.00156, 0.00388),
(80, 393, 0.00714, 0.00240, 0.00313, 0.00404),
(81, 394, 0.02500, 0.00775, 0.02504, 0.01811),
(82, 395, 0.01667, 0.00284, 0.00156, 0.00661),
(83, 396, 0.00800, 0.00240, 0.03443, 0.01369),
(84, 397, 0.01667, 0.00841, 0.04851, 0.02292),
(85, 398, 0.02000, 0.01234, 0.02191, 0.01751),
(86, 399, 0.00667, 0.00797, 0.11111, 0.03852),
(87, 400, 0.00500, 0.00087, 0.00156, 0.00232),
(88, 401, 0.04000, 0.00710, 0.03443, 0.02517),
(89, 402, 0.02000, 0.00393, 0.01878, 0.01321),
(90, 403, 0.00909, 0.00295, 0.01095, 0.00719),
(91, 404, 0.01111, 0.00382, 0.00313, 0.00580),
(92, 405, 0.01111, 0.00218, 0.03130, 0.01360),
(93, 406, 0.01111, 0.00197, 0.00626, 0.00600),
(94, 407, 0.01111, 0.00142, 0.03130, 0.01329),
(95, 408, 0.01176, 0.00273, 0.00156, 0.00509),
(96, 409, 0.01176, 0.00066, 0.00469, 0.00520),
(97, 410, 0.01176, 0.00175, 0.02034, 0.01033),
(98, 411, 0.01176, 0.00175, 0.00156, 0.00470),
(99, 412, 0.02500, 0.16689, 0.54147, 0.23670),
(100, 413, 0.00714, 0.00328, 0.06416, 0.02270),
(101, 414, 0.01667, 0.01420, 0.05164, 0.02617),
(102, 415, 0.02000, 0.06138, 0.01408, 0.03478),
(103, 416, 0.04000, 0.01081, 0.11424, 0.05060),
(104, 417, 0.02000, 0.00393, 0.01878, 0.01321),
(105, 418, 0.01111, 0.00404, 0.00156, 0.00542),
(106, 419, 0.01250, 0.00306, 0.00156, 0.00544),
(107, 420, 0.00286, 0.00033, 0.00156, 0.00146),
(108, 421, 0.01667, 0.00950, 0.05321, 0.02476),
(109, 422, 0.01250, 0.00590, 0.00782, 0.00846),
(110, 423, 0.00909, 0.00360, 0.01095, 0.00746),
(111, 424, 0.01000, 0.00131, 0.00313, 0.00446),
(112, 425, 0.05000, 0.01999, 0.00156, 0.02346),
(113, 426, 0.05000, 0.01048, 0.00156, 0.01966),
(114, 427, 0.02000, 0.00546, 0.00626, 0.01006),
(115, 428, 0.01667, 0.00360, 0.04538, 0.02006),
(116, 429, 0.02000, 0.00218, 0.00156, 0.00734),
(117, 430, 0.02000, 0.00644, 0.00156, 0.00905),
(118, 431, 0.05000, 0.00513, 0.04069, 0.02926),
(119, 432, 0.05000, 0.00175, 0.00156, 0.01617),
(120, 433, 0.01667, 0.00131, 0.00156, 0.00599),
(121, 434, 0.01667, 0.24487, 0.00156, 0.10342),
(122, 435, 0.01176, 0.01420, 0.07512, 0.03174),
(123, 436, 0.02857, 0.00459, 0.00782, 0.01275),
(124, 437, 0.03333, 0.00175, 0.00156, 0.01117),
(125, 438, 0.01667, 0.00360, 0.00313, 0.00738),
(126, 439, 0.01111, 0.00153, 0.00156, 0.00441),
(127, 440, 0.01667, 0.00590, 0.06729, 0.02755),
(128, 441, 0.01250, 0.00404, 0.03912, 0.01710),
(129, 442, 0.01000, 0.00797, 0.07199, 0.02779),
(130, 443, 0.02000, 0.00470, 0.05321, 0.02384),
(131, 444, 0.25000, 0.18403, 0.35524, 0.25519),
(132, 445, 0.00222, 0.00273, 0.02973, 0.01068),
(133, 446, 0.00200, 0.00557, 0.07981, 0.02677),
(134, 447, 0.06667, 0.01879, 0.02504, 0.03503),
(135, 448, 0.06667, 0.04838, 0.02034, 0.04546),
(136, 449, 0.14286, 0.05155, 0.07825, 0.08695),
(137, 450, 0.01429, 0.01911, 0.02034, 0.01803),
(138, 451, 0.00909, 0.00612, 0.04538, 0.01879),
(139, 452, 0.00556, 0.00830, 0.05790, 0.02236),
(140, 453, 0.02000, 0.00360, 0.08607, 0.03326),
(141, 454, 0.01250, 0.00393, 0.03756, 0.01659),
(142, 455, 0.00909, 0.02097, 0.04069, 0.02332),
(143, 456, 0.00667, 0.01747, 0.09077, 0.03622),
(144, 457, 0.01667, 0.00972, 0.01408, 0.01311),
(145, 458, 0.00952, 0.00371, 0.00469, 0.00575),
(146, 459, 0.01818, 0.00688, 0.01252, 0.01196),
(147, 460, 0.01429, 0.00677, 0.01408, 0.01122),
(148, 461, 0.06667, 0.00360, 0.00939, 0.02426),
(149, 462, 0.03333, 0.00120, 0.00626, 0.01236),
(150, 463, 0.00909, 0.00633, 0.00626, 0.00714),
(151, 464, 0.00909, 0.00426, 0.01565, 0.00913),
(152, 465, 0.01250, 0.00601, 0.01408, 0.01038),
(153, 466, 0.01429, 0.00339, 0.02504, 0.01315),
(154, 467, 0.01429, 0.00513, 0.00156, 0.00681),
(155, 468, 0.02500, 0.00349, 0.01095, 0.01218),
(156, 469, 0.02500, 0.00251, 0.00156, 0.00897),
(157, 470, 0.03333, 0.02283, 0.28638, 0.10505),
(158, 471, 0.03333, 0.00262, 0.00156, 0.01152),
(159, 472, 0.03333, 0.00120, 0.00156, 0.01095),
(160, 473, 0.01538, 0.03582, 0.02034, 0.02505),
(161, 474, 0.01538, 0.00262, 0.04225, 0.01834),
(162, 475, 0.01818, 0.00743, 0.02973, 0.01735),
(163, 476, 0.00909, 0.00939, 0.06416, 0.02573),
(164, 477, 0.05000, 0.20118, 0.99999, 0.39547),
(165, 478, 0.02500, 0.00098, 0.00313, 0.00883),
(166, 479, 0.00909, 0.00153, 0.00156, 0.00381),
(167, 480, 0.02000, 0.00371, 0.00156, 0.00795),
(168, 481, 0.00909, 0.01638, 0.01408, 0.01351),
(169, 482, 0.01000, 0.00262, 0.00156, 0.00452),
(170, 483, 0.00500, 0.00251, 0.00156, 0.00297),
(171, 484, 0.00714, 0.00328, 0.00313, 0.00439),
(172, 485, 0.05000, 0.01147, 0.04069, 0.03179),
(173, 486, 0.03333, 0.01507, 0.05477, 0.03246),
(174, 487, 0.00833, 0.00153, 0.00156, 0.00358),
(175, 488, 0.03333, 0.01212, 0.00782, 0.01720),
(176, 489, 0.03333, 0.00076, 0.00156, 0.01078),
(177, 490, 0.05000, 0.00808, 0.00156, 0.01870),
(178, 491, 0.10000, 0.01442, 0.20344, 0.09680),
(179, 492, 0.00800, 0.01048, 0.09703, 0.03570),
(180, 493, 0.05000, 0.00830, 0.00156, 0.01879),
(181, 494, 0.10000, 0.00677, 0.10172, 0.06323),
(182, 495, 0.10000, 0.01758, 0.00156, 0.03750),
(183, 496, 0.01250, 0.03003, 0.07981, 0.03971),
(184, 497, 0.02500, 0.00284, 0.00156, 0.00911),
(185, 498, 0.00588, 0.00153, 0.01095, 0.00566),
(186, 499, 0.01000, 0.00743, 0.03130, 0.01536),
(187, 500, 0.00233, 0.00437, 0.00156, 0.00291),
(188, 501, 0.00417, 0.00633, 0.00156, 0.00425),
(189, 502, 0.00312, 0.00491, 0.00156, 0.00337),
(190, 503, 0.01000, 0.01048, 0.17058, 0.05837),
(191, 504, 0.01000, 0.00732, 0.00156, 0.00640),
(192, 505, 0.00667, 0.00754, 0.18623, 0.06088),
(193, 506, 0.01111, 0.00120, 0.01721, 0.00898),
(194, 507, 0.02857, 0.00087, 0.01095, 0.01221),
(195, 508, 0.02000, 0.01431, 0.05477, 0.02815),
(196, 509, 0.02857, 0.00142, 0.00156, 0.00961),
(197, 510, 0.01250, 0.00415, 0.01252, 0.00917),
(198, 511, 0.01250, 0.02730, 0.24570, 0.08838),
(199, 512, 0.01250, 0.00109, 0.00156, 0.00466),
(200, 513, 0.00714, 0.00142, 0.00782, 0.00506),
(201, 514, 0.00714, 0.00131, 0.00156, 0.00314),
(202, 515, 0.01429, 0.01879, 0.03443, 0.02213),
(203, 516, 0.00714, 0.00142, 0.00469, 0.00412),
(204, 517, 0.00714, 0.00120, 0.00313, 0.00356),
(205, 518, 0.00714, 0.00819, 0.00156, 0.00589),
(206, 519, 0.00714, 0.00732, 0.06416, 0.02432),
(207, 520, 0.00500, 0.00229, 0.00156, 0.00289),
(208, 521, 0.00833, 0.00120, 0.00156, 0.00345),
(209, 522, 0.01429, 0.00022, 0.00156, 0.00484),
(210, 523, 0.01667, 0.00535, 0.00313, 0.00808),
(211, 524, 0.00250, 0.00120, 0.00156, 0.00170),
(212, 525, 0.00500, 0.00087, 0.00156, 0.00232),
(213, 526, 0.01111, 0.00328, 0.01565, 0.00934),
(214, 527, 0.01818, 0.00175, 0.00156, 0.00662),
(215, 528, 0.01111, 0.00371, 0.00156, 0.00529),
(216, 529, 0.02500, 0.00404, 0.00156, 0.00959),
(217, 530, 0.01000, 0.00186, 0.00156, 0.00421),
(218, 531, 0.01667, 0.00197, 0.00156, 0.00626),
(219, 532, 0.01053, 0.00470, 0.00156, 0.00551),
(220, 533, 0.01667, 0.00317, 0.00156, 0.00674),
(221, 534, 0.00625, 0.00732, 0.01878, 0.01044),
(222, 535, 0.04000, 0.00262, 0.00156, 0.01352),
(223, 536, 0.01000, 0.01649, 0.00469, 0.01101);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar`) VALUES
(1, 'BP MONSTAR HITAM ', '1.jfif'),
(2, 'AGENDA ELEGANT BP-703', '2.PNG'),
(3, 'AGENDA EXCELLENT BP-701', '3.jfif'),
(4, 'AGENDA EXCLUSIVE BP-704', '4.jpg'),
(5, 'AGENDA EXECUTIVE BP-702', '5.png'),
(6, 'AL QURAN CUSTOM A5 (BESAR)', '6.png'),
(7, 'AL QURAN CUSTOM A6 (KECIL)', '7.png'),
(8, 'AMPLOP BESAR', '8.jpg'),
(9, 'AMPLOP KECIL', '9.jpg'),
(10, 'AMPLOP SEDANG', '10.jfif'),
(11, 'BINDER CLIPS 200 BIG / PCS', '11.jpg'),
(12, 'BINDER CLIPS 260 BIG / PCS', '12.jpg'),
(13, 'BINDER LOOSE BOOK A5 WENGU', '13.jfif'),
(14, 'BINDER NOTE BN-101', '14.jfif'),
(15, 'BP ARTLINE SG2 MERAH 0.7', '15.jpg'),
(16, 'BP ARTLINE SG8 BIRU 0.5', '16.jpg'),
(17, 'BP GREEBEL BIRU', '17.jfif'),
(18, 'BP GREEBEL HITAM', '18.jpg'),
(19, 'BP GREEBEL MERAH', '19.jfif'),
(20, 'BP JOYKO 6WARNA BP-236', '20.jpg'),
(21, 'BP JOYKO SAVANNA 4 BP-232', '21.jfif'),
(22, 'BP KENKO EASY FLOW 62', '22.png'),
(23, 'BP KENKO KE-303 T-GEL', '23.jfif'),
(24, 'BP KIKY SLIM HITAM', '24.jfif'),
(25, 'BP METAL DB-560 0.5MM DEBOZZ', '25.jfif'),
(26, 'BP PILOT BIRU', '26.png'),
(27, 'BP PILOT MERAH', '27.jpg'),
(28, 'BP SNOWMAN BP7 BIRU', '28.jpg'),
(29, 'BP SNOWMAN BP7 HITAM', '29.jpg'),
(30, 'BP SNOWMAN BP7 MERAH', '30.jpg'),
(31, 'BP SNOWMAN S1 BIRU', '31.jpg'),
(32, 'BP SNOWMAN V1 BIRU', '32.jpg'),
(33, 'BP SNOWMAN V2 BIRU', '33.jpg'),
(34, 'BP SNOWMAN V2 HITAM', '34.jfif'),
(35, 'BP SNOWMAN V3 BIRU', '35.jpg'),
(36, 'BP SNOWMAN V3 MERAH', '36.jpg'),
(37, 'BP SNOWMAN V5 BIRU', '37.png'),
(38, 'BP SNOWMAN V5 HITAM', '38.jpg'),
(39, 'BP SNOWMAN V5 MERAH', '39.jpg'),
(40, 'BP SNOWMAN V6 BIRU', '40.jpg'),
(41, 'BP SNOWMAN V7 HITAM', '41.jfif'),
(42, 'BP STANDARD AE7 HITAM', '42.jfif'),
(43, 'BP STANDARD AE7 MERAH', '43.jpg'),
(44, 'BP STANDARD BLIVE 0.3 HITAM', '44.jpg'),
(45, 'BP STANDARD BLIVE NOX 0.3 HITAM', '45.jpg'),
(46, 'BP STANDARD GSOFT OIL GEL HITAM', '46.jfif'),
(47, 'BP STANDARD R3 HITAM', '47.jpg'),
(48, 'BP STANDARD TECNOGEL HTM/BR/MRH', '48.jpg'),
(49, 'BP TECHJOB TM TZ501 GEL PEN', '49.jfif'),
(50, 'BP TIZO BIRU BLUE 1.0 mm', '50.jfif'),
(51, 'BP TIZO HITAM 1.0 mm', '51.jfif'),
(52, 'BP TRENDEE BIRU', '52.jfif'),
(53, 'BP TRENDEE HITAM', '53.jpg'),
(54, 'BP TRENDEE MERAH', '54.jpg'),
(55, 'BP WEIYADA 3WARNA BP-993', '55.jfif'),
(56, 'BP WEIYADA 4WARNA BP-994', '56.jfif'),
(57, 'BP X-DATA M1 HITAM', '57.jfif'),
(58, 'BP X-DATA M2 HITAM', '58.jpg'),
(59, 'BP X-DATA ROCKET 0.7 HITAM', '59.jfif'),
(60, 'BP ZEBRA A4C 4WARNA', '60.jfif'),
(61, 'BP ZEBRA KOKORO GEL HITAM', '61.jfif'),
(62, 'BP ZEBRA PICCOLO BIRU', '62.jfif'),
(63, 'BP ZEBRA PICCOLO HITAM', '63.jfif'),
(64, 'BP ZEBRA PICCOLO MERAH', '64.jpg'),
(65, 'BP ZEBRA PRESTIGE FINELINER 0.8 HITAM', '65.jfif'),
(66, 'BUKU FOLIO 100 GELATIK', '66.jpg'),
(67, 'BUKU FOLIO 200 GELATIK', '67.jpg'),
(68, 'BUKU KUITANSI 50 SHEETS PAPERLINE 50 B', '68.jfif'),
(69, 'BUKU KUITANSI PAPERLINE 40 T', '69.jpg'),
(70, 'BUKU KWARTO200 GELATIK', '70.jfif'),
(71, 'BUKU OKTAVO 100 GK', '71.jpg'),
(72, 'BUKU OKTAVO 200 GK', '72.jpg'),
(73, 'BUKU TULIS KOTAK MATEMATIKA 38 (STRIMIN) SIDU', '73.jpg'),
(74, 'BUKU TULIS SIDU 38', '74.jfif'),
(75, 'BUKU TULIS SIDU 38 SATUAN', '75.jfif'),
(76, 'BUKU TULIS VISION 38', '76.jpeg'),
(77, 'BUKU TULIS VISION 38 SATUAN', '77.png'),
(78, 'CLIPBOARD BIG 5001 TRANSPARAN', '78.jpg'),
(79, 'CLIPBOARD BIG 5003 FLUORES', '79.jfif'),
(80, 'CLIPBOARD BIG 5005 PASTEL COLOR', '80.jfif'),
(81, 'CORRECTION FLUID JK-01 JOYKO', '81.png'),
(82, 'CORRECTION TAPE DEBOZZ DB-CT013', '82.jfif'),
(83, 'COVER MIKA FOLIO NIPON', '83.jpg'),
(84, 'CUTTER A-300 KENKO', '84.jpg'),
(85, 'CUTTER K-200 KENKO', '85.jfif'),
(86, 'CUTTER L-500 KENKO', '86.jpg'),
(87, 'DISPLAY BOOK F4-801 HIJAU 20 POCKET', '87.jfif'),
(88, 'DOUBLE TAPE NACHI 12mm', '88.jpg'),
(89, 'DOUBLE TAPE NACHI 24mm', '89.jpg'),
(90, 'DOUBLE TAPE NACHI 48mm', '90.jpg'),
(91, 'DRAWING PEN SNOWMAN 0.1', '91.jpg'),
(92, 'DRAWING PEN SNOWMAN 0.2', '92.jpg'),
(93, 'DRAWING PEN SNOWMAN 0.3', '93.jpg'),
(94, 'DRAWING PEN SNOWMAN 0.4', '94.jpg'),
(95, 'DRAWING PEN SNOWMAN 0.5', '95.jpg'),
(96, 'DRAWING PEN SNOWMAN 0.6', '96.jpg'),
(97, 'DRAWING PEN SNOWMAN 0.7', '97.jpg'),
(98, 'DRAWING PEN SNOWMAN 0.8', '98.jpg'),
(99, 'ERICA 156/E-156 PERSONAL NOTE BOOK', '99.jfif'),
(100, 'FINGER COUNTER (BESAR) LED/TIME SXH 5136 (12PCS)', '100.jpg'),
(101, 'FINGER COUNTER (KECIL) (125PCS)', '101.jpg'),
(102, 'G.KUKU 777 BESAR', '102.png'),
(103, 'G.KUKU 777 KECIL', '103.jpg'),
(104, 'G.KUKU 777 SEDANG', '104.jfif'),
(105, 'G.KUKU LK-350 SUPER DOLL', '105.jpg'),
(106, 'G.KUKU SK-340 SUPER DOLL', '106.jpg'),
(107, 'GLUE GUN VT-600 V-TEC', '107.jpg'),
(108, 'GUNTING K200 5.5\"', '108.jpg'),
(109, 'GUNTING K300 6.5\"', '109.jpg'),
(110, 'GUNTING K500 8\"', '110.jpg'),
(111, 'HERO STAMP PAD KECIL', '111.jfif'),
(112, 'ID CARD DELUXE 333 BIG', '112.jfif'),
(113, 'ID CARD HITAM/BIRU', '113.jpg'),
(114, 'ISI CUTTER BLADE A-100 KENKO/V-TEC 5PCS', '114.png'),
(115, 'ISI CUTTER L-150 5PCS  KENKO/V-TEC', '115.png'),
(116, 'ISI PENSIL 0.5mm 12PCS KENKO', '116.jfif'),
(117, 'ISI PENSIL 2.0mm 8PCS BIG', '117.jfif'),
(118, 'ISI STAPLES DEBOZZ MODEL 10', '118.jfif'),
(119, 'ISI STAPLES ETONA NO. 10', '119.jpg'),
(120, 'ISI STAPLES NO.3-1M FINE 24/6 MAX', '120.jpg'),
(121, 'ISOLASI KECIL 2000 NACHI STATIONERY', '121.jpg'),
(122, 'ISOLASI KERTAS KECIL NACHI', '122.jfif'),
(123, 'ISOLASI MASKING NACHI', '123.jpg'),
(124, 'ISOLASI NACHI 12mm 72yard', '124.jfif'),
(125, 'ISOLASI NACHI 24mm 72yard', '125.jpg'),
(126, 'JANGKA ENTER 4001', '126.jpg'),
(127, 'KAPUR SARJANA PUTIH', '127.jpg'),
(128, 'KAPUR SARJANA WARNA', '128.jpg'),
(129, 'KASYKUL KHOT', '129.jpg'),
(130, 'KERTAS BUFFALO (100/PACK)', '130.jpg'),
(131, 'KERTAS DOUBLE FOLIO BERGARIS ', '131.jfif'),
(132, 'KERTAS HVS SIDU A4 70 GSM', '132.png'),
(133, 'KERTAS HVS SIDU F4 70 GSM', '133.jpg'),
(134, 'KERTAS KADO CRAFT FANCY', '134.jpg'),
(135, 'KERTAS KADO HVS BATIK', '135.jpg'),
(136, 'KERTAS KARBON SAILING BOAT', '136.jpg'),
(137, 'KERTAS KARTON MAKET', '137.jfif'),
(138, 'KERTAS MANILA PUTIH', '138.jfif'),
(139, 'KHOT NASKHI', '139.jpg'),
(140, 'LAKBAN BENING SEDANG 1\" NACHI', '140.jfif'),
(141, 'LAKBAN PREMIUM 23X12 NACHI', '141.jpg'),
(142, 'LAKBAN PREMIUM 35x12 NACHI', '142.jpg'),
(143, 'LAKBAN PREMIUM 46X12 NACHI', '143.jpg'),
(144, 'LEM ALTECO', '144.jpg'),
(145, 'LEM CASTOL BESAR', '145.jpg'),
(146, 'LEM CASTOL MINI', '146.jpg'),
(147, 'LEM CASTOL SEDANG', '147.jpg'),
(148, 'LEM DLUKOL KECIL', '148.jpg'),
(149, 'LEM DLUKOL SEDANG', '149.jpg'),
(150, 'LEM FOX 150g', '150.jpg'),
(151, 'LEM FOX KALENG 70 gr', '151.jpg'),
(152, 'LEM UHU 7g/ml', '152.jpg'),
(153, 'LOOSE LEAF 50 WARNA KIKY', '153.jfif'),
(154, 'LOOSE LEAF A5/100 BERGARIS BIGBOSS', '154.jpg'),
(155, 'LOOSE LEAF A5/50 BERGARIS BIGBOSS', '155.jpg'),
(156, 'LOOSE LEAF A5/50 POLOS BIGBOSS', '156.jpg'),
(157, 'MAP BATIK KIKY', '157.jpg'),
(158, 'MAP BUSINESS FILE 8804 BIG', '158.png'),
(159, 'MAP BUSINESS FILE KIKY', '159.jpg'),
(160, 'MAP L 8113 BIG', '160.jpg'),
(161, 'MAP TALI PLASTIK FOLDER ONE EBO 100F', '161.jfif'),
(162, 'MASKING TAPE 24MM ISOLASI KERTAS NACHI', '162.png'),
(163, 'MASKING TAPE 48MM ISOLASI KERTAS NACHI', '163.jpg'),
(164, 'NON ASTURO POLOS/PELANGI (50/PACK)', '164.jpg'),
(165, 'NOTA KONTAN 2 PLY KECIL 108X155', '165.jfif'),
(166, 'NOTA KONTAN 3 PLY BESAR 160X210', '166.jfif'),
(167, 'NOTA KONTAN 3 PLY KECIL 108X155', '167.jpg'),
(168, 'NOTEBOOK A7 MATTE INA CREATIVE', '168.jpg'),
(169, 'NOTEBOOK B5 PERFUME INA CREATIVE', '169.jfif'),
(170, 'NOTEBOOK HARDCOVER INA', '170.png'),
(171, 'PENCIL CASE CRAFT', '171.jpg'),
(172, 'PENGGARIS BENING 20CM BUTTERFLY (12/PACK)', '172.jfif'),
(173, 'PENGGARIS BENING 30CM BUTTERFLY (12/PACK)', '173.jfif'),
(174, 'PENGGARIS BENING 50CM  BUTTERFLY', '174.jfif'),
(175, 'PENGGARIS BUSUR PROTRACTOR BUTTERFLY', '175.png'),
(176, 'PENGGARIS KAYU SEGITIGA (SEPASANG)', '176.jpg'),
(177, 'PENGHAPUS HITAM BESAR BIG 4B 9242 (24/PACK)', '177.jpg'),
(178, 'PENGHAPUS HITAM KECIL BIG 4B 9402 (40/PACK)', '178.jfif'),
(179, 'PENGHAPUS KAYU PIRAMIDA/PRIMA/ABC', '179.jfif'),
(180, 'PENGHAPUS PUTIH BESAR BIG 4B 9241 (24/PACK)', '180.jpg'),
(181, 'PENGHAPUS PUTIH KECIL BIG 4B 9401 (40/PACK)', '181.jpg'),
(182, 'PENGHAPUS WARNA 19-L-000243 BIG 4B', '182.png'),
(183, 'PENSIL MEKANIK MP-07 0.5 KENKO', '183.jpg'),
(184, 'PUSH PIN KENKO PN-30', '184'),
(185, 'REFILL INK SNOWMAN HITAM WHITEBOARD', '185.jfif'),
(186, 'SAMPUL COKLAT', '186.jpg'),
(187, 'SEJARAH INDONESIA 1 KMI (16)', '187.jfif'),
(188, 'SEJARAH INDONESIA 2 KMI (26)', '188.jfif'),
(189, 'SEJARAH INDONESIA 3 KMI', '189.jfif'),
(190, 'SELECTED VOCABULARIES 1', '190.jpg'),
(191, 'SELECTED VOCABULARIES 2 (19)', '191.jpg'),
(192, 'SELECTED VOCABULARIES 3', '192.jfif'),
(193, 'SNOWMAN 700 1.0 CALLIGRAPHY', '193.jfif'),
(194, 'SPIDOL KENKO BIRU PERMANENT', '194.jpg'),
(195, 'SPIDOL KENKO HITAM BOARDMARKER', '195.jpg'),
(196, 'SPIDOL KENKO MERAH BOARDMARKER', '196.jpg'),
(197, 'SPIDOL SNOWMAN BOARDMARKER BIRU', '197.jpg'),
(198, 'SPIDOL SNOWMAN BOARDMARKER HITAM', '198.jfif'),
(199, 'SPIDOL SNOWMAN BOARDMARKER MERAH', '199.jpg'),
(200, 'SPIDOL SNOWMAN GOLD NO.FGP', '200.jpg'),
(201, 'SPIDOL SNOWMAN GOLD NO.GP', '201.jfif'),
(202, 'SPIDOL SNOWMAN PERMANENT HITAM', '202.jpg'),
(203, 'SPIDOL SNOWMAN SILVER NO.FSP', '203.jfif'),
(204, 'SPIDOL SNOWMAN SILVER NO.SP', '204.jpg'),
(205, 'SPIDOL SNOWMAN WHITE NO.FWP', '205.jfif'),
(206, 'SPIDOL SNOWMAN WHITE NO.WP', '206.jfif'),
(207, 'SPIRALBOOK A5 HARDCOVER', '207.jpg'),
(208, 'SPIRALBOOK A6 DIE CUT', '208.PNG'),
(209, 'SPRING FILE 8116 BIG', '209.jpg'),
(210, 'STAMPING INK YAMURA', '210.jfif'),
(211, 'STANDY BELADIRI (BESAR)', '211'),
(212, 'STANDY SANTRIWAN SARUNG (KECIL)', '212'),
(213, 'STAPLER KENKO HD10', '213.jpg'),
(214, 'STICK NOTE 5 COLOR SN 7651 5W', '214.jpg'),
(215, 'STICK NOTE ARAH 7 WARNA BIG6020', '215.jpg'),
(216, 'STICK NOTE MULTIPLE SN 5138T (24/pack)', '216.jpg'),
(217, 'STICK NOTE MULTIPLE SN 76100T', '217.jpg'),
(218, 'STICK NOTE MULTIPLE SN 7651T', '218.jfif'),
(219, 'TEMPAT TINTA BESAR', '219.jfif'),
(220, 'TEMPAT TINTA KACA', '220.png'),
(221, 'TINTA CINA 100ML V-TEC', '221.jfif'),
(222, 'TRIGONAL CLIPS NO.1 BIG', '222.jfif'),
(223, 'ZIPPER BAG 5521B BENEX', '223.jpg'),
(224, 'spidol silver', '224.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `n_produk`
--
ALTER TABLE `n_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perangkingan`
--
ALTER TABLE `perangkingan`
  ADD PRIMARY KEY (`id_perangkingan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `n_produk`
--
ALTER TABLE `n_produk`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
