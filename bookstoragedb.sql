-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 01:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstoragedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_books`
--

CREATE TABLE `table_books` (
  `ID` int(11) NOT NULL,
  `BookName` varchar(255) NOT NULL,
  `AuthorName` varchar(255) NOT NULL,
  `Genre` int(11) NOT NULL,
  `Publisher` varchar(255) NOT NULL,
  `Rating` decimal(3,1) NOT NULL,
  `BookCover` varchar(255) NOT NULL DEFAULT 'defaultprofile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_books`
--

INSERT INTO `table_books` (`ID`, `BookName`, `AuthorName`, `Genre`, `Publisher`, `Rating`, `BookCover`) VALUES
(1, 'The Reincarnation of Ian Labading.', 'Miguel Calumbaa', 1, 'Miguel Publishing Inc.', 4.5, '1_the_reincarnation_of_ian_labading_miguel_calumbaa_2.png'),
(2, 'The Reminiscyer of the Stars.', 'Aries Rebooks', 12, 'Akitsujiza Publishing Corp.', 4.9, '2_the_reminiscyer_of_the_stars_aries_rebooks_2.png'),
(3, 'Memory of the Fall', 'Ian Labadan', 5, 'Labading Publishing Store', 4.7, 'defaultprofile.png'),
(4, 'Chronicles of Dawn', 'Karl Ives', 4, 'KICE Books', 4.3, 'defaultprofile.png'),
(5, 'Warrior’s Path', 'Keanu Rivers', 3, 'Red Lover Press', 4.8, 'defaultprofile.png'),
(7, 'The Silent Galaxy', 'Alastair Reynolds', 1, 'Gollancz', 3.5, 'defaultprofile.png'),
(8, 'Echoes of Eternity', 'Sarah J. Maas', 3, 'Bloomsbury', 4.8, 'defaultprofile.png'),
(9, 'Code of the Streets', 'Iceberg Slim', 11, 'Holloway House', 2.9, 'defaultprofile.png'),
(10, 'The Lost algorithm', 'Ada Lovelace', 12, 'Vintage Tech', 5.0, 'defaultprofile.png'),
(11, 'Shadows of Mars', 'H.G. Wells', 6, 'Classic Reads', 3.8, 'defaultprofile.png'),
(12, 'The Last Samurai', 'Helen DeWitt', 10, 'Miramax Books', 4.2, 'defaultprofile.png'),
(13, 'Cyberpunk 2077: No Coincidence', 'Rafal Kosik', 17, 'Orbit', 3.9, 'defaultprofile.png'),
(14, 'Cooking with Fire', 'Gordon Ramsay', 17, 'Hodder & Stoughton', 4.7, 'defaultprofile.png'),
(15, 'The Art of War', 'Sun Tzu', 17, 'Shambhala', 4.6, 'defaultprofile.png'),
(16, 'Digital Fortress', 'Dan Brown', 15, 'St. Martin\'s Press', 3.4, 'defaultprofile.png'),
(17, 'The Great Gatsby', 'F. Scott Fitzgerald', 3, 'Scribner', 4.1, 'defaultprofile.png'),
(18, 'Into the Wild', 'Jon Krakauer', 8, 'Villard', 4.3, 'defaultprofile.png'),
(19, 'The Catcher in the Rye', 'J.D. Salinger', 13, 'Little, Brown', 3.0, 'defaultprofile.png'),
(20, 'Brave New World', 'Aldous Huxley', 2, 'Chatto & Windus', 4.5, 'defaultprofile.png'),
(21, 'The Hobbit', 'J.R.R. Tolkien', 6, 'Allen & Unwin', 5.0, 'defaultprofile.png'),
(22, 'Fahrenheit 451', 'Ray Bradbury', 7, 'Ballantine Books', 4.2, 'defaultprofile.png'),
(23, 'Crime and Punishment', 'Fyodor Dostoevsky', 16, 'The Russian Messenger', 4.4, 'defaultprofile.png'),
(24, 'Moby Dick', 'Herman Melville', 6, 'Harper & Brothers', 2.5, 'defaultprofile.png'),
(25, 'War and Peace', 'Leo Tolstoy', 17, 'The Russian Messenger', 4.0, 'defaultprofile.png'),
(26, 'The Odyssey', 'Homer', 14, 'Ancient Scrolls', 4.1, 'defaultprofile.png'),
(27, 'Pride and Prejudice', 'Jane Austen', 18, 'T. Egerton', 4.8, 'defaultprofile.png'),
(28, 'The Alchemist', 'Paulo Coelho', 9, 'HarperTorch', 3.7, 'defaultprofile.png'),
(29, 'The Da Vinci Code', 'Dan Brown', 10, 'Doubleday', 3.9, 'defaultprofile.png'),
(30, 'The Shining', 'Stephen King', 4, 'Doubleday', 4.6, 'defaultprofile.png'),
(31, 'It', 'Stephen King', 7, 'Viking Press', 4.5, 'defaultprofile.png'),
(32, 'A Game of Thrones', 'George R.R. Martin', 4, 'Bantam Spectra', 4.9, 'defaultprofile.png'),
(33, 'Harry Potter', 'J.K. Rowling', 1, 'Bloomsbury', 4.8, 'defaultprofile.png'),
(34, 'The Hunger Games', 'Suzanne Collins', 9, 'Scholastic', 4.3, 'defaultprofile.png'),
(35, 'Twilight', 'Stephenie Meyer', 4, 'Little, Brown', 2.8, 'defaultprofile.png'),
(36, 'Life of Pi', 'Yann Martel', 11, 'Knopf Canada', 3.6, 'defaultprofile.png'),
(37, 'The Kite Runner', 'Khaled Hosseini', 5, 'Riverhead Books', 4.7, 'defaultprofile.png'),
(38, 'The Book Thief', 'Markus Zusak', 13, 'Picador', 4.8, 'defaultprofile.png'),
(39, 'Gone Girl', 'Gillian Flynn', 11, 'Crown Publishing', 3.5, 'defaultprofile.png'),
(40, 'The Fault in Our Stars', 'John Green', 15, 'Dutton Books', 4.2, 'defaultprofile.png'),
(41, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 6, 'Norstedts Förlag', 4.4, 'defaultprofile.png'),
(42, 'The Help', 'Kathryn Stockett', 5, 'Penguin Books', 4.6, 'defaultprofile.png'),
(43, 'Divergent', 'Veronica Roth', 4, 'Katherine Tegen Books', 3.3, 'defaultprofile.png'),
(44, 'The Maze Runner', 'James Dashner', 4, 'Delacorte Press', 3.8, 'defaultprofile.png'),
(45, 'Eragon', 'Christopher Paolini', 8, 'Knopf', 3.1, 'defaultprofile.png'),
(46, 'Percy Jackson', 'Rick Riordan', 11, 'Disney Hyperion', 4.7, 'defaultprofile.png'),
(47, 'The Giver', 'Lois Lowry', 11, 'Houghton Mifflin', 4.0, 'defaultprofile.png'),
(48, 'Ender\'s Game', 'Orson Scott Card', 6, 'Tor Books', 4.9, 'defaultprofile.png'),
(49, 'Dune', 'Frank Herbert', 12, 'Chilton Books', 4.8, 'defaultprofile.png'),
(50, 'Neuromancer', 'William Gibson', 8, 'Ace', 4.1, 'defaultprofile.png'),
(51, 'Snow Crash', 'Neal Stephenson', 3, 'Bantam Spectra', 4.3, 'defaultprofile.png'),
(52, 'The Martian', 'Andy Weir', 7, 'Crown Publishing', 4.9, 'defaultprofile.png'),
(53, 'Ready Player One', 'Ernest Cline', 8, 'Random House', 4.5, 'defaultprofile.png'),
(54, 'Jurassic Park', 'Michael Crichton', 3, 'Knopf', 4.6, 'defaultprofile.png'),
(55, 'The Lost World', 'Michael Crichton', 5, 'Knopf', 3.7, 'defaultprofile.png'),
(56, 'Timeline', 'Michael Crichton', 16, 'Knopf', 3.4, 'defaultprofile.png'),
(57, 'Sphere', 'Michael Crichton', 10, 'Knopf', 3.9, 'defaultprofile.png'),
(58, 'Congo', 'Michael Crichton', 4, 'Knopf', 3.2, 'defaultprofile.png'),
(59, 'State of Fear', 'Michael Crichton', 4, 'HarperCollins', 3.0, 'defaultprofile.png'),
(60, 'Next', 'Michael Crichton', 10, 'HarperCollins', 2.9, 'defaultprofile.png'),
(61, 'Micro', 'Michael Crichton', 2, 'HarperCollins', 3.1, 'defaultprofile.png'),
(62, 'Pirate Latitudes', 'Michael Crichton', 17, 'HarperCollins', 3.5, 'defaultprofile.png'),
(63, 'Dragon Teeth', 'Michael Crichton', 4, 'HarperCollins', 4.0, 'defaultprofile.png'),
(64, 'The Andromeda Strain', 'Michael Crichton', 3, 'Knopf', 4.2, 'defaultprofile.png'),
(65, 'The Terminal Man', 'Michael Crichton', 5, 'Knopf', 3.6, 'defaultprofile.png'),
(66, 'The Great Train Robbery', 'Michael Crichton', 17, 'Knopf', 4.1, 'defaultprofile.png'),
(67, 'Eaters of the Dead', 'Michael Crichton', 13, 'Knopf', 3.3, 'defaultprofile.png'),
(68, 'Electronic Life', 'Michael Crichton', 15, 'Knopf', 2.5, 'defaultprofile.png'),
(69, 'Travels', 'Michael Crichton', 1, 'Knopf', 4.4, 'defaultprofile.png'),
(70, 'Jasper Jones', 'Craig Silvey', 12, 'Allen & Unwin', 4.2, 'defaultprofile.png'),
(71, 'Cloudstreet', 'Tim Winton', 3, 'Penguin Books', 3.9, 'defaultprofile.png'),
(72, 'Breath', 'Tim Winton', 16, 'Penguin Books', 3.7, 'defaultprofile.png'),
(73, 'Dirt Music', 'Tim Winton', 15, 'Picador', 3.5, 'defaultprofile.png'),
(74, 'The Riders', 'Tim Winton', 7, 'Pan Macmillan', 3.8, 'defaultprofile.png'),
(75, 'Blueback', 'Tim Winton', 8, 'Pan Macmillan', 4.0, 'defaultprofile.png'),
(76, 'Lockie Leonard', 'Tim Winton', 2, 'Pan Macmillan', 4.3, 'defaultprofile.png'),
(77, 'The Turning', 'Tim Winton', 3, 'Picador', 3.6, 'defaultprofile.png'),
(78, 'Eyrie', 'Tim Winton', 10, 'Penguin Books', 3.2, 'defaultprofile.png'),
(79, 'Island Home', 'Tim Winton', 4, 'Penguin Books', 4.1, 'defaultprofile.png'),
(80, 'The Shepherd\'s Hut', 'Tim Winton', 7, 'Penguin Random House', 4.5, 'defaultprofile.png'),
(81, 'Boy Swallows Universe', 'Trent Dalton', 3, 'HarperCollins', 4.8, 'defaultprofile.png'),
(82, 'All Our Shimmering Skies', 'Trent Dalton', 13, 'HarperCollins', 4.4, 'defaultprofile.png'),
(83, 'The Dry', 'Jane Harper', 1, 'Pan Macmillan', 4.6, 'defaultprofile.png'),
(84, 'Force of Nature', 'Jane Harper', 3, 'Pan Macmillan', 4.2, 'defaultprofile.png'),
(85, 'The Lost Man', 'Jane Harper', 10, 'Pan Macmillan', 4.5, 'defaultprofile.png'),
(86, 'The Survivors', 'Jane Harper', 6, 'Pan Macmillan', 4.0, 'defaultprofile.png'),
(87, 'Exiles', 'Jane Harper', 15, 'Pan Macmillan', 4.3, 'defaultprofile.png'),
(88, 'Big Little Lies', 'Liane Moriarty', 3, 'Penguin Books', 4.7, 'defaultprofile.png'),
(89, 'The Husband\'s Secret', 'Liane Moriarty', 5, 'Penguin Books', 4.4, 'defaultprofile.png'),
(90, 'Truly Madly Guilty', 'Liane Moriarty', 18, 'Penguin Books', 3.5, 'defaultprofile.png'),
(91, 'Nine Perfect Strangers', 'Liane Moriarty', 18, 'Penguin Books', 3.8, 'defaultprofile.png'),
(92, 'Apples Never Fall', 'Liane Moriarty', 18, 'Penguin Books', 4.1, 'defaultprofile.png'),
(93, 'The Slap', 'Christos Tsiolkas', 18, 'Allen & Unwin', 3.0, 'defaultprofile.png'),
(94, 'Barracuda', 'Christos Tsiolkas', 18, 'Allen & Unwin', 3.4, 'defaultprofile.png'),
(95, 'Damascus', 'Christos Tsiolkas', 17, 'Allen & Unwin', 3.9, 'defaultprofile.png'),
(96, '7 1/2', 'Christos Tsiolkas', 13, 'Allen & Unwin', 3.2, 'defaultprofile.png'),
(97, 'The Narrow Road', 'Richard Flanagan', 13, 'Vintage Books', 4.6, 'defaultprofile.png'),
(98, 'Gould\'s Book of Fish', 'Richard Flanagan', 6, 'Picador', 4.0, 'defaultprofile.png'),
(99, 'The Unknown Terrorist', 'Richard Flanagan', 8, 'Picador', 3.1, 'defaultprofile.png'),
(100, 'Wanting', 'Richard Flanagan', 3, 'Random House', 3.7, 'defaultprofile.png'),
(101, 'DIgital', 'Devils', 11, 'The Reminiscyer Company', 5.0, '101_digital_devils_1.png'),
(102, 'What a wonderful me', 'Ian', 8, 'Comedy Pub', 2.0, '102_what_a_wonderful_me_ian_1.png'),
(104, 'Alex Reb', 'Xis Ucas', 5, 'What bOOks', 4.0, '104_alex_reb_xis_ucas_2.png'),
(105, 'Wow', 'The goat', 8, 'Wow', 2.0, '105_wow_the_goat_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `table_genres`
--

CREATE TABLE `table_genres` (
  `ID` int(11) NOT NULL,
  `GenreName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_genres`
--

INSERT INTO `table_genres` (`ID`, `GenreName`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Biography'),
(4, 'Classic'),
(5, 'Cooking'),
(6, 'Drama'),
(7, 'Dystopian'),
(8, 'Fantasy'),
(9, 'Historical'),
(10, 'Horror'),
(11, 'Martial Arts'),
(12, 'Mystery'),
(13, 'Philosophy'),
(14, 'Reincarnation'),
(15, 'Romance'),
(16, 'Sci-Fi'),
(17, 'Thriller'),
(18, 'Urban Fiction');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_books`
--
ALTER TABLE `table_books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_genres`
--
ALTER TABLE `table_genres`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_books`
--
ALTER TABLE `table_books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `table_genres`
--
ALTER TABLE `table_genres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
