CREATE DATABASE IF NOT EXISTS rekap_nilai;
USE rekap_nilai;

CREATE TABLE IF NOT EXISTS user (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255) NULL,
    username VARCHAR(255) NULL,
    password VARCHAR(255) NULL,
    PRIMARY KEY (id_user)
);

INSERT INTO user (nama, username, password) VALUES
('Administrator', 'admin', MD5('admin'));

CREATE TABLE IF NOT EXISTS nilai (
    id_nilai INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255) NULL,
    mapel VARCHAR(255) NULL,
    tugas INT(11) NULL,
    uts INT(11) NULL,
    uas INT(11) NULL,
    nilai_akhir DECIMAL(5,2) NULL,
    PRIMARY KEY (id_nilai)
);
