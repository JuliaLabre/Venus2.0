DROP DATABASE IF EXISTS venushop;
CREATE DATABASE venushop CHARACTER SET utf8 COLLATE utf8_general_ci;
USE venushop;
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_name VARCHAR (255) NOT NULL,
    user_birth DATE,
    user_reg INT NOT NULL,
    user_email VARCHAR (255) NOT NULL,
    user_password VARCHAR (255) NOT NULL,
    user_adress VARCHAR (255) NOT NULL,
    user_billing VARCHAR (255) NOT NULL,
    user_photo VARCHAR (255),
    user_type ENUM ('user','admin','shop','deleted') DEFAULT 'user',
    last_login DATETIME,
    user_status ENUM ('online','offline','banned','deleted') DEFAULT 'online'
    --acrescentar sexo ?? deixar só o CEP, complemento e numero ??
);

 INSERT INTO users(
     user_name,
     user_birth,
     user_CPF,
     user_email, 
     user_password,
     user_CEPadress,
     user_CEPbilling,
     user_photo   
) VALUES (
     'Marineuza Siriliano',
      '2002-03-21',
     '13333333333',
     'mari@neuza.com',
     '$2y$10$PDcffSzbeZ2.R.JVesp7MeO6i53Tovspzb0EjNO6tx7kzoIPcff7S',
     '23000000',
     '23000000',
     'https://randomuser.me/api/portraits/women/72.jpg'
 );

CREATE TABLE products (
    prod_id INT PRIMARY KEY AUTO_INCREMENT,
    shop INT NOT NULL,
    prod_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    prod_name VARCHAR (255) NOT NULL,
    prod_photo VARCHAR (255) NOT NULL,
    prod_value DOUBLE,
    prod_stock INT,
    prod_desc VARCHAR (255) NOT NULL,
    prod_cat VARCHAR (255) NOT NULL,
    prod_status ENUM ('online','offline','banned','deleted') DEFAULT 'online',
    views INT DEFAULT 0,
    FOREIGN KEY (shop) REFERENCES users (user_id)
);
CREATE TABLE pay (
    pay_id INT PRIMARY KEY AUTO_INCREMENT,
    pay_type INT,
    pay_name VARCHAR (255),
    pay_active BIT
);
CREATE TABLE request (
    req_id INT PRIMARY KEY AUTO_INCREMENT,
    client INT NOT NULL,
    req_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   	req_pay INT,
    req_allvalue DOUBLE,
    req_adress INT,
    req_billing INT,
    req_status ENUM ('approved','negate','processing','canceled'),
    FOREIGN KEY (client) REFERENCES users (user_id),
    FOREIGN KEY (req_pay) REFERENCES pay (pay_id)
);
CREATE TABLE delivery (
    deli_id INT PRIMARY KEY AUTO_INCREMENT,
    cod_pay INT NOT NULL,
    deli_date DATE,
    deli_status ENUM ('delivered','in transit','not delivered'),
    status_date TIMESTAMP,
    FOREIGN KEY (cod_pay) REFERENCES request (req_id)
);

CREATE TABLE comments (
    com_id INT PRIMARY KEY AUTO_INCREMENT,
    com_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cautor INT NOT NULL,
    products INT NOT NULL,
    comment TEXT NOT NULL,
    com_status ENUM('online','offline','banned','deleted') DEFAULT 'online',
    FOREIGN KEY (cautor) REFERENCES users (user_id),
    FOREIGN KEY (products) REFERENCES products ( prod_id)
);