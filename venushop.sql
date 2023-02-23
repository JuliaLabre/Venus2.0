-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Fev-2023 às 14:58
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
-- Estrutura da tabela `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `quant` int(11) NOT NULL,
  `price` double NOT NULL
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
('Artesanato', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_date` date NOT NULL,
  `produto` int(11) NOT NULL,
  `com_name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `com_status` enum('online','offline','banned','deleted') NOT NULL DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`com_id`, `com_date`, `produto`, `com_name`, `comment`, `com_status`) VALUES
(3, '2023-02-20', 9, 'Cicrano Souza', 'Linda bolsa, qualidade impecavél.', 'online'),
(4, '2023-02-20', 13, 'Cicrano Souza', 'Mesa linda demais!', 'online'),
(5, '2023-02-21', 7, ' Josefina Silva', 'Muito lindo, vale a pena!!', 'online');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('sended','readed','responded','deleted') DEFAULT 'sended',
  `receiver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `contacts`
--

INSERT INTO `contacts` (`id`, `date`, `name`, `email`, `subject`, `message`, `status`, `receiver`) VALUES
(1, '2023-02-17 18:41:00', 'Teste', 'teste@teste.com', 'Não aguento mais', 'Não estou disposto a tanto erro', 'sended', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contactshop`
--

CREATE TABLE `contactshop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `contactshop`
--

INSERT INTO `contactshop` (`id`, `name`, `email`, `subject`, `message`, `address`) VALUES
(1, 'Teste', 'teste@teste.com', 'teste', 'Mais um teste', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `delivery`
--

CREATE TABLE `delivery` (
  `deli_id` int(11) NOT NULL,
  `deli_sale` int(11) NOT NULL,
  `deli_status` enum('Em Separação','Em Trânsito','Entregue','Cancelado') NOT NULL DEFAULT 'Em Separação',
  `deli_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `delivery`
--

INSERT INTO `delivery` (`deli_id`, `deli_sale`, `deli_status`, `deli_date`) VALUES
(1, 3, 'Em Separação', '0000-00-00'),
(2, 4, 'Em Separação', '0000-00-00'),
(3, 5, 'Em Separação', '0000-00-00'),
(4, 8, 'Em Separação', '2023-02-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorite`
--

CREATE TABLE `favorite` (
  `fav_id` int(11) NOT NULL,
  `fav_user` int(11) NOT NULL,
  `fav_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `favorite`
--

INSERT INTO `favorite` (`fav_id`, `fav_user`, `fav_prod`) VALUES
(2, 4, 11),
(4, 4, 9),
(5, 4, 8),
(11, 4, 13),
(21, 4, 4),
(30, 4, 12);

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

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`prod_id`, `shop`, `prod_date`, `prod_name`, `prod_photo`, `prod_size`, `prod_price`, `prod_stock`, `prod_desc`, `prod_cat`, `prod_status`, `views`) VALUES
(4, 1, '2023-02-10 18:55:55', 'Anjinho em croche', '../photos/63e6933b41cb8.jpg', 'P', 50, 0, 'Lindo anjinho para enfeitar, bricar e funciona também como naninha', 5, 'online', 0),
(5, 1, '2023-02-10 18:57:16', 'Bolsa Marrom', '../photos/63e6938c73dea.jpg', 'M', 150, 2, 'Linda Bolsa colorida, ideal para qualquer passeio.', 5, 'online', 0),
(6, 3, '2023-02-10 19:01:26', 'Picolés tropicais', '../photos/63e69486bbad5.avif', '', 5, 50, 'Pricolés tropicais maravilhosos', 1, 'deleted', 0),
(7, 3, '2023-02-10 19:02:02', 'Tapete Branco', '../photos/63ecdb4641e3c.avif', 'G', 150, 3, 'Lindo e facil de limpar', 4, 'online', 0),
(8, 2, '2023-02-10 19:05:58', 'Ecobag', '../photos/63e695962bbe7.avif', '', 15, 9, 'Ultimas unidades em promoção', 1, 'online', 0),
(9, 2, '2023-02-10 19:06:46', 'Ecobag Personalizada', '../photos/63e695c6ed9b1.avif', '', 25, 22, 'Linda Ecobag, fazemos também personalizada', 1, 'online', 0),
(10, 4, '2023-02-10 19:08:01', 'Kit Brinquedos', '../photos/63ecdc359e2fe.avif', 'G', 55, 7, '2 bolinhas e 3 ossos', 2, 'online', 0),
(11, 4, '2023-02-10 19:08:38', 'Case para saco de recolher', '../photos/63ecdc446fb25.avif', 'P', 49, 5, 'Case para levar as suas sacolinhas de forma deslumbrante', 2, 'online', 0),
(12, 1, '2023-02-15 12:28:33', 'Cama em Croche', '../photos/63eccff146deb.avif', 'G', 100, 2, 'Aconchegante, lindo e sustentavel.', 2, 'online', 0),
(13, 3, '2023-02-15 13:18:03', 'Mesa de Madeira', '../photos/63ecdb8bced93.avif', '', 99, 5, 'Linda Mesinha de madeira', 4, 'online', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `request`
--

CREATE TABLE `request` (
  `req_id` int(11) NOT NULL,
  `req_prod` int(11) NOT NULL,
  `req_sale` int(11) NOT NULL,
  `req_quant` int(11) NOT NULL,
  `req_value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `request`
--

INSERT INTO `request` (`req_id`, `req_prod`, `req_sale`, `req_quant`, `req_value`) VALUES
(1, 9, 1, 2, 25),
(2, 13, 2, 1, 99),
(3, 7, 2, 1, 150),
(4, 4, 3, 1, 50),
(5, 7, 4, 1, 150),
(6, 9, 5, 1, 25),
(7, 8, 5, 1, 15),
(8, 10, 5, 3, 55),
(9, 4, 8, 1, 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) NOT NULL,
  `sale_client` int(11) NOT NULL,
  `sale_value` double NOT NULL,
  `sale_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `sale`
--

INSERT INTO `sale` (`sale_id`, `sale_client`, `sale_value`, `sale_date`) VALUES
(1, 5, 50, '2023-02-20'),
(2, 5, 249, '2023-02-20'),
(3, 5, 50, '2023-02-20'),
(4, 4, 150, '2023-02-21'),
(5, 4, 205, '2023-02-23'),
(6, 4, 50, '2023-02-23'),
(7, 4, 50, '2023-02-23'),
(8, 4, 50, '2023-02-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shop_name` varchar(255) NOT NULL,
  `shop_desc` text NOT NULL,
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

INSERT INTO `shop` (`shop_id`, `shop_date`, `shop_name`, `shop_desc`, `shop_CNPJ`, `shop_email`, `shop_password`, `shop_photo`, `shop_lastlogin`, `shop_status`) VALUES
(1, '2023-02-10 19:14:00', 'Crocheteria', 'Trabalho com Croches de forma em geral.', '12345678912345', 'croche@teria.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '../photoshop/63e690a350dd6.avif', '2023-02-09 18:18:15', 'online'),
(2, '2023-02-10 19:14:16', 'Costurices da Lu', 'Trabalho com personalizados.', '01472589630258', 'costu@rices.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '../photoshop/63e6957529a88.avif', '2023-02-09 18:18:15', 'online'),
(3, '2023-02-15 13:14:20', 'DecoRê', 'Sua casa mais bonita!', '78945612307894', 'deco@re.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '../photoshop/63ecdaace9dc1.avif', '2023-02-09 18:19:52', 'online'),
(4, '2023-02-15 13:19:47', 'PetLandia', 'o mundo do seu pet', '12345678912355', 'pet@landia.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '../photoshop/63ecdbf33dcf5.avif', '2023-02-09 18:19:52', 'online');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) NOT NULL,
  `user_tel` varchar(11) NOT NULL,
  `user_gen` enum('Feminino','Masculino','Outro') NOT NULL,
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
  `user_status` enum('online','offline','banned','deleted') DEFAULT 'online',
  `user_type` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_date`, `user_name`, `user_tel`, `user_gen`, `user_birth`, `user_CPF`, `user_email`, `user_password`, `user_CEPadress`, `user_comp`, `user_num`, `user_CEPbilling`, `user_photo`, `last_login`, `user_status`, `user_type`) VALUES
(4, '2023-02-09 17:18:06', ' Josefina Silva', ' 2197577012', 'Feminino', '1995-02-17', '12345678910', 'jose@fina.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '23059020', '0', 55, '23059020', '../photousers/63e54472daf0b.avif', NULL, 'online', 'user'),
(5, '2023-02-09 17:18:06', 'Cicrano Souza', '', 'Masculino', '1995-06-25', '12345665412', 'ci@crano.com', '$2y$10$l0XLl25pV5GUSXq5OeYkQuWpHvybVbPAdOH1aDsXxnbGsaDP1YWuW', '23059020', 'Casa 1', 55, '23059020', NULL, NULL, 'online', 'user'),
(6, '2023-02-14 17:32:03', 'Admin', '', 'Feminino', '1995-02-17', '111111111111', 'admin@admin.com', '$2y$10$.C1e.8NZxDbJxixH9UvMpe.pQncwmrxYBuFzERu/Wf0Ees.yzres.', '11111111', '11', 0, '11111111', NULL, NULL, 'online', 'admin');

--
-- Índices para tabelas despejadas
--

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
  ADD KEY `comments_ibfk_1` (`produto`);

--
-- Índices para tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver` (`receiver`);

--
-- Índices para tabela `contactshop`
--
ALTER TABLE `contactshop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`);

--
-- Índices para tabela `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deli_id`),
  ADD KEY `delivery_ibfk_1` (`deli_sale`);

--
-- Índices para tabela `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `fav_prod` (`fav_prod`),
  ADD KEY `fav_user` (`fav_user`);

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
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `req_prod` (`req_prod`),
  ADD KEY `req_sale` (`req_sale`);

--
-- Índices para tabela `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `sale_client` (`sale_client`);

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
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `contactshop`
--
ALTER TABLE `contactshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `favorite`
--
ALTER TABLE `favorite`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `request`
--
ALTER TABLE `request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `products` (`prod_id`);

--
-- Limitadores para a tabela `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`receiver`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `contactshop`
--
ALTER TABLE `contactshop`
  ADD CONSTRAINT `contactshop_ibfk_1` FOREIGN KEY (`address`) REFERENCES `shop` (`shop_id`);

--
-- Limitadores para a tabela `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`deli_sale`) REFERENCES `sale` (`sale_id`);

--
-- Limitadores para a tabela `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`fav_prod`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`fav_user`) REFERENCES `users` (`user_id`);

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
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`req_prod`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`req_sale`) REFERENCES `sale` (`sale_id`);

--
-- Limitadores para a tabela `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`sale_client`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
