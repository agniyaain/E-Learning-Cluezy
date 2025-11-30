-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2025 at 03:27 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cluezy_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id_note` int NOT NULL,
  `id_user` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id_note`, `id_user`, `judul`, `deskripsi`, `isi`) VALUES
(14, 7, 'Hobby and Interest', 'English Grade X ', '1761106288_hobby_n_interest_2.jpg,1761106288_hobby_n_interest.jpg'),
(15, 7, 'Descriptive Text', 'English Grade X Descriptive Text', '1761106502_photo_2025-10-22_11-13-21.jpg,1761106502_deskripsi2.jpg'),
(16, 7, 'Energi', 'IPAS kelas X semester 1 Energi', '1761106555_Energi.jpg'),
(17, 7, 'Ilmu Sejarah', 'Sejarah kelas X semester 1 ilmu Sejarah', '1761106617_photo_2025-10-22_11-16-15.jpg'),
(19, 10, 'Laporan Hasil Observasi', 'Teks Laporan Hasil Observasi, Bahasa Indonesia Kelas X ', '1761632012_photo_2025-10-28_13-12-30.jpg'),
(36, 22, 'routing', 'safds', '1763084717_02_Routing___Controller_Laravel.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_user`
--

CREATE TABLE `jawaban_user` (
  `id_jawaban` int NOT NULL,
  `id_user` int NOT NULL,
  `id_quiz` int NOT NULL,
  `id_soal` int NOT NULL,
  `jawaban_user` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int NOT NULL,
  `id_user` int NOT NULL,
  `judul` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah_soal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `id_user`, `judul`, `deskripsi`, `jumlah_soal`) VALUES
(18, 7, 'Pemrogaman Berorientasi Objek', 'PBO kelas X SMK Semester 1', 5),
(21, 7, ' SIMPLE PAST TENSE', 'Simple Past Tense, Grade 8th', 14),
(22, 7, 'Pendidikan Pancasila', 'Pendidikan Pancasila, Kelas 11', 20),
(23, 7, 'Teks Anekdot', 'Teks Anekdot, Bahasa Indonesia kelas 10 ', 10),
(24, 7, 'Teks Laporan Hasil Observasi', 'Teks LHO, Bahasa Indonesia, kelas 10', 10),
(31, 21, 'sadf', 'safdssdadfd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_session`
--

CREATE TABLE `quiz_session` (
  `id_session` int NOT NULL,
  `id_quiz` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `kode_session` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `status_play` enum('solo','code') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'solo',
  `status` enum('waiting','running','finished') NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quiz_session`
--

INSERT INTO `quiz_session` (`id_session`, `id_quiz`, `id_user`, `kode_session`, `created_at`, `status_play`, `status`) VALUES
(42, 24, NULL, NULL, '2025-10-27 09:04:43', 'solo', 'waiting'),
(43, 18, 12, 'HI970L', '2025-10-27 09:06:02', 'solo', 'waiting'),
(44, 18, 11, 'XXMN8H', '2025-10-27 09:08:35', 'solo', 'waiting'),
(45, 18, 11, '5LLE5S', '2025-10-27 09:09:03', 'solo', 'waiting'),
(46, 18, 11, 'GYC08U', '2025-10-27 09:16:45', 'solo', 'waiting'),
(47, 21, 10, 'V4F2US', '2025-10-27 09:26:02', 'solo', 'finished'),
(48, 18, 10, '0X1PGO', '2025-10-27 11:14:59', 'solo', 'running'),
(52, 21, NULL, NULL, '2025-11-03 09:23:09', 'solo', 'waiting'),
(53, 22, 7, 'GHEB8Q', '2025-11-03 10:55:17', 'solo', 'waiting'),
(60, 18, 16, 'DFZMIY', '2025-11-13 20:07:27', 'solo', 'waiting'),
(63, 22, 10, 'O3RY9L', '2025-11-14 07:26:53', 'solo', 'waiting');

-- --------------------------------------------------------

--
-- Table structure for table `skor_table`
--

CREATE TABLE `skor_table` (
  `id_skor` int NOT NULL,
  `id_user` int NOT NULL,
  `id_quiz` int NOT NULL,
  `skor_benar` int NOT NULL,
  `skor_salah` int NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int NOT NULL,
  `id_quiz` int NOT NULL,
  `soal` text NOT NULL,
  `pilihan_a` text NOT NULL,
  `pilihan_b` text NOT NULL,
  `pilihan_c` text NOT NULL,
  `pilihan_d` text NOT NULL,
  `jawaban_benar` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_quiz`, `soal`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban_benar`) VALUES
(93, 18, 'Programming paradigm yang menggunakan obyek dan interaksinya untuk merancang aplikasi dan program computer merupakan pengertian dari…', 'Pemrograman terstruktur', 'Pemrograman berorientasi objek', 'Pemrogaman Web', 'Pemrograman desktop', 'b'),
(94, 18, 'Suatu program yang menerjemahkan bahasa program ( source code) kedalam bahasa objek (obyek code) disebut dengan …', 'Compiler', 'Visual Basic', 'Kompilasi', 'Kompilasi', 'a'),
(95, 18, 'Compiler bertugas untuk melakukan kompilasi *.java menjadi *.class, syntak yang digunakan adalah…', 'java nama_file', 'javac nama file', 'javac nama_file.java', 'java nama_file.java', 'c'),
(96, 18, 'Sekumpulan data yang berisi attribut dengan variabelnya dan method yang saling berhubungan disebut dengan …', 'Method', 'Objek', 'Class', 'Attribute', 'b'),
(97, 18, 'Merupakan sebuah blue print dari sebuah objek atau pembungkus objek disebut dengan …', 'Method', 'Objek', 'Class', 'Attribute', 'c'),
(109, 21, 'She did not.... a movie yesterday.', 'watch', 'watchs', 'watched', 'wotch', 'a'),
(110, 21, 'My mother .... a nurse 10 years ago', 'Was', 'Is', 'Were', 'Are', 'a'),
(111, 21, 'I told him I …….. something to show to his brother last week.', 'have', 'had', 'has', 'do', 'b'),
(112, 21, 'Sally did not___a heart on the beach sand last week.', 'drew', 'draws', 'drawed', 'draw', 'd'),
(113, 21, 'Leonardo registered himself for an online game competition . . . . .', ' TOMORROW', ' NEXT MONDAY', 'YESTERDAY', 'TODAY', 'c'),
(114, 21, '. . . . Tuesday I saw Enid hunt a rabbit in the woods.', 'ago', 'more', 'later', 'last', 'd'),
(115, 21, 'They ..... this music two hours ago.', 'Be listen', ' Listened to', 'Listening to', ' Listen to', 'b'),
(116, 21, 'He ..... to go to the beach last week.', 'Wanted', 'Willing', 'Want', 'Will', 'a'),
(117, 21, '..... you go to Solo yesterday?', 'Do', 'DOne', 'Dare', 'Did', 'd'),
(118, 21, 'The sofa ..... not comfortable for me.', 'is', 'was', 'were', 'did', 'b'),
(119, 21, 'Brian didnt ..... his parents about his English test score last week.', ' Told', 'Tell', 'Telling', 'Telled', 'b'),
(120, 21, 'She ..... fried chicken yesterday afternoon.', 'Mix', 'Cook', 'Cooking ', 'Cooked', 'd'),
(121, 21, '.... he come here?', 'Did ', 'Was', 'Is ', 'Would', 'a'),
(122, 21, 'I ..... corn soup this afternoon.', 'Eat ', 'Ate', 'Eating', 'Eaten', 'b'),
(126, 22, 'Pandangan hidup bangsa dan ideologi bagi negara Indonesia adalah..', 'Pancasila', 'Ketetapan MPR', ' Burung Garuda ', ' UUD 1945', 'a'),
(127, 22, 'Pancasila sebagai ideologi nasional bangsa Indonesia adalah ideologi ...', 'Dinamis', 'Tertutup', ' Reformis', 'Terbuka', 'd'),
(128, 22, 'Makna Pancasila sebagai ideologi nasional adalah nilai nilai yang terkandung dalam Pancasila menjadi...', ' Tujuan nasional bangsa Indonesia ', 'Pandangan hidup bangsa Indonesia ', ' Cita-cita normatif penyelenggaraan negara', ' Tujuan hidup masyarakat indonesia', 'c'),
(129, 22, 'Kedudukan Pancasila dalam sistem hukum nasional sebagai sumber dari segala sumber hukum merupakan contoh perwujudan nilai Pancasila pada bidang', 'Politik', 'Budaya ', 'Ekonomi ', 'Hukum', 'd'),
(130, 22, 'Dalam sistem hukum nasional semua peraturan perundangan undangan yang berlaku tidak boleh bertentangan dengan nilai-nilai ..', 'Agama', 'Norma', 'Pancasila ', 'Budaya', 'c'),
(131, 22, 'Salah satu ciri ideologi tertutup adalah keberagaman cara pandang dan kebudayaan dalam masyarakat dikurangi bahkan di hilangkan.oleh karena itu ideologi tertutup biasanya bersifat....', 'Kaku', 'Otoriter', 'Nasionalis', 'Kapitalis', 'a'),
(132, 22, 'Mengembangkan nilai-nilai persamaan status sosial bdan menghalangi berkembangnya nilai feodalisme merupakan salah satu contoh perwujudan nilai-nilai Pancasila di bidang ...', 'Ekonomi', 'POlitik', 'Hukum ', 'Sosial Budaya', 'd'),
(133, 22, 'Naya senag berlatih tari piring  dengan teman sekelasnya.meskioun Naya bersuku Jawa tetapi Naya senang belajar tari piring. Perilaku Naya menunjukkan perwujudan nilai-nilai Pancasila di bidang...', 'Hukum', 'Sosial Budaya', 'Ekonomi', 'Pertahanan Keamanan', 'b'),
(134, 22, 'Pancasila sebagai ideologi terbuka mengandung beberapa nilai. Berikut yang bukan nilai-nilai tersebut adalah...', 'Dasar', 'Instrumental', 'Ketuhanan', 'Praksis', 'c'),
(135, 22, 'Ideologi yang mengharuskan masyarakatnya patuh dan taat terhadap ideologi tersebut termasuk petingginya merupakan salah satu ciri ideologi...', 'Tertutup', 'Pragmatis', 'Terbuka ', 'Liberal', 'a'),
(136, 22, 'Ideologi terbuka memiliki berbagai sifat,antara lain....', 'Kaku', 'Fleksibel', 'Sulit untuk diubah', 'Tidak mengikuti perkembangan zaman', 'b'),
(137, 22, 'Ideologi merupakan asas pendapat, pandangan, atau keyakinan yang dicita-citakan oleh orang atau golongan dalam masyarakat atau suatu bangsa.ideologi bersumber dari ...', 'Sejarah bangsa', 'Pikiran Manusia', 'Kebudayaan Bangsa', 'Keyakinan dan kepercayaan', 'b'),
(138, 22, 'Perwujudan nilai-nilai Pancasila dalam bidang politik dapat dilihat dari...', 'Meningkatnya angka kemiskinan ', 'Terjadinya praktik korupsi yang merajalela', 'Berkembangnya sikap individualisme ', 'Adanya jaminan kebebasan berpendapat dan berserikat', 'd'),
(139, 22, 'Penerapan nilai-nilai Pancasila dalam bidang pertahanan dan keamanan tercermin dalam...', 'Adanya rasa saling curiga antar warga negara', 'Terwujudnya stabilitas keamanan negara yang terjamin', 'Terjadinya tindakan kekerasan ', 'Terjadinya tindakan kekerasan ', 'b'),
(140, 22, 'Kedudukan Pancasila sebagai pandangan hidup bangsa Indonesia adalah....', 'Cita-cita dan tujuan hidup bangsa ', 'Dasar negara mengatur pemerintahan negara ', 'Gambaran sikap dan perilaku manusia Indonesia', 'Pegangan dan pedoman hidup bangsa Indonesia', 'd'),
(141, 22, 'Salah satu contoh perwujudan nilai-nilai Pancasila dalam bidang hukum adalah...', 'Penegakan hukum yang adil dan transparan ', ' Adanya diskriminasi hukum terhadap kelompok tertentu', ' Pemberian hukuman yang berat sebelah', 'Terjadinya praktik korupsi dalam lembaga peradilan', 'a'),
(142, 22, 'Salah satu alasan mengapa bangsa Indonesia harus bangga karena memiliki ideologi Pancasila adalah...', 'Sesuai dengan perkembangan zaman', ' Dapat menyelesaikan segala masalah ', ' Mampu mempersatukan bangsa Indonesia yang majemuk', 'Karena dirumuskan oleh banyak pemimpin', 'c'),
(143, 22, 'Orang yang tidak bermoral Pancasila salah satunya dicirikan dengan....', 'Semua Maslah diselesaikan melalui musyawarah ', 'Segala tindakannya ditujukan untuk mendapatkan pujian dari masyarakat ', 'Mengutamakan masyarakat dari pada diri sendiri ', ' Berhati-hati dalam setiap mengambil keputusan', 'b'),
(144, 22, 'Pancasila menjadi sarana penting untuk mempersatukan bangsa Indonesia karena kedudukannya sebagai ..', 'Falsafah bangsa Indonesia ', 'Jiwa dan kepribadian bangsa ', 'Perjanjian luhur bangsa ', 'Pedoman hidup bangsa', 'd'),
(145, 22, 'Makna Pancasila digunakan secara objektif adalah....', ' Pancasila menjadi filtermasuknya budaya globa', ' Pancasila menjadi pedoman perilaku sehari-hari ', ' Pancasila menjadi sumber hukum negara ', ' Pancasila menjadi dasar hukum penyelenggaraan negara ', 'b'),
(146, 23, 'Teks anekdot adalah teks yang berisi….', ' Cerita khayalan penuh fantasi', 'Cerita sedih yang membuat pembaca menangis', ' Cerita lucu yang mengandung kritik atau sindiran', 'Cerita panjang yang penuh konflik', 'c'),
(147, 23, 'Tujuan utama dari teks anekdot adalah….', ' Menghibur dan memberikan informasi factual', 'Menghibur sekaligus menyampaikan kritik sosial', 'Menyampaikan pengalaman pribadi secara rinci', ' Memberikan pengetahuan tentang tokoh sejarah', 'b'),
(148, 23, 'Struktur teks anekdot yang benar adalah….', 'Pendahuluan- isi- penutup', ' Abstrak – orientasi- koda- penutup- krisis', 'Judul- isi- penutup', ' Abstrak- orientasi- krisis- reaksi- koda', 'd'),
(149, 23, 'Bagian orientasi dalam teks anekdot berfungsi untuk….', ' Memberi sindiran atau pesan moral', ' Menjelaskan tokoh, latar, dan situasi awal', 'Menguraikan solusi dari masalah', ' Menutup cerita dengan kesan tertentu', 'b'),
(150, 23, 'Bagian yang menunjukkan adanya masalah dalam teks anekdot adalah…', 'Krisis', 'Abstrak', 'Orientasi', 'Koda', 'a'),
(151, 23, 'Kalimat berikut yang merupakan ciri teks anekdot adalah….', '“Presiden Soekarno lahir pada tahun 1901 di Blitar”', ' “Banjir bandang terjadi akibat curah hujan tinggi”', ' “Pohon manga itu tumbuh dengan subur di belakang rumah”', '“Seorang guru pernah marah karena siswanya terlalu rajin”', 'd'),
(152, 23, 'Gaya Bahasa yang paling dominan digunakan dalam teks anekdot adalah….', 'Formal dan ilmiah', ' Puitis dan indah', 'Lucu, santai, dan menyindir', ' Naratif dan objektif', 'c'),
(153, 23, '“Pak RT menegus warganya yang membuang sampah sembarangan”. Warganya menjawab, “Biarn aja, Pak. Sampah kan bisa berenang”. Kalimat jawaban warga itu termasuk….', 'Krisis', 'Reaksi', 'Abstrak', 'Koda', 'd'),
(154, 23, 'Ciri kebahasaan teks anekdot adalah…', 'Menggunakan kalimat naratif, kalimat langsung, dan konyol', 'Banyak menggunakan istilah ilmiah', 'Menggunakan ungkapan puitis', ' Menggunakan kalimat perintah dan fakta', 'a'),
(155, 23, 'Pesan moral dalam teks anekdot biasanya disampaikan melalui….', ' Tokoh antagonis', ' Penjelasan narator', ' Dialog yang lucu dan menyindir', ' Fakta dan data peneltian', 'c'),
(194, 24, 'Pisang adalah salah satu buah tropis yang banyak ditemukan di Indonesia. Buah ini memiliki kulit berwarna kuning saat matang dan rasanya manis. Lanjutan yang paling tepat adalah....', 'Banyak orang tidak suka pisang karena rasanya pahit.', ' Pisang biasanya tumbuh di daerah dingin dan bersalju.', 'Buah pisang mengandung banyak vitamin, terutama vitamin B dan C.', 'Pisang bisa digunakan untuk menyembuhkan luka bakar.', 'c'),
(195, 24, 'Pohon beringin memiliki akar gantung yang tumbuh dari batangnya. Daun pohon ini rimbun dan dapat memberikan keteduhan.  Lanjutan yang paling tepat adalah..', 'Banyak orang tidak suka pisang karena rasanya pahit.', 'Oleh karena itu, pohon ini sering ditebang saat musim kemarau.', 'Pohon beringin biasanya hidup di gurun pasir yang panas.', 'Akar gantung pohon beringin tidak memiliki fungsi apa pun.', 'a'),
(196, 24, 'Kupu-kupu mengalami proses metamorfosis sempurna. Proses ini dimulai dari telur, kemudian menjadi ulat, kepompong, lalu kupu-kupu dewasa. Lanjutan yang paling tepat adalah....', ' Oleh karena itu, kupu-kupu langsung lahir dalam bentuk dewasa.', ' Proses ini sangat cepat, hanya butuh satu jam', ' Metamorfosis ini membantu kupu-kupu bertahan hidup dan berkembang biak.', ' Ulat akan tetap menjadi ulat seumur hidup.', 'c'),
(197, 24, 'Pisang merupakan buah tropis yang banyak tumbuh di Indonesia. Buah ini memiliki kandungan vitamin C dan serat yang baik untuk tubuh.', ' Deskripsi manfaat', ' Pernyataan umum', ' Deskripsi bagian', ' Penutup ', 'b'),
(198, 24, 'Burung hantu merupakan hewan malam yang aktif berburu saat gelap. Burung ini memiliki penglihatan yang sangat tajam dan leher yang dapat berputar hampir 270 derajat. Kalimat lanjutan yang paling tepat', 'Oleh sebab itu, burung hantu hanya hidup di kutub utara.', 'Kemampuan ini membantunya mengamati mangsa dari berbagai arah.', ' Buah pisang mengandung banyak vitamin, terutama vitamin B dan C.', ' Burung ini termasuk hewan pemakan rumput.', 'b'),
(199, 24, 'Kaktus adalah tumbuhan yang biasa tumbuh di daerah kering seperti gurun. Daunnya berbentuk duri untuk mengurangi penguapan. Kalimat lanjutan yang paling tepat adalah..', 'Selain itu, batangnya menyimpan air sebagai cadangan saat musim kering.', ' Oleh karena itu, kaktus tidak bisa bertahan hidup di tanah berpasir.', ' Kaktus harus disiram setiap pagi dan malam agar subur.', ' Kaktus hanya hidup jika ditanam dalam air.', 'a'),
(200, 24, 'Elang adalah burung pemangsa yang memiliki penglihatan tajam. Ia mampu melihat mangsa dari ketinggian dan langsung menyergapnya.', 'Elang memakan rumput dan biji-bijia', 'Elang menyukai tempat yang ramai dan padat penduduk.', ' Elang tidak bisa terbang tinggi seperti burung lain.', 'Karena kemampuannya itu, elang menjadi predator utama di udara', 'd'),
(201, 24, 'Gajah Asia adalah salah satu mamalia besar yang hidup di hutan tropis Asia. Hewan ini memiliki ciri khas berupa belalai panjang, telinga yang lebih kecil dibanding gajah Afrika, dan tubuh berwarna abu', ' Cara menangkap gajah liar', 'Ciri fisik dan kebiasaan hidup gajah Asia', ' Jenis-jenis makanan hewan hutan', ' Perbedaan gajah Afrika dan Amerika', 'b'),
(202, 24, 'Bunga Rafflesia arnoldii merupakan salah satu tumbuhan langka yang tumbuh di hutan tropis Indonesia, khususnya di wilayah Bengkulu dan Sumatra Barat. Kalimat definisi diatas ditandai oleh kata ', 'Merupakan', 'Khususnya', 'di', 'Dan', 'a'),
(203, 24, 'Ikan lele adalah ikan air tawar yang banyak dibudidayakan di Indonesia. Ikan ini mudah beradaptasi dan dapat hidup di air yang keruh sekalipun. Kalimat lanjutan yang paling tepat adalah …', ' Karena itu, lele sering dijadikan hewan peliharaan di rumah.', ' Ikan lele hidup di laut dalam dan berburu di malam hari.', ' Lele berkembang biak dengan cara membelah diri.', 'Selain mudah dipelihara, daging lele juga kaya protein dan bergizi.', 'd'),
(209, 31, 'sdfds', 'sfd', 'sds', 'safds', 'sfadsf', 'c'),
(210, 31, 'ads', 'sfads', 'sfadgsf', 'fsads', 'afsds', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `status_todo`
--

CREATE TABLE `status_todo` (
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status_todo`
--

INSERT INTO `status_todo` (`status`) VALUES
('Not Yet'),
('Doing'),
('Done');

-- --------------------------------------------------------

--
-- Table structure for table `to_do_list`
--

CREATE TABLE `to_do_list` (
  `id_todo` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `to_do_list`
--

INSERT INTO `to_do_list` (`id_todo`, `id_user`, `kegiatan`, `status`) VALUES
(2, 1, 'fdsf', 'Done'),
(3, 1, 'annanana', 'Done'),
(4, 1, 'fsafasasfaf', 'Doing'),
(5, 1, 'sdfsdb', 'Doing'),
(6, 1, 'sdfsfd', 'Doing'),
(7, 1, 'dfsd', 'Not Yet'),
(8, 1, ' kjnlkm;', 'Doing'),
(9, 2, 'csadsfng', 'Doing'),
(11, 3, 'wwwww', 'Done'),
(12, 3, 'ttt', 'Done'),
(13, 5, 'sdasf', 'Doing'),
(16, 10, 'sads', 'Done'),
(17, 7, 'fsafasasfaf', 'Doing'),
(19, 10, 'asd', 'Doing'),
(20, 10, 'asdd', 'Doing'),
(21, 10, 'saddfa', 'Done'),
(22, 10, 'asfdfs', 'Not Yet'),
(23, 10, 'asdfs', 'Doing'),
(24, 10, 'fsafasasfaf', 'Not Yet'),
(25, 16, 'Presentasi TA', 'Done'),
(26, 16, 'Laporan TA', 'Done'),
(27, 16, 'asds', 'Not Yet'),
(28, 16, 'asds', 'Not Yet'),
(29, 19, 'asda', 'Done'),
(30, 19, 'asd', 'Done'),
(32, 22, 'Presentasi TA', 'Doing'),
(33, 22, 'Laporan TA', 'Done'),
(34, 22, 'ASdasf', 'Not Yet');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `pass`, `email`, `role`) VALUES
(7, 'admin_niya', 'admin_ayin123', 'agniyaakun@gmail.com', 'admin'),
(8, 'sads', 'asfds', 'igyftudry@gmail.com', 'user'),
(9, 'sd', 'ds', '2041720100', 'user'),
(10, 'adudukotak', 'hijau123', 'adududu@gmail.com', 'user'),
(11, 'ayinnaaw', 'a123', 'dududu@gmail.com', 'user'),
(12, 'Agniya', 'agniya354', 'agniya.rahmah68@smk.belajar.id', 'user'),
(13, 'aduhhh', '1234', 'aggaag@gmail.com', 'user'),
(15, 'admin_akuu', 'akunita', 'asdads@gmail.com', 'admin'),
(16, 'Cluezy Era', 'cluezy1234', 'cluezy123@gmail.com', 'user'),
(17, 'asdfs', 'adsf', 'adfsdg', 'user'),
(19, 'cluezy', 'cluezytest', 'cluezytest@gmail.com', 'user'),
(21, 'akuu_admin', 'admin123', 'dasfdsf@gmail.com', 'admin'),
(22, 'cluezy ea', 'cluezy_ea', 'Cluezy_user@gmail.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `id_user_session` int NOT NULL,
  `id_user` int NOT NULL,
  `id_session` int NOT NULL,
  `waktu_join` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nilai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`id_user_session`, `id_user`, `id_session`, `waktu_join`, `nilai`) VALUES
(17, 12, 42, '2025-10-27 02:04:43', 30),
(18, 10, 46, '2025-10-27 02:16:58', NULL),
(19, 11, 47, '2025-10-27 02:26:15', NULL),
(21, 7, 52, '2025-11-03 02:23:09', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `jawaban_user`
--
ALTER TABLE `jawaban_user`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_quiz` (`id_quiz`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `quiz_session`
--
ALTER TABLE `quiz_session`
  ADD PRIMARY KEY (`id_session`),
  ADD UNIQUE KEY `kode_session` (`kode_session`),
  ADD KEY `id_quiz` (`id_quiz`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `skor_table`
--
ALTER TABLE `skor_table`
  ADD PRIMARY KEY (`id_skor`),
  ADD KEY `id_quiz` (`id_quiz`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_quiz` (`id_quiz`);

--
-- Indexes for table `to_do_list`
--
ALTER TABLE `to_do_list`
  ADD PRIMARY KEY (`id_todo`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id_user_session`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_session` (`id_session`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_note` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `jawaban_user`
--
ALTER TABLE `jawaban_user`
  MODIFY `id_jawaban` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `quiz_session`
--
ALTER TABLE `quiz_session`
  MODIFY `id_session` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `skor_table`
--
ALTER TABLE `skor_table`
  MODIFY `id_skor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `to_do_list`
--
ALTER TABLE `to_do_list`
  MODIFY `id_todo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id_user_session` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan`
--
ALTER TABLE `catatan`
  ADD CONSTRAINT `catatan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `quiz_session`
--
ALTER TABLE `quiz_session`
  ADD CONSTRAINT `quiz_session_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id_quiz`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_session_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `skor_table`
--
ALTER TABLE `skor_table`
  ADD CONSTRAINT `skor_table_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id_quiz`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `skor_table_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_session`
--
ALTER TABLE `user_session`
  ADD CONSTRAINT `user_session_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `user_session_ibfk_2` FOREIGN KEY (`id_session`) REFERENCES `quiz_session` (`id_session`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
