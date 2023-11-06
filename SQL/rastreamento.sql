- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Nov-2023 às 15:32
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rastreamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `deleted_at`, `created_at`, `updated_at`, `user_id`) VALUES
(131, 'Jogo', NULL, '2023-10-24 15:37:52', '2023-10-24 15:37:52', 1),
(138, 'Loja', NULL, '2023-10-25 13:31:19', '2023-10-25 13:47:02', 1),
(139, 'Queijo', NULL, '2023-10-25 13:31:32', '2023-10-25 13:31:32', 1),
(143, 'Cavalo', NULL, '2023-10-25 16:12:35', '2023-10-25 16:12:35', 1),
(146, 'vialo', NULL, '2023-10-26 14:15:19', '2023-10-26 14:15:19', 1),
(149, 'Voz', NULL, '2023-10-27 16:31:12', '2023-10-27 16:58:16', 1),
(150, 'ola', NULL, '2023-10-27 17:04:03', '2023-10-27 17:04:03', 1),
(167, 'ola', NULL, '2023-11-01 14:15:49', '2023-11-01 14:15:49', 1),
(168, 'Noz', NULL, '2023-11-01 15:39:00', '2023-11-03 14:26:53', 1),
(169, 'Vamos', NULL, '2023-11-01 15:43:50', '2023-11-01 15:43:50', 1),
(171, 'Star wars', NULL, '2023-11-01 16:07:44', '2023-11-01 16:07:44', 1),
(172, 'One piece', NULL, '2023-11-01 16:07:48', '2023-11-01 16:07:48', 1),
(173, 'Anime', NULL, '2023-11-01 16:07:52', '2023-11-01 16:07:52', 1),
(174, 'Spider-Man', NULL, '2023-11-01 16:07:57', '2023-11-01 16:07:57', 1),
(175, 'Elden ring', NULL, '2023-11-01 16:08:03', '2023-11-01 16:08:03', 1),
(176, 'Dark souls', NULL, '2023-11-01 16:08:08', '2023-11-01 16:08:08', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Antonio', 'antonio@marata.com.br', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(3, 'Jorge', 'jorge@marata.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(10, 'opa', 'gojo@gojo.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(31, 'Carlos', 'vaca@mail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(33, 'Pedro', 'carvão@mail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(39, 'Augusto', 'augusto@marata.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(47, 'Moto', 'moto@moto.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(50, 'Luffy', 'onepiece@anime.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL),
(55, 'Augusto Flávio', 'augusto.mendonca@marata.com.br', NULL, '5e8667a439c68f5145dd2fcbecf02209', NULL, NULL, NULL),
(56, 'php', 'php@php.com', NULL, '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL),
(57, 'padrao', 'padrao@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL),
(58, 'Velho', 'vamos@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL),
(60, 'Coelho', 'coelho@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_user_id` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
