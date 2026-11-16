-- Jalankan di phpMyAdmin: tab "SQL" (atau Import)
CREATE DATABASE IF NOT EXISTS db_login CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_login;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama VARCHAR(100) NOT NULL,
  dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Pengguna contoh dibuat lewat setup_user.php (agar password ter-hash dengan aman)
