CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_item INT,
    quantite INT DEFAULT 0,
    FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_item INT,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE
);

CREATE TABLE invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
    montant DECIMAL(10,2),
    adresse_facturation VARCHAR(255),
    ville VARCHAR(100),
    code_postal VARCHAR(10),
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (nom, email, password, role) 
VALUES ('Administrateur', 'admin@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');