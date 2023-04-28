-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Kwi 2023, 23:08
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklepinternetowypai`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cartproduct`
--

CREATE TABLE `cartproduct` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `cartproduct`
--

INSERT INTO `cartproduct` (`id`, `user_id`, `product_id`, `product_quantity`) VALUES
(21, 51, 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Elektronika'),
(2, 'Moda'),
(7, 'Organizacje charytatywne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `favoriteproduct`
--

CREATE TABLE `favoriteproduct` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `favoriteproduct`
--

INSERT INTO `favoriteproduct` (`id`, `user_id`, `product_id`) VALUES
(10, 51, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lastwatchedproducts`
--

CREATE TABLE `lastwatchedproducts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `lastwatchedproducts`
--

INSERT INTO `lastwatchedproducts` (`id`, `user_id`, `product_id`) VALUES
(19, 51, 5),
(68, 51, 0),
(97, 51, 210),
(98, 51, 208),
(229, 51, 3),
(235, 51, 7),
(245, 51, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_value` float NOT NULL,
  `ship` float NOT NULL,
  `payment_type` varchar(25) NOT NULL,
  `shipping_adress` varchar(2000) NOT NULL,
  `ordered_products` varchar(2000) NOT NULL,
  `order_date` varchar(10) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_value`, `ship`, `payment_type`, `shipping_adress`, `ordered_products`, `order_date`, `status`) VALUES
(14, 51, 7984, 0, 'googlepay', 'a:1:{s:13:\"paczkomatCode\";s:6:\"LIM02M\";}', 'a:5:{i:0;a:2:{s:10:\"product_id\";s:1:\"4\";s:16:\"product_quantity\";s:1:\"1\";}i:1;a:2:{s:10:\"product_id\";s:1:\"3\";s:16:\"product_quantity\";s:1:\"9\";}i:2;a:2:{s:10:\"product_id\";s:1:\"7\";s:16:\"product_quantity\";s:1:\"2\";}i:3;a:2:{s:10:\"product_id\";s:3:\"208\";s:16:\"product_quantity\";s:1:\"1\";}i:4;a:2:{s:10:\"product_id\";s:3:\"209\";s:16:\"product_quantity\";s:1:\"1\";}}', '2023-04-23', 'Wysłane'),
(18, 51, 1712.99, 14.99, 'googlepay', 'a:6:{s:4:\"name\";s:5:\"Kamil\";s:7:\"surname\";s:8:\"Kowalski\";s:9:\"telephone\";s:9:\"123456789\";s:5:\"sreet\";s:14:\"Stara Wieś 18\";s:8:\"postcode\";s:6:\"34-600\";s:4:\"city\";s:8:\"Limanowa\";}', 'a:1:{i:0;a:2:{s:10:\"product_id\";s:3:\"208\";s:16:\"product_quantity\";s:1:\"2\";}}', '2023-04-23', 'Nowe'),
(19, 51, 15619.9, 19.99, 'blik', 'a:6:{s:4:\"name\";s:3:\"Jan\";s:7:\"surname\";s:8:\"Kowalski\";s:9:\"telephone\";s:9:\"777777777\";s:5:\"sreet\";s:15:\"Stara Wieś 901\";s:8:\"postcode\";s:6:\"34-600\";s:4:\"city\";s:8:\"Limanowa\";}', 'a:1:{i:0;a:2:{s:10:\"product_id\";s:1:\"4\";s:16:\"product_quantity\";s:1:\"6\";}}', '2023-04-24', 'Nowe'),
(20, 51, 23414.9, 14.99, 'blik', 'a:6:{s:4:\"name\";s:3:\"Jan\";s:7:\"surname\";s:8:\"Kowalski\";s:9:\"telephone\";s:9:\"111111111\";s:5:\"sreet\";s:15:\"Stara Wieś 901\";s:8:\"postcode\";s:6:\"34-600\";s:4:\"city\";s:8:\"Limanowa\";}', 'a:1:{i:0;a:2:{s:10:\"product_id\";s:1:\"4\";s:16:\"product_quantity\";s:1:\"9\";}}', '2023-04-24', 'Nowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_magazinePieces` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` varchar(25) NOT NULL,
  `product_regularPrice` varchar(25) NOT NULL,
  `product_properties` varchar(5000) NOT NULL,
  `product_description` mediumtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_img` varchar(2000) NOT NULL,
  `product_boughtCount` int(11) NOT NULL,
  `isSuspended` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`product_id`, `product_magazinePieces`, `product_title`, `product_price`, `product_regularPrice`, `product_properties`, `product_description`, `category_id`, `product_img`, `product_boughtCount`, `isSuspended`) VALUES
(3, 2, 'Czajnik elektryczny Adler AD1223 srebrny 1,7l', '80.00', '99.99', '', '', 1, 'a:3:{i:0;s:48:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg\";i:1;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg\";i:2;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg\";}', 0, 'no'),
(4, 0, 'Samsung Galaxy S22 5G SM-S901 8/128GB Czarny', '2599.99', '2798.00', 'a:6:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:11:\"Elektronika\";}i:1;a:2:{i:0;s:9:\"Producent\";i:1;s:7:\"SAMSUNG\";}i:2;a:2:{i:0;s:5:\"Kolor\";i:1;s:6:\"czarny\";}i:3;a:2:{i:0;s:12:\"Pamięć RAM\";i:1;s:3:\"8GB\";}i:4;a:2:{i:0;s:8:\"Pamięć\";i:1;s:5:\"128GB\";}i:5;a:2:{i:0;s:12:\"Kod produktu\";i:1;s:7:\"SM-S901\";}}', 'Za działanie Galaxy S22 odpowiada najszybszy w historii Galaxy procesor. Wykonany w procesie 4 nm i wspierany 8 GB RAM przyczynia się do szybkiej i energooszczędnej pracy smartfona. Możesz uruchomić nawet zaawansowaną grę 3D i nie zauważysz opóźnień. A możliwość szybkiego przetwarzania danych przełoży się na polepszenie jakości zdjęć i filmów. \r\n<br><br>\r\nGalaxy S22 dysponuje 3-krotnym zoomem optycznym wspomaganym optyczną stabilizacją obrazu (OIS). Nawet, jeśli fotografowany obiekt jest daleko, możesz wykonać zbliżenie i pokazać go, nie tracąc na jakości obrazu. \r\n<br><br>\r\nDodatkowo aparat używa nieskompresowanych danych, zawierających więcej szczegółów o kolorach, ostrości i kontraście, poprawiając Twoje fotografie. Smartfon wyposażono w baterię o pojemności 3700 mAh oraz wspiera szybkie ładowanie 25 W*. Wszystko po to, by umożliwić Ci jak najdłuższe oglądanie filmów, wideoczaty ze znajomymi czy granie oraz skrócenie czasu potrzebnego do naładowania baterii.\r\n<br><br>\r\n Z Galaxy S22 noce nabierają wspaniałych kolorów. Aparat w smartfonie otrzymał duże piksele (2 µm), które lepiej wyłapują światło, by nawet robione po zmierzchu zdjęcia i filmy zachwycały bogatą paletą barw, wiernością odwzorowania detali czy świetnym kontrastem. Dodatkowo aparat wspiera sztuczna inteligencja, która dobiera optymalne ustawienia.', 1, 'a:3:{i:0;s:48:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg\";i:1;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg\";i:2;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg\";}', 12, 'no'),
(5, 0, 'Procesor AMD Ryzen 9 5900X, 3.7 GHz, 64 MB, BOX (100-100000061WOF)', '1570.11', '1570.11', '', '', 1, 'a:3:{i:0;s:48:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg\";i:1;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg\";i:2;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg\";}', 0, 'no'),
(7, 0, 'Gigabyte B650 AORUS ELITE AX', '1249.00', '1449.00', '', '', 1, 'a:3:{i:0;s:48:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg\";i:1;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg\";i:2;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg\";}', 0, 'no'),
(208, 0, 'Corsair iCUE H150i RGB PRO XT 3x120mm', '849.00', '999.99', '', '', 1, 'a:3:{i:0;s:48:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg\";i:1;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg\";i:2;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg\";}', 0, 'no'),
(209, 0, 'Samsung 2TB M.2 PCIe Gen4 NVMe 990 PRO', '1119.00', '1119.00', '', '', 1, 'a:3:{i:0;s:48:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg\";i:1;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg\";i:2;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg\";}', 0, 'no'),
(210, 0, 'Acer Nitro VG240YBMIIX czarny', '599.00', '599.00', '', '', 1, 'a:3:{i:0;s:48:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg\";i:1;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg\";i:2;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg\";}', 0, 'no');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `createDate` varchar(10) NOT NULL,
  `monety` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `pass`, `createDate`, `monety`, `isAdmin`) VALUES
(51, 'Macinekk', 'tak@gmail.com', 'ofc', '2023-04-06', 0, 1),
(52, 'user52', 'marcingawron222@gmail.com', '123', '2023-04-07', 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cartproduct`
--
ALTER TABLE `cartproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksy dla tabeli `favoriteproduct`
--
ALTER TABLE `favoriteproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `lastwatchedproducts`
--
ALTER TABLE `lastwatchedproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `cartproduct`
--
ALTER TABLE `cartproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `favoriteproduct`
--
ALTER TABLE `favoriteproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `lastwatchedproducts`
--
ALTER TABLE `lastwatchedproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
