DROP DATABASE IF EXISTS venushop;
CREATE DATABASE venushop CHARACTER SET utf8 COLLATE utf8_general_ci;
USE venushop;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_name VARCHAR (255) NOT NULL,
    user_birth DATE,
    user_CPF CHAR (14) NOT NULL,
    user_email VARCHAR (255) NOT NULL,
    user_password VARCHAR (255) NOT NULL,
    user_CEPadress VARCHAR (255) NOT NULL,
    user_CEPbilling VARCHAR (255) NOT NULL,
    user_photo VARCHAR (255),
    user_type ENUM ('user','admin','shop') DEFAULT 'user',
    last_login DATETIME,
    user_status ENUM ('online','offline','banned','deleted') DEFAULT 'online'
   
);

 INSERT INTO users(
     user_name,
     user_birth,
     user_CPF,
     user_email, 
     user_password,
     user_CEPadress,
     user_CEPbilling,
     user_photo,
     user_type   
) VALUES (
     'Marineuza Siriliano',
      '2002-03-21',
     '13333333333',
     'mari@neuza.com',
     '$2y$10$PDcffSzbeZ2.R.JVesp7MeO6i53Tovspzb0EjNO6tx7kzoIPcff7S',
     '23000000',
     '23000000',
     'https://randomuser.me/api/portraits/women/72.jpg',
     'user'
 ),(
     'Admin Admin',
      '2002-03-21',
     '13333333332',
     'admin@admin.com',
     '$2y$10$PDcffSzbeZ2.R.JVesp7MeO6i53Tovspzb0EjNO6tx7kzoIPcff7S',
     '23059020',
     '23059020',
     'https://randomuser.me/api/portraits/women/75.jpg',
     'admin'
 ),(
     'Crocheteria',
      '2002-03-21',
     '13333333322',
     'croche@teria.com',
     '$2y$10$PDcffSzbeZ2.R.JVesp7MeO6i53Tovspzb0EjNO6tx7kzoIPcff7S',
     '23059040',
     '23059040',
     'https://randomuser.me/api/portraits/women/70.jpg',
     'shop'
 );

CREATE TABLE products (
    prod_id INT PRIMARY KEY AUTO_INCREMENT,
    shop INT NOT NULL,
    prod_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    prod_name VARCHAR (255) NOT NULL,
    prod_photo VARCHAR (255) NOT NULL,
    prod_price DOUBLE,
    prod_stock INT,
    prod_desc VARCHAR (255) NOT NULL,
    prod_cat VARCHAR (255) NOT NULL,
    prod_status ENUM ('online','offline','banned','deleted') DEFAULT 'online',
    views INT DEFAULT 0,
    FOREIGN KEY (shop) REFERENCES users (user_id)
);

    INSERT INTO products (
        shop,
        prod_name,
        prod_photo,
        prod_price,
        prod_stock,
        prod_desc,
        prod_cat
    ) VALUES(
        '3',
        'Bolsa Glamour',
        'https://img.freepik.com/fotos-gratis/feche-o-tiro-de-mulher-com-vestido-voador-de-verao-leve-segurando-uma-bolsa-de-malha-na-praia-mar-no-fundo_343596-1231.jpg?w=996&t=st=1674495137~exp=1674495737~hmac=7a92c292caca78174d49166c066d522d148e9f8518ef2d834f10d54ca7eebe29',
        '50',
        '3',
        'Linda bolsa em Crôche, na cor marrom',
        'Acessórios'
    ),(
         '3',
        'Bolsa',
        'https://img.freepik.com/fotos-gratis/feche-o-tiro-de-mulher-com-vestido-voador-de-verao-leve-segurando-uma-bolsa-de-malha-na-praia-mar-no-fundo_343596-1231.jpg?w=996&t=st=1674495137~exp=1674495737~hmac=7a92c292caca78174d49166c066d522d148e9f8518ef2d834f10d54ca7eebe29',
        '50',
        '3',
        'Linda bolsa em Crôche, na cor marrom',
        'Acessórios'
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

CREATE TABLE cart(
     prod_name VARCHAR (255),
     quant INT

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