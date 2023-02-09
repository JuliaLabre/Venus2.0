-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Fev-2023 às 20:52
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `venushop`
--
CREATE DATABASE IF NOT EXISTS `venushop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `venushop`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'admin@admin.com', '$2y$10$g4j9l/A4XnkZbcpVjHi4Le3prr3KZU8tsVNFPTcpW.VAZFLTBCwiG');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `quant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `cat_name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`cat_name`, `cat_id`) VALUES
('Moças', 1),
('Pets', 2),
('Beleza', 3),
('Deco&Casa', 4),
('Escritório', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `com_req` int(11) NOT NULL,
  `comment` text NOT NULL,
  `com_status` enum('online','offline','banned','deleted') DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `delivery`
--

CREATE TABLE `delivery` (
  `deli_id` int(11) NOT NULL,
  `cod_pay` int(11) NOT NULL,
  `deli_date` date DEFAULT NULL,
  `deli_status` enum('delivered','in transit','not delivered') DEFAULT NULL,
  `status_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pay`
--

CREATE TABLE `pay` (
  `pay_id` int(11) NOT NULL,
  `pay_type` int(11) DEFAULT NULL,
  `pay_name` varchar(255) DEFAULT NULL,
  `pay_active` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `shop` int(11) NOT NULL,
  `prod_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `prod_name` varchar(255) NOT NULL,
  `prod_photo` varchar(255) NOT NULL,
  `prod_size` varchar(4) NOT NULL,
  `prod_price` double DEFAULT NULL,
  `prod_stock` int(11) DEFAULT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `prod_cat` int(11) NOT NULL,
  `prod_status` enum('online','offline','banned','deleted') DEFAULT 'online',
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `request`
--

CREATE TABLE `request` (
  `req_id` int(11) NOT NULL,
  `client_cart` int(11) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_pay` int(11) DEFAULT NULL,
  `req_allvalue` double DEFAULT NULL,
  `req_adress` int(11) DEFAULT NULL,
  `req_comp` varchar(100) NOT NULL,
  `req_num` int(11) NOT NULL,
  `req_fret` double NOT NULL,
  `req_status` enum('approved','negate','processing','canceled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shop_name` varchar(255) NOT NULL,
  `shop_CNPJ` char(14) NOT NULL,
  `shop_email` varchar(255) NOT NULL,
  `shop_password` varchar(255) NOT NULL,
  `shop_photo` varchar(255) NOT NULL,
  `shop_lastlogin` datetime NOT NULL,
  `shop_status` enum('online','offline','banned','deleted') NOT NULL DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_date`, `shop_name`, `shop_CNPJ`, `shop_email`, `shop_password`, `shop_photo`, `shop_lastlogin`, `shop_status`) VALUES
(1, '2023-02-09 17:26:07', 'Crocheteria', '12345678912345', 'croche@teria.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '', '2023-02-09 18:18:15', 'online'),
(2, '2023-02-09 17:26:10', 'Costurices da Lu', '01472589630258', 'costu@rices.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '', '2023-02-09 18:18:15', 'online'),
(3, '2023-02-09 17:26:15', 'Picolés da Lê', '78945612307894', 'pi@cole.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '', '2023-02-09 18:19:52', 'online'),
(4, '2023-02-09 17:26:17', 'Camisolaria', '12345678912355', 'cami@sola.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '', '2023-02-09 18:19:52', 'online');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) NOT NULL,
  `user_gen` varchar(1) NOT NULL,
  `user_birth` date DEFAULT NULL,
  `user_CPF` char(14) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_CEPadress` varchar(255) NOT NULL,
  `user_comp` varchar(100) NOT NULL,
  `user_num` int(11) NOT NULL,
  `user_CEPbilling` varchar(255) NOT NULL,
  `user_photo` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `user_status` enum('online','offline','banned','deleted') DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_date`, `user_name`, `user_gen`, `user_birth`, `user_CPF`, `user_email`, `user_password`, `user_CEPadress`, `user_comp`, `user_num`, `user_CEPbilling`, `user_photo`, `last_login`, `user_status`) VALUES
(4, '2023-02-09 17:18:06', 'Josefina Silva', 'F', '1995-02-17', '12345678910', 'jose@fina.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '23059020', 'Fundos', 55, '23059020', '../photousers/63e54472daf0b.avif', NULL, 'online'),
(5, '2023-02-09 17:18:06', 'Cicrano Souza', 'M', '1995-06-25', '12345665412', 'ci@crano.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '23059020', 'Casa 1', 55, '23059020', NULL, NULL, 'online');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Índices para tabela `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Índices para tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `comments_ibfk_2` (`com_req`);

--
-- Índices para tabela `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deli_id`),
  ADD KEY `cod_pay` (`cod_pay`);

--
-- Índices para tabela `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`pay_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `prod_cat` (`prod_cat`),
  ADD KEY `shop` (`shop`);

--
-- Índices para tabela `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`req_id`);

--
-- Índices para tabela `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deli_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pay`
--
ALTER TABLE `pay`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `request`
--
ALTER TABLE `request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`com_req`) REFERENCES `request` (`req_id`);

--
-- Limitadores para a tabela `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`cod_pay`) REFERENCES `request` (`req_id`);

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`prod_cat`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`shop`) REFERENCES `shop` (`shop_id`);

--
-- Limitadores para a tabela `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`req_pay`) REFERENCES `pay` (`pay_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
