-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21 Jun 2018 pada 08.06
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES
(1, 'Uncategorized', '', ''),
(2, 'Berita', '', ''),
(3, 'Opini', '', 'Opini'),
(4, 'Tech', '', 'Tech');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `parent_id` text NOT NULL,
  `post_id` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `website` text NOT NULL,
  `content` text NOT NULL,
  `time` text NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `comment`
--

INSERT INTO `comment` (`id`, `parent_id`, `post_id`, `username`, `email`, `website`, `content`, `time`, `position`) VALUES
(1, '', '8', 'Feri', 'feriukita@gmail.com', '', 'Keren', '1526199565', '1'),
(2, '', '8', 'feri setyaji', 'feriukita@gmail.com', 'www.feri.com', 'test comment', '1526200129', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `component`
--

CREATE TABLE `component` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `component`
--

INSERT INTO `component` (`id`, `name`) VALUES
(4, 'category.php'),
(5, 'recent-post.php'),
(6, 'tag.php'),
(7, 'test.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `library`
--

CREATE TABLE `library` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `library`
--

INSERT INTO `library` (`id`, `name`) VALUES
(5, 'bookblock-417570-unsplash.jpg'),
(6, 'emre-gencer-364602-unsplash.jpg'),
(7, 'neonbrand-570369-unsplash.jpg'),
(8, 'allef-vinicius-468838-unsplash.jpg'),
(30, 'begadang_20171018_190833.jpg'),
(31, 'pexels-photo.jpg'),
(58, '[Meownime.com] KonoSuba 03 (720p).mkv_snapshot_21.48_[2017.10.20_17.12.47].jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `position` text NOT NULL,
  `group_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `name`, `url`, `position`, `group_id`) VALUES
(8, 'Home', 'http://localhost/blog/', '1', '1'),
(9, 'Berita', 'http://localhost/blog/category/berita', '3', '1'),
(10, 'Kontak', 'http://localhost/blog/pages/Kontak', '2', '1'),
(11, 'Tentang Kami', 'http://localhost/blog/pages/Tentang-Kami', '4', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_group`
--

CREATE TABLE `menu_group` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_group`
--

INSERT INTO `menu_group` (`id`, `name`) VALUES
(1, 'menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `slug` text NOT NULL,
  `time` text NOT NULL,
  `active` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `page`
--

INSERT INTO `page` (`id`, `img`, `title`, `content`, `slug`, `time`, `active`) VALUES
(1, '[MV] MOMOLAND (ëª¨ëª¨ëžœë“œ) _ BBoom BBoom (ë¿œë¿œ) - YouTube.MKV_snapshot_00.19_[2018.03.13_19.25.13].jpg', 'Tentang Kami', '<p style=\"text-align: center;\"><span style=\"font-size: 24px;\"><strong>Tentang Kami</strong></span></p>', 'Tentang-Kami', '1526192788', 'Yes'),
(3, '', 'Kontak', '<p style=\"text-align: center;\"><span style=\"font-size: 24px;\"><strong>Kontak</strong></span></p>', 'Kontak', '1526193392', 'Yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `author` text NOT NULL,
  `img` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `slug` text NOT NULL,
  `time` text NOT NULL,
  `rate` text NOT NULL,
  `category` text NOT NULL,
  `tag` text NOT NULL,
  `comment` text NOT NULL,
  `active` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `post`
--

INSERT INTO `post` (`id`, `author`, `img`, `title`, `content`, `slug`, `time`, `rate`, `category`, `tag`, `comment`, `active`) VALUES
(4, '3', 'begadang_20171018_190833.jpg', 'Tips Cara Menjadi Programmer Walaupun Hanya Secara Otodidak', '<p>Kalau kamu punya ketertarikan di dunia komputer, khususnya bagaimana cara membuat sebuah program atau aplikasi, kamu bisa mempelajarinya tanpa harus duduk di bangku kuliah. Ya, untuk menjadi programmer itu bisa dilakukan secara otodidak. Tapi ini bukan berarti kami menolak pendidikan perguruan tinggi. Bukan seperti itu.</p>\r\n<p>Yang kami maksud di sini adalah kalau kamu memang punya ketertarikan di bidang itu dan tidak ada keinginan untuk mempelajarinya di perkuliahan, kamu pun tetap bisa meraih mimpi itu dengan belajar sendiri.</p>\r\n<p>Karena ilmu programming / komputer ini merupakan ilmu terapan, yang artinya kamu akan bisa menguasainya dengan cara praktek.</p>\r\n<p>Bahkan kadang mahasiswa jurusan IT yang notabene di kuliah diajarkan ilmu programming, kadang kalau sudah lulus tidak menjadi mereka bisa. Banyak yang telah mengalaminya.</p>\r\n<p>Untuk itu buat kamu yang tidak kuliah, masih terbuka kesempatan lebar untuk tetap bisa menjadi programmer otodidak. Hal yang perlu kamu lakukan adalah :</p>\r\n<p><strong>#1 Belajar Algoritma Dasar</strong></p>\r\n<p>Sebelum kamu mempelajari ilmu programming lebih jauh, pelajaran dasar yang perlu kamu pahami adalah soal algoritma. Algoritma ini merupakan langkah-langkah penyelesaian sebuah masalah. Kalau kamu sudah paham mengenai algoritma, nantinya akan mudah mempelajari bahasa program yang kamu inginkan. Karena ini memang dasar dari ilmu programming.</p>\r\n<p>Di internet banyak sekali materi mengenai algoritma, dan kamu bisa belajar melalui media tersebut. Atau kamu juga bisa membacanya dari buku-buku Algoritma seperti &ldquo;<a href=\"https://www.bukupedia.com/id/book/id-118161/algoritma-dan-struktur-data-bahasa-c.html\">Algoritma Dan Struktur Data Bahasa C</a>&ldquo;. Kami sarankan memang mempelajarinya melalui buku, karena referensinya lebih komplit dan sistematis.</p>\r\n<p><strong>#2 Memilih Bahasa Pemrograman</strong></p>\r\n<p>Dalam memilih bahasa pemrograman ini perlu disesuaikan dengan minat. Misalnya saja kamu tertarik untuk membuat program yang berbasis web, berarti kamu harus fokus mempelajari bahasa program seperti HTML, PHP, NodeJS, dll. Kalau ingin membuat program yang versi desktop, berarti bahasa program yang perlu dipelajari adalah Java, Delphi, dll.</p>\r\n<p>Pemilihan bahasa pemrograman ini sangat penting, karena akan membuat kamu lebih fokus dalam belajar. Jangan sampai semua dipelajari karena itu kadang hasilnya kurang optimal. Mending fokus di satu Bahasa Pemrograman dan dalami itu. Sehingga nanti kamu akan lebih expert di bidang itu.</p>\r\n<p><strong>#3 Praktek Langsung</strong></p>\r\n<p>Kalau kamu ingin menjadi programer otodidak, saran kami jangan terlalu banyak teori. Langsung saja praktek dengan membuat proyek kecil-kecilan. Dari situ kamu akan belajar membuat proyek sekaligus belajar. Dan cara seperti ini lebih efektif dibanding mempelajari materi satu per satu.</p>\r\n<p>Misalnya saja kamu fokus mempelajari bahasa program desktop, coba kamu untuk membuat proyek aplikasi pendataan inventaris. Ini program sederhana, tapi bagi kamu yang baru belajar tentu akan menjadi luar biasa. Tidak apa membuat yang kecil-kecil dulu toh tujuannya untuk belajar.</p>\r\n<p>Pastikan tujuan akhirnya adalah program atau aplikasi bisa berjalan sesuai dengan harapan. Jadi sebelumnya kamu juga perlu menargetkan tujuan akhir.</p>\r\n<p><strong>#4 Tinjau Ulang Karya Kamu</strong></p>\r\n<p>Meskipun membuat proyek kecil-kecilan, tetapi setelah jadi jangan berbangga diri dulu. Kamu harus mencoba meninjau ulang hasil karya kamu itu. Coba cari kekurangannya apa. Dari kekurangan itu catat dan coba untuk diperbaiki di proyek selanjutnya.</p>\r\n<p>Meninjau ulang ini juga cara agar kamu bisa memahami hasil yang telah kamu buat.</p>\r\n<p><strong>#5 Praktek Lagi</strong></p>\r\n<p>Jangan cepat puas jika belajar pemrograman, karena setiap waktu ilmu ini juga terus mengalami pembaharuan. Jadi kamu harus terus belajar dan membuat hal-hal baru. Dalam setiap prakter membuat proyek baru, pastikan untuk memperbaiki kesalahan dan kekurangan di proyek sebelumnya. Misalnya di proyek sebelumnya menggunakan sistem yang kurang efektif, sekarang di proyek selanjutnya di buat dengan lebih efektif. Sehingga proses pembuatan juga akan lebih menghemat waktu.</p>\r\n<p><strong>#6 Bergabunglah dengan Komunitas</strong></p>\r\n<p>Belajar programming secara otodidak dengan sendiri memang kurang asyik. Selain tidak bisa ada yang diajak komunikasi, juga tidak bisa bertukar ilmu. Maka bergabunglah dengan komunitas programming di daerah mu. Ini akan sangat membantu kamu untuk mendapatkan hal-hal baru. Terlebih di sana akan banyak programmer yang telah berpengalaman, sehingga kamu bisa belajar banyak dengan nya.</p>\r\n<p>Bahkan kamu bisa berkesempatan untuk diajak kolaborasi menggarap sebuah proyek.</p>\r\n<p>Menjadi programmer otodidak memang butuh proses. Kalau boleh dikatakan, belajar secara otodidak justru waktunya akan lebih cepat dibanding orang yang kuliah. Kamu belajar dan fokus di pemrograman selama 1 tahun saja sudah bisa menguasai. Kalau kuliah, selama 4 tahun belum yakin bisa. Karena belajar secara otodidak akan lebih fokus. Selamat belajar!</p>', '2018/05/13/Tips-Cara-Menjadi-Programmer-Walaupun-Hanya-Secara-Otodidak', '1526184010', '', 'Berita', 'Programmer,Tips,Otodidak', 'Yes', 'Yes'),
(5, '3', 'bookblock-417570-unsplash.jpg', 'Tips Untuk Menjadi Lebih Kreatif', '<p>Apakah Anda merasa kreatif? atau sebaliknya, apakah Anda merasa tidak kreatif? Apapun jawaban&nbsp; Anda, Anda tetap bisa meningkatkan kreatifitas Anda. Apapun profesi Anda saat ini, anda dapat dengan mudah meningkatkan kreatifitas Anda melalui langkah-langkah menurut&nbsp;<a href=\"http://www.briantracy.com/\"><strong>Brian Tracy.</strong></a></p>\r\n<p>Mungkin Anda seringkali berpikir bahwa kreatifitas hanyalah milik sebagian orang saja, seperti penulis, ilmuwan, atau artis. Tidak, kreatifitas merupakan kemampuan alami manusia yang dianugrahkan oleh Allah seperti saat kita bernafas. Setiap orang mampu memiliki kreatifitas yang tinggi karena dia menginginkannya. Kreatifitas dapat dikembangkan dan ditingkatkan. Kreatifitas sama seperti otot kita, bila tidak kita latih dan gunakan secara baik, maka otot akan kehilangan kekuatannya.</p>\r\n<p>Untuk menjadi kreatif, Anda tidak perlu memiliki IQ atau kecerdasan yang tinggi. Banyak orang yang memiliki IQ tinggi tetapi&nbsp; tidak dapat melakukan apa-apa untuk membuat hidupnya lebih baik. Mereka hanya bekerja pada pekerjaan yang tidak mereka sukai, karena terpaksa, sehingga mereka bekerja hanya untuk gaji dan bekerja pada level jauh di bawah potensi mereka sesungguhnya.</p>\r\n<p>Sedangkan kecerdasan sebenarnya berhubungan dengan cara Anda bertindak dan bergerak. Jika Anda bertindak dengan cerdas, maka Anda cerdas. Kualitas kecerdasan (kejeniusan) seseorang dapat diukur melalui 3 hal dasar, yaitu :</p>\r\n<ul>\r\n<li><strong>Open Minded-ness.&nbsp;</strong>Semakin terbuka cara berpikir Anda, maka semakin terbuka dan kreatif terhadap ide baru dan pemecahan terhadap sebuah masalah.</li>\r\n<li><strong>Kemampuan konsentrasi dalam sebuah hal/masalah.&nbsp;</strong>Dalam kata lain, Anda harus memiliki kemampuan untuk fokus dalam sebuah hal atau masalah Anda.</li>\r\n<li><strong>Kemampuan untuk memecahkan masalah secara sistematis.&nbsp;</strong>Anda harus melihat sebuah masalah sebagai sebuah sistem, bukan sebuah masalah yang saling terpisah satu sama lain.</li>\r\n</ul>\r\n<p>Demikianlah 3 hal dasar yang dapat digunakan sebagai ukuran kecerdasan seseorang. Lalu bagaimana langkah untuk meningkatkan kreatifitas? Berikut 10 langkah mudah untuk meningkatkan kreatiifitas.</p>\r\n<ol>\r\n<li><strong> Ubahlah cara berpikir Anda dari negatif ke positif</strong></li>\r\n</ol>\r\n<p>Semakin positif cara berpikir Anda, membuat Anda semakin percaya diri dan optimis dalam menghadapi permasalahan. Selanjutnya Anda akan semakin kreatif dalam mencari solusi segala permasalahan Anda. Biasakanlah Anda mengatakan &ldquo;Ya ini merupakan kesempatan untuk menjadi lebih baik&rdquo; dalam menghadapi sebuah rintangan.</p>\r\n<ol start=\"2\">\r\n<li><strong> Tulislah secara detail mengenai situasi kesulitan yang Anda hadapi</strong></li>\r\n</ol>\r\n<p>Tulislah segala hal yang berkaitan dengan tantangan Anda, Apa yang menjadi penyebab Anda tertekan? Apa yang Anda kuatirkan? Kenapa Anda tidak bahagia? Ini bukan berarti berpikir negatif, tapi dengan menulisnya Anda selanjutnya akan berpikir untuk mencari jalan keluar dari permasalahan tersebut.</p>\r\n<ol start=\"3\">\r\n<li><strong> Selalu bertanya</strong></li>\r\n</ol>\r\n<p>Jangan terlalu cepat puas dengan jawaban singkat dari permasalahan Anda. Berlatihlah juga untuk menjawab sebuah permasalahan atau pertanyaan dari sudut pandang yang berbeda. Misalnya bisnis Anda sedang menurun, kenapa menurun? mengapa penjualannya menurun? apa karena semakin banyak kompetitor? atau karena produk Anda semakin menurun kualitasnya?&nbsp; Dengan semakin banyak pertanyaan yang dapat Anda buat, maka Anda akan terpacu untuk semakin kreatif mencari solusinya.</p>\r\n<ol start=\"4\">\r\n<li><strong> Definisikan Batasan, Buat Alternatif Solusi</strong></li>\r\n</ol>\r\n<p>Anda harus mampu mengidentifikasi apa saja yang menjadi batasan Anda untuk menyelesaikan permasalahan Anda. Kemudian Anda harus mencari alternatif-alternatif solusi sesuai dengan batasan yang Anda miliki.</p>\r\n<ol start=\"5\">\r\n<li><strong> Lakukan keputusan yang terbaik dari beberapa alternatif solusi yang Anda buat</strong></li>\r\n</ol>\r\n<p>Pilihkan keputusan yang terbaik setelah Anda membandingkannya dengan alternatif lainnya.</p>\r\n<ol start=\"6\">\r\n<li><strong> Buatlah Planning bila keputusan terbaik Anda tidak berjalan sesuai harapan Anda.</strong></li>\r\n</ol>\r\n<p>Anda harus menyiapkan rencana bila hasil evaluasi keputusan terbaik Anda tidak sesuai dengan tujuan awal Anda.</p>\r\n<ol start=\"7\">\r\n<li><strong> Tetapkan satuan pengukuran dalam keputusan Anda</strong></li>\r\n</ol>\r\n<p>Anda harus menetapkan ukuran untuk mengetahui perkembangan pencapaian tujuan Anda. Bagaimana cara Anda dapat mengetahui bahwa Anda sudah sukses?</p>\r\n<ol start=\"8\">\r\n<li><strong> Menerima semua tanggung jawab dari keputusan yang telah dibuat.</strong></li>\r\n</ol>\r\n<p>Anda harus berani menghadapi semua resiko dan hasil dari keputusan yang telah Anda buat.</p>\r\n<ol start=\"9\">\r\n<li><strong> Tentukan deadline</strong></li>\r\n</ol>\r\n<p>Anda harus menentukan deadline dari semua tujuan Anda. Misalkan Anda ingin tahun depan memiliki penghasilan per tahun sebesar 120 juta/tahun. Selanjutnya Anda mesti mem&nbsp;<em>break-down&nbsp;</em>apa saja yang Anda lakukan tiap bulan, tiap hari, tiap jam, bahkan tiap menit untuk mencapai tujuan Anda.</p>\r\n<ol start=\"10\">\r\n<li><strong> Anda harus Take Action (Bertindak)</strong></li>\r\n</ol>\r\n<p>Bertindaklah, sibukkanlah diri Anda, dan terus bergerak. Tentukan Prioritas Tujuan Anda. Semakin cepat Anda dan semakin jelas tujuan Anda, semakin kreatif diri Anda dalam mencapai tujuan Anda. Anda juga akan semakin banyak memiliki energi dan waktu untuk belajar. Semakin banyak belajar maka semakin cepat Anda dapat mengembangkan kapabilitas diri Anda dan mencapai sesuatu yang lebih baik bagi masa depan Anda.</p>\r\n<p>Demikian&nbsp;<em>10 langkah mudah meningkatkan kreatifitas Anda</em>. Ada komentar, silahkan !</p>\r\n<p>Salam sukses</p>', '2018/05/13/Tips-Untuk-Menjadi-Lebih-Kreatif', '1526184083', '', 'Berita', 'Tips,Kreatif', 'Yes', 'Yes'),
(6, '3', 'emre-gencer-364602-unsplash.jpg', 'Manfaat - Manfaat Mengkonsumsi Kopi', '<p>Kopi sering dijadikan sebagai pembuka dalam mengawali aktivitas panjang seharian.<br /> <br /> Mereka yang suka minum kopi beralasan, bahwa minum kopi di pagi hari dapat membuat pikiran lebih fresh dan meningkatkan suasana hati, yang hal ini sangat baik untuk mengawali aktivitas di pagi hari.<br /> <br /> Kopi juga diyakini masyarakat dapat mengurangi rasa kantuk, dimana ini karena kandungan kafeinnya. Minuman ini digemari baik oleh pria maupun wanita.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<ol>\r\n<li><strong> Mencegah dan Mengatasi Depresi</strong><br /> Penelitian menunjukan bahwa adanya keterkaitan antara kopi dengan turunnya resiko depresi pada seseorang. Yang paling rentan mengalami depresi adalah kaum wanita, kandungan di dalam kopi mampu berfungsi untuk melawan depresi.<br /> <br /> Sebuah penelitian menunjukan bahwa minum kopi mampu mengurangi resiko terkena depresi sebesar 10 persen, jika dibandingkan dengan orang-orang yang tidak minum kopi sama sekali.<br /> <br /> Penelitian lainnya juga menunjukan bahwa perempuan yang mengonsumsi kopi dua sampai tiga cangkir kopi dalam sehari, mengalami resiko lebih rendah sebesar 15 persen terkena depresi. Hal ini berdasarkan laporan di jurnal &ldquo;Archives of Internal Medicine&rdquo; pada tahun 2011.<br /> <br /> Hal yang unik, walaupun soda memiliki zat kafein di dalamnya, namum penelitian para ahli tidak menemukan adanya manfaat minuman bersoda untuk meminimalisir masalah depresi.<br /> <br /> Hal itu karena minuman bersoda yang tinggi akan kandungan gula. Oleh karena itu, agar Anda bisa memperoleh manfaat kopi secara maksimal, hendaknya tidak minum kopi dengan kandungan gula yang tinggi.<br /> <br /> Kopi mampu mengobati depresi serta menjadikan orang yang mengonsumsinya lebih ceria.<br /> <br /> <strong>2. Meningkatan Memori Otak</strong><br /> Minum kopi ternyata bermanfaat untuk merangsang peningkatan memori otak.<br /> <br /> Dari laman resmi<a href=\"https://press.rsna.org/timssnet/media/pressreleases/pr_target.cfm?ID=270\">RSNA.org</a>. Ada sebuah studi yang dilakukan pada tahun 2005, dipublikasian di Radiological Society of North America. Penelitian yang dilakukan tersebut menunjukan bahwa minum kopi memiliki keterkaitan dengan peningkatan memori otak.<br /> <br /> Dimana peneliti menemukan bahwa mereka yang minum dua cangkir kopi berkafein dalam sehari mengalami peningkatan memori jangka pendek.<br /> <br /> Peneliti menyimpulkan bahwa mengonsumsi 100 miligram kafein (sekitar dua cangkir kopi) mampu memberikan peningkatan aktivitas di daerah otak yang berhubungan dengan fungsi memori dan perhatian atau kemampuan fokus.<br /> <br /> Florian Koppelst&auml;tter, M.D., Ph.D, seorang radiolog dari Medical University Innsbruck di Austria, mengungkapkan bahwa kandungan kafein bekerja untuk membantu peningkatan kemampuan fungsi otak yang lebih tinggi.<br /> <br /> Dr. Koppelst&auml;tter dan rekan-rekannya membuat penelitian dengan menggunakan bantuan MRI, tujuannya untuk mengetahui manfaat konsumsi kafein pada aktivasi otak.<br /> <br /> Penelitian dengan menyertakan sebanyak 15 sukarelawan dewasa sehat, yang akan diteliti kondisi fungsi memori mereka.<br /> <br /> Dr. Koppelst&auml;tter menjelaskan fungsi memori sebagai aktivitas otak yang diperlukan untuk mengingat berbagai hal dalam waktu yang singkat. Seperti mengingat nomor telepon di buku telepon.<br /> <br /> Para relawan penelitian tersebut, ditunjukkan urutan gambar sederhana (berupa huruf A, B, C atau D) dan kemudian ditanya apakah gambar itu sama dengan yang ditampilkan dua gambar sebelumnya.<br /> <br /> Para relawan diminta untuk merespon dengan secepat mungkin menggunakan jari telunjuk kanannya untuk \"ya\" dan jari telunjuk kiri untuk \"tidak.\"<br /> <br /> Tugas ini dilakukan setelah periode 12 jam tanpa kafein dan empat jam tanpa paparan nikotin.<br /> <br /> Kemudian untuk yang kedua kali mereka diminta untuk melakukan tugas ini lagi, tetapi kondisinya agak sedikit berbeda, karena sebagian dari mereka diberikan asupan kafein secara acak.<br /> <br /> Hasilnya, mereka yang diberikan asupan kafein menunjukkan kecenderungan peningkatan memori jangka pendek dan reaksi yang lebih tanggap.<br /> <br /> Alat MRI menunjukkan adanya peningkatan aktivitas di daerah otak yang terletak di lobus frontal, dimana itu adalah bagian dari jaringan fungsi memori berada, serta peningkatan pada cingulum anterior, itu adalah bagian dari otak yang fungsinya mempengaruhi kemampuan perhatian.<br /> <br /> Dr. Koppelst&auml;tter menjelaskan dengan mesin MRI tim-nya dapat mengetahui bahwa kafein diberikan bisa memberikan efek peningkatan aktivitas neuron di otak.<br /> </li>\r\n</ol>\r\n<p>Mesin MRI | Sumber gambar:&nbsp;<a href=\"http://www.medkes.com/2013/03/pemeriksaan-fungsi-tubuh-dengan-mri.html\">Medkes.com</a><br /> <br /> Pada penelitian lainnya pada tahun 2007, peneliti menemukan bahwa wanita berusia 65 atau lebih yang rutin minum kopi ternyata mempunyai kemampuan yang lebih baik dalam tes memori.<br /> <br /> </p>\r\n<ol start=\"3\">\r\n<li><br /> <strong> Meningkatkan Kinerja dan Performa</strong><br /> Beberapa studi telah menemukan bahwa manfaat kopi mampu memperkuat daya tahan tubuh dalam menghadapi aktivitas sehari-hari. Pada sebuah penelitian yang dilakukan pada tahun 2008, mengungkapkan bahwa kandungan kafein berguna bagi para atlet.<br /> <br /> Mengonsumsi kafein bagi para atlet dapat meningkatkan ketahanan tubuhnya. Demikian juga, jika Anda ingin membuat tubuh kuat dan mampu bekerja secara maksimal maka konsumsi kafein. Hal ini berguna, terutama bagi Anda yang bekerja di pabrik yang membutuhkan fisik dan peforma prima.<br /> <br /> Dalam dunia kedokteran, zat kafein umumnya dipakai untuk memberikan rangsangan pada organ jantung dan merangsang produksi urin agar meningkat. Penggunaan zat kafein dalam dosis rendah mampu memberikan efek peningkatan stamina dan membantu menurunkan rasa sakit.<br /> <br /> Cara kafein bekerja di dalam tubuh yaitu dengan memberikan hambatan pada adenosin di dalam tubuh. Adenosim adalah senyawa yang ada di sel otak befungsi untuk memicu seseorang untuk tertidur atau mengantuk.<br /> <br /> Zat kafein bekerja dengan tidak memperlambat pergerakan sel-sel di dalam tubuh, tetapi kafein bekerja untuk menangkal fungsi dari adenosin sehingga memberikan efek berupa:</li>\r\n</ol>\r\n<ul>\r\n<li>Rasa mengantuk menurun</li>\r\n<li>Talu timbul rasa segar di badan.</li>\r\n<li>Mata dapat lebih lebar terbuka</li>\r\n<li>Muncul rasa sedikit gembira</li>\r\n<li>Tekanan darah agak meningkat</li>\r\n<li>Detak jantung meningkat</li>\r\n<li>Hati akan melepas gula ke aliran darah dengan lebih banyak, hal inlah yang memberikan tambahan tenaga bagi tubuh.</li>\r\n</ul>\r\n<p><br /> Dengan efek-efek yang ditimbulkan dari zat kafein tersebut, inilah yang membuat segala jenis produk minuman pembangkit stamina memiliki kandungan kafein di dalamnya.<br /> <br /> <strong>4. Membantu Mencegah Diabetes</strong><br /> Pada sebuah studi yang dilakukan, menemukan bahwa minum kopi memiliki kecendrungan untuk menurunkan resiko diabetes tipe 2.<br /> <br /> Pada sebuah laporan penelitian tahun 2012 yang dipublikasikan di &lsquo;Journal of Agricultural &amp; Food Chemistry&rsquo;. Mengungkapkan alasan tentang hubungan antara kopi dengan penurunan resiko diabetes.<br /> <br /> Hal ini karena kopi memiliki kandungan senyawa yang bekerja menghambat hIAPP. &nbsp;hIAPP merupakan polipeptida memicu munculnya serat protein abnormal yang mengakibatkan seseorang terkena diabetes.<br /> <br /> Serat protein abnormal umum ditemukan pada orang yang mengalami penyakit diabetes tipe 2.<br /> <br /> Kandungan kromium dan magnesium yang ada di dalam kopi juga bekerja untuk menekan resiko penyakit diabetes tipe II.<br /> <br /> Hanya saja dengan manfaat ini, bukan berarti Anda minum kopi dengan kandungan gula yang banyak di dalamnya. Tentunya untuk mencegah diabetes dengan memanfaatkan kopi, maka batasi gula yang digunakan.<br /> <br /> Kalau Anad mampu, konsumsilah kopi dengan rasa yang cenderung pahit, hal itu kalau Anda mampu. Minimalnya Anda mengurangi (agar tidak berlebih) penggunaan gula pada kopi.<br /> <br /> <strong>5. Mencegah Penyakit Parkinson</strong><br /> Penyakin Parkinson merupakan sebuah penyakit yang membuat penderitanya mengalami penurunan kemampuan saraf. Seorang petinju terkenal yang bernama Muhammad Ali mengalami penyakit ini.<br /> <br /> Munculnya penyakit parkinson karena kondisi matinya saraf penghasil dopamin di organ otak. Para ilmuwan belum menemukan obat untuk menyembuhkan Parkinson.<br /> <br /> Beberapa penelitian menemukan kesimpulan bahwa peminum kopi memiliki resiko Parkinson yang lebih rendah, bakan mengalami penurunan resiko hingga 50%.<br /> <br /> Dari laman&nbsp;<a href=\"https://www.ncbi.nlm.nih.gov/pubmed/10819950\">Ncbi.nlm.nih.gov</a>. Sebuah laporan penelitian yang dipublikasikan di laman tersebut, bertujuan untuk mengeksplorasi hubungan kopi dan asupan kafein dengan penurunan risiko penyakit parkinson. Penelitian dengan melibatkan 8004 orang laki-laki.<br /> <br /> Dalam sebuah laporan pada tahun 2010 yang dipublikasikan di &ldquo;Journal of American Medical Association&rdquo;. Sebuah penelitian menemukan bahwa kandungan kafein di dalam kopi mampu menurunkan resiko penyakit Parkinson.<br /> <br /> Kesimpulan penelitian menunjukkan bahwa asupan kopi dan kafein mampu secara signifikan menurunkan resiko penyakit parkinson. (JAMA. 2000;283:2674-2679)<br /> <br /> Disinyalir manfaat kopi untuk pencegahan penyakit parkinson ini karena adanya kandungan kafein di dalam kopi.</p>\r\n<p><strong>MORE FROM AROUND THE WEB</strong></p>\r\n<p><a href=\"http://mgid.com/advertisers?utm_source=widget&amp;utm_medium=text&amp;utm_campaign=add&amp;utm_content=141384\">by&nbsp;</a></p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"https://dengan_trik_ini_kamu_akan_menjadi_miliarder_dalam_waktu_2_bulan/\"><strong>Dengan trik ini, kamu akan menjadi miliarder dalam waktu 2 bulan!</strong></a></p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"https://rasa_sakit_di_sendi_akan_hilang_sekali_dan_untuk_selamanya/\"><strong>Rasa sakit di sendi akan hilang sekali dan untuk selamanya!</strong></a></p>\r\n<ol start=\"6\">\r\n<li><br /> <strong> Kopi Menurunkan Resiko Kanker</strong><br /> Kandungan kopi sudah dihubung-hubungkan dengan menurunnya risiko kanker, yaitu berupa penurunan risiko kanker hati, kanker endometrium, kanker payudara dan kanker prostat.<br /> <br /> Pada sebuah studi tahun 2008 di Swedia, hasil penelitian menyimpulkan bahwa dengan minum dua-tiga cangkir kopi dalam sehari mampu menurunkan risiko kanker payudara.<br /> <br /> Sebuah studi dari pihak Harvard School of Public Health, menemukan bahwa kopi dapat menurunkan risiko terkena kanker prostat. Manfaat ini bisa diperoleh dari kopi yang berkafein maupun kopi yang tidak mengandung kafein.<br /> <br /> Dari laman&nbsp;<a href=\"http://scienceblog.cancerresearchuk.org/2016/06/15/coffee-and-cancer-what-does-the-evidence-say/\">Cancerresearchuk.org</a>, Pada tahun 2015, World Cancer Research Fund (WCRF) melakukan analisa dari hasil 6 studi mengenai hubungan kopi dengan penurunan risiko kanker hati.<br /> <br /> WCRF menyimpulkan bahwa mengonsumsi kopi tampaknya mampu menurunkan risiko kanker hati. Hanya saja dari beberapa studi yang dianalisa tersebut, belum tentu bisa secara akurat melakukan perhitungan berbagai faktor risiko kanker hati, seperti faktor obesitas dan kebiasaan mengonsumsi minuman alkohol yang dilakukan audiens yang diteliti.<br /> <br /> Sehingga masih ada kemungkinan bahwa ada faktor lain selain kopi yang memperngaruhi hasil studi, misalnya bahwa bisa saja orang yang tidak minum kopi tetapi minum banyak alkohol, ataupun orang yang suka minum kopi tetapi dia tidak penah minum alkohol.<br /> <br /> Oleh karena itu penelitian ini belum bisa dikatakan akurat 100%.<br /> <br /> Masih dari laman Cancerresearchuk.org, terdapat beberapa bukti penelitian bahwa kopi mampu menurunkan risiko kanker rahim. Sebuah penelitian pada tahun 2013 menemukan bahwa perempuan yang minum secangkir kopi setiap hari mengalami penurunan risiko kanker rahim.<br /> <br /> Dalam studi yang ada tersebut, pihak IARC tidak mengomentari setiap jenis kopi (seperti instan atau espresso), dan mengomentari tenang cara penyajian kopi, seperti menambahkan susu, gula, dll<br /> <br /> Dari kesimpulan itu semua, sebenarnya sudah memperkuat dan memberikan tanda-tanda bahwa minum kopi memberikan manfaat untuk penurunan resiko beberapa jenis kanker.&nbsp;</li>\r\n<li><br /> <strong> Meningkatkan Metabolisme Tubuh dan Menurunkan Berat Badan</strong><br /> Pada sebuah penelitian pada tahun 1980, penelitian tersebut menemukan bahwa kopi yang memiliki kandungan kafein, berfungsi untuk meningkatkan metabolisme tubuh.<br /> <br /> Peneliti menyatakan bahwa manfaat kopi ini terlihat secara signifikan pada orang yang memiliki berat badan tidak obesitas.<br /> <br /> Adapun orang yang gemuk akan mendapatkan manfaat minum kopi berupa membantu penurunan kadar lemak di dalam tubuh, karena metabolisme tubuh yang meningkat. Dengan begitu, minum kopi dapat membantu menurunkan berat badan bagi mereka yang mengalami obesitas.<br /> <br /> Dari laman&nbsp;<a href=\"https://authoritynutrition.com/coffee-increase-metabolism/\">Authoritynutrition.com</a>. Kopi mengandung beberapa zat aktif biologis yang merangsang kerja metabolisme tubuh. Kandungan kafein bekerja untuk merangsang sistem saraf untuk mengoptimalkan proses pememecahan lemak di dalam tubuh.<br /> <br /> Studi menunjukkan bahwa kandungan kafein dapat meningkatkan tingkat metabolisme tubuh. Peningkatan metabolisme tubuh akan sejalan dengan peningkatan proses pembakaran lemak di dalam tubuh.<br /> <br /> Dalam jangka pendek, kafein meningkatkan tingkat metabolisme tubuh, serta meningkatkan pembakaran lemak.<br /> <br /> Dalam satu studi, menyimpulkan bahwa mengonsumsi kafein dapat menekan nafsu makan, terutama oleh pria.<br /> <br /> <strong>8. Kopi Tinggi Kandungan Antioksidan</strong><br /> Seorang peneliti bernama Edward Giovannucci, dari Harvard, pada sebuah penelitiannya yang diterbitkan di jurnal &ldquo;Cancer Epidemiology, Biomarkers &amp; Prevention,&rdquo;.<br /> <br /> Penelitian tersebut menemukan bahwa kopi memiliki kandungan antioksidan yang tinggi, bahkan setara pada sebagian sayuran dan buah-buahan.<br /> <br /> Pada sebuah studi yang dilakukan pada tahun 2005, menemukan bahwa kopi menjadi urutan pertama sebagai sumber kandungan antioksidan dalam pola makan orang-orang di Amerika Serikat.<br /> <br /> <strong>9. &nbsp;Menurunkan Risiko Alzheimer</strong><br /> Manfaat mengonsumsi kopi bisa meningkatkan kemampuan konsentrasi dan fokus, peforma kerja juga meningkat.<br /> <br /> Pada beberapa studi yang dilakukan para ilmuwan telah menemukan bahwa orang-orang (terutama wanita) yang rutin minum kopi memiliki risiko lebih rendah terkena penyakit Alzheimer dan demensia. Penurunan resiko bahkan bisa sampai 60 persen.<br /> <br /> <br /> <strong>10. Membantu Menurunkan Resiko Stroke</strong><br /> Ahli kesehatan menjelaskan bahwa kandungan kafein bisa meningkatkan tekanan darah. Hal ini benar, namum dampak peningkatan darah sangat kecil (sekitar 3-4 mm/Hg).<br /> <br /> Oleh karena itu, kopi tidak mengkhawatirkan bisa menyebabkan hipertensi, hanya saja bagi penderita tekanan darah tinggi perlu berhati-hati dengan kopi, dengan kata lain harus membatasi konsumsi kopi dan kafein secara umum.<br /> <br /> Penelitian tidak membenarkan mitos yang mengatakan bahwa kopi menyebabkan penyakit hati. Bahkan sebaliknya, minum kopi mampu untuk menurunkan resiko terkena penyakit hati.<br /> <br /> Terdapat beberapa penelitian yang menemukan bahwa minum kopi bermanfaat bagi wanita untuk menurunkan resiko penyakit hati.<br /> <br /> Minum kopi mampu mencegah seseorang mengalami primary sclerosing cholangitis (PSC), yaitu sebuah penyakit autoimun yang bahaya-nya cukup serius, yaitu bisa menyebabkan sirosis hati, gagal hati dan kanker.<br /> <br /> Bahkan untuk jenis penyakit lainnya, beberapa penelitian yang dilakukan ilmuwan memberikan kesimpulan bahwa rutin minum kopi mampu menurunkan resiko stroke sebesar 20%.<br /> <br /> Hanya saja, bagi mereka yang sudah terlanjur mengalami penyakit tekanan darah tinggi, maka tidak boleh mengonsumsi kopi dan kafein dalam jumlah yang banyak.</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p><strong>11. Mencegah Gigi Berlubang</strong><br /> Minum kopi hitam bermanfaat untuk mencegah gigi berlubang. Dimana para peneliti di Brazil menemukan bahwa kandungan di dalam kopi hitam mampu membunuh bakteri pada gigi.<br /> <br /> Tetapi manfaat ini hilang ketika mencampurkan gula atau susu ke dalam kopi. Dengan begitu, hanya kopi pahit yang bermanfaat untuk mencegah gigi berlubang.<br /> <br /> Manfaat Lainnya dari Minum Kopi:<br /> <br /> 12. Kopi bermanfaat untuk meningkatkan energi dan bisa membuat lebih cerdas. Selain itu, kopi juga bisa mengurangi rasa lelah, dan menimbulkan semangat.<br /> <br /> 13. Kandungan kafein di dalam kopi mampu meningkatkan performa fisik, meningkatkan adrenalin di dalam tubuh.<br /> <br /> 14. Kopi memiliki kandungan serat yang bermanfaat bagi tubuh. Satu gelas kopi memiliki kandungan setara dengan 1.8 gram serat. Dalam sehari, jumlah serat yang dibutuhkan tubuh yaitu 20-38 gram.<br /> <br /> 15. Minum kopi dapat menurunkan resiko terkena penyakit encok. Sebuah penelitian dengan melibatkan 50.000 pria menunjukan bahwa minum kopi dapat menurunkan resiko terkena encok.<br /> <br /> 16. Kopi bermanfaat untuk mencegah penyakit batu empedu. Penelitian pada tahun 2002 di Harvard menemukan kesimpulan penelitian bahwa wanita yang minum kopi mampu menurunkan risiko penyakit batu empedu. Hal ini juga berlaku bagi para pria berdasarkan studi lainnya yang telah dilakukan.<br /> <br /> 17. Minum kopi berkhasiat untuk meningkatkan stamina, kandungan kafein di dalam kopi mempengaruhi kinerja sel tubuh, yang menimubulkan perasaan segar di tubuh lebih lama.<br /> <br /> 18. Kopi dapat menjaga kesehatan mulut. Hal itu karena kopi memiliki sifat anti bakteri yang berguna untuk kebersihan di mulut.<br /> <br /> 19. Kopi bermanfaat untuk meningkatkan mood, dimana banyak orang yang tidak sadar merasakan lebih ceria setelah minum kopi.<br /> <br /> 20. Kopi dapat menjaga kesehatan kulit kepala. Penelitian menunjukan bahwa kandungan kafein di dalam kopi bermanfaat untuk meminimalisir kerontokan pada rambut. Kandungan antioksidan di dalam kopi juga bermanfaat untuk kesehatan kulit kepala.</p>', '2018/05/13/Manfaat---Manfaat-Mengkonsumsi-Kopi', '1526184252', '', 'Berita', 'Kopi', 'Yes', 'Yes'),
(7, '3', 'allef-vinicius-468838-unsplash.jpg', 'Cara Jitu Mengatur Keuangan Pribadi yang Baik', '<p>Mengelola keuangan pribadi amat penting bagi semua kalangan. Membuat pembukuan dapat dilakukan oleh semua orang, tak memandang status sosial ataupun gaji bulanan. Salah satu tujuannya adalah agar pengeluaran tak lebih besar daripada pemasukan. Jika sampai pengeluaran jumlahnya lebih besar, anda mungkin akan meminjam uang untuk menutupi kebutuhan dan akhirnya terlilit utang. Berikut ini adalah beberapa cara jitu mengelola keuangan pribadi, diantaranya:</p>\r\n<p><strong>Mulai menabung sejak dini</strong>. Biasakan untuk menabung karena akan berguna jika suatu saat anda mengalami masalah keuangan. Anda dapat menggunakan layanan Bank untuk men-debit otomatis sebagian gaji yang anda terima.<br /> <br /> Jika masih mungkin untuk meminjam atau menyewa, maka hindari membeli. Jika anda ingin sebuah barang yang hanya akan digunakan sekali atau 2 kali saja, sebaiknya tak perlu membeli. Anda dapat menyewa atau meminjam karena akan jauh lebih murah. Ini merupakan salah satu hal penting dalam manajemen pengelolaan keuangan. Semakin banyak dana yang bisa anda hemat, maka akan semakin baik.<br /> Jika berkeinginan mencicil barang, pilihlah angsuran yang DP besar. Dan akhirnya yang anda lihat jumlah total yang harus anda bayar. Misal anda memilih barang yang ber-DP kecil, lalu bunganya tinggi. Anda akan membayar hingga dua kali lipat harga barang tersebut. Oleh karena itu usahakan melunasi cicilan secepat mungkin.<br /> <strong>Mencari asuransi</strong>. Anda takkan pernah tahu kapan anda akan membutuhkan uang dalam jumlah banyak. Oleh karenanya amat disarankan agar anda mencari dan milih asuransi yang bisa menjaga keuangan anda di masa krisis.<br /> <strong>Gunakan kredit card</strong>. Banyak orang kurang suka memakai kredit card karena justru akan menyebabkan pemborosan. Pada dasarnya akan kembali lagi kepada pribadi anda sendiri.Orang yang telah terbiasa berhemat umumnya tidak akan mengalami masalah ketika memegang kartu kredit. Kartu kredit dibuat bukan untuk membuat anda boros, hanya saja banyak kalangan menyalah gunakannya. Bahkan jika anda tidak ingin kartu kredit, rasanya anda tetap harus memilikinya untuk menciptakan credit score.<br /> <br /> <strong>Buat pembukuan rapi dan teratur</strong>. Buatlah pembukuan tentang jumlah pemasukan dan pengeluaran perbulan. Dengan cara ini anda akan tahu mana yang harus diutamakan dan mana yang harus dinomorduakan. Jika jumlah pengeluaran jauh lebih besar melebihi pemasukan, maka sudah saatnya anda mulai mengelola keuangan dengan lebih baik &amp; bijak.<br /> Sisihkan sejumlah uang setiap hari. Berapapun jumlahnya, jika ditumpuk nantinya akan menjadi banyak. Contohnya setiap hari anda belanja dan menerima kembalian. Simpan saja uang kembalian itu kedalam celengan. Anda takkan merasa menyisihkan/menabung uang dengan cara seperti ini.<br /> Sekian ulasan kami tentang Cara Jitu Mengatur Keuangan Pribadi yang Baik, semoga apa yang telah kami paparkan dapat menjadi tambahan pengetahuan bagi kita bersama.</p>', '2018/05/13/Cara-Jitu-Mengatur-Keuangan-Pribadi-yang-Baik', '1526184439', '', 'Berita', 'Keuangan,Tips', 'Yes', 'Yes'),
(8, '3', 'pexels-photo.jpg', 'Tips Sukses Membangun Startup', '<p>Pertumbuhan bisnis baru di Indonesia meningkat tajam setiap tahunnya. Bisnis baru yang akrab disebut sebagai&nbsp;<em>startup</em>, memiliki berbagai bidang yang digeluti, hingga memiliki kelasnya tersendiri. Bisnis startup yang memiliki nilai lebih dari 1 milyar dolar Amerika akan dikategorikan ke dalam kelas unicorn. Saat ini, terdapat kurang lebih&nbsp;<a href=\"https://www.cbinsights.com/research-unicorn-companies\">225</a>&nbsp;<em>startup</em>&nbsp;di seluruh dunia yang berstatus unicorn. Ada empat startup asal Indonesia yang saat ini menyandang predikat tersebut. Untuk mencapai predikat tersebut tentunya setiap perusahaan memiliki&nbsp;tips membangun bisnis startup masing-masing.</p>\r\n<p>Mau tau bagaimana caranya untuk bersaing menjadi&nbsp;<em>startup</em>&nbsp;unicorn selanjutnya? Simak caranya berikut:</p>\r\n<p><strong>1.Meningkatkan kapasitas</strong></p>\r\n<p>Permasalahan yang sering dihadapi startup yang sedang berkembang adalah masalah kapasitas. Masalah kapasitas ini bisa dari segi teknis maupun non teknis. Contohnya seperti jumlah pekerja,&nbsp;<em>server</em>, dan perangkat-perangkat yang produktif. Tidak mungkin sebuah&nbsp;<em>startup</em>&nbsp;tumbuh dengan kapasitas yang stagnan seperti kondisi di awal. Untuk menjaga kapasitas agar bisa tetap sejalan dengan pertumbuhan namun tidak banyak pengeluaran&nbsp;<em>startup</em><em>&nbsp;</em>bisa mengoptimalkan dengan mulai mengurangi bagian-bagian yang kurang produktif untuk dialihkan ke bagian yang lebih produktif.</p>\r\n<ol start=\"2\">\r\n<li><strong> Pengujian, mengukur, dan analisis</strong></li>\r\n</ol>\r\n<p>Pekerjaan mempercepat pertumbuhan&nbsp;<em>startup</em>&nbsp;tidak bisa dilakukan secara instan. Semua harus dilakukan melalui proses panjang dan diperlukan perhitungan-perhitungan matang. Melakukan pengujian, pengukuran, dan analisis menjadi sebuah hal yang tidak bisa ditinggalkan. Keputusan mengenai pasar, pelanggan, pendapatan, produk, dan lainnya harus direncanakan secara matang dan terukur.</p>\r\n<ol start=\"3\">\r\n<li><strong> Menambahkan jalur&nbsp;</strong><em><strong>revenue</strong></em><strong>baru</strong></li>\r\n</ol>\r\n<p>Setelah sebuah startup berada cukup lama di dalam industri baru harusnya sudah mulai memikirkan untuk membuat jalur baru untuk menambah pendapatan. Misalnya dengan mengeluarkan fitur atau layanan premium yang bisa memberikan manfaat lebih ke pelanggan sekaligus menjadi aliran pendapatan baru.</p>\r\n<p>&nbsp;</p>\r\n<ol start=\"4\">\r\n<li><strong> Menyelaraskan dengan teknologi yang ada</strong></li>\r\n</ol>\r\n<p>Sebagai bisnis yang menjadikan teknologi sebagai denyut nadinya startup mau tidak mau harus up to date dengan teknologi. Bukan untuk masalah lain, dengan menyelaraskan dengan teknologi terkini startup bisa mencari celah untuk mengembangkan bisnisnya. Secara sederhana contohnya bisa dilihat dari perkembangan teknologi mobile, setiap startup yang mengikuti tren dengan meluncurkan aplikasi mobile tentu akan memiliki angka pertumbuhan dengan yang tidak. Anda tidak perlu bingung dalam membuat aplikasi mobile untuk bisnis startup Anda. Anda bisa mempercayakan solusi kebutuhan IT kepada<a href=\"http://geekgarden.id/\">GeekGarden Software House</a>. GeekGarden Software House adalah perusahaan jasa pembuat aplikasi mobile, baik aplikasi android maupun IOS. Selain itu, GeekGarden Software House juga menyediakan jasa pembuatan aplikasi berbasis website maupun website company profile dengan pengalaman lebih dari 10 tahun.</p>', '2018/05/13/Tips-Sukses-Membangun-Startup', '1526184667', '', 'Berita', 'Tips,Sukses,Startup', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`) VALUES
(1, 'title', 'blog'),
(2, 'tagline', 'website for study'),
(3, 'url', 'http://localhost/blog/'),
(4, 'icon', 'favicon.ico'),
(5, 'logo', 'BlogPost'),
(6, 'language_admin', 'English'),
(7, 'language_site', 'English'),
(8, 'max_post', '10'),
(9, 'max_text', 'Summary'),
(10, 'paging_post', '10'),
(11, 'paging_category', '10'),
(12, 'paging_tag', '10'),
(13, 'paging_comment', '10'),
(15, 'paging_page', '10'),
(16, 'paging_library', '10'),
(17, 'paging_user', '10'),
(18, 'theme', 'tema'),
(19, 'email', 'feriukita@gmail.com'),
(20, 'logo_img', 'apple-touch-icon.png'),
(21, 'default_category', 'Berita'),
(22, 'permalink', 'post-title'),
(23, 'default_permalink', 'detail-post'),
(24, 'medium_size', '500'),
(25, 'timezone', 'Asia/Jakarta'),
(26, 'paging_component', '10'),
(27, 'paging_theme', '10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tag`
--

INSERT INTO `tag` (`id`, `name`, `description`, `slug`) VALUES
(7, 'Programmer', '', ''),
(8, 'Tips', '', ''),
(9, 'Otodidak', '', ''),
(10, 'Kreatif', '', ''),
(11, 'Kopi', '', ''),
(12, 'Keuangan', '', ''),
(13, 'Sukses', '', ''),
(14, 'Startup', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `theme`
--

INSERT INTO `theme` (`id`, `name`) VALUES
(1, 'tema');

-- --------------------------------------------------------

--
-- Struktur dari tabel `traffic`
--

CREATE TABLE `traffic` (
  `id` int(11) NOT NULL,
  `vistor` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `traffic`
--

INSERT INTO `traffic` (`id`, `vistor`, `date`) VALUES
(2, '10', '2018-05-17'),
(3, '6', '2018-05-18'),
(4, '2', '2018-05-19'),
(5, '1', '2018-05-23'),
(6, '2', '2018-05-24'),
(7, '2', '2018-05-25'),
(8, '2', '2018-05-26'),
(9, '1', '2018-05-27'),
(10, '0', '2018-05-28'),
(11, '0', '2018-05-29'),
(12, '2', '2018-05-31'),
(13, '2', '2018-06-01'),
(14, '2', '2018-06-02'),
(15, '4', '2018-06-03'),
(16, '3', '2018-06-04'),
(17, '1', '2018-06-06'),
(18, '2', '2018-06-09'),
(19, '6', '2018-06-19'),
(20, '2', '2018-06-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `about` text NOT NULL,
  `img` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `about`, `img`, `role`) VALUES
(3, 'admin', '$2y$10$wMeFuxf2Yim2o8XOr28zTegTuCX9LbV0EPUOkJYIKgypb.oJVkvQe', 'admin', 'feriukita@gmail.com', '', '', '736185.png', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traffic`
--
ALTER TABLE `traffic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `traffic`
--
ALTER TABLE `traffic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
