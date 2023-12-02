SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  

INSERT INTO `products` (`id`, `name`, `price`, `description`) VALUES 
(NULL, 'Crayon', '2', 'Un super crayon en bois !'), 
(NULL, 'Chaise', '30', 'Avec des finitions en métal');