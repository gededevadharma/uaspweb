CREATE DATABASE IF NOT EXISTS db_perpus;
USE db_perpus;

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    level ENUM('admin') DEFAULT 'admin',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE buku (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    pengarang VARCHAR(150) DEFAULT NULL,
    penerbit VARCHAR(150) DEFAULT NULL,
    isbn VARCHAR(20) DEFAULT NULL UNIQUE,
    tahun INT(4) DEFAULT NULL,
    jumlah INT(5) DEFAULT 1,
    tersedia INT(5) DEFAULT 1,
    deskripsi TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE peminjam (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE peminjaman (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    peminjam_id INT(11) NOT NULL,
    buku_id INT(11) NOT NULL,
    tgl_pinjam DATE NOT NULL,
    tgl_kembali DATE NOT NULL,
    tgl_dikembalikan DATE DEFAULT NULL,
    status ENUM('dipinjam','dikembalikan') DEFAULT 'dipinjam',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (peminjam_id) REFERENCES peminjam(id) ON DELETE CASCADE,
    FOREIGN KEY (buku_id) REFERENCES buku(id) ON DELETE CASCADE
);

-- Password: 123123
INSERT INTO users (username, password, nama, email, level) VALUES
('admin', '$2y$10$LeWx.F5eZfqrkOA3cG/hreiEBIFdfwhsT/GIYEuTvSwiihrqks3G6', 'Administrator', 'admin@perpustakaan.com', 'admin');

INSERT INTO buku (judul, pengarang, penerbit, isbn, tahun, jumlah, tersedia, deskripsi) VALUES
('Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', '9789793062792', 2005, 5, 5, 'Novel tentang perjuangan anak-anak di Belitung Timur'),
('Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', '9789799731209', 1980, 3, 3, 'Novel sejarah Indonesia masa kolonial'),
('Perahu Kertas', 'Dee Lestari', 'Bentang Pustaka', '9789791227913', 2009, 4, 4, 'Kisah persahabatan dan cinta anak muda'),
('Sang Pemimpi', 'Andrea Hirata', 'Bentang Pustaka', '9789793062808', 2006, 3, 3, 'Sekuel Laskar Pelangi'),
('Ronggeng Dukuh Paruk', 'Ahmad Tohari', 'Gramedia Pustaka Utama', '9789796868133', 1982, 2, 2, 'Kisah kehidupan pedesaan Jawa'),
('Atomic Habits', 'James Clear', 'Penguin Random House', '9780735211292', 2018, 5, 5, 'Cara mudah membangun kebiasaan baik'),
('Sapiens', 'Yuval Noah Harari', 'HarperCollins', '9780062316097', 2015, 3, 3, 'Sejarah singkat umat manusia'),
('Harry Potter and the Philosopher''s Stone', 'J.K. Rowling', 'Bloomsbury', '9780747532743', 1997, 4, 4, 'Petualangan penyihir muda'),
('Filosofi Teras', 'Henry Manampiring', 'Kompas Media', '9786233460527', 2018, 4, 4, 'Filsafat Stoa untuk kehidupan modern'),
('The Alchemist', 'Paulo Coelho', 'HarperOne', '9780062315007', 1988, 3, 3, 'Perjalanan seorang gembala mencari harta karun'),
('Pulang', 'Leila S. Chudori', 'Kepustakaan Populer Gramedia', '9789799106489', 2012, 2, 2, 'Kisah eksil Indonesia di Paris'),
('Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia Pustaka Utama', '9789792258251', 2009, 4, 4, 'Kisah santri di pondok modern'),
('Dilan: Dia adalah Dilanku', 'Pidi Baiq', 'Pastel Books', '9786021201545', 2014, 5, 5, 'Romansa anak SMA di Bandung'),
('Habis Gelap Terbitlah Terang', 'R.A. Kartini', 'Balai Pustaka', '9789796661109', 1911, 2, 2, 'Kumpulan surat-surat R.A. Kartini'),
('Tenggelamnya Kapal Van Der Wijck', 'Hamka', 'Gema Insani', '9789791600316', 1938, 3, 3, 'Kisah cinta yang tragis di tanah Minang');
