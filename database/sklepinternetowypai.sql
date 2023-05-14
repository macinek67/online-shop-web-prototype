-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Maj 2023, 18:28
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
(22, 51, 212, 1);

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
(9, 'Dziecko'),
(13, 'Sport');

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
(12, 51, 212);

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
(68, 51, 0),
(250, 51, 208),
(263, 51, 1),
(275, 51, 209),
(277, 51, 5),
(280, 51, 7),
(284, 51, 210),
(568, 51, 212),
(598, 51, 214),
(599, 51, 215),
(604, 51, 213),
(610, 51, 216),
(611, 51, 217),
(617, 51, 218),
(827, 51, 211),
(844, 51, 3),
(845, 51, 4),
(846, 51, 219),
(850, 51, 221),
(851, 51, 222),
(852, 51, 223),
(853, 51, 224),
(855, 51, 227),
(856, 51, 228),
(857, 51, 229),
(859, 51, 230),
(860, 51, 220);

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
(3, 5, 'Czajnik elektryczny Adler AD1223 srebrny 1,7l', '80.00', '99.99', 'a:6:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"1\";}i:1;a:2:{i:0;s:9:\"Producent\";i:1;s:7:\"SAMSUNG\";}i:2;a:2:{i:0;s:5:\"Kolor\";i:1;s:6:\"czarny\";}i:3;a:2:{i:0;s:12:\"Pamięć RAM\";i:1;s:3:\"8GB\";}i:4;a:2:{i:0;s:8:\"Pamięć\";i:1;s:5:\"128GB\";}i:5;a:2:{i:0;s:12:\"Kod produktu\";i:1;s:7:\"SM-S901\";}}', 'Filtr z mikrosiateczką wyłapujący drobne cząsteczki kamienia\r\nZdejmowany filtr z mikrosiateczką wyłapuje drobne cząsteczki kamienia, nawet o wielkości 200 mikronów, zapewniając czystość wody.<br><br>Płaski element grzejny umożliwia szybkie gotowanie\r\nUkryty element grzejny ze stali szlachetnej umożliwia szybkie gotowanie i łatwe czyszczenie czajnika PHILIPS HD9318/20.', 1, 'a:2:{i:0;s:33:\"Czajnik-PHILIPS-HD9318-20-bok.jpg\";i:1;s:35:\"Czajnik-PHILIPS-HD9318-20-front.jpg\";}', 0, 'no'),
(4, 7, 'Samsung Galaxy S22 5G SM-S901 8/128GB Czarny', '2349.99', '2999.00', 'a:6:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"1\";}i:1;a:2:{i:0;s:9:\"Producent\";i:1;s:7:\"SAMSUNG\";}i:2;a:2:{i:0;s:5:\"Kolor\";i:1;s:6:\"czarny\";}i:3;a:2:{i:0;s:12:\"Pamięć RAM\";i:1;s:3:\"8GB\";}i:4;a:2:{i:0;s:8:\"Pamięć\";i:1;s:5:\"128GB\";}i:5;a:2:{i:0;s:12:\"Kod produktu\";i:1;s:7:\"SM-S901\";}}', 'Za działanie Galaxy S22 odpowiada najszybszy w historii Galaxy procesor. Wykonany w procesie 4 nm i wspierany 8 GB RAM przyczynia się do szybkiej i energooszczędnej pracy smartfona. Możesz uruchomić nawet zaawansowaną grę 3D i nie zauważysz opóźnień. A możliwość szybkiego przetwarzania danych przełoży się na polepszenie jakości zdjęć i filmów. \r\n<br><br>\r\nGalaxy S22 dysponuje 3-krotnym zoomem optycznym wspomaganym optyczną stabilizacją obrazu (OIS). Nawet, jeśli fotografowany obiekt jest daleko, możesz wykonać zbliżenie i pokazać go, nie tracąc na jakości obrazu. \r\n<br><br>\r\nDodatkowo aparat używa nieskompresowanych danych, zawierających więcej szczegółów o kolorach, ostrości i kontraście, poprawiając Twoje fotografie. Smartfon wyposażono w baterię o pojemności 3700 mAh oraz wspiera szybkie ładowanie 25 W*. Wszystko po to, by umożliwić Ci jak najdłuższe oglądanie filmów, wideoczaty ze znajomymi czy granie oraz skrócenie czasu potrzebnego do naładowania baterii.\r\n<br><br>\r\n Z Galaxy S22 noce nabierają wspaniałych kolorów. Aparat w smartfonie otrzymał duże piksele (2 µm), które lepiej wyłapują światło, by nawet robione po zmierzchu zdjęcia i filmy zachwycały bogatą paletą barw, wiernością odwzorowania detali czy świetnym kontrastem. Dodatkowo aparat wspiera sztuczna inteligencja, która dobiera optymalne ustawienia.', 1, 'a:3:{i:0;s:48:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-tyl-front.jpg\";i:1;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-2.jpg\";i:2;s:40:\"Smartfon-SAMSUNG-Galaxy-S22-Czarny-3.jpg\";}', 12, 'yes'),
(211, 1, 'Zabawka interaktywna FISHER PRICE Tańczący DJ HND41', '221.45', '230.99', 'a:3:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"9\";}i:1;a:2:{i:0;s:9:\"Producent\";i:1;s:12:\"FISHER PRICE\";}i:2;a:2:{i:0;s:5:\"Kolor\";i:1;s:14:\"różno-kolory\";}}', 'Zorganizuj imprezę taneczną dla swojego malucha z muzyczną zabawką edukacyjną Taneczny DJ od Fisher-Price! Gdy dziecko naciska przyciski, interaktywny przyjaciel do tańca „ożywa” dzięki kolorowym światełkom i ponad 75 dźwiękowym aktywacjom, na które składają się odgłosy, melodie, piosenki i wypowiedzi wprowadzające malucha w świat literek, liczenia, kolorów i nie tylko. Ta muzyczna zabawka ma specjalną miękką sprężynę – Taneczny DJ wesoło podskakuje, zapraszając do aktywnej zabawy! Dzięki 3 poziomom nauki Taneczny DJ zachęca szkraby do tańca, skakania i wesołej nauki. A to nie wszystko! Taneczny DJ ma też funkcję nagrywania – powiedz coś, a on to powtórzy, przerabiając na krótką, zabawną piosenkę! Zabawka w polskiej wersji językowej, dla dzieci w wieku 9–36 miesięcy.', 9, 'a:2:{i:0;s:59:\"Zabawka-edukacyjna-FISHER-PRICE-Taneczny-DJ-HND41-front.jpg\";i:1;s:64:\"Zabawka-edukacyjna-FISHER-PRICE-Taneczny-DJ-HND41-opakowanie.jpg\";}', 0, 'no'),
(219, 4, 'Laptop APPLE MacBook Air 2022 13.6\" Retina M2 8GB RAM 256GB SSD macOS Srebrny', '4999.00', '6199.00', 'a:7:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"1\";}i:1;a:2:{i:0;s:5:\"Ekran\";i:1;s:20:\"13.6\", 2560 x 1664px\";}i:2;a:2:{i:0;s:8:\"Procesor\";i:1;s:8:\"Apple M2\";}i:3;a:2:{i:0;s:12:\"Pamięć RAM\";i:1;s:3:\"8GB\";}i:4;a:2:{i:0;s:4:\"Dysk\";i:1;s:5:\"256GB\";}i:5;a:2:{i:0;s:15:\"Karta graficzna\";i:1;s:19:\"Apple M2 (8 rdzeni)\";}i:6;a:2:{i:0;s:6:\"System\";i:1;s:14:\"macOS Monterey\";}}', 'Sięgnij po niezawodność!\r\nTrzymaj się mocno, bo oto przed Tobą niezawodnie szybki i ultralekki MacBook Air. Zaprojektowany z myślą o spełnieniu oczekiwań swojego użytkownika i doprecyzowany pod każdym kątem, stanowi wydajne rozwiązanie do pracy, codziennych czynności i grania w gry. Sprawdź potęgę ulepszonej generacji układów scalonych, które oferują jeszcze większą szybkość i energooszczędność.<br><br>\r\n\r\nTeraz jeszcze smuklejszy\r\nNiewiarygodnie cienka obudowa MacBook Air pozwoli Ci cieszyć się jeszcze wygodniejszym użytkowaniem. Podzespoły zamknięte w aluminiowej obudowie, która w 100 procentach pochodzi z recyklingu są bezpieczne, a wszystko dlatego, ponieważ APPLE zadbało o silną trwałość konstrukcji urządzenia. Solidna obudowa zapewnia niepodważalną ochronę dla wnętrza, co dodatkowo zwiększa żywotność Twojego laptopa.<br><br>\r\n\r\nRozwiązanie, które robi wrażenie\r\nCzip M2, jaki zastosowano w MacBook Air to rozwiązanie, jakie zachwyci nawet najbardziej wymagających użytkowników. Imponujące parametry tego niezawodnego podzespołu sprawiają, że urządzenie nie potrzebuje wentylatora do redukcji temperatur, aby stale utrzymywać najwyższą wydajność nawet przy największym obciążeniu. To właśnie ta cecha czyni MacBooka Air niesamowicie cichym i bezszelestnym narzędziem do pracy.', 1, 'a:3:{i:0;s:30:\"obraz_2023-05-14_171722802.png\";i:1;s:30:\"obraz_2023-05-14_171729186.png\";i:2;s:30:\"obraz_2023-05-14_172008319.png\";}', 0, 'no'),
(220, 19, 'Smartfon APPLE iPhone 13 128GB 5G 6.1\" Czarny MLPF3PM/A', '4749.00', '4749.00', 'a:6:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"1\";}i:1;a:2:{i:0;s:12:\"Wyświetlacz\";i:1;s:19:\"6.1\", 2532 x 1170px\";}i:2;a:2:{i:0;s:18:\"Pamięć wbudowana\";i:1;s:5:\"128GB\";}i:3;a:2:{i:0;s:8:\"Procesor\";i:1;s:35:\"Apple A15 Bionic, Sześciordzeniowy\";}i:4;a:2:{i:0;s:6:\"Aparat\";i:1;s:32:\"Tylny 2 x 12 Mpx, Przedni 12 Mpx\";}i:5;a:2:{i:0;s:11:\"Komunikacja\";i:1;s:49:\"5G, Wi-Fi, NFC, Bluetooth 5.0, Złącze Lightning\";}}', 'Nowy system aparatów\r\nInnowacyjny system dwóch aparatów został zaaranżowany na nowo, przesuwając obiektywy o 45 stopni. Dzięki temu nowy szerokokątny obiektyw może robić jeszcze wspaniałe zdjęcia i filmy w warunkach słabego oświetlenia. Ultraszerokokątny obiektyw obejmuje szerszą ramkę, dzięki czemu uchwycisz jeszcze więcej.<br><br>\r\n\r\nTryb filmowy\r\nOd teraz możesz kręcić filmy jak zawodowi filmowcy. APPLE iPhone 13 automatycznie dostosuje przeostrzenia, zmieniając ostrość z jednego obiektu na drugi, żeby kierować uwagą widzów. Dzięki temu uzyskujemy zachwycający efekt głębi.<br><br>\r\n\r\nŚwietne zdjęcia, jednym ruchem palca\r\nTryb nocny pozwoli Ci wykonać wyraźne i doświetlone zdjęcia w słabo oświetlonych sceneriach. Za pomocą trybu portretowego wyostrzony zostaje pierwszy plan, natomiast tło będzie artystycznie rozmazane. Natomiast tryb inteligentny HDR jest w stanie rozpoznać nawet cztery różne osoby w kadrze, dostosowując kontrast, a nawet odcienie skóry tak, aby wszyscy wyszli, jak najlepiej.', 1, 'a:4:{i:0;s:30:\"obraz_2023-05-14_174515641.png\";i:1;s:30:\"obraz_2023-05-14_174520488.png\";i:2;s:30:\"obraz_2023-05-14_174524957.png\";i:3;s:30:\"obraz_2023-05-14_174529597.png\";}', 0, 'no'),
(221, 3, 'Monitor ACER Predator XB253QGW 24.5\" 1920x1080px IPS 280Hz 1 ms', '1399.00', '1599.00', 'a:6:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"1\";}i:1;a:2:{i:0;s:5:\"Ekran\";i:1;s:25:\"24.5\", 1920 x 1080px, IPS\";}i:2;a:2:{i:0;s:37:\"Częstotliwość odświeżania obrazu\";i:1;s:5:\"280Hz\";}i:3;a:2:{i:0;s:20:\"Czas reakcji matrycy\";i:1;s:3:\"1ms\";}i:4;a:2:{i:0;s:16:\"Jasność ekranu\";i:1;s:10:\"400[cd/m2]\";}i:5;a:2:{i:0;s:16:\"Proporcje ekranu\";i:1;s:4:\"16:9\";}}', 'Tak, rozdzielczość ma znaczenie\r\nZobacz wyraźny obraz i rzeczywiste kolory na 25-calowym wyświetlaczu Full HD IPS. Ekran może służyć szerszej publiczności, ponieważ cienie i kontrast nie tracą jakości nawet przy kącie patrzenia równym 178°.<br><br>\r\n\r\nWyjdź z cienia\r\nACER Predator XB253QGW wyróżniają dwa paski LED z przodu urządzenia. Możesz sterować nimi za pomocą menu monitora lub aplikacji RGB Light Sense i wybierać spośród różnych styli podświetlenia, takich jak np. fala, stały czy oddychanie, w którym paski pulsują kolorem.<br><br>\r\n\r\nDoskonałe dopasowanie\r\nZestrój liczbę klatek na stałym poziomie między urządzeniami dzięki technologii NVIDIA G-SYNC. Zapewni Ci to płynny obraz podczas rozgrywki, bez opóźnień i przeskoków.', 1, 'a:3:{i:0;s:30:\"obraz_2023-05-14_174820544.png\";i:1;s:30:\"obraz_2023-05-14_174825269.png\";i:2;s:30:\"obraz_2023-05-14_174830894.png\";}', 0, 'no'),
(222, 50, 'LEGO Star Wars Mandalorianin i dziecko 75317', '73.00', '73.00', 'a:4:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"9\";}i:1;a:2:{i:0;s:5:\"Seria\";i:1;s:14:\"Lego Star Wars\";}i:2;a:2:{i:0;s:14:\"Kod producenta\";i:1;s:5:\"75317\";}i:3;a:2:{i:0;s:18:\"Przedział wiekowy\";i:1;s:3:\"10+\";}}', 'ŚWIAT GWIEZDNYCH WOJEN\r\nSzukasz pomysłu na prezent dla fana serialu „Star Wars: The Mandalorian”? Wybierz zestaw LEGO Star Wars Mandalorianin i dziecko 75317, który zachęca do kreatywnej zabawy z postaciami znanymi z uniwersum Gwiezdnych Wojen i może być spełnieniem marzeń dla każdego kolekcjonera!<br><br>\r\n\r\nZAWARTOŚĆ OPAKOWANIA\r\nW opakowaniu znalazło się 295 elementów. Razem z nimi skonstruujesz 2 figurki – Mandalorianina i dziecka umieszczonego w specjalnym wózku, który „unosi się” na przezroczystych klockach LEGO. W zestawie znajduje się również uzbrojenie mandaloriańskiego wojownika – jego karabin i pistolet blasterowy. Zabawka jest przeznaczona dla dzieci w wieku 10+.', 9, 'a:3:{i:0;s:30:\"obraz_2023-05-14_175354372.png\";i:1;s:30:\"obraz_2023-05-14_175358583.png\";i:2;s:30:\"obraz_2023-05-14_175404406.png\";}', 0, 'no'),
(223, 8, 'LEGO DUPLO Posterunek policji 10902', '197.00', '217.00', 'a:5:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"9\";}i:1;a:2:{i:0;s:5:\"Seria\";i:1;s:10:\"Lego Duplo\";}i:2;a:2:{i:0;s:14:\"Kod producenta\";i:1;s:5:\"10902\";}i:3;a:2:{i:0;s:18:\"Przedział wiekowy\";i:1;s:2:\"2+\";}i:4;a:2:{i:0;s:5:\"Motyw\";i:1;s:18:\"Posterunek policji\";}}', 'LEGO DUPLO POSTERUNEK POLICJI 10902\r\nLEGO Duplo Posterunek policji zachwyci niejednego małego chłopca i dziewczynkę. Duże, ergonomiczne klocki są odpowiednim wyborem już dla dwuletniego dziecka.<br><br>\r\n\r\nROZWÓJ KREATYWNOŚCI\r\nZestaw pozwala na tworzenie interesujących i kreatywnych scenariuszy scenek. Policjant może przeprowadzić pełne przesłuchanie złodzieja lub wybrać się w pościg radiowozem. Policjantka może udać się na interwencję, podczas gdy jej kolega pozostanie na posterunku. Liczba opcji sprawia, że zabawa nigdy nie znudzi się maluchowi.\r\n\r\nMożliwość kreowania własnych scenariuszy pozwala na rozwój kreatywności dziecka. Choć w początkowej fazie, maluch może potrzebować nieco pomocy w obmyślaniu scenek, szybko nauczy się samodzielnie tworzyć pomysłowe dialogi.', 9, 'a:3:{i:0;s:30:\"obraz_2023-05-14_175541196.png\";i:1;s:30:\"obraz_2023-05-14_175548031.png\";i:2;s:30:\"obraz_2023-05-14_175554766.png\";}', 0, 'no'),
(224, 23, 'Książka dla dzieci Kodowanie krok po kroku Dla maluchów Z koalą', '8.00', '10.00', 'a:5:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"9\";}i:1;a:2:{i:0;s:5:\"Seria\";i:1;s:23:\"Kodowanie krok po kroku\";}i:2;a:2:{i:0;s:8:\"Tematyka\";i:1;s:5:\"Nauka\";}i:3;a:2:{i:0;s:12:\"Liczba stron\";i:1;s:2:\"24\";}i:4;a:2:{i:0;s:18:\"Przedział wiekowy\";i:1;s:3:\"4-5\";}}', 'W przyszłości zostanę...programistą! Każdy programista musi dostrzegać różne zależności, aby umiejętnie pisać kod, a tego właśnie uczyć się może już jako dziecko dzięki serii \"Kodowanie krok po kroku\". Seria w prosty sposób wprowadza w świat kodowania i programowania. Wykonując zadania, dziecko ćwiczy cierpliwość, spostrzegawczość, logiczne myślenie. Będzie to świetna metoda na zapoznanie się ze sposobem działania maszyn i algorytmów. W serii dostępne są dwa zeszyty dla dzieci młodszych i dwa dla starszych.\r\n\r\nUWAGA: Produkt nieprzeznaczony dla dzieci poniżej 3 roku życia.', 9, 'a:1:{i:0;s:30:\"obraz_2023-05-14_175739602.png\";}', 0, 'no'),
(225, 2, 'Butelka PHILIPS Avent Natural SCY903/66', '45.00', '53.00', 'a:5:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:1:\"9\";}i:1;a:2:{i:0;s:12:\"Wiek dziecka\";i:1;s:4:\"1 m+\";}i:2;a:2:{i:0;s:11:\"Pojemność\";i:1;s:5:\"260ml\";}i:3;a:2:{i:0;s:19:\"Materiał wykonania\";i:1;s:17:\"Tworzywo sztuczne\";}i:4;a:2:{i:0;s:11:\"Antykolkowa\";i:1;s:3:\"Tak\";}}', 'Butelka marki PHILIPS Avent model SCY903/66. Produkt wykonany z tworzywa sztucznego o pojemności 260 ml. Od 1 miesiąca życia. Butelka antykolkowa ma na celu utrzymywanie powietrza z dala od brzuszka dziecka podczas karmienia, aby pomóc zmniejszyć kolkę i dyskomfort.', 9, 'a:3:{i:0;s:30:\"obraz_2023-05-14_175912717.png\";i:1;s:30:\"obraz_2023-05-14_175916970.png\";i:2;s:30:\"obraz_2023-05-14_175921324.png\";}', 0, 'no'),
(226, 12, 'Ławka do ćwiczeń MARBO SPORT MH-L114', '429.00', '479.00', 'a:6:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:2:\"13\";}i:1;a:2:{i:0;s:17:\"Klasa urządzenia\";i:1;s:18:\"H - użytek domowy\";}i:2;a:2:{i:0;s:30:\"Maksymalne obciążenie ławki\";i:1;s:5:\"200kg\";}i:3;a:2:{i:0;s:4:\"Rama\";i:1;s:7:\"Stalowa\";}i:4;a:2:{i:0;s:33:\"Regulacja kąta nachylenia ławki\";i:1;s:3:\"Tak\";}i:5;a:2:{i:0;s:17:\"Wsporniki sztangi\";i:1;s:3:\"Nie\";}}', 'Regulacja oparcia i siedziska\r\nŁawka do ćwiczeń MARBO SPORT MH-L114 to funkcjonalny sprzęt, który będzie świetną podstawą do budowania świetnie wyposażonej domowej siłowni. Siedzisko możesz regulować w 3 pozycjach (0° 15° 26°), a jego oparcie pod 9 różnymi kątami, więc ustawisz je dokładnie tak, jak tego potrzebujesz. Zakres regulacji oparcia to od -22 do 84 stopni (-22° 0° 15° 25° 35° 45° 56° 67° 84°), więc możesz wykonywać na niej najrozmaitsze ćwiczenia, od wyciskania sztangi leżąc głową w dół, po takie wykonywane w pozycji siedzącej.<br><br>\r\n\r\nBezpieczna i trwała\r\nDodatkowe wzmocnienia tapicerki na oparciu, czyli w miejscu, gdzie najczęściej pojawiają się przetarcia, sprawia, że ławka na dłużej zachowuje idealny stan. Ergonomiczne kształty i jej grubość sprawiają, że ćwiczenia są komfortowe, a sprzęt przez długi czas wygląda jak nowy. Stopki są z gumy, więc nie musisz obawiać się, że sprzęt porysuje podłogę w Twoim domu. Dodatkowo zapewniają większe bezpieczeństwo, ponieważ sprzęt nie ślizga się i nie przesuwa.<br><br>\r\n\r\nLinia Home - sprzęt do użytku domowego\r\nŁawka do ćwiczeń MARBO SPORT MH-L114 to produkt z serii Home, która przeznaczona jest dla początkujących użytkowników sprzętów z domowej siłowni. Produkty z tej serii wykonane są z wytrzymałych profili 40 x 40 mm, które gwarantują świetną stabilność i bezpieczeństwo ćwiczeń. Sprzęty są malowane proszkowo, więc zachowają doskonały wygląd przez długi czas, a gruba, 3 cm gąbka pokryta czerwono-czarną tapicerką zapewnia wygodę ćwiczeń. Linia Home spełnia normy bezpieczeństwa potwierdzone przez Certyfikat Bezpieczeństwa i Top Security Certificate.', 13, 'a:3:{i:0;s:30:\"obraz_2023-05-14_180316800.png\";i:1;s:30:\"obraz_2023-05-14_180323286.png\";i:2;s:30:\"obraz_2023-05-14_180328463.png\";}', 0, 'no'),
(227, 4, 'Ławka do ćwiczeń MARBO SPORT Semi-Pro 2.0 MS-L107 2.0', '599.00', '649.00', 'a:4:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:2:\"13\";}i:1;a:2:{i:0;s:17:\"Klasa urządzenia\";i:1;s:18:\"H - użytek domowy\";}i:2;a:2:{i:0;s:4:\"Rama\";i:1;s:7:\"Stalowa\";}i:3;a:2:{i:0;s:33:\"Regulacja kąta nachylenia ławki\";i:1;s:3:\"Nie\";}}', 'Chcesz wykonać profesjonalny trening bicepsa także poza siłownią? Teraz to możliwe bez wychodzenia z domu!<br><br>\r\n\r\n \r\n\r\nŁaweczka Scotta MS-L107 2.0 to nowa wersja modlitewnika z kultowej serii Semi Pro od Marbo Sport. To idealne urządzenie do izolowanych ćwiczeń mięśni ramion – a w szczególności bicepsa.<br><br>\r\n\r\n \r\n\r\nOdkryj, jak wiele możesz osiągnąć, korzystając z MS-L107 2.0 we własnej, domowej siłowni! Ćwicz biceps bezpiecznie, bez nadmiernego obciążania pleców i w pełnym zakresie ruchów. Zbuduj swój mięsień dwugłowy ramienia i wypiętrz jego szczyt. Trenuj górne partie mięśni – ze sztangielkami, sztangą łamaną lub prostą, kettlami czy wyciągiem dolnym. Zgodnie z własnymi preferencjami.<br><br>\r\n\r\n \r\n\r\nModlitewnik MS-L107 2.0 to: bardzo wysoka jakość wykonania, która przekłada się na niezawodną stabilność oraz ergonomię, przy obciążeniu nawet do 300 kg; optymalny kąt nachylenia – 5-stopniowa regulacja oparcia pozwoli Ci dopasować optymalną pozycję do charakteru ćwiczeń na biceps. Postaw na sprzęt najwyższej klasy, dostosowany do wykorzystania w domowej siłowni i nie tylko. To jakość dla zaawansowanych!<br><br>\r\n\r\n \r\n\r\nRegulacja podparcia – skok co 4 cm\r\nTen modlitewnik zapewni Ci wygodę ćwiczeń, bez względu na to, jakiego jesteś wzrostu. 5-stopniowa regulacja wysokości podparcia z 4-centymetrowym skokiem pozwala bardzo łatwo zadbać o komfortowe ustawienie wysokości podparcia. Takie, które pozwoli przyjąć optymalną postawę podczas ćwiczeń. Wybrana przez Ciebie pozycja podparcia nie ulegnie zmianie pod wpływem obciążenia – wszystko za sprawą solidnego pokrętła dociskowego. Drugim zabezpieczeniem jest blokada wsuwana w otwór. Możesz więc ćwiczyć bez obaw!<br><br>\r\n\r\n \r\n\r\nDwa poziomy do odłożenia gryfu\r\nDwie hakownice na gryf to większe bezpieczeństwo oraz wygoda ćwiczeń – łatwo i szybko odłożysz gryf po zakończonej intensywnej serii. Ponadto zyskujesz możliwość bezpiecznego przechowywania dwóch sztang.<br><br>\r\n\r\n \r\n\r\nWysokiej jakości tapicerka\r\nTapicerka ławeczki MS-L107 2.0 jest przyjemna w dotyku, a przede wszystkim wytrzymała na przetarcia i inne uszkodzenia, które wynikają z intensywnej eksploatacji. Dzięki temu masz pewność, że sprzęt będzie wyglądał jak nowy przez długi czas.<br><br>\r\n\r\n \r\n\r\nNowoczesny design\r\nEleganckie, czarne obicie nadaje ławce Scotta MS-L107 2.0 minimalistyczny styl - dlatego to urządzenie dopasuje się do każdej przestrzeni.<br><br>\r\n\r\n \r\n\r\nStopki wykonane ze wzmocnionej mieszanki gumy\r\nGumowe stopki sprawiają, że modlitewnik stoi stabilnie i nie zmienia pozycji nawet podczas intensywnych ćwiczeń z obciążeniem. Nie musisz się obawiać poślizgnięć, przesunięć czy „chybotania”. Zyskujesz pełen komfort i bezpieczeństwo działania. Poza tym sprzęt nie zarysuje podłogi – bez względu na to, czy postawisz go na panelach, parkiecie czy posadzce.<br><br>\r\n\r\n \r\n\r\nSeria Semi-Pro 2.0 - nowa generacja bestsellerów\r\nSemi-Pro 2.0 to nowa seria urządzeń i akcesoriów Marbo Sport przeznaczona dla zaawansowanych użytkowników domowych. To nowa odsłona kultowej serii Semi-Pro, w odświeżonej i ulepszonej wersji. Doskonale znane jakość, ergonomia i stabilność zyskały nowy design. Elegancka czerń tapicerki w połączeniu z subtelnymi detalami w odcieniu srebra i stali oraz dyskretnym logo to kwintesencja nowoczesnego stylu. Maszyny robią doskonałe wrażenie i prezentują się wyjątkowo profesjonalnie – są jeszcze stabilniejsze, bezpieczniejsze i bardziej ergonomiczne. W bogatej gamie urządzeń znalazł się sprzęt umożliwiający ćwiczenia siłowe i wytrzymałościowe, z obciążeniem i bez, kształtujące różne partie mięśni. Maszyny zapewniają precyzyjną i szeroki zakres regulacji. To pozwala dopasować je do potrzeb treningowych każdego użytkownika. Sprzęt można ze sobą łatwo łączyć – tak, aby powstały kompaktowe i kompletne zestawy do profesjonalnych ćwiczeń. To doskonały wybór dla osób, które prowadzą bardziej intensywne i zaawansowane treningi na co dzień.', 13, 'a:4:{i:0;s:30:\"obraz_2023-05-14_181119641.png\";i:1;s:30:\"obraz_2023-05-14_181124504.png\";i:2;s:30:\"obraz_2023-05-14_181129065.png\";i:3;s:30:\"obraz_2023-05-14_181134129.png\";}', 0, 'no'),
(228, 16, 'Bidon KELLYS Sport 022 700 ml Antracytowy', '19.00', '22.00', 'a:4:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:2:\"13\";}i:1;a:2:{i:0;s:6:\"Rodzaj\";i:1;s:5:\"Bidon\";}i:2;a:2:{i:0;s:5:\"Kolor\";i:1;s:11:\"Antracytowy\";}i:3;a:2:{i:0;s:9:\"Materiał\";i:1;s:17:\"Tworzywo sztuczne\";}}', 'Bidon Sport 022 marki KELLYS o pojemności 700 ml, wykonany z tworzywa sztucznego. Posiada ergonomiczny kształt, oryginalny design i zamykany ustnik z miękkiego plastiku. Nakrętka butelki wyposażona jest w silikonową uszczelkę. Szeroka szyjka butelki ułatwia czyszczenie i napełnianie.', 13, 'a:1:{i:0;s:30:\"obraz_2023-05-14_181431262.png\";}', 0, 'no'),
(229, 5, 'Worek treningowy MARBO SPORT 150 cm fi45 cm + torpeda MC-W150-45', '127.00', '137.00', 'a:4:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:2:\"13\";}i:1;a:2:{i:0;s:9:\"Materiał\";i:1;s:6:\"Plawil\";}i:2;a:2:{i:0;s:11:\"Długość \";i:1;s:4:\"45cm\";}i:3;a:2:{i:0;s:12:\"Szerokość \";i:1;s:4:\"45cm\";}}', 'Do wyrobu naszych worków używamy najmocniejszej odmiany plawilu - odpornego na przetarcia i rozerwania profesjonalnego materiału, używanego do produkcji wyrobów, które muszą stawić czoła najbardziej ekstremalnym wyzwaniom. Worek otrzymasz pusty, należy samemu go wypełnić. Polecamy do wypełnienia skrawki tekstyliów. Jednak jeśli uważasz, że to zbyt mało, nic nie stoi na przeszkodzie, aby jeszcze bardziej go dociążyć - w zestawie otrzymasz torpedę, która po napełnieniu suchym piaskiem zwiększa wagę worka o 20 kg. Torpeda ma wymiary 22x55cm, wykonana z mocnego poliestru 600x600, zamykana jest na suwak, dzięki czemu masz 100% pewności, że zawartość nie rozsypie się w środku worka. Guma dolnego mocowania widoczna na zdjęciach nie jest dołączona do zestawu.<br><br>\r\n\r\nMateriał\r\nDo wyrobu naszych worków używamy najmocniejszej odmiany PLAVILU - odpornego na przetarcia i rozerwania, używanego do produkcji wyrobów, które muszą stawić czoła najbardziej ekstremalnym wyzwaniom<br><br>\r\n\r\nSystem mocowania\r\n\r\nWorek posiada mocne uchwyty mocujące o grubości 6 milimetrów. Nasze worki posiadają grube, podwójnie zakładane taśmy mocujące z wielokrotnymi przeszyciami. Końcówka taśmy mocującej została przez nas przeszyta w ten sposób, że jej krawędzie są zabezpieczone przed uszkodzeniami, oberwaniem i wystrzępieniem.', 13, 'a:2:{i:0;s:30:\"obraz_2023-05-14_181748623.png\";i:1;s:30:\"obraz_2023-05-14_181753736.png\";}', 0, 'no'),
(230, 6, 'Zestaw hantli HMS STC15 (2 x 7.5 kg)', '255.00', '335.00', 'a:5:{i:0;a:2:{i:0;s:9:\"Kategoria\";i:1;s:2:\"13\";}i:1;a:2:{i:0;s:6:\"Rodzaj\";i:1;s:6:\"Hantla\";}i:2;a:2:{i:0;s:9:\"Materiał\";i:1;s:4:\"Stal\";}i:3;a:2:{i:0;s:5:\"Waga \";i:1;s:4:\"15kg\";}i:4;a:2:{i:0;s:25:\"Liczba sztuk w opakowaniu\";i:1;s:1:\"2\";}}', 'Produkt charakteryzuje się dużą mobilnością, łatwo go też przechowywać. Zestaw został wykonany z materiałów najwyższej jakości. Znajdują się w nim profesjonalne chromowane i dodatkowo wzmacniane gryfy proste z solidnymi zaciskami śrubowymi. Posiadają one gwintowane końce, dzięki czemu osadzanie obciążenia jest proste i szybkie (blokuje się je szybkim ruchem za pomocą nakrętki blokującej). Zaciski równomiernie dociskają talerze i nie rysują się. Część chwytna posiada ryflowany uchwyt, który zapewnia pewny uchwyt gryfu w dłoni. Zestaw pakowany w praktyczną walizkę ułatwiającą transport.', 13, 'a:2:{i:0;s:30:\"obraz_2023-05-14_182120581.png\";i:1;s:30:\"obraz_2023-05-14_182126093.png\";}', 0, 'no');

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
(51, 'Macinekk', 'nie@gmail.com', '321', '2023-04-06', 0, 1),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `favoriteproduct`
--
ALTER TABLE `favoriteproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `lastwatchedproducts`
--
ALTER TABLE `lastwatchedproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=861;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
