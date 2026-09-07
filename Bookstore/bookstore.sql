-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 03:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` varchar(20) NOT NULL,
  `book_title` varchar(200) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `book_title`, `genre`, `price`, `description`, `image`) VALUES
('978-0000000001', 'Harry Potter And The Chambers of Secrets', 'Fantasy', 0.00, 'Harry Potter\'s summer has included the worst birthday ever, ominous warnings from a house-elf called Dobby, and rescue from the Dursleys by his friend Ron Weasley in a magical flying car!', 'Picture1.png'),
('978-0000000002', 'Harry Potter and the Goblet of Fire', 'Fantasy', 0.00, 'Harry Potter and the Goblet of Fire follows Harry\'s fourth year at Hogwarts as he competes in the dangerous Triwizard Tournament while facing mysterious challenges.', 'gob.png'),
('978-0000000003', 'Harry Potter and the Deathly Hallows', 'Fantasy', 0.00, 'In the final installment, Harry, Ron, and Hermione embark on a perilous mission to destroy Voldemort\'s Horcruxes and bring an end to the Second Wizarding War.', 'book3.jpg'),
('978-0000000004', 'Harry Potter and the Half-Blood Prince', 'Fantasy', 0.00, 'Harry discovers an old potions textbook belonging to the mysterious \"Half-Blood Prince\" while Dumbledore prepares him for the final battle against Voldemort.', 'book4.png'),
('978-0000000005', 'The Lord of the Rings: The Fellowship of the Ring', 'Fantasy', 0.00, 'A young hobbit, Frodo Baggins, inherits a dangerous ring that must be destroyed in the fires of Mount Doom to prevent the Dark Lord Sauron from conquering Middle-earth.', 'lotr.png'),
('978-0000000006', 'Eragon', 'Fantasy', 0.00, 'A farm boy discovers a dragon egg and becomes a Dragon Rider, thrust into a world of magic and power struggles in Christopher Paolini\'s Inheritance Cycle.', 'eragon1.jpg'),
('978-0000000007', 'The Way of Kings', 'Fantasy', 0.00, 'Brandon Sanderson\'s epic fantasy follows warriors, scholars, and kings in the storm-ravaged world of Roshar, where magical armor and weapons change the tide of war.', 'stormlight.png'),
('978-0000000008', 'The Priory of the Orange Tree', 'Fantasy', 0.00, 'A feminist reimagining of dragon mythology featuring queendoms, dragonriders, and an ancient enemy threatening to destroy the world.', 'priory1.png'),
('978-0000000009', 'Neverwhere', 'Fantasy', 0.00, 'Neil Gaiman\'s urban fantasy about Richard Mayhew, who discovers London Below - a magical world hidden beneath the streets of London.', 'neverwhere.png'),
('978-0000000010', 'Treasure Island', 'Adventure', 5.00, 'Young Jim Hawkins embarks on a perilous voyage to find buried pirate treasure, facing Long John Silver and mutinous crew members in Robert Louis Stevenson\'s swashbuckling classic.', 'treasure-island1.jpg'),
('978-0000000011', 'Around the World in 80 Days', 'Adventure', 0.00, 'Phileas Fogg bets he can circumnavigate the globe in 80 days, racing against time through continents and overcoming unexpected obstacles in Jules Verne\'s thrilling adventure.', '80-days.jpg'),
('978-0000000012', 'The Call of the Wild', 'Adventure', 0.00, 'Buck, a domesticated dog, must embrace his primal instincts to survive the brutal Yukon during the 1890s Klondike Gold Rush in Jack London\'s wilderness epic.', 'call-wild.jpg'),
('978-0000000013', 'King Solomon\'s Mines', 'Adventure', 0.00, 'Allan Quatermain leads an expedition into unexplored Africa in search of a missing man and legendary diamond mines in H. Rider Haggard\'s lost world adventure.', 'solomon-mines.jpg'),
('978-0000000014', 'The Lost World', 'Adventure', 0.00, 'Arthur Conan Doyle\'s thrilling tale of an expedition to a South American plateau where dinosaurs and other prehistoric creatures still roam.', 'lost-world.jpg'),
('978-0000000015', 'Twenty Thousand Leagues Under the Sea', 'Adventure', 0.00, 'Professor Aronnax explores the ocean depths in Captain Nemo\'s extraordinary submarine Nautilus, encountering sea monsters and underwater wonders in Jules Verne\'s sci-fi adventure.', 'leagues.jpg'),
('978-0000000016', 'The African Queen', 'Adventure', 0.00, 'A missionary\'s sister and a rough-hewn mechanic navigate dangerous rivers in German-held Africa during WWI in C.S. Forester\'s wartime adventure.', 'queen.jpg'),
('978-0000000017', 'The Lost City of Z', 'Adventure', 0.00, 'David Grann\'s true account of explorer Percy Fawcett\'s quest for a mythical city in the Amazon jungle, blending history and modern investigative journalism.', 'z.jpg'),
('978-0000000018', 'Into the Wild', 'Adventure', 0.00, 'Jon Krakauer\'s gripping true story of Christopher McCandless who abandoned civilization to trek into the Alaskan wilderness, seeking raw adventure.', 'wild.jpg'),
('978-0000000020', 'And Then There Were None', 'Mystery', 0.00, 'Ten strangers are lured to a remote island where they\'re killed one by one in this iconic Agatha Christie masterpiece of suspense.', 'none.jpg'),
('978-0000000021', 'The Hound of the Baskervilles', 'Mystery', 0.00, 'Sherlock Holmes investigates a family curse involving a ghostly hound haunting the moors in Arthur Conan Doyle\'s classic mystery.', 'hound.jpg'),
('978-0000000022', 'Gone Girl', 'Mystery', 0.00, 'A husband becomes the prime suspect when his wife disappears in Gillian Flynn\'s psychological thriller full of shocking twists.', 'gone.jpg'),
('978-0000000023', 'The Girl with the Dragon Tattoo', 'Mystery', 0.00, 'Journalist Mikael Blomkvist and hacker Lisbeth Salander investigate a decades-old disappearance in Stieg Larsson\'s Nordic noir.', 'dragon.jpg'),
('978-0000000024', 'The Silent Patient', 'Mystery', 0.00, 'A psychotherapist becomes obsessed with unraveling why a famous painter stopped speaking after shooting her husband in Alex Michaelides\' thriller.', 'silent.jpg'),
('978-0000000025', 'Murder on the Orient Express', 'Mystery', 0.00, 'Hercule Poirot must solve a murder aboard a snowbound train in Agatha Christie\'s most famous locked-room mystery.', 'orient.jpg'),
('978-0000000026', 'The Da Vinci Code', 'Mystery', 0.00, 'Robert Langdon deciphers clues in Renaissance art to solve a murder and uncover a religious mystery in Dan Brown\'s bestseller.', 'davinci.jpg'),
('978-0000000027', 'Big Little Lies', 'Mystery', 0.00, 'Three women become entangled in a murder investigation that reveals dark secrets beneath their perfect lives in Liane Moriarty\'s suspense novel.', 'lies.jpg'),
('978-0000000028', 'The Woman in the Window', 'Mystery', 0.00, 'An agoraphobic woman witnesses a crime across the street in this Hitchcockian thriller by A.J. Finn, where nothing is as it seems.', 'window.jpg'),
('978-0000000030', 'The Shining', 'Horror', 0.00, 'A winter caretaker and his family are trapped in a haunted hotel, leading to terrifying consequences in Stephen King\'s classic horror novel.', 'shining.jpg'),
('978-0000000031', 'Dracula', 'Horror', 0.00, 'Bram Stoker\'s gothic masterpiece tells the story of Count Dracula\'s attempt to move to England and spread his curse of vampirism.', 'dracula.jpg'),
('978-0000000032', 'The Exorcist', 'Horror', 0.00, 'A young girl\'s horrifying possession leads to a battle between good and evil in William Peter Blatty\'s chilling horror novel.', 'exorcist.jpg'),
('978-0000000033', 'House of Leaves', 'Horror', 0.00, 'A family discovers impossible, shifting spaces inside their new home in Mark Z. Danielewski\'s mind-bending horror novel.', 'house.jpg'),
('978-0000000034', 'Pet Sematary', 'Horror', 0.00, 'A grieving father discovers an ancient burial ground with sinister powers in Stephen King\'s haunting tale of loss and horror.', 'pet.jpg'),
('978-0000000035', 'The Haunting of Hill House', 'Horror', 0.00, 'Shirley Jackson\'s classic ghost story follows a group of people investigating a mansion with a sinister reputation.', 'hillhouse.jpg'),
('978-0000000036', 'Bird Box', 'Horror', 0.00, 'In a world where unseen creatures drive people to madness, a mother must escape to safety while blindfolded in Josh Malerman\'s terrifying thriller.', 'birdbox.jpg'),
('978-0000000037', 'The Silence of the Lambs', 'Horror', 0.00, 'An FBI trainee must seek the help of a brilliant but dangerous serial killer to catch another murderer in Thomas Harris\'s psychological horror novel.', 'silence.jpg'),
('978-0000000038', 'The Shadow Over Innsmouth', 'Horror', 0.00, 'H.P. Lovecraft\'s eerie tale of an isolated town harboring a horrifying secret beneath the waves.', 'innsmouth.jpg'),
('978-0000000040', 'Pride and Prejudice', 'Romance', 0.00, 'Elizabeth Bennet navigates love, society, and pride in this timeless classic by Jane Austen.', 'pride.jpg'),
('978-0000000041', 'The Notebook', 'Romance', 0.00, 'A sweeping love story between Noah and Allie that spans decades in Nicholas Sparks\' heartwarming novel.', 'pride1.jpg'),
('978-0000000042', 'Me Before You', 'Romance', 0.00, 'A small-town woman forms an unexpected bond with a man struggling with life after an accident in Jojo Moyes\' emotional romance.', 'pride2.jpg'),
('978-0000000043', 'Outlander', 'Romance', 0.00, 'A WWII nurse is transported back in time to 18th-century Scotland, where she finds love and adventure in Diana Gabaldon’s novel.', 'pride3.jpg'),
('978-0000000044', 'The Fault in Our Stars', 'Romance', 0.00, 'Two teens with illnesses fall in love in John Green’s heartbreaking yet beautiful story of love and loss.', 'pride4.jpg'),
('978-0000000045', 'Red, White & Royal Blue', 'Romance', 0.00, 'A secret romance between a British prince and the First Son of the United States unfolds in Casey McQuiston’s modern rom-com.', 'pride5.jpg'),
('978-0000000046', 'It Ends With Us', 'Romance', 0.00, 'Colleen Hoover’s powerful novel explores love, resilience, and difficult choices in a deeply emotional story.', 'pride6.jpg'),
('978-0000000047', 'Beach Read', 'Romance', 0.00, 'Two writers with opposing styles challenge each other to switch genres for the summer, leading to unexpected romance in Emily Henry’s novel.', 'pride7.jpg'),
('978-0000000048', 'People We Meet on Vacation', 'Romance', 0.00, 'Two best friends take one last trip to rekindle their friendship and possibly something more in Emily Henry’s charming romance.', 'pride8.jpg'),
('978-0000000050', 'Dune', 'Science Fiction', 0.00, 'A young nobleman must navigate a desert planet filled with political intrigue, giant sandworms, and a mystical spice in Frank Herbert\'s sci-fi epic.', 'dune.jpg'),
('978-0000000051', 'Neuromancer', 'Science Fiction', 0.00, 'A washed-up hacker is hired for the ultimate cyberspace heist in William Gibson\'s cyberpunk masterpiece.', 'neuromancer.jpg'),
('978-0000000052', 'The Hitchhiker\'s Guide to the Galaxy', 'Science Fiction', 0.00, 'Arthur Dent embarks on a hilarious and mind-bending journey through space after Earth\'s sudden destruction in Douglas Adams\' sci-fi classic.', 'hitchhiker.jpg'),
('978-0000000053', 'Ender’s Game', 'Science Fiction', 0.00, 'A brilliant young strategist is trained in a futuristic battle school to defend Earth against an alien invasion in Orson Scott Card\'s novel.', 'ender.jpg'),
('978-0000000054', 'The Martian', 'Science Fiction', 0.00, 'A stranded astronaut fights for survival on Mars in Andy Weir\'s scientifically meticulous and thrilling adventure.', 'martian.jpg'),
('978-0000000055', 'Brave New World', 'Science Fiction', 0.00, 'A dystopian future of genetic engineering and social control is explored in Aldous Huxley\'s groundbreaking novel.', 'bravenew.jpg'),
('978-0000000056', 'Snow Crash', 'Science Fiction', 0.00, 'A samurai-sword-wielding hacker uncovers a mind-altering virus in Neal Stephenson\'s cyberpunk adventure.', 'snowcrash.jpg'),
('978-0000000057', 'Fahrenheit 451', 'Science Fiction', 0.00, 'A dystopian world where books are banned and burned is at the heart of Ray Bradbury\'s cautionary tale.', 'fahrenheit1.jpg'),
('978-0000000058', 'The Left Hand of Darkness', 'Science Fiction', 0.00, 'A human envoy navigates a planet with a unique gender-fluid society in Ursula K. Le Guin’s thought-provoking sci-fi novel.', 'lefthand1.jpg'),
('978-0000000060', 'The Girl on the Train', 'Thriller', 0.00, 'A woman\'s obsession with the lives of a couple she watches from a train leads her into a thrilling mystery in Paula Hawkins\' bestseller.', 'girltrain.jpg'),
('978-0000000061', 'The Night Manager', 'Thriller', 0.00, 'A former soldier turned hotel manager is recruited to infiltrate a dangerous arms dealer\'s network in John le Carré\'s intense thriller.', 'nightmanager.jpg'),
('978-0000000062', 'The Chain', 'Thriller', 0.00, 'A mother must kidnap another child to save her own in Adrian McKinty\'s high-stakes psychological thriller.', 'chain.jpg'),
('978-0000000063', 'I Am Watching You', 'Thriller', 0.00, 'When a young woman vanishes after meeting strangers on a train, those who knew her are forced to reveal dark secrets in Teresa Driscoll\'s mystery thriller.', 'watching.jpg'),
('978-0000000064', 'Before I Go to Sleep', 'Thriller', 0.00, 'A woman suffering from amnesia must reconstruct her life daily, uncovering terrifying secrets in S.J. Watson\'s psychological thriller.', 'before.jpg'),
('978-0000000065', 'Sharp Objects', 'Thriller', 0.00, 'A journalist returns to her hometown to cover a string of murders while confronting dark family secrets in Gillian Flynn\'s haunting novel.', 'sharp.jpg'),
('978-0000000066', 'The Couple Next Door', 'Thriller', 0.00, 'A dinner party takes a shocking turn when a baby goes missing in Shari Lapena\'s twist-filled thriller.', 'couple.jpg'),
('978-0000000067', 'The Silent Corner', 'Thriller', 0.00, 'A determined FBI agent investigates a string of mysterious suicides that reveal a terrifying conspiracy in Dean Koontz\'s thriller.', 'silentcorner.jpg'),
('978-0000000068', 'The Family Upstairs', 'Thriller', 0.00, 'Lisa Jewell\'s chilling thriller uncovers a twisted family mystery when a woman inherits a house with a dark past.', 'family.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `USIID` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`USIID`, `name`, `email`, `created_at`, `password`, `address`, `postcode`) VALUES
('cust_68026293d230b6.41788028', 'user', 'user@gmail.com', '2025-04-18 14:32:51', '$2y$10$kRxleNrowu0BoY0HEaKtS..T7xg/U0LH.O9VpvcdyyXSKJCcIHO8C', '13 camden st,\r\nnelson', 'BB9 0BL'),
('cust_68057e23d42ce3.86412361', 'user1', 'user1@gmail.com', '2025-04-20 23:07:15', '$2y$10$eBaLEgJYOF7q1C/ZeI0u6e.c.zCZ5/QTjUkI5L7gx8BtCSCF/VE3C', '13 camden street \r\nnelson', 'BB9 0BL'),
('cust_680b6a20ccb017.59872320', 'my', 'user2@gmail.com', '2025-04-25 10:55:29', '$2y$10$N84DtEeH9sFRkYpJqciG/.yU7y8VQiUTZ0OTM2kq7fCUXa24uEh0G', NULL, NULL),
('cust_6814b4ddbd541.80613230', '123', '123@gmail.com', '2025-05-02 12:04:45', '$2y$10$leaJyg9C7alRGZoKJ0PtA.fUgy4gG8Mg/DQQiKtRhGM7PfWf3NJCW', '13 camden', 'BB9 0BL'),
('cust_6814c39b6d490.23534568', 'user21', 'user21@gmail.com', '2025-05-02 13:07:39', '$2y$10$oOpK8X.kYfBuqqP.qfKJDupCsLUUZX5km/zTuzDfZerLf6HBeej6i', '13 camden', 'BB9 0BL'),
('cust_6815438c793eb.83018008', 'user26', 'user26@gmail.com', '2025-05-02 22:13:32', '$2y$10$UlJMpJtn3C6jFnB0YfJBBeV/1sX2Nx5V/cUjeQGMHx9MSbrej1S1a', '13 camden', 'BB9 0BL'),
('cust_6815f94365b17.89547094', 'hamid', 'hamid@gmail.com', '2025-05-03 11:08:51', '$2y$10$1cY/rWhfJ2SMv7yiY3jDMuspV/znuJHfYMe51TAzTiDji.2TA2LtS', '13 camden', 'BB9 9DA');

-- --------------------------------------------------------

--
-- Table structure for table `customerbooks`
--

CREATE TABLE `customerbooks` (
  `USIID` varchar(50) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `bought` tinyint(1) DEFAULT 0,
  `removed` tinyint(1) DEFAULT NULL,
  `interaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerbooks`
--

INSERT INTO `customerbooks` (`USIID`, `ISBN`, `bought`, `removed`, `interaction_date`, `quantity`) VALUES
('cust_68026293d230b6.41788028', '978-0000000002', 1, 0, '2025-04-21 13:26:37', 2),
('cust_68026293d230b6.41788028', '978-0000000010', 1, 1, '2025-04-21 13:27:40', 1),
('cust_68026293d230b6.41788028', '978-0000000044', 1, 0, '2025-04-21 13:27:40', 1),
('cust_68026293d230b6.41788028', '978-0000000054', 1, 0, '2025-04-21 13:27:40', 1),
('cust_68057e23d42ce3.86412361', '978-0000000001', 1, 0, '2025-04-20 23:24:35', 1),
('cust_68057e23d42ce3.86412361', '978-0000000001', 0, 1, '2025-05-02 15:00:28', 1),
('cust_6815438c793eb.83018008', '978-0000000001', 0, 1, '2025-05-02 22:16:17', 1),
('cust_6815438c793eb.83018008', '978-0000000001', 0, 1, '2025-05-02 22:16:25', 1),
('cust_6815438c793eb.83018008', '978-0000000002', 0, 1, '2025-05-02 22:16:08', 1),
('cust_6815438c793eb.83018008', '978-0000000003', 0, 1, '2025-05-02 22:16:11', 1),
('cust_6815438c793eb.83018008', '978-0000000004', 0, 1, '2025-05-02 22:16:10', 1),
('cust_6815438c793eb.83018008', '978-0000000004', 0, 1, '2025-05-02 22:16:21', 1),
('cust_6815438c793eb.83018008', '978-0000000005', 0, 1, '2025-05-02 22:16:23', 1),
('cust_6815438c793eb.83018008', '978-0000000005', 0, 1, '2025-05-02 22:16:27', 1),
('cust_6815438c793eb.83018008', '978-0000000006', 0, 1, '2025-05-02 22:16:14', 1),
('cust_6815438c793eb.83018008', '978-0000000007', 0, 1, '2025-05-02 22:16:19', 1),
('cust_6815438c793eb.83018008', '978-0000000007', 0, 1, '2025-05-02 22:16:29', 1),
('cust_6815438c793eb.83018008', '978-0000000008', 0, 1, '2025-05-02 22:16:06', 1),
('cust_6815438c793eb.83018008', '978-0000000009', 0, 1, '2025-05-02 22:16:16', 1),
('cust_6815438c793eb.83018008', '978-0000000010', 1, NULL, '2025-05-02 23:19:02', 1),
('cust_6815438c793eb.83018008', '978-0000000022', 1, NULL, '2025-05-02 23:11:46', 1),
('cust_6815438c793eb.83018008', '978-0000000025', 1, NULL, '2025-05-02 23:11:46', 2),
('cust_6815438c793eb.83018008', '978-0000000028', 0, 1, '2025-05-02 22:20:53', 1),
('cust_6815438c793eb.83018008', '978-0000000040', 0, 1, '2025-05-02 22:19:37', 1),
('cust_6815438c793eb.83018008', '978-0000000040', 0, 1, '2025-05-02 22:19:41', 1),
('cust_6815438c793eb.83018008', '978-0000000041', 0, 1, '2025-05-02 22:19:32', 1),
('cust_6815438c793eb.83018008', '978-0000000042', 0, 1, '2025-05-02 22:17:08', 1),
('cust_6815438c793eb.83018008', '978-0000000043', 0, 1, '2025-05-02 22:17:10', 1),
('cust_6815438c793eb.83018008', '978-0000000044', 0, 1, '2025-05-02 22:19:39', 1),
('cust_6815438c793eb.83018008', '978-0000000045', 0, 1, '2025-05-02 22:17:11', 1),
('cust_6815438c793eb.83018008', '978-0000000045', 0, 1, '2025-05-02 22:19:40', 1),
('cust_6815438c793eb.83018008', '978-0000000046', 0, 1, '2025-05-02 22:17:13', 1),
('cust_6815438c793eb.83018008', '978-0000000047', 0, 1, '2025-05-02 22:19:38', 1),
('cust_6815438c793eb.83018008', '978-0000000047', 0, 1, '2025-05-02 22:19:42', 1),
('cust_6815438c793eb.83018008', '978-0000000048', 0, 1, '2025-05-02 22:17:06', 1),
('cust_6815438c793eb.83018008', '978-0000000050', 0, 1, '2025-05-02 22:16:45', 1),
('cust_6815438c793eb.83018008', '978-0000000051', 0, 1, '2025-05-02 22:16:40', 1),
('cust_6815438c793eb.83018008', '978-0000000053', 0, 1, '2025-05-02 22:17:02', 1),
('cust_6815438c793eb.83018008', '978-0000000054', 0, 1, '2025-05-02 22:16:38', 1),
('cust_6815438c793eb.83018008', '978-0000000055', 0, 1, '2025-05-02 22:16:39', 1),
('cust_6815438c793eb.83018008', '978-0000000057', 0, 1, '2025-05-02 22:16:43', 1),
('cust_6815438c793eb.83018008', '978-0000000058', 0, 1, '2025-05-02 22:16:35', 1),
('cust_6815f94365b17.89547094', '978-0000000001', 0, 1, '2025-05-03 21:54:20', 1),
('cust_6815f94365b17.89547094', '978-0000000001', 1, NULL, '2025-05-03 22:59:00', 1),
('cust_6815f94365b17.89547094', '978-0000000002', 0, 1, '2025-05-03 22:04:05', 1),
('cust_6815f94365b17.89547094', '978-0000000002', 1, NULL, '2025-05-03 22:59:00', 1),
('cust_6815f94365b17.89547094', '978-0000000003', 0, 1, '2025-05-03 22:04:17', 1),
('cust_6815f94365b17.89547094', '978-0000000004', 0, 1, '2025-05-03 22:04:38', 1),
('cust_6815f94365b17.89547094', '978-0000000005', 0, 1, '2025-05-03 22:04:37', 1),
('cust_6815f94365b17.89547094', '978-0000000005', 1, NULL, '2025-05-03 22:59:00', 1),
('cust_6815f94365b17.89547094', '978-0000000006', 0, 1, '2025-05-03 22:04:34', 1),
('cust_6815f94365b17.89547094', '978-0000000007', 0, 1, '2025-05-03 11:34:24', 1),
('cust_6815f94365b17.89547094', '978-0000000008', 0, 1, '2025-05-03 22:04:35', 1),
('cust_6815f94365b17.89547094', '978-0000000009', 0, 1, '2025-05-03 22:04:40', 1),
('cust_6815f94365b17.89547094', '978-0000000010', 0, 1, '2025-05-03 12:30:07', 1),
('cust_6815f94365b17.89547094', '978-0000000010', 1, NULL, '2025-05-03 22:59:00', 1),
('cust_6815f94365b17.89547094', '978-0000000012', 1, NULL, '2025-05-04 00:03:07', 1),
('cust_6815f94365b17.89547094', '978-0000000013', 0, 1, '2025-05-03 12:30:08', 1),
('cust_6815f94365b17.89547094', '978-0000000014', 1, NULL, '2025-05-03 11:32:27', 1),
('cust_6815f94365b17.89547094', '978-0000000014', 0, 1, '2025-05-03 12:30:04', 1),
('cust_6815f94365b17.89547094', '978-0000000015', 0, 1, '2025-05-04 00:02:31', 1),
('cust_6815f94365b17.89547094', '978-0000000016', 0, 1, '2025-05-04 00:02:26', 1),
('cust_6815f94365b17.89547094', '978-0000000017', 0, 1, '2025-05-03 12:30:05', 1),
('cust_6815f94365b17.89547094', '978-0000000018', 0, 1, '2025-05-04 00:03:13', 1),
('cust_6815f94365b17.89547094', '978-0000000025', 1, NULL, '2025-05-03 22:59:00', 1),
('cust_6815f94365b17.89547094', '978-0000000030', 0, 1, '2025-05-03 23:58:32', 1),
('cust_6815f94365b17.89547094', '978-0000000031', 0, 1, '2025-05-03 23:58:34', 1),
('cust_6815f94365b17.89547094', '978-0000000032', 0, 1, '2025-05-03 23:58:28', 1),
('cust_6815f94365b17.89547094', '978-0000000033', 0, 1, '2025-05-03 23:58:35', 1),
('cust_6815f94365b17.89547094', '978-0000000034', 0, 1, '2025-05-03 23:58:36', 1),
('cust_6815f94365b17.89547094', '978-0000000035', 0, 1, '2025-05-03 23:58:35', 1),
('cust_6815f94365b17.89547094', '978-0000000036', 0, 1, '2025-05-03 23:58:33', 1),
('cust_6815f94365b17.89547094', '978-0000000037', 0, 1, '2025-05-03 23:58:31', 1),
('cust_6815f94365b17.89547094', '978-0000000038', 0, 1, '2025-05-03 23:58:30', 1),
('cust_6815f94365b17.89547094', '978-0000000040', 1, NULL, '2025-05-03 23:57:09', 1),
('cust_6815f94365b17.89547094', '978-0000000041', 0, 1, '2025-05-03 22:08:19', 1),
('cust_6815f94365b17.89547094', '978-0000000042', 0, 1, '2025-05-03 22:08:26', 1),
('cust_6815f94365b17.89547094', '978-0000000043', 0, 1, '2025-05-03 22:08:27', 1),
('cust_6815f94365b17.89547094', '978-0000000044', 0, 1, '2025-05-03 22:08:20', 1),
('cust_6815f94365b17.89547094', '978-0000000045', 0, 1, '2025-05-03 22:08:24', 1),
('cust_6815f94365b17.89547094', '978-0000000046', 0, 1, '2025-05-03 22:04:52', 1),
('cust_6815f94365b17.89547094', '978-0000000047', 0, 1, '2025-05-03 23:58:01', 1),
('cust_6815f94365b17.89547094', '978-0000000048', 0, 1, '2025-05-03 22:08:29', 1),
('cust_6815f94365b17.89547094', '978-0000000050', 0, 1, '2025-05-04 00:04:57', 1),
('cust_6815f94365b17.89547094', '978-0000000051', 0, 1, '2025-05-04 00:04:55', 1),
('cust_6815f94365b17.89547094', '978-0000000052', 0, 1, '2025-05-04 00:04:38', 1),
('cust_6815f94365b17.89547094', '978-0000000053', 0, 1, '2025-05-04 00:04:34', 1),
('cust_6815f94365b17.89547094', '978-0000000054', 0, 1, '2025-05-04 00:04:50', 1),
('cust_6815f94365b17.89547094', '978-0000000055', 1, NULL, '2025-05-04 00:05:34', 1),
('cust_6815f94365b17.89547094', '978-0000000056', 0, 1, '2025-05-04 00:04:46', 1),
('cust_6815f94365b17.89547094', '978-0000000057', 0, 1, '2025-05-04 00:04:41', 1),
('cust_6815f94365b17.89547094', '978-0000000058', 0, 1, '2025-05-04 00:05:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(50) NOT NULL,
  `USIID` varchar(50) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_postcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `USIID`, `order_date`, `total_amount`, `payment_status`, `shipping_address`, `shipping_postcode`) VALUES
('ORD-6815513298621', 'cust_6815438c793eb.83018008', '2025-05-02 23:11:46', 0.00, 'completed', '13 camden', 'BB9 0BL'),
('ORD-681552E683F37', 'cust_6815438c793eb.83018008', '2025-05-02 23:19:02', 10.00, 'completed', '13 camden', 'BB9 0BL'),
('ORD-6815FECBD5D3C', 'cust_6815f94365b17.89547094', '2025-05-03 11:32:27', 0.00, 'completed', '13 camden', 'BB9 0BL'),
('ORD-68169FB435444', 'cust_6815f94365b17.89547094', '2025-05-03 22:59:00', 5.00, 'completed', '13 camden', 'BB9 0BL'),
('ORD-6816AD55832CB', 'cust_6815f94365b17.89547094', '2025-05-03 23:57:09', 0.00, 'completed', '13 camden', 'BB9 9DA'),
('ORD-6816AEBBEC953', 'cust_6815f94365b17.89547094', '2025-05-04 00:03:07', 0.00, 'completed', '13 camden', 'BB9 9DA'),
('ORD-6816AF4E718F3', 'cust_6815f94365b17.89547094', '2025-05-04 00:05:34', 0.00, 'completed', '13 camden', 'BB9 9DA');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price_at_purchase` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `ISBN`, `quantity`, `price_at_purchase`) VALUES
(1, 'ORD-6815513298621', '978-0000000022', 1, 0.00),
(2, 'ORD-6815513298621', '978-0000000025', 2, 0.00),
(3, 'ORD-681552E683F37', '978-0000000010', 1, 10.00),
(4, 'ORD-6815FECBD5D3C', '978-0000000014', 1, 0.00),
(5, 'ORD-68169FB435444', '978-0000000005', 1, 0.00),
(6, 'ORD-68169FB435444', '978-0000000001', 1, 0.00),
(7, 'ORD-68169FB435444', '978-0000000025', 1, 0.00),
(8, 'ORD-68169FB435444', '978-0000000010', 1, 5.00),
(9, 'ORD-68169FB435444', '978-0000000002', 1, 0.00),
(10, 'ORD-6816AD55832CB', '978-0000000040', 1, 0.00),
(11, 'ORD-6816AEBBEC953', '978-0000000012', 1, 0.00),
(12, 'ORD-6816AF4E718F3', '978-0000000055', 1, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `USIID` varchar(50) DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `USIID`, `ISBN`, `rating`, `created_at`) VALUES
(1, 'cust_6815438c793eb.83018008', '978-0000000010', 3, '2025-05-02 23:40:51'),
(2, 'cust_6815438c793eb.83018008', '978-0000000022', 5, '2025-05-02 23:40:57'),
(3, 'cust_6815438c793eb.83018008', '978-0000000025', 3, '2025-05-02 23:41:02'),
(4, 'cust_6815f94365b17.89547094', '978-0000000014', 5, '2025-05-03 11:33:09'),
(5, 'cust_6815f94365b17.89547094', '978-0000000025', 5, '2025-05-03 22:59:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`USIID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customerbooks`
--
ALTER TABLE `customerbooks`
  ADD PRIMARY KEY (`USIID`,`ISBN`,`interaction_date`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `USIID` (`USIID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `USIID` (`USIID`),
  ADD KEY `ISBN` (`ISBN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerbooks`
--
ALTER TABLE `customerbooks`
  ADD CONSTRAINT `customerbooks_ibfk_1` FOREIGN KEY (`USIID`) REFERENCES `customer` (`USIID`),
  ADD CONSTRAINT `customerbooks_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`USIID`) REFERENCES `customer` (`USIID`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`USIID`) REFERENCES `customer` (`USIID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
