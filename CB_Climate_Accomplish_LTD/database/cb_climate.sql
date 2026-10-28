CREATE DATABASE IF NOT EXISTS cb_climate CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cb_climate;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','staff','customer') DEFAULT 'customer',
    phone VARCHAR(40),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(40) NOT NULL,
    email VARCHAR(190),
    address VARCHAR(255),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category ENUM('AC','CCTV','OTHER') DEFAULT 'AC',
    description TEXT,
    price DECIMAL(12,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    service_id INT NOT NULL,
    assigned_to INT NULL,
    status ENUM('pending','scheduled','in_progress','completed','cancelled') DEFAULT 'pending',
    scheduled_date DATETIME NULL,
    problem TEXT,
    solution TEXT,
    total_cost DECIMAL(12,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE RESTRICT,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NULL,
    customer_id INT NULL,
    original_name VARCHAR(255) NOT NULL,
    stored_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_type VARCHAR(100),
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

INSERT IGNORE INTO users (id,name,email,password,role) VALUES
(1,'CB Climate Admin','admin@cbclimate.rw','admin123','admin');

INSERT INTO services (name,category,description,price) VALUES
('AC Sales','AC','Supply and sale of air conditioners',0),
('AC Installation','AC','Professional AC installation',0),
('AC Repair','AC','Air conditioner diagnosis and repair',0),
('AC Maintenance','AC','Preventive AC maintenance',0),
('CCTV Installation','CCTV','CCTV camera installation and setup',0),
('CCTV Maintenance','CCTV','CCTV inspection and maintenance',0);
