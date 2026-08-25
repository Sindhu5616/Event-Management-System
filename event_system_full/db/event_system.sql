-- event_system SQL setup
CREATE DATABASE IF NOT EXISTS event_system;
USE event_system;
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(150) UNIQUE,
  password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  description TEXT
);
CREATE TABLE IF NOT EXISTS packages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  price DECIMAL(10,2),
  description TEXT
);
CREATE TABLE IF NOT EXISTS slots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slot_date DATE,
  slot_time TIME,
  capacity INT,
  booked INT DEFAULT 0
);
CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(150),
  user_email VARCHAR(150),
  event_type VARCHAR(100),
  package_id INT,
  services TEXT,
  slot_id INT,
  ticket_code VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ticket_code VARCHAR(100),
  rating INT,
  comments TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
