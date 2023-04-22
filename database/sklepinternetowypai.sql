-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Kwi 2023, 22:48
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
(7, 51, 4, 1),
(10, 51, 3, 9);

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
(3, 'Motoryzacja');

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
(3, 51, 4),
(4, 51, 6);

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
(3, 51, 6);

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
  `ordered_products` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_value`, `ship`, `payment_type`, `shipping_adress`, `ordered_products`) VALUES
(10, 51, 3532.99, 14.99, 'blik', 'a:6:{s:4:\"name\";s:3:\"Jan\";s:7:\"surname\";s:8:\"Kowalski\";s:9:\"telephone\";s:9:\"111111111\";s:5:\"sreet\";s:15:\"Stara Wieś 901\";s:8:\"postcode\";s:6:\"34-600\";s:4:\"city\";s:8:\"Limanowa\";}', 'a:2:{i:0;a:2:{s:10:\"product_id\";s:1:\"4\";s:16:\"product_quantity\";s:1:\"1\";}i:1;a:2:{s:10:\"product_id\";s:1:\"3\";s:16:\"product_quantity\";s:1:\"9\";}}'),
(11, 51, 3532.99, 14.99, 'blik', 'a:6:{s:4:\"name\";s:3:\"Jan\";s:7:\"surname\";s:8:\"Kowalski\";s:9:\"telephone\";s:9:\"111111111\";s:5:\"sreet\";s:15:\"Stara Wieś 901\";s:8:\"postcode\";s:6:\"34-600\";s:4:\"city\";s:8:\"Limanowa\";}', 'a:2:{i:0;a:2:{s:10:\"product_id\";s:1:\"4\";s:16:\"product_quantity\";s:1:\"1\";}i:1;a:2:{s:10:\"product_id\";s:1:\"3\";s:16:\"product_quantity\";s:1:\"9\";}}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` varchar(25) NOT NULL,
  `product_description` varchar(2000) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_boughtCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`product_id`, `product_title`, `product_price`, `product_description`, `category_id`, `product_img`, `product_boughtCount`) VALUES
(3, 'Czajnik elektryczny Adler AD1223 srebrny 1,7l', '80.00', '', 1, 'https://duka.com/media/catalog/product/cache/88c2480cc32e03bb6d6f41df6024675d/1/2/1214343_16755108672_1.jpg', 0),
(4, 'Samsung Galaxy S22 5G SM-S901 8/128GB Czarny', '2798.00', '', 1, 'https://prod-api.mediaexpert.pl/api/images/gallery_500_500/thumbnails/images/35/3508342/Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg', 3),
(5, 'Procesor AMD Ryzen 9 5900X, 3.7 GHz, 64 MB, BOX (100-100000061WOF)', '1570.11', '', 1, 'https://images.morele.net/i1064/7267022_0_i1064.jpg', 0),
(7, 'Gigabyte B650 AORUS ELITE AX', '1249.00', '', 1, 'https://cdn.x-kom.pl/i/setup/images/prod/big/product-new-big,,2022/10/pr_2022_10_10_9_40_29_690_02.jpg', 0),
(208, 'Corsair iCUE H150i RGB PRO XT 3x120mm', '849.00', '', 1, 'https://cdn.x-kom.pl/i/setup/images/prod/big/product-new-big,,2020/1/pr_2020_1_30_12_7_50_593_03.jpg', 0),
(209, 'Samsung 2TB M.2 PCIe Gen4 NVMe 990 PRO', '1119.00', '', 1, 'https://cdn.x-kom.pl/i/setup/images/prod/big/product-new-big,,2022/10/pr_2022_10_20_6_19_50_837_00.jpg', 0),
(210, 'Acer Nitro VG240YBMIIX czarny', '599.00', '', 1, 'https://cdn.x-kom.pl/i/setup/images/prod/big/product-new-big,,2018/7/pr_2018_7_23_8_51_23_525_05.jpg', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `favoriteproduct`
--
ALTER TABLE `favoriteproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `lastwatchedproducts`
--
ALTER TABLE `lastwatchedproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
