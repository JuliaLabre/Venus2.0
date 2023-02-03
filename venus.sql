-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Fev-2023 às 20:48
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
('cat_girls', 1),
('cat_pets', 2),
('cat_beuty', 3),
('cat_decor', 4),
('cat_office', 5);

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

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`prod_id`, `shop`, `prod_date`, `prod_name`, `prod_photo`, `prod_size`, `prod_price`, `prod_stock`, `prod_desc`, `prod_cat`, `prod_status`, `views`) VALUES
(1, 3, '2023-02-02 16:32:31', 'Bolsa Glamour', 'https://img.freepik.com/fotos-gratis/feche-o-tiro-de-mulher-com-vestido-voador-de-verao-leve-segurando-uma-bolsa-de-malha-na-praia-mar-no-fundo_343596-1231.jpg?w=996&t=st=1674495137~exp=1674495737~hmac=7a92c292caca78174d49166c066d522d148e9f8518ef2d834f10d', '', 50, 3, 'Linda bolsa em Crôche, na cor marrom', 1, 'online', 0),
(2, 3, '2023-02-02 16:32:31', 'Bolsa', 'https://img.freepik.com/fotos-gratis/feche-o-tiro-de-mulher-com-vestido-voador-de-verao-leve-segurando-uma-bolsa-de-malha-na-praia-mar-no-fundo_343596-1231.jpg?w=996&t=st=1674495137~exp=1674495737~hmac=7a92c292caca78174d49166c066d522d148e9f8518ef2d834f10d', '', 50, 3, 'Linda bolsa em Crôche, na cor marrom', 1, 'online', 0),
(3, 3, '2023-02-02 19:42:03', 'Blusa Florida', '../photos/63dc120b67f8e.avif', '', 30, 2, 'Linda blusa florida', 1, 'online', 0);

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
  `user_type` enum('user','admin','shop') DEFAULT 'user',
  `last_login` datetime DEFAULT NULL,
  `user_status` enum('online','offline','banned','deleted') DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_date`, `user_name`, `user_gen`, `user_birth`, `user_CPF`, `user_email`, `user_password`, `user_CEPadress`, `user_comp`, `user_num`, `user_CEPbilling`, `user_photo`, `user_type`, `last_login`, `user_status`) VALUES
(1, '2023-02-02 16:32:31', 'Marineuza Siriliano', '', '2002-03-21', '13333333333', 'mari@neuza.com', '$2y$10$PDcffSzbeZ2.R.JVesp7MeO6i53Tovspzb0EjNO6tx7kzoIPcff7S', '23000000', '0', 0, '23000000', 'https://randomuser.me/api/portraits/women/72.jpg', 'user', NULL, 'online'),
(2, '2023-02-02 16:32:31', 'Admin Admin', '', '2002-03-21', '13333333332', 'admin@admin.com', '$2y$10$PDcffSzbeZ2.R.JVesp7MeO6i53Tovspzb0EjNO6tx7kzoIPcff7S', '23059020', '0', 0, '23059020', 'https://randomuser.me/api/portraits/women/75.jpg', 'admin', NULL, 'online'),
(3, '2023-02-02 16:32:31', 'Crocheteria', '', '2002-03-21', '13333333322', 'croche@teria.com', '$2y$10$WwLfPne8sDlcNqdkl5Vm.uy.BVk5FJ//YF.wgwBlgVOaC5GbGvxpi', '23059040', '0', 0, '23059040', 'https://randomuser.me/api/portraits/women/70.jpg', 'shop', NULL, 'online');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `cart_ibfk_1` (`id_prod`),
  ADD KEY `id_user` (`id_user`);

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
  ADD KEY `shop` (`shop`),
  ADD KEY `prod_cat` (`prod_cat`);

--
-- Índices para tabela `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `req_pay` (`req_pay`),
  ADD KEY `request_ibfk_1` (`client_cart`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`);

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
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`shop`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`prod_cat`) REFERENCES `category` (`cat_id`);

--
-- Limitadores para a tabela `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`client_cart`) REFERENCES `cart` (`id_cart`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`req_pay`) REFERENCES `pay` (`pay_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;