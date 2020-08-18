-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Ago-2020 às 23:08
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vsm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `idiomas`
--

CREATE TABLE `idiomas` (
  `id` int(11) NOT NULL,
  `portugues` text NOT NULL,
  `ingles` text NOT NULL,
  `espanhol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `id_imagem` int(11) NOT NULL,
  `id_postagem` int(11) NOT NULL,
  `conteudo` mediumblob NOT NULL,
  `criacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes_postagens`
--

CREATE TABLE `likes_postagens` (
  `id_postagem` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagens`
--

CREATE TABLE `postagens` (
  `id_postagem` int(11) NOT NULL,
  `id_pai` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` int(11) DEFAULT NULL COMMENT '1 = concordo; 0 = discordo; null = assunto raiz',
  `texto_conteudo` varchar(1024) NOT NULL,
  `criacao` datetime NOT NULL,
  `list_imagens` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`list_imagens`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `hsenha` varchar(80) NOT NULL,
  `foto_perfil` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE `videos` (
  `id_video` int(11) NOT NULL,
  `id_postagem` int(11) NOT NULL,
  `conteudo` longblob NOT NULL,
  `criacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id_imagem`);

--
-- Índices para tabela `likes_postagens`
--
ALTER TABLE `likes_postagens`
  ADD KEY `id_usuario_frgn2` (`id_usuario`),
  ADD KEY `id_postagem_frgn` (`id_postagem`);

--
-- Índices para tabela `postagens`
--
ALTER TABLE `postagens`
  ADD PRIMARY KEY (`id_postagem`),
  ADD KEY `id_pai_frgn` (`id_pai`),
  ADD KEY `id_usuario_frgn` (`id_usuario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postagens`
--
ALTER TABLE `postagens`
  MODIFY `id_postagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `likes_postagens`
--
ALTER TABLE `likes_postagens`
  ADD CONSTRAINT `id_postagem_frgn` FOREIGN KEY (`id_postagem`) REFERENCES `postagens` (`id_postagem`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_usuario_frgn2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `postagens`
--
ALTER TABLE `postagens`
  ADD CONSTRAINT `id_pai_frgn` FOREIGN KEY (`id_pai`) REFERENCES `postagens` (`id_postagem`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_usuario_frgn` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
