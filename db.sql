-- db.sql
CREATE DATABASE IF NOT EXISTS rentacar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rentacar;

-- Users (customers + admins)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  is_admin TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cars
CREATE TABLE cars (
  id INT AUTO_INCREMENT PRIMARY KEY,
  make VARCHAR(100) NOT NULL,
  model VARCHAR(100) NOT NULL,
  year INT,
  seats INT,
  price_per_day DECIMAL(8,2) NOT NULL,
  image VARCHAR(255),
  availability TINYINT(1) DEFAULT 1,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bookings
CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  car_id INT NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  status ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
);

-- Seed: admin and a few cars
INSERT INTO users (name,email,password,is_admin) VALUES
('Admin','admin@example.com', '$2y$10$XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX','1');

-- Password: vendos pas hashing me password_hash në PHP. (Ky është placeholder.)

INSERT INTO cars (make,model,year,seats,price_per_day,image,description)
VALUES
('Toyota','Corolla',2019,5,35.00,'assets/images/corolla.jpg','Gjashtë shpejtësi, i pastër, ekonomik.'),
('BMW','3 Series',2020,5,70.00,'assets/images/bmw3.jpg','Komod dhe i fuqishëm.'),
('Fiat','500',2018,4,28.00,'assets/images/fiat500.jpg','I vogël, ideal për qytet.');
